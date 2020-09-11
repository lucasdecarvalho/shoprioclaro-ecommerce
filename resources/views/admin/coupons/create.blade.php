@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Cupons de Desconto</h6>
            </div>
        </div>
    </div>
   
    <div class="col-12 p-4 bg-white border border-top-0 rounded-bottom">

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

        <form action="{{ route('coupons.store') }}" method="POST">
            @csrf
        
            <div class="row">
                <div class="col-12">
                    
                    <div class="form-row">
                        <div class="form-group col-12 col-xl-6">
                            <label for="cod">Código:</label>
                            <input type="text" name="cod" class="form-control text-uppercase" maxlength="8" id="cod" required>
                        </div>
                        <div class="form-group col-12 col-xl-6">
                            <label for="discount">Desconto (%):</label>
                            <input type="number" maxlength="2" name="discount" class="form-control" id="discount" required>
                        </div>
                    </div>
                
                    <div class="form-row">
                        <div class="form-group col-12 text-right">
                            <a class="btn btn-secondary" href="{{ route('coupons.index') }}"> Voltar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                
                </div>
            </div>
        
        </form>
    </div>

@endsection