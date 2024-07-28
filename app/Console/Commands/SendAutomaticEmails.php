<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Mail;
use App\Mail\WelcomeMail;
use App\Mail\ThankYouMail;

class SendAutomaticEmails extends Command
{
    protected $signature = 'emails:send';
    protected $description = 'Send automatic emails to users based on their status';

    public function handle()
    {
        $newCustomers = User::where('status', 'NEW CUSTOMER')->get();
        $loyalCustomers = User::where('status', 'LOYAL CUSTOMER')->get();

        foreach ($newCustomers as $user) {
            Mail::to($user->email)->send(new WelcomeMail($user));
        }

        foreach ($loyalCustomers as $user) {
            Mail::to($user->email)->send(new ThankYouMail($user));
        }

        $this->info('Automatic emails sent successfully!');
    }
}