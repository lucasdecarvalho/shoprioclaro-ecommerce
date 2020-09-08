@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12 margin-tb">
            <div class="pull-left">
                <h2>Detalhes do Produto</h2>
            </div>
        </div>
    </div>

<div class="row p-4 bg-white border rounded">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $product->details }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fotos:</strong>
                <div class="col">
                    <img src="{{ asset($product->image1) }}" alt="" style="width:240px !important;height:auto !important;float:left;margin-right:2px;">
                    <img src="{{ asset($product->image2) }}" alt="" style="width:240px !important;height:auto !important;float:left;margin-right:2px;">
                    <img src="{{ asset($product->image3) }}" alt="" style="width:240px !important;height:auto !important;float:left;margin-right:2px;">
                </div>
            </div>
        </div>
    </div>

</div>
@endsection