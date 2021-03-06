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

Route::get('socket', 'SocketController@index');
Route::post('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writemessage');

Route::get('/', function () {
	
	if (\Auth::check()){

		switch (Auth::user()->type) {

			case 'admin':
				return redirect('/admin');
				break;
			
			case 'restaurant':
				return redirect('/restaurant');
				break;
			
			default:
				return redirect('/home');
				break;
		}

	}else{
		return view('welcome');		
	}
    
});

Auth::routes();


Route::get('auth/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback');

Route::get('testVue', 'TestController@index');
Route::get('vue', 'TestController@vue');
Route::get('vue-component', 'TestController@vueComponent');
Route::get('adminlte', 'TestController@adminLte');

Route::get('pusherClient', function(){
	return view('test.pusher');
});
Route::get('pusherServer', function(){
	$options = array(
    	'encrypted' => true
  	);
  	//$pusher = App::make('pusher');
  	$pusher = new Pusher(
	    '43dde511ec5106d226b1',
	    'bf854c62c49049407807',
	    '347695',
	    $options
  	);

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
});


//clients
Route::group(['middleware' => 'client'], function () {
	Route::get('/home', 'ClientController@index')->name('home');	
	Route::get('/profile/{id}', 'ClientController@show');
	Route::post('/profile', 'ClientController@updateClient');
	Route::get('/restaurants/{id}/{restaurant}', 'ClientController@showRestaurant');

	Route::get('/profile/{id}/orders', 'ClientController@showOrders');
	Route::get('/profile/{id}/favorites', 'ClientController@showFavorites');

	Route::post('/add-product-to-cart', 'ClientController@add_product_to_cart');
	Route::post('/remove-product-from-cart', 'ClientController@remove_product_from_cart');	
	Route::post('/manage-product-from-cart', 'ClientController@manage_product_from_cart');	
	
	Route::get('/hola', 'ClientController@hola');
});

//admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'Admin\AdminController@index');
    Route::get('/admin/profile/{id}', 'Admin\AdminController@show');
    
    Route::get('/admin/clients', 'Admin\AdminController@clients');
    Route::post('/admin/clients/create', 'Admin\AdminController@insertClient');
    Route::get('/admin/clients/{id}/edit', 'Admin\AdminController@editClient');
    Route::post('/admin/clients', 'Admin\AdminController@updateClient');


    Route::get('/admin/products', 'Admin\AdminController@products');
    Route::post('/admin/products/create', 'Admin\AdminController@insertProduct');
    Route::get('/admin/products/{id}/edit', 'Admin\AdminController@editProduct');
    Route::post('/admin/products/{id}', 'Admin\AdminController@updateProduct');

    Route::get('/admin/restaurants/{id}/edit', 'Admin\AdminController@editRestaurant');
    Route::post('/admin/restaurants', 'Admin\AdminController@insertRestaurant');
    Route::get('/admin/restaurants', 'Admin\AdminController@restaurants');
    
    Route::post('/admin/category', 'Admin\AdminController@insertCategory');
    Route::get('/admin/categories-by-restaurant', 'Admin\AdminController@getCategoriesByRestaurant');

    Route::get('/admin/discounts/{id}/edit', 'Admin\AdminController@editDiscount');
    Route::post('/admin/discount/{id}', 'Admin\AdminController@updateDiscount');
	Route::get('/admin/discounts', 'Admin\AdminController@showDiscounts');
	Route::post('/admin/discount', 'Admin\AdminController@insertDiscount');

	Route::get('/admin/promotions', 'Admin\AdminController@promotions');
	Route::get('/admin/promotions/{promotion}/edit', 'Admin\AdminController@editPromotion');
	Route::post('/admin/promotion/{id}', 'Admin\AdminController@updatePromotion');

    Route::get('/admin/orders', 'Admin\AdminController@orders');
	
    Route::get('/admin/history', 'Admin\AdminController@getHistory');
});

//providers
Route::group(['middleware' => 'restaurant'], function () {
    Route::get('/restaurant', 'Restaurant\RestaurantController@index');
    Route::get('/restaurant/profile/{id}', 'Restaurant\RestaurantController@show');
    
});
