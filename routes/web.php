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

//Seller
Route::get('/seller/index', function () {
    return view('seller.index');
});
Route::get('/seller/event', function () {
    return view('seller.event');
});
Route::get('/seller/account', function () {
    return view('seller.account');
});
Route::get('/list', function () {
    return view('seller.list');
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
        Route::resource('/event-params', 'Admin\\EventParamsController');
        //Route::get('/event-params/{event_id}', 'EventParamsController@create')->name('event-params.create');

        //Admin - Event Buyers
        Route::resource('/event-buyers', 'Admin\\EventBuyersController');
        Route::get('/event-buyers/create/{event_id}', [
            'as' => 'create.event.buyers',
            'uses' => 'Admin\\EventBuyersController@createWithEvent'
        ]);

        //Admin - Event Sellers
        Route::resource('/event-sellers', 'Admin\\EventSellersController');
        Route::get('/event-sellers/create/{event_id}', [
            'as' => 'create.event.sellers',
            'uses' => 'Admin\\EventSellersController@createWithEvent'
        ]);

        // Admin - Account
        Route::resource('/account', 'Admin\\AdministratorsController');


        // Mailing
        Route::get('/event/{event_id}/mail', 'Admin\\MailController@mailParticipants');
        Route::post('/event/{event_id}/sendmail', 'Admin\\MailController@sendMailParticipants');
        // Route::post('/admin/event/{event_id}/mail', 'Admin\\MailController@testmail');
        //Route::get('/mail/run', 'Admin\\MailController@run');
    });

    // MIDDLEWARE FOR BUYER
    Route::group(['prefix' => 'buyer', 'middleware' => 'buyer'], function () {
        Route::get('/home', 'HomeController@buyerIndex')->name('buyerHome');
//        Route::get('/profile', 'Buyer\\BuyerProfilesController@index');

        // TEMPORARY!!!
        Route::get('/dashboard', function(){
//            dd("Dashboard");
            return view('buyer.index');
        });
        Route::get('/events', function(){
//            dd("Events");
            return view('buyer.events');
        });
        Route::get('/profile', function(){
//            dd("Events");
            return view('buyer.show');
        });
        Route::get('/edit', function(){
//            dd("Events");
            return view('buyer.edit');
        });
    });

    // MIDDLEWARE FOR SELLER
    Route::group(['prefix' => 'seller', 'middleware' => 'seller'], function () {
        Route::get('/home', 'HomeController@sellerIndex')->name('sellerHome');

        // NOT TESTED
        Route::resource('seller', 'Seller\\SellerController');

        Route::get('/seller/list/{id}', [
            'as' => 'list.buyer',
            'uses' => 'Seller\\SellerController@showList'
        ]);
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
Route::resource('admin/seller-preferences', 'Admin\\SellerPreferencesController');