<!-- <?php

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

#in questo modo ottendo il nome esatto della view corrente e tramite composer la condivido alle viste
// View::composer('*', function($view) {
//    $view->with('viewName', array_last(explode('/', $view->getPath())));
// });


//echo 'm here after composer command ';exit;
//Route::domain('admin.' . env('APP_URL', 'boilerplate.local'))->group(function () {
Route::group(['prefix'=> '/admin'],function(){

    Route::group([
        'as' => 'admin::',
        'middleware' => 'role:god'
    ], function() {

        Route::get('/', [
            'as' => 'dashboard',
            function () {
                return view('backend.pages.dashboard');
            }
        
        ]);
        Route::resource('products','ProductController');
        Route::resource('media','MediaController');
        Route::resource('pages','PagesController');
        Route::resource('categories','CategoriesController');
        Route::resource('pom','pomController');
        Route::resource('offers','offerController');
        Route::resource('classic','classicController');
        Route::resource('box','boxController');
        Route::resource('subscription','SubscriptionController');
        Route::resource('coupon','CouponController');
        Route::resource('shipping-rules','ShippingRules');
        Route::resource('shipping-zones','ShippingZonesController');
        Route::resource('shipping-classes','ShippingClassesController');
        Route::resource('shipping-defaults','ShippingDefaultRatesController');
        Route::resource('shipping-table-rates','ShippingTableRatesController');
        Route::resource('payment','PaymentController');
        
        Route::post('/pom/remove/{id}','pomController@remove');
        Route::post('/offers/remove/{id}','offerController@remove');
        Route::post('/classic/remove/{id}','classicController@remove');


        Route::get('/orders/all','OrderController@list')->name('orders.all');
        Route::get('/orders/{id}/show', 'OrderController@show');
        Route::post('/orders/update/{id}', 'OrderController@update')->name('orders.update');

        Route::get('/coupon/sendEmail/{id}', 'CouponController@sendEmail');
        
        Route::group(['prefix' => '/users', 'as' => 'users::'], function() {

            // Route::get('/', 'UserController@index')->name('users');

            Route::resource('/', 'UserController', ['parameters' => [
                '' => 'user'
            ]]);

            Route::get('/settings', [
                'as' => 'settings',
                function () {
                    return view('backend.pages.users.settings');
                }
            ]);
        });



        Route::group(['prefix' => '/blog', 'as' => 'blog::'], function() {

            Route::get('/', 'PostController@index')->name('blog');
            Route::get('/create', 'PostController@create')->name('create');
            Route::post('/update/{post}', 'PostController@update')->name('update');

            Route::get('/{post}/edit', 'PostController@edit')->name('edit');
            Route::post('/{post}/tag', 'PostController@tag')->name('tag');

            Route::get('/categories', [
                'as' => 'categories',
                function () {
                    return view('backend.pages.blog.categories');
                }
            ]);

            Route::get('/settings', [
                'as' => 'settings',
                function () {
                    return view('backend.pages.blog.settings');
                }
            ]);
        });

        Route::group(['prefix' => '/cyrano', 'as' => 'cyrano::'], function() {

            Route::get('/', [
                'as' => 'cyrano',
                function () {
                    return view('backend.pages.cyrano');
                }
            ]);

            Route::get('/settings', [
                'as' => 'settings',
                function () {
                    return view('backend.pages.cyrano.settings');
                }
            ]);
        });

        Route::get('/settings', [
            'as' => 'settings',
            function () {
                return view('backend.pages.settings');
            }
        ]);

    });

    Route::group(['prefix' => '/utilities', 'as' => 'utilities::'], function() {

        #Cloudinary
        Route::get('/csearch', 'PageController@cloudinarySearch')->name('cloudinary-search-by-tag');
        Route::get('/caction', 'PostController@cloudinaryAction')->name('cloudinary-act');

        #Strings
        Route::get('/slug',    'PostController@getSlug')->name('slug');

        #Configuration
        Route::get('/configuration/{key}', 'UtilitiesController@getConfiguration')->name('config');
        Route::post('/post-cat', 'UtilitiesController@setPostCategories')->name('post-cat');
    });

    #Creation of backend users
    Route::get('/confirm/{email}/{password}', 'UserController@create');
    Route::put('/activate', 'UserController@activate')->name('activate');

    Route::get('/siamosolonoi', function () {
        return view('frontend.demos.demo');
    })->name('si');

    Route::get('/login', function () {
        return view('backend.pages.auth.login');
    })->name('backend-login');

    Route::get('/logout','UserController@getlogout')->name('admin.logout');

});


