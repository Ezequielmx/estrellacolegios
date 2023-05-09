<div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <label for="filtro">Filtrar por:</label>
                    <select class="form-control" wire:model="filtro" id="filtro">
                        <option value="hoy">Hoy</option>
                        <option value="ayer">Ayer</option>
                        <option value="ultima_semana">Última semana</option>
                        <option value="ultimo_mes">Último mes</option>
                        <option value="ultimo_anio">Último año</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="cantidad">Ventas:</label>
                    <input type="text" class="form-control" wire:model="cantidad" disabled>
                </div>
                <div class="col-md-1">
                    <label for="aprob">Aprobadas:</label>
                    <input type="text" class="form-control"  disabled value="{{ $servicios->where('estado_id','>',0)->count() }}">
                </div>
                <div class="col-md-1">
                    <label for="falt">Faltantes:</label>
                    <input type="text" class="form-control"  disabled value="{{ $servicios->count() - $servicios->where('estado_id','>',0)->count() }}">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @php
            $vend = '';
            $vend_cont = 0;
            @endphp
            <table class="table table-striped">
                <thead>
                    <th>Fecha Venta</th>
                    <th>Colegio/Lugar</th>
                    <th>Fecha Servicio</th>
                    <th>Provincia</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Precio x Alumno</th>
                    <th>Precio Total</th>
                    <th>Estado</th>
                    <th></th>
                </thead>
                @foreach ($servicios as $servicio)
                @if ($servicio->vendedor_id != $vend)
                @php
                $vent_tot = 0;
                $vend = $servicio->vendedor_id;
                $vend_cont = ($vend_cont+1) % 4;
                switch ($vend_cont) {
                case 0:
                $color = 'table-success';
                break;
                case 1:
                $color = 'table-danger';
                break;
                case 2:
                $color = 'table-warning';
                break;
                case 3:
                $color = 'table-info';
                break;
                }
                @endphp
                <tr class={{ $color }}>
                    <td colspan="10"><b>{{ $servicio->vendedor->name }} - {{ $servicios->where('vendedor_id',$servicio->vendedor->id)->count() }}</b></td>
                </tr>
                @endif
                @php
                $vent_tot++;
                @endphp
                <tr {{ $servicio->estado_id>0? 'style=background-color:#5f9ea0' : '' }}>
                    <td>{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_venta))) }}</td>
                    @if ($servicio->tipo != 1)
                    <td>
                        @if ($servicio->tipo == 2)
                        💰 
                        @else
                        🎫 
                        @endif
                        {{ $servicio->lugar }}</td>
                    <td>{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_ini_serv))) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @else
                    <td>🏫
                        @foreach ($servicio->establecimientos as $establecimiento)
                            {{ $establecimiento->nombre . " - " }}
                        @endforeach
                    </td>
                    <td>{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_ini_serv))) }}</td>
                    <td>{{ $servicio->establecimientos[0]->prov }}</td>
                    <td>{{ $servicio->establecimientos[0]->depto }}</td>
                    <td>{{ $servicio->establecimientos[0]->ciudad }}</td>
                    @endif

                    <td>$ {{ number_format($servicio->precio_alumno,0,",",".") }}</td>
                    <td>$ {{ number_format($servicio->precio_total,0,",",".") }}</td>
                    <td>{{ $servicio->estado->estado }}</td>
                    <td style="white-space: nowrap">
                        @can('aprobar ventas')
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('admin.servicios.edit', $servicio) }}">Ver</a>

                        
                            @if ($servicio->estado_id == 0)
                                <button class="btn btn-success btn-sm" wire:click='aprobarVenta({{ $servicio->id }})'>Aprobar</button> 
                            @endif
                        @endcan
                    </td>
                    @endforeach
            </table>
        </div>
    </div>


    <div wire:loading>
        <div class="modload">
            <div class="spinload">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>

</div>