<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Linea;
use App\Models\Servicio;
use DateTime;
use DateInterval;

class IndexController extends Controller
{
    public function index()
    {
        $lineas = Linea::where('activa', 1)->get();
        $servicios = Servicio::Orderby('linea_id')->where('estado_id', '!=', '5')->get();
        $events = [];

        foreach ($servicios as $servicio) {

            $icon = "";
            switch ($servicio->planetario_id) {
                case 1:
                    $icon = '❗';
                    break;
                case 2:
                    $icon = '❌';
                    break;
                case 3:
                    $icon = '⭕';
                    break;
            }

            $fechFin = new DateTime($servicio->fecha_fin_serv);
            $fechFin->add(new DateInterval('P1D'));
            $fechFin = $fechFin->format('Y-m-d');


            $events[] =
                [
                    'title' => $icon . " " . $servicio->establecimientos->first()->nombre . ' - ' . $servicio->establecimientos->first()->ciudad,
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
