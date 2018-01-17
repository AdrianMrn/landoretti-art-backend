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
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
	Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('auctions', 'AuctionController');
    Route::resource('photo', 'PhotoController');
    Route::resource('style', 'StyleController');
    Route::resource('isearch', 'ISearchController');
    Route::resource('bid', 'BidController');
    Route::resource('watchlist', 'WatchlistItemController');

    Route::post('/watchlist/clear', 'WatchlistItemController@clear')->name('clearWatchlist');
    Route::get('/myauctions', 'AuctionController@myAuctions')->name('myAuctions');

    Route::get('/buyacount/{id}', 'AuctionController@buyNow')->name('buynow');
});
