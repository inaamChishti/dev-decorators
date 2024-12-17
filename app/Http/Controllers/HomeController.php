<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Post, Comment};
use App\Models\Like;


class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
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
        $posts = Post::withCount('likes')
                ->with('comments.replies')
                ->take(10)
                ->get();

        return response()->json($posts);
    }


    public function deletePost($id)
    {
        // dd($id);
        $post = Post::find($id);

        if (!$post)
        {
            return redirect()->route('home')->with('error', 'Post not found.');
        }

        if ($post->user_id !== auth()->id())
        {
            return redirect()->route('home')->with('error', 'Unauthorized action.');
        }

        if ($post->photo)
        {
            $photoPath = public_path($post->photo);
            if (file_exists($photoPath))
            {
                unlink($photoPath);
            }
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }

    public function editPost($id)
    {
        $post = Post::where('id', $id)->first();
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

        if ($existingLike) {
                $existingLike->delete();
                $message = 'Like removed successfully';
        } else {
            Like::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
            $message = 'Post liked successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function addComment(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment            = new Comment();
        $comment->content   = $request->content;
        $comment->post_id   = $request->post_id;
        $comment->user_id   = auth()->id();
        $comment->parent_id = null;
        $comment->save();

        return response()->json(['success' => true]);
    }

    public function addReply(Request $request)
    {
        $request->validate([
            'content'   => 'required|string',
            'parent_id' => 'required|exists:comments,id',
        ]);

        $reply = new Comment();
        $reply->content   = $request->content;
        $reply->post_id   = Comment::find($request->parent_id)->post_id;
        $reply->user_id   = auth()->id();
        $reply->parent_id = $request->parent_id;
        $reply->save();

        return response()->json(['success' => true]);
    }

    public function fetchComments($postId)
    {
        $comments = Comment::with('user')
            ->where('post_id', $postId)
            ->whereNull('parent_id')
            ->get();

        $formattedComments = $comments->map(function ($comment) {
            return [
                'id'        => $comment->id,
                'content'   => $comment->content,
                'user_name' => $comment->user->name,
            ];
        });

        return response()->json($formattedComments);
    }


    public function fetchReplies($commentId)
    {
        $replies = Comment::with('user')
                    ->where('parent_id', $commentId)
                    ->get();

        $formattedReplies = $replies->map(function ($reply) {
            return [
                'content'   => $reply->content,
                'user_name' => $reply->user->name
            ];
        });

        return response()->json($formattedReplies);
    }
}
