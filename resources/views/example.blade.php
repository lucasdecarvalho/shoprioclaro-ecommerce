@extends('layouts.app')
@section('content')
   <?php $i = 1; ?>
   <!-- Slider -->
   @if(!!$fbt)
   <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            @if(!empty($fbt->target)) <a href="{{ $fbt->target }}"> @endif
               <img class="d-block w-100" src="{{ asset($fbt->path) }}" alt="{{ $fbt->title }}">
            @if(!empty($fbt->target)) </a> @endif
         </div>
         @foreach ($banners as $banner)
            @if ($banner->place == 1 && $banner->path !== $fbt->path)
               <div class="carousel-item">
                  @if(!empty($banner->target)) <a href="{{ $banner->target }}"> @endif
                     <img class="d-block w-100" src="{{ asset($banner->path) }}" alt="{{ $banner->title }}">
                  @if(!empty($banner->target)) </a> @endif
               </div>
            @endif
         @endforeach
         <ol class="carousel-indicators">

            @foreach ($banners as $banner)

               @if ($banner->place == 1 && $banner->path == $fbt->path)
                  <li data-target="#carouselExampleControls1" class="pt-2 pb-3 rounded-circle active" data-slide-to="{{ ++$i }}"></li>
               @endif
               @if ($banner->place == 1 && $banner->path !== $fbt->path)
                  <li data-target="#carouselExampleControls1" class="pt-2 pb-3 rounded-circle" data-slide-to="{{ ++$i }}"></li>
               @endif
            
            @endforeach

         </ol>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
      </a>
   </div>
   @endif
   <!-- Slider end -->
   <!-- Container -->
   <div class="container">

      <div class="card-deck mt-4 mb-4">
         <h2 class="w-100 m-2 text-center">DESTAQUES</h2>

         @foreach ($pr as $product)
         <div class="col-12 col-md-3 m-0 p-0 rounded-0 mx-0">
            <div class="card text-center bg-white p-0 rounded-0">
               <a href="{{ route('shop.show',[$product->category,$product->id]) }}">
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
      <!-- Slider -->
      @if(!!$fbb)
      <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               @if(!empty($fbb->target)) <a href="{{ $fbb->target }}"> @endif
                  <img class="d-block w-100" src="{{ asset($fbb->path) }}" alt="{{ $fbb->title }}">
                  @if(!empty($fbb->target)) </a> @endif
            </div>
            @foreach ($banners as $banner)
               @if ($banner->place == 2 && $banner->path !== $fbb->path)
                  <div class="carousel-item">
                        @if(!empty($banner->target)) <a href="{{ $banner->target }}"> @endif
                        <img class="d-block w-100" src="{{ asset($banner->path) }}" alt="{{ $banner->title }}">
                        @if(!empty($banner->target)) </a> @endif
                  </div>
               @endif
            @endforeach
            <ol class="carousel-indicators">

               @foreach ($banners as $banner)
                  @if ($banner->place == 2 && $banner->path == $fbb->path)
                     <li data-target="#carouselExampleControls2" class="pt-2 pb-3 rounded-circle active" data-slide-to="{{ ++$i }}"></li>
                  @endif
                  @if ($banner->place == 2 && $banner->path !== $fbb->path)
                     
                     <li data-target="#carouselExampleControls2" class="pt-2 pb-3 rounded-circle" data-slide-to="{{ ++$i }}"></li>
                  @endif
               
               @endforeach

            </ol>
         </div>
         <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
      @endif
      <!-- Slider end -->
   <!-- Container -->
   </div>

   <div class="container">
      <div class="card-deck mt-2 mb-4">

      <div class="col-12 col-md-4 m-0 p-0 rounded-0 mx-0">
         <div class="card border-0 p-0">
            <a href="details">
            <img class="card-img-top" src="{{ asset('images/202009082036071.jpg') }}" alt="Card image cap">
            </a>
            <div class="card-body">
               <h5 class="card-title">Card title</h5>
               <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
               <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit">Cadastre-se</button>
            </div>
         </div>
         </div>

         <div class="col-12 col-md-4 m-0 p-0 rounded-0 mx-0">
         <div class="card border-0 p-0">
            <a href="details">
            <img class="card-img-top" src="{{ asset('images/202009082036071.jpg') }}" alt="Card image cap">
            </a>
            <div class="card-body">
               <h5 class="card-title">Card title</h5>
               <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
               <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit">Saiba mais</button>
            </div>
         </div>
         </div>

         <div class="col-12 col-md-4 m-0 p-0 rounded-0 mx-0">
         <div class="card border-0 p-0">
            <a href="details">
            <img class="card-img-top" src="{{ asset('images/202009082036071.jpg') }}" alt="Card image cap">
            </a>
            <div class="d-hover card-body">
               <h5 class="card-title">Card title</h5>
               <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
               <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit">SAIBA MAIS</button>
            </div>
         </div>
         </div>

      </div>
   </div>
   <!-- Content end -->

@endsection
