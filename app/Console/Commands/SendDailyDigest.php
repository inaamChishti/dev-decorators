<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyDigestEmail;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class SendDailyDigest extends Command
{

    protected $signature = 'app:send-daily-digest';

    protected $description = 'Send daily digest of top 10 posts with most likes from current date.';

    public function handle()
    {
        // Log::info('is working?');

        $currentDate = now()->toDateString();

        $posts = Post::whereDate('created_at', $currentDate)
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->take(10)
            ->get();

        Log::info('Top 10 posts with most likes from ' . $currentDate . ':');
        foreach ($posts as $post) {
            Log::info('Post ID: ' . $post->id . ', Likes Count: ' . $post->likes_count);
        }
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user)->send(new DailyDigestEmail($posts));
        }
    }
}
