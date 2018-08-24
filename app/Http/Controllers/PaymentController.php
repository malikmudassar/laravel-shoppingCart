<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paymentMethods;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment=paymentMethods::find(1);
        return view('backend.payment.index')->with('payment', $payment);
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
        $request->validate([
            'paypal_email' => 'required|email',
            'i_bonifico'   => 'required|min:3|max:191|regex:/^[\pL\s\-]+$/u',
            'iban'         => 'required|min:11|max:191|regex:/(^[A-Za-z0-9\- ]+$)+/'
        ]);

        $payment=paymentMethods::find(1);
        $method=$request->input('method');
        if(in_array('card',$method)) {
            $payment->card='yes';
        }
        else{
            $payment->card='no';
        }
        if(in_array('paypal',$method)) {
            $payment->paypal='yes';
        }
        else{
            $payment->paypal='no';
        }
        if(in_array('bank',$method)) {
            $payment->bank='yes';
        }
        else{
            $payment->bank='no';
        }
        if(in_array('cod',$method)) {
            $payment->cod='yes';
        }
        else{
            $payment->cod='no';
        }
        $payment->email_paypal=$request->input('paypal_email');
        $payment->ibonifico=$request->input('i_bonifico');
        $payment->iban=$request->input('iban');
        $payment->save();

        return redirect()->route('admin::payment.index')->with('success', 'Payment method Updated');
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
