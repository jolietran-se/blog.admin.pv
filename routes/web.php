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
// 	return view('welcome');
// });
Route::get('/','PageController@getIndex')->name('home');
Route::get('show/{id}','PageController@show')->name('edit');
Route::post('postcart','PageController@postcart')->name('postcart');
Route::get('shop', function(){
	return view('page.product');
});
Route::get('detail', function(){
	return view('page.product_detail');
});
Route::get('cart', function(){
	return view('page.shoping_cart');
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
				Route::get('{id_product}/anydataListProduct','ProductController@anydataListProduct')->name('product.anydataListProduct');
				Route::post('/image-view','ProductController@store');
				// Route::post('store','ProductController@store');
				Route::post('store','ProductController@storeProduct')->name('product.store');
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
			// ----------------color------------
			Route::group(['prefix'=>'color'],function(){
				Route::get('index','ColorController@index')->name('color.index');
				Route::get('anydata','ColorController@anydata')->name('color.anydata');
				Route::get('show/{id}','ColorController@show')->name('color.show');
				Route::get('{id_slide}/anydataListProduct','ColorController@anydataListProduct')->name('color.anydataListProduct');
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
				Route::get('{id_slide}/anydataListProduct','SizeController@anydataListProduct')->name('size.anydataListProduct');
				Route::post('store','SizeController@store')->name('size.store');
				Route::get('edit/{id}','SizeController@edit')->name('size.edit');
				Route::post('update/{id}','SizeController@update')->name('size.update');
				Route::delete('delete/{id}','SizeController@destroy')->name('size.delete');
			});
			     // SLIDE
			Route::group(['prefix'=>'slide'],function(){
				Route::get('index','SlideController@index')->name('slide.index');
				Route::get('anydata','SlideController@anydata')->name('slide.anydata');
				Route::get('show/{id}','SlideController@show')->name('slide.show');
				Route::get('{id_slide}/anydataListProduct','SlideController@anydataListProduct')->name('slide.anydataListProduct');
				Route::post('store','SlideController@store')->name('slide.store');
				Route::get('edit/{id}','SlideController@edit')->name('slide.edit');
				Route::post('update/{id}','SlideController@update')->name('slide.update');
				Route::delete('delete/{id}','SlideController@destroy')->name('slide.delete');
			});
    });
		
});

// ----------DEMO----------------------


// USER
Auth::routes();
Route::middleware('auth')->group(function(){
	Route::get('/home', 'HomeController@index')->name('home');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
