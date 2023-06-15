@extends('usuario.layout')

@section('titulo', 'Servcicios')

@section('main')
<div class="container">
    <div class="row">
      <!-- Columna de los buscadores -->

      <!-- Columna de las cards de productos -->
      <div class="col-md-12">
        <div class="row">
          <!-- Card 1 -->
        @foreach($servicios as $key => $servicio)
          <div class="col-md-4 mb-3">
            <div class="card shadow-lg anima">
                <img src="{{ asset($servicio->imagen) }}" class=" rounded-top" alt="..." width="100%" height="340">
            <div class="card-body rounded">
              <h2 class="card-title text-center text-uppercase text-warning-emphasis">{{$servicio->nombre}}</h2>
                    <p class="card-text text-dark"><strong>Ciudad:&nbsp</strong>{{$servicio->ciudad}}</p>
                    <p class="card-text text-dark"><strong>Facturacion:&nbsp</strong>{{$servicio->facturacion}}</p>
                    @foreach($categorias as $key => $categoria)
                        @if ($servicio->categoria_id == $categoria->id)
                        <p class="card-text text-dark"><strong>Categoria:&nbsp</strong>{{ $categoria->nombre }}</p>
                        @endif
                    @endforeach

                    <p class="card-subtitle mb-2 text-light-emphasis float-end">{{$servicio->fecha}}</p>
                    <a class="btn btn-outline-dark shadow-lg" href="/servicio/{{$servicio->id}}/detalle">Mas Informacion</a>
            </div>
            </div>
          </div>
        @endforeach
          <!-- Agrega más cards de productos según sea necesario -->
        </div>
      </div>
    </div>
  </div>
@endsection