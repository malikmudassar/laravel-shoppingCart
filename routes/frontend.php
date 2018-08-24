<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('home');

Route::get('/products/all', 'ProductController@list')->name('product.index');

Route::get('/product/{id}/show', 'ProductController@show');

Route::get('/product/category/{category}','ProductController@showCategory')->name('product.category');
Route::get('/pom/all', 'pomController@list')->name('pom.index');
Route::get('/offer/all', 'offerController@list')->name('offer.index');
Route::get('/classic/all', 'classicController@list')->name('classic.index');
Route::get('/box/all', 'boxController@list')->name('box.index');



Route::get('/box/single/{id}','boxController@getSingleBox');
Route::get('/box/{id}/show', 'boxController@show');
//Route::post('/subscription/save','SubscriptionController@save')->name('sub.save');


Route::group(['middlewareGroups'=>'auth'], function(){
	Route::post('/subscription/save','SubscriptionController@save')->name('sub.save');
	Route::post('/subscription/remove','SubscriptionController@delete')->name('sub.del');

	Route::get('/wishlist/cart','ProductController@addWlToCart')->name('wishlist.cart');
	Route::get('/wishlist/delete/{id}','WishListController@destroy');
	Route::get('/order/re-order/{id}','ProductController@addOrderToCart');

	Route::get('/cart/paypal/checkout', 'ProductController@paypalCheckout')->name('paypal.checkout');
	Route::get('/cart/paypal/success', 'ProductController@paypalSuccess')->name('paypal.success');

	Route::get('/product/add-to-wl/{id}', 'WishListController@addToWl');
	Route::get('/wishlist', 'WishListController@index')->name('wishlist');
	Route::get('/send/email','ProductController@send');
	Route::get('/product/add-to-cart/{id}', 'ProductController@addToCart');
	Route::get('/product/cart', 'ProductController@cart')->name('cart');
	Route::get('/product/checkout','ProductController@checkout')->name('checkout');
	Route::post('/product/checkout','ProductController@postCheckout');
	Route::get('/product/reduce/{id}','ProductController@getReduceByOne')->name('reduce');
	Route::get('/product/remove/{id}','ProductController@getRemoveItem')->name('remove');
	Route::post('/product/removeMultipleItemsFromCart','ProductController@removeMultipleItemsFromCart')->name('removeMultipleItemsFromCart');
    Route::post('/product/getOrderDetailsByOrderId','ProductController@getOrderDetailsByOrderId');
	Route::get('/user/profilo/edit','ProfileController@edit')->name('profile.edit');
	Route::get('/user/profilo','ProfileController@index')->name('profile');
	Route::post('user/profilo/update','ProfileController@update')->name('profile.update');
	Route::get('/user/abbonamenti','SubscriptionController@index')->name('subscription');
	Route::get('/user/ordini','ProfileController@orders')->name('orders');
	Route::get('/user/delete', 'UserController@delete')->name('user.delete');
	Route::post('/product/cart/insertCoupon', 'ProductController@insertCoupon')->name('insert.coupon');
	Route::get('/logout','UserController@logout')->name('logout');
});
// Footer Links

Route::get('/pages/chi-siamo','PagesController@aboutUs');
Route::get('/pages/come-funziona','PagesController@howItWorks');
Route::get('/pages/metodi-pagamenti','PagesController@payment');
Route::get('/pages/termini-condizioni','PagesController@recipe');
Route::get('/pages/informativa-privacy','PagesController@breeder');
Route::get('/pages/stampa-news','PagesController@press')->name('news');
Route::get('/pages/faq','PagesController@faq');
Route::get('/ajax-cities', 'PagesController@getCities');


Auth::routes();

Route::get('/verify/{verifyToken}','verifyController@verify')->name('verify');
Route::get('/showVerifyEmail','verifyController@verifyEmail')
			->name('showVerifyEmail');






