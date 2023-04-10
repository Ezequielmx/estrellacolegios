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
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <div class="custom-file">
                                <input type="file" name="imagen" id="imagen" class="custom-file-input">
                                <label class="custom-file-label" for="imagen">Seleccionar archivo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="video">Video</label>
                            <div class="custom-file">
                                <input type="file" name="video" id="video" class="custom-file-input">
                                <label class="custom-file-label" for="video">Seleccionar archivo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="duracion">Duración</label>
                            <input type="number" name="duracion" id="duracion" class="form-control" required>
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

@section('js')
    <script>
        // Actualizar el nombre del archivo seleccionado en el campo de imagen
        $('#imagen').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        // Actualizar el nombre del archivo seleccionado en el campo de video
        $('#video').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop