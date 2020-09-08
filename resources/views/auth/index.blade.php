@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="card-header">Meus dados</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Você está logado como {{ Auth::user()->name ?? null  }}.

                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Sair</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <!-- Dados -->
                    <hr class="w-100 float-left mt-4 mb-4">
                    <h4>Dados pessoais</h4>
                    <hr class="w-100 float-left mt-4 mb-4">

                    <form action="{{ route('client.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ Auth::user()->id  }}">

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome" value="{{ Auth::user()->name ?? null }}">
                                </div>
                                <div class="col-6">
                                    <label for="lastname">Sobrenome:</label>
                                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Sobrenome" value="{{ Auth::user()->lastname ?? null }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="doc">CPF:</label>
                            <input type="text" name="doc" class="form-control cpf" id="doc" placeholder="CPF" value="{{ Auth::user()->doc ?? null  }}" readonly required>
                            <small id="emailHelp" class="form-text text-muted">Caso precise alterar o seu CPF, entre em contato com nosso suporte <a href="mailto:iluminatta@iluminatta.com.br">clicando aqui</a>.</small>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="" class="btn btn-primary">Alterar dados</button>
                        </div>                        
                    </form>

                    <!-- Contatos -->
                    <hr class="w-100 float-left mt-4 mb-4">
                    <h4>Contatos</h4>
                    <hr class="w-100 float-left mt-4 mb-4">

                    <form action="{{ route('client.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">


                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="phone1">Celular:</label>
                                    <input type="text" name="phone1" class="form-control cel" id="phone1" placeholder="Telefone" value="{{ Auth::user()->phone1 ?? null }}">
                                </div>
                                <div class="col-6">
                                    <label for="phone2">Telefone (opcional)):</label>
                                    <input type="text" name="phone2" class="form-control phone" id="phone2" placeholder="Telefone adicional" value="{{ Auth::user()->phone2 ?? null }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="E-mail" value="{{ Auth::user()->email ?? null }}">
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="" class="btn btn-primary">Alterar contatos</button>
                        </div>
                    </form>



                    <!-- CEP -->
                    <hr class="w-100 float-left mt-4 mb-4">
                    <h4>Endereço</h4>
                    <p>(Será usado para entregas)</p>
                    <hr class="w-100 float-left mt-4 mb-4">

                    <form action="{{ route('client.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ Auth::user()->id  }}">

                        <div class="col-12 col-xl-6 mt-4 mb-4">
                            <div class="row">
                                <label for="zipcode" class="w-100">Digite seu CEP:</label>
                                <input type="text" name="zipcode" class="col-8 border rounded-left cep" id="zipcode" placeholder="Digite seu CEP" value="{{ Auth::user()->zipcode ?? null  }}" required>
                                <input type="hidden" name="number" value=" ">
                                <input type="hidden" name="comp" value=" ">
                                <button type="submit" name="" class="col-4 bg-secondary p-2 border-0 text-white rounded-right">Preencher</button>
                            </div>
                        </div>
                    </form>    



                    <!-- Endereço -->
                    <form action="{{ route('client.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ Auth::user()->id  }}">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-9">
                                    <label for="street">Endereço:</label>
                                    <input type="text" name="street" class="form-control" id="street" placeholder="Logradouro" value="{{ $end['street'] ?? null }}" readonly required>
                                </div>
                                <div class="col-3">
                                    <label for="number">Número:</label>
                                    <input type="text" name="number" class="form-control" id="number" placeholder="Número" value="{{ Auth::user()->number ?? null }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="comp">Complemento:</label>
                                    <input type="text" name="comp" class="form-control" id="comp" placeholder="Complemento" value="{{ Auth::user()->comp ?? null }}">
                                </div>
                                <div class="col-6">
                                    <label for="neigh">Bairro:</label>
                                    <input type="text" name="neigh" class="form-control" id="neigh" placeholder="Bairro" value="{{ $end['district'] ?? null }}" readonly required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="city">Cidade:</label>
                                    <input type="text" name="city" class="form-control" id="city" placeholder="Cidade" value="{{ $end['city'] ?? null }}" readonly required>
                                </div>
                                <div class="col-6">
                                    <label for="state">Estado:</label>
                                    <input type="text" name="state" class="form-control" id="state" placeholder="Estado" value="{{ $end['uf'] ?? null }}" readonly required>
                                    <input type="hidden" name="country" value="Brasil" readonly required>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" name="" class="btn btn-primary">Alterar Endereço</button>
                        </div>
                    </form>
                    <!-- end form address -->
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card">
                <div class="card-header">Meus Pedidos</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($done as $key => $item)
                            @if($item->status == 'waiting' || $item->status == 'delivered')
                            <ul class="w-100 p-2 border rounded">
                                
                                <li class="">Número do pedido: {{ $item->tid }}</li>
                                <li>Status: <button class="btn btn-info text-white p-0 pl-1 pr-1">{{ $item->status }}</button></li>
                                    
                                    <ul class="w-100 p-0 mt-2">
                                    @foreach($item->cart as $prods)
                                        <li class="p-2 border-top">{{ $prods }}</li>
                                    @endforeach
                                    </ul>
                            </ul>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Pedidos Entregues</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($done as $key => $item)
                            @if($item->status == 'done')
                            <ul class="w-100 p-2 border rounded">
                                
                                <li class="">Número do pedido: {{ $item->tid }}</li>
                                    
                                    <ul class="w-100 p-0 mt-2">
                                    @foreach($item->cart as $prods)
                                        <li class="p-2 border-top">{{ $prods }}</li>
                                    @endforeach
                                    </ul>
                            </ul>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
