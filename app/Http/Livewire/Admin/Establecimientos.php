<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Establecimiento;

class Establecimientos extends Component
{
    public function render()
    {
        $establecimientos = Establecimiento::all();
        return view('livewire.admin.establecimientos', compact('establecimientos'));
    }
}
