@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Editar Servicio</h1>
    <div class="card">
        <div class="card-header">
            @livewire('admin.serv-establecimientos', ['servicio' => $servicio])
        </div>

        <div class="card-body">
            {!! Form::model($servicio, ['route' => ['admin.servicios.update', $servicio], 'method' => 'put']) !!}
            
            @include('admin.servicios.partials.form')

                {!! Form::submit('Actualizar Servicio', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.servicios.index') }}"  class="btn btn-secondary">Cancelar</a>
                
            {!! Form::close() !!}
        </div>


    </div>

        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                
    <script>
        Livewire.on('deleteEstabl', establId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar el estbalecimiento?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteEst', establId);
                    Swal.fire(
                    'Eliminado!',
                    'El establecimiento se ha eliminado.',
                    'success'
                    )
                }
            })  
        });
        
    </script>
 
@stop