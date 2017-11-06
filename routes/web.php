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
Route::get('/login', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('admin.auth.register');
});
Route::get('/list', function () {
    return view('admin.buyers.list');
});
Route::get('/buyer_profile/profile', function () {
    return view('buyer_profile.profile');
});
Route::group(['middleware' => ['auth']], function () {

    // Reports
    Route::get('/reports/{event_id}', 'ReportsController@downloadSchedule');
    Route::get('/reports/{event_id}/pdf', 'ReportsController@downloadPdf');

    // MIDDLEWARE FOR ADMIN
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/home', 'HomeController@adminIndex')->name('adminHome');


        // Admin users
        Route::post('/users/{user_id}/reset_password', 'Admin\\UsersController@reset_password');

        // Resources
        Route::resource('/administrators', 'Admin\\AdministratorsController');
        Route::resource('/super-administrators', 'Admin\\SuperAdministratorsController');

        // Admin - Buyers
        Route::resource('/buyers', 'Admin\\BuyersController');
        // Admin - Sellers
        Route::resource('/sellers', 'Admin\\SellersController');

        // Admin - Events
        Route::resource('/events', 'Admin\\EventsController');
        // Admin - Event Parameters
        Route::resource('admin/event-params', 'Admin\\EventParamsController');
        // Mailing
        Route::get('/event/{event_id}/mail', 'Admin\\MailController@mailParticipants');
        Route::post('/event/{event_id}/sendmail', 'Admin\\MailController@sendMailParticipants');
        // Route::post('/admin/event/{event_id}/mail', 'Admin\\MailController@testmail');
        //Route::get('/mail/run', 'Admin\\MailController@run');
    });

    // MIDDLEWARE FOR BUYER
    Route::group(['prefix' => 'buyer', 'middleware' => 'buyer'], function () {
        Route::get('/home', 'HomeController@buyerIndex')->name('buyerHome');

    });

    // MIDDLEWARE FOR SELLER
    Route::group(['prefix' => 'seller', 'middleware' => 'seller'], function () {
        Route::get('/home', 'HomeController@sellerIndex')->name('sellerHome');

    });

    Route::post('/admin/buyers/{user_id}/change_status', function($user_id){
       $user = \App\User::findOrFail($user_id);
       $user->activated = ($user->activated > 0 ? 0 : 1);
       $user->save();
       return back();
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('buyer_profile', 'Buyer\\Buyer_ProfileController');
Route::resource('seller', 'Seller\\SellerController');

Route::resource('admin/event-sellers', 'Admin\\EventSellersController');
Route::resource('admin/event-buyers', 'Admin\\EventBuyersController');
