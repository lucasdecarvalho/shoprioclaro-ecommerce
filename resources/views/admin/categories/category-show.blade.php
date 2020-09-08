@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Detalhes do Produto</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary float-right mb-4" href="{{ route('admin.index') }}"> Voltar</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $admin->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $admin->details }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fotos:</strong>
                <div class="col">
                    <img src="{{ asset($admin->image1) }}" alt="" style="width:240px !important;height:auto !important;float:left;margin-right:2px;">
                    <img src="{{ asset($admin->image2) }}" alt="" style="width:240px !important;height:auto !important;float:left;margin-right:2px;">
                    <img src="{{ asset($admin->image3) }}" alt="" style="width:240px !important;height:auto !important;float:left;margin-right:2px;">
                </div>
            </div>
        </div>
    </div>
@endsection