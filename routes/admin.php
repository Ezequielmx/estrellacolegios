<?php

use App\Http\Controllers\Admin\ComisioneController;
use App\Http\Controllers\Admin\EstablecimientoController;
use App\Http\Controllers\Admin\LineaController;
use App\Http\Controllers\Admin\PlanetarioController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TemaController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\Admin\MapaController;

Route::resource('establecimientos', EstablecimientoController::class)->names('admin.establecimientos');
Route::resource('servicios', ServicioController::class)->names('admin.servicios');
Route::resource('planetarios', PlanetarioController::class)->names('admin.planetarios');
Route::resource('usuarios', UsuarioController::class)->names('admin.usuarios')->middleware('can:editar usuarios');
Route::resource('lineas', LineaController::class)->names('admin.lineas')->middleware('can:editar lineas');
Route::resource('temas', TemaController::class)->names('admin.temas')->middleware('can:editar temas');
Route::resource('comisiones', ComisioneController::class)->names('admin.comisiones')->middleware('can:editar comisiones');
Route::resource('ventas', VentaController::class)->names('admin.ventas')->middleware('can:ver ventas');
Route::resource('mapa', MapaController::class)->names('admin.mapa');