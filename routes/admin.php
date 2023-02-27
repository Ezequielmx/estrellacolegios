<?php

use App\Http\Controllers\Admin\AsesoreController;
use App\Http\Controllers\Admin\EstablecimientoController;
use App\Http\Controllers\Admin\LineaController;
use App\Http\Controllers\Admin\PlanetarioController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\UsuarioController;
use Illuminate\Support\Facades\Route;




Route::resource('establecimientos', EstablecimientoController::class)->names('admin.establecimientos');
Route::resource('servicios', ServicioController::class)->names('admin.servicios');
Route::resource('planetarios', PlanetarioController::class)->names('admin.planetarios');
Route::resource('usuarios', UsuarioController::class)->names('admin.usuarios');
Route::resource('lineas', LineaController::class)->names('admin.lineas');


