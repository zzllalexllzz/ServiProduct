<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('img/icono.png') }}" sizes="16x16">
  <title>ServiProduct</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
  <style>
    .banner {
      height: 500px;
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .banner h1 {
      font-size: 36px;
    }
    html{
    height: 100%;
  }
    body{
      /* font-family: 'Russo One', sans-serif; */
      font-family: 'Cabin', sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    footer{
      margin-top:auto;
    }
    .titulo{
      margin-left: 20px;
    }
  </style>
</head>

<body>
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Tu Empresa</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacto</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->
  <!-- Menu-->
  <nav class="navbar navbar-expand-md sticky-top py-4" style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <a class="navbar-brand titulo" href="/">
        SERVIPRODUCT
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbar-toggler">
        <ul class="navbar-nav d-flex">
            <li class="nav-item">
                <a class="nav-link sub" href="/">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sub" href="/servicios">SERVICIOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sub" href="/productos">PRODUCTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sub" href="/contacto">CONTACTO</a>
            </li>
        </ul>
      </div>
      <ul class="navbar-nav d-flex">
        @auth
        <li><a class="nav-link scrollto" href="/profile">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</a></li>
        @else
          <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
          @if (Route::has('register'))
            <li><a class="nav-link scrollto" href="{{ route('register') }}">Register</a></li>
          @endif
        @endauth
      </ul>
    </div>
</nav>

  <div class="banner container" style="background-image: url('{{ asset('img/servi.jpg') }}');">
    <div class="container text-dark">
      {{-- <h1> ¡Convierte tu pasión en un negocio exitoso y haz que cada cliente experimente la calidad y dedicación que solo tú puedes brindar!</h1> --}}
    </div>
  </div>

  <div class="container mt-5">
    <h2>Servicio autónomo: Calidad sin límites.</h2>
    <h5>¡Convierte tu pasión en un negocio exitoso y haz que cada cliente experimente la calidad y dedicación que solo tú puedes brindar!</h5>
  </div>
  

  <div class="container mt-5">
    <div class="row">

        @foreach($servicios as $servicio)

        <div class="col-md-4">
            <div class="card">
            <img src="{{asset($servicio->imagen)}}" class="card-img-top img-fluid" alt="Imagen 2">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase" style="color: #53adee;">{{$servicio->nombre}}</h5>
                    <p class="card-text text-uppercase">{{$servicio->ciudad}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>

  <div class="container mt-5 mb-5">
    <h2>Productos excepcionales: Innovación sin fronteras.</h2>
    <h5>Transforma tu pasión en un negocio próspero y brinda a cada cliente la experiencia de calidad y dedicación que solo tus productos pueden ofrecer. ¡Deja tu huella en el mercado y encanta a tus clientes con soluciones únicas e inigualables!</h5>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
