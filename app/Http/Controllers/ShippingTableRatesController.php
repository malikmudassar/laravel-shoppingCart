<?php

namespace App\Http\Controllers;
use App\ShippingClasses;
use App\ShippingZones;
use App\ShippingTableRates;
use Illuminate\Http\Request;

class ShippingTableRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones=ShippingZones::all();
        foreach($zones as $zone) {
            $zone->classes=ShippingClasses::where('zone',$zone->id)->paginate(50);
        }
        $rates=ShippingTableRates::all();

        if(!empty($rates)) {
            foreach($rates as $rate){
                $class=ShippingClasses::find($rate->shipping_class);
                if(!empty($class->name)) {
                    $rate->shipping_class_name=$class->name;
                }
            }
            return view('backend.shipping.rates.index')
                ->with([
                    'zones' =>  $zones,
                    'rates' =>  $rates
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=ShippingClasses::all();
        $zones=ShippingZones::all();
        foreach($zones as $zone) {
            $zone->classes=ShippingClasses::where('zone',$zone->id)->paginate(50);
        }
        
        return view('backend.shipping.rates.create')
                ->with([
                    'classes'   => $classes,
                    'zones'     => $zones
                ]);
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
            'shipping_class' => 'required',
            'min' => 'required|numeric|between:0,99999999999',
            'max' => 'required|numeric|between:0,99999999999',
            'rate' => 'required|numeric'
        ]);
        
        $rates=new ShippingTableRates;
        $rates->shipping_class=$request->input('shipping_class');
        $rates->min=$request->input('min');
        $rates->max=$request->input('max');
        $rates->rate=$request->input('rate');
        $rates->save();

        return redirect('admin/shipping-table-rates')->with('success', 'Rate added successfully');
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
        $rate=ShippingTableRates::find($id);
        if(!empty($rate)) {
            $rate->delete();
            return redirect('/admin/shipping-table-rates')->with('success', 'Rate Deleted Successfully');
        }
        return redirect('/admin/shipping-table-rates');
    }
}
