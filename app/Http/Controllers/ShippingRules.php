<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\countries;
use App\ShippingRulesModel;

class ShippingRules extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries=countries::all();
        $rules=ShippingRulesModel::all();
        return view('backend.shipping.rules.index')
        ->with([
            'countries' => $countries,
            'rules' => $rules
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=countries::all();
        return view('backend.shipping.rules.create')->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule=new ShippingRulesModel;

        $rule->country=$request->input('country');
        $rule->rule_type=$request->input('rule_type');
        $rule->city=$request->input('city');
        $rule->cap=$request->input('cap');
        $rule->min_cap=$request->input('min_cap');
        $rule->max_cap=$request->input('max_cap');
        $rule->province=$request->input('province');
        $rule->min_weight=$request->input('min_weight');
        $rule->max_weight=$request->input('max_weight');
        $rule->rate=$request->input('rate');
        $rule->rule_type=$request->input('rule_type');

        $rule->save();

        return redirect()->route('admin::shipping-rules.index')->with('success', 'Rule Added ');

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
        $rule=ShippingRulesModel::find($id);
        $rule->delete();

        return redirect()->route('admin::shipping-rules.index')->with('success', 'Rule Deleted');
    }
}
