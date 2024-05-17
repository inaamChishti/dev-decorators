<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailyDigestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $posts;

    /**
     * Create a new message instance.
     */
    public function __construct(Collection $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Daily Digest Email')
                    ->view('emails.daily_digest')
                    ->with('posts', $this->posts);
    }
}
