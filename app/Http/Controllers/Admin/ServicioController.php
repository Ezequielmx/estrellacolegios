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
        
        return view ('admin.servicios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (isset($_GET["estab_id"]))
        {
            $est_id = $_GET["estab_id"];
        }
        else
        {
            $est_id = 0;
        }
        
        $serv_tipo = $_GET["serv_tipo"];
       
        return view ('admin.servicios.create', compact('est_id', 'serv_tipo'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   
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
        return view ('admin.servicios.edit', compact('servicio'));
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
        $servicio->cont_1 = $request->cont_1;
        $servicio->cel_cont_1 = $request->cel_cont_1;
        $servicio->puesto_cont1 = $request->puesto_cont_1;
        $servicio->cont_2 = $request->cont_2;
        $servicio->puesto_cont2 = $request->puesto_cont_2;
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
        ($request->vendedor_id == 0)?$servicio->asesor_id = null: $servicio->asesor_id = $request->asesor_id;
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
