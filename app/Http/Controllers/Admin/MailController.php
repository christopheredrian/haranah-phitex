<?php

namespace App\Http\Controllers\Admin;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function testMail(Request $request){
        $data = [
            'body' => $request->input('body'), // this should be required
            'address' => $request->address,
            'subject' => $request->subject,
            'name' => $request->name,
            'from' => $request->from
        ];
        Mail::to( $request->to ? $request->to :  'christopheredrian@gmail.com')->send(new TestEmail($data));
        dd('Email Sent');
    }
}
