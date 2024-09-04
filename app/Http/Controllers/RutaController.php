<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RutaController extends Controller
{
    // Función para obtener la ruta entre ciudades
    public function obtenerRuta(Request $request)
    {
        $accessToken = env('MAPBOX_ACCESS_TOKEN');
        $ciudades = $request->input('ciudades'); // Recibimos las ciudades desde el componente Livewire

        $coordenadas = [];
        foreach ($ciudades as $ciudad) {
            $coords = $this->obtenerCoordenadas($ciudad, $accessToken);
            if ($coords !== null) {
                $coordenadas[] = $coords;
            }
        }

        if (count($coordenadas) > 1) {
            $waypoints = implode(";", array_map(function ($coords) {
                return implode(",", $coords);
            }, $coordenadas));

            $url = "https://api.mapbox.com/directions/v5/mapbox/driving/{$waypoints}?geometries=geojson&access_token={$accessToken}";
            $response = Http::get($url);
            $data = $response->json();

            if (!empty($data['routes'][0])) {
                $ruta = $data['routes'][0]['geometry']['coordinates'];
                $distanciaKm = $data['routes'][0]['distance'] / 1000; // Convertir metros a kilómetros

                return response()->json([
                    'ruta' => $ruta,
                    'distanciaKm' => $distanciaKm,
                    'ciudades' => $coordenadas
                ]);
            }
        }

        return response()->json(['error' => 'No se pudo obtener la ruta.']);
    }

    // Función para obtener coordenadas de una ciudad
    private function obtenerCoordenadas($ciudad, $accessToken)
    {
        $url = "https://api.mapbox.com/geocoding/v5/mapbox.places/" . urlencode($ciudad) . ".json?access_token={$accessToken}";
        $response = Http::get($url);
        $data = $response->json();

        if (!empty($data['features'][0]['geometry']['coordinates'])) {
            return $data['features'][0]['geometry']['coordinates'];
        }

        return null;
    }
}
