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
        /*
        $id = $servicio->id;
        $cel = '+549' . $servicio->cel_cont_1;
        if($servicio->estado->estado == 'VENDIDO'){

            $servicio->estado_id = 2;
            $servicio->save();

            if($servicio->precio_total){
                $precio = "$" . $servicio->precio_total;
            }
            else{
                $precio = "$" . $servicio->precio_alumno . " x alumno";
            }

            $cant_alumnos = max($servicio->matricula_total_j,$servicio->matricula_tmj + $servicio->matricula_ttj + $servicio->matricula_tnj) 
                        + max($servicio->matricula_total_p,$servicio->matricula_tmp + $servicio->matricula_ttp + $servicio->matricula_tnp) 
                        + max($servicio->matricula_total_s,$servicio->matricula_tms + $servicio->matricula_tts + $servicio->matricula_tns);

            setlocale(LC_TIME, "spanish");

            $title = "¡Hola " . $servicio->cont_1 . "!";
            
            $mensaje = "🤖Este es un mensaje automatizado. Recibimos una solicitud de servicio para llevar el Planetario móvil a tu institución: \\n\\n";            
            $mensaje .= "🗓️ *Fecha:* " . utf8_encode(strftime('%A %d de %B', strtotime($servicio->fecha_ini_serv))) . "\\n\\n";
            $mensaje .= "🏫 *Establecimiento:* {$servicio->establecimientos->first()->nombre} \\n\\n";
            $mensaje .= "📍 *Dirección:* {$servicio->establecimientos->first()->domicilio} \\n\\n";
            $mensaje .= "🏙️ *Ciudad:* {$servicio->establecimientos->first()->ciudad} , {$servicio->establecimientos->first()->depto}, {$servicio->establecimientos->first()->prov}\\n\\n";
            $mensaje .= "👨‍👩‍👦‍👦 *Cantidad de Alumnos:* " .  $cant_alumnos . " aprox.\\n\\n";
            $mensaje .= " 💵 *Valor:* " . $precio . "\\n\\n";

            $mensaje .= "Confirmanos por favor si es correcta esta información 🤔";

            $postFields = '{
                "phone": "' . $cel . '",
                "reference": "' . $id . '",
                "device": "' . env('WPP_DEVICE_ENC') . '",
                "list": {
                    "description": "' . $mensaje . '",
                    "button": "Selecciona respuesta",
                    "title": "' . $title . '",
                    "sections": [
                        {
                            "rows": [
                                {
                                    "id": "ok",
                                    "title": "SI - Confirmar"
                                },
                                {
                                    "id": "no",
                                    "title": "NO - Hablar con asesor"
                                }
                            ]
                        }
                    ]
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
                "Content-Type: application/json",
                "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
            ],
            ]);
        
            $response = curl_exec($curl);
            $err = curl_error($curl);
      
            curl_close($curl);

        }*/
    }
    
}