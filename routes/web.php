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
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });
Route::get('/list', function () { return view('admin.buyers.list'); });
Route::group(['middleware' => ['auth']], function () {
    // Resources
    Route::resource('admin/administrators', 'Admin\\AdministratorsController');
    Route::resource('admin/super-administrators', 'Admin\\SuperAdministratorsController');
    Route::resource('admin/buyers', 'Admin\\BuyersController');
    Route::resource('admin/sellers', 'Admin\\SellersController');
    Route::resource('admin/events', 'Admin\\EventsController');
    // Mailing
    Route::get('/admin/event/{event_id}/mail', 'Admin\\MailController@mailParticipants');
//    Route::post('/admin/event/{event_id}/mail', 'Admin\\MailController@');
    Route::get('/mail/run', 'Admin\\MailController@run');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
