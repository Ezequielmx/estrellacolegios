<?php

namespace App\Http\Livewire\Admin\Servicios;

use App\Models\Establecimiento;
use Livewire\Component;
use App\Models\User;
use App\Models\Planetario;
use App\Models\Estado;
use App\Models\Espacio;
use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use App\Models\Linea;
use App\Services\mensWpp;

class NewServicio extends Component
{
    public $establecimientos = array();

    public $cueNew;
    public $nombreNew;
    public $provinciaNew;
    public $deptoNew;
    public $localidadNew;

    public $validCue;

    public $fecha_venta;
    public $fecha_ini_serv;
    public $fecha_fin_serv;
    public $fecha_orig_ini;
    public $fecha_orig_fin;
    public $cont_1;
    public $cel_cont_1;
    public $puesto_cont1;
    public $cont_2;
    public $puesto_cont2;
    public $cel_cont_2;
    public $matricula_tmj;
    public $matricula_ttj;
    public $matricula_tnj;
    public $matricula_total_j;
    public $matricula_tmp;
    public $matricula_ttp;
    public $matricula_tnp;
    public $matricula_total_p;
    public $matricula_tms;
    public $matricula_tts;
    public $matricula_tns;
    public $matricula_total_s;
    public $servicio_tm;
    public $servicio_tt;
    public $servicio_tn;
    public $espacio_montaje;
    public $precio_alumno;
    public $precio_total;
    public $observaciones;
    public $planetario_id;
    public $asesor_id;
    public $vendedor_id;
    public $estado_id;
    public $linea_id;

    public $asesores;
    public $vendedores;
    public $planetarios;
    public $estados;
    public $espacios;
    public $lineas;

    public $userReg;

    protected $listeners = ['deleteEst'];

    protected $rules = [
        'fecha_venta' => 'required',
        'fecha_ini_serv' => 'required',
        'fecha_fin_serv' => 'required',
        'cont_1' => 'required',
        'cel_cont_1' => 'required|digits:10',
        'puesto_cont1' => 'required',
        'espacio_montaje' => 'required',
        'planetario_id' => 'required',
        'vendedor_id' => 'required',
        'estado_id' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.servicios.new-servicio');
    }

    public function mount($est_id)
    {
        array_push($this->establecimientos, Establecimiento::find($est_id)->toArray());

        $this->asesores = User::role('Asesor')->get();

        $this->vendedores = User::role('Vendedor')->get();
        if(Auth::user()->hasRole('Vendedor')){
            $this->vendedor_id = Auth::user()->id;
        }

        $this->planetarios = Planetario::all();
        $this->estados = Estado::all();
        $this->espacios = Espacio::all();
        $this->lineas = Linea::all();
        $this->fecha_venta = date('Y-m-d');
        $this->estado_id = 1;

        $this->servicio_tm = 0;
        $this->servicio_tt = 0;
        $this->servicio_tn = 0;

    }

    public function buscCue()
    {
        $estNew = Establecimiento::where('cue', $this->cueNew)->first();

        if ($estNew) {
            $this->validCue = true;
            $this->nombreNew = $estNew->nombre;
            $this->provinciaNew = $estNew->prov;
            $this->deptoNew = $estNew->depto;
            $this->localidadNew = $estNew->ciudad;
        } else {
            $this->validCue = false;
            $this->nombreNew = 'No encontrado';
            $this->provinciaNew = 'No encontrado';
            $this->deptoNew = 'No encontrado';
            $this->localidadNew = 'No encontrado';
        }
    }

    public function agregar()
    {
        $estNew = Establecimiento::where('cue', $this->cueNew)->first();
        array_push($this->establecimientos, $estNew->toArray());

        $this->cueNew = null;
        $this->nombreNew = null;
        $this->provinciaNew = null;
        $this->deptoNew = null;
        $this->localidadNew = null;
        $this->validCue = false;
    }

    public function deleteEst($id)
    {
        array_splice($this->establecimientos, $id, 1);
    }

    //if update fecha_ini_serv
    public function updatedFechaIniServ()
    {
        $this->fecha_orig_ini = $this->fecha_ini_serv;
        $this->fecha_fin_serv = $this->fecha_ini_serv;
        $this->fecha_orig_fin = $this->fecha_ini_serv;
    }

    //if update fecha_fin_serv
    public function updatedFechaFinServ()
    {
        $this->fecha_orig_fin = $this->fecha_fin_serv;
    }

    public function crear(){

        $this->validate();

        $servicio = new Servicio();
        $servicio->fecha_venta = $this->fecha_venta;
        $servicio->fecha_ini_serv = $this->fecha_ini_serv;
        $servicio->fecha_fin_serv = $this->fecha_fin_serv;
        $servicio->fecha_orig_ini = $this->fecha_orig_ini;
        $servicio->fecha_orig_fin = $this->fecha_orig_fin;
        $servicio->cont_1 = $this->cont_1;
        $servicio->cel_cont_1 = $this->cel_cont_1;
        $servicio->puesto_cont1 = $this->puesto_cont1;
        $servicio->cont_2 = $this->cont_2;
        $servicio->puesto_cont2 = $this->puesto_cont2;
        $servicio->cel_cont_2 = $this->cel_cont_2;
        $servicio->matricula_tmj = $this->matricula_tmj;
        $servicio->matricula_ttj = $this->matricula_ttj;

        $servicio->matricula_tnj = $this->matricula_tnj;
        $servicio->matricula_total_j = $this->matricula_total_j;
        $servicio->matricula_tmp = $this->matricula_tmp;
        $servicio->matricula_ttp = $this->matricula_ttp;
        $servicio->matricula_tnp = $this->matricula_tnp;
        $servicio->matricula_total_p = $this->matricula_total_p;

        $servicio->matricula_tms = $this->matricula_tms;
        $servicio->matricula_tts = $this->matricula_tts;
        $servicio->matricula_tns = $this->matricula_tns;
        $servicio->matricula_total_s = $this->matricula_total_s;

        $servicio->servicio_tm = $this->servicio_tm;
        $servicio->servicio_tt = $this->servicio_tt;
        $servicio->servicio_tn = $this->servicio_tn;

        $servicio->espacio_montaje = $this->espacio_montaje;

        $servicio->precio_alumno = $this->precio_alumno;
        $servicio->precio_total = $this->precio_total;
        $servicio->observaciones = $this->observaciones;
        $servicio->planetario_id = $this->planetario_id;
        $servicio->asesor_id = $this->asesor_id;
        $servicio->vendedor_id = $this->vendedor_id;
        $servicio->estado_id = $this->estado_id;
        $servicio->cambio_estado = now();
        $servicio->linea_id = $this->linea_id;
        
        $servicio->save();
        foreach ($this->establecimientos as $est) {
            $servicio->establecimientos()->attach($est['id']);
        }

        new mensWpp($servicio);
        
        //redirect to admin.servicios.index with info "Servicio creado"
        return redirect()->route('admin.servicios.index')->with('info', 'Servicio creado');
    }
}
