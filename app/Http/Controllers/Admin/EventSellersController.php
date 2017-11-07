<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EventSeller;
use Illuminate\Http\Request;

class EventSellersController extends Controller
{
    private function getSellerNames()
    {
        $seller_names = [];
        $sellers = \App\Seller::orderBy('user_id')->get();
        foreach ($sellers as $seller) {
            $seller_names[$seller->id] = $seller->user_id;
        }
        return $seller_names;
    }
    public function createWithEvent($event_id)
    {
        return view('admin.event-sellers.create')->with('event_id',$event_id);
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
        
        EventSeller::create($requestData);

        return redirect('admin/event-sellers')->with('flash_message', 'EventSeller added!');
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
}
