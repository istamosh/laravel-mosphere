<?php

namespace App\Jobs;

use App\Mail\PostMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendNewPostMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $incoming)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // handle mail sending
            // send mail to authenticated user's email after storing, will pass name and content to the PostMail constructor class
            // this will store an entry to the jobs database if .env's QUEUE_CONNECTION is set to 'database'
            // set QUEUE_CONNECTION in .env to 'sync' for testing
            Mail::to($this->incoming['email'])->send(new PostMail([
                'title' => $this->incoming['title'],
                'content' => $this->incoming['content'], 
                'name' => $this->incoming['name'], 
            ]));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error sending email: ' . $e->getMessage());
        }
    }
}
