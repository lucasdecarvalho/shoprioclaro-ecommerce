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

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p class="p-0 m-0 text-center">{{ $message }}</p>
            </div>
        @endif

        <div class="table-responsive">

            <form class="col-12" action="{{ route('categories.update',$category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="col-12">
                    
                    <div class="form-row">
                        <div class="form-group col-12 col-xl-6">
                            <label for="title">Título:</label>
                            <input type="text" name="title" value="{{ $category->title }}" class="form-control" id="title" maxlength="45" required>
                        </div>
                        <div class="form-group col-12 col-xl-6">
                            <label for="path">Caminho:</label>
                            <input type="text" name="path" value="{{ $category->path }}" class="form-control" maxlength="45" id="path" required>
                        </div>
                    </div>

                    <!-- <div class="form-row">
                        <div class="form-group col-12 col-xl-12">
                            <label for="tag">Tag:</label>
                            <input type="text" name="tag" value="{{ $category->tag }}" class="form-control" id="tag">
                        </div>
                    </div> -->
                
                    <div class="form-row">
                        <div class="form-group col-12 text-right">
                            <a class="btn btn-secondary" href="{{ route('categories.index') }}">Voltar</a>
                            <button type="submit" class="btn btn-primary">Alterar</button>
                        </div>
                    </div>
                
                </div>
        
            </form>

        </div>
    </div>
@endsection