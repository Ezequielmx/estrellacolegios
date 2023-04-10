@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
       
    @livewire('admin.servicios.new-servicio', ['est_id' => $est_id, 'serv_tipo' => $serv_tipo])
   
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                
    <script>
        Livewire.on('deleteEstabl', establId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar el establecimiento?',
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