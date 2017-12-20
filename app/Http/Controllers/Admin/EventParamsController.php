<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EventParam;
use Illuminate\Http\Request;

class EventParamsController extends Controller
{
    public function createWithEvent($event_id)
    {
        return view('admin.event-params.create')->with('event_id',$event_id);
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
            $eventparams = EventParam::where('start_time', 'LIKE', "%$keyword%")
                ->orWhere('end_time', 'LIKE', "%$keyword%")
                ->orWhere('event_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $eventparams = EventParam::paginate($perPage);
        }

        return view('admin.event-params.index', compact('eventparams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.event-params.create');
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
        EventParam::create($requestData);

        for ($i = 1; array_key_exists('start_time'.$i, $requestData); $i++) {
                $schedule = EventParam::create();
                $schedule->start_time = $requestData['start_time'.$i];
                $schedule->end_time = $requestData['end_time'.$i];
                $schedule->event_id = $requestData['event_id'];
                $schedule->save();

            }



        return redirect('admin/events/'.$request->event_id)->with('flash_message', 'EventBuyer added!');
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
        $eventparam = EventParam::findOrFail($id);

        return view('admin.event-params.show', compact('eventparam'));
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
        $eventparam = EventParam::findOrFail($id);

        return view('admin.event-params.edit', compact('eventparam'));
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
        
        $eventparam = EventParam::findOrFail($id);
        $eventparam->update($requestData);

        return redirect('admin/event-params')->with('flash_message', 'EventParam updated!');
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
        EventParam::destroy($id);

        return redirect('admin/event-params')->with('flash_message', 'EventParam deleted!');
    }
}
