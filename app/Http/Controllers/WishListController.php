<?php

namespace App\Http\Controllers;

use App\Product;
use App\WishList;
use Auth;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index() {
    	$WishLists=Auth::user()->wishlist;
    	foreach ($WishLists as $WishList){
            $WishList->product = Product::find($WishList->product_id);
        }
        
        return view('frontend.pages.wishlist', ['Wishlists'=> $WishLists]);
    }

    public function addToWl($id)
    {
        $WishList=new WishList;
        $WishList->user_id=Auth::user()->id;
        $list=WishList::where('product_id',$id)
                        ->where('user_id',Auth::user()->id)
                        ->first();
        
        if(empty($list))
        {
        	$WishList->product_id=$id;
        	$WishList->save();
        }        
        return redirect()->back();

    }

    public function destroy($id)
    {
        $Wishlist=Wishlist::find($id);
        $Wishlist->delete();

        return redirect()->back();
    }
}
