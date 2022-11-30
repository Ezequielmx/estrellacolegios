<?php

use App\Http\Controllers\Admin\EstablecimientoController;
use App\Http\Controllers\Admin\ServicioController;
use Illuminate\Support\Facades\Route;




Route::resource('establecimientos', EstablecimientoController::class)->names('admin.establecimientos');
Route::resource('servicios', ServicioController::class)->names('admin.servicios');


