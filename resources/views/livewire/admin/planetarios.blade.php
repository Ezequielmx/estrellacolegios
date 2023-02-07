<div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 100px">Numero</th>
                    <th style="width: 200px">Tamaño</th>
                    <th>Observaciones</th>
                    <th style="width: 50px">Activo</th>
                    <th style="width: 100px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planetarios as $planetario)
                <tr>
                    <td>
                        <input type="text" class="form-control" value="{{ $planetario->numero }}"
                            wire:change="changeNumero({{ $planetario->id}}, $event.target.value)">
                    </td>
                    <td>
                        <select class="form-control" name="tamaño"
                            wire:change="changeTamaño({{ $planetario->id}}, $event.target.value)">
                            <option value="CHICO" {{ ($planetario->tamaño === 'CHICO')? 'selected' : '' }} >CHICO
                            </option>
                            <option value="MEDIANO" {{ ($planetario->tamaño === 'MEDIANO')? 'selected' : '' }} >MEDIANO
                            </option>
                            <option value="GRANDE" {{ ($planetario->tamaño === 'GRANDE')? 'selected' : '' }} >GRANDE
                            </option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" value="{{ $planetario->observaciones }}"
                            wire:change="changeObservaciones({{ $planetario->id}}, $event.target.value)">
                    </td>
                    <td>
                        <input type="checkbox" {{ ($planetario->activo === 1)? 'checked' : '' }}
                        wire:change="changeActivo({{ $planetario->id }}, $event.target.checked)">
                    </td>
                    <td>
                        <a wire:click="$emit('deletePlanet', {{ $planetario->id }})"
                            class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>
                        <input type="text" class="form-control" wire:model="numero">
                        @error('numero')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select class="form-control" name="tamaño" wire:model="tamaño">
                            <option value="">Seleccione</option>
                            <option value="CHICO">CHICO</option>
                            <option value="MEDIANO">MEDIANO</option>
                            <option value="GRANDE">GRANDE</option>
                        </select>
                        @error('tamaño')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="observaciones">
                    </td>
                    <td>
                        <input type="checkbox" wire:model="activo">
                    </td>
                    <td>
                        <a wire:click="store()" class="btn btn-primary btn-sm">Agregar</a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>