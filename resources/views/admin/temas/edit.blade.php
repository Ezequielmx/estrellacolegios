@extends('adminlte::page')

@section('title', 'Editar tema')

@section('content_header')
    <h1>Editar tema</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" method="POST" action="{{ route('admin.temas.update', $tema->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="box-body">

                        <div class="form-group @error('titulo') has-error @enderror">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $tema->titulo) }}" placeholder="Ingrese el título">
                            @error('titulo')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" placeholder="Ingrese la descripción">{{ old('descripcion', $tema->descripcion) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen">
                            @if ($tema->imagen)
                                <p class="help-block">
                                    Imagen actual:
                                    <a href="{{ asset($tema->imagen) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $tema->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="max-width: 200px;">
                                    </a>
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" class="form-control" id="video" name="video">
                            @if ($tema->video)
                                <p class="help-block">
                                    Video actual:
                                    <a href="{{ asset('storage/' . $tema->video) }}" target="_blank">{{ basename($tema->video) }}</a>
                                </p>
                            @endif
                        </div>

                        <div class="form-group @error('duracion') has-error @enderror">
                            <label for="duracion">Duración (segundos)</label>
                            <input type="number" class="form-control" id="duracion" name="duracion" value="{{ old('duracion', $tema->duracion) }}" placeholder="Ingrese la duración">
                            @error('duracion')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('admin.temas.index') }}" class="btn btn-default">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop
