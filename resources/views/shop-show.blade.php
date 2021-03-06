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
                  <h4 class="product-title">{{ $product->name ?? null }}</h4>
                  
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Especificações</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Descrição</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     </div>
                     <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p class="product-description" style="text-align:justify !important;">{{ $product->caption ?? null }} {{ $product->details ?? null }}</p>
                     </div>
                  </div>

                  <div class="col-12 col-xl-6 p-0">
                     <h4 class="price">R$ {{ number_format($product->price,2,",",".") }}</h4>
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

      <div class="card-group mt-4 mb-3">
      <h4 class="w-100 text-center">Produtos Relacionados</h4>
      <div class="row pl-2 pr-2">

            @foreach ($related as $prod)

            <div class="col-6 col-md-3 pl-2 pr-2">
               <div class="card text-center p-0">
                  <a href="{{ route('shop.show',[$prod->category,$product->id]) }}">
                     <img class="card-img-top w-100 mx-auto" src="{{ asset($prod->image1 ?? 'images/no-image.png') }}" alt="{{ $prod->name ?? null }}">
                  </a>
                  <div class="card-body overflow-hidden" style="height:90px;">
                     <p class="card-title">{{ $prod->name ?? null }}</p>
                  </div>
                  <div class="card-footer">
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