<?php

namespace App\Http\Controllers;

use App\Media;
use Image;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media=Media::find(1);
        return view('backend.pages.media.create')->with('media',$media);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $media=Media::find(1);
        $media->page='home';
        if($request->hasFile('image-1')){
            $image=$request->file('image-1');
            $filename=time().'image1.'.$image->getClientOriginalExtension();
            $location=public_path('images/media/'.$filename);
            Image::make($image)->resize(620,416)->save($location);
            $media->image1=$filename;
        }
        if($request->hasFile('image-2')){
            $image=$request->file('image-2');
            $filename=time().'image2.'.$image->getClientOriginalExtension();
            $location=public_path('images/media/'.$filename);
            Image::make($image)->resize(433,200)->save($location);
            $media->image2=$filename;
        }
        if($request->hasFile('image-3')){
            $image=$request->file('image-3');
            $filename=time().'image3.'.$image->getClientOriginalExtension();
            $location=public_path('images/media/'.$filename);
            Image::make($image)->resize(433,200)->save($location);
            $media->image3=$filename;
        }
        if($request->hasFile('box-avatar')){
            $image=$request->file('box-avatar');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/media/'.$filename);
            Image::make($image)->resize(350,235)->save($location);
            $media->video1=$filename;
        }
        if($request->hasFile('header')){
            $image=$request->file('header');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/media/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $media->header=$filename;
        }

        if($request->hasFile('lg_image1')){
            $image=$request->file('lg_image1');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/media/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $media->header=$filename;
        }

        if($request->hasFile('lg_image2')){
            $image=$request->file('lg_image2');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/media/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $media->header=$filename;
        }
        
        $media->save();

        return redirect()->route('admin::media.create')->with('success','Images Updated Successfully');
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
        $media=Media::find($id);
        
        if($request->hasFile('image-1')){
            $image=$request->file('image-1');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(620,675)->save($location);
            $media->image=$filename;
        }
        if($request->hasFile('image-2')){
            $image=$request->file('image-2');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(433,322)->save($location);
            $media->image=$filename;
        }
        if($request->hasFile('image-3')){
            $image=$request->file('image-3');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(433,322)->save($location);
            $media->image=$filename;
        }
        if($request->hasFile('box-avatar')){
            $image=$request->file('box-avatar');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(350,235)->save($location);
            $media->image=$filename;
        }
        if($request->hasFile('header')){
            $image=$request->file('header');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/products/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $media->image=$filename;
        }
        $media->page='home';
        $media->save();

        return redirect('/admin')->with('success','Images Updated Successfully');
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
