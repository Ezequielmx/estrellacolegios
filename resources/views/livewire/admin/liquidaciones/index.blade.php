<div>
    <div class="card">
        <div class="card-body">
            <!-- filter by user, fecha desde and fecha hasta -->
            <div class="row" style="align-items: flex-end;">
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="userIdFiltro">Empleado</label>
                        <select class="form-control" wire:model.defer="userId" style="font-weight: bold;">
                            <option value="">Seleccione empleado</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-2">
                    <div class="form-group">
                        <label for="desdeFiltro">Desde</label>
                        <input type="date" class="form-control" wire:model.defer="desde" style="font-weight: bold;">
                    </div>
                </div>
                <div class="col col-md-2">
                    <div class="form-group">
                        <label for="hastaFiltro">Hasta</label>
                        <input type="date" class="form-control" wire:model.defer="hasta" style="font-weight: bold;">
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button wire:click="generarLiqui" class="btn btn-primary d-print-none">Generar</button>

                        <button onclick="window.print()" class="btn btn-secondary d-print-none">
                            <i class="fas fa-print"></i> Imprimir
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Totales
                </div>
                <div class="card-body">
                    <table class="table table-striped align-middle">
                        <tbody>
                            <tr style="font-weight: bold;">
                                <td>Total Servicios</td>
                                <td class="text-right">$ {{ number_format($totalFrentes + $totalFichas + $totalDoble +
                                    $totalTriple, 0,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>Pagos Frentes</td>
                                <td class="text-right">$ -{{ number_format($totalFrentes, 0,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>Vales</td>
                                <td class="text-right">$ -{{ number_format($totalVales, 0,",",".") }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="table-success" style="font-weight: bold;">
                                <td>A Liquidar</td>
                                <td class="text-right">$ {{ number_format( $totalFichas + $totalDoble + $totalTriple +
                                    - $totalVales, 0,",",".") }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    Dias
                </div>
                <div class="card-body">
                    <table class="table table-striped align-middle">
                        <tbody>
                            <tr>
                                <td>Días trabajados</td>
                                <td>{{ $dias_trab }}</td>
                            </tr>
                            <tr>
                                <td>Días libres</td>
                                <td>{{ $dias_libres }}</td>
                            </tr>
                            <tr>
                                <td>Días de viaje</td>
                                <td>{{ $dias_viaje }}</td>
                            </tr>
                            <tr>
                                <td>Días Servicios Cancelados</td>
                                <td>{{ $dias_cancelados }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Detalle Servicios
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-bordered align-middle">
                <thead>
                    <tr>
                        <th class="align-middle text-center">Fecha</th>
                        <th class="align-middle text-center">Colegio/Lugar</th>
                        <th class="align-middle text-center">Localidad/Prov</th>
                        <th class="align-middle text-center">Puesto</th>
                        <th class="align-middle text-center">Frente</th>
                        <th class="align-middle text-center">Ficha</th>
                        <th class="align-middle text-center">Plus Doble</th>
                        <th class="align-middle text-center">Plus Triple</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($liquidaciondetalles as $liquidaciondetalle)
                    <tr class="{{ $liquidaciondetalle['tipo']=='plus'? 'table-info' : '' }}">
                        <td style="white-space: nowrap" class="align-middle text-center">{{
                            date('d-m-Y',strtotime($liquidaciondetalle['fecha'])) }}</td>
                        <td class="align-middle">
                            @if($liquidaciondetalle['tipo']=='servicio')
                            @if ($liquidaciondetalle['servicio']->tipo == 1)
                            🏫
                            {{ $liquidaciondetalle['servicio']->establecimientos->first()->nombre }}
                            @else
                            @if ($liquidaciondetalle['servicio']->tipo == 2)
                            💰
                            @else
                            🎫
                            @endif
                            {{ $liquidaciondetalle['servicio']->lugar }}
                            @endif

                            @if ($liquidaciondetalle['servicio']->estado_id == 12)
                            <span class="badge badge-secondary">Suspendido</span>
                            @endif

                            @else
                            {{ $liquidaciondetalle['servicio']->tipo->tipo}} - {{
                            $liquidaciondetalle['servicio']->descripcion }}
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($liquidaciondetalle['tipo']=='servicio')
                            @if ($liquidaciondetalle['servicio']->tipo == 1)
                            {{ $liquidaciondetalle['servicio']->establecimientos->first()->prov }} -
                            {{ $liquidaciondetalle['servicio']->establecimientos->first()->ciudad }}
                            @endif
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($liquidaciondetalle['tipo']=='servicio')
                            {{ $liquidaciondetalle['puesto']->name }}
                            @if($liquidaciondetalle['sin_ayud'])
                            <br>
                            <span class="badge badge-primary">Sin Ayudante</span>
                            @endif
                            @endif
                        </td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{
                            number_format($liquidaciondetalle['frente'], 0,",",".") }}
                        </td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{
                            number_format($liquidaciondetalle['ficha'], 0,",",".") }}
                        </td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{
                            number_format($liquidaciondetalle['plus_doble_serv'],
                            0,",",".") }}</td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{
                            number_format($liquidaciondetalle['plus_triple_serv'],
                            0,",",".") }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-primary" style="font-weight: bold;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{
                            number_format($totalFrentes, 0,",",".") }}</td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{ number_format($totalFichas,
                            0,",",".") }}</td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{ number_format($totalDoble,
                            0,",",".") }}</td>
                        <td style="white-space: nowrap" class="text-right align-middle">$ {{ number_format($totalTriple,
                            0,",",".") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if(count($vales)>0)
    <div class="card">
        <div class="card-head">
            Detalle Vales
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Importe</th>
                </thead>
                <tbody>
                    @foreach ($vales as $vale)
                    <tr>
                        <td>{{ date('d-m-Y',strtotime($vale->fecha)) }}</td>
                        <td>{{ $vale->descripcion }}</td>
                        <td>$ {{ number_format($vale->monto,2,",",".") }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div wire:loading>
        <div class="modload">
            <div class="spinload">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>


</div>