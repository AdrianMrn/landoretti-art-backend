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

Auth::routes();

/* Route::get('/home', 'HomeController@index')->name('home'); */
Route::get('/', 'HomeController@index')->name('home');

/* Route::group(['middleware' => ['auth']], function () {

}); */

Route::resource('auction', 'AuctionController');
Route::resource('photo', 'PhotoController');
Route::resource('style', 'StyleController');
Route::resource('isearch', 'ISearchController');
Route::resource('bid', 'BidController');
Route::resource('watchlistitem', 'WatchlistItemController');
