<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function newPost(Request $request)
    {
        $content  = $request->input('content');
        $postData = ['content' => $content];

        if ($request->hasFile('photo')) {
            $photo     = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'photos/' . $photoName;

            $photo->move(public_path('photos'), $photoName);
            $postData['photo'] = $photoPath;
        }

        $user = Auth::user();
        $user->posts()->create($postData);

        return response()->json(['message' => 'Post created successfully'], 201);
    }

    public function fetchPosts()
    {
        $posts = Post::
        // inRandomOrder()->
        withCount('likes')->take(10)->get();
        // dd($posts);
        return response()->json($posts);
    }

    public function deletePost($id)
    {
        // dd($id);
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('home')->with('error', 'Post not found.');
        }

        if ($post->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Unauthorized action.');
        }

        //delete photo if any
        if ($post->photo) {
            $photoPath = public_path($post->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }

    public function editPost($id)
    {
        $post = Post::where('id', $id)->first();
        // dd($post);
        return view('editPost', get_defined_vars());
    }

    public function updatePost($id, Request $request)
    {
        $post = Post::findOrFail($id);

        if ($request->hasFile('photo'))
        {
            if ($post->photo)
            {
                $photoPath = public_path($post->photo);
                if (file_exists($photoPath))
                {
                    unlink($photoPath);
                }
            }

            $photo     = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'photos/' . $photoName;

            $photo->move(public_path('photos'), $photoName);
            $post->photo = $photoPath;
        }

        $post->content = $request->content;
        $post->save();

        return redirect()->route('home')->with('success', 'Post updated successfully.');
    }

    public function likePost(Request $request)
    {
        $userId = $request->user_id;
        $postId = $request->post_id;

        $existingLike = Like::where('user_id', $userId)
                            ->where('post_id', $postId)
                            ->first();

        if ($existingLike)
        {
            $existingLike->delete();
            $message = 'Like removed successfully';
        }
         else
        {
            Like::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
            $message = 'Post liked successfully';
        }

        return response()->json(['message' => $message]);
    }
}
