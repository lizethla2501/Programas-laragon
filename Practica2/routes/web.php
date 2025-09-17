<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

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
});

Route::get('Pagina 1',[UsuariosController:: class,('mostrarRegistro')])->name('registrar');
Route::post('Pagina 1',[UsuariosController:: class,('hacerRegistro')])->name('hacer-registro');