<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Sistema @section('titulo') @show</title>
    <link href="{{ asset("assets/librerias/bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/librerias/bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href={{ asset("assets/librerias/alerts/toastr.min.css")}} rel="stylesheet" />
    <link href="{{ asset("assets/css/dashboard/plantilla.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/css/dashboard/boxicons.min.css")}}" rel="stylesheet" type="text/css" />

    @section('styles') @show
</head>
<body>

      <!--INICIO SIDEBAR aqui barra lateral y contenido-->
      @include("Home/sidebar")

      <div class="home-section">
          <div class="home-content">
              <i class="bi bi-list" style="font-size: 2rem;"></i>  
              <span class="text">Menu</span>
          </div>
          <main class="main col">
              <div class="columnas">
                  <!--CONTENIDO -->
                  @yield('contenido')
              </div>
           </main>
      </div>

    <script src="{{ asset("assets/scripts/dashboard/plantilla.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/librerias/jquery/jquery-3.3.1.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("assets/librerias/alerts/toastr.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset('assets/scripts/alert.js') }}" type="text/javascript"></script>
    <script src="{{ asset("assets/librerias/bootstrap4/js/bootstrap.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("assets/librerias/bootstrap4/js/bootstrap.bundle.min.js")}}" type="text/javascript"></script> 

    @section('scripts') @show
</body>
</html>