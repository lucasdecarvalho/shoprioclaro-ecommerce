@extends('layouts.app')
@section('content')

   <!-- Container -->
   <div class="container">

      <div class="card-group mt-4 mb-3">
         <h4 class="w-100 text-center">Palavra-chave: {{ $keyword }}</h4>
         <div class="row">

               @foreach ($result as $res)

               <div class="col-6 col-md-3">
                  <div class="card text-center p-0">
                     <a href="{{ route('shop.show',[$res->category,$res->id]) }}">
                        <img class="card-img-top w-100 mx-auto" src="{{ asset($res->image1 ?? 'images/no-image.png') }}" alt="{{ $res->name ?? null }}">
                     </a>
                     <div class="card-body overflow-hidden" style="height:90px;">
                        <p class="card-title">{{ $res->name ?? null }}</p>
                     </div>
                     <div class="card-footer">
                        <h4 class="card-text">R$ {{ number_format($res->price,2,",",".") }}</h4>
                     </div>
                  </div>
               </div>
               
               @endforeach

         </div>
      </div>
      
   </div>
   <!-- Container -->

@endsection