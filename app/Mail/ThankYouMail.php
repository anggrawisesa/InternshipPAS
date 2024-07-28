<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You for Your Purchase',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.thankyou',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->view('emails.thankyou')
                    ->with(['user' => $this->user]);
    }
}