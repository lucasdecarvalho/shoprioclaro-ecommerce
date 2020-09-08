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

    <title>{{ config('app.name', 'Iluminatta') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600&Libre+Baskerville:wght@700&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Amita:wght@400&display=swap" rel="stylesheet">
    <style>
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
            font-family: 'Amita', cursive;
            font-size:32px;
            color:#fff;
            line-height:0;
            margin-top:.8em;
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
    </style>
</head>
<body style="">
    <div class="flex-center bg-white">
        <!-- top warning -->
        <!-- removed -->
        <!-- header -->
        <!-- top menu contact, cart -->
        <header class="col-12 p-0 m-0">
            <nav class="navbar navbar-dark d-none d-xl-block" style="background:#2c1b47;border-bottom: solid 1px rgba(157, 111, 174, .3);">
                <div class="row">
                    <ul class="navbar mr-auto p-0 m-0">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">WhatsApp: (19) 1234-5678</a>
                        </li>
                    </ul>
                    <ul class="navbar p-0 m-0">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/client">@if (Auth::check()) {{ "Olá, ". Auth::user()->name }} @else Login / Registro @endif</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('cart.index') }}">Carrinho</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Menu logo search -->
            <nav class="navbar navbar-light d-none d-xl-block" style="background:#2c1b47">
                <div class="row">
                    <div class="col-4 d-none d-xl-block">
                        <!--  -->
                    </div>
                    <div class="col-12 col-xl-4 text-center">
                        <a href="/"><h1>Iluminatta</h1><i class="fas fa-seedling" style="position:absolute;margin-left:-0em;margin-top:-2em;font-size:1.2em;color:#ff7700;"></i></a>
                    </div>
                    <div class="col-4 d-none d-xl-block">
                        <form class="form-inline" action="{{ route('search.word') }}" method="GET">
                            <input type="search" name="keyword" class="form-control mr-2 w-75" placeholder="Buscar por produtos na loja" value="@if(isset($keyword)) {{$keyword}} @endif" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- top menu -->
            <nav class="navbar navbar-expand-xl navbar-dark" style="background:#2c1b47">
                <!-- responsivo -->
                <div class="col-12 d-block d-xl-none">
                    <div class="row">
                        <div class="col-9">
                            <a href="/"><h1>Iluminatta</h1><i class="fas fa-seedling" style="position:absolute;margin-left:4.45em;margin-top:-1.9em;font-size:1.2em;color:#ff7700;"></i></a>
                        </div>
                        <div class="col-3">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarText" aria-expanded="true" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                    <ul class="navbar-nav">
                        <div class="col-12 p-2 mt-3 mb-2 rounded d-xl-none bg-dark">

                            <li class="nav-item  border-bottom p-2">
                                <a class="nav-link text-light" href="/client"><i class="fas fa-user"></i> @if (Auth::check()) {{ "Olá, ". Auth::user()->name }} @else Login / Registro @endif</a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link text-light" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i> Carrinho</a>
                            </li>
                            
                        </div>
                        @foreach($categories as $catg)
                        <li>
                            <a class="nav-item nav-link text-light" href="{{ route('shop.index',$catg->path ?? null) }}">{{ $catg->title ?? null }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </header>
        <!-- header end -->

        @yield('content')
        
        <!-- Footer -->
        <div class="footer-head bg-dark text-light">
            <div class="col-12">
                <div class="container pt-4 pb-4">
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="row">
                                <form class="form-inline mb-3 w-100 w-xl-75" action="{{ route('newsletter.store') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <input class="form-control mr-0 mr-xl-1 mt-0" type="text" name="name" placeholder="Digite seu Nome" required>
                                        <input class="form-control mr-0 mr-xl-1 mt-2 mt-xl-0" type="text" name="email" placeholder="Digite seu E-mail" required>
                                        <button class="btn btn-outline-light mt-2 mt-xl-0" type="submit">Assinar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <span>Inscreva-se em nossa newsletter e receba mensagens periodicamente sobre promoções, novidades e destaques de nossa loja.</span>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="row">
                                <ul class="mt-3" style="font-size:2rem;">
                                    <li class="float-left m-2"><a class="text-light" href="https://www.facebook.com/Iluminatta-654918827851954/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                                    <li class="float-left m-2"><a class="text-light" href="https://www.instagram.com/iluminattastore/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <!-- <li class="float-left m-2"><a class="text-light" href="http://" target="_blank"><i class="fab fa-twitter-square"></i></a></li> -->
                                    <!-- <li class="float-left m-2"><a class="text-light" href="http://" target="_blank"><i class="fab fa-youtube"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-light" style="background:#2c1b47;">
            <div class="col-12">
                <div class="container pt-4 pb-4">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="row">
                                <h4>Sobre</h4>
                                <p>Somos uma loja de produtos importados, com ótimo estoque e custo benefício. Navegue por nossas páginas e encontre os produtos que mais tem a ver com o seu estilo. Temos diversas formas de pagamento e facilidades.</p>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="row">
                                <ul class="col-12 col-xl-6">
                                    <li><a class="text-light" href="http://">Contato</a></li>
                                    <li><a class="text-light" href="http://">FAQ</a></li>
                                    <li><a class="text-light" href="http://">Meus Pedidos</a></li>
                                    <li><a class="text-light" href="http://">Política de retorno</a></li>
                                </ul>
                                <ul class="col-12 col-xl-6">
                                    <li><a class="text-light" href="http://">Informações de compra</a></li>
                                    <li><a class="text-light" href="http://">Privacidade</a></li>
                                    <li><a class="text-light" href="http://">Termos de uso</a></li>
                                    <li><a class="text-light" href="http://">Permissão de uso</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-4 text-center" style="border-top: solid 1px rgba(157, 111, 174, .3);">
                            <p class="p-0 m-0">© 2020 Iluminatta. Todos os direitos reservados.</p>
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
        });
    </script>
</body>
</html>
