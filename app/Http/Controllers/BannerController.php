<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();

        return view('admin.banners.banners-list',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banners = Banner::all();

        return view('admin.banners.create',compact('banners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fileUpload1' => 'image|mimes:jpeg,png,jpg,gif,svg',
       ]);

       if ($files = $request->file('fileUpload1')) {
           $destinationPath = 'images/banners/'; // upload path
           $profileImage1 = date('YmdHis') . "1." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage1);
           $image1 = $destinationPath.$profileImage1;
        }
        else {
            $image1 = null;
        }
        
        $data = [
            'place' => $request->place,
            'title'  => $request->title,
            'caption' => $request->caption,
            'path' => $image1,
            'code' => $request->code,
            'target' => $request->target,
            'status' => $request->status,
        ];

        Banner::create($data);
   
        return redirect()->route('banners.index')
                        ->with('success','Banner registrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
  
        return redirect()->route('banners.index')
                        ->with('success','Banner deletado com sucesso!');
    }
}
