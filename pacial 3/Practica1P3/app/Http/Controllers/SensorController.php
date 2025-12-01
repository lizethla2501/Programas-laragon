<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sensor;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller
{
   public function index()
    {
        //return response()->json(Sensor::orderBy('id', 'desc')->take(20)->get());
        //return Sensor::all();
       $datos = Sensor::orderBy('created_at','desc')-> take(20)->pluck('sensor1');
    return view('welcome',compact('datos'));

    }
    public function vistaSensores(){
        $datos = Sensor::orderBy('created_at','desc')
        ->take(20)
        ->pluck('sensor1')
        ->map(fn($v) =>floatval($v))
        ->values();
    return response()->json($datos);
    }


    public function store(Request $request)
{

    $request->validate([
        'valor' => 'required|numeric',
    ]);


    $sensor = new Sensor();
    $sensor->sensor1 = $request->valor;

    $sensor->save();


    $maxRegistros = 20;

    $total = Sensor::count();
    if ($total > $maxRegistros) {
        $excedente = $total - $maxRegistros;
        Sensor::orderBy('created_at', 'asc')->limit($excedente)->delete();
    }

    return response()->json(['mensaje' => 'Datos guardados y limpieza realizada']);
}
}

