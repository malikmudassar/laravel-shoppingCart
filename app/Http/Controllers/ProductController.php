<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Order;
use App\Coupon;
use Image;
use Session;
use Auth;
use Mail;
use DB;
use App\ShippingClasses;
use App\ShippingTableRates;
use App\ShippingRulesModel;
use App\ShippingDefaultRates;
use App\Categories;
use App\WishList;
use App\Mail\ConfirmSubscription;
use Stripe\Charge;
use Stripe\Stripe;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use App\paymentMethods;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('created_at','desc')->paginate(100);
        return view('backend.products.list')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Categories::orderBy('created_at','asc')->paginate(10);
        return view('backend.products.add')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'          =>  'required|min:3|max:191|unique:products|regex:/^[\pL\s\-]+$/u',
            'detail'        =>  'required|min:3|max:191',
            'description'   =>  'required|min:10|max:5000',
            'price'         =>  'required|numeric|min:1|max:99999999999',
            'slug'          =>  'required|min:3|max:191|regex:/^[\pL\-]+$/u',
            'weight'        =>  'required|numeric|min:1|max:99999999999',
            'category'      =>  'required',
            'product_image' =>  'required'
        ]);

        $product=new Product;
        $product->name= $request->input('name');
        $product->details= $request->input('detail');
        $product->description= $request->input('description');
        $product->price= $request->input('price');
        $product->slug= $request->input('slug');
        $product->weight=$request->input('weight');
        $product->category=$request->input('category');

        if($request->hasFile('product_image')){
        	$image=$request->file('product_image');
        	$filename=time().'.'.$image->getClientOriginalExtension();
        	$location=public_path('images/products/'.$filename);
        	Image::make($image)->resize(800,400)->save($location);
        	$product->image=$filename;
        }

        $product->save();

        return redirect('/admin/products')->with('success','Product Added Successfully');

    }
    /**
     * Display a listing of the resource on front-end.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $products=Product::orderBy('created_at','desc')->paginate(10);
        return view('frontend.pages.products')->with(['products'=> $products, 'label'=>'Prodotti']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        $products=Product::orderBy('created_at','desc')->paginate(3);
        return view('frontend.pages.product')->with(['product'=>$product, 'products'=>$products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $categories=Categories::orderBy('created_at','asc')->paginate(10);
        return view('backend.products.edit')
                ->with([
                    'product' => $product,
                    'categories' => $categories
                ]);
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
        $this->validate($request, [
            'title'         =>  'required|min:3|max:191|regex:/^[\pL\s\-]+$/u',
            'detail'        =>  'required|min:3|max:191',
            'description'   =>  'required|min:10|max:5000',
            'price'         =>  'required|numeric|min:1|max:999999999',
            'slug'          =>  'required|min:3|max:191|regex:/^[\pL\-]+$/u',
            'weight'        =>  'required|numeric|min:1|max:99999999999',
            'category'      =>  'required',
            'product_image' =>  'required'
        ]);

        $product=Product::find($id);
        $product->name= $request->input('title');
        $product->details= $request->input('detail');
        $product->description= $request->input('description');
        $product->price= $request->input('price');
        $product->weight= $request->input('weight');
        $product->slug= $request->input('slug');
        $product->category=$request->input('category');

        if($request->hasFile('product_image')){
        	$image=$request->file('product_image');
        	$filename=time().'.'.$image->getClientOriginalExtension();
        	$location=public_path('images/products/'.$filename);
        	Image::make($image)->resize(800,400)->save($location);
        	$product->image=$filename;
        }


        $product->save();

        return redirect('/admin/products')->with('success','Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        //return $product;
        $product->delete();

        return redirect('/admin/products')->with('success','Product Deleted Successfully');
    }

    public function addToCart(Request $request, $id)
    {
        $product=Product::find($id);
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->back();

    }

    public function addOrderToCart(Request $request, $id)
    {
        $order=Order::find($id);
        $order->cart=unserialize($order->cart);
        
        foreach($order->cart->items as $item)
        {
            $oldCart=Session::has('cart') ? Session::get('cart') : null;
            $cart=new Cart($oldCart);  
            if($item['qty'] >1){
                for($i=0;$i<$item['qty'];$i++)
                {
                    $cart->add($item['item'], $item['item']->id);
                    $request->session()->put('cart', $cart);
                }
            }
            else
            {
                $cart->add($item['item'], $item['item']->id);
                $request->session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart');

    }

    public function addWlToCart(Request $request)
    {
        $WishLists=Auth::user()->wishlist;
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        foreach ($WishLists as $WishList){
            $WishList->product = Product::find($WishList->product_id);
            $cart->add($WishList->product, $WishList->product_id);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('wishlist');

    }

    public function getOrderDetailsByOrderId(Request $request){
        $id = $request->only('order_id');
        if(isset($id['order_id'])) {
            $order=Order::find($id['order_id']);
            $order->cart=unserialize($order->cart);
            $order->cart->shipment_price = $order->shipment_price;
           echo json_encode($order->cart);
        }
    }

    public function insertCoupon(Request $request)
    {
        //Find coupon
        $data=Coupon::where('name', $request->input('coupon'))->get();
        if(count($data)>0)
        {
            $coupon=$data[0]; 
            $date_exp=$coupon->date_end;
            $date_start=$coupon->date_start;
            $date_now=date('Y-m-d');

            $oldCart=Session::has('cart') ? Session::get('cart') : null;
            $cart=new Cart($oldCart);

            if(strtotime($date_now)>strtotime($date_exp))
            {
                return redirect()->route('cart')->with('error', 'Coupon Expired');    
            }
            elseif(strtotime($date_now)<strtotime($date_start))
            {
                return redirect()->route('cart')->with('error', 'Coupon is not active yet');
            }
            else
            {
                $type=$coupon->type;
                $coup=Coupon::find($coupon->id);
                if($coup->times_used > $coup->used_times)
                {
                    if($type=='value'){
                    $rate=$coupon->value;
                    $cart->totalPrice=$cart->totalPrice-$rate;
                    $request->session()->put('cart', $cart);
                    ($coup->used_times==NULL)?$val=1:$val=$coup->used_times+1;
                    $coup->used_times=$val;
                    $coup->save();
                    session()->put('coupon', $rate);
                    return redirect()->route('cart')->with('success', 'Coupon Applied');
                    }
                    elseif($type='discount_per')
                    {
                        $rate=$coupon->discount_per;
                        $amount=$cart->totalPrice-(($rate/100)*$cart->totalPrice);
                        $rate=$cart->totalPrice-$amount;
                        $cart->totalPrice=$amount;
                        $request->session()->put('cart', $cart);  
                        ($coup->used_times==NULL)?$val=1:$val=$coup->used_times+1;
                        $coup->used_times=$val;
                        $coup->save();
                        session()->put('coupon', $rate);
                        return redirect()->route('cart')->with('success', 'Coupon Applied');
                    } 
                }
                else
                {
                    return redirect()->route('cart')->with('error', 'Coupon already used');
                }
                               

            }
        }
        else
        {   // IF not found redirect to cart with error message
            return redirect()->route('cart')->with('error', 'Invalid Coupon');
        }
            
            
        
    }
    

    

    

    public function cart()
    {
        $payment=paymentMethods::find(1);
        if(!Session::has('cart')){
            return view('frontend.pages.cart')->with(['products'=>null, 'iban'=>$payment->iban]);
        }
        $user=Auth::user();
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $products=$cart->items;
        $total_weight=0;

        foreach ($products as $product)
        {
           $total_weight=$total_weight+$product['item']->weight;
           if($product['qty']>1){
                $total_weight=$total_weight*$product['qty'];
           }
        }
        $rate = 0;
        $total_weight=$total_weight/1000;
        $min=(int)($total_weight/10);
        if($min>0)
        {
            $max=($min+1)*10;
            $min=$min*10;
        }
        else
        {
            $min=0;
            $max=(10-$min)+$min;    
        }
        
        
        $m['max']=$max;
        $m['min']=$min;
        
        // Shipping Rate Calculation
        $msg['text']='';
        if(!empty($user->add_ship_cap))
        {
            $rate_value=DB::table('shipping_rules')
                    ->where('cap', '=', $user->add_ship_cap)
                    ->where('min_weight','<',$total_weight)
                    ->where('max_weight','>',$total_weight)
                    ->get();
            $msg['text']='Fixed CAP';
            if(!count($rate_value)>0)
            {
                $rate_value=DB::table('shipping_rules')
                    ->where('min_cap','<', $user->add_ship_cap)
                    ->where('max_cap','>', $user->add_ship_cap)
                    ->where('min_weight','<',$total_weight)
                    ->where('max_weight','>',$total_weight)
                    ->get();        
                  $msg['text']='CAP in Range';

                  if(!count($rate_value)>0)
                    {
                        $msg['text']='CAP Not in Range';
                        if(!empty($user->add_ship_city))
                        {
                            $rate_value=DB::table('shipping_rules')
                                    ->where('city', '=', $user->add_ship_city)
                                    ->where('min_weight','<',$total_weight)
                                    ->where('max_weight','>',$total_weight)
                                    ->get();
                                    $msg['text']='CAP - City Found';
                            if(!count($rate_value)>0)
                            {
                                if(!empty($user->add_ship_province))
                                {
                                    $rate_value=DB::table('shipping_rules')
                                            ->where('province', '=', $user->add_ship_province)
                                            ->where('min_weight','<',$total_weight)
                                            ->where('max_weight','>',$total_weight)
                                            ->get();
                                            $msg['text']='CAP - Province Found';
                                    if(!count($rate_value)>0)
                                    {
                                        if(!empty($user->add_ship_country))
                                        {
                                            $rate_value=DB::table('shipping_rules')
                                                    ->where('country', 'LIKE', '%'.$user->add_ship_country.'%')
                                                    ->where('min_weight','<',$total_weight)
                                                    ->where('max_weight','>',$total_weight)
                                                    ->get();
                                               $msg['text']='CAP - Country Found';
                                        }      
                                    } 
                                }   
                            } 
                                   
                        }
                        elseif(!empty($user->add_ship_province))
                        {
                            $rate_value=DB::table('shipping_rules')
                                    ->where('province', '=', $user->add_ship_province)
                                    ->where('min_weight','<',$total_weight)
                                    ->where('max_weight','>',$total_weight)
                                    ->get();
                                    $msg['text']='CAP - Province Found';
                            if(!count($rate_value)>0)
                            {
                                if(!empty($user->add_ship_country))
                                {
                                    $rate_value=DB::table('shipping_rules')
                                            ->where('country', 'LIKE', '%'.$user->add_ship_country.'%')
                                            ->where('min_weight','<',$total_weight)
                                            ->where('max_weight','>',$total_weight)
                                            ->get();
                                       $msg['text']='CAP - Country Found';
                                }      
                            } 
                        }
                        elseif(!empty($user->add_ship_country))
                        {
                            $rate_value=DB::table('shipping_rules')
                                    ->where('country', 'LIKE', '%'.$user->add_ship_country.'%')
                                    ->where('min_weight','<',$total_weight)
                                    ->where('max_weight','>',$total_weight)
                                    ->get();
                               $msg['text']='CAP - Country Found';
                        }
                    }
            }
            
            if(!count($rate_value)>0)
            {
                $defaults=ShippingDefaultRates::all()->first();
                $m['max_per_item']=$defaults->max_per_item;
                $m['handling_per_item']=$defaults->handling_per_item;
                $sum=$m['max_per_item'] + $m['handling_per_item'];
                $rate_value[0]=(object)array('rate' => $sum);  
                $msg['text']='default rates';
            } 
            $msg['text']='CAP Found';  

        }
        elseif(!empty($user->add_ship_city))
        {
            $rate_value=DB::table('shipping_rules')
                    ->where('city', '=', $user->add_ship_city)
                    ->where('min_weight','<',$total_weight)
                    ->where('max_weight','>',$total_weight)
                    ->get();
            if(!count($rate_value)>0)
            {
                if(!empty($user->add_ship_province))
                {
                    $rate_value=DB::table('shipping_rules')
                    ->where('province', '=', $user->add_ship_province)
                    ->where('min_weight','<',$total_weight)
                    ->where('max_weight','>',$total_weight)
                    ->get();
                    if(!count($rate_value)>0)
                    {
                        if(!empty($user->add_ship_country))
                        {
                            $rate_value=DB::table('shipping_rules')
                            ->where('country', 'LIKE', '%'.$user->add_ship_country.'%')
                            ->where('min_weight','<',$total_weight)
                            ->where('max_weight','>',$total_weight)
                            ->get();
                               
                        }      
                    } 
                }
                else
                {
                    if(!empty($user->add_ship_country))
                    {
                        $rate_value=DB::table('shipping_rules')
                        ->where('country', 'LIKE', '%'.$user->add_ship_country.'%')
                        ->where('min_weight','<',$total_weight)
                        ->where('max_weight','>',$total_weight)
                        ->get();
                           
                    } 
                }   
            } 
            if(!count($rate_value)>0)
            {
                $defaults=ShippingDefaultRates::all()->first();
                $m['max_per_item']=$defaults->max_per_item;
                $m['handling_per_item']=$defaults->handling_per_item;
                $sum=$m['max_per_item'] + $m['handling_per_item'];
                $rate_value[0]=(object)array('rate' => $sum);  
                $msg['text']='default rates';
            } 
            $msg['text']='City Found';  
                   
        }
        elseif(!empty($user->add_ship_province))
        {
            $rate_value=DB::table('shipping_rules')
                    ->where('province', '=', $user->add_ship_province)
                    ->where('min_weight','<',$total_weight)
                    ->where('max_weight','>',$total_weight)
                    ->get();
            if(!count($rate_value)>0)
            {
                if(!empty($user->add_ship_country))
                {
                    $rate_value=DB::table('shipping_rules')
                            ->where('country', 'LIKE', '%'.$user->add_ship_country.'%')
                            ->where('min_weight','<',$total_weight)
                            ->where('max_weight','>',$total_weight)
                            ->get();
                       
                }      
            } 
            if(!count($rate_value)>0)
            {
                $defaults=ShippingDefaultRates::all()->first();
                $m['max_per_item']=$defaults->max_per_item;
                $m['handling_per_item']=$defaults->handling_per_item;
                $sum=$m['max_per_item'] + $m['handling_per_item'];
                $rate_value[0]=(object)array('rate' => $sum);  
                $msg['text']='default rates';
            } 
            $msg['text']='Provice Found';  
        }
        elseif(!empty($user->add_ship_country))
        {
            $rate_value=DB::table('shipping_rules')
                    ->where('country', 'LIKE', '%'.$user->add_ship_country.'%')
                    ->where('min_weight','<',$total_weight)
                    ->where('max_weight','>',$total_weight)
                    ->get();
            $msg['text']='Country Found';  
            if(!count($rate_value)>0)
            {
                $defaults=ShippingDefaultRates::all()->first();
                $m['max_per_item']=$defaults->max_per_item;
                $m['handling_per_item']=$defaults->handling_per_item;
                $sum=$m['max_per_item'] + $m['handling_per_item'];
                $rate_value[0]=(object)array('rate' => $sum);  
                $msg['text']='default rates';
            } 
        }

        if(!empty($rate_value))
        {
            if(count($rate_value)>0)
            {
                $rate= $rate_value[0]->rate;        
            }            
        }
        else 
        {
            $rate_value[0]=(object)array('rate' => '');  
            $defaults=ShippingDefaultRates::all()->first();
            $m['max_per_item']=$defaults->max_per_item;
            $m['handling_per_item']=$defaults->handling_per_item;
            $sum=$m['max_per_item'] + $m['handling_per_item'];
            $rate_value[0]->rate=$sum;
        }
        
        $rate=(int)$rate_value[0]->rate;
        
        session()->put('shipment_price', number_format($rate_value[0]->rate, 2));
        session()->put('rate', $rate);

        return view('frontend.pages.cart')
            ->with([
                'products'=>$products, 
                'totalPrice'=>$cart->totalPrice, 
                'totalQty'=>$cart->totalQty, 
                'total_weight'=> $total_weight,
                'rate'  => number_format($rate, 2),
                'min'   => $min,
                'max'   => $max,
                'iban'=>$payment->iban
            ]);
    }

    public function checkout() {

        if(!Session::has('cart')){
            return view('frontend.pages.cart');
        }

        $user_payment_type = Auth::user()->payment_type;

        if(empty($user_payment_type) || is_null($user_payment_type)) {
            session()->flash('user_payment_type_issue', 'Seleziona un metodo di pagamento dalla sezione del profilo');
            return $this->cart();
        }

        if(Session::has('shipment_price')){
            $shipment_price = Session::get('shipment_price');
        }


        if($user_payment_type == 'cod')
        {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);            
            
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = Auth::user()->add_bill1.' '.Auth::user()->add_bill2;
            $order->name = Auth::user()->name;
            $order->payment_id = 'Self';
            $order->payment_status = 'Pending';
            $order->payment_method = 'cod';
            $order->shipment_status = 'Pending';
            $order->shipment_price = $shipment_price;

            Auth::user()->orders()->save($order);
            Session::forget('cart');
            return view('frontend.pages.cod');
        }
        elseif($user_payment_type == 'bank')
        {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);            
            
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = Auth::user()->add_bill1.' '.Auth::user()->add_bill2;
            $order->name = Auth::user()->name;
            $order->payment_id = 'Self';
            $order->payment_status='Pending';
            $order->payment_method='bank';
            $order->shipment_price = $shipment_price;
            
            Auth::user()->orders()->save($order);
            Session::forget('cart');
            return view('frontend.pages.bank');
        }
        elseif($user_payment_type == 'card')
        {
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $total=$cart->totalPrice;
            $products=$cart->items;
            $total_weight=0;

            foreach ($products as $product)
            {
               $total_weight=$total_weight+$product['item']->weight;
            }
            
            
            $total_weight=$total_weight/1000;
            $min=(int)($total_weight/10);
            $max=(10-$min)+$min;
            $shipment_price = session::get('shipment_price');
            //////////////////////////
            $rate=$shipment_price;
            //////////////////////////
        
            
            //return $rate;
            session()->put('shipment_price', number_format($rate, 2));
           
            $total+=$rate;

            return view('frontend.pages.checkout', ['total'=>$total]);
        }
        elseif($user_payment_type == 'paypal')
        {
            // $oldCart = Session::get('cart');
            // $cart = new Cart($oldCart);
            // //return $cart->items;
            // return view('frontend.pages.test')->with('cart', $cart);
            return redirect()->route('paypal.checkout');
        }
        
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return view('frontend.pages.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        Stripe::setApiKey('sk_test_k36WDPLBUkJ2qALWiOdgPIMg');
        
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $shipment_price = session('shipment_price');
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;
            $order->payment_status='Paid';
            $order->payment_method='card';
            $order->shipment_price = $shipment_price;
            $order->shipment_status='Pending';
            // echo '<pre>';
            // var_dump($order->toArray());exit;
            
            Auth::user()->orders()->save($order);

        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        Session::forget('coupon');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('cart');
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('cart');
    }

    public function removeMultipleItemsFromCart(Request $request) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $product_ids = $request->only('product_ids');
        if(!empty($product_ids)) {
            foreach($product_ids['product_ids'] as $product) {
                $cart->removeItem($product);
                if (count($cart->items) > 0) {
                    Session::put('cart', $cart);
                } else {
                    Session::forget('cart');
                }
            }
        }
    }

    public function showCategory ($category) {
        $categories=Categories::orderBy('created_at','asc')->paginate(10);
        $products=Product::where('category',$category)->paginate(10);
        return view('frontend.pages.products')
        ->with([
            'products'=>$products, 
            'label'=>$category,
            'categories'=>$categories
        ]);
    }  

    public function send() {
        Mail::to(Auth::user()->email)->send(new ConfirmSubscription);
        return 'Email sent';
    }


    public function paypalCheckout()
    {
        $provider = new ExpressCheckout;   

        if (!Session::has('cart')) {
            return view('frontend.pages.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        try 
        {
            $data = [];
            $cart->totalPrice=0;
            foreach($cart->items as $item)
            {
                $itemDetail=[
                    'name'  => $item['item']->name,
                    'price' => $item['item']->price,
                    'qty'   => $item['qty']
                ];
                $cart->totalPrice+=$item['item']->price;
                $data['items'][]=$itemDetail;
            }
            
            $data['invoice_id'] = uniqid();
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('paypal.success');
            $data['cancel_url'] = route('cart');        

            $data['total'] = $cart->totalPrice;
            session()->put('cart', $cart);
        } catch (\Exception $e) {
            return redirect()->route('cart')->with('error', $e->getMessage());
        }
        $response = $provider->setExpressCheckout($data);

         // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }

    public function paypalSuccess(Request $request)
    {
        $token=$request->token;
        $provider = new ExpressCheckout;  
        $response = $provider->getExpressCheckoutDetails($token);

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        if(session()->has('coupon')){

            $cart->totalPrice=$cart->totalPrice-Session::get('coupon');  
            
        }
        
        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = Auth::user()->add_ship1.' '.Auth::user()->add_ship2;
        $order->name = Auth::user()->name;
        $order->payment_id = $token;
        $order->payment_status='Paid';
        $order->payment_method='paypal';
        $order->shipment_price=session::get('shipment_price');
        $order->shipment_status='Pending';

        Auth::user()->orders()->save($order);
        Session::forget('cart');
        Session::forget('coupon');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }
}
