<?php

namespace App\Http\Controllers;

use App\Product;
Use App\Box;
use Image;
use Illuminate\Http\Request;

class boxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Box::orderBy('created_at','desc')->get();
        return view('backend.box.index',['products'=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.box.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$this->validate($request, [
            'name' =>      'required|unique:boxes,name',
            'detail'    =>  'required',
            'weight'    =>  'required|numeric',
            'description'=> 'required',
            'price'     =>  'required|numeric'
        ]);
        
        $product=new Box;
        $product->name= $request->input('name');
        $product->details= $request->input('detail');
        $product->description= $request->input('description');
        $product->price= $request->input('price');
        $product->weight= $request->input('weight');
        $product->slug= $request->input('slug');

        if($request->hasFile('product_image')){
            $image=$request->file('product_image');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(600,400)->save($location);
            $product->image=$filename;
        }

        $product->save();

        return redirect('/admin/box')->with('success','Box Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Box::find($id);
        $products=Product::orderBy('created_at','desc')->paginate(3);
        return view('frontend.pages.product')->with(['product'=>$product, 'products'=>$products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Box::find($id);
        return view('backend.box.edit')->with('product',$product);
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
        $product=Box::find($id);
        $product->name= $request->input('name');
        $product->details= $request->input('detail');
        $product->description= $request->input('description');
        $product->price= $request->input('price');
        $product->slug= $request->input('slug');
        $product->weight= $request->input('weight');

        if($request->hasFile('product_image')){
            $image=$request->file('product_image');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $product->image=$filename;
        }

        $product->save();

        return redirect('/admin/box')->with('success','Box Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Box::find($id);
        //return $product;
        $product->delete();

        return redirect('/admin/box')->with('success','Box Deleted Successfully');
    }

    // Front End

    public function list()
    {
        $products=Box::orderBy('created_at','desc')->paginate(12);
        return view('frontend.pages.box')->with('products',$products);
    }

    public function getSingleBox($id)
    {
        $box=Box::find($id);
        return $box;
    }
}
