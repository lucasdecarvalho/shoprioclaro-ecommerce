<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Shop;
use App\Product;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;

class CartController extends Controller
{ 

    public function index()
    {
        $correios = new Client;
        $shop = new Shop;
        $cupom = null;
        $zipcode = auth()->user()->zipcode ?? null;

        $ship = $correios->freight()
                        ->origin('13501-140') // endereço da loja
                        ->destination($zipcode) // endereço da entrega
                        ->services(Service::SEDEX) // serviços dos correios
                        ->item(11, 2, 16, .3, Cart::count()) // largura min 11, altura min 2, comprimento min 16, peso min .3 e quantidade
                        ->calculate();

        $shop->ship       = $ship[0]["price"];
    
        $price            = str_replace(',','',Cart::total());
        $tax              = str_replace(',','',Cart::tax());
        
        $shop->price      = str_replace(',','',Cart::subtotal());
        $shop->fmt_price  = number_format($shop['price'],2,',','.');
        $shop->fmt_ship   = number_format($shop['ship'],2,',','.');
        $shop->final      = number_format($shop['price'] + $shop['ship'],2,'','');
        $shop->fmt_final  = number_format($shop['price'] + $shop['ship'],2,',','.');
                
        return view('cart', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!!$request->zipcode)
        {
            $data = CartController::index();
            $correios = new Client;
            $shop = new Shop;

            $shop->fmt_price = $data->shop->fmt_price;

            $ship = $correios->freight()
                            ->origin('13501-140') // endereço da loja
                            ->destination($request->zipcode) // endereço da entrega
                            ->services(Service::SEDEX, Service::PAC) // serviços dos correios
                            ->item(11, 2, 16, .3, Cart::count()) // largura min 11, altura min 2, comprimento min 16, peso min .3 e quantidade
                            ->calculate();

            $shop->fmt_ship = number_format($ship[0]["price"],2,',','.');
            // dd($shop);

            return view('cart', compact('shop'));
        }

        if(!!$request->id)
        {

        Cart::add($request->id, $request->name, 1, $request->price)
            ->associate('App\Product');

            return redirect()->route('cart.index')->with('success_message', 'Item adicionado ao carrinho!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //                   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if($request->sub)
        {
            if($request->sub == "up")
            {
                $up = $request->qtd + 1;
            }
            else
            {
                $up = $request->qtd - 1;
            }
        
        Cart::update($id, $up); // Will update the quantity
        return back()->with('success_message', 'Quantidade alterada com sucesso');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message', 'Item removido do carrinho');
    }
}
