<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use App\Seller;
use App\EventSeller;
use App\SellerPreference;
use App\User;
use App\EventBuyer;
use App\Buyer;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Session;

class EventsController extends Controller
{
    private $event_validation = [
        'event_name' => 'required',
        'event_place' => 'required',
        'event_date' => 'required',
        'event_description' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $events = Event::where('event_name', 'LIKE', "%$keyword%")
                ->orWhere('event_place', 'LIKE', "%$keyword%")
                ->orWhere('event_date', 'LIKE', "%$keyword%")
                ->orWhere('event_status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $events = Event::orderByDesc('created_at')->paginate($perPage);
        }

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate($this->event_validation);
        $requestData = $request->all();

        $event = Event::create($requestData);
        $event->event_status = 'New Event';
        $event->save();

        return redirect('admin/events')->with('flash_message', 'Event added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $sellerID = Seller::where('user_id', '=', Auth::user()->id)->first();
        $schedule = DB::table('final_schedules')
            ->join('event_params', 'final_schedules.event_param_id', '=', 'event_params.id')
            ->where('final_schedules.event_id', '=', $id)
            ->get();
        $event = Event::findOrFail($id);

        //$eventsellers = User::whereIn('user_id', Seller::whereIn('id',EventSeller::where('event_id' , '=','$id')))->pluck('last_name');
        //SELECT * FROM `users`  WHERE id IN (SELECT user_id from buyers WHERE id IN (SELECT buyer_id FROM `event_buyers`))

        // TODO: Refactor for 1:M
//        $eventsellers = User::whereIn('id',
//            Seller::whereIn('id',EventSeller::where('event_id','=',$id)
//                    ->pluck('seller_id'))
//                    ->pluck('user_id'))
//                    ->get();
//        dd($event->buyers);
        $eventsellers = $event->sellers;
//        dd($eventsellers);

        // TODO: Refactor for 1:M
//        $eventbuyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',$id)
//            ->pluck('buyer_id'))
//            ->pluck('user_id'))
//            ->get();
        $eventbuyers = $event->buyers;

        return view('admin.events.show', compact('event'))
            ->with('eventbuyers', $eventbuyers)
            ->with('eventsellers', $eventsellers)
            ->with('buyers', $event->buyers)
            ->with('sellers', $event->sellers)
            ->with('event_id', $id)
            ->with('schedule', $schedule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);


        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->event_validation);
        $requestData = $request->all();

        $event = Event::findOrFail($id);
        $event->update($requestData);

        return redirect('admin/events')->with('flash_message', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Event::destroy($id);
        return redirect('admin/events')->with('flash_message', 'Event deleted!');
    }

    /**
     * Opens event registration
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function openRegistration($id)
    {
        $event = Event::FindorFail($id);
        $event->event_status = "Registration Open";
        $event->save();
        return redirect('admin/events/' . $id)->with('flash_message', 'Event updated!');
    }

    public function closeRegistration($id)
    {
//       DB::transaction(function() use ($id){

        $event = Event::FindorFail($id);
        $event->event_status = "Registration Closed";
        $event->save();

        // TODO: Refactor for 1:M
//        $noSellerPreference = \App\Seller::whereIn('id',
//            EventSeller::where('event_id','=',$id)->pluck('seller_id'))
//            ->whereNotIn('id',\App\SellerPreference::where('event_id', '=', $id)->pluck('seller_id'))->get();
        $noSellerPreference = SellerPreference::getSellersWithoutPreferences($id);

        // TODO: Refactor for 1:M
//        $eventBuyers = \App\Buyer::whereIn('id',EventBuyer::where('event_id','=',$id)->pluck('buyer_id'))->get();
        $eventBuyers = $event->buyers;
        $counter = 1;
        foreach ($noSellerPreference as $seller) {
            foreach ($eventBuyers as $buyer) {

                $newSellerPreference = new \App\SellerPreference();
                $newSellerPreference->event_id = $id;
                $newSellerPreference->buyer_id = $buyer->id;
                $newSellerPreference->seller_id = $seller->seller_id;
                $newSellerPreference->rank = $counter;
                $newSellerPreference->save();
                $counter = $counter + 1;
            }
            $counter = 1;
        }

        $event_params = \App\EventParam::where('event_id', '=', $id)->orderBy('start_time')->pluck('id');
        $seller_preference = \App\SellerPreference::where('event_id', '=', $id)
            ->orderBy('created_at')
            ->orderBy('rank')
            ->get();

        // TODO: Refactor for 1:M
//        $sellercount = User::whereIn('id', Seller::whereIn('id',EventSeller::where('event_id','=',$id)
//            ->pluck('seller_id'))
//            ->pluck('user_id'))
//            ->count();
        $sellercount = $event->sellers->count();

        // For each of the schedules
        foreach ($event_params as $event_param) {

            for ($i = 1; $i <= $sellercount; $i++) {

                // For each of the seller preferences
                foreach ($seller_preference as $item) {

                    // Current seller_id  is not in final sched
                    if (\App\FinalSchedule::where('seller_id', '=', $item->seller_id)
                            ->where('event_param_id', '=', $event_param)->first() == null
                    ) {
                        // Current buyer_id is not in final sched
                        if (\App\FinalSchedule::where('buyer_id', '=', $item->buyer_id)->where('event_param_id', '=', $event_param)->first() == null) {

                            // Current buyer_id  and seller_id is not in final sched
                            if (\App\FinalSchedule::where('seller_id', '=', $item->seller_id)->where('buyer_id', '=', $item->buyer_id)->where('event_id', '=', $id)->first() == null) {
                                // Create the schedule
                                $final_schedule = new \App\FinalSchedule();
                                $final_schedule->event_id = $id;
                                $final_schedule->seller_id = $item->seller_id;
                                $final_schedule->event_param_id = $event_param;
                                $final_schedule->buyer_id = $item->buyer_id;
                                $final_schedule->save();
                            }
                        }
                    }
                }
            }
        }
//       } );

        return redirect('admin/events/' . $id)->with('flash_message', 'Event updated!');
    }

    public function finalizeSchedule($id)
    {
        $event = Event::FindorFail($id);
        $event->event_status = "Schedule Finalized";
        $event->save();
        return redirect('admin/events/' . $id)->with('flash_message', 'Event updated!');
    }

    public function sendNotificationEmails($event_id)
    {
        try {
            $event = Event::find($event_id);

            $new_buyer_emails = [];
            $new_seller_emails = [];
            $old_buyer_emails = [];
            $old_seller_emails = [];

            foreach ($event->buyers as $buyer) {
                if ($buyer->events->count() === 1) {
                    $new_buyer_emails[] = $buyer->user->email;
                } else {
                    $old_buyer_emails[] = $buyer->user->email;
                }
            }

            foreach ($event->sellers as $seller) {
                if ($seller->events->count() === 1) {
                    $new_seller_emails[] = $seller->user->email;
                } else {
                    $old_seller_emails[] = $seller->user->email;
                }
            }

            $new_user_emails = array_merge($new_buyer_emails, $new_seller_emails);
            $old_user_emails = array_merge($old_buyer_emails, $old_seller_emails);

            if ($event->buyers->count() && $event->sellers->count()) {
                $url = env('APP_URL');

                if (count($new_user_emails) > 1) {
                    $new_is_complete = \App\Http\Controllers\Admin\MailController::sendToMultiple(
                        $new_user_emails,
                        "Thank you for registering in Haranah Phitex's $event->event_name event. <a href='$url/password/reset'> Here</a> is the link to reset your password ($url/password/reset).",
                        'Reset Password - Haranah Phitex',
                        'Haranah Phitex',
                        'jasmine.tan@haranahtours.com.ph');
                }

                $old_is_complete = \App\Http\Controllers\Admin\MailController::sendToMultiple(
                    $old_user_emails,
                    "Thank you for registering in Haranah Phitex's $event->event_name event. <a href='$url/login'> Here</a> is the link to to login to your account ($url/login).",
                    $event->event_name . ' Event - Haranah Phitex',
                    'Haranah Phitex',
                    'jasmine.tan@haranahtours.com.ph');

                if ((isset($new_is_complete) && isset($old_is_complete)) && ($new_is_complete && $old_is_complete)) {
                    $flag = true;
                } elseif (isset($old_is_complete) && $old_is_complete) {
                    $flag = true;
                } elseif (isset($new_is_complete) && $new_is_complete) {
                    $flag = true;
                } else {
                    $flag = false;
                }

                if ($flag) {
                    Session::flash('flash_message', 'Success! An email was sent to all buyers and sellers.');
                    Session::flash('alert-class', 'alert-success');
                } else {
                    Session::flash('flash_message', 'An error occurred. The mail server may be down.');
                    Session::flash('alert-class', 'alert-danger');
                }

                return redirect('admin/events/' . $event_id);
            }
        } catch (Exception $e) {
            Session::flash('flash_message', 'An error occurred. There might be invalid columns in the  import file or some emails are already taken.');
            Session::flash('alert-class', 'alert-danger');

            return redirect('admin/events/' . $event_id);
        }
    }

}
