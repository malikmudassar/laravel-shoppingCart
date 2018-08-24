<?php

namespace App\Http\Controllers;

use App\Pages;
use App\Product;
use App\Cart;
use App\Order;
use App\countries;
use App\cities;
use Image;
use Session;
use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages=Pages::all();
        return view('backend.pages.cms.index')->with('pages',$pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.cms.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:1|max:191|regex:/^[\pL\s\-]+$/u',
            'slug' => 'required|min:1|max:191|regex:/^[\pL\-]+$/u',
            'description'=> 'required'            
        ]);

        $Page=new Pages;
        $Page->name= $request->input('name');
        $Page->slug= $request->input('slug');
        $Page->description= $request->input('description');

        
        $Page->save();

        return redirect('/admin/pages')->with('success','Page Added Successfully');
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
        $page=Pages::find($id);
        return view('backend.pages.cms.edit')->with('page',$page);
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

        $this->validate($request, [
            'name' => 'required|min:1|max:191|regex:/^[\pL\s\-]+$/u',
            'slug' => 'required|min:1|max:191|regex:/^[\pL\-]+$/u',
            'description'=> 'required'
        ]);

        $this->validate($request, [
            'name'      =>      'required',
            'slug'      =>  'required',
            'description'=> 'required'            
        ]);

        $Page=Pages::find($id);
        $Page->name= $request->input('name');
        $Page->slug= $request->input('slug');
        $Page->description= $request->input('description');

        
        $Page->save();

        return redirect('/admin/pages')->with('success','Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page=Pages::find($id);
        //return $product;
        $page->delete();

        return redirect('/admin/pages')->with('success','Page Deleted Successfully');
    }


    // Footer Links

    public function aboutUs()
    {
        $page=Pages::find(1);
        return view('frontend.pages.page')->with('page',$page);
    }

    public function howItWorks()
    {
        $page=Pages::find(2);
        return view('frontend.pages.page')->with('page',$page);   
    }

    public function payment()
    {
        $page=Pages::find(5);
        return view('frontend.pages.page')->with('page',$page);   
    }

    public function recipe() {
        $page=Pages::find(11);
        return view('frontend.pages.page')->with('page',$page);      
    }

    public function breeder() {
        $page=Pages::find(12);
        return view('frontend.pages.page')->with('page',$page);      
    }

    public function faq() {
        $page=Pages::find(8);
        return view('frontend.pages.page')->with('page',$page);      
    }

    public function press() {
        $page=Pages::find(13);
        return view('frontend.pages.page')->with('page',$page);      
    }

    public function getCities(Request $request){
        $country=$request->country;
        $cities=cities::where('country_id', $country)->get();
        return json_encode($cities);
    }  
}