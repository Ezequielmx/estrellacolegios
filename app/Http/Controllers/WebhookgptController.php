<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookgptController extends Controller
{
    public function handle(Request $request)
    {
        $msg = $request["data"]["body"];
        $cel = $request["data"]["fromNumber"];

        $msg = strtolower($msg);
        $first4 = substr($msg, 0, 4);

        if ($first4 != "gpt ") {
            return;
        }

        //return $msg;
        $msg = substr($msg, 4);

        $responseGpt = $this->chatGpt($msg);
        //return $responseGpt;

        $responseGpt = json_decode($responseGpt, true);

        $responseGpt = $responseGpt["choices"][0]["text"];


        //split $response
        $responseGpt = explode(" ", trim($responseGpt));

        //replace api.estrella with estrelladelplata.ml/api

        //call to Apicontroller servicios with gpt response[1]
        $url = $responseGpt[1];

        $url = str_replace("api.estrella", "estrelladelplata.ml/api", $url);//reemplazar con api final


        //return $url;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cookie: XSRF-TOKEN=eyJpdiI6ImNjaHgxTENRamo0VEV6ZFJ0bHBwbEE9PSIsInZhbHVlIjoiTWE2S3R2RHNLMnErM2g5SjRtMmduSzRuQWNqRGRsdy92ZmVZQnkwRCtrN0h6dkVLbEVJbDlGQWhmdW1hcEJLNU5oNjA2d2N5aXBza0w1dXdjelUzWXF4NXFXakJuMHJ0OW56bEd2dGd4UnBYZVJNTGFrTTJPbTI2eUxhZmJtTWIiLCJtYWMiOiJiZWFlMTM3NDVmOTVhMDFkN2FmNmMxNzE5OGZjMzkxZmE1MzU5M2UxOTQzMmMxMzQ2YzI1YzQ2ODZkMGQzZjliIiwidGFnIjoiIn0%3D; servicios_estrella_del_plata_session=eyJpdiI6ImhzU0JLM2hLdE1TMkVNK2VoNjZ6blE9PSIsInZhbHVlIjoiQnRvSzFJRU80YjlkTm1ySC9NdXp0SEI3ZUhab3JvMisxcnF6SmxiNjQ2aUp1bDlOeERmK2d0TUJtUTgrWm5EVUV5bGRkSHA0RHpmUEQvMXVzd0QyWnp6YjZKNEwrby9aU3hSa0Z6djZydkR5U3g2MFNyOWhHRWxESEJJdjBhcnUiLCJtYWMiOiI3ZWRjMzFmN2NmYjQzMDI3NmZkOWIyNzlmZThhNjA0YmI3ZTFiN2M5MWEwOWJhNjQwMmZhMWFiNTExYjA1YWUxIiwidGFnIjoiIn0%3D"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);
        $msg = "";

        if (isset($response["error"])) {
            $msg = 'No hay servicios para esa fecha';
        } else {
            $msg = "*Servicios para la fecha:* " . $response[0]["fecha_ini_serv"] . "\\n";
            $msg .= "➖➖➖➖➖➖➖➖➖➖➖\\n";
            foreach ($response as $servicio) {
                $msg .= "*Servicio Id:* " . $servicio["id"] . "\\n";
                $msg .= "*Tipo:* " . $servicio["tipo"] . "\\n";
                //if isnull $servicio["lugar"]
                if (($servicio["lugar"] != null)) {
                    $msg .= "*Lugar:* " . $servicio["lugar"] . "\\n";
                } else {
                    foreach ($servicio["establecimientos"] as $establecimiento) {
                        $msg .= "*Colegio:* " . $establecimiento["nombre"] . "\\n";
                        $msg .= "*Direccion:* " . $establecimiento["domicilio"] . "\\n";
                        $msg .= "*Ciudad:* " . $establecimiento["ciudad"] . "\\n";
                        $msg .= "*Provincia:* " . $establecimiento["prov"] . "\\n";
                    }
                }
                $msg .= "➖➖➖➖➖➖➖➖➖➖➖\\n\\n";
            }
        }
        $this->enviarWpp($cel, $msg);
    }

    function enviarWpp($cel, $msg)
    {
        echo $cel;
        echo $msg;
        $postFields = '{
            "phone": "' . $cel . '",
            "device": "' . env('WPP_DEVICE_ENC') . '",
            "order": true,
            "message": "' . $msg . '"
        }';

        $this->sendMessage($postFields);
    }

    function sendMessage($postFields)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wassenger.com/v1/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
                "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function chatGpt($msg)
    {
        $api_key = env('GPT_API_KEY');
        $model_name = "babbage:ft-personal:babbage-api-test-2023-04-13-00-28-00";
        $temperature = 0.5;
        $max_tokens = 50;
        $prompt = "{$msg}=>";
        $stop_sequence = ["_END"];

        // Set up the API request
        $request_data = array(
            'model' => $model_name,
            'prompt' => $prompt,
            'max_tokens' => $max_tokens,
            'temperature' => $temperature,
            'stop' => $stop_sequence //
        );

        $request_headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        );

        $request_url = 'https://api.openai.com/v1/completions';

        // Make the API request
        $curl = curl_init($request_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request_data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
