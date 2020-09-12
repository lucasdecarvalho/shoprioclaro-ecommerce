<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/details.css') }}" rel="stylesheet" type="text/css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shop Rio Claro') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        a,p,span,small,h2,h5,h6,li {
            font-family: 'Open Sans', cursive;
        }
        a {
            text-decoration: none !important;
        }
        ul {
            list-style: none;
        }
        #carouselExampleControls {
            width:100%;
            height:auto;
            background:#f90;
        }
        h1 {
            font-family: 'Anton', cursive;
            font-size:42px;
            line-height:0;
            margin-top:.2em;
        }
        h5 {
            font-size:16px;
        }
        h4 {
            font-family: 'Anton', cursive;
            font-size:22px;
        }
        h3 {
            font-family: 'Anton', cursive;
            font-size:26px;
            line-height:0;
            margin-top:.75em;
        }
        .slide {
            overflow:hidden;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
        li#menu:hover {
            background:#f60;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="flex-center bg-white">

        <header class="col-12 p-0 m-0">

            <nav class="navbar">
                <div class="container">
                    <div class="col-12 col-md-4 d-none d-md-block text-center text-md-left">
                        <a href="{{ route('index') }}">
                            <h1 class="text-primary">Sua Marca</h1>
                        </a>
                    </div>
                    <div class="col-9 col-md-4 p-0">
                        <form class="form-inline" action="{{ route('search.word') }}" method="GET">
                            <input type="search" name="keyword" class="form-control border-primary w-75" placeholder="Buscar por produtos..." maxlength="255" value="@if(isset($keyword)) {{$keyword}} @endif" aria-label="Search" required>
                            <button class="btn btn-outline-primary ml-1 w-auto" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-3 col-md-4">
                        <ul class="nav">
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link text-dark" href="{{ route('client.index') }}">
                                    <i style="font-size:18px;" class="fas fa-user text-dark mr-1"></i>
                                    @if (Auth::check()) {{ "Olá, ". Auth::user()->name ." ". Auth::user()->lastname }}. @else Login / Registro @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('cart.index') }}">
                                    <i style="position:absolute;top:-2px;right:.5em;font-size:34px;line-height:1em;" class="fas fa-shopping-cart mr-2 text-dark"></i>
                                    <span style="position:absolute;top:-.5em;right:.5em;" class="rounded-circle pr-2 pl-2 bg-danger text-white">{{ Cart::count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- top menu -->
        <nav class="nav sticky-top navbar-expand-md navbar-dark bg-dark pt-2 pb-2 p-md-0">
            <!-- responsivo -->
            <div class="col-12 d-block d-md-none">
                <div class="row">
                    <div class="col-7 text-left">
                        <a href="{{ route('index') }}">
                            <h3 class="text-white">Sua Marca</h3>
                        </a>
                    </div>
                    <div class="col-5 text-right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarText" aria-expanded="true" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <ul class="navbar-nav rounded d-md-none mt-3 m-2 bg-secondary">
                    <li class="nav-item p-3">
                        <a class="nav-link text-light" href="{{ route('client.index') }}"><i class="fas fa-user"></i> @if (Auth::check()) {{ "Olá, ". Auth::user()->name }} @else Login / Registro @endif</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @foreach($categories as $catg)
                    <li id="menu" class="nav-item p-3">
                        <a class="nav-link text-white text-uppercase" href="{{ route('shop.index',$catg->path ?? null) }}">{{ $catg->title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        <!-- header end -->

        @yield('content')
        
        <!-- Footer -->
        <div class="footer-head bg-secondary text-light">
            <div class="container pt-4 pb-4"></div>
        </div>
        <footer class="bg-dark text-light">
            <div class="container pt-4 pb-4">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <h4>Lorem Ipsum</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porta purus lectus, sit amet placerat libero porta at. Vivamus tincidunt, ex in porttitor ornare, libero dolor bibendum ante.</p>
                    </div>
                    <div class="col-12 col-md-5 p-0">
                        <div class="navbar">
                            <ul class="p-2 border-left">
                                <li>
                                    <a class="text-light" href="">Contato</a>
                                </li>
                                <li>
                                    <a class="text-light" href="">FAQ</a>
                                </li>
                                <li>
                                    <a class="text-light" href="">Meus Pedidos</a>
                                </li>
                            </ul>
                            <ul class="p-2 border-left">
                                <li>
                                    <a class="text-light" href="">Política de devolução</a>
                                </li>
                                <li>
                                    <a class="text-light" href="">Privacidade</a>
                                </li>
                                <li>
                                    <a class="text-light" href="">Termos de uso</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-4 pb-4 text-center" style="border-top: solid 1px rgba(3, 3, 3, .3);">
                <p class="p-0 m-0">© 2020 Shop Rio Claro. <br> Todos os direitos reservados.</p>
            </div>
        </footer>
        <!-- Footer end -->
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.cpf').mask('000.000.000-00');
            $('.cep').mask('00000-000');
            $('.cel').mask('(00) 00000-0000');
            $('.phone').mask('(00) 0000-0000');
            $('.exp').mask('00/0000');
            $('.cvv').mask('000');
            $('.ccnumber').mask('0000 0000 0000 0000');
        });
    </script>
</body>
</html>
