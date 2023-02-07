@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <h1 style="padding:7px"><i class="fas fa-school"></i>&nbsp;&nbsp;Establecimientos</h1>
   
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.establecimientos.create') }}" class="btn btn-primary">Agregar Establecimiento</a>    
            </div> 

            <div class="card-body">

                <div>
                    
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>CUE</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>Provincia</th>
                            <th>Departamento</th>
                            <th>Ciudad</th>
                            <th>Sector</th>
                            <th>Tipo</th>
                            <th>Niveles</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($establecimientos as $establecimiento)
                        <tr>
                            <td>{{ $establecimiento->cue }}</td>
                            <td>{{ $establecimiento->nombre }}</td>
                            <td>{{ $establecimiento->domicilio }}</td>
                            <td>{{ $establecimiento->prov }}</td>
                            <td>{{ $establecimiento->depto }}</td>
                            <td>{{ $establecimiento->ciudad }}</td>
                            <td>{{ $establecimiento->sector }}</td>
                            <td>{{ $establecimiento->tipo }}</td>
                            <td>{{ $establecimiento->niveles }}</td>

                        </tr>
                    @endforeach
                </table>

            </div>
        </div>   
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> 
<link rel="stylesheet" href="/css/admin.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
         $(document).ready(function () {
            
            $('#establec tfoot th.forBusq').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            $('#establec').DataTable({
                "proccessiing": true,
                "ajax": "{{ route('admin.establecimientos.index') }}",
                columns: [                   
                    {
                        data: 'editar',
                        name: 'editar'
                    },
                    {
                        data: "cue",
                        name: "cue"
                    },
                    {
                        data: "nombre",
                        name: "nombre"
                    },
                    				 {
                        data: 'domicilio',
                        name: 'domicilio'
                    },
                    {
                        data: 'tel',
                        name: 'tel'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'prov',
                        name: 'prov'
                    },
                    {
                        data: 'depto',
                        name: 'depto'
                    },
                    {
                        data: 'ciudad',
                        name: 'ciudad'
                    },
                    {
                        data: 'sector',
                        name: 'sector'
                    },
                    {
                        data: 'ambito',
                        name: 'ambito'
                    },
                    {
                        data: 'tipo',
                        name: 'tipo'
                    },
                    {
                        data: 'niveles',
                        name: 'niveles'
                    }

                    ],

                    language: {
                        lengthMenu: "Mostrar _MENU_ registros por página",
                        zeroRecords: "Nada Encontrado - Disculpa...",
                        info: "Mostrando página _PAGE_ de _PAGES_",
                        infoEmpty: "No records available",
                        infoFiltered: "(filtrados de _MAX_ registros totales)",
                        paginate: {
                            next: "Siguiente",
                            previous: "Anterior"
                        }
                    },

                    initComplete: function () {
                        // Apply the search
                        
                        this.api()
                            .columns()
                            .every(function () {
                                var that = this;
                                $('input', this.footer()).on('keyup change clear', function () {
                                    if (that.search() !== this.value) {
                                        that.search(this.value).draw();
                                    }
                                });
                            });

                        var r = $('#establec tfoot tr');
                        r.find('th').each(function(){
                            $(this).css('padding', 8);
                        });
                        $('#establec thead').append(r);
                        $('#search_0').css('text-align', 'center');

                        $('a.toggle-vis').on('click', function (e) {
                            e.preventDefault();

                        
                            // Get the column API object
                            var column = $('#establec').DataTable().column($(this).attr('data-column'));

                            
                    
                            // Toggle the visibility
                            column.visible(!column.visible());
                        });


                        this.api()
                                .columns([6,9,10,11])
                                .every(function () {
                                    var column = this;
                                    var select = $('<select><option value=""></option></select>')
                                        .appendTo($(column.footer()).empty())
                                        .on('change', function () {
                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                
                                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                                        });
                
                                    column
                                        .data()
                                        .unique()
                                        .sort()
                                        .each(function (d, j) {
                                            select.append('<option value="' + d + '">' + d + '</option>');
                                        });
                                });

                        
                    },
            });
        }); 
    </script>
@endsection