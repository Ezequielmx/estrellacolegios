<div>
    <div class="row" style="padding:20px; align-items: center;">
        <div class="col text-right"  style="max-width:40px">
            <label for="mes">Mes:</label>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="mesSel">
                <option value="01">ENERO</option>
                <option value="02">FEBRERO</option>
                <option value="03">MARZO</option>
                <option value="04">ABRIL</option>
                <option value="05">MAYO</option>
                <option value="06">JUNIO</option>
                <option value="07">JULIO</option>
                <option value="08">AGOSTO</option>
                <option value="09">SEPTIEMBRE</option>
                <option value="10">OCTUBRE</option>
                <option value="11">NOVIEMBRE</option>
                <option value="12">DICIEMBRE</option>
            </select>
        </div>
    </div>
    <table class="table table-striped">
        <thead style="position: sticky;
        top: 0px;
        background-color: gray;
        color: white;">
            <tr>
                <th>Día</th>
                @foreach ($lineas as $linea)
                    <th style="background-color: {{ $linea->color }}!important;
                        text-align:center">
                        {{ $linea->nombre }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @for ($dia = 1; $dia <= 31; $dia++)
                @php
                    if(date('w', strtotime(date('Y').'-' . $mesSel . '-' . $dia)) == 0 || date('w', strtotime(date('Y').'-' . $mesSel . '-' . $dia)) == 6)
                    {
                        $style="background-color: #f7a9a9 !important;";
                    }
                    else
                    {
                        $style="";
                    }
                @endphp
                <tr style="{{ $style }}">
                    <td style="font-weight:bolder; vertical-align:middle">
                        {{ $dia }}
                    </td>
                    @foreach ($lineas as $linea)
                        <td style="vertical-align:middle; 
                                    border-right: 1px solid gray; 
                                    border-left: 1px solid gray;">
                            @if (isset($meses[$dia][$linea->id]))
                                @foreach ($meses[$dia][$linea->id] as $servicio)
                                    @if ($servicio->tipo == 1)
                                        @php
                                            $title =  $servicio->establecimientos->first()->ciudad . ' - ' . $servicio->establecimientos->first()->prov . ' - ' . $servicio->establecimientos->first()->nombre;
                                        @endphp
                                    @else
                                        @php
                                            $title = $servicio->lugar;
                                        @endphp
                                    @endif
                                    <a href="{{ route('admin.servicios.edit', $servicio->id) }}">
                                        <div class="{{  'calEst' . $servicio->estado_id}}"
                                            style="
                                                border: 1px solid;
                                                border-right: 20px solid;
                                                border-radius: 5px;
                                                padding: 5px;
                                                background-color: {{ $linea->color }};
                                                color:white">
                                            {{ $title }}
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>

    <div wire:loading>
        <div class="modload">
            <div class="spinload">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>
    
</div>
