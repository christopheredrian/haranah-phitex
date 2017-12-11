<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FinalSchedule;
use Illuminate\Http\Request;

class FinalSchedulesController extends Controller
{
    private function getSchedules($event_id)
    {
        $schedule_list = [];
        $schedules = \App\EventParam::where('event_id','=',$event_id)->get();
        foreach ($schedules as $schedule) {
            $schedule_id = $schedule->id;
            $schedule_list[$schedule_id] = $schedule->start_time." - ".$schedule->end_time;
        }
        return $schedule_list;
    }
    private function getBuyerNames($event_id)
    {
        $buyer_names = [];
        $buyers = \App\User::whereIn('id', \App\Buyer::where('id' ,'>' ,0)->whereIn('id',\App\EventBuyer::where('event_id','=',$event_id)->pluck('buyer_id'))->pluck('user_id')->toArray())->orderBy('last_name')->get();
        foreach ($buyers as $buyer) {
            $buyerid = \App\Buyer::where('user_id' ,'=' ,$buyer->id)->value('id');
            $buyer_names[$buyerid] = $buyer->last_name.", ".$buyer->first_name;
        }
        return $buyer_names;
    }
    private function getSellerNames($event_id)
    {
        $seller_names = [];
        $sellers = \App\User::whereIn('id', \App\Seller::where('id' ,'>' ,0)->whereIn('id',\App\EventSeller::where('event_id','=',$event_id)->pluck('seller_id'))->pluck('user_id')->toArray())->orderBy('last_name')->get();
        //whereNotIn('id',\App\EventSeller::where('event_id','=',$event_id))
        foreach ($sellers as $seller) {
            $sellerid = \App\Seller::where('user_id' ,'=' ,$seller->id)->value('id');
            $seller_names[$sellerid] = $seller->last_name.", ".$seller->first_name;
        }
        return $seller_names;
    }

    public function createWithEvent($event_id)
    {
        $finalschedule = FinalSchedule::create();
        return view('admin.final-schedules.create')
            ->with('events_id',$event_id)
            ->with('seller_names', $this->getSellerNames($event_id))
            ->with('buyer_names', $this->getBuyerNames($event_id))
            ->with('schedule_list', $this->getSchedules($event_id))
            ->with('finalschedule',$finalschedule);
    }

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
        $event = \App\Event::where('id','=',$event_id)->first()->event_name;
        $finalschedules = FinalSchedule::where('event_id', '=', $event_id)->paginate($perPage);

        return view('admin.final-schedules.index', compact('finalschedules'))
            ->with('event',$event)
            ->with('seller_names', $this->getSellerNames($event_id))
            ->with('buyer_names', $this->getBuyerNames($event_id))
            ->with('schedule_list', $this->getSchedules($event_id));
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

        return view('admin.final-schedules.edit', compact('finalschedule'))
            ->with('seller_names', $this->getSellerNames($finalschedule->event_id))
            ->with('buyer_names', $this->getBuyerNames($finalschedule->event_id))
            ->with('schedule_list', $this->getSchedules($finalschedule->event_id));
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
