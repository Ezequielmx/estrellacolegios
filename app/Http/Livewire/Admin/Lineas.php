<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Linea;
use Illuminate\Support\Facades\DB;

class Lineas extends Component
{
    protected $listeners = ['deleteLinea'];

    public function render()
    {
        $lineas = DB::table('lineas')->orderBy('activa', 'desc')->orderBy('nombre')->get();
        return view('livewire.admin.lineas', compact('lineas'));
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

    public function deleteLinea(Linea $linea)
    {
        $linea->delete();
    }





}
