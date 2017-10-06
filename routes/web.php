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

Route::get('/', function () {
    return view('welcome');
});

// Email sample
Route::get('/test-mail', function(){
    $data = [];
    Mail::send('emails.reminder', [], function ($m) use ($data) {
        $m->from('hello@app.com', 'Your Application');
        $m->to('christopheredrian@gmail.com', 'chriseds')->subject('Your Reminder!');
    });
});
