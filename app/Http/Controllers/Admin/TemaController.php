<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tema;
use Illuminate\Support\Facades\Storage;

class TemaController extends Controller
{
    public function index()
    {
        $temas = Tema::all();
        return view('admin.temas.index', compact('temas'));
    }

    public function edit($id)
    {
        $tema = Tema::find($id);
        return view('admin.temas.edit', compact('tema'));
    }

    public function update(Request $request, $id)
    {
        $tema = Tema::find($id);
        $tema->titulo = $request->input('titulo');
        $tema->tarjeta_file_id = $request->input('tarjeta');
        $tema->poster_file_id = $request->input('poster');
        $tema->temario_file_id = $request->input('temario');
    
        $tema->save();
        return redirect()->route('admin.temas.index')->with('success', 'El tema se actualizó correctamente.');
    }

    public function destroy($id)
    {
        $tema = Tema::find($id);
        $tema->delete();
        return redirect()->route('admin.temas.index')->with('success', 'El tema se eliminó correctamente.');
    }

    public function create()
    {
        return view('admin.temas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'tarjeta' => 'nullable',
            'poster' => 'nullable',
            'temario' => 'nullable',
        ]);

        $tema = new Tema();
        $tema->titulo = $request->titulo;
        $tema->tarjeta_file_id = $request->tarjeta;
        $tema->poster_file_id = $request->poster;
        $tema->temario_file_id = $request->temario;

        $tema->save();

        return redirect()->route('admin.temas.index')->with('success', 'Tema creado satisfactoriamente');
    }
}
