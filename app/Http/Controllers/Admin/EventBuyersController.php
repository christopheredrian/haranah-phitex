<?php

namespace App\Http\Controllers\Admin;

use App\BuyerEvent;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EventBuyer;
use App\Event;
use App\Seller;
use App\EventSeller;
use App\User;
use App\Buyer;
use Illuminate\Http\Request;

class EventBuyersController extends Controller
{
    private function getBuyers($event_id)
    {
//        $buyers = \App\User::whereIn('id', \App\Buyer::where('id' ,'>' ,0)->whereNotIn('id',\App\EventBuyer::where('event_id','=',$event_id)->pluck('buyer_id'))->pluck('user_id')->toArray())->orderBy('last_name')->get();
        $buyers = Buyer::whereNotIn('id',
            Event::find($event_id)
            ->buyers->pluck('id')
            ->toArray())
            ->get();
//        foreach ($buyers as $buyer) {
//            $buyerid = \App\Buyer::where('user_id' ,'=' ,$buyer->id)->value('id');
//            $buyer_names[$buyerid] = $buyer->last_name.", ".$buyer->first_name;
//        }
        return $buyers;
    }

    public function createWithEvent($event_id)
    {
        return view('admin.event-buyers.create')
            ->with('event_id',$event_id)
            ->with('buyers', $this->getBuyers($event_id));
    }
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
            $eventbuyers = EventBuyer::where('event_id', 'LIKE', "%$keyword%")
                ->orWhere('buyer_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $eventbuyers = EventBuyer::paginate($perPage);
        }

        return view('admin.event-buyers.index', compact('eventbuyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.event-buyers.create')->with('fs_names',$this->getBuyerNames());
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
        $requestData = $request->all();
        $buyer = Buyer::find($request->buyer_id);
        $buyer->event_id = $request->event_id;
        $buyer->save();

        $event_buyer = new BuyerEvent();
        $event_buyer->event_id = $buyer->event_id;
        $event_buyer->buyer_id = $buyer->id;
        $event_buyer->save();

        for ($i = 1; array_key_exists('buyer_id'.$i, $requestData); $i++) {
            $buyer = Buyer::find($requestData['buyer_id'.$i]);
            EventSeller::firstOrCreate(
                ['event_id' => $request->event_id],
                ['buyer_id' => $buyer->id]
            );
//            $buyer_event = new BuyerEvent();
//            $buyer_event->event_id = $request->event_id;
//            $buyer_event->buyer_id = $buyer->id;
//            $buyer_event->save();

//            $buyer->event_id = $request->event_id;
//            $buyer->save();
        }
        return redirect('admin/events/'.$request->event_id)
            ->with('flash_message', 'EventBuyer added!');
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
        $eventbuyer = EventBuyer::findOrFail($id);

        return view('admin.event-buyers.show', compact('eventbuyer'));
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
        $eventbuyer = EventBuyer::findOrFail($id);

        return view('admin.event-buyers.edit', compact('eventbuyer'));
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
        
        $requestData = $request->all();
        
        $eventbuyer = EventBuyer::findOrFail($id);
        $eventbuyer->update($requestData);

        return redirect('admin/event-buyers')->with('flash_message', 'EventBuyer updated!');
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

        EventBuyer::destroy($id);

        return redirect('admin/event-buyers')->with('flash_message', 'EventBuyer deleted!');
    }

    public function delete($event_id, $buyer_id)
    {
        $buyer = Buyer::find($buyer_id);
        $buyer->event_id = null;
        $buyer->save();

        return redirect('admin/events/'.$event_id)->with('flash_message', 'EventBuyer deleted!');

    }
}
