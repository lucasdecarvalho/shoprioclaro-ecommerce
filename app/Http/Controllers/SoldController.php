<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\User;
use App\Sold;

class SoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $done = [];        
        $sale = Sold::all();
        
        foreach ($sale as $key => $shop)
        {
            $done[$key] = $shop;
            $done[$key]['cart'] = unserialize($shop->cart);
        }

        $user = User::all()->where('id',$shop->userId)->first();
        
        return view('admin.sales.sales-list', compact('done','user'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sold $sale)
    {

        $done = [];        
        $saleN = Sold::all();

        foreach ($saleN as $key => $shop)
        {
            $done[$key] = $shop;
            $done[$key]['cart'] = unserialize($shop->cart);
        }

        $user = auth()->user()->where('id',$sale->userId)->first();

        return view('admin.sales.show',compact('sale','done','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sold $sale)
    {

        return view('admin.sales.edit',compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sold $sale)
    {
        $data = [
            'status'  => $request->status,
            'trackingNumber' => $request->trackingNumber,
        ];

        $sale->update($data);
  
        return redirect()->route('sales.index')
                        ->with('success','Dados alterados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
