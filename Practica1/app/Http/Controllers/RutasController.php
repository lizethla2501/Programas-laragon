<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutasController extends Controller
{
    public function mostrarAyuda(){
        //dd('ayuda');
        return view('ayuda');
    }
    public function pag1(){
        return view('pagina1');
    }
    public function pag2(){
        return view('pagina2');
    }
    public function pag3(){
        return view('pagina3');
    }
    public function pag4(){
        return view('pagina4');
    }
    public function HacerSuma(Request $request){
        //dd($request)
        $request->validate([
            'numero1' => 'required|numeric|numeric',//
            'numero2' => 'required|numeric|numeric',

        ]);
        
        $numero1 = $request->input('numero1');
        $numero2 = $request->input('numero2');
       // dd($request->operaciones);
       if($request->operaciones == '+'){
        $suma = $numero1 + $numero2;
       }elseif($request->operaciones == '-'){
        $suma = $numero1 - $numero2;
       }elseif($request->operaciones == '*'){
        $suma = $numero1 * $numero2;
       }elseif($request->operaciones == '/'){
        $suma = $numero1 / $numero2;
       }else{
        return back()->with('resultado',  'Operacion no valida');
       }
       return back()->with('resultado',$suma);
    }
    public function guardarFormulario(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:3|max:50',
            'edad'   => 'required|integer|min:1|max:100',
            'sexo'   => 'required|in:M,F,O',
            'correo' => 'required|email|max:100',
        ]);

        return back()->with('success', 'Formulario enviado correctamente ✅');
    }
}


    
