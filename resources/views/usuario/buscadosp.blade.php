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
        @foreach($productos as $key => $producto)
          <div class="col-md-4 mb-3">
            <div class="card shadow-lg anima">
              <div class="d-flex justify-content-center">
                <img src="{{ asset($producto->imagen) }}" class=" rounded-top " alt="..." width="80%" height="340">
              </div>
                <div class="card-body rounded">
                  <h3 class="card-title text-center text-uppercase text-warning-emphasis tracking-in-expand">{{$producto->nombre}}</h3>
                        @foreach($categorias as $key => $categoria)
                            @if ($producto->cateproducto_id == $categoria->id)
                            <p class="card-text text-dark"><strong>Categoria:&nbsp</strong>{{ $categoria->nombre }}</p>
                            @endif
                        @endforeach
                        <h5 class="card-text text-dark d-flex justify-content-end"><strong>Precio:&nbsp</strong>{{$producto->precio}} €</h5>
                        <p class="card-subtitle mb-2 text-light-emphasis ">{{$producto->fecha}}</p>
                        <a class="btn btn-outline-dark shadow-lg" href="/producto/{{$producto->id}}/detalle">Ver más</a>
                        {{-- <a href="{{ route('addProduct.to.cart', $producto->id) }}" class="btn btn-outline-success shadow-lg">Añadir carrito</a> --}}
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