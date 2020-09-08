@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Usuários</h6>
            </div>
        </div>
    </div>
   
    <div class="col-12 p-4 bg-white border border-top-0 rounded-bottom">
    
        <div class="col-12">
            <div class="row">

                <div class="col-12 mt-4 mb-4 p-2 border">Dados Pessoais:</div>

                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Nome Completo:</strong>
                    {{ $user->name }} {{ $user->lastname }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>CPF:</strong>
                    {{ $user->doc }}
                </div>



                <div class="col-12 mt-4 mb-4 p-2 border">Contatos:</div>



                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Telefone:</strong>
                    {{ $user->phone1 }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Telefone Adicional:</strong>
                    {{ $user->phone2 }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>E-mail:</strong>
                    {{ $user->email }}
                </div>



                <div class="col-12 mt-4 mb-4 p-2 border">Endereço:</div>



                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Rua:</strong>
                    {{ $user->street }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>N:</strong>
                    {{ $user->number }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Complemento:</strong>
                    {{ $user->comp }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Cidade:</strong>
                    {{ $user->city }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Estado:</strong>
                    {{ $user->state }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>CEP:</strong>
                    {{ $user->zipcode }}
                </div>



                <div class="col-12 mt-4 mb-4 p-2 border-bottom"></div>
        
                <div class="col-12">
                    <div class="row float-right">
                        <a class="btn btn-primary mb-4" href="{{ route('users.index') }}"> Voltar</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection