@extends('usuario.layout')

@section('titulo', 'Servcicios')

@section('main')
<div class="container">
  <div class="container text-center mt-5 mb-5">
    <h5>Descubre un nuevo estándar de excelencia y confía en nuestro servicio para hacer realidad tus proyectos. Nuestra pasión por brindar resultados sobresalientes y nuestra atención inigualable te garantizan una experiencia única. Únete a nuestra comunidad de clientes satisfechos y déjanos superar tus expectativas en cada servicio que brindamos.</h5>
  </div>
    <div class="row">
      <!-- Columna de los buscadores -->
      <div class="col-md-2">
        <h1>Filtros</h1>
        <div class="mb-3">
        {{-- bucar por fecha --}}
            <form action="/servicio/buscar/fecha" method="post">
                @csrf
                <label for="fecha" class="form-label">Fecha: </label>
                <input type="date" id="fecha" name="fecha" class="form-control input-field" required>
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </form>
        </div>
        <div class="mb-3">
        {{-- buscar por ciudad --}}
            <form action="/servicio/buscar/ciudad" method="post">
                @csrf
                <label for="ciudad" class="form-label">Ciudad: </label>
                <input type="text" id="ciudad" name="ciudad" class="form-control input-field" required>
                <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i> Buscar</button>
            </form>
        </div>
        <div class="mb-3">
        {{-- buscar por categoria --}}
            <form action="/servicio/buscar/categoria" method="post">
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
        @foreach($servicios as $key => $servicio)
          <div class="col-md-6 col-lg-4 mb-3">
            <div class="card shadow-lg anima">
                <img src="{{ asset($servicio->imagen) }}" class=" rounded-top" alt="..." width="100%" height="340">
            <div class="card-body rounded">
              <h2 class="card-title text-center text-uppercase text-warning-emphasis tracking-in-expand">{{$servicio->nombre}}</h2>
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
  <div class='row me-5 mb-5'>
    {{ $servicios->links() }}
  </div>
@endsection