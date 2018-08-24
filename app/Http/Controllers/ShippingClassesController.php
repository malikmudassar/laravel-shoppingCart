<?php

namespace App\Http\Controllers;
use App\ShippingClasses;
use App\ShippingZones;
use Illuminate\Http\Request;

class ShippingClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=ShippingClasses::all();
        foreach ($classes as $class) {
            $class->Zone=ShippingZones::find($class->zone);
        }
        return view('backend.shipping.classes.index')->with('classes', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones=ShippingZones::all();
        return view('backend.shipping.classes.create')->with('zones', $zones);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation_arr = [
            'name'  => 'required|min:3|max:191|unique:shipping_classes|regex:/^[\pL\s\-]+$/u'
        ];
        $rule = $request->input('rule');
        if(!isset($rule)) {
            $validation_arr['rule'] = 'required';
        }
        else {
            switch ($request->input('rule')) {
                case 'fixed':
                    $validation_arr['fixed_rate'] = 'required|numeric|between:0,9999.99';
                    break;
                case 'nation':
                    $validation_arr['town'] = 'required|min:5|max:255';
                    break;
                case 'town':
//                $validation_arr = ['fixed_rate' => 'numeric|between:0,9999.99'];
                    break;
                case 'cap_range':
                    $validation_arr['min_cap'] = 'required|numeric|between:0,99999999999';
                    $validation_arr['max_cap'] = 'required|numeric|between:0,99999999999';
                    break;
                case 'cap':
                    $validation_arr['cap'] = 'required|numeric|between:0,99999999999';
                    break;
                default:
                    $validation_arr['rule'] = 'required';
                    break;
            }
        }

        $this->validate(request(), $validation_arr);


        $class=new ShippingClasses;
        $class->name=$request->input('name');
        $class->zone=$request->input('zone');
        $class->rule_type=$request->input('rule');
        $class->fixed_rate=$request->input('fixed_rate');
        $class->town=$request->input('town');
        $class->min_cap=$request->input('min_cap');
        $class->max_cap=$request->input('max_cap');
        $class->cap=$request->input('cap');
        $class->save();

        return redirect('/admin/shipping-classes')->with('success', 'Class Added Successfully');
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
        $class=ShippingClasses::find($id);
        $class->delete();
        return redirect('/admin/shipping-classes')->with('success', 'Class Deleted Successfully');
    }
}
