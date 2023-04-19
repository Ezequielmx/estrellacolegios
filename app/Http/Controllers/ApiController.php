<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Servicio;

class ApiController extends Controller
{
    public function users(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }

    public function servicios(Request $request)
    {
        if($request->has('date')){
            $servicios = Servicio::with('establecimientos')->where('fecha_ini_serv', '=', $request->date)->get();
            if($servicios->isEmpty()){
                return response()->json(['error' => 'No hay servicios para esa fecha'], 404);
            }
            return response()->json($servicios);
        }
        else{
            return response()->json(['error' => 'No se ha enviado la fecha'], 400);
        }
    }

}
