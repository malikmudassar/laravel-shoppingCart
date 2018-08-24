<?php

namespace App\Http\Controllers;

use App\Product;
use App\Offer;
use Illuminate\Http\Request;

class offerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers=Offer::all();
        $products=Product::orderBy('created_at','desc')->paginate(10);
        return view('backend.offer.index',['products'=> $products, 'offers'=>$offers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offer=new Offer;
        $offer->productId=$request->input('productId');
        $offer->save();

        return redirect('/admin/offers')->with('success','Prodotto aggiunto correttamente');
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
        $offers=Offer::orderBy('created_at','desc')->paginate(3);
        foreach ($offers as $offer){
            $offer->product = Product::find($offer->productId);
        }
        return view('frontend.pages.offers')->with('offers',$offers);
    }

    public function remove($id)
    {
        $pom=Offer::where('productId',$id)->first();
        //return $pom;
        $pId=$pom->id;
        $product=Offer::find($pId);
        $product->delete();

        return redirect('/admin/offers')->with('success','Prodotto unselected');
    }
}
