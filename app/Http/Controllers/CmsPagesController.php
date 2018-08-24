<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPages;
use App\Cart;
use App\Order;
use Image;
use Session;
use Auth;
use DB;
use Stripe\Charge;
use Stripe\Stripe;

class CmsPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pages=CmsPages::all();
        //echo '<pre>';print_r($pages);exit;        
        return view('backend.pages.cms.list')->with('pages',$pages);
    }

    public function list(){
        return '123';
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
            'name'      =>      'required',
            'slug'      =>  'required',
            'description'=> 'required'            
        ]);

        $Page=new CmsPages;
        $Page->name= $request->input('name');
        $Page->slug= $request->input('slug');
        $Page->description= $request->input('description');
        $Page->copyright= $request->input('copyright');
        $Page->keywords= $request->input('keywords');

        
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
}
