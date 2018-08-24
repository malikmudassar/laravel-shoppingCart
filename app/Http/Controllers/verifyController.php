<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class verifyController extends Controller
{
    public function verify($verifyToken)
    {
        User::where('verifyToken', $verifyToken)
            ->update(['status' => 1, 'verifyToken' => null]);
		return redirect()->route('login');
    }

    public function verifyEmail(){
    	return view('frontend.pages.verifyEmail');
    }
}
