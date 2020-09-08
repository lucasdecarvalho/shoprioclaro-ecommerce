@extends('layouts.app')
@section('content')

<section class="container p-4">
    @if (Cart::count() > 0)
    
        <div class="row mt-2 mb-2 text-center text-xl-left">
            <div class="col-12">
                <h4><i class="fas fa-shopping-cart mr-2"></i><span>Carrinho de compras</span></h4>
            </div>
        </div>

        <!-- Avisos -->
        <div class="row">
            <div class="col-12 p-0">
                @if (session()->has('success_message'))
                <div class="alert alter-success bg-white text-black border rounded text-center">
                    {{ session()->get('success_message') }}
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alter-danger bg-danger text-white text-center">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach 
                    </ul>
                    {{ session()->get('success_message') }}
                </div>
                @endif
            </div>
        </div>
        <!-- Fim Avisos -->

        <!-- content -->
        <div class="row">
            <!-- section -->
            <div class="col-12 pt-2 pb-2 border border-bottom-0 rounded-top bg-white">
                <!-- linha de produto -->
                @foreach (Cart::content() as $item)
                <div class="row">

                    <!-- Foto do produto -->
                    <div class="col-3 col-xl-1">
                        <img style="width:auto;height:36px;" class="m-1" src="{{ asset($item->model->image1 ?? 'images/no-image.png') }}" />
                    </div>

                    <!-- Nome do produto -->
                    <div class="col-9 col-xl-5">
                        <h6 class="mt-3 text-black">{{ $item->model->name ?? null }}</h6>
                    </div>

                    <!-- Deletar o produto -->
                    <div class="col-4 col-xl-2 text-left text-xl-right">
                        <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-text mt-1 bg-light"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </div>

                    <!-- Quantidade do produto -->
                    <div class="col-4 col-xl-2">
                        <form class="w-100 float-left" action="{{ route('cart.update', $item->rowId) }}" method="POST">
                            <div class="row">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <button type="submit" name="sub" value="down" class="w-25 btn btn-text bg-light text-black mt-1 float-left rounded-left"><i class="fas fa-minus" style="font-size:.5em;margin-left:-.2em;"></i></button>
                                <input type="number" class="w-50 mt-1 pl-2 float-left border" name="qtd" value="{{ $item->qty }}" readonly>
                                <button type="submit" name="sub" value="up" class="w-25 btn btn-text bg-light text-black mt-1 float-left rounded-right"><i class="fas fa-plus" style="font-size:.5em;margin-left:-.5em;"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Valor do produto -->
                    <div class="col-4 col-xl-2 text-right">
                        <h6 class="mt-3">R$ {{ number_format($item->model->price * $item->qty, 2, ',','.') }}</h6>
                    </div>

                </div>
                @endforeach
            </div>
            <!-- fim section -->
            
            <!-- produtos -->
            <div class="col-12 border rounded-bottom bg-light text-black">
                <!-- Acaba linha de produto -->
                <div class="row">
                    <div class="col-6 d-none d-xl-block">
                    </div>

                    <!-- Valor do total -->
                    <div class="col-12 col-xl-6 text-center text-xl-right">

                        <h4 class="pt-3"><span style="font-size:.7em;">Subtotal:</span> R$ {{ $shop->fmt_price }}</h4>
                                                
                        @if (!!auth()->user() || $shop->fmt_ship != 0.00)
                        <p><i class="fas fa-truck"></i> (Sedex) R$ {{ $shop->fmt_ship }}</p>
                        @else
                        <form action="{{ route('cart.index') }}" method="POST">
                            {{ csrf_field() }}
                            <label class="pr-2" for="zipcode">Calcule o frete <i class="fas fa-truck"></i></label>
                            <input class="w-50 p-2 border rounded cep"  type="text" name="zipcode" id="zipcode" placeholder="Digite seu CEP">
                        </form>
                        </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- fim Content -->

        <div class="row mt-4">
            <div class="col-6">
                <a href="/shop" class="w-100 float-left"><i class="fas fa-undo-alt"></i> Voltar às compras</a>
            </div>
            <div class="col-6 text-right">
                @if (!!auth()->user())
                <a class="w-100 btn btn-success" href="{{ route('checkout.index') }}">Continuar</a>
                @else
                <a class="w-100 btn btn-success" href="{{ route('client.index') }}"><i class="fas fa-sign-in-alt"></i> Login / Cadastro</a>
                @endif
            </div>
        </div>

    @else

        <div class="row">
            <div class="col-12">
                <p class="w-100 mt-3 p-2 border rounded text-center">Não tem produtos em seu carrinho.<br>
                <a href="{{ route('index') }}">Volte às compras</a></p>
            </div>
        </div>

    @endif

</section>

@endsection