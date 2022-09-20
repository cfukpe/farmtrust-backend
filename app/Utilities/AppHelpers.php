<?php

namespace App\Utilities;


class AppHelpers
{
    public static function httpResponse($data, $message = "", $status = 200)
    {
        return [
            'data' => $data,
            'message' => $message,
            'status' => $status
        ];
    }
}
