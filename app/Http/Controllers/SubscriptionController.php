<?php

namespace App\Http\Controllers;

use App\Subscription;
use Auth;
use Mail;
use App\Box;
use App\Product;
use App\Mail\ConfirmSubscription;
use App\Mail\removeSubscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Subscription=Subscription::where('user_id',Auth::user()->id)->paginate(10);
        foreach ($Subscription as $offer){
            $offer->box = Box::find($offer->box_id);
        }
        return view('frontend.pages.subscriptions')->with('subscriptions',$Subscription);
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
    public function save(Request $request)
    {   
        
        $Subscription=new Subscription;
        
        $Subscription->user_id=Auth::user()->id;
        $Subscription->card_type='Credit card';
        $Subscription->card_number=$request->input('card_number');
        $Subscription->expiry=$request->input('expiry');
        $Subscription->cvv=$request->input('cvv');
        $Subscription->name=$request->input('name');
        $Subscription->surname=$request->input('surname');
        $Subscription->address1=$request->input('address1');
        $Subscription->address2=$request->input('address2');
        $Subscription->province=$request->input('province');
        $Subscription->city=$request->input('city');
        $Subscription->country='Italia';
        $Subscription->box_id=$request->input('box_id');
        
        $Subscription->save();

        Mail::to(Auth::user()->email)->send(new ConfirmSubscription);

        return 'Data Saved';
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
        
    }


    public function delete(Request $request)
    {
        $Subscription=Subscription::where('user_id','=',Auth::user()->id)
                                    ->where('box_id','=',$request->input('box_id'));
        $Subscription->delete();
        Mail::to(Auth::user()->email)->send(new removeSubscription);
        return redirect()->route('subscription');
    }






}
