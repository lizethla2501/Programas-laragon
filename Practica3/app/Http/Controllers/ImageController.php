<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ImageController extends Controller
{
    public function show(){
        return view('registro');
    }
    public function create(Request $request){
       // dd('hola');
        $request->validate([
        'name' => 'required|max:25',
        'email' => 'required|unique:users|email',
        'password' => 'required|confirmed|min:3',
        'img' => 'image',
    ]);

    $user = User::create([
        'name'=> $request->name,
        'rol'=> 'usuario',
        'email' =>$request->email,
        'password' => Hash::make( $request->password),

    ]);
   
    $rutaCarpeta = public_path("imagenes/imgusuario");
    if($request -> hasFile('img')){
        if(!file_exists($rutaCarpeta)){
            mkdir($rutaCarpeta,0777,true);//0777 son los permisos, en caso de que la carpeta no exista.
        }
        $foto =$request-> file('img');
        $nombreImg= time()."_".$foto->getClientOriginalName();//va agregar la imagen con la hora en la que lo guardamos , asi no perimtira duplicados.
        $foto ->move($rutaCarpeta, $nombreImg);
        $rutaLogica = "imagenes/imgusuario/";

        $userfoto= Image::create([
        'ruta' => $rutaLogica . $nombreImg,
        'user_id'=> $user->id,
        ]);
    }
    
    return redirect()->route('index')->with('creado','creado');//redireccionar la pagina de registro.

    }
    public function acceso(Request $request){
        $request -> validate([
        'email' => 'required|email',
        'password' =>'required|min:3',
        ]);
        if(auth()->attempt($request->only('email','password'))){
            //$persona = User::all();//todos los campos de la tabla.
            $persona =auth()->user();//obtener el usuario que esta autentificado con el que estoy logeando.
            //dd($persona);
            $imagen = Image::where('user_id', $persona->id)->get()->first();


            return view('inicio', compact('persona','imagen'));
        }
        return back()->with('error','error');
    }
}
