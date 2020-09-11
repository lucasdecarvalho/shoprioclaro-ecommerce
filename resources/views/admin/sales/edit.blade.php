@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Vendas</h6>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-12 p-4 bg-white border border-top-0 rounded-bottom">

        <form action="{{ route('sales.update',$sale->id) }}" method="POST">
            @csrf
            @method('PUT')

                <div class="form-row">
                    <div class="form-group col-12 col-xl-6">
                        <label for="status">Status de Entrega:</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="{{ $sale->status }}">@if($sale->status == 'waiting') Aguardando envio @elseif($sale->status == 'delivered') Postado @elseif($sale->status == 'done') Entregue @else Error edit.sales 34 @endif</option>
                                <option value="waiting">Aguardando envio</option>
                                <option value="delivered">Postado</option>
                                <option value="done">Entregue</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-xl-6">
                        <label for="trackingNumber">Código de Rastreio:</label>
                        <input type="text" maxlength="18" name="trackingNumber" value="{{ $sale->trackingNumber }}" class="form-control" id="trackingNumber" maxlength="45" placeholder="">
                    </div>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-12 text-right">
                        <a href="/admin/sales" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Alterar</button>
                    </div>
                </div>
                
        </form>
    </div>
@endsection