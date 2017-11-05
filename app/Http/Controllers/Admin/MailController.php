<?php

namespace App\Http\Controllers\Admin;

use App\Mail\GenericMail;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{

    public function run()
    {
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

    function testMail(Request $request)
    {
        $data = [
            'body' => $request->body, // this should be required
            'address' => $request->address,
            'subject' => $request->subject,
            'name' => $request->name,
            'from' => $request->from
        ];
        Mail::to($request->to ? $request->to : 'christopheredrian@gmail.com')->send(new TestEmail($data));
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
    public static function sendMail($address_from, $to, $body, $subject, $name)
    {
        $data = [
            'body' => $body, // this should be required
            'address' => $address_from,
            'subject' => $subject,
            'name' => $name
        ];
        Mail::to($to)->send(new GenericMail($data));
    }

    /**
     * Get request for sending emails to event buyers and sellers
     * @param Request $request
     * @param $event_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mailParticipants(Request $request, $event_id)
    {
        $to = $request->get('to');
        $addresses = [
            'christopheredrian@gmail.com',
            'test@haranah.com',
            'maxwellrenard@gmail.com'
        ];
        Session::put('addresses', $addresses);
        switch ($to) {
            case 'buyers':
                return view('emails.event')
                    ->with('title', 'Emailing all buyers for this event')
                    ->with('event_id', $event_id)
                    ->with('to', 'Buyers')
                    ->with('addresses', $addresses);
                break;
            case 'sellers':
                return view('emails.event')
                    ->with('title', 'Emailing all sellers for this event')
                    ->with('event_id', $event_id)
                    ->with('to', 'Sellers')
                    ->with('addresses', $addresses);
                break;
            case 'all':
                return view('emails.event')
                    ->with('title', 'Emailing all buyers and sellers for this event')
                    ->with('event_id', $event_id)
                    ->with('to', 'Buyers and Sellers')
                    ->with('addresses', $addresses);
                break;
            default:
                dd('invalid parameter');
                break;
        }
    }

    /**
     * The post route for mailParticipants
     * @param Request $request
     */
    function sendMailParticipants(Request $request, $event_id)
    {
        // TODO: Get data from event_id
        $addresses = Session::get('addresses');
        Session::forget("addresses");
        $addresses = [
            'christopheredrian@gmail.com',
            'test@haranah.com',
            'test2@haranah.com',
            'test3@haranah.com',
            'test4@haranah.com',
            'test5@haranah.com',
            'test6@haranah.com',
            'test7@haranah.com',
            'test8@haranah.com',
            'test9@haranah.com',
            'test10@haranah.com',
            'test11@haranah.com',
            'test12@haranah.com',
            'test13@haranah.com',
            '14@haranah.com',
            '15@haranah.com',
            '16@haranah.com',
            '17@haranah.com',
            '18@haranah.com',
            '19@haranah.com',
            '20@haranah.com',
            '21@haranah.com',
            '22@haranah.com',
            '23@haranah.com',
            '24@haranah.com',
            '25@haranah.com',
            '26@haranah.com',
            '27@haranah.com',
            '28@haranah.com',
            '29@haranah.com',
            '30@haranah.com',
            '31@haranah.com',
            '32@haranah.com',
            '33@haranah.com',
            'maxwellrenard@gmail.com'
        ];
        $data = [
            'body' => $request->body, // this should be required
            'address' => $request->address,
            'subject' => $request->subject,
            'name' => $request->name,
            'from' => $request->from
        ];
        Mail::to($addresses ? $addresses : 'christopheredrian@gmail.com')
            ->queue(new GenericMail($data));
        dd('Email Sent');
    }
}
