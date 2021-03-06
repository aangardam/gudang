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

// Route::get('/', function () {
//     return view('home');
// });
/*---------- FRONT --------------------*/
Auth::routes();
//Route::group(['middleware'=>'Auth'],function(){
Route::group(['middleware' => ['auth']], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');
	Route::get('/profil', 'HomeController@profil');
	Route::post('profil/edit/{id}','HomeController@updateprofil');
	// Route::post('profil/update/{id}','HomeController@updateprofil2');
	Route::resource('Kategori','CategoryController');
	Route::post('Kategori/active/{id}','CategoryController@active');
	Route::post('Kategori/inactive/{id}','CategoryController@inactive');
	Route::resource('/User','UserController');
	Route::resource('/Vendors','VendorsController');
	Route::post('Vendors/active/{id}','VendorsController@active');
	Route::post('Vendors/inactive/{id}','VendorsController@inactive');
	// Toko
	Route::resource('Toko','StoreController');
	Route::post('Toko/active/{id}','StoreController@active');
	Route::post('Toko/inactive/{id}','StoreController@inactive');

	// Barang
	// Route::resource('Barang');
	// Route::group(['prefix' => 'front'], function() {
	Route::group(['prefix' => 'Produk'], function () {
		Route::get('/PO','ProductsController@index');
		Route::get('/PO/create','ProductsController@create');
		Route::post('/PO/save','ProductsController@store'); //tambah produk
		Route::get('PO/{id}/view','ProductsController@show');
		
		Route::get('PO/{id}/edit','ProductsController@edit');
		Route::post('/PO/approve','ProductsController@approve');
		// gudang
		Route::get('/Stok','ProductsController@gudang');
		Route::get('Send/{id}/view2','ProductsController@show2');
		Route::get('Send','ProductsController@send');
		Route::post('Stok/save','ProductsController@store2'); // kirim ke toko
		Route::get('/store','ProductsController@toko');
		Route::get('/store/print/{id}','ProductsController@print');

		// return
		Route::get('/return','ProductsController@return');
		Route::post('/return_product','ProductsController@return_product'); // kirim ke toko

		//back pusat
		Route::get('/productreturn','ProductReturnController@index');

		// cek data return di pusat
		Route::get('/kembali','ProductReturnController@index2');
		Route::get('/detail2/{id}','ProductReturnController@show');
		Route::put('/return/save','ProductReturnController@update');
	});
	Route::get('/ajax/getVendor/{id}','ProductsController@getVendor');
	Route::get('/ajax/getSize/{id}','ProductsController@getSize');
	Route::get('/ajax/getSum/{id}','ProductsController@getSum');

	Route::get('/ajax/getSize2/{id}','ProductsController@getSize2');
	Route::get('/ajax/getSum2/{id}','ProductsController@getSum2');

	// area kepala toko
	Route::group(['middleware'=>['role:Kepala Toko']],function(){
		Route::group(['prefix' => 'Produk'], function () {
			Route::get('/pending', 'ProductStoreController@index');
			Route::get('/pending/detail/{id}', 'ProductStoreController@show');
			Route::put('pending/save','ProductStoreController@update');

			Route::get('/approve', 'ProductStoreController@index2');
		});
		
	});

	Route::group(['middleware'=>['role:Vendor']],function(){
		Route::group(['prefix' => 'Produk'], function () {
			Route::get('/inprogres', 'VendorsController@inprogres');
			Route::get('/finished', 'VendorsController@finished');
			Route::get('/detail/{id}/view', 'VendorsController@detail');
			// Route::get('/pending/detail/{id}', 'ProductStoreController@show');
			// Route::put('pending/save','ProductStoreController@update');

			// Route::get('/approve', 'ProductStoreController@index2');
		});
		
	});


	Route::get('test','HomeController@test');
	Route::post('test/rabinkarp','HomeController@cek');
});

