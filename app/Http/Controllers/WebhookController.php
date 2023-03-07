<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $reference = null;
        $mens = new Mensaje();

        if ($request->data['flow'] == 'outbound')
            $cel= $request->data['toNumber'];
        else
            $cel = $request->data['fromNumber'];

        $celbd = str_replace('+549', '', $cel);

        $idServ = $this->findServ($celbd);
        
        echo $idServ;

        if(!$idServ)
            return 'num no registrado';

        if (isset($request->data['reference'])) {
            $reference = $request->data['reference'];
            $mens->servicio_id = $reference;
        }
        else{
            $mens->servicio_id = $idServ;
        }

        $mens->data= json_encode($request->data);
        $mens->save();

        if ($request->data['flow'] == 'outbound') {
            return;
        }

        $servicio = Servicio::find($mens->servicio_id);

        

        $type = $request->data['type'];
        if($type == 'buttons_response'){
            $idSel = $request->data['quoted']['selectedId'];

            if($idSel == 'ok')
                $servicio->estado_id = 3;
            elseif ($idSel == 'call')
                $servicio->estado_id = 4;
        }
        else{
            $servicio->unreadwpp = $servicio->unreadwpp + 1;
        }

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
