<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\Classic;
Use App\Box;
Use App\Pom;
use App\Product;
use App\WishList;
use App\Categories;
use Image;
use Session;
use App\Media;
use App\countries;
use App\UserPaymentCard;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_payments = [];

        $products=Product::where('category','box')->orderBy('created_at','desc')->paginate(10);
        $offers=Offer::orderBy('created_at','desc')->paginate(3);
        foreach ($offers as $offer){
            $offer->product = Product::find($offer->productId);
        }
        $classics=Classic::orderBy('created_at','desc')->paginate(3);
        foreach ($classics as $offer){
            $offer->product = Product::find($offer->productId);
        }
        $pom=Pom::orderBy('created_at','desc')->paginate(3);
        foreach ($pom as $offer){
            $offer->product = Product::find($offer->productId);
        }
        $boxes=Box::orderBy('created_at','desc')->paginate(6);
        $categories=Categories::orderBy('created_at','asc')->paginate(10);

        $wishlist=WishList::all();

        $countries=countries::all();

        if (Auth::check()) {
            if(isset(Auth::user()->payment_card)) {
                $user_payments = [
                    'card_number' => Auth::user()->payment_card->card_number,
                    'card_name' => Auth::user()->payment_card->name,
                    'card_expiry' => Auth::user()->payment_card->expiry,
                    'card_cvv' => Auth::user()->payment_card->cvv
                ];
            }
        }

        $media=Media::find(1);
        return view('frontend.pages.home')
        ->with([
            'products'=>$products, 
            'media'=>$media,
            'offers'=> $offers,
            'pom'   => $pom,
            'classic' => $classics,
            'box'   => $boxes,
            'wishlist' => $wishlist, 
            'categories'=> $categories,
            'countries'=> $countries,
            'user_payments'=> $user_payments
        ]);
    }
}
