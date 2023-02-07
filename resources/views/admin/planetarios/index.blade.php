@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-igloo"></i> </i>&nbsp;&nbsp;Planetarios</h1>
    <div class="card">
        @livewire('admin.planetarios')
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                
    <script>
        Livewire.on('deletePlanet', asesId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar el Planetario?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deletePlanetario', asesId);
                    Swal.fire(
                    'Eliminado!',
                    'el Planteario ha sido eliminado.',
                    'success'
                    )
                }
            })  
        });
        
    </script>
 
@stop
