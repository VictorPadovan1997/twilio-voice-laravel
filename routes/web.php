<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CallController;


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


Route::get('/',[CallController::class, 'index']);
Route::get('/calls',[CallController::class, 'index']);
Route::post('/calls/create',[CallController::class, 'create']);
Route::delete('/calls/{id}',[CallController::class, 'destroy']);

//Configuracao Twilio
Route::get('/index',[Controller::class, 'index']);
Route::get('/twilio',[Controller::class, 'index']);
Route::post('/voice',[Controller::class, 'voice']);
Route::post('/token',[Controller::class, 'token']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
