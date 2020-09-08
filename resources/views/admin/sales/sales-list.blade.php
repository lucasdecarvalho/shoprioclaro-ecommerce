@extends('layouts.admin')
@section('content')
    
    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Vendas</h6>
            </div>
        </div>
    </div>
   
    <div class="col-12 p-4 bg-white border border-top-0 rounded-bottom">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p class="p-0 m-0 text-center">{{ $message }}</p>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <tr>
                    <th>Id</th>
                    <th>Status</th>
                    <th>TID <span data-toggle="tooltip" data-placement="top" title="TID é o identificador da sua transação no app da Cielo®"><i class="fas fa-question-circle"></i></span></th>
                    <th>Entrega</th>
                    <th>Cliente</th>
                    <th><i class="fas fa-cogs"></i></th>
                </tr>
                @foreach ($done as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                    @if($item->success == true) Aprovada
                    @else Reprovada @endif</td>
                    <td>{{ $item->tid }}</td>
                    <td>@if($item->status == 'waiting') Aguardando envio @elseif($item->status == 'delivered') Postado @elseif($item->status == 'done') Entregue @else Error edit.sales 34 @endif</td>
                    <td>{{ $user->name }} {{ $user->lastname }} (CPF: {{ $user->doc }})</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('sales.show',$item->id) }}" data-toggle="tooltip" data-placement="top" title="Detalhes"><i class="fas fa-search-plus"></i></a>
                        <a class="btn btn-primary" href="{{ route('sales.edit',$item->id) }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>   
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>
      
@endsection
