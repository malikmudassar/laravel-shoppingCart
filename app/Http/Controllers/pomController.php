<?php

namespace App\Http\Controllers;
use App\Product;
use App\Pom;
use Illuminate\Http\Request;

class pomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pom=Pom::all();
        $products=Product::orderBy('created_at','desc')->paginate(100);
        return view('backend.pom.index',['products'=> $products, 'pom' => $pom]);
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
        $offer=new Pom;
        $offer->productId=$request->input('productId');
        $offer->save();

        return redirect('/admin/pom')->with('success','Prodotto aggiunto correttamente');
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
        $pom=Pom::orderBy('created_at','desc')->paginate(3);
        foreach ($pom as $offer){
            $offer->product = Product::find($offer->productId);
        }
        return view('frontend.pages.pom')->with('pom',$pom);
    }

    public function remove($id)
    {
        $pom=Pom::where('productId',$id)->first();
        //return $pom;
        $pId=$pom->id;
        $product=Pom::find($pId);
        $product->delete();

        return redirect('/admin/pom')->with('success','Prodotto unselected');
    }
}
