<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FinalSchedule;
use Illuminate\Http\Request;

class FinalSchedulesController extends Controller
{
    public function showWithEvent($event_id){
        //$keyword = $request->get('search');

        $perPage = 25;

//        if (!empty($keyword)) {
//            $finalschedules = FinalSchedule::where('event_id', '=', $id)
//                ->orWhere('buyer_id', 'LIKE', "%$keyword%")
//                ->orWhere('seller_id', 'LIKE', "%$keyword%")
//                ->orWhere('event_param_id', 'LIKE', "%$keyword%")
//                ->paginate($perPage);
//        } else {
//            $finalschedules = FinalSchedule::paginate($perPage);
//        }
        $finalschedules = FinalSchedule::where('event_id', '=', $event_id)->paginate($perPage);

        return view('admin.final-schedules.index', compact('finalschedules'));
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
            $finalschedules = FinalSchedule::where('event_id', 'LIKE', "%$keyword%")
                ->orWhere('buyer_id', 'LIKE', "%$keyword%")
                ->orWhere('seller_id', 'LIKE', "%$keyword%")
                ->orWhere('event_param_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $finalschedules = FinalSchedule::paginate($perPage);
        }

        return view('admin.final-schedules.index', compact('finalschedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.final-schedules.create');
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
        
        FinalSchedule::create($requestData);

        return redirect('admin/final-schedules')->with('flash_message', 'FinalSchedule added!');
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
        $finalschedule = FinalSchedule::findOrFail($id);

        return view('admin.final-schedules.show', compact('finalschedule'));
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
        $finalschedule = FinalSchedule::findOrFail($id);

        return view('admin.final-schedules.edit', compact('finalschedule'));
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
        
        $finalschedule = FinalSchedule::findOrFail($id);
        $finalschedule->update($requestData);

        return redirect('admin/final-schedules')->with('flash_message', 'FinalSchedule updated!');
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
        FinalSchedule::destroy($id);

        return redirect('admin/final-schedules')->with('flash_message', 'FinalSchedule deleted!');
    }
}
