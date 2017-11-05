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

Route::get('/', function () {

    return view('welcome');
});

Route::get('/list', function () {
    return view('admin.buyers.list');
});


Route::get('/emails', function(){ return view('emails.index'); });
// Just my test route for sending mails Will put in Controller later
Route::post('/emails/sendmail', 'Admin\\MailController@testMail');




Route::group(['middleware' => ['auth']], function () {
    Route::resource('admin/administrators', 'Admin\\AdministratorsController');
    Route::resource('admin/super-administrators', 'Admin\\SuperAdministratorsController');
    Route::resource('admin/buyers', 'Admin\\BuyersController');
    Route::resource('admin/sellers', 'Admin\\SellersController');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/events', 'Admin\\EventsController');
