<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class TelegramHelper
{

    public static function sendToTelegram($message)
        {
            $token = '7091354707:AAHiW8LkkxOoGf67DlhYW9nfQPGAXfu7nAY';
            $chat_id = '826077514';
            $url = "https://api.telegram.org/bot$token/sendMessage";

            $response = Http::post($url, [
                'chat_id' => $chat_id,
                'text' => $message
            ]);

            return $response->successful();
        }
}