<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Log;

class Establecimientos extends Component
{

    public $filtProv;
    public $filtDepto;
    public $filtCiudad;
    public $estabFilt;


    public $nomBusq = "";
    public $provSel = "all";
    public $deptoSel = "all";
    public $ciudadSel = "all";

    public function mount()
    {
        $establecimientos = Establecimiento::all();
        $this->estabFilt = $establecimientos;
        $this->listarFiltros();
        $this->estabFilt = $establecimientos->take(100);
    }

    public function render()
    {
        return view('livewire.admin.establecimientos');
    }

    function listarFiltros()
    {
        $this->filtProv = $this->estabFilt->pluck('prov')->unique();
        $this->filtDepto = $this->estabFilt->pluck('depto')->unique();
        $this->filtCiudad = $this->estabFilt->pluck('ciudad')->unique();
    }

    public function busqNombre()
    {
        $this->filtrarTabla();
    }

    public function limpNombre()
    {
        $this->nomBusq ="";
        $this->filtrarTabla();
    }

    public function updProv($provSel)
    {
        $prov = str_replace("_", " ", $provSel);
        $this->provSel = $prov;
        $this->filtrarTabla();
    }

    public function updDepto($deptoSel)
    {
        $depto = str_replace("_", " ", $deptoSel);
        $this->deptoSel = $depto;
        $this->filtrarTabla();
    }

    public function updCiudad($ciudadSel)
    {
        $ciudad = str_replace("_", " ", $ciudadSel);
        $this->ciudadSel = $ciudad;
        $this->filtrarTabla();
    }

    public function filtrarTabla()
    {
        $this->nomBusq = str_replace("ñ","Ñ",$this->nomBusq);
        $filter = false;
        if ($this->provSel != "all") {
            $this->estabFilt = Establecimiento::all()->where('prov', '===', $this->provSel);
            $filter = true;
        }

        if($this->nomBusq !=""){
            if ($filter) {
                $this->estabFilt = $this->estabFilt->filter(function ($item) {
                    return false !== stristr($item->nombre, $this->nomBusq);
                });
            } else {
                $this->estabFilt = Establecimiento::all()->filter(function ($item) {
                    return false !== stristr($item->nombre, $this->nomBusq);
                });
            }
            $filter = true;
        }

        if ($this->deptoSel != "all") {
            if ($filter) {
                $this->estabFilt = $this->estabFilt->where('depto', '===', $this->deptoSel);
            } else {
                $this->estabFilt = Establecimiento::all()->where('depto', '===', $this->deptoSel);
            }
            $filter = true;
        }

        if ($this->ciudadSel != "all") {
            if ($filter) {
                $this->estabFilt = $this->estabFilt->where('ciudad', '===', $this->ciudadSel);
            } else {
                $this->estabFilt = Establecimiento::all()->where('ciudad', '===', $this->ciudadSel);
            }
            $filter = true;
        }

        if (!$filter) {
            $this->estabFilt = Establecimiento::all();
        } 

        $this->listarFiltros();
        $this->estabFilt=$this->estabFilt->take(100);
    }
}
