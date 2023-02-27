<?php

namespace App\Services;

use App\Models\Servicio;
use Illuminate\Support\Facades\DB;
use App\Models\Mensaje;

class mensWpp
{

    public $eventoSel;
    public $funcionSel;
    public $reservas;
    public $mensaje; 

    public function __construct(Servicio $servicio)
    {
        $id = $servicio->id;
        $cel = '+549' . $servicio->cel_cont_1;
        if(isset($servicio->asesor) && $servicio->estado->estado == 'VENDIDO'){

            $servicio->estado_id = 2;
            $servicio->save();

            setlocale(LC_TIME, "spanish");

            $mens = new Mensaje;

            $mens->servicio_id = $id;
            $mens->celular = $cel;


            $mensaje = "*¡Hola " . $servicio->cont_1 . "!* \\n";

            $mensaje .= "🤖Este es un mensaje automatizado. Recibimos una solicitud de servicio para llevar el Planetario móvil a tu institución: \\n";
            $mensaje .= "➖➖➖➖➖➖➖ \\n";  
             
            $mensaje .= "🗓️ *Fecha:* " . utf8_encode(strftime('%A %d de %B', strtotime($servicio->fecha_ini_serv))) . "\\n";
            $mensaje .= "🏫 *Establecimiento:* {$servicio->establecimiento->nombre} \\n";
            $mensaje .= "📍 *Dirección:* {$servicio->establecimiento->domicilio} \\n";
            $mensaje .= "🏙️ *Ciudad:* {$servicio->establecimiento->ciudad} , {$servicio->establecimiento->depto}, {$servicio->establecimiento->prov}\\n";
            $mensaje .= "➖➖➖➖➖➖➖ \\n"; 
            $mensaje .= "Confirmanos por favor si es correcta esta información 🤔\\n\\n";
            $mensaje .= "*A* - SI, CONFIRMAR el servicio. 👌 \\n";
            $mensaje .= "*B* - NO, CANCELAR el Servicio ❌";

            $mens->mensaje = $mensaje;

            $mens->save();


            $postFields = '{
                "phone": "' . $cel . '",
                "device": "' . env('WPP_DEVICE_ENC') . '",
                "message": "' .$mensaje . '"
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
                "Content-Type: application/json",
                "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
            ],
            ]);
        
            $response = curl_exec($curl);
            $err = curl_error($curl);
       
            curl_close($curl);

        }
    }

}