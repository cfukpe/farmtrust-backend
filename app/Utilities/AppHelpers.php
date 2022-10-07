<?php

namespace App\Utilities;

use GuzzleHttp\Client;


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

    public static function verifyPayment($transaction_id)
    {
        $http = new Client();
        $res = $http->get("https://api.paystack.co/transaction/verify/" . $transaction_id, [
            "headers" => [
                "Authorization" => "Bearer " . config('paystack.secretKey'),
            ]
        ]);

        // try {
        $response = json_decode($res->getBody(), 1);
        return $response;
        // } catch (\Exception $ex) {
        //     throw $ex;
        // }
    }
}
