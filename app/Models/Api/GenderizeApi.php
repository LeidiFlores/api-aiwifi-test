<?php

namespace App\Models\Api;

use Illuminate\Support\Facades\Http;

class GenderizeApi {
    const BASE_URL = 'https://api.genderize.io';

    public static function checkGenderName(string $name)
    {
        try {
            $response = Http::get(sprintf(self::BASE_URL . '?name[]=%s', $name))->json();
        } catch (\Throwable $throw) {
            $response = null;
        }

        return $response;
    }

    public static function checkGenderMultipleNames(array $data)
    {
        try {
            $response = Http::get(sprintf(self::BASE_URL . '?name[]=%s%s', $data[0], implode('&name[]=', $data)));
        } catch (\Throwable $throw) {
            $response = null;
        }

        return $response;
    }
}
