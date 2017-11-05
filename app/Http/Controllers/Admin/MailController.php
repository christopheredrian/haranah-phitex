<?php

namespace App\Http\Controllers\Admin;

use App\Mail\GenericMail;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function run(){
       MailController::sendMail(
            'superadmin@haranah.com', // email address FROM?
            'maxwellrenard@gmail.com', // to
            'This is the email content.
             This is the email content. This is the email content.
              This is the email content. This is the email content. 
            This is the email content. 
            This is the email content. 
            This is the email content. 
            This is the email content. ', // email body
            'Haranah-Phitex',  // email subject
            'John Doe'); // name
        dd('mailsent');
    }

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


    /**
     * Helper function for sending emails
     * @param $from - from address
     * @param $to - to address
     * @param $body - the message
     * @param $address -
     * @param $subject
     * @param $name
     */
    public static function sendMail($address_from, $to, $body , $subject, $name){
        $data = [
            'body' => $body, // this should be required
            'address' => $address_from,
            'subject' => $subject,
            'name' => $name
        ];
        Mail::to($to)->send(new GenericMail($data));
    }





    public function mailParticipants(Request $request, $event_id){
        $to = $request->get('to');
        switch ($to){
            case 'buyers':
                return view('emails.event', ['title' => 'Emailing all buyers for this event']);
                break;
            case 'sellers':
                return view('emails.event', ['title' => 'Emailing all sellers for this event']);
                break;
            case 'all':
                return view('emails.event', ['title' => 'Emailing all the buyers and sellers for this event']);
                break;
            default:
                dd('invalid parameter');
                break;
        }
    }
}
