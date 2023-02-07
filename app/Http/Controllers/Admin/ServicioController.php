<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Espacio;
use App\Models\Planetario;
use App\Models\Establecimiento;
use App\Models\Estado;
use App\Models\User;
use App\Services\mensWpp;
use Illuminate\Support\Collection;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view ('admin.servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $est_id = $_GET["establ_id"];
        $asesores = User::role('Asesor')->get()->pluck('name','id');
        $asesores->prepend(NULL);
        $planetarios = Planetario::pluck('numero', 'id');
        $planetarios->prepend(NULL);
        $establecimiento = Establecimiento::find($est_id);
        $estados = Estado::pluck('estado', 'id');
        $espacios = Espacio::pluck('espacio', 'id');
        $espacios->prepend(NULL);

        return view ('admin.servicios.create', compact('asesores', 'planetarios', 'establecimiento', 'estados', 'espacios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   
        $request->validate([
            'fecha_ini_serv' => 'required',
            'fecha_venta' => 'required',
            'estado_id' =>'required',
            'establecimiento_id' =>'required'
        ]);

        //dd($request);

        $serv = new Servicio;

        $serv->fecha_venta = $request->fecha_venta;
        $serv->fecha_ini_serv = $request->fecha_ini_serv;
        (!$request->fecha_fin_serv)? $serv->fecha_fin_serv = $request->fecha_ini_serv : $serv->fecha_fin_serv = $request->fecha_fin_serv;
        $serv->establecimiento_id = $request->establecimiento_id;
        $serv->cont_1 = $request->cont_1;
        $serv->cel_cont_1 = $request->cel_cont_1;
        $serv->puesto_cont1 = $request->puesto_cont_1;
        $serv->cont_2 = $request->cont_2;
        $serv->puesto_cont2 = $request->puesto_cont_2;
        $serv->cel_cont_2 = $request->cel_cont_2;
        $serv->matricula_tmj = $request->matricula_tmj;
        $serv->matricula_ttj = $request->matricula_ttj;
        $serv->matricula_tnj = $request->matricula_tnj;
        $serv->matricula_tmp = $request->matricula_tmp;
        $serv->matricula_ttp = $request->matricula_ttp;
        $serv->matricula_tnp = $request->matricula_tnp;
        $serv->matricula_tms = $request->matricula_tms;
        $serv->matricula_tts = $request->matricula_tts;
        $serv->matricula_tns = $request->matricula_tns;

        isset($request->servicio_tm)? $serv->servicio_tm = 1 : $serv->servicio_tm = 0;
        isset($request->servicio_tt)? $serv->servicio_tt = 1 : $serv->servicio_tt = 0;
        isset($request->servicio_tn)? $serv->servicio_tn = 1 : $serv->servicio_tn = 0;

        $serv->espacio_montaje = $request->espacio_montaje;
        ($request->planetario_id == 0)? $serv->planetario_id = null : $serv->planetario_id = $request->planetario_id;
        ($request->asesor_id == 0)?$serv->asesor_id = null: $serv->asesor_id = $request->asesor_id;
        $serv->precio_alumno = $request->precio_alumno;
        $serv->precio_total = $request->precio_total;
        $serv->observaciones = $request->observaciones;
        $serv->estado_id = $request->estado_id;

        $serv->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        //dd($servicio);
        $asesores = User::role('Asesor')->get()->pluck('name','id');
        $asesores->prepend(NULL);
        //dd($asesores);
        $planetarios = Planetario::pluck('numero', 'id');
        $planetarios->prepend(NULL);
        $estados = Estado::pluck('estado', 'id');
        $espacios = Espacio::pluck('espacio', 'id');
        $espacios->prepend(NULL);
        //dd($espacios);
        $establecimiento = $servicio->establecimiento()->first();

        return view ('admin.servicios.edit', compact('servicio', 'establecimiento', 'asesores', 'planetarios', 'estados', 'espacios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
         $request->validate([
            'fecha_ini_serv' => 'required',
            'fecha_venta' => 'required',
            'estado_id' =>'required',
            'establecimiento_id' =>'required'
        ]);

        $servicio->fecha_venta = $request->fecha_venta;
        $servicio->fecha_ini_serv = $request->fecha_ini_serv;
        (!$request->fecha_fin_serv)? $servicio->fecha_fin_serv = $request->fecha_ini_serv : $servicio->fecha_fin_serv = $request->fecha_fin_serv;
        $servicio->establecimiento_id = $request->establecimiento_id;
        $servicio->cont_1 = $request->cont_1;
        $servicio->cel_cont_1 = $request->cel_cont_1;
        $servicio->puesto_cont1 = $request->puesto_cont1;
        $servicio->cont_2 = $request->cont_2;
        $servicio->puesto_cont2 = $request->puesto_cont2;
        $servicio->cel_cont_2 = $request->cel_cont_2;
        $servicio->matricula_tmj = $request->matricula_tmj;
        $servicio->matricula_ttj = $request->matricula_ttj;
        $servicio->matricula_tnj = $request->matricula_tnj;
        $servicio->matricula_tmp = $request->matricula_tmp;
        $servicio->matricula_ttp = $request->matricula_ttp;
        $servicio->matricula_tnp = $request->matricula_tnp;
        $servicio->matricula_tms = $request->matricula_tms;
        $servicio->matricula_tts = $request->matricula_tts;
        $servicio->matricula_tns = $request->matricula_tns;

        isset($request->servicio_tm)? $servicio->servicio_tm = 1 : $servicio->servicio_tm = 0;
        isset($request->servicio_tt)? $servicio->servicio_tt = 1 : $servicio->servicio_tt = 0;
        isset($request->servicio_tn)? $servicio->servicio_tn = 1 : $servicio->servicio_tn = 0;

        $servicio->espacio_montaje = $request->espacio_montaje;
        ($request->planetario_id == 0)? $servicio->planetario_id = null : $servicio->planetario_id = $request->planetario_id;
        ($request->asesor_id == 0)?$servicio->asesor_id = null: $servicio->asesor_id = $request->asesor_id;
        $servicio->precio_alumno = $request->precio_alumno;
        $servicio->precio_total = $request->precio_total;
        $servicio->observaciones = $request->observaciones;
        $servicio->estado_id = $request->estado_id;

        $servicio->save();

        new mensWpp($servicio);

        return redirect()->route('admin.servicios.index')->with('info', 'El servicio se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
