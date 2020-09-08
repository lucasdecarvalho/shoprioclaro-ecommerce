@extends('layouts.app')
@section('content')

   <!-- Content -->
   <div class="container">
      <div class="card-deck mt-4 mb-4">
         <h2 class="w-100 m-2 text-center">Palavra-chave: {{ $keyword }}</h2>

         @foreach ($result as $res)
         <div class="col-12 col-xl-3">
            <div class="card text-center">
               <a href="{{ route('shop.show',[$res->category,$res->id]) }}">
               <img class="card-img-top" style="width:auto;height:140px;margin: 0 auto;" src="{{ asset($res->image1 ?? 'images/no-image.png') }}" alt="{{ $res->name ?? null }}">
               </a>
               <div class="card-body" style="height:140px;">
                  <h5 class="card-title">{{ $res->name ?? null }}</h5>
                  <!-- <p class="card-text">{{ $res->details ?? null }}</p> -->
                  <p class="card-text">R$ {{ $res->price ?? null }}</p>
               </div>
            </div>
         </div>
         @endforeach

      </div>
   </div>
   <!-- Content end -->

@endsection