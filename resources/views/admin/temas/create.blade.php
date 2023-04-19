@extends('adminlte::page')

@section('title', 'Nuevo Tema')

@section('content_header')
    <h1>Nuevo Tema</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.temas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tarjeta">Tarjeta</label>
                            <input type="text" name="tarjeta" id="tarjeta" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="poster">Poster</label>
                            <input type="text" name="poster" id="oister" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="temario">Temario</label>
                            <input type="text" name="temario" id="temario" class="form-control">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('admin.temas.index') }}" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop