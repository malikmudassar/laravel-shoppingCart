<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Mail;
use App\countries;
use App\Mail\ProfileUpdate;
use App\Order;
use App\ShippingClasses;
use App\ShippingZones;
use App\UserPaymentCard;
use App\paymentMethods;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $zones=ShippingZones::all();
        foreach($zones as $zone) {
            $zone->classes=ShippingClasses::where('zone',$zone->id)->paginate(50);
        }
        $user=Auth::user();
        $user->zone=ShippingClasses::find($user->shipping_class);
        $payment=paymentMethods::find(1);
    	return view('frontend.pages.profile')->with([
                    'user'  => $user,
                    'zones' => $zones,
                    'payment'=> $payment
                ]);;
    }

    public function orders()
    {
    	$orders=Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

    	foreach ($orders as $order){
    		$order->cart=unserialize($order->cart);
    		$order->cart->shipment_price = $order->shipment_price;
    	}
		
    	return view('frontend.pages.orders')->with('orders',$orders);
    }

    public function edit()
    {   
        $user=Auth::user();
        $zones=ShippingZones::all();
        foreach($zones as $zone) {
            $zone->classes=ShippingClasses::where('zone',$zone->id)->paginate(50);
        }
        $payment=paymentMethods::find(1);
        $names=countries::all();
        $countries=countries::all();
        return view('frontend.pages.editprofile')
                ->with([
                    'user'  => $user,
                    'zones' => $zones,
                    'payment' => $payment,
                    'countries'=> $countries
                ]);
    }

    public function update(Request $request)
    {
        $user=User::find(Auth::user()->id);

        $user->name=$request->input('name');
        if(!empty($request->input('password'))){
            $user->password=bcrypt($request->input('password'));    
        }        
        $user->add_ship1=$request->input('add_ship1');
        $user->add_ship_country=$request->input('add_ship_country');
        $user->add_ship_city=$request->input('add_ship_city');
        $user->shipping_class=$request->input('shipping_class');
        $user->add_bill1=$request->input('add_bill1');
        $user->add_bill_country=$request->input('add_bill_country');
        $user->add_bill_city=$request->input('add_bill_city');
        $user->add_ship_province=$request->input('add_ship_province');
        $user->add_ship_cap=$request->input('add_ship_cap');
        $user->add_bill_province=$request->input('add_bill_province');
        $user->add_bill_cap=$request->input('add_bill_cap');
        if(!empty($request->input('payment_type'))) {
            $user->payment_type=$request->input('payment_type');    
        }
        else {
            $user->payment_type=Auth::user()->payment_type;
        }
        

        $user->save();

        if(Auth::user()->payment_type=='card'){
            if(Auth::user()->payment_card){
                $card=UserPaymentCard::find(Auth::user()->payment_card->id);
                $card->card_number=$request->input('card_number');
                $card->name=$request->input('card_name');
                $card->expiry=$request->input('card_expiry');
                $card->cvv=$request->input('card_cvv');
                $card->save();                
            }
            else
            {
                $card=new UserPaymentCard;
                $card->user_id=Auth::user()->id;
                $card->card_number=$request->input('card_number');
                $card->expiry=$request->input('card_expiry');
                $card->cvv=$request->input('card_cvv');
                $card->name=$request->input('card_name');
                $card->save();                   
            }
            
        }
        Mail::to(Auth::user()->email)->send(new ProfileUpdate);
        return redirect()->route('profile')->with('success','Profilo aggiornato con successo');

    }

    public function subscription()
    {
    	return view('frontend.pages.subscriptions');
    }
}
