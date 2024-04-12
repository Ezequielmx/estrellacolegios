<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;
use App\Services\simpleMensWpp;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $mens = new Mensaje();

        if ($request->data['flow'] == 'outbound')
            $cel = $request->data['toNumber'];
        else
            $cel = $request->data['fromNumber'];

        $celbd = str_replace('+549', '', $cel);

        $idServ = $this->findServ($celbd);

        echo $idServ;

        if (!$idServ)
            return 'num no registrado';

        /*
        if (isset($request->data['reference'])) {
            $reference = $request->data['reference'];
            $mens->servicio_id = $reference;
        }
        else{
            $mens->servicio_id = $idServ;
        }*/

        $mens->servicio_id = $idServ;

        $mens->data = json_encode($request->data);
        $mens->save();

        if ($request->data['flow'] == 'outbound') {
            return;
        }

        $servicio = Servicio::find($mens->servicio_id);

        /*
        $type = $request->data['type'];
        if($type == 'list_response'){
            $idSel = $request->data['quoted']['selectedId'];

            if($idSel == 'ok'){
                $servicio->estado_id = 3;
                $servicio->cambio_estado = now();
            }elseif ($idSel == 'no'){
                $servicio->estado_id = 4;
                $servicio->cambio_estado = now();
            }
        }
        else{
            $servicio->unreadwpp = $servicio->unreadwpp + 1;
        }
        */

        if ($servicio->estado_id == 2) {
            $respuesta  = $request->data['body'];
            $respuesta = strtolower(str_replace([' ', '.', ','], '', $respuesta));

            if ($respuesta == 'a') {
                $servicio->estado_id = 3;
                $mess = "🤖¡Gracias! Un asesor se comunicará contigo cerca de la fecha del servicio";
                new simpleMensWpp(substr($cel, 4), $mess);
                $servicio->cambio_estado = now();
            } elseif ($respuesta == 'b') {
                $servicio->estado_id = 4;
                $mess = "🤖 Upss.. Lamento la confusión. En breve un asesor se comunicará contigo.";
                new simpleMensWpp(substr($cel, 4), $mess);
                $servicio->cambio_estado = now();
            } else {
                $servicio->unreadwpp = $servicio->unreadwpp + 1;
            }
        }
        else {
            $servicio->unreadwpp = $servicio->unreadwpp + 1;
        }

        echo $servicio->estado_id;
        $servicio->save();
    }

    function findServ($phone)
    {
        $serv = DB::table('servicios')
            ->select('id')
            ->where('cel_cont_1', '=', $phone)
            ->orderBy('id', 'desc')
            ->first();

        if ($serv)
            return $serv->id;
        else
            return null;
    }
}
