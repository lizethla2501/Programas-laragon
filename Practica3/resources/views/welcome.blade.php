

@extends('app.base')
@section('title')
    Inicio
@endsection

@section('content')
<div class="flex h-screen bg-indigo-700">
  <div class="w-full max-w-xs m-auto bg-indigo-100 rounded p-5">
    <header>
      <img class="w-20 mx-auto mb-5" src="https://img.icons8.com/fluent/344/year-of-tiger.png" />
    </header>
    <form action="{{route('acceso')}}" method="POST">
      @csrf
      @if(@session('creado'))
                  <script>
                    document.addEventListener('DOMContentLoaded', function () {
                      Swal.fire({
                        title: "Guardado con exito!",
                        text: "Resultado: {{ session('creado') }}",
                        icon: "success"
                        });
                      });
                   </script>
                @endif
      <div>
        <label class="block mb-2 text-indigo-500" for="username">Email</label>
        <input name="email" type="email" id="email" class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="text" name="username" placeholder="Ingresa tu nombre de usuario">
      </div>
      <div>
        <label class="block mb-2 text-indigo-500" for="password">Password</label>
        <input name= "password" type="password" id="password" class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="password" name="password" placeholder="Escribe tu password">
      </div>
      <div>
        <input class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit">
      </div>
    
    <footer>
      <a class="text-indigo-700 hover:text-pink-700 text-sm float-left" href="#">Olvidaste tu Password?</a>
      <a class="text-indigo-700 hover:text-pink-700 text-sm float-right" href="{{route('register')}}">Crear cuenta</a>
    </footer>
    </form>
  </div>
</div>

@endsection