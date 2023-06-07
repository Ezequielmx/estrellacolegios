@extends('adminlte::page')

@section('title','Liquidaciones')

@section('content')

@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif

<div style="display: flex; justify-content: space-between; align-items:center"  class="d-print-none">
    <h1 style="padding:7px"><i class="fas fa-money-bill-alt"></i>&nbsp;&nbsp;Liquidaciones</h1>
</div>
@livewire('admin.liquidaciones.index')

@stop

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    /*
    Livewire.on('deleteLin', lineaId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar la Línea?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteLinea', lineaId);
                    Swal.fire(
                    'Eliminado!',
                    'la Línea ha sido eliminada.',
                    'success'
                    )
                }
            })  
        });
        */
</script>
@stop