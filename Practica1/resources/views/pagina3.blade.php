@extends('app.layout')
@section('titulo')
    pagina3
@endsection


@section('contenido')
   <h1> 
    Calculadora 
   </h1>

    <div class="container">
    <form method="POST" action="{{ route('suma') }}">
    
    @csrf
    @if(session('resultado'))

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          title: 'Resultado',
          text: 'El resultado es: {{ session('resultado') }}',
          icon: 'success',
          confirmButtonText: 'OK'
        });
      });
    </script>
    @endif

    
    <div class="container">
   
  <div class="card">
  <div class="card-body">
    <h5 class="card-title">Elige la operacion aritmetica que deseas realizar</h5>
     <div class="dropdown" data-bs-theme="dark">
     <select name="operaciones" class="form-select" aria-label="Default select example">

    <option value="+">Suma</option>
    <option value="-" selected>Resta</option>
    <option value="*">Multiplicacion</option>
    <option value="/">Division</option>
    </select>

    </div>
    <p class="card-text">Ingresa los numeros</p>
  </div>
  <div class="card-body">
    <input  
    name ='numero1' 
    type="text" 
    class="form-control @error('numero1') @enderror" 
    placeholder="0" 
    aria-label="Username" 
    aria-describedby="basic-addon1">
    @error('numero1')
    <p class="bg-red-500 text-white my-2 text-center p-2">
      {{$mensaje}}
    </p>
    @enderror
    
  </div>
  <div class="card-body">
    <input name ='numero2' 
    type="text" 
    class="form-control @error('numero2') @enderror" 
    placeholder="0" 
    aria-label="Username" 
    aria-describedby="basic-addon1">
    @error('numero2')
    <p class="bg-red-500 text-white my-2 text-center p-2">
      {{$mensaje}}
    </p>
    @enderror
    
  </div>
 
      

 <div class="btn-group" role="group" aria-label="Basic example">
  <button type="submit" class="btn btn-outline-primary">Calcular</button>
</div>
</form>

</div>

@endsection