<div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <b><label for="cue">CUE</label></b>
                <select class="form-control" name="cue" wire:change="updCue($event.target.value)">
                    <option value="all" {{ ('all'==$cueSel)? 'selected' : '' }}>TODO</option>
                    @foreach ($filtCue as $cue)
                    <option value={{ $cue }} {{ ($cue==$cueSel)? 'selected' : '' }}>{{
                        $cue }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <b><label for="nombre">Nombre</label></b>
                <div class="input-group">
                    <input class="form-control" type="text" name="nombre" wire:model.defer="nomBusq">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" wire:click="busqNombre()">
                            Buscar
                        </button>
                        <button class="btn btn-danger" wire:click="limpNombre()">
                            X
                        </button>
                    </span>
                </div>
            </div>

            <div class="col">
                <b><label for="provincia">Provincia</label></b>
                <select class="form-control" name="provincia" wire:change="updProv($event.target.value)">
                    <option value="all" {{ ('all'==$provSel)? 'selected' : '' }}>TODO</option>
                    @foreach ($filtProv->sort() as $prov)
                    <option value={{ str_replace(" ","_",$prov) }} {{ ($prov==$provSel)? 'selected' : '' }}>{{
                        $prov }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <b><label for="departamento">Departamento</label></b>
                <select class="form-control" name="departamento" wire:change="updDepto($event.target.value)">
                    <option value="all" {{ ('all'==$deptoSel)? 'selected' : '' }}>TODO</option>
                    @foreach ($filtDepto->sort() as $depto)
                    <option value={{ str_replace(" ","_",$depto) }} {{ ($depto==$deptoSel)? 'selected' : '' }}>{{
                        $depto }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <b><label for="ciudad">Ciudad</label></b>
                <select class="form-control" name="ciudad" wire:change="updCiudad($event.target.value)">
                    <option value="all" {{ ('all'==$ciudadSel)? 'selected' : '' }}>TODO</option>
                    @foreach ($filtCiudad->sort() as $ciudad)
                    <option value={{ str_replace(" ","_",$ciudad) }} {{ ($ciudad==$ciudadSel)? 'selected' : '' }}>{{
                        $ciudad }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="card-body">
        <table id="establec" class="table table-striped">
            <thead>
                <tr>
                    <th>CUE</th>
                    <th>Nombre</th>
                    <th>Domicilio</th>
                    <th>Provincia</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Sector</th>
                    <th>Ámbito</th>
                    <th>Tipo</th>
                    <th>Niveles</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estabFilt as $establ)
                <tr>
                    <td>{{ $establ->cue }}</td>
                    <td>{{ $establ->nombre }}</td>
                    <td>{{ $establ->domicilio }}</td>
                    <td>{{ $establ->prov }}</td>
                    <td>{{ $establ->depto }}</td>
                    <td>{{ $establ->ciudad }}</td>
                    <td>{{ $establ->sector }}</td>
                    <td>{{ $establ->ambito }}</td>
                    <td>{{ $establ->tipo }}</td>
                    <td>{{ $establ->niveles }}</td>
                    <td width="10px">
                        <a class="btn btn-primary btn-sm"
                            href="{{ route('admin.establecimientos.edit', $establ->cue) }}">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div wire:loading>
        <div class="modload">
            <div class="spinload">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>
</div>