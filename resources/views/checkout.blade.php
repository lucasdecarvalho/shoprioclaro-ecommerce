@extends('layouts.app')
@section('content')

<section class="container p-4">
    @if (Cart::count() > 0)

   <div class="row mt-2 mb-2 text-center text-xl-left">
      <div class="col-12 col-xl-6">
         <h4><i class="fas fa-money-check-alt mr-2"></i><span>Checkout</span></h4>
      </div>
      <div class="col-12 col-xl-6 text-center text-xl-right">
            <p><i class="fas fa-lock"></i> Compra segura</p>
      </div>
   </div>

   <!-- avisos -->
   <div class="row">
      <div class="col-12 p-0">
            @if (session()->has('success_message'))
            <div class="alert alter-success bg-white text-black border rounded text-center">
               {{ session()->get('success_message') }}
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alter-danger bg-danger text-white text-center">
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach 
               </ul>
               {{ session()->get('success_message') }}
            </div>
            @endif
      </div>
   </div>
   <!-- fim avisos -->

   <!-- content -->
   <div class="row">
      <!-- section -->
      <div class="col-12">
         
         <div class="row border rounded-top bg-light">
            <!-- cupom de desconto -->
            <div class="col-12 col-xl-6 mt-2 mb-2">
               <form class="w-100 float-left" action="{{ route('checkout.coupon') }}" method="POST">
                  @csrf
                  <input class="w-100 p-2 border rounded text-uppercase" type="text" name="cod" maxlength="8" placeholder="Cupom de desconto" value="@if(!!$shopc->fmt_final) {{ $coupon->cod ?? null }} @endif">
               </form>
            </div>
            <!-- valor do total -->
            <div class="col-12 col-xl-6 text-center text-xl-right">
               <h4 class="w-100 pt-3"><span style="font-size:.7em;">Total:</span> R$ {{ $shopc->fmt_final ?? $shop->fmt_final }}</h4>
               <p class="w-100 text-primary">@if(!!$shopc->message) {{ $shopc->message }} @endif</p>
            </div>
         </div>

         <div class="row border border-top-0 rounded-bottom bg-white">
            <div class="col-12 col-xl-6 d-none d-xl-block">
               <div class="row border-right">
                  <div class="col-12 p-3">
                  <h4>Dados da Entrega</h4>

                     @if (!!auth()->user())
                     <h6 class="mt-3"><b>Comprador(a):</b></h6>
                     <p><span>{{ auth()->user()->name ?? null }} {{ auth()->user()->lastname ?? null }}</span>
                           <br><span>{{ auth()->user()->doc ?? null }}</span></p>
                     
                     <h6><b>Contato:</b></h6>
                     <p><span>{{ auth()->user()->email ?? null }}</span>
                     <br><span>{{ auth()->user()->phone1 ?? null }}</span></p>

                     <h6><b>Endereço de entrega:</b></h6>
                     <p><span>{{ auth()->user()->street ?? null }}, 
                           {{ auth()->user()->number ?? null }}<br>
                           {{ auth()->user()->comp ?? null }}<br>
                           {{ auth()->user()->neigh ?? null }} - 
                           {{ auth()->user()->city ?? null }}/{{ auth()->user()->state ?? null }}<br>
                           CEP: {{ auth()->user()->zipcode ?? null }} -
                           {{ auth()->user()->country ?? null }}</span>
                     </p>
                     @else
                     <p class="w-100 mt-4 text-center">Para prosseguir, é preciso se logar.</p>
                     <a class="w-100 btn btn-info float-right mb-4 text-white" href="{{ route('client.index') }}"><i class="fas fa-sign-in-alt"></i> Login / Cadastro</a>
                     @endif
                  </div>                          
               </div>
            </div>
            <div class="col-12 col-xl-6">
               <div class="row">
                  <div class="col-12 p-3">
                  <h4>Forma de Pagamento</h4>
                     <div class="col-12">
                        <div class="row">
                           <button class="btn btn-light active mr-1">Cartão de Crédito</button>
                           <!-- <form action="{{ route('checkout.payer') }}" method="POST">
                              @csrf
                              <input type="hidden" name="fpag" value="debito">
                              <button class="btn btn-light">Débito</button>
                           </form> -->
                           <button class="btn btn-light" data-toggle="modal" data-target="#exampleModalCenter">Boleto Bancário</button>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 pb-2">
                     <!-- form credit -->
                     <form class="needs-validation" action="{{ route('checkout.payer') }}" method="POST">
                        @csrf
                        <input type="hidden" name="fpag" value="credit">
                        <div class="row">
                           <div class="col-12 col-xl-6 mb-2">
                              <select class="form-control" name="flag" id="flag" required>
                                    <option value="">Bandeira:</option>
                                    <option value="elo">Elo</option>
                                    <option value="dinners">Dinners</option>
                                    <option value="mastercard">Mastercard</option>
                                    <option value="visa">Visa</option>
                              </select>
                           </div>
                           <div class="col-12 col-xl-6 mb-2">
                              <select class="form-control" name="installments" id="installments" required>
                              <option value="">Parcelamento:</option>
                              <option value="1">À vista</option>
                              <option value="2">Parcelar em 02x</option>
                              <option value="3">Parcelar em 03x</option>
                              <option value="4">Parcelar em 04x</option>
                              <option value="5">Parcelar em 05x</option>
                              <option value="6">Parcelar em 06x</option>
                              <option value="7">Parcelar em 07x</option>
                              <option value="8">Parcelar em 08x</option>
                              <option value="9">Parcelar em 09x</option>
                              <option value="10">Parcelar em 10x</option>
                              <option value="11">Parcelar em 11x</option>
                              <option value="12">Parcelar em 12x</option>
                              </select>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 mb-2">
                              <input type="text" name="numberCard" class="form-control ccnumber" id="cc-number" placeholder="Número do cartão:" required>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-6 mb-2 pr-0">
                              <input type="text" name="date" class="form-control exp" id="cc-expiration" placeholder="_ _ / _ _ _ _" required>
                           </div>
                           <div class="col-6 mb-2">
                              <input type="text" name="cvv" class="form-control cvv" id="cc-cvv" placeholder="CVV:" required>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 mb-2">
                              <input type="text" name="holder" class="form-control" id="cc-name" maxlength="65" placeholder="Nome completo (como impresso no cartão):" required>
                              <!-- <small class="text-muted"></small> -->
                           </div>
                           <!-- <div class="col-12 mb-2">
                              <input type="number" name="doc" class="form-control" id="cc-number" placeholder="CPF:" required>
                           </div> -->
                        </div>
                        <div class="row">
                           <div class="col-12">
                              <button class="btn btn-primary btn-block" type="submit"><i class="far fa-credit-card"></i> Efetuar Pagamento</button>
                           </div>
                        </div>
                     </form>
                  </div> <!-- fim form credit -->
               </div>
            </div>
         </div>
      </div> <!-- fim section -->
   </div> <!-- fim content -->

   @else

   <div class="row">
      <div class="col-12">
            <p class="w-100 mt-3 p-2 border rounded text-center">Não tem produtos em seu carrinho.<br>
            <a href="{{ route('index') }}">Volte às compras</a></p>
      </div>
   </div>

   @endif
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="w-100 modal-title text-center" id="exampleModalLongTitle">Pagamento via Boleto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p>Clique no botão abaixo para gerar sua fatura no valor de  <b>R$ {{ $shopc->fmt_final ?? $shop->fmt_final }}</b>:</p>
        <form action="{{ route('checkout.payer') }}" target="_blank" method="POST">
            @csrf
            <input type="hidden" name="fpag" value="boleto">
            <button type="submit" class="btn btn-primary">Gerar Boleto</button>
         </form>
      </div>
      <div class="modal-footer text-center">
         <small class="w-100 text-center"><i class="fas fa-info-circle text-secondary"></i> Obs: o boleto abrirá em uma nova aba do seu navegador.</small>
      </div>
    </div>
  </div>
</div>

@endsection