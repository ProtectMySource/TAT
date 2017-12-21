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
//     return view('welcome');
// });
// Route::get('/user',function(){
//   return view('backend.user.usertable');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin'],function(){
  Route::get('customers/search','backend\customers\CustomerController@search')->name('customers.search')->middleware('auth');
  Route::resource('customers','backend\customers\CustomerController')->middleware('auth');
  Route::post('customer/edit/{customer}', 'backend\customers\CustomerController@update')->name('customers.up')->middleware('auth');
  Route::get('customer/destroy/{customer}', 'backend\customers\CustomerController@destroy')->name('customers.delete')->middleware('auth');
  Route::get('categories/search','backend\categories\CategoriesController@search')->name('categories.search')->middleware('auth');
  Route::resource('categories','backend\categories\CategoriesController')->middleware('auth');
  Route::post('categories/edit/{category}', 'backend\categories\CategoriesController@update')->name('categories.up')->middleware('auth');
  Route::get('categories/destroy/{category}', 'backend\categories\CategoriesController@destroy')->name('categories.delete')->middleware('auth');
  Route::get('species/search','backend\species\SpeciesController@search')->name('species.search')->middleware('auth');
  Route::resource('species','backend\species\SpeciesController')->middleware('auth');
  Route::post('species/edit/{specy}', 'backend\species\SpeciesController@update')->name('species.up')->middleware('auth');
  Route::get('species/destroy/{specy}', 'backend\species\SpeciesController@destroy')->name('species.delete')->middleware('auth');
  Route::get('books/search','backend\books\BooksController@search')->name('books.search')->middleware('auth');
  Route::resource('books','backend\books\BooksController')->middleware('auth');
  Route::post('books/edit/{book}', 'backend\books\BooksController@update')->name('books.up')->middleware('auth');
  Route::get('books/destroy/{book}', 'backend\books\BooksController@destroy')->name('books.delete')->middleware('auth');
  Route::get('adv', 'backend\adv\AdvController@index')->name('adv.index')->middleware('auth');
  Route::post('adv/update_btv', 'backend\adv\AdvController@update_btv')->name('adv.update_btv')->middleware('auth');
  Route::post('adv/update_qc', 'backend\adv\AdvController@update_qc')->name('adv.update_qc')->middleware('auth');
  Route::get('adv/{id}', 'backend\adv\AdvController@delete')->name('adv.delete')->middleware('auth');
});
Route::get('/index','frontend\IndexController@index')->name('frontend.index');
Route::get('/danhmuc/{category}','frontend\IndexController@danhsach')->name('frontend.danhsach');
Route::get('/theloai/{specy}','frontend\IndexController@theloai')->name('frontend.theloai');
Route::get('/detail/{id}','frontend\IndexController@show')->name('frontend.show');
