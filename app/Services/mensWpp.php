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

   /* public function __construct(int $funcSel, String $mensaje)
    {   
        $this->mensaje = $mensaje;
        $this->reservas = DB::table('reservas')
                        ->join('funcione_reserva', 'reservas.id', '=', 'funcione_reserva.reserva_id') 
                        ->join('funciones', 'funcione_reserva.funcione_id', '=', 'funciones.id') 
                        ->join('temas', 'funciones.tema_id', '=', 'temas.id') 
                        ->join('eventos', 'funciones.evento_id', '=', 'eventos.id') 
                        ->select(
                                'reservas.id',
                                'reservas.usuario',
                                'reservas.telefono',
                                'funciones.id',
                                'temas.titulo',
                                'funciones.fecha',
                                'funciones.horario'
                                )
                        ->where('funciones.id', '=', $funcSel)
                        ->get();
    }

    public function wppAviso()
    {
        setlocale(LC_TIME, "spanish");

        foreach ($this->reservas as $reserva) {

            $this->mensaje = str_replace("\n", "\\n", $this->mensaje);

            $name = $reserva->usuario ;
            $cel = "549" . $reserva->telefono;
            $mens= "*Hola $name!* \\nTenemos un *AVISO IMPORTANTE* acerca de tu reserva para el Planetario Móvil - Función: $reserva->titulo -" . 
                    utf8_encode(strftime('%A %d de %B', strtotime($reserva->fecha))) . 
                    " - " . strftime('%H:%M', strtotime($reserva->horario )) . "\\n" . $this->mensaje;

            

            //AvisoFuncion::dispatch($cel, $mens);
        } 

    }*/

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

            $mens->save();

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


            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.wassenger.com/v1/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"phone\":\"". $cel. "\",\"message\":\"" . $mensaje . "\"}",
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