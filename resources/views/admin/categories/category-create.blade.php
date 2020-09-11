@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Categorias</h6>
            </div>
        </div>
    </div>
   
    <div class="col-12 p-4 bg-white border border-top-0 rounded-bottom">
   
        @if ($errors->any())
        <div class="alert alert-danger">
            Não foi possível efetuar o cadastro. Veja o motivo:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="col-12" action="{{ route('categories.store') }}" method="POST">
            @csrf
        
            <div class="row">
                <div class="col-12">

                    <div class="form-row">
                        <div class="form-group col-12 col-xl-6">
                            <label for="title">Título:</label>
                            <input type="text" name="title" class="form-control" maxlength="45" id="title" required>
                        </div>
                        <div class="form-group col-12 col-xl-6">
                            <label for="path">Caminho:</label>
                            <input type="text" maxlength="65" name="path" class="form-control" id="path" required>
                        </div>
                    </div>
                
                    <div class="form-row">
                        <div class="form-group col-12 text-right">
                            <input type="hidden" maxlength="1" name="tag" value="1">
                            <a class="btn btn-secondary" href="{{ route('categories.index') }}">Voltar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                
                </div>
            </div>
        </form>
    </div>
@endsection