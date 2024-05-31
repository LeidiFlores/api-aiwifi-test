<?php

namespace App\Models\Api;

use Illuminate\Support\Facades\Http;

class MailboxlayerApi {
    const BASE_URL = 'http://apilayer.net/api';

    public static function checkEmail(string $email)
    {
        try {
            return Http::get(sprintf(self::BASE_URL . '/check?access_key=%s&email=%s', env('ACCESS_TOKEN_MAILBOXLAYER'), $email))->json();
        } catch (\Throwable $throw) {
            return $throw->getMessage();
        }
    }
}
