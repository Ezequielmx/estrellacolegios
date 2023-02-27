<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 200px">Tamaño</th>
                        <th style="width: 200px">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planetarios as $planetario)
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{ $planetario->tamaño }}" disabled>
                        </td>
                        <td>
                            <input type="number" class="form-control" value="{{ $planetario->cantidad }}" min="0"
                                wire:change="changeCantidad({{ $planetario->id}}, $event.target.value)">
                        </td>
                        @error('cantidad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>