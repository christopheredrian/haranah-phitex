<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Mail\GenericMail;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Session;

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
//        $addresses = [
//            'christopheredrian@gmail.com',
//            'test@haranah.com',
//            'maxwellrenard@gmail.com'
//        ];
        $event = Event::find($event_id);
        switch ($to) {
            case 'buyers':
                $addresses = array();
                foreach ($event->buyers as $buyer) {
                    $addresses[] = $buyer->user->email;
                }
                Session::put('addresses', $addresses);
                return view('emails.event')
                    ->with('title', 'Emailing all buyers for this event')
                    ->with('event_id', $event_id)
                    ->with('to', 'Buyers')
                    ->with('buyers', $event->buyers);
                break;
            case 'sellers':
                $addresses = array();
                foreach ($event->sellers as $seller) {
                    $addresses[] = $seller->user->email;
                }
                Session::put('addresses', $addresses);
                return view('emails.event')
                    ->with('title', 'Emailing all sellers for this event')
                    ->with('event_id', $event_id)
                    ->with('to', 'Sellers')
                    ->with('sellers', $event->sellers);
                break;
            case 'all':
                $addresses = array();
                foreach ($event->sellers as $seller) {
                    $addresses[] = $seller->user->email;
                }
                foreach ($event->buyers as $buyer) {
                    $addresses[] = $buyer->user->email;
                }
                Session::put('addresses', $addresses);
                return view('emails.event')
                    ->with('title', 'Emailing all buyers and sellers for this event')
                    ->with('event_id', $event_id)
                    ->with('to', 'Buyers and Sellers')
                    ->with('buyers', $event->buyers)
                    ->with('sellers', $event->sellers);
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

        $data = [
            'body' => $request->body, // this should be required
            'address' => $request->address,
            'subject' => $request->subject,
            'name' => $request->name,
            'from' => $request->from
        ];
        Mail::to($addresses ? $addresses : 'christopheredrian@gmail.com')
            ->queue(new GenericMail($data));
        Session::flash('flash_message', 'Successfully sent email!');
        return redirect('/admin/events/' . $event_id);
    }

    /**
     * Send mail to multiple email addressess
     * @param $addressess - array of email addressess
     * @param $body
     * @param $address
     * @param $subject
     * @param $name
     * @param $from
     * @param $redirect_url
     * @param $success_message
     */
    public static function sendToMultiple($addresses, $body, $subject, $name, $from_address)
    {
        Redirect::to('/login');
        $data = [
            'body' => $body, // this should be required
            'address' => $from_address,
            'subject' => $subject,
            'name' => $name,
            'from' => $from_address
        ];
        Mail::to($addresses ? $addresses : 'christopheredrian@gmail.com')
            ->queue(new GenericMail($data));
        return true;

    }

}
