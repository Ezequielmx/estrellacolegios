<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Vale;
use App\Models\User;
use App\Models\Pluse;
use App\Models\Plustipo;
use App\Models\Comisione;


class Vales extends Component
{
    public $vales;

    public $fechaVale;
    public $user_idVale;
    public $descripcionVale;
    public $montoVale;

    public $users;
    public $pluses;
    public $plusTipos;

    public $fechaPlus;
    public $user_idPlus;
    public $descripcionPlus;
    public $montoPlus;
    public $tipoidPlus;

    public $desdeFiltro;
    public $hastaFiltro;
    public $userIdFiltro;

    public $tabActivo = 'vales';

    public function mount()
    {
        $this->fechaVale = date('Y-m-d');
        $this->fechaPlus = date('Y-m-d');
        //user who has role 'asesor', 'instructor' or 'cobrador' ordered by name
        $this->users = User::role(['asesor', 'instructor','instructor nuevo', 'instructor intermedio', 'cobrador'])->where('activo',1)->orderBy('name')->get();
        $this->plusTipos = Plustipo::all();

        $this->desdeFiltro = date('Y-m-01');
        $this->hastaFiltro = date('Y-m-d');

    }

    public function render()
    {
        //vales filtered by date and user
        $this->vales = Vale::orderBy('fecha');
        $this->pluses = Pluse::orderBy('fecha');

        if($this->desdeFiltro)
        {
            $this->vales = $this->vales->where('fecha','>=',$this->desdeFiltro);
            $this->pluses = $this->pluses->where('fecha','>=', $this->desdeFiltro);
        }

        if($this->hastaFiltro)
        {
            $this->vales = $this->vales->where('fecha','<=',$this->hastaFiltro);
            $this->pluses = $this->pluses->where('fecha','<=',$this->hastaFiltro);
        }

        if($this->userIdFiltro)
        {
            $this->vales = $this->vales->where('user_id',$this->userIdFiltro);
            $this->pluses = $this->pluses->where('user_id',$this->userIdFiltro);
        }

        $this->vales = $this->vales->get();
        $this->pluses = $this->pluses->get();

        return view('livewire.admin.vales');
    }

    public function agregarVale()
    {

        $this->validate(
            [
                'fechaVale' => 'required',
                'user_idVale' => 'required',
                'descripcionVale' => 'nullable',
                'montoVale' => 'required',
            ]
        );

        Vale::create([
            'fecha' => $this->fechaVale,
            'user_id' => $this->user_idVale,
            'descripcion' => $this->descripcionVale,
            'monto' => $this->montoVale,
        ]);

        $this->fechaVale = date('Y-m-d');
        $this->user_idVale = '';
        $this->descripcionVale = '';
        $this->montoVale = '';
    }

    public function deleteVale($id)
    {
        Vale::destroy($id);
    }

    //function if tipo_idPluse updated
    public function updatedTipoidPlus()
    {
        //Find role id of user_idPlus
        $user = User::find($this->user_idPlus);
        $role_id = $user->roles->first()->id;
        //Find comisiones of role_id

        $comis = Comisione::Where('role_id', $role_id)->where('servicioubicacione_id', 2)->first();

        switch($this->tipoidPlus)
        {
            
            case 1:
                $this->montoPlus = $comis->dia_libre;
                break;
            case 2:
                $this->montoPlus = $comis->dia_viaje;
                break;
            case 3:
                $this->montoPlus = $comis->servicio_suspendido;
                break;
            default:
                $this->montoPlus = 0;
                break;
        }
    }

    public function agregarPlus(){
            
            $this->validate(
                [
                    'fechaPlus' => 'required',
                    'user_idPlus' => 'required',
                    'tipoidPlus' => 'required',
                    'montoPlus' => 'required',
                ]
            );
    
            Pluse::create([
                'fecha' => $this->fechaPlus,
                'user_id' => $this->user_idPlus,
                'plustipo_id' => $this->tipoidPlus,
                'descripcion' => $this->descripcionPlus,
                'monto' => $this->montoPlus,
            ]);
    
            $this->fechaPlus = date('Y-m-d');
            $this->user_idPlus = '';
            $this->descripcionPlus = '';
            $this->montoPlus = '';
            $this->tipoidPlus = '';
    }

    public function deletePlus($id)
    {
        Pluse::destroy($id);
    }

    public function borrarFiltros()
    {
        $this->desdeFiltro = date('Y-m-01');
        $this->hastaFiltro = date('Y-m-d');
        $this->userIdFiltro = '';
    }

    public function activaTab($tab)
    {
        $this->tabActivo = $tab;
    }
}
