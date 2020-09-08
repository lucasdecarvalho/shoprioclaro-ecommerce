<?php

namespace App\Http\Controllers;


use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $catg = Category::where('path', $slug)
                            ->firstOrFail('id');

        $products = Product::whereIn('category', $catg)->get();

        $getCatg = Category::where('path',$slug)->first('title');
        $title = $getCatg["title"];
        
        return view('shop',compact('title','slug','products'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $productId) 
    {
        $catg = Category::where('path', $slug)
        ->firstOrFail('id');
        
        $product = Product::where('category', $catg->id)
        ->where('id', $productId)
        ->firstOrFail();
        
        $related = Product::all()->random('4');
                    
            foreach ($related as $r) {
                
                $ca = Category::where('id',$r->category)->get();

                foreach ($ca as $rr) {
                    $r->category = $rr->path;
                }
            }
            
        return view('shop-show',compact('product','related'));
    }

}