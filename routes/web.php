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

Route::get('/', function () { return view('welcome'); });
Route::get('/list', function () { return view('admin.buyers.list'); });
Route::group(['middleware' => ['auth']], function () {
    // Resources
    Route::resource('sellers', 'Admin\\SellersController');
    Route::resource('buyers', 'Admin\\BuyersController');
    Route::resource('administrators', 'Admin\\AdministratorsController');
    Route::resource('super-administrators', 'Admin\\SuperAdministratorsController');
    Route::resource('admin/events', 'Admin\\EventsController');
    // Mailing
    Route::get('/admin/event/{event_id}/mail', 'Admin\\MailController@mailParticipants');
//    Route::post('/admin/event/{event_id}/mail', 'Admin\\MailController@');
    Route::get('/mail/run', 'Admin\\MailController@run');


});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
