<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Servicio;

class obtenerRuta
{
    protected $servicios;
    protected $accessToken;

    public function __construct($servicios)
    {
        $this->servicios = $servicios;
        $this->accessToken = env('MAPBOX_ACCESS_TOKEN');
    }

    public function obtenerDatosRuta()
    {
        $coordenadas = [];
        foreach ($this->servicios as $servicio) {
            if ($servicio->tipo == 1) {
                $ciudad = $servicio->establecimientos->first()->ciudad . ', ' . $servicio->establecimientos->first()->prov;
            } else {
                $ciudad = $servicio->lugar;
            }
            $coords = $this->obtenerCoordenadas($ciudad);
            if ($coords !== null) {
                $coordenadas[] = [
                    'ciudad' => $ciudad,
                    'date' => date('d-m-y', strtotime($servicio->fecha_ini_serv)),
                    'coordenadas' => $coords,
                    'tipo'  => $servicio->tipoServicio->tipo
                ];
            }
        }

        if (count($coordenadas) > 1) {
            $waypoints = implode(";", array_map(function ($ciudad) {
                return implode(",", $ciudad['coordenadas']);
            }, $coordenadas));

            $url = "https://api.mapbox.com/directions/v5/mapbox/driving/{$waypoints}?geometries=geojson&access_token={$this->accessToken}";
            $response = Http::get($url);
            $data = $response->json();

            if (!empty($data['routes'][0])) {
                $ruta = $data['routes'][0]['geometry']['coordinates'];
                $distanciaTotalKm = round($data['routes'][0]['distance'] / 1000, 2); // Convertir metros a kilómetros

                // Extraer las distancias entre tramos (legs)
                $distanciasPorTramo = [];
                foreach ($data['routes'][0]['legs'] as $index => $leg) {
                    $distanciaKm = round($leg['distance'] / 1000, 2); // Convertir metros a kilómetros and round to 2 decimal places
                    $distanciasPorTramo[] = $distanciaKm;
                }

                return [
                    'ruta' => $ruta,
                    'distanciaTotalKm' => $distanciaTotalKm,
                    'distanciasPorTramo' => $distanciasPorTramo,
                    'ciudades' => $coordenadas
                ];
            }
        }

        return ['error' => 'No se pudo obtener la ruta.'];
    }

    // Función para obtener coordenadas de una ciudad
    private function obtenerCoordenadas($ciudad)
    {
        $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/" . urlencode($ciudad) . ".json?types=place,locality&access_token={$this->accessToken}";
        $response = Http::get($url);
        $data = $response->json();

        if (!empty($data['features'][0]['geometry']['coordinates'])) {
            return $data['features'][0]['geometry']['coordinates'];
        }

        return null;
    }
}
