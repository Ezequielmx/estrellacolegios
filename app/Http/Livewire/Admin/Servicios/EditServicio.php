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
use App\Models\Tamano;
use App\Models\Valoracione;
use App\Services\asignAsesorAviso;
use App\Services\mensWpp;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Google\Service\NetworkManagement\AbortInfo;

class EditServicio extends Component
{
    //habilitar carga de archivos con use
    use WithFileUploads;
    

    public $servicio;
    public $rend_fte;
    public $rend_dorso;
    public $cobrado_txt;

    public $cueNew;
    public $nombreNew;
    public $provinciaNew;
    public $deptoNew;
    public $localidadNew;
    public $personal;
    public $puestos;
    public $valoraciones;

    public $newpers_id;
    public $newpers_rol_id;

    public $validCue;

    public $asesores;
    public $vendedores;
    public $planetarios;
    public $estados;
    public $espacios;
    public $lineas;
    public $tamanos;

    protected $listeners = ['deleteEst', 'deleteEst'];


    protected $rules = [
        'servicio.fecha_venta' => 'required',
        'servicio.fecha_ini_serv' => 'required',
        'servicio.fecha_fin_serv' => 'required',
        'servicio.cont_1' => 'required',
        'servicio.cel_cont_1' => 'required|digits:10',
        'servicio.puesto_cont1' => 'required',
        'servicio.espacio_montaje' => 'nullable',
        'servicio.tamano_id' => 'required',
        'servicio.planetario_id' => 'nullable',
        'servicio.vendedor_id' => 'required',
        'servicio.estado_id' => 'required',
        'servicio.fecha_orig_ini' => 'required',
        'servicio.fecha_orig_fin' => 'required',
        'servicio.asesor_id' => 'nullable',
        'servicio.cont_2' => 'nullable',
        'servicio.puesto_cont2' => 'nullable',
        'servicio.cel_cont_2' => 'nullable',
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
        'servicio.lugar'    => 'exclude_if:servicio.tipo,1|required',
        'servicio.tamano_id' => 'required',
        'servicio.alumnos_ing' => 'nullable',
        'servicio.cobrado' => 'nullable',
        'servicio.val_asesoramiento' => 'nullable',
        'servicio.val_puntutalidad' => 'nullable',
        'servicio.val_trato' => 'nullable',
        'servicio.val_higiene' => 'nullable',
        'servicio.val_material' => 'nullable',
        'servicio.val_general' => 'nullable',
        'servicio.rend_fte' => 'nullable',
        'servicio.rend_dorso' => 'nullable',
        'rend_fte' => 'nullable|image',
        'rend_dorso' => 'nullable|image',
    ];

    public function render()
    {
        return view('livewire.admin.servicios.edit-servicio');
    }

    public function mount(Servicio $servicio)
    {
        
        /*if(!(auth()->user()->hasAnyRole(['Super Admin', 'Administrador', 'Usuario Administrativo'])) && auth()->user()->id != $servicio->asesor_id)
            Abort(403, 'No Autorizado');*/

        if(!(auth()->user()->can('Ver todos los Servicios')) && auth()->user()->id != $servicio->asesor_id)
            Abort(403, 'No Autorizado');
     
        $this->servicio = $servicio;
        $this->asesores = User::role('Asesor')->where('activo', 1)->orderBy('name')->get();
        $this->personal = User::role(['Instructor','instructor nuevo','Cobrador'])->where('activo', 1)->orderBy('name')->get();
        $this->puestos = Role::whereIn('name', ['Instructor','instructor nuevo','Cobrador'])->get();
        $this->valoraciones = Valoracione::all();

        $this->vendedores = User::role('Vendedor')->get();

        $this->planetarios = Planetario::all();
        $this->estados = Estado::all();
        $this->espacios = Espacio::all();
        $this->lineas = Linea::where('activa','=', '1')->orderBy('nombre')->get();
        $this->tamanos = Tamano::all();
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
        //dd($id);
        $this->servicio->establecimientos()->detach($id);
    }

    public function changeFechaIni()
    {
        $this->servicio->fecha_fin_serv = $this->servicio->fecha_ini_serv;
    }

    public function guardar()
    {
        $this->validate();

        if ($this->rend_fte) {
            Storage::delete($this->servicio->rend_fte);
            $this->servicio->rend_fte = $this->rend_fte->store('rendiciones');
        }
        if ($this->rend_dorso) {
            Storage::delete($this->servicio->rend_dorso);
            $this->servicio->rend_dorso = $this->rend_dorso->store('rendiciones');
        }

        $this->servicio->save();
        if (isset($this->servicio->getchanges()['estado_id'])){
            $this->servicio->cambio_estado = now();
            $this->servicio->save();
        }

        if (isset($this->servicio->getchanges()['asesor_id'])){
            new asignAsesorAviso($this->servicio, $this->servicio->asesor_id);
        }
            
        //redirect to admin.servicios.index with info "Servicio creado"
        return redirect()->route('admin.servicios.index')->with('info', 'Servicio guardado con éxito');
    }

    public function eliminarPersonal($id)
    {
        $this->servicio->personal()->detach($id);
        $this->emit('render');
    }

    public function agregarPersonal()
    {
        $this->validate([
            'newpers_id' => 'required',
            'newpers_rol_id' => 'required'
        ]);

        //si el newpers_rol_id es 6 (instructor), asignar a una variable rolper el id del rol del personal

        if ($this->newpers_rol_id == 6) {
            $rolper = User::find($this->newpers_id)->roles->first()->id;
        } else {
            $rolper = 7;
        }

        $this->servicio->personal()->attach($this->newpers_id, ['role_id' => $rolper]);
        $this->newpers_id = null;
        $this->newpers_rol_id = null;

        $this->emit('render');
    }

    public function saveChange(){
        $this->cobrado_txt = $this->numero_a_texto($this->servicio->cobrado);
        $this->servicio->save();
    }

    public function envWpp(){
        new mensWpp($this->servicio);
        $this->servicio->estado_id = 2;
        $this->servicio->save();
    }

    function numero_a_texto($numero) {
        $unidades = array("", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve");
        $decenas = array("", "diez", "veinte", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa");
        $especiales = array("once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve");
        $centenas = array("", "ciento", "doscientos", "trescientos", "cuatrocientos", "quinientos", "seiscientos", "setecientos", "ochocientos", "novecientos");
     
        if ($numero == 0) {
            return "cero";
        } else if ($numero < 0) {
            return "menos " . $this->numero_a_texto(abs($numero));
        }
     
        $texto = "";
     
        if (($numero / 1000) >= 1) {
            $texto .= $this->numero_a_texto(floor($numero / 1000)) . " mil ";
            $numero %= 1000;
        }
     
        if (($numero / 100) >= 1) {
            $texto .= $centenas[floor($numero / 100)] . " ";
            $numero %= 100;
        }
     
        if (($numero / 10) >= 1) {
            if ($numero >= 11 && $numero <= 19) {
                $texto .= $especiales[$numero - 11] . " ";
                return $texto;
            } else if ($numero % 10 == 0) {
                $texto .= $decenas[$numero / 10] . " ";
                return $texto;
            } else {
                $texto .= $decenas[floor($numero / 10)] . " y ";
                $numero %= 10;
            }
        }
     
        if ($numero > 0) {
            $texto .= $unidades[$numero];
        }
     
        return trim($texto);
    }
}
