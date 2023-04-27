<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Servicio;

class RendicionController extends Controller
{
    public function print($serv_id){
        $servicio = Servicio::find($serv_id);
        $pdf = PDF::loadView('rendicion', compact('servicio'));
        return $pdf->stream();
    }
    
}
