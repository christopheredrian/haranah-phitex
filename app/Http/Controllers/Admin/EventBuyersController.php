<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EventBuyer;
use Illuminate\Http\Request;

class EventBuyersController extends Controller
{
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
        return view('admin.event-buyers.create');
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
        
        EventBuyer::create($requestData);

        return redirect('admin/event-buyers')->with('flash_message', 'EventBuyer added!');
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
}
