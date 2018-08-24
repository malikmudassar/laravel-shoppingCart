<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Coupon;
use App\Mail\CouponInvite;
use App\User;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$coupons=Coupon::all();
        return view('backend.coupons.index')->with('coupons', $coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->input('type');

        $validation_arr = [];

        if(empty($type)) {
            $validation_arr['type'] = 'required';
        }
        else {
            switch ($request->input('type')) {
                case 'value':
                    $validation_arr['value'] = 'required|numeric|min:1|max:999999999';
                    break;
                case 'discount_per':
                    $validation_arr['discount_per'] = 'required|numeric|min:1|max:100';
                    break;
                default:
                    $validation_arr['type'] = 'required';
                    break;
            }
        }

        $validation_arr['name'] = 'required|min:3|max:191|unique:products|regex:/^[A-Za-z0-9\-]+$/u';
        $validation_arr['date_start']  = 'required|date';
        $validation_arr['date_end']  = 'required|date';
        $validation_arr['commulative']  = 'required';
        $validation_arr['times_used']  = 'required|numeric|min:1|max:99999999999';

        $this->validate($request, $validation_arr);

        $coupon=new Coupon;
        $coupon->name=$request->input('name');
        $coupon->value=$request->input('value');
        $coupon->discount_per=$request->input('discount_per');
        $coupon->date_start=$request->input('date_start');
        $coupon->date_end=$request->input('date_end');
        $coupon->commulative=$request->input('commulative');
        $coupon->times_used=$request->input('times_used');
        $coupon->type=$request->input('type');

        $coupon->save();
        
        

    	return redirect()->route('admin::coupon.index')->with('success', 'Coupon Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon=Coupon::find($id);
        return view('backend.coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$coupon=Coupon::find($id);
        return view('backend.coupons.edit')->with('coupon', $coupon);
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
        $type = $request->input('type');

        $validation_arr = [];

        if(empty($type)) {
            $validation_arr['type'] = 'required';
        }
        else {
            switch ($request->input('type')) {
                case 'value':
                    $validation_arr['value'] = 'required|numeric|min:1|max:999999999';
                    break;
                case 'discount_per':
                    $validation_arr['discount_per'] = 'required|numeric|min:1|max:100';
                    break;
                default:
                    $validation_arr['type'] = 'required';
                    break;
            }
        }

        $validation_arr['name'] = 'required|min:3|max:191|unique:products|regex:/^[A-Za-z0-9\-]+$/u';
        $validation_arr['date_start']  = 'required|date';
        $validation_arr['date_end']  = 'required|date';
        $validation_arr['commulative']  = 'required';
        $validation_arr['times_used']  = 'required|numeric|min:1|max:99999999999';

        $this->validate($request, $validation_arr);

        $coupon=Coupon::find($id);
        $coupon->name=$request->input('name');
        $coupon->value=$request->input('value');
        $coupon->discount_per=$request->input('discount_per');
        $coupon->date_start=$request->input('date_start');
        $coupon->date_end=$request->input('date_end');
        $coupon->commulative=$request->input('commulative');
        $coupon->times_used=$request->input('times_used');
        $coupon->type=$request->input('type');

        $coupon->save();
        return redirect()->route('admin::coupon.index')->with('success', 'Coupon Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       	$coupon=Coupon::find($id);
       	$coupon->delete();
       	return redirect()->route('admin::coupon.index')->with('success', 'Coupon Deleted');
    }


    public function sendEmail($id)
    {
        $coupon=Coupon::find($id);
        $users=User::where('id','>','8')->paginate(7);
        foreach ($users as $user) {
            Mail::to($user->email)->send(new CouponInvite($coupon));   
        }
        return redirect()->route('admin::coupon.index')->with('success', 'Email Sent');
    }
}
