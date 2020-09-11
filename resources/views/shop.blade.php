@extends('layouts.app')
@section('content')

   <!-- Content -->
   <div class="container">
      <div class="card-deck mt-4 mb-4">
         <h2 class="w-100 m-2 text-center">{{ $title }}</h2>

         @foreach ($products as $product)
         <div class="col-12 col-md-3 m-0 p-0 rounded-0 mx-0">
            <div class="card text-center bg-white p-0 rounded-0">
               <a href="{{ route('shop.show',[$slug,$product->id]) }}">
                  <img class="card-img-top p-2 bg-white" style="width:100%;height:auto;margin: 0 auto;" src="{{ asset($product->image1 ?? 'images/no-image.png') }}" alt="{{ $product->name ?? null }}">
               </a>
               <div class="card-body bg-white" style="height:85px;">
                  <h5 class="card-title font-weight-bold">{{ $product->name ?? null }}</h5>
               </div>
               <div class="card-footer text-dark border-top-0">
                  <!-- <small>De: R$ 1.290,90</small> -->
                  <h4 class="card-text">R$ {{ number_format($product->price,2,",",".") }}</h4>
               </div>
            </div>
         </div>
         @endforeach

      </div>
   </div>
   <!-- Content end -->

@endsection