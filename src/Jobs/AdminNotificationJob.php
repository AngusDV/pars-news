<?php

namespace AngusDV\ParsNews\Jobs;

use AngusDV\ParsNews\Mail\AdminNotificaionMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AdminNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // Specify the number of tries
    public $tries = 5; // Number of attempts before failing
    // Optional: specify the timeout in seconds
    public $timeout = 60; // Timeout for each attempt
    // Constructor to receive data
    public function __construct(public $article)
    {
    }
    // Execute the job
    public function handle()
    {
        Mail::to(config('pars-news.admin_email'))->send(new AdminNotificaionMail($this->article));
    }
    // Optional: Handle job failure
    public function failed($exception)
    {
        // Logic to execute when the job fails
        // For example, log the error or notify someone
        logger()->error('AdminNotificationJob failed: ' . $exception->getMessage());
    }
}
