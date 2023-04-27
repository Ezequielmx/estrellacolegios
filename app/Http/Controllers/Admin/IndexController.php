<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Linea;
use App\Models\Servicio;
use DateTime;
use DateInterval;
use Mobile_Detect;


class IndexController extends Controller
{
    public function index()
    {
        $lineas = Linea::where('activa', 1)->get();
        $servicios = Servicio::Orderby('linea_id')->where('estado_id', '!=', '8')->get();
        $events = [];

        foreach ($servicios as $servicio) {
            if ($servicio->planetario_id) {
                switch ($servicio->planetario_id) {
                    case 1:
                        $icon = '1️⃣';
                        break;
                    case 2:
                        $icon = '2️⃣';
                        break;
                    case 3:
                        $icon = '3️⃣';
                        break;
                    case 4:
                        $icon = '4️⃣';
                        break;
                    case 5:
                        $icon = '5️⃣';
                        break;
                    case 6:
                        $icon = '6️⃣';
                        break;
                    case 7:
                        $icon = '7️⃣';
                        break;
                }
            } else {
                switch ($servicio->tamano_id) {
                    case 1:
                        $icon = '❗';
                        break;
                    case 2:
                        $icon = '❗-❌';
                        break;
                    case 3:
                        $icon = '❌';
                        break;
                    case 4:
                        $icon = '❌-⭕';
                        break;
                    case 5:
                        $icon = '⭕';
                        break;
                }
            }

            if($servicio->fecha_ini_serv != $servicio->fecha_orig_ini){
                //Servicio que se reprogamó
                $icon .= '🔄';
            }

            $fechFin = new DateTime($servicio->fecha_fin_serv);
            $fechFin->add(new DateInterval('P1D'));
            $fechFin = $fechFin->format('Y-m-d');

            if ($servicio->tipo == 1) {
                $title = $icon . " " . $servicio->establecimientos->first()->nombre . ' - ' . $servicio->establecimientos->first()->ciudad;
            } else {
                $title = $icon . " " . $servicio->lugar;
            }


            $events[] =
                [
                    'title' => $title,
                    'start' => $servicio->fecha_ini_serv,
                    'end'   => $fechFin,
                    'color' => $servicio->linea->color,
                    'linea' => $servicio->linea_id,
                    'panetario' => $servicio->planetario_id,
                    'url' => route('admin.servicios.edit', $servicio),
                    'className' => ['calEst' . $servicio->estado_id, 'outl']

                ];
        }

        $events[] =
            [
                'title' => '4 Gde - 4 Med - 1 Ch',
                'start' => '2022-11-07',
                'end'   => '2022-11-07',
                'allDay' => false
            ];

        $events[] =
            [
                'title' => 'Fondo2',
                'start' => '2023-02-16',
                'end'   => '2023-02-16',
                'color' => 'red',
                'className' => 'calEst1',
                'description' => 'ASDA SADASD SADASDA'
            ];

        $events[] =
            [
                'title' => 'Fondo2',
                'start' => '2023-02-20',
                'end'   => '2023-02-20',
                'color' => 'blue',
                'borderColor' => 'red'
            ];

        return view('admin.index', compact('events', 'lineas'));
    }
}
