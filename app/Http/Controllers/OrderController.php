<?php

namespace App\Http\Controllers;

use App\Order;
use Auth;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {

    }

    public function list() {
    	$orders=Order::orderBy('created_at', 'desc')->paginate(100);
    	foreach($orders as $order) {
    		$orders->user=User::find($order->user_id);
    	}
    	return view('backend.orders.list', ['orders' => $orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $order=Order::find($id);       
    	$order->cart=unserialize($order->cart);
        return view('backend.orders.show')->with(['order'=>$order]);
    }


    public function update(Request $request, $id)
    {
    	$order=Order::find($id);

    	$order->payment_status=$request->input('payment_status');
    	$order->shipment_status=$request->input('shipment_status');

    	$order->save();

    	return redirect('/admin/orders/all')->with('success','Order Updated');
    }
}
