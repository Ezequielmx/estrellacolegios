@extends('adminlte::page')

@section('title', 'Temas')

@section('content_header')
    <h1>Temas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Temas</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.temas.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo Tema</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabla-temas" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Video</th>
                                <th>Duración</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temas as $tema)
                                <tr>
                                    <td>{{ $tema->id }}</td>
                                    <td>{{ $tema->titulo }}</td>
                                    <td>{{ $tema->descripcion }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $tema->imagen) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $tema->imagen) }}" alt="{{ $tema->titulo }}" class="img-fluid" width="100">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $tema->video) }}" target="_blank">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </td>
                                    <td>{{ $tema->duracion }}</td>
                                    <td>
                                        <a href="{{ route('admin.temas.edit', $tema->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.temas.destroy', $tema->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este tema?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        // Inicializar la tabla de temas con DataTables
        $('#tabla-temas').DataTable({
            'language': {
                'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            }
        });
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop
