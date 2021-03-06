@extends('layouts.app')
@section('content')

        <div class="container mb-4">
            <div class="card text-center">
                <div class="card-header">
                    Erro!
                </div>
                <div class="card-body">
                    <h5 class="card-title">Não foi possivel realizar seu pagamento</h5>
                    <p class="card-text">{{ $error->getMessage() }}</p>
                    <a href="#" class="btn btn-primary">Código: {{ $error->getCode() }}</a>
                </div>
                <div class="card-footer text-muted">
                    {{ @date('d/m/Y') }}
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
@endsection