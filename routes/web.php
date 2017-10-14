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

Route::get('/emails', function(){ return view('emails.index'); });
// Just my test route for sending mails Will put in Controller later
Route::post('/emails/sendmail', function(\Illuminate\Http\Request $request){
    $from = new SendGrid\Email("Example User", $request->input('from'));
    $subject = $request->input('subject');
    $to = new SendGrid\Email("Example User", $request->input('to'));
    $content = new SendGrid\Content("text/plain", $request->input('content'));
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
//    dd($mail);
//    $apiKey = getenv('SENDGRID_API_KEY');
    $apiKey = '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';
    $sg = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    print_r($response->headers());
    echo $response->body();
});

