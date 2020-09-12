@extends('layouts.app')
@section('content')
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
         <div class="d-none d-sm-block">
            <ol class="carousel-indicators">
               <?php $i = -1; ?>
               @foreach ($banners as $key => $banner)
               @if ($banner->place == 1 && $banner->path == $fbt->path)
               <li data-target="#carouselExampleControls1" class="pt-2 pb-3 rounded-circle active" data-slide-to="{{ ++$i }}"></li>
               @endif
               @if ($banner->place == 1 && $banner->path !== $fbt->path)
                     <li data-target="#carouselExampleControls1" class="pt-2 pb-3 rounded-circle" data-slide-to="{{ ++$i }}"></li>
                  @endif
               @endforeach
            </ol>
         </div>
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

      <div class="card-group mt-4 mb-3">
         <h4 class="w-100 text-center">DESTAQUES</h4>
         <div class="row pl-2 pr-2">

               @foreach ($pr as $product)

               <div class="col-6 col-md-3 pl-2 pr-2">
                  <div class="card text-center p-0">
                     <a href="{{ route('shop.show',[$product->category,$product->id]) }}">
                        <img class="card-img-top w-100 mx-auto" src="{{ asset($product->image1 ?? 'images/no-image.png') }}" alt="{{ $product->name ?? null }}">
                     </a>
                     <div class="card-body overflow-hidden" style="height:90px;">
                        <p class="card-title">{{ $product->name ?? null }}</p>
                     </div>
                     <div class="card-footer">
                        <h4 class="card-text">R$ {{ number_format($product->price,2,",",".") }}</h4>
                     </div>
                  </div>
               </div>
               
               @endforeach

         </div>
      </div>

      <!-- Slider -->
      @if(!!$fbb)
      <div id="carouselExampleControls2" class="carousel slide rounded" data-ride="carousel">
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
            <div class="d-none d-sm-block">
               <ol class="carousel-indicators">
                  <?php $i = -1; ?>
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
   </div>

   <div class="container">
      <div class="card-group mb-3">
         <div class="row pl-2 pr-2">

            <div class="col-12 col-md-4 pl-2 pr-2">
               <div class="card text-center p-0">
                  <img class="card-img-top" src="{{ asset('images/202009082036071.jpg') }}" alt="Card image cap">
                  <div class="card-body">
                     <h4 class="card-title">Newsletter</h4>
                     <p class="card-text">Receba um e-mail semanal com todas as nossas novidades.</p>
                     <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit"><i class="fas fa-envelope-open-text"></i> Assinar</button>
                  </div>
               </div>
            </div>

            <div class="col-12 col-md-4 pl-2 pr-2">
               <div class="card text-center p-0">
                  <img class="card-img-top" src="{{ asset('images/202009082036071.jpg') }}" alt="Card image cap">
                  <div class="card-body">
                     <h4 class="card-title">Sig@-nos!</h4>
                     <p class="card-text">Curta, comente e compartilhe! Postagens diárias nas redes sociais.</p>
                     <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit"><i class="fab fa-instagram"></i></button>
                     <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit"><i class="fab fa-facebook-square"></i></button>
                     <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit"><i class="fab fa-twitter"></i></button>
                     <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit"><i class="fab fa-youtube"></i></button>
                  </div>
               </div>
            </div>

            <div class="col-12 col-md-4 pl-2 pr-2">
               <div class="card text-center p-0">
                  <img class="card-img-top" src="{{ asset('images/202009082036071.jpg') }}" alt="Card image cap">
                  <div class="d-hover card-body">
                     <h4 class="card-title">Blog Sua Empresa</h4>
                     <p class="card-text">Acompanhe e participe do nosso conteúdo no blog <strong>Sua empresa</strong>.</p>
                     <button class="btn btn-outline-dark my-2 my-sm-0 text-uppercase" type="submit"><i class="fas fa-external-link-alt"></i> Acessar</button>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
   <!-- Content end -->

@endsection
