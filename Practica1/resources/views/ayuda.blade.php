

@extends('app.layout')
@section('titulo')
    Ayuda
@endsection

@section('contenido')
    <h1> 
    Ayuda 
   </h1>
   <div class="container">
  <div class="card" style="width: 18rem;">
  <img src="{{ asset('img/liz.jpg') }}" class="card-img-top" alt="...">
  <div class="card-body">
    <p class="card-text"> 
          <style>
      .bg-morado {
        background-color: #ac3decff; /* morado */
        color: white;
      }
    </style> 
      <div class="badge bg-morado text-wrap" style="width: 16rem;"> Helou
        Mi nombre es Lizeth y mi correo es llizlopez578@gmail.com
    </p>
    </div>
  </div>
</div>
    


</div>
    
@endsection