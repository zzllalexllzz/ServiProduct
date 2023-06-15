<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/icono.png') }}" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">

    <title>ServiProduct</title>
</head>
<style>
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
    nav a{
      color: black
    }
    .titulo{
      margin-left: 20px;
    }
    .input-field {
      width: 200px; /* Ajusta el ancho según tus necesidades */
      height: 35px;
    }
    .anima{
      transition: 2s;
    }
    .anima:hover{
      transform: scale(1.1);
      border: 3px solid rgb(20, 109, 243);
      z-index: 1000;
    }
    .animaeve{
      transition: 4s;
    }
    .animaeve:hover{
      transform: scale(1.1);
      z-index: 1000;
    }
    
    .blur-in{animation:blur-in 1.8s linear both} @keyframes blur-in{0%{filter:blur(12px);opacity:0}100%{filter:blur(0);opacity:1}}
    .rotate-vertical-center:hover{animation:rotate-vertical-center 2s} @keyframes rotate-vertical-center{0%{transform:rotateY(0)}100%{transform:rotateY(360deg)}}

    .jello-vertical:hover{animation:jello-vertical .9s linear both} @keyframes jello-vertical{0%{transform:scale3d(1,1,1)}30%{transform:scale3d(.75,1.25,1)}40%{transform:scale3d(1.25,.75,1)}50%{transform:scale3d(.85,1.15,1)}65%{transform:scale3d(1.05,.95,1)}75%{transform:scale3d(.95,1.05,1)}100%{transform:scale3d(1,1,1)}}

</style>
<body>
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
            <li>
              <a href="{{ route('shopping.cart')}}" class="btn  position-relative " style="margin-right: 10px;">
                <i class="bi bi-cart3"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
                  {{ count((array) session('cart')) }}
                  <span class="visually-hidden">unread messages</span>
                </span>
              </a>
            </li>
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


    <main id="main">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
      @endif
      <section id="main" class="section-bg">
        <div class="container-fluid mt-5">
          @yield('main')
        </div>
      </section>
    </main><!-- End #main -->


    <footer class="bg-dark text-center text-white ">
        <!-- Grid container -->
        <div class="container p-4 ">
          <!-- Section: Social media -->
          <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="bi bi-facebook"></i></a>
            <!-- Twitter -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="bi bi-twitter"></i></a>
            <!-- Google -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="bi bi-google"></i></a>
            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="bi bi-instagram"></i></a>
            <!-- Linkedin -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="bi bi-linkedin"></i></a>
            <!-- Github -->
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="bi bi-github"></i></a>
          </section>
          <!-- Section: Social media -->
        </div>
        <!-- Grid container -->
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2023 Copyright:
          <a class="text-white" href="">ServiciosInfo.com</a>
        </div>
        <!-- Copyright -->
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>