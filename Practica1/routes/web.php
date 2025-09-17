<?php
use App\Http\Controllers\RutasController;
use Illuminate\Support\Facades\Route;

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

//Route::get('ayuda',[])//en los corchetes va un controlador que encontramos en el Http en Controllers, vamos a una terminal 

Route::get('ayuda',[RutasController:: class,('mostrarAyuda')])->name('liz-bonita');

Route::get('Pagina 1',[RutasController:: class,('pag1')])->name('pag-1');
Route::get('Pagina 2',[RutasController:: class,('pag2')])->name('pag-2');
Route::get('Pagina 3',[RutasController:: class,('pag3')])->name('pag-3');
Route::get('Pagina 4',[RutasController:: class,('pag4')])->name('pag-4');
Route::post('Pagina 4', [RutasController::class, 'guardarFormulario'])->name('pag-4');

Route::post('HACER SUMA',[RutasController:: class,('HacerSuma')])->name('suma');