<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();
        
        // Ubah status user menjadi "LOYAL CUSTOMER"
        $user->status = 'LOYAL CUSTOMER';
        $user->save();

        // Kirim email terima kasih
        Mail::to($user->email)->send(new ThankYouMail($user));

        // Redirect ke halaman yang diinginkan
        return redirect()->route('home')->with('success', 'Checkout berhasil dan email terima kasih telah dikirim.');
    }
}