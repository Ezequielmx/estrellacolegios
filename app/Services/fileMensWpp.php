<?php

namespace App\Services;

class fileMensWpp
{
    public function __construct(string $cel, string $fileId)
    {
        $cel = '+549' . $cel;


        $postFields = '{
            "phone": "' . $cel . '",
            "device": "' . env('WPP_DEVICE_ENC') . '",
            "media": {
                "file": "' . $fileId . '"
              }
        }';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.wassenger.com/v1/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}
