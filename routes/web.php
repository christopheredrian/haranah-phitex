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


Route::group(['middleware' => ['auth']], function () {
    Route::get('/change-password', 'Admin\\UsersController@passwordForm');
    Route::post('/change-password', 'Admin\\UsersController@changePassword');

    // Reports
    Route::get('/reports/{event_id}', 'ReportsController@downloadSchedule');
    Route::get('/reports/{event_id}/pdf', 'ReportsController@downloadPdf');



    // MIDDLEWARE FOR ADMIN
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/home', 'HomeController@adminIndex')->name('adminHome');

        Route::get('/home', 'HomeController@adminIndex')->name('adminHome');
        // Admin users
        Route::post('/users/{user_id}/reset_password', 'Admin\\UsersController@reset_password');

        // Administrators CRUD is only for Super Administrators
        Route::group(['middleware' => 'superadmin'], function () {
            Route::resource('/administrators', 'Admin\\AdministratorsController');
            Route::resource('/super-administrators', 'Admin\\SuperAdministratorsController');
        });


        // Admin - Buyers
        Route::resource('/buyers', 'Admin\\BuyersController');

        // Admin - Sellers
        Route::resource('/sellers', 'Admin\\SellersController');

        // Admin - Events
        Route::resource('/events', 'Admin\\EventsController');
        Route::post('/events/{id}/openRegistration', [
            'as' => 'open.registration',
            'uses' => 'Admin\\EventsController@openRegistration'
        ]);
        Route::post('/events/{id}/closeRegistration', [
            'as' => 'close.registration',
            'uses' => 'Admin\\EventsController@closeRegistration'
        ]);
        Route::post('/events/{id}/finalizeSchedule', [
            'as' => 'finalize.schedule',
            'uses' => 'Admin\\EventsController@finalizeSchedule'
        ]);
        // Admin - Event Parameters
        Route::resource('/event-params', 'Admin\\EventParamsController');
        Route::get('/event-params/create/{event_id}', [
            'as' => 'create.event.params',
            'uses' => 'Admin\\EventParamsController@createWithEvent'
        ]);
        //Route::get('/event-params/{event_id}', 'EventParamsController@create')->name('event-params.create');

        //Admin - Event Buyers
        Route::resource('/event-buyers', 'Admin\\EventBuyersController');
        Route::get('/event-buyers/create/{event_id}', [
            'as' => 'create.event.buyers',
            'uses' => 'Admin\\EventBuyersController@createWithEvent'
        ]);
        Route::post('/event-buyers/{event_id}/{buyer_id}/delete', [
            'as' => 'delete.event.buyer',
            'uses' => 'Admin\\EventBuyersController@delete'
        ]);
        //Admin - Event Sellers
        Route::resource('/event-sellers', 'Admin\\EventSellersController');
        Route::get('/event-sellers/create/{event_id}', [
            'as' => 'create.event.sellers',
            'uses' => 'Admin\\EventSellersController@createWithEvent'
        ]);
        Route::post('/event-sellers/{event_id}/{seller_id}/delete', [
            'as' => 'delete.event.seller',
            'uses' => 'Admin\\EventSellersController@delete'
        ]);

        //Admin - Final Schedule
        Route::resource('/final-schedules', 'Admin\\FinalSchedulesController');
        Route::get('/final-schedules/list/{event_id}', [
            'as' => 'show.final.schedule',
            'uses' => 'Admin\\FinalSchedulesController@showWithEvent'
        ]);

        Route::get('/final-schedules/list/{event_id}', [
            'as' => 'show.final.list.schedule',
            'uses' => 'Admin\\FinalSchedulesController@showList'
        ]);

        Route::get('/final-schedules/create/{event_id}', [
            'as' => 'create.final.schedule',
            'uses' => 'Admin\\FinalSchedulesController@createWithEvent'
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

        // TEMPORARY!!!
//        Route::get('/profile', function(){
//            return view('buyer.show');
//        });

        Route::get('/profile', [
            'as' => 'buyers.show',
            'uses' => 'Buyer\\BuyerProfilesController@show'
        ]);

        Route::get('/edit', [
            'as' => 'buyers.edit',
            'uses' => 'Buyer\\BuyerProfilesController@edit'
        ]);

        Route::post('/submit', [
            'as' => 'buyers.update',
            'uses' => 'Buyer\\BuyerProfilesController@update'
        ]);
    });

    // MIDDLEWARE FOR SELLER
    Route::group(['prefix' => 'seller', 'middleware' => 'seller'], function () {
        Route::get('/home', 'HomeController@sellerIndex')->name('sellerHome');
//        Route::get('/home', 'Seller\\SellerController@showEvents');

        // NOT TESTED
        Route::resource('seller', 'Seller\\SellerController');
        Route::get('/events', [
            'as' => 'list.events',
            'uses' => 'Seller\\SellerController@showEvents'
        ]);

        Route::get('/{user_id}/profile', [
            'as' => 'seller.show',
            'uses' => 'Seller\\SellerController@show'
        ]);

        Route::get('/{user_id}/profile', [
            'as' => 'seller.cbuyer',
            'uses' => 'Seller\\SellerController@showBuyerProfile'
        ]);

        Route::get('/events/{id}', [
            'as' => 'list.buyer',
            'uses' => 'Seller\\SellerController@sellerPreference'
        ]);

        Route::post('/events/{id}/submit', [
            'as' => 'preference.submit',
            'uses' => 'Seller\\SellerController@submitPreferences'
        ]);


        //Seller
        Route::get('/index', function () {
            return view('seller.index');
        });
        Route::get('/seller/event', function () {
            return view('seller.event');
        });
        Route::get('/account', function () {
            return view('seller.account');
        });
        Route::get('/list', function () {
            return view('seller.list');
        });

    });

    Route::post('/change-status/{user_id}', 'Admin\\UsersController@changeStatus');

    //
    Route::post('/importBuyersOrSellers', 'FileController@importBuyersOrSellers');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('admin/seller-preferences', 'Admin\\SellerPreferencesController');
