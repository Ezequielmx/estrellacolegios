<?php

namespace App\Http\Livewire\Admin\Servicios;

use Livewire\Component;
use App\Models\Servicio;
use App\Models\Espacio;
use App\Models\Planetario;
use App\Models\Establecimiento;
use App\Models\Estado;
use App\Models\User;
use App\Models\Linea;
use App\Services\mensWpp;

class EditServicio extends Component
{
    public $servicio;

    public $cueNew;
    public $nombreNew;
    public $provinciaNew;
    public $deptoNew;
    public $localidadNew;

    public $validCue;

    public $asesores;
    public $vendedores;
    public $planetarios;
    public $estados;
    public $espacios;
    public $lineas;

    protected $listeners = ['deleteEst'];


    protected $rules = [
        'servicio.fecha_venta' => 'required',
        'servicio.fecha_ini_serv' => 'required',
        'servicio.fecha_fin_serv' => 'required',
        'servicio.cont_1' => 'required',
        'servicio.cel_cont_1' => 'required|digits:10',
        'servicio.puesto_cont1' => 'required',
        'servicio.espacio_montaje' => 'required',
        'servicio.planetario_id' => 'required',
        'servicio.vendedor_id' => 'required',
        'servicio.estado_id' => 'required',
        'servicio.fecha_orig_ini' => 'required',
        'servicio.fecha_orig_fin' => 'required',
        'servicio.asesor_id' => 'nullable',
        'servicio.cont_2' => 'nullable',
        'servicio.puesto_cont2' => 'nullable',
        'servicio.cel_cont_2' => 'nullable|digits:10',
        'servicio.matricula_tmj' => 'nullable|numeric',
        'servicio.matricula_ttj' => 'nullable|numeric',
        'servicio.matricula_tnj' => 'nullable|numeric',
        'servicio.matricula_total_j' => 'nullable|numeric',
        'servicio.matricula_tmp' => 'nullable|numeric',
        'servicio.matricula_ttp' => 'nullable|numeric',
        'servicio.matricula_tnp' => 'nullable|numeric',
        'servicio.matricula_total_p' => 'nullable|numeric',
        'servicio.matricula_tms' => 'nullable|numeric',
        'servicio.matricula_tts' => 'nullable|numeric',
        'servicio.matricula_tns' => 'nullable|numeric',
        'servicio.matricula_total_s' => 'nullable|numeric',
        'servicio.servicio_tm' => 'nullable',
        'servicio.servicio_tt' => 'nullable',
        'servicio.servicio_tn' => 'nullable',
        'servicio.precio_alumno' => 'nullable|numeric',
        'servicio.precio_total' => 'nullable|numeric',
        'servicio.observaciones' => 'nullable',
        'servicio.linea_id' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.servicios.edit-servicio');
    }

    public function mount(Servicio $servicio)
    {
        $this->servicio = $servicio;
        $this->asesores = User::role('Asesor')->get();

        $this->vendedores = User::role('Vendedor')->get();

        $this->planetarios = Planetario::all();
        $this->estados = Estado::all();
        $this->espacios = Espacio::all();
        $this->lineas = Linea::all();
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

        $estNew = Establecimiento::where('cue', $this->cueNew)->first()->id;
        $this->servicio->establecimientos()->attach($estNew);

        $this->cueNew = null;
        $this->nombreNew = null;
        $this->provinciaNew = null;
        $this->deptoNew = null;
        $this->localidadNew = null;
        $this->validCue = false;
    }

    public function deleteEst($id)
    {
        $this->servicio->establecimientos()->detach($id);
    }

    public function changeFechaIni()
    {
        $this->servicio->fecha_fin_serv = $this->servicio->fecha_ini_serv;
    }

    public function guardar()
    {
        $this->validate();

        $this->servicio->save();

        new mensWpp($this->servicio);
        
        //redirect to admin.servicios.index with info "Servicio creado"
        return redirect()->route('admin.servicios.index')->with('info', 'Servicio guardado con éxito');
    }
}
