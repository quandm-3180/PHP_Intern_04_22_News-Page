<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostStatisticsMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $writer;
    protected $posts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($writer, $posts)
    {
        $this->writer = $writer;
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.post-statistic')
            ->with([
                'writer' => $this->writer,
                'posts' => $this->posts,
            ]);
    }
}
