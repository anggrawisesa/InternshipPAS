<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Helpers\TelegramHelper;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        Mail::to($event->user->email)->send(new WelcomeMail($event->user));
        $message = "Customer Baru:\nID: $user->id\nName: $user->name\nEmail: $user->email\nStatus: NEW CUSTOMER";
        TelegramHelper::sendToTelegram($message);
    }
}