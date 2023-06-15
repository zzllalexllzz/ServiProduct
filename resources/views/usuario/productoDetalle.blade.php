@extends('usuario.layout')

@section('titulo', 'Productos')

@section('main')
<div class="row mb-5 flex justify-content-center">
    <div class="col-md-4  mb-3 mb-sm-0">
      <div class="card shadow-lg animaeve">
        <div class="card-body ">
          <h1 class="card-title text-center text-warning-emphasis">{{$productos->nombre}}</h1>
          <p class="card-text"><strong>Descripcion: </strong><br>{{$productos->descripcion}}</p>
          <p class="card-text"><strong>Precio: </strong><br>{{$productos->precio}} €</p>
          @foreach($categorias as $key => $categoria)
              @if ($productos->cateproducto_id == $categoria->id)
              <p class="card-text"><strong>Categoria: </strong><br>{{ $categoria->nombre }}</p>
              @endif
          @endforeach
          <strong>Fecha: </strong><br>
          <p class="card-subtitle mb-2 text-light-emphasis">{{$productos->fecha}}</p>
        </div>
        <img src="{{asset($productos->imagen)}}" class="card-img-top rounded-bottom" alt="...">
      </div>
    </div>
    <div class="col-md-4 ">
      <div class="card shadow-lg ">
        <div class="card-body">
            <a href="{{ route('addProduct.to.cart', $productos->id) }}" class="btn btn-outline-success shadow-lg text-center"><i class="bi bi-cart3"></i> Añadir carrito</a>
          <h3 class="card-title text-center">Dejanos tu opinion</h3>
          <div class="mb-5">
            <form action="/producto/resena" method="POST">
              @csrf
              <!-- user_id -->
              <input type="hidden" name="user_id" value={{Auth::user()->id}}>
              <!-- evento -->
              <input type="hidden" name="producto_id" value={{$productos->id}}>
              <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s');?>">
              <div class="mb-3">
                <label class="form-label"><strong>Añadir Reseña:</strong></label>
                <textarea class="form-control" name="descripcion" placeholder="Comenta aqui..." id="floatingTextarea" style="height: 100px" required></textarea>
              </div>
              <center>
                <button class="btn btn-info text-center">Añadir Reseña</button>
              </center>
            </form>
          </div>
          <div>
            @foreach ($comentarios as $comentario)
                @if($productos->id==$comentario->producto_id)
                <div>
                    @foreach ($users as $user)
                    @if($user->id==$comentario->user_id)
                    <div class="d-flex justify-content-between">
                      <h5>{{$user->nombre}} {{$user->apellido}} </h5>
                      <span class="text-light-emphasis opacity-75">{{$comentario->fecha}}</span>
                    </div>
                    @endif
                    @endforeach
                    <p>{{$comentario->descripcion}}</p>
                    <div>
                        @if (Auth::user()->id==$comentario->user_id)
                        <a href="/resena/{{ $comentario->id }}/borrar" class="d-flex justify-content-end"><i class="bi bi-x-lg text-danger"></i></a>
                        @endif
                    </div>
                </div>
                <hr style="width: 100%; border:1px solid black;">
                @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')

@endsection