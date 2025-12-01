<?php
use App\Http\Controllers\SensorController;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/sensores', function () {
    $datos = Sensor::orderBy('created_at','desc')-> take(20)->pluck('sensor1');
    return response()->json($datos);//devolver los datos en json.

});
Route::get('/sensores',[SensorController::class,'index']);
Route::get('/sensores',[SensorController::class,'vistaSensores']);
Route::post('/sensores',[SensorController::class,'store']);
