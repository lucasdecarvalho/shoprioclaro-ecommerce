<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Cart;
use App\User;
use App\Sold;
use FlyingLuscas\Correios\Client;
use FlyingLuscas\Correios\Service;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $correios = new Client;
        $done = [];
        
        $sale = Sold::all()->where('userId', auth()->user()->id)
                        ->where('success', true);
        
        foreach ($sale as $key => $shop)
        {
            $done[$key] = $shop;
            $done[$key]['cart'] = unserialize($shop->cart);
        }

        $end = $correios->zipcode()
                        ->find(auth()->user()->zipcode);

        return view('auth.index', compact('done','end'));
    }

    public function update(Request $request)
    {

        // dd($request);
        // $request->validate([
        //   'name' => 'required',
        //   'email' => 'required',
        // ]);

        User::where('id',$request->id)->first()->update($request->all());

        return redirect()->route('client.index')
                            ->with('success','Dados atualizados com sucesso!');
    }
    
}
