<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;

class MapaController extends Controller
{
    public function index()
    {
        $servicios = Servicio::where('linea_id', 3)->orderBy('fecha_ini_serv')->get();

        $ubicaciones = [];

        foreach ($servicios as $servicio) {
            if ($servicio->tipo == 1){
                $ubicaciones[] = 
                    $servicio->establecimientos[0]->ciudad . ', '. $servicio->establecimientos[0]->prov . ', Argentina'
               ;
            }
        }
        

        return view('admin.mapa', compact('ubicaciones'));
    }
}
