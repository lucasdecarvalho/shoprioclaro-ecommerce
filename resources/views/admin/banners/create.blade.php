@extends('layouts.admin')
@section('content')

    <div class="col-12 border bg-light rounded-top">
        <div class="row">
            <div class="col-12 col-xl-6 p-2 p-xl-4">
                <h6 class="text-uppercase text-center text-xl-left font-weight-bold pt-2">Banners</h6>
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

        <form class="col-12" action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="row">
                <div class="col-12">

                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="file-upload">Banner:</label><br>
                            <input id="file-upload" type="file" name="fileUpload1" accept="image/*" onchange="readURL(this);" required>
                        </div>
                        <div class="col-12 mt-2 mb-4 p-2 border-bottom"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12 col-xl-6">
                            <label for="title">Título (opcional):</label>
                            <input type="text" name="title" class="form-control" maxlength="45" id="title">
                        </div>
                        <div class="form-group col-12 col-xl-6">
                            <label for="place">Localização:</label>
                            <select class="form-control" name="place" id="place" required>
                                <option value="">Selecione...</option>
                                    <option value="1">Topo Home</option>
                                    <option value="2">Meio Home</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-xl-6">
                            <label for="target">Link (opcional):</label>
                            <input type="text" name="target" class="form-control" id="target" placeholder="exemplo: http://www.site.com.br">
                        </div>
                        <div class="form-group col-12 col-xl-6">
                            <label for="caption">Descrição (opcional):</label>
                            <input type="text" name="caption" class="form-control" maxlength="255" id="caption">
                        </div>
                    </div>
                
                    <div class="form-row">
                        <div class="form-group col-12 text-right">
                            <a class="btn btn-secondary" href="{{ route('banners.index') }}"> Voltar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                
                </div>
            </div>
        
        </form>
    </div>
    
@endsection