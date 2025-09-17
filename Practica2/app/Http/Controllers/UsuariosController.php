<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsuariosController extends Controller
{
    public function mostrarRegistro(){
        return view('registro');
    }

    public function hacerRegistro(Request $request){
       // dd($request);
        $request->validate([
        'name'=>['required','regex:/^[a-zA-Z\s]+$/u','max:50'],
        'email' => 'required|unique:users|min:3',
        'password'=> 'required|confirmed|min:3'
        ]);
    $rol= 'usuario';
    User::create([
        'name' => $request ->name,
        'rol'=> $rol,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),//encriptar la contraseña, necesita una libreria.


    ]);
    return back()->with('mensaje','Usuario registrado correctamente');
    }
}
