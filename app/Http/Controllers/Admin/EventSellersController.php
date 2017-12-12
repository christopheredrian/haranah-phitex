<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EventSeller;
use App\EventBuyer;
use App\Event;
use App\Seller;
use App\User;
use App\Buyer;
use Illuminate\Http\Request;

class EventSellersController extends Controller
{
    private function getSellers($event_id)
    {
//        $seller_names = [];
//        $sellers = \App\User::whereIn('id', \App\Seller::where('id' ,'>' ,0)->whereNotIn('id',\App\EventSeller::where('event_id','=',$event_id)->pluck('seller_id'))->pluck('user_id')->toArray())->orderBy('last_name')->get();
//        //whereNotIn('id',\App\EventSeller::where('event_id','=',$event_id))
//        foreach ($sellers as $seller) {
//            $sellerid = \App\Seller::where('user_id' ,'=' ,$seller->id)->value('id');
//            $seller_names[$sellerid] = $seller->last_name.", ".$seller->first_name;
//        }
        $sellers = Seller::whereNotIn('id',
            Event::find($event_id)
                ->sellers->pluck('id')
                ->toArray())
            ->get();
        return $sellers;
    }
    public function createWithEvent($event_id)
    {
        return view('admin.event-sellers.create')
            ->with('event_id',$event_id)
            ->with('sellers', $this->getSellers($event_id));
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
            $eventsellers = EventSeller::where('event_id', 'LIKE', "%$keyword%")
                ->orWhere('seller_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $eventsellers = EventSeller::paginate($perPage);
        }

        return view('admin.event-sellers.index', compact('eventsellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.event-sellers.create')->with('fs_names',$this->getSellerNames());
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
        $seller = Seller::find($request->seller_id);
        $seller->event_id = $request->event_id;
        $seller->save();
//        EventSeller::create($requestData);
        return redirect('admin/events/'.$request->event_id)->with('flash_message', 'EventSeller added!');
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
        $eventseller = EventSeller::findOrFail($id);

        return view('admin.event-sellers.show', compact('eventseller'));
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
        $eventseller = EventSeller::findOrFail($id);

        return view('admin.event-sellers.edit', compact('eventseller'));
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
        
        $eventseller = EventSeller::findOrFail($id);
        $eventseller->update($requestData);

        return redirect('admin/event-sellers')->with('flash_message', 'EventSeller updated!');
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
        EventSeller::destroy($id);

        return redirect('admin/event-sellers')->with('flash_message', 'EventSeller deleted!');
    }

    public function delete($event_id, $seller_id)
    {
        $seller = Seller::find($seller_id);
        $seller->event_id = null;
        $seller->save();

        $event = Event::findOrFail($event_id);


        //$eventsellers = User::whereIn('user_id', Seller::whereIn('id',EventSeller::where('event_id' , '=','$id')))->pluck('last_name');
        //SELECT * FROM `users`  WHERE id IN (SELECT user_id from buyers WHERE id IN (SELECT buyer_id FROM `event_buyers`))

        // TODO: Refactor for 1:M
//        $eventsellers = User::whereIn('id',
//            Seller::whereIn('id',EventSeller::where('event_id','=',$id)
//                    ->pluck('seller_id'))
//                    ->pluck('user_id'))
//                    ->get();
        $eventsellers  = $event->sellers;

        // TODO: Refactor for 1:M
//        $eventbuyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',$id)
//            ->pluck('buyer_id'))
//            ->pluck('user_id'))
//            ->get();
        $eventbuyers = $event->buyers;

        return view('admin.events.show', compact('event'))
            ->with('eventbuyers',$eventbuyers)
            ->with('eventsellers',$eventsellers)
            ->with('buyers', $event->buyers)
            ->with('sellers', $event->sellers)
            ->with('event_id', $event_id);
//        return redirect('admin/event-buyers')->with('flash_message', 'EventBuyer deleted!');
    }
}
