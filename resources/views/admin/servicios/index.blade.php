@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <h1 style="padding:7px"><i class="fas fa-truck"></i>&nbsp;&nbsp;Servicios</h1>
    <div class="card">

        <div class="card-header">
            <a href="" class="btn btn-primary">Agregar Tema</a>    
        </div>    

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Establecimiento</th>
                        <th>Localidad</th>
                        <th>Estado</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id }}</td>
                        <td>{{ strftime("%d/%m/%Y", strtotime($servicio->fecha_ini_serv)) }}</td>
                        <td>{{ $servicio->establecimiento()->first()->nombre }}</td>
                        <td>{{ $servicio->establecimiento()->first()->ciudad }}</td>
                        <td>{{ $servicio->estado()->first()->estado }}</td>
                        <td width="10px">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.servicios.edit', $servicio) }}">Editar</a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.servicios.destroy', $servicio) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    
                @endforeach

            </table>
        </div>
    </div>

@stop

@section('css')

    <link rel="stylesheet" href="/css/admin.css">

@stop
