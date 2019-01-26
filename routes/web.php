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
	// Route::get('/profil', 'HomeController@profil');
	// Route::post('profil/edit/{id}','HomeController@updateprofil');
	// Route::post('profil/update/{id}','HomeController@updateprofil2');
	Route::resource('Kategori','CategoryController');
	Route::post('Kategori/active/{id}','CategoryController@active');
	Route::post('Kategori/inactive/{id}','CategoryController@inactive');
	Route::resource('/User','UserController');

});
