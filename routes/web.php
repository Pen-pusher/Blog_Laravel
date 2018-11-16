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


/*
Route::get('/hello', function () {
    //return view('welcome');
    return 'Hello world';
});
*/
/*
Route::get('/users/{id}/{name}',function($id,$name){
    return 'This is user<br>' .$name. '<br> with an id of<br>' .$id ;
});
*/
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
  
Route::resource('posts', 'PostsController');
 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
