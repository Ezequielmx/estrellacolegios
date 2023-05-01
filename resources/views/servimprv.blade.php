<!DOCTYPE html>
@php
//set locale argentina
setlocale(LC_TIME, "spanish");


@endphp
<html>

<head>
    <meta charset="UTF-8">
    <title>Ficha de Servicio</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.42857143;
            color: #333333;
            background-color: #ffffff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        thead {
            background-color: #f5f5f5;
        }

        thead th {
            font-weight: bold;
            text-align: left;
            padding: 2px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody td {
            padding: 2px;
            border-bottom: 1px solid #ddd;
        }

        h1, h2, h3, h4{
            margin-block-start: 2px;
            margin-block-end: 2px;
        }

        h1 {
            font-size: 1.75em;
        }

        h2 {
            font-size: 1.5em;
        }

        h3 {
            font-size: 1.25em;
        }

        .row {
            /*margin-left: -15px;
            margin-right: -15px;*/
        }

        .col {
            float: left;
            padding-left: 1%;
            padding-right: 1%;
        }

        .col-1 {
            width: 8.33%;
        }

        .col-2 {
            width: 14.66%;
        }

        .col-3 {
            width: 23%;
        }

        .col-4 {
            width: 31.33%;
        }

        .col-5 {
            width: 39.66%;
        }

        .col-6 {
            width: 48%;
        }

        .col-7 {
            width: 56.33%;
        }

        .col-8 {
            width: 64.66%;
        }

        .col-9 {
            width: 73%;
        }

        .col-10 {
            width: 81.33%;
        }

        .col-11 {
            width: 89.66%;
        }

        .col-12 {
            width: 98%;
        }

        .clearfix {
            clear: both;
        }

        /* Card container */
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            margin-bottom: 1rem;
        }

        /* Card header */
        .card-header {
            padding: 0 10px;
            margin-bottom: 0;
            background-color: #f7f7f9;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            border-top-left-radius: calc(0.25rem - 1px);
            border-top-right-radius: calc(0.25rem - 1px);
        }

        /* Card body */
        .card-body {
            flex: 1 1 auto;
            padding: 0.4rem;
        }

        /* Card footer */
        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: #f7f7f9;
            border-top: 1px solid rgba(0, 0, 0, 0.125);
            border-bottom-left-radius: calc(0.25rem - 1px);
            border-bottom-right-radius: calc(0.25rem - 1px);
        }

        /* Card titles */
        .card-title {
            /*margin-bottom: 0.5rem;*/
            font-size: 1.1rem;
        }

        /* Card subtitle */
        .card-subtitle {
            margin-top: -0.25rem;
            margin-bottom: 0;
            color: rgba(0, 0, 0, 0.6);
            font-size: 1rem;
        }

        /* Card text */
        .card-text {
            margin-top: 0.5rem;
            margin-bottom: 0;
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Card links */
        .card-link {
            color: #007bff;
            text-decoration: none;
        }

        .card-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .titgde {
            border-radius: 5px;
            border: 1px solid gray;
            padding: 20px 5px 5px 5px;
            font-size: medium;
            font-weight: bold;
            margin-top: -20px;
            text-align: center;
            margin-right: 20px;
            background-color: #ddd;
        }

        .etiqflot {
            margin-left: 10px;
            font-weight: 100;
            font-style: oblique;
            z-index: 2;
        }

        .txtc {
            text-align: center;
        }

    </style>
</head>

<body>

    <!-- Encabezado -->
    <div class="row">
        <div class="col col-4">
            <div class="etiqflot">
                Tipo de Servicio
            </div>

            <div class="titgde">
                @if ($servicio->tipo == 1)
                <span>Colegio</span>
                @elseif($servicio->tipo == 2)
                <span>Evento Pago</span>
                @elseif ($servicio->tipo == 3)
                <span>Evento Al Cobro</span>
                @endif
            </div>
        </div>

        <div class="col col-4">
            <div class="etiqflot">
                Linea
            </div>

            <div class="titgde" style="background-color: white">
                {{ $servicio->linea->nombre }}
            </div>

        </div>
        <div class="col col-4">
            <div class="etiqflot">
                Fecha
            </div>

            <div class="titgde">
                {{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_ini_serv)))}}
                {{ ($servicio->fecha_fin_serv == $servicio->fecha_ini_serv)? '' : ' al ' .
                utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_fin_serv)))}}
            </div>

        </div>
        <div class="clearfix"></div>
    </div>

    <!-- Vendedor - Fecha Venta - Fecha Original -->
    <div class="row">
        <table>
            <tr>
                <td style="width: 10px">Vendedor</td>
                <th style="text-align: left">{{ $servicio->vendedor->name }}</th>
                <td style="width: 10px; white-space:nowrap">Fecha Venta</td>
                <th style="text-align: left">{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_venta)))}}
                </th>
                @if ($servicio->fecha_orig_ini != $servicio->fecha_ini_serv)
                <td style="width: 10px; white-space:nowrap"><b>REPROGRAMADO-</b> Fecha Original:</td>
                <td>{{ utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_orig_ini)))}}
                    {{ ($servicio->fecha_orig_fin == $servicio->fecha_orig_ini)? '' : ' al ' .
                    utf8_encode(strftime('%d/%m/%Y', strtotime($servicio->fecha_orig_fin)))}}</td>
                @endif
            </tr>
        </table>
    </div>


    <!-- Lugar o Escuelas -->
    @if ($servicio->tipo != 1)
    <table>
        <tr>
            <td>Lugar</td>
            <td>$servicio->lugar</td>
        </tr>
    </table>
    @else
    <div class="card">
        <div class="card-header">
            <div class="card-title">Colegio</div>
        </div>
        <div class="card-body">
            <table>
                @foreach ($servicio->establecimientos as $establecimiento)
                <tr>
                    <th>Nombre</th>
                    <th>Provincia</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                </tr>

                <tr>
                    <td>
                        <b>{{ $establecimiento->nombre }}</b>
                    </td>
                    <td>{{ $establecimiento->prov }}</td>
                    <td>{{ $establecimiento->depto }}</td>
                    <td>{{ $establecimiento->ciudad }}</td>
                </tr>

            </table>
            <table>
                <tr>
                    <td><b>Direccion:</b></th>
                    <td>{{ $establecimiento->domicilio }}</td>
                    <td><b>Tel:</b></td>
                    <td>{{ $establecimiento->tel }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endif

    <!-- Contactos -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Contactos</div>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>{{ $servicio->cont_1 }}</td>
                    <td>{{ $servicio->cel_cont_1 }}</td>
                    <td>{{ $servicio->puesto_cont1 }}</td>
                </tr>
                <tr>
                    <td>{{ $servicio->cont_2 }}</td>
                    <td>{{ $servicio->cel_cont_2 }}</td>
                    <td>{{ $servicio->puesto_cont2 }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Matricula -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Matricula</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col col-9">
                    <table>
                        <tr>
                            <td>JARDIN</td>
                            <td>Total: {{ $servicio->matricula_total_j }}</td>
                            <td>TM: {{ $servicio->matricula_tmj }}</td>
                            <td>TT: {{ $servicio->matricula_ttj }}</td>
                            <td>TN: {{ $servicio->matricula_tnj }}</td>
                        </tr>
                        <tr>
                            <td>PRIMARIA</td>
                            <td>Total: {{ $servicio->matricula_total_p }}</td>
                            <td>TM: {{ $servicio->matricula_tmp }}</td>
                            <td>TT: {{ $servicio->matricula_ttp }}</td>
                            <td>TN: {{ $servicio->matricula_tnp }}</td>
                        </tr>
                        <tr>
                            <td>SECUNDARIA</td>
                            <td>Total: {{ $servicio->matricula_total_s }}</td>
                            <td>TM: {{ $servicio->matricula_tms }}</td>
                            <td>TT: {{ $servicio->matricula_tts }}</td>
                            <td>TN: {{ $servicio->matricula_tns }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col col-3">
                    <div class="row">
                        <input type="checkbox" {{ $servicio->servicio_tm? 'checked' : '' }}>
                        <label for="manana">Mañana</label>
                    </div>
                    <div class="row">


                        <input type="checkbox" {{ $servicio->servicio_tt? 'checked' : '' }}>
                        <label for="tarde">Tarde</label>
                    </div>
                    <div class="row">
                        <input type="checkbox" {{ $servicio->servicio_tn? 'checked' : '' }}>
                        <label for="noche">Noche</label>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- Espacio - Tamano - Planetario - Asesor - Precio -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col col-9">
                    <table>
                        <tr>
                            <th>Espacio Montaje</th>
                            <th>Tamaño (venta)</th>
                            <th>Planetario asignado</th>
                            <th>Asesor</th>
                        </tr>
                        <tr>
                            <td class="txtc">{{ $servicio->espacio->espacio }}</td>
                            <td class="txtc">{{ $servicio->tamano->tamano }}</td>
                            @if ($servicio->planetario_id)
                            <td class="txtc">{{ $servicio->planetario->id . '-' . $servicio->planetario->tamaño }}</td>
                            @else
                            <td></td>
                            @endif
                            @if ($servicio->asesor_id)
                            <td class="txtc">{{ $servicio->asesor->name }}</td>
                            @else
                            <td></td>
                            @endif
                        </tr>
                    </table>
                    <div style="min-height: 72px; padding:5px; border: 1px solid #ddd">
                        <b>Observaciones: </b>{{ $servicio->observaciones }}
                    </div>
                </div>

                <div class="col col-3">
                    @if ($servicio->tipo == 1)
                    <table>
                        <tr>
                            <th>Precio por alumno</th>
                        </tr>
                        <tr>
                            <td>$ {{ $servicio->precio_alumno }}</td>
                        </tr>
                    </table>
                    <br>
                    @endif
                    <table>
                        <tr>
                            <th>Precio total</th>
                        </tr>
                        <tr>
                            <td>$ {{ $servicio->precio_total }}</td>
                        </tr>
                    </table>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <!-- Horarios -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Horarios</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col col-4">
                    <h3>Turno Mañana - Total: {{ $servicio->horarios->where('turno','m')->sum('cantidad') }}</h3>
                    <table>
                        <tr>
                            <th style="width: 15%">Horario</th>
                            <th style="width: 15%">Cantidad</th>
                            <th style="width: 70%">Tema</th>
                            <th></th>
                        </tr>
                        @foreach ($servicio->horarios as $horario)
                        @if ($horario->turno == 'm')
                        <tr>
                            <td>{{ $horario->hora }}</td>
                            <td>{{ $horario->cantidad }}</td>
                            <td>{{ $horario->tema->titulo }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                <div class="col col-4">
                    <h4>Turno Tarde - Total: {{ $servicio->horarios->where('turno','t')->sum('cantidad') }}</h4>
                    <table>
                        <tr>
                            <th style="width: 15%">Horario</th>
                            <th style="width: 15%">Cantidad</th>
                            <th style="width: 70%">Tema</th>
                            <th></th>
                        </tr>
                        @foreach ($servicio->horarios as $horario)
                        @if ($horario->turno == 't')
                        <tr>
                            <td>{{ $horario->hora }}</td>
                            <td>{{ $horario->cantidad }}</td>
                            <td>{{ $horario->tema->titulo }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                <div class="col col-4">
                    <h4>Turno Noche - Total: {{ $servicio->horarios->where('turno','n')->sum('cantidad') }}</h4>
                    <table>
                        <tr>
                            <th style="width: 15%">Horario</th>
                            <th style="width: 15%">Cantidad</th>
                            <th style="width: 70%">Tema</th>
                            <th></th>
                        </tr>
                        @foreach ($servicio->horarios as $horario)
                        @if ($horario->turno == 'n')
                        <tr>
                            <td>{{ $horario->hora }}</td>
                            <td>{{ $horario->cantidad }}</td>
                            <td>{{ $horario->tema->titulo }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
    </div>



</body>