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
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        a,p,span,small,h2,h3,h5,h6,li {
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
        }
        h5 {
            font-size:16px;
        }
        h4 {
            font-family: 'Anton', cursive;
            font-size:22px;
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
                    <div class="col-4">
                        <a href="/">
                            <h1 class="text-primary">Sua marca</h1>
                        </a>
                    </div>
                    <div class="col-4">
                        <form class="form-inline" action="{{ route('search.word') }}" method="GET">
                            <input type="search" name="keyword" class="form-control border-primary w-75" placeholder="Buscar por produtos na loja" value="@if(isset($keyword)) {{$keyword}} @endif" aria-label="Search">
                            <button class="btn btn-outline-primary ml-1 w-auto" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-4">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('client.index') }}">
                                    <i style="font-size:18px;" class="fas fa-user text-dark mr-1"></i>
                                    @if (Auth::check()) {{ "Olá, ". Auth::user()->name ." ". Auth::user()->lastname }}. @else Login / Registro @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="position:absolute;right:0;" class="nav-link text-dark" href="{{ route('cart.index') }}">
                                    <i style="font-size:34px;line-height:1em;" class="fas fa-shopping-cart mr-2 text-dark"></i>
                                    <span style="position:absolute;top:.2em;right:.5em;" class="rounded-circle pr-2 pl-2 bg-danger text-white">{{ Cart::count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>



            <!-- top menu -->
            <nav class="navbar navbar-expand-xl navbar-dark bg-dark p-0">
                <!-- responsivo -->
                <div class="col-12 d-block d-xl-none">
                    <div class="row">
                        <div class="col-12 text-right">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarText" aria-expanded="true" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <div class="col-12 rounded d-xl-none">

                            <li class="nav-item  border-bottom p-2 m-0">
                                <a class="nav-link text-light" href="/client"><i class="fas fa-user"></i> @if (Auth::check()) {{ "Olá, ". Auth::user()->name }} @else Login / Registro @endif</a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link text-light" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i> Carrinho</a>
                            </li>
                            
                        </div>
                        @foreach($categories as $catg)
                        <li id="menu" class="p-2 m-0">
                            <a class="nav-item nav-link text-white text-uppercase" href="{{ route('shop.index',$catg->path ?? null) }}">{{ $catg->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </header>
        <!-- header end -->

        @yield('content')
        
        <!-- Footer -->
        <div class="footer-head bg-secondary text-light">
            <div class="col-12">
                <div class="container pt-4 pb-4">
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="row">
                                <form class="form-inline mb-3 w-100 w-xl-75" action="{{ route('newsletter.store') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <input class="form-control mr-0 mr-xl-1 mt-0 border-light" type="text" name="name" placeholder="Digite seu Nome" required>
                                        <input class="form-control mr-0 mr-xl-1 mt-0 mt-xl-0 border-light" type="text" name="email" placeholder="Digite seu E-mail" required>
                                        <button class="btn btn-outline-light mt-2 mt-xl-0" type="submit">Assinar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <span>Inscreva-se em nossa newsletter e receba mensagens periodicamente sobre promoções, novidades e destaques de nossa loja.</span>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <ul class="navbar nav mt-3">
                                <li class="nav-item m-2">
                                    <a class="text-secondary text-light" href="https://www.instagram.com/" target="_blank">
                                        <i style="font-size:2em;" class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-2">
                                    <a class="text-secondary text-light" href="https://www.facebook.com/" target="_blank">
                                        <i style="font-size:2em;" class="fab fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-2">
                                    <a class="text-secondary text-light" href="https://www.twitter.com/" target="_blank">
                                        <i style="font-size:2em;" class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item m-2">
                                    <a class="text-secondary text-light" href="https://www.youtube.com/" target="_blank">
                                        <i style="font-size:2em;" class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-dark text-light">
            <div class="col-12">
                <div class="container pt-4 pb-4">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="row">
                                <h4>Lorem Ipsum</h4>
                                <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porta purus lectus, sit amet placerat libero porta at. Vivamus tincidunt, ex in porttitor ornare, libero dolor bibendum ante, ac condimentum metus eros ac risus. In ac ornare dolor. Nam accumsan semper consequat.</p>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="nav navbar">
                                <ul class="col-12 col-xl-6">
                                    <li>
                                        <a class="text-light" href="">Contato</a>
                                    </li>
                                    <li>
                                        <a class="text-light" href="">FAQ</a>
                                    </li>
                                    <li>
                                        <a class="text-light" href="">Meus Pedidos</a>
                                    </li>
                                    <li>
                                        <a class="text-light" href="">Política de retorno</a>
                                    </li>
                                </ul>
                                <ul class="col-12 col-xl-6">
                                    <li>
                                        <a class="text-light" href="">Informações de compra</a>
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
                    <div class="row">
                        <div class="col-12 pt-4 text-center" style="border-top: solid 1px rgba(3, 3, 3, .3);">
                            <p class="p-0 m-0">© 2020 Shop Rio Claro. Todos os direitos reservados.</p>
                        </div>
                    </div>
                </div>
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
            // $('.mixed').mask('AAA 000-S0S');
            // $('.money').mask('000.000.000.000.000,00', {reverse: true});

            $('.carousel').carousel({
              interval: 200
            })
        });
    </script>
</body>
</html>
