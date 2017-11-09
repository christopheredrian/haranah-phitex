<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use App\Seller;
use App\EventSeller;
use App\User;
use App\EventBuyer;
use App\Buyer;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    private $event_validation = [
        'event_name' => 'required',
        'event_place' => 'required',
        'event_date' => 'required',
        'event_status' => 'required',
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
            $events = Event::where('event_name', 'LIKE', "%$keyword%")->orWhere('event_place', 'LIKE', "%$keyword%")->orWhere('event_date', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $events = Event::paginate($perPage);
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
        
        Event::create($requestData);

        return redirect('admin/events')->with('flash_message', 'Event added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        //$eventsellers = User::whereIn('user_id', Seller::whereIn('id',EventSeller::where('event_id' , '=','$id')))->pluck('last_name');
        //SELECT * FROM `users`  WHERE id IN (SELECT user_id from buyers WHERE id IN (SELECT buyer_id FROM `event_buyers`))
        $eventsellers = User::whereIn('id', Seller::whereIn('id',EventSeller::where('event_id','=',$id)
                    ->pluck('seller_id'))
                    ->pluck('user_id'))
                    ->get();

        $eventbuyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',$id)
            ->pluck('buyer_id'))
            ->pluck('user_id'))
            ->get();

        return view('admin.events.show', compact('event'))
            ->with('eventbuyers',$eventbuyers)
            ->with('eventsellers',$eventsellers)
            ->with('buyers', $event->buyers)
            ->with('sellers', $event->sellers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
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
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Event::destroy($id);

        return redirect('admin/events')->with('flash_message', 'Event deleted!');
    }
}
