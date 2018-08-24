<?php

namespace App\Http\Controllers;

use App\Product;
use App\Classic;
use Illuminate\Http\Request;

class classicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classics=Classic::all();
        $products=Product::orderBy('created_at','desc')->paginate(100);
        return view('backend.classic.index',['products'=> $products, 'classics' => $classics]);
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
        $classic=new Classic;
        $classic->productId=$request->input('productId');
        $classic->save();

        return redirect('/admin/classic')->with('success','Prodotto aggiunto correttamente ');
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
        //
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

    // Front End

    public function list()
    {
        $classics=Classic::orderBy('created_at','desc')->paginate(3);
        foreach ($classics as $offer){
            $offer->product = Product::find($offer->productId);
        }
        return view('frontend.pages.classic')->with('classics',$classics);
    }

    public function remove($id)
    {
        $pom=Classic::where('productId',$id)->first();
        //return $pom;
        $pId=$pom->id;
        $product=Classic::find($pId);
        $product->delete();

        return redirect('/admin/classic')->with('success','Prodotto unselected');
    }
}
