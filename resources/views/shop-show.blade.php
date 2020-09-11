@extends('layouts.app')
@section('content')

   <!-- Content -->
   <div class="container">
      <div class="card">
         <div class="container-fliud">
            <div class="wrapper row">
               <div class="preview col-md-6">
                  
                  <div class="preview-pic tab-content">
                     <div class="tab-pane active" id="pic-1"><img src="{{ asset($product->image1 ?? 'images/no-image.png' ) }}" /></div>
                     <div class="tab-pane" id="pic-2"><img src="{{ asset($product->image2 ?? 'images/no-image.png' ) }}" /></div>
                     <div class="tab-pane" id="pic-3"><img src="{{ asset($product->image3 ?? 'images/no-image.png' ) }}" /></div>
                  </div>
                  <ul class="preview-thumbnail nav nav-tabs">
                     <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{ asset($product->image1 ?? 'images/no-image.png' ) }}" /></a></li>
                     <li><a data-target="#pic-2" data-toggle="tab"><img src="{{ asset($product->image2 ?? 'images/no-image.png' ) }}" /></a></li>
                     <li><a data-target="#pic-3" data-toggle="tab"><img src="{{ asset($product->image3 ?? 'images/no-image.png' ) }}" /></a></li>
                  </ul>
                  
               </div>
               <div class="details col-md-6 text-center text-xl-left">
                  <h3 class="product-title">{{ $product->name ?? null }}</h3>
                  <p class="product-description" style="text-align:justify !important;">{{ $product->caption ?? null }} {{ $product->details ?? null }}</p>
                  <h4 class="price">R$ {{ number_format($product->price,2,",",".") }}</h4>
                  <div class="col-12 col-xl-6 p-0">
                     <form action="{{ route('cart.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button type="submit" class="btn btn-success w-100">Adicionar ao carrinho</button>
                     </form>
                     <!-- <button class="btn btn-secondary" type="button"><span class="fa fa-heart"></span></button> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Content end -->
   
   <!-- Container -->
   <div class="container">

      <div class="card-group mt-4 mb-4">
         <div class="row">
            <h4 class="w-100 m-2 text-center">Produtos Relacionados</h4>

               @foreach ($related as $prod)

               <div class="col-6 col-md-3">
                  <div class="card text-center p-0 rounded-0">
                     <a href="{{ route('shop.show',[$prod->category,$prod->id]) }}">
                        <img class="card-img-top p-1 bg-white" style="width:100%;height:auto;margin: 0 auto;" src="{{ asset($prod->image1 ?? 'images/no-image.png') }}" alt="{{ $prod->name ?? null }}">
                     </a>
                     <div class="card-body bg-white" style="min-height:130px;">
                        <h5 class="card-title font-weight-bold">{{ $prod->name ?? null }}</h5>
                     </div>
                     <div class="card-footer text-dark border-top-0">
                        <!-- <small>De: R$ 1.290,90</small> -->
                        <h4 class="card-text">R$ {{ number_format($prod->price,2,",",".") }}</h4>
                     </div>
                  </div>
               </div>
               
               @endforeach

         </div>
      </div>
      
   </div>
   <!-- Container -->

@endsection