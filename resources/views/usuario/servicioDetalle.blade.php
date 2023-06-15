@extends('usuario.layout')

@section('titulo', 'Servcicios')

@section('main')
<div class="row mb-5 flex justify-content-center">
    <div class="col-sm-4 mb-3 mb-sm-0">
      <div class="card shadow-lg animaeve">
        <div class="card-body ">
          <h1 class="card-title text-center text-warning-emphasis">{{$servicios->nombre}}</h1>
          <p class="card-text"><strong>Descripcion: </strong><br>{{$servicios->descripcion}}</p>
          <p class="card-text"><strong>Ciudad: </strong><br>{{$servicios->ciudad}}</p>
          <p class="card-text"><strong>Facturacion: </strong><br>{{$servicios->facturacion}}</p>
          @foreach($categorias as $key => $categoria)
              @if ($servicios->cateservicio_id == $categoria->id)
              <p class="card-text"><strong>Categoria: </strong><br>{{ $categoria->nombre }}</p>
              @endif
          @endforeach
          <strong>Fecha: </strong><br>
          <p class="card-subtitle mb-2 text-light-emphasis">{{$servicios->fecha}}</p>
        </div>
        <img src="{{asset($servicios->imagen)}}" class="card-img-top rounded-bottom" alt="...">
      </div>
    </div>
    <div class="col-sm-4 ">
      <div class="card shadow-lg ">
        <div class="card-body">
          <h3 class="card-title text-center">¿Te gusto nuestro Servicio?</h3>
          <div class="d-flex justify-content-center gap-2 mb-5">
            <div>
              <form method='POST' action='/servicio/user/store' class="mb-3">
                @csrf
                <!-- user_id -->
                <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                <!-- servicio -->
                <input type="hidden" name="servicio_id" value={{$servicios->id}}>

                <button class="btn btn-primary btn-lg"><i class="bi bi-hand-thumbs-up-fill"></i> Me Gusta +{{$usuarios->count()}}</button>
              </form>
            </div>
            <div>
              <a href="/servicio/{{$servicios->id}}/user/{{Auth::user()->id}}/borrar" class="btn btn-secondary btn-lg"><i class="bi bi-hand-thumbs-down-fill"></i> No me Gusta</a>
            </div>
          </div>
          <div class="d-flex justify-content-center mb-5">
            <a href="/servicio/{{$servicios->id}}/user/{{Auth::user()->id}}/interesado" class="btn btn-success btn-lg interesado"><i class="bi bi-envelope-at"></i> Estoy Interesado/a</a>
          </div>
          <div class="mb-5">
            <form action="/servicio/coment" method="POST">
              @csrf
              <!-- user_id -->
              <input type="hidden" name="user_id" value={{Auth::user()->id}}>
              <!-- evento -->
              <input type="hidden" name="servicio_id" value={{$servicios->id}}>
              <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s');?>">
              <div class="mb-3">
                <label class="form-label"><strong>Añadir Reseña:</strong></label>
                <textarea class="form-control" name="descripcion" placeholder="Comenta aqui..." id="floatingTextarea" style="height: 100px" required></textarea>
              </div>
              <center>
                <button class="btn btn-outline-success text-center">Añadir Reseña</button>
              </center>
            </form>
          </div>
          

          <div>
            @foreach ($comentarios as $comentario)
              @if($servicios->id==$comentario->servicio_id)
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
                  <a href="/comentario/{{ $comentario->id }}/borrar" class="d-flex justify-content-end"><i class="bi bi-x-lg text-danger"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
 $(".interesado").click(function(event) {
    event.preventDefault(); // Evita el comportamiento predeterminado del enlace
    
    var href = $(this).attr("href"); // Obtén la URL del enlace
    
    // Realizar acción del enlace
    window.location.href = href;
    
    // Mostrar SweetAlert después de que la página se haya cargado completamente
    window.onload = function() {
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
      });
    };
  });

</script>
@endsection