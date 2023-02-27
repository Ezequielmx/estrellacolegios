<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >Nombre</th>
                        <th >Inicio</th>
                        <th >Fin</th>
                        <th >Color</th>
                        <th >Activa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineas as $linea)
                    <tr>
                        <td>
                            <input type="text" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}"  value="{{ $linea->nombre }}"
                            wire:change='changeNombre({{ $linea->id }}, $event.target.value)' >
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>

                        <td>
                            <input type="date" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}" value="{{ $linea->inicio }}"
                            wire:change='changeInicio({{ $linea->id }}, $event.target.value)'>
                        </td>
                        <td>
                            <input type="date" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}" value="{{ $linea->fin }}"
                            wire:change='changeFin({{ $linea->id }}, $event.target.value)'>
                        </td>
                        <td>
                            <input type="color" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}" value="{{ $linea->color }}"
                            style="padding:0px; border:0px;"
                            wire:change='changeColor({{ $linea->id }}, $event.target.value)'>
                        </td>
                        <td>
                            <input type="checkbox" class="form-control {{ $linea->activa? '' : 'inputdisabled' }}" {{ $linea->activa==1? 'checked' : '' }}
                            wire:change='changeActiva({{ $linea->id }}, $event.target.checked)'>
                        </td>
                        <td>
                            <button class="btn btn-danger" wire:click="$emit('deleteLin'), {{ $linea->id }}">Eliminar</button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>