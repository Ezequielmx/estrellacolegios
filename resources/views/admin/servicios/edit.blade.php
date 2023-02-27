@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Editar Servicio</h1>
   
    @livewire('admin.servicios.edit-servicio', ['servicio' => $servicio])
   
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