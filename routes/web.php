<?php
use Illuminate\Support\Facades\Auth;

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

/** home */
Route::get('/', function () {
    return view('vendor.voyager-frontend.header');
 })->name('home');
 /** login */
 Route::get('/login', function () {
     return view('modules.auth.login');
  })->name('login');
 /** register */
 Route::get('/register', function () {
     return view('modules.auth.register');
  })->name('register');
 /** reset Password */
 Route::get('/passwords/reset', function () {
     return view('modules.auth.passwords.reser');
  })->name('passwords');
 
 Route::get('/account',function(){
     $user = Auth::user();
     return view('modules/auth/account', ['user' => $user]);
 })->name('account');
 
 Route::get('/admin/login',function(){
 
     return Redirect('/login');
 });
 
 Route::get('/home', function(){
 
    return Redirect('/admin');
 
 });


 Route::get('/carrito/agregar/{id}','CarritoController@agregar2');
 
 
 Route::post('logout','Voyager\Http\Controllers\VoyagerController@logout')->name('logout');

 /**condicional de cuando */
 
 /** Panel */
 Route::group(['prefix' => 'admin'], function () {

    Route::get('/PedidosChar','Voyager\Http\Controllers\ProductController@PedidosChar')->name('voyager.produtoscharcuteria.index');
    Route::get('/PedidosCar','Voyager\Http\Controllers\ProductController@PedidosCar')->name('voyager.produtoscarnicos.index');
 
 
     ////Route widgets
     Route::get('/newProducts','Voyager\Http\Controllers\ProductController@newProducts')->name('productsNew.index');
 

     
    /* Carrito*/
   


    Route::post('/carrito/agregar','CarritoController@agregar')->name('carrito.add');
    Route::get('/carrito','CarritoController@index')->name('carrito.index');

     ////no modificar
 
     ///login
 
     Route::get('/login', function () {
         return view('modules.auth.login');
      })->name('login'); 
 
     ////logout
     Route::get('/', ['uses' => 'Voyager\Http\Controllers\VoyagerController@logout',   'as' => 'dashboard']);
     Route::post('logout','Voyager\Http\Controllers\VoyagerController@logout')->name('logout');
 
     Route::get('login', ['uses' => 'Voyager\Http\Controllers\VoyagerController@logout',     'as' => 'login']);
     Route::post('login', ['uses' => 'Voyager\Http\Controllers\VoyagerController@logout', 'as' => 'postlogin']);
 
     ///compasss
 
     Route::group(['middleware' => 'admin.user'], function (){
         // Compass Routes
         Route::group([
             'as'     => 'compass.',
             'prefix' => 'compass',
         ], function (){
             Route::get('/', ['uses' =>'Voyager\Http\Controllers\VoyagerCompassController@index',  'as' => 'index']);
             Route::post('/', ['uses' => 'Voyager\Http\Controllers\VoyagerCompassController@index',  'as' => 'post']);
         });
     });
 
     Voyager::routes();
    ///////////////dejar quieto
 
 });