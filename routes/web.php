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

Route::get('/buyer_profile/profile', function () {
    return view('buyer_profile.profile');
});

Route::get('/', function () {
    return view('public');
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

Route::group(['middleware' => ['auth']], function () {
    // Admin users
    Route::post('admin/users/{user_id}/reset_password', 'Admin\\UsersController@reset_password');

    // Resources
    Route::resource('admin/administrators', 'Admin\\AdministratorsController');
    Route::resource('admin/super-administrators', 'Admin\\SuperAdministratorsController');

    // Admin - Buyers
    Route::resource('admin/buyers', 'Admin\\BuyersController');
    // Admin - Sellers
    Route::resource('admin/sellers', 'Admin\\SellersController');

    // Admin - Events
    Route::resource('admin/events', 'Admin\\EventsController');
    // Admin - Event Parameters
    Route::resource('admin/event-params', 'Admin\\EventParamsController');
    // Mailing
    Route::get('admin/event/{event_id}/mail', 'Admin\\MailController@mailParticipants');
    Route::post('admin/event/{event_id}/sendmail', 'Admin\\MailController@sendMailParticipants');
    // Route::post('/admin/event/{event_id}/mail', 'Admin\\MailController@testmail');
    //Route::get('/mail/run', 'Admin\\MailController@run');
    // Reports
    Route::get('/reports/{event_id}', 'ReportsController@downloadSchedule');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('buyer_profile', 'Buyer\\Buyer_ProfileController');


