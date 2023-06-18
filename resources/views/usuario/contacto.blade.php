@extends('usuario.layout')

@section('titulo', 'Productos')

@section('main')
<div class="container">
    
    <div class="container text-center mt-5 mb-5">
      <h5>¡Contáctanos a través de nuestra página de contacto y solicita tu perfil de creador! Con nuestro formulario, podrás subir tus servicios y compartir tu talento con el mundo.</h5>
  </div>
  <div class="container text-center mt-5 mb-5">
    <p>Tu opinión es valiosa y nos ayuda a crecer. Nos encantaría escuchar tus pensamientos y brindarte la mejor experiencia posible. No tengas miedo de compartir, cada palabra cuenta en nuestro camino hacia la mejora constante.</p>
</div>
    <h1 class="text-center mt-5">Formulario de Contacto</h1>
    <div class="row justify-content-center">
      <div class="col-lg-6 mb-5">
        <form action="/enviar/info/contacto" method="post">
          @csrf
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required aria-required="true">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico" required aria-required="true">
          </div>
          <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="descripcion" rows="5" placeholder="Ingrese su mensaje" required aria-required="true"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-dark">Enviar Mensaje</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

