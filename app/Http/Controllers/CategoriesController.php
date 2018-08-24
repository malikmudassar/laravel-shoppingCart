<?php

namespace App\Http\Controllers;

use App\Categories;
use Image;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories=Categories::all();
        return view('backend.pages.cat.index')->with('categories', $Categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.cat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(request(), [
            'name'          => 'required|min:5|max:255|unique:categories',
            'description'   => 'required|min:5|max:5000',
            'weight'        => 'required|numeric|min:1|max:100000',
            'thumb'         => 'required'
        ]);

        $category = new Categories;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->weight=$request->weight;

        if($request->hasFile('thumb')){
            $image=$request->file('thumb');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(50,50)->save($location);
            $category->thumb=$filename;
        }
        $category->save();

        return redirect('/admin/categories/')->with('success','Category Added Successfully');
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
        $category=Categories::find($id);
        return view('backend.pages.cat.edit')->with('category',$category);
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
        $category=Categories::find($id);

        $this->validate(request(), [
            'name'          => 'required|min:5|max:255',
            'description'   => 'required|min:5|max:5000',
            'weight'        => 'required|numeric|min:1|max:100000',
//            'thumb'         => 'required'
        ]);

        $category->name=$request->name;
        $category->description=$request->description;
        $category->weight=$request->weight;
        if($request->hasFile('thumb')){
            $image=$request->file('thumb');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(50,50)->save($location);
            $category->thumb=$filename;
        }

        $category->save();

        return redirect('/admin/categories')->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Categories::find($id);
        $category->delete();
        return redirect('/admin/categories')->with('success','Category Deleted Successfully');
    }
}
