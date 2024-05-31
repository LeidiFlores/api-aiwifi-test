<?php

namespace App\Models\Api;

use Illuminate\Support\Facades\Http;

class NationalizeApi {
    const BASE_URL = 'https://api.nationalize.io';

    public static function checkNationalityName(string $name)
    {
        try {
            $response = Http::get(sprintf(self::BASE_URL . '?name[]=%s', $name))->json();
        } catch (\Throwable $throw) {
            $response = null;
        }

        return $response;
    }

    public static function checkNationalityMultipleNames(array $data)
    {
        try {
            $response = Http::get(sprintf(self::BASE_URL . '?name[]=%s%s', $data[0], implode('&name[]=', $data)));
        } catch (\Throwable $throw) {
            $response = null;
        }

        return $response;
    }
}
