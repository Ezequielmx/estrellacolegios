<div>
    @php
        setlocale(LC_TIME, "spanish");
    @endphp
    <div class="card-body" style="background-color: {{ $codColorSel }}"  >
        <form>
            <div class="row">
                <div class="col">
                    <b><label for="evento">Seleccione el Evento</label></b>
                    <select class="form-control" name="evento" wire:model="eventoSel">
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->id }}">{{ $evento->lugar }} </option>                                   
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <b><label for="funcion">Seleccione la funcion</label></b>
                    <select class="form-control" name="funcion" wire:model="funcionSel">
                        @foreach ($funciones as $funcion)
                            <option value="{{ $funcion->func_id }}">{{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}</option>    
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <b><label for="funcion">Color de entrada</label></b>
                    <select class="form-control" name="funcion" wire:change="changeColor($event.target.value)">
                        @foreach ($colores as $color)
                            <option value="{{ $color->id }}" {{ ($colorSel === $color->id)?'selected' : '' }}>{{ $color->color }}</option>    
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <span class="badge badge-secondary" style="width:100%"><h5>Reservas: <b> {{ $totRes }} </b> / Asistencia: <b> {{ $totAsist }} </h5></span>
                    <div class="progress" style="height:30px; margin-top:5px">
                        @if ($totRes > 0)
                        <div class="progress-bar bg-success" style="width:{{ sprintf("%.0f%%", $totAsist/$totRes * 100) }} ;height:30px">{{ sprintf("%.0f%%", $totAsist/$totRes * 100) }}</div>  
                        @endif
                    </div>
                </div>   

                <div class="col">
                    <span style="text-align: center"><h4>Total Función: <b> {{ '$ ' . number_format($totIng) }} </b></h4></span>
                    <span style="text-align: center"><h5>Total Evento: {{ '$ ' . number_format($totEvento) }} </h5></span>
                </div>   

            </div>
        </form>


    </div> 

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Usuario</th>
                        <th>Telefono</th>
                        <th>Cant_Adul</th>
                        <th>Cant_Esp</th>
                        <th>Importe</th>
                        <th>Seg Func</th>
                        <th>Asist</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                @foreach ($reservt as $reserva)
                    @php
                        if ($reserva->cancel == 1){
                            $classrow = 'table-danger';
                        }   
                        elseif ($reserva->asist == 1){
                            $classrow = 'table-success';
                        }    
                        else {
                            $classrow = '';
                        }
                    @endphp
                    <tr class={{ $classrow }}>
                        <td>{{ $reserva->codigo_res }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $codColorSel }}; font-size: 100%; border: 1px solid gray">
                                {{ $reserva->usuario }}
                            </span>  
                                                   
                        
                        </td>
                        <td>{{ $reserva->telefono }}</td>
                        <td>
                            @if ($reserva->asist == 1)
                                {{ $reserva->cant_adul }}
                            @else
                                <select class="form-control rowh" name="cant_adul" wire:change="changeCantAdul({{ $reserva->id }}, $event.target.value)">
                                    @for ($i=1; $i <= 10; $i++ )
                                        <option value="{{ $i }}" {{ ($i === $reserva->cant_adul)? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            @endif
                        </td>
                        <td>
                            @if ($reserva->asist == 1)
                                {{ $reserva->cant_esp }}
                            @else
                                <select class="form-control rowh" name="cant_esp" wire:change="changeCantEsp({{ $reserva->id }}, $event.target.value)">
                                    @for ($i=0; $i <= 10; $i++ )
                                        <option value="{{ $i }}" {{ ($i === $reserva->cant_esp)? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            @endif
                        </td>
                        <td>${{ $reserva->importe }}</td>

                        <td>
                            @php
                                $otraFunc = -1;
                                if($reserva->f1 != $funcionSel)
                                {
                                    $otraFunc = $reserva->f1;
                                }
                                if($reserva->f2 != $funcionSel)
                                {
                                    $otraFunc = $reserva->f2;
                                }
                            @endphp
                            @if ($reserva->asist == 1)
                                @foreach ($funciones as $funcion)
                                    @if ($funcion->func_id == $otraFunc)
                                        <span class="badge" style="background-color: {{ $funcion->codigo_color }}; font-size: 100%; border: 1px solid white">
                                            {{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}
                                        </span>  
                                    @endif  
                                @endforeach
                            @else
                                <select class="form-control rowh" name="funcion2" wire:change="changeFunc2({{ $reserva->id }}, $event.target.value)">
                                    <option value="-1">---------</option>
                                    @foreach ($funciones as $funcion)
                                        @if ($funcion->func_id != $funcionSel && $funcion->id != $temaFunSel)
                                            <option value="{{ $funcion->func_id }}" {{ ($funcion->func_id == $otraFunc)? 'selected' : '' }}>
                                                {{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}
                                            </option>  
                                        @endif  
                                    @endforeach
                                </select>
                            @endif
                        </td>
                        <td>
                            @if ($reserva->asist == 0)
                                <input type="checkbox" wire:change="changeAsist({{ $reserva->id }}, $event.target.checked)">
                            @endif            
                        </td>
                        <td>
                            @if ($reserva->asist == 1)
                                <input type="checkbox" {{ ($reserva->cancel === 1)? 'checked' : '' }} wire:change="changeCancel({{ $reserva->id }}, $event.target.checked)">
                            @endif   
                        </td>

                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td>
                        <input type="text" class="form-control" wire:model="newUsuario">
                        @error('newUsuario')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="newTelefono">
                    </td>
                    <td>
                        <select class="form-control" name="cant_adul" wire:change="changeNewCantAdul($event.target.value)">
                            @for ($i=0; $i <= 10; $i++ )
                                <option value="{{ $i }}" {{ ($i == $newCantAdul)? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="cant_esp" wire:change="changeNewCantEsp($event.target.value)">
                            @for ($i=0; $i <= 10; $i++ )
                                <option value="{{ $i }}" {{ ($i == $newCantEsp)? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </td>
                    <td >
                        $ {{ number_format($newImporte) }}
                    </td>
                    <td>
                        <select class="form-control" name="newfuncion2" wire:change="changeNewFun2($event.target.value)">
                            <option value="-1" selected>---------</option>
                            @foreach ($funciones as $funcion)
                                @php
                                    $fechaf2 = new DateTime($funcion->fecha . " " . $funcion->horario);
                                @endphp
                                @if ($funcion->func_id != $funcionSel && $funcion->id != $temaFunSel && $fechaf2 > $fechaf1)
                                    <option value="{{ $funcion->func_id }}">
                                        {{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}
                                    </option>  
                                @endif  
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="save">
                            +
                        </button>
                    </td>
                    
                </tr>
            </table>
        </div>
    </div>
</div>


