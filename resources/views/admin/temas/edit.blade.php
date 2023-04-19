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
                            <label for="tarjeta">Tarjeta</label>
                            <input type="text" class="form-control" id="tarjeta" name="tarjeta" rows="5" placeholder="Ingrese id de tarjeta" value="{{ old('tarjeta', $tema->tarjeta_file_id) }}">
                        </div>

                        <div class="form-group">
                            <label for="poster">Poster</label>
                            <input type="text" class="form-control" id="poster" name="poster" rows="5" placeholder="Ingrese id de poster" value="{{ old('poster', $tema->poster_file_id) }}">
                        </div>

                        <div class="form-group">
                            <label for="temario">Temario</label>
                            <input type="text" class="form-control" id="temario" name="temario" rows="5" placeholder="Ingrese id de temario" value="{{ old('temario', $tema->temario_file_id) }}">
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
