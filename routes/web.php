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

// Route::domain('admin.' . env('APP_DOMAIN', 'boilerplate.test'))->group(function () {

//     Route::group([
//         'as' => 'admin::',
//         'middleware' => 'role:god'
//     ], function() {

//         Route::get('/', [
//             'as' => 'dashboard',
//             function () {
//                 return view('backend.pages.dashboard');
//             }
//         ]);

//         Route::group(['prefix' => '/users', 'as' => 'users::'], function() {

//             Route::get('/', 'UserController@index')->name('users');

//             Route::resource('users', 'UserController');

//             Route::get('/settings', [
//                 'as' => 'settings',
//                 function () {
//                     return view('backend.pages.users.settings');
//                 }
//             ]);
//         });

//         Route::group(['prefix' => '/pages', 'as' => 'pages::'], function() {

//             Route::get('/', [
//                 'as' => 'pages',
//                 function () {
//                     return view('backend.pages.pages');
//                 }
//             ]);

//             Route::get('/settings', [
//                 'as' => 'settings',
//                 function () {
//                     return view('backend.pages.pages.settings');
//                 }
//             ]);
//         });

//         Route::group(['prefix' => '/blog', 'as' => 'blog::'], function() {

//             Route::get('/', [
//                 'as' => 'blog',
//                 function () {
//                     return view('backend.pages.blog');
//                 }
//             ]);

//             Route::get('/posts', [
//                 'as' => 'posts',
//                 function () {
//                     return view('backend.pages.blog.posts');
//                 }
//             ]);

//             Route::get('/categories', [
//                 'as' => 'categories',
//                 function () {
//                     return view('backend.pages.blog.categories');
//                 }
//             ]);

//             Route::get('/settings', [
//                 'as' => 'settings',
//                 function () {
//                     return view('backend.pages.blog.settings');
//                 }
//             ]);
//         });

//         Route::group(['prefix' => '/cyrano', 'as' => 'cyrano::'], function() {

//             Route::get('/', [
//                 'as' => 'cyrano',
//                 function () {
//                     return view('backend.pages.cyrano');
//                 }
//             ]);

//             Route::get('/settings', [
//                 'as' => 'settings',
//                 function () {
//                     return view('backend.pages.cyrano.settings');
//                 }
//             ]);
//         });

//         Route::get('/settings', [
//             'as' => 'settings',
//             function () {
//                 return view('backend.pages.settings');
//             }
//         ]);

//     });

//     Route::group(['prefix' => '/utilities', 'as' => 'utilities::'], function() {
//     });

//     Route::get('/confirm/{email}/{password}', 'UserController@create');
//     Route::put('/activate', 'UserController@activate')->name('activate');


//     Route::get('/login', function () {
//         return view('backend.pages.auth.login');
//     })->name('backend-login');

// });



//     Route::get('/', function () {
//         return view('frontend.pages.home');
//     });

//     Auth::routes();

    // Route::get('/', 'HomeController@index')->name('home');


