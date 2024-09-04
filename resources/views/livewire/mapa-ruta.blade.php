<div>
    <form wire:submit.prevent="actualizarRuta">
        <div class="form-row align-items-end py-3">
            <!-- Selector de línea -->
            <div class="col">
                <label for="linea" class="form-label">Selecciona una línea:</label>
                <select id="linea" class="form-control @error('lineaSeleccionada') is-invalid @enderror" wire:model.defer="lineaSeleccionada">
                    <option value="">Seleccione una línea</option>
                    @foreach ($lineas as $linea)
                    <option value="{{ $linea->id }}"> {{ $linea->nombre }}</option>
                    @endforeach
                </select>
                @error('lineaSeleccionada')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Fechas de inicio y fin -->
            <div class="col">
                <label for="fechaInicio" class="form-label">Fecha de inicio:</label>
                <input type="date" id="fechaInicio" class="form-control @error('fechaInicio') is-invalid @enderror" wire:model.defer="fechaInicio">
                @error('fechaInicio')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="fechaFin" class="form-label">Fecha de fin:</label>
                <input type="date" id="fechaFin" class="form-control @error('fechaFin') is-invalid @enderror" wire:model.defer="fechaFin">
                @error('fechaFin')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <!-- Botón de enviar -->
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>

    <div id="map" style="height: calc(100vh - 150px);"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            let map;
            map = L.map('map').setView([-32 , -68], 9);
            L.tileLayer(`https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token={{ env('MAPBOX_ACCESS_TOKEN') }}`, {
                    attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a>',
                    maxZoom: 18,
                    tileSize: 512,
                    zoomOffset: -1,
                }).addTo(map);

            const fechaInicio = document.getElementById('fechaInicio');
            const fechaFin = document.getElementById('fechaFin');

            function validarFechas() {
                const inicio = new Date(fechaInicio.value);
                const fin = new Date(fechaFin.value);

                if (inicio && fin && (fin - inicio > 20 * 24 * 60 * 60 * 1000)) { // 20 días en milisegundos
                    alert('El rango de fechas no puede ser mayor a 20 días.');
                    fechaFin.value = '';
                    return false;
                }
                return true;
            }

            fechaInicio.addEventListener('change', validarFechas);
            fechaFin.addEventListener('change', validarFechas);

            @this.on('rutaActualizada', data => {
                map.remove();
                map = L.map('map').setView([-32 , -68], 9);

                L.tileLayer(`https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token={{ env('MAPBOX_ACCESS_TOKEN') }}`, {
                    attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a>',
                    maxZoom: 18,
                    tileSize: 512,
                    zoomOffset: -1,
                }).addTo(map);

                if (data.ruta) {
                    if (map) {
                        // Mapear las coordenadas de la ruta
                        const routeCoordinates = data.ruta.map(coords => [coords[1], coords[0]]);

                        // Verifica que routeCoordinates no esté vacío
                        if (routeCoordinates.length > 0) {
                            // Dibujar la ruta en el mapa
                            const routeLayer = L.polyline(routeCoordinates, { color: 'blue' }).addTo(map);

                            // Ajustar el mapa a los límites de la ruta
                            map.fitBounds(routeCoordinates);

                            // Agregar marcadores numerados en cada ciudad
                            data.ciudades.forEach((ciudadData, index) => {
                                const cityCoords = [ciudadData.coordenadas[1] + Math.random() * 0.1, ciudadData.coordenadas[0] + Math.random() * 0.1]; // Leaflet usa lat, lon

                                const markerIcon = L.divIcon({
                                    className: 'numbered-marker',
                                    html: `<div class="marker-number">${index + 1}</div>`,
                                    iconSize: [25, 41],
                                    iconAnchor: [12, 41]
                                });

                                //const distanciaTramo = data.distanciaPorTramo[index] ? data.distanciaPorTramo[index] : 'No disponible';
                                const distanciaTramo = data.distanciasPorTramo[index];
                                const ciudadProx = data.ciudades[index+1] ? data.ciudades[index+1].ciudad : '';

                                // Añadir marcador numerado
                                L.marker(cityCoords, { icon: markerIcon }).addTo(map)
                                    .bindPopup(`Tipo: ${ciudadData.tipo} <br> Ciudad: ${ciudadData.ciudad} <br> Fecha: ${ciudadData.date} <br> Distancia: ${distanciaTramo} km => ${ciudadProx}`)
                                    .openPopup();
                            });
                        }
                    } else {
                        console.error('El mapa no está inicializado');
                    }
                }
            });
        });
    </script>

    <style>
        /* Estilo para los marcadores numerados */
        .numbered-marker .marker-number {
            background-color: red;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            padding: 5px;
            text-align: center;
            line-height: 1.2;
        }
    </style>
</div>