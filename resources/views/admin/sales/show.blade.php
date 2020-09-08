@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Detalhes da Venda</h6>
            </div>
        </div>
    </div>
   
    <div class="col-12 p-4 bg-white border border-top-0 rounded-bottom">
    
        <div class="col-12">
            <div class="row">

                <div class="col-12 mt-4 mb-4 p-2 border">Dados da Venda:</div>

                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Merchant Order Id:</strong>
                    {{ $sale->merchantOrderId }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Status da Compra:</strong>
                    @if($sale->success == true) aprovada
                    @else reprovada @endif
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Status da Entrega:</strong>
                    @if($sale->status == 'waiting') aguardando envio
                    @elseif($sale->status == 'delivered') postado
                    @elseif($sale->status == 'done') entregue @endif
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Tid:</strong>
                    {{ $sale->tid }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Valor Total:</strong>
                    R$ <span class="money">{{ $sale->value }}</span>
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Tipo de Pagamento:</strong>
                    {{ $sale->paymentType }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Parcelamento:</strong>
                    {{ $sale->installments }}x
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Usuário:</strong>
                    {{ $user->name }} {{ $user->lastname }} (cpf: {{ $user->doc }})
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Id do Pagamento:</strong>
                    {{ $sale->paymentId }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Código de Erro:</strong>
                    {{ $sale->errorCod ?? 'N/A' }}
                </div>



                <div class="col-12 mt-4 mb-4 p-2 border">Endereço:</div>



                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Rua:</strong>
                    {{ $sale->street }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>N:</strong>
                    {{ $sale->number }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Complemento:</strong>
                    {{ $sale->comp }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Cidade:</strong>
                    {{ $sale->city }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Estado:</strong>
                    {{ $sale->state }}
                </div>
                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>CEP:</strong>
                    {{ $sale->zipcode }}
                </div>



                <div class="col-12 mt-4 mb-4 p-2 border">Compra:</div>



                <div class="col-12 pt-2 pb-2">
                    <strong>Quantidade | Produto(s) | (ID):</strong>
                    @foreach ($done as $item)
                        @foreach ($item->cart as $prods)
                            <p class="w-100 p-0 m-0 mt-2">{{ $prods }}</p>
                        @endforeach
                    @endforeach
                </div>



                <div class="col-12 mt-4 mb-4 p-2 border">Resposta dos Correios:</div>



                <div class="col-12 col-xl-6 pt-2 pb-2">
                    <strong>Código de Entrega:</strong>
                    {{ $sale->trackingNumber ?? 'N/A' }}
                </div>

                <div class="col-12 mt-4 mb-4 p-2 border-bottom"></div>
            
                <div class="col-12">
                    <div class="row float-right">
                        <a class="btn btn-primary mb-4" href="{{ route('sales.index') }}"> Voltar</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection