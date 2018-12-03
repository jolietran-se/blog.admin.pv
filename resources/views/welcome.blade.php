<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>

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


// Route::get('/', function(){
//  return view('welcome');
// });
Route::get('/', function(){
    return view('master');
});



Route::group(['prefix'=>'admin'],function(){

        // -----LOGIN-LOGOUT------
    Route::get('login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AuthAdmin\LoginController@login')->name('admin.authenciate');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    // Registration Routes...
    Route::get('register', 'AuthAdmin\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'AuthAdmin\RegisterController@register')->name('admin.signin');

    // Password Reset Routes...
   Route::get('password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'AuthAdmin\ResetPasswordController@reset');

    Route::middleware('admin.auth')->group(function(){
        Route::get('/dashboard', function() {
            return view('dashboard');
        });
            // ----PRODUCT------
        Route::group(['prefix'=>'product'],function(){
                
                Route::get('index','ProductController@index')->name('product.index');
                Route::get('anydata','ProductController@anydata')->name('product.anydata');
                Route::get('show/{id}','ProductController@show')->name('product.show');
                Route::get('{id_category}/anydataProductControllerListProduct','ProductController@anydataListProduct')->name('product.anydataListProduct');
                Route::post('store','ProductController@store')->name('product.store');
                Route::get('edit/{id}','ProductController@edit')->name('product.edit');
                Route::post('update/{id}','ProductController@update')->name('product.update');
                Route::delete('delete/{id}','ProductController@destroy')->name('product.delete');
            });
                // -----CATEGORY--------
            Route::group(['prefix'=>'category'],function(){
                Route::get('index','CategoryController@index')->name('category.index');
                Route::get('anydata','CategoryController@anydata')->name('category.anydata');
                Route::get('show/{id}','CategoryController@show')->name('category.show');
                Route::get('{id_category}/anydataListProduct','CategoryController@anydataListProduct')->name('category.anydataListProduct');
                Route::post('store','CategoryController@store')->name('category.store');
                Route::get('edit/{id}','CategoryController@edit')->name('category.edit');
                Route::post('update/{id}','CategoryController@update')->name('category.update');
                Route::delete('delete/{id}','CategoryController@destroy')->name('category.delete');
            });
            // ----------MANUFACTURE--------------

            Route::group(['prefix'=>'manufacture'],function(){
                Route::get('index','ManufactureController@index')->name('manufacture.index');
                Route::get('anydata','ManufactureController@anydata')->name('manufacture.anydata');
                Route::get('show/{id}','ManufactureController@show')->name('manufacture.show');
                Route::get('{id_category}/anydataListProduct','ManufactureController@anydataListProduct')->name('manufacture.anydataListProduct');
                Route::post('store','ManufactureController@store')->name('manufacture.store');
                Route::get('edit/{id}','ManufactureController@edit')->name('manufacture.edit');
                Route::post('update/{id}','ManufactureController@update')->name('manufacture.update');
                Route::delete('delete/{id}','ManufactureController@destroy')->name('manufacture.delete');

            });
            // ----------------COLOR------------
            Route::group(['prefix'=>'color'],function(){
                Route::get('index','ColorController@index')->name('color.index');
                Route::get('anydata','ColorController@anydata')->name('color.anydata');
                Route::get('show/{id}','ColorController@show')->name('color.show');
                Route::get('{id_color}/anydataListProduct','ColorController@anydataListProduct')->name('color.anydataListProduct');
                Route::post('store','ColorController@store')->name('color.store');
                Route::get('edit/{id}','ColorController@edit')->name('color.edit');
                Route::post('update/{id}','ColorController@update')->name('color.update');
                Route::delete('delete/{id}','ColorController@destroy')->name('color.delete');
            });
            // -------------SIZE------------------
            Route::group(['prefix'=>'size'],function(){
                Route::get('index','SizeController@index')->name('size.index');
                Route::get('anydata','SizeController@anydata')->name('size.anydata');
                Route::get('show/{id}','SizeController@show')->name('size.show');
                Route::get('{id_color}/anydataListProduct','SizeController@anydataListProduct')->name('size.anydataListProduct');
                Route::post('store','SizeController@store')->name('size.store');
                Route::get('edit/{id}','SizeController@edit')->name('size.edit');
                Route::post('update/{id}','SizeController@update')->name('size.update');
                Route::delete('delete/{id}','SizeController@destroy')->name('size.delete');
            });
    });
        
});

// ----------DEMO----------------------

Route::resource('posts','PostsController');
Route::post('posts/changeStatus', array('as' => 'changeStatus', 'uses' => 'PostsController@changeStatus'));

// USER
Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
});



