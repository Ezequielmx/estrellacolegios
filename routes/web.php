<?php

use App\Http\Controllers\Admin\Ocupacion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\RendicionController;
use App\Http\Controllers\Admin\ServicioprintController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WebhookgptController;
use App\Http\Livewire\Admin\Servicios\EditServicio;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->get('/admin', [IndexController::class, 'index'])->name('admin');
Route::post('/webhook', [WebHookController::class, 'handle']);
Route::post('/webhookgpt', [WebhookgptController::class, 'handle']);
Route::get('/admin/rendicionprint/{serv_id}', [RendicionController::class, 'print'])->name('rendicionprint');
Route::get('/admin/servicioprint/{serv_id}', [ServicioprintController::class, 'print'])->name('servicioprint');
Route::get('/admin/servicioprintv/{serv_id}', [ServicioprintController::class, 'show'])->name('servicioprintv');





