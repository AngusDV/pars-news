<?php

namespace AngusDV\ParsNews\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotificaionMail extends Mailable
{
    use Queueable, SerializesModels;
    // Constructor to receive user data
    public function __construct(public $article)
    {
    }
    // Build the email
    public function build()
    {
        return $this->view('ParsNews::emails.admin-notification')
            ->subject("مقاله جدید اضافه شد!")
            ->with(['article' => $this->article]);
    }
}
