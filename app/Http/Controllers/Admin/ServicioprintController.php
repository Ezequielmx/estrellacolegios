<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;

class ServicioprintController extends Controller
{
    public function print($serv_id){
        $servicio = Servicio::with('linea')
                        ->with('vendedor')
                        ->with('espacio')
                        ->find($serv_id);
        $pdf = PDF::loadView('servimpr', compact('servicio'));
        return $pdf->stream();
    }

    public function show($serv_id){
        $servicio = Servicio::with('linea')
                        ->with('vendedor')
                        ->with('espacio')
                        ->find($serv_id);
        return view('servimprv', compact('servicio'));
    }
}
