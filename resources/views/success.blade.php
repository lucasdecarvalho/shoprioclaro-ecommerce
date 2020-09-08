@extends('layouts.app')
@section('content')

        <div class="container mb-4">
            <div class="card text-center">
                <div class="card-header">
                    Compra efetuada com sucesso!
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pagamento confirmado.</h5>
                    <p class="card-text">Já recebemos o seu pedido e em breve faremos o envio.</p>
                </div>
                <div class="card-footer text-muted">
                    {{@date('d/m/Y')}}
                </div>
            </div>
        </div>
        {{ Cart::destroy() }}

@endsection