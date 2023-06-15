@extends('usuario.layout')

@section('titulo', 'Productos')

@section('main')
<div class="container">
  <div class="container text-center mt-5 mb-5">
    <h5>Encuentra la excelencia en cada producto y confía en nosotros para llevar tus necesidades al siguiente nivel. Nuestra dedicación por la calidad y nuestra atención excepcional garantizan una experiencia única. Únete a nuestra comunidad de clientes satisfechos y déjanos sorprenderte con productos innovadores que superarán tus expectativas.</h5>
  </div>
    <div class="row">
      <!-- Columna de los buscadores -->
      <div class="col-md-2">
        <h1>Filtros</h1>
        <div class="mb-3">
        {{-- bucar por fecha --}}
            <form action="/producto/buscar/fecha" method="post">
                @csrf
                <label for="fecha" class="form-label">Fecha: </label>
                <input type="date" id="fecha" name="fecha" class="form-control input-field" required>
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </form>
        </div>
        <div class="mb-3">
        {{-- buscar por nombre --}}
            <form action="/producto/buscar/nombre" method="post">
                @csrf
                <label for="nombre" class="form-label">Nombre: </label>
                <input type="text" id="nombre" name="nombre" class="form-control input-field" required>
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </form>
        </div>
        <div class="mb-3">
        {{-- buscar por categoria --}}
            <form action="/producto/buscar/categoria" method="post">
                @csrf
                <label for="categoria" class="form-label">Categoria:</label>
                <select name="categoria" id="" class="form-control input-field" required aria-required="true">
                <option value="">Elige una categoria...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </form>
        </div>
        <!-- Agrega más filtros si es necesario -->
      </div>

      <!-- Columna de las cards de productos -->
      <div class="col-md-10">
        <div class="row">
          <!-- Card 1 -->
        @foreach($productos as $key => $producto)
          <div class="col-md-6 col-lg-4 mb-3">
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
                    @auth
                    <a href="{{ route('addProduct.to.cart', $producto->id) }}" class="btn btn-outline-success shadow-lg">Añadir carrito</a>
                    @endauth
            </div>
            </div>
          </div>
        @endforeach
          <!-- Agrega más cards de productos según sea necesario -->
        </div>
      </div>
    </div>
  </div>
  <div class='row me-5 mb-5'>
    {{ $productos->links() }}
  </div>
@endsection