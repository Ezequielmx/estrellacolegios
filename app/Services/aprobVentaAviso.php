<?php

namespace App\Services;

use App\Models\Servicio;
use Illuminate\Support\Facades\DB;
use App\Models\Mensaje;
use PhpParser\Node\Expr\Cast\String_;
use App\Models\User;

class aprobVentaAviso
{
    public function __construct(Servicio $servicio)
    {
        $user = User::find(13);
        $message = '🤖 *Nueva Venta Aprobada* \\n\\n';
        
        $message .= '🗺 *Linea:* ' . $servicio->linea->nombre . '\\n';
        $message .= '📅 *Fecha:* ' . date("d/m/Y", strtotime($servicio->fecha_ini_serv));
        if ($servicio->fecha_fin_serv != $servicio->fecha_ini_serv)
            $message .= ' - ' . date("d/m/Y", strtotime($servicio->fecha_fin_serv));
        $message .= '\\n';

        if ($servicio->tipo == 1) {
            $message .= '🏫 *Tipo de Servicio:* Colegio\\n';
        } elseif ($servicio->tipo == 2) {
            $message .= '💰 *Tipo de Servicio:* Evento Pago\\n';
        } elseif ($servicio->tipo == 3) {
            $message .= '🎫 *Tipo de Servicio:* Evento Al Cobro\\n';
        }
        $message .= '\\n';

        if ($servicio->tipo != 1) {
            $message .= '📍 *Lugar:* ' . $servicio->lugar . '\\n';
        } else {
            $message .= '🏫 *Colegio:* ' . $servicio->establecimientos[0]->nombre . '\\n';
            $message .= '    ' . $servicio->establecimientos[0]->prov . ' - ' . $servicio->establecimientos[0]->depto . ' - ' . $servicio->establecimientos[0]->ciudad . '\\n';
            $message .= '    ' . $servicio->establecimientos[0]->domicilio . '\\n';
        }

        if ($servicio->tipo == 1) {
            $cant_alumnos = max($servicio->matricula_total_j, $servicio->matricula_tmj + $servicio->matricula_ttj + $servicio->matricula_tnj)
                + max($servicio->matricula_total_p, $servicio->matricula_tmp + $servicio->matricula_ttp + $servicio->matricula_tnp)
                + max($servicio->matricula_total_s, $servicio->matricula_tms + $servicio->matricula_tts + $servicio->matricula_tns);

            $message .= '👨‍🏫 *Cantidad de Alumnos:* ' . $cant_alumnos . '\\n';
            $message .= '💲 *Precio por alumno:* ' . number_format($servicio->precio_alumno, 0, ",", ".") . '\\n';
        }

        if ($servicio->tipo != 3)
            $message .= '💲 *Precio Total:* ' . number_format($servicio->precio_total, 0, ",", ".") . '\\n';


        new simpleMensWpp($user->celular, $message);
    }
}
