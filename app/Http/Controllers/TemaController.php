<?php

namespace App\Http\Controllers;

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
        $tema->descripcion = $request->input('descripcion');
        // Actualiza la imagen y el video si el usuario los cambia
        if ($request->hasFile('imagen')) {
            $img = Storage::put('temas', $request->file('imagen'));
            $tema->imagen = $img;
        }
        if ($request->hasFile('video')) {
            $vid = Storage::put('temas', $request->file('video'));
            $tema->video = $vid;
        }
        $tema->duracion = $request->input('duracion');
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
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm',
            'duracion' => 'required|integer',
        ]);

        $tema = new Tema();
        $tema->titulo = $request->titulo;
        $tema->descripcion = $request->descripcion;
        $tema->duracion = $request->duracion;

        if ($request->hasFile('imagen')) {
            $img = Storage::put('temas', $request->file('imagen'));
            $tema->imagen = $img;
        }
        if ($request->hasFile('video')) {
            $vid = Storage::put('temas', $request->file('video'));
            $tema->video = $vid;
        }

        $tema->save();

        return redirect()->route('admin.temas.index')->with('success', 'Tema creado satisfactoriamente');
    }
}
