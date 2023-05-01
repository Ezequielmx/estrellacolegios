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
                <div class="col-md-2">
                    <label for="cantidad">Ventas:</label>
                    <input type="text" class="form-control" wire:model="cantidad" disabled>
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
                    <td colspan="9"><b>{{ $servicio->vendedor->name }}</b></td>
                </tr>
                @endif
                @php
                    $vent_tot++;
                @endphp
                <tr>
                    <td>{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_venta))) }}</td>
                    @if ($servicio->tipo != 1)
                    <td>{{ $servicio->lugar }}</td>
                    <td>{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_ini_serv))) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @else
                    <td>
                        @foreach ($servicio->establecimientos as $establecimiento)
                        {{ $establecimiento->nombre . " - " }}
                        @endforeach
                    </td>
                    <td>{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_ini_serv))) }}</td>
                    <td>{{ $servicio->establecimientos[0]->prov }}</td>
                    <td>{{ $servicio->establecimientos[0]->depto }}</td>
                    <td>{{ $servicio->establecimientos[0]->ciudad }}</td>
                    @endif

                    <td>{{ $servicio->precio_x_alumno }}</td>
                    <td>{{ $servicio->precio_total }}</td>
                    <td>{{ $servicio->estado->estado }}</td>
                    @endforeach
            </table>
        </div>
    </div>


</div>