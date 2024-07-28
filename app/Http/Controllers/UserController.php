<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Mail;
use App\Helpers\TelegramHelper;

class UserController extends Controller
{
    public function getUserStats()
    {
        $newCustomers = User::where('status', 'NEW CUSTOMER')->count();
        $loyalCustomers = User::where('status', 'LOYAL CUSTOMER')->count();

        return response()->json([
            'new_customers' => $newCustomers,
            'loyal_customers' => $loyalCustomers
        ]);
    }

    public function getData()
    {
        $users = User::select(['id', 'name', 'email', 'status'])->whereRaw("email NOT LIKE '%@admin.com'");;

        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                return '<button class="btn btn-danger btn-sm delete-btn" data-id="' . $user->id . '">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    

    public function setLoyal($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'LOYAL CUSTOMER';
        $user->save();
        Mail::to($user->email)->send(new ThankYouMail($user));

        // Kirim data customer yang diubah ke Telegram
        $message = "Customer Status Updated:\nID: $user->id\nName: $user->name\nEmail: $user->email\nStatus: $user->status";
        TelegramHelper::sendToTelegram($message);

        return response()->json(['success' => true]);
    }

    
}