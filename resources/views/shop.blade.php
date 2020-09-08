@extends('layouts.app')
@section('content')

   <!-- Content -->
   <div class="container">
      <div class="card-deck mt-4 mb-4">
         <h2 class="w-100 m-2 text-center">{{ $title }}</h2>

         @foreach ($products as $product)
         <div class="col-12 col-xl-3">
            <div class="card text-center">
               <a href="{{ route('shop.show',[$slug,$product->id]) }}">
               <img class="card-img-top" style="width:auto;height:140px;margin: 0 auto;" src="{{ asset($product->image1 ?? 'images/no-image.png') }}" alt="{{ $product->name ?? null }}">
               </a>
               <div class="card-body" style="height:140px;">
                  <h5 class="card-title">{{ $product->name ?? null }}</h5>
                  <!-- <p class="card-text">{{ $product->details ?? null }}</p> -->
                  <p class="card-text">R$ {{ number_format($product->price,2,",",".") }}</p>
               </div>
            </div>
         </div>
         @endforeach

      </div>
   </div>
   <!-- Content end -->

@endsection