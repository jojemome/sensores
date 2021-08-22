<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sensores') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <!-- inicio mis librerias -->

    <!-- Google Charts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- librerias tablas -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" defer>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" defer>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" defer>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css" defer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous" defer></script>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js" defer></script>

    <!-- estilos tabla -->
    <style> 
        :after, :before {
            box-sizing: border-box;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }
        i{
        margin-bottom:4px;
        }

        .btn {
            display: inline-block;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .btn-app {
            color: white;
            box-shadow: none;
            border-radius: 3px;
            position: relative;
            padding: 10px 15px;
            margin: 0;
            min-width: 60px;
            max-width: 80px;
            text-align: center;
            border: 1px solid #ddd;
            background-color: #f4f4f4;
            font-size: 12px;
            transition: all .2s;
            background-color: steelblue !important;
        }

        .btn-app > .fa, .btn-app > .glyphicon, .btn-app > .ion {
            font-size: 30px;
            display: block;
        }

        .btn-app:hover {
            border-color: #aaa;
            transform: scale(1.1);
        }

        .pdf {
        background-color: #dc2f2f !important;
        }

        .excel {
            background-color: #3ca23c !important;
        }

        .csv {
            background-color: #e86c3a !important;
        }

        .imprimir {
            background-color: #8766b1 !important;
        }

        /*
        Esto es opcional pero sirve para que todos los botones de exportacion se distribuyan de manera equitativa usando flexbox

        .flexcontent {
            display: flex;
            justify-content: space-around;
        }
        */

        .selectTable{
        height:40px;
        float:right;
        }

        div.dataTables_wrapper div.dataTables_filter {
            text-align: left;
            margin-top: 15px;
        }

        .btn-secondary {
            color: #fff;
            background-color: #4682b4;
            border-color: #4682b4;
        }

        .btn-secondary:hover {
            color: #fff;
            background-color: #315f86;
            border-color: #545b62;
        }

        .titulo-tabla{
        color:#606263;
        text-align:center;
        margin-top:15px;
        margin-bottom:15px;
        font-weight:bold;
        }

        .inline{
        display:inline-block;
        padding:0;
        }

    </style>

    <!-- fin mis librerias -->

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'SENSORES') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::check()) <!-- autentificado-->
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Estaciones
                            </a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('regest') }}">Registar estación nueva</a>
                                <a class="dropdown-item" href="{{ route('muestramonitor') }}">Mostrar estaciones existentes</a>
                                </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Registros
                            </a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('mtt') }}">Tabulación de registros por estación</a>
                                <a class="dropdown-item" href="{{ route('mgt') }}">Graficación de registros por estación</a>
                                </div>
                        </li>

                    </ul>
                    @endif 

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <!--@if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif-->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>


    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js" defer></script>
</html>
