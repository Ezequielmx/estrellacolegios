<?php

namespace App\Http\Livewire\Admin;

use App\Models\Asesore;
use Livewire\Component;

class Asesores extends Component
{
    public $asesor;
    public $celular;

    protected $rules = [
        'asesor' => 'required',
        'celular' => 'required'
    ];



    protected $listeners = ['deleteAsesor'];

    public function render()
    {
        $asesores = Asesore::all();
        return view('livewire.admin.asesores', compact('asesores'));
    }

    public function deleteAsesor(Asesore $asesore)
    {
        $asesore->delete();
    }

    public function changeName(Asesore $asesore, $name)
    {
        $asesore->asesor = $name;
        $asesore->save();
    }

    public function changeCel(Asesore $asesore, $cel)
    {
        $asesore->celular = $cel;
        $asesore->save();
    }

    public function store()
    {
        $this->validate();

        Asesore::create([
            'asesor' => $this->asesor,
            'celular' => $this->celular,
        ]);

        $this->reset(['asesor', 'celular']);
    }


}
