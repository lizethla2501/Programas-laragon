<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('pagRegistro',[ImageController::class,'show'])->name('register');
Route::post('Registrar',[ImageController::class,'create'])->name('registrar');
Route::post('acceso',[ImageController::class,'acceso'])->name('acceso');


