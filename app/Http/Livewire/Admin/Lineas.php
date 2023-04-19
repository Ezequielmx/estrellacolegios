<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Linea;
use App\Models\Servicioubicacione;
use Google\Service\CloudLifeSciences\Mount;
use Illuminate\Support\Facades\DB;

class Lineas extends Component
{
    protected $listeners = ['deleteLinea'];


    public $nombre = '';
    public $inicio = '';
    public $fin = '';
    public $color = '';
    public $servicioubicacione_id = 1;
    public $ubicaciones;



    public function render()
    {
        $lineas = DB::table('lineas')->orderBy('activa', 'desc')->orderBy('nombre')->get();
        return view('livewire.admin.lineas', compact('lineas'));
    }

    public function mount(){
        $this->ubicaciones = Servicioubicacione::all();
    }

    public function changeNombre(Linea $linea, $nombre)
    {
        $linea->nombre = $nombre;
        $linea->save();
    }

    public function changeInicio(Linea $linea, $inicio)
    {
        $linea->inicio = $inicio;
        $linea->save();
    }

    public function changeFin(Linea $linea, $fin)
    {
        $linea->fin = $fin;
        $linea->save();
    }

    public function changeColor(Linea $linea, $color)
    {
        $linea->color = $color;
        $linea->save();
    }

    public function changeActiva(Linea $linea, $activa)
    {
        $linea->activa = $activa;
        $linea->save();
    }

    public function changeServicioUbicacion(Linea $linea, $servicioUbicacion)
    {
        $linea->servicioubicacione_id = $servicioUbicacion;
        $linea->save();
    }

    public function deleteLinea(Linea $linea)
    {
        $linea->delete();
    }

    public function createLinea()
{
    $this->validate([
        'nombre' => 'required',
        'inicio' => 'required|date',
        'fin' => 'required|date|after_or_equal:inicio',
        'color' => 'required',
    ]);

    $linea = new Linea;
    $linea->nombre = $this->nombre;
    $linea->servicioubicacione_id = $this->servicioubicacione_id;
    $linea->inicio = $this->inicio;
    $linea->fin = $this->fin;
    $linea->color = $this->color;
    $linea->activa = true;
    $linea->save();

    $this->nombre = '';
    $this->inicio = '';
    $this->fin = '';
    $this->color = '';
    $this->servicioubicacione_id = 1;
}





}
