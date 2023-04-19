<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Turno Mañana - Total: {{ $horarios->where('turno','m')->sum('cantidad') }}</h4>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%">Horario</th>
                                <th style="width: 15%">Cantidad</th>
                                <th style="width: 70%">Tema</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $horario)
                            @if ($horario->turno == 'm')
                            <tr>
                                <td>
                                    <input type="time" class="form-control" value="{{ $horario->hora }}"
                                        wire:change="changeHorario({{ $horario->id}}, $event.target.value)">
                                </td>
                                <td>
                                    <input type="number" class="form-control" value="{{ $horario->cantidad }}" min="0"
                                        wire:change="changeCant({{ $horario->id}}, $event.target.value)">
                                </td>
                                <td>
                                    <select class="form-control"
                                        wire:change="changeTema({{ $horario->id}}, $event.target.value)">
                                        @foreach ($temas as $tema)
                                        <option value="{{ $tema->id }}" {{ $tema->id == $horario->tema_id ? 'selected' :
                                            '' }}>
                                            {{ $tema->titulo }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-danger" wire:click="deleteHorario({{ $horario->id }})">X</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td style="width: 20%">
                                    <input type="time" class="form-control" wire:model="newhoraM">

                                    @error('newhoraM')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td style="width: 20%">
                                    <input type="number" class="form-control" wire:model="newcantM">

                                    @error('newcantM')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" wire:model="newtemaM">
                                        <option value="0">Seleccione un tema</option>
                                        @foreach ($temas as $tema)
                                        <option value="{{ $tema->id }}">
                                            {{ $tema->titulo }}</option>
                                        @endforeach
                                    </select>

                                    @error('newtemaM')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <button class="btn btn-primary" wire:click="addHorarioM">+</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4">
                    <h4>Turno Tarde - Total: {{ $horarios->where('turno','t')->sum('cantidad') }}</h4>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%">Horario</th>
                                <th style="width: 15%">Cantidad</th>
                                <th style="width: 70%">Tema</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $horario)
                            @if ($horario->turno == 't')
                            <tr>
                                <td>
                                    <input type="time" class="form-control" value="{{ $horario->hora }}"
                                        wire:change="changeHorario({{ $horario->id}}, $event.target.value)">
                                </td>
                                <td>
                                    <input type="number" class="form-control" value="{{ $horario->cantidad }}" min="0"
                                        wire:change="changeCant({{ $horario->id}}, $event.target.value)">
                                </td>
                                <td>
                                    <select class="form-control"
                                        wire:change="changeTema({{ $horario->id}}, $event.target.value)">
                                        @foreach ($temas as $tema)
                                        <option value="{{ $tema->id }}" {{ $tema->id == $horario->tema_id ? 'selected' :
                                            '' }}>
                                            {{ $tema->titulo }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-danger" wire:click="deleteHorario({{ $horario->id }})">X</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td style="width: 20%">
                                    <input type="time" class="form-control" wire:model="newhoraT">

                                    @error('newhoraT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td style="width: 20%">
                                    <input type="number" class="form-control" wire:model="newcantT">

                                    @error('newcantT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" wire:model="newtemaT">
                                        <option value="0">Seleccione un tema</option>
                                        @foreach ($temas as $tema)
                                        <option value="{{ $tema->id }}">
                                            {{ $tema->titulo }}</option>
                                        @endforeach
                                    </select>

                                    @error('newtemaT')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <button class="btn btn-primary" wire:click="addHorarioT">+</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4">
                    <h4>Turno Noche - Total: {{ $horarios->where('turno','n')->sum('cantidad') }}</h4>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%">Horario</th>
                                <th style="width: 15%">Cantidad</th>
                                <th style="width: 70%">Tema</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $horario)
                            @if ($horario->turno == 'n')
                            <tr>
                                <td>
                                    <input type="time" class="form-control" value="{{ $horario->hora }}"
                                        wire:change="changeHorario({{ $horario->id}}, $event.target.value)">
                                </td>
                                <td>
                                    <input type="number" class="form-control" value="{{ $horario->cantidad }}" min="0"
                                        wire:change="changeCant({{ $horario->id}}, $event.target.value)">
                                </td>
                                <td>
                                    <select class="form-control"
                                        wire:change="changeTema({{ $horario->id}}, $event.target.value)">
                                        @foreach ($temas as $tema)
                                        <option value="{{ $tema->id }}" {{ $tema->id == $horario->tema_id ? 'selected' :
                                            '' }}>
                                            {{ $tema->titulo }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-danger" wire:click="deleteHorario({{ $horario->id }})">X</button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td style="width: 20%">
                                    <input type="time" class="form-control" wire:model="newhoraN">

                                    @error('newhoraN')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td style="width: 20%">
                                    <input type="number" class="form-control" wire:model="newcantN">

                                    @error('newcantN')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" wire:model="newtemaN">
                                        <option value="0">Seleccione un tema</option>
                                        @foreach ($temas as $tema)
                                        <option value="{{ $tema->id }}">
                                            {{ $tema->titulo }}</option>
                                        @endforeach
                                    </select>

                                    @error('newtemaN')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <button class="btn btn-primary" wire:click="addHorarioN">+</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col text-right">
                    <button class="btn {{ $servicio->crono_env == 1 ? 'btn-warning' : 'btn-success' }} btn-sm" wire:click="enviarCron">
                        <i class="fab fa-whatsapp"></i>
                        {{ $servicio->crono_env == 1 ? 'Reenviar Cronograma' : 'Enviar Cronograma' }}
                    </button>

                    
                    <button class="btn {{ $servicio->tarj_env == 1 ? 'btn-warning' : 'btn-success' }} btn-sm" wire:click="enviarTarj">
                        <i class="fab fa-whatsapp"></i> 
                        {{ $servicio->tarj_env == 1 ? 'Reenviar Tarjetas' : 'Enviar Tarjetas' }} 
                    </button>
         

                    <button class="btn {{ $servicio->post_env == 1 ? 'btn-warning' : 'btn-success' }} btn-sm" wire:click="enviarPost">
                        <i class="fab fa-whatsapp"></i> 
                        {{ $servicio->post_env == 1 ? 'Reenviar Posters' : 'Enviar Posters' }} 
                    </button>
   

                    <button class="btn {{ $servicio->tem_env == 1 ? 'btn-warning' : 'btn-success' }}  btn-sm" wire:click="enviarTem">
                        <i class="fab fa-whatsapp"></i> 
                        {{ $servicio->tem_env == 1 ? 'Reenviar Temarios' : 'Enviar Temarios' }}
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>