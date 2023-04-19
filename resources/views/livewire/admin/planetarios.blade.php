<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 200px">Id</th>
                        <th style="width: 200px">Tamaño</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planetarios as $planetario)
                    <tr>
                        <td>
                            {{ $planetario->id }}
                        </td>
                        <td>
                            {{ $planetario->tamaño }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>