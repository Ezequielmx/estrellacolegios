@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <div id="map" style="height: calc(100vh - 60px);"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {lat: 37.7749, lng: -122.4194}
            });
            directionsDisplay.setMap(map);

            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var waypts = [];
            var ubicaciones = @json($ubicaciones);
            console.log(ubicaciones);

            for (var i = 0; i < ubicaciones.length; i++) {
                waypts.push({
                    location: ubicaciones[i],
                    stopover: true
                });
            }

            directionsService.route({
                origin: waypts[0].location,
                destination: waypts[waypts.length - 1].location,
                waypoints: waypts.slice(1, -1),
                optimizeWaypoints: false,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin.css">
@stop
