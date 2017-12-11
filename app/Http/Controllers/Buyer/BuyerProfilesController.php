<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Buyer;
use App\User;
use App\FinalSchedule;
use App\EventParam;
use App\Event;
use App\EventBuyer;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Database\Eloquent\Builder;
use Session;


class BuyerProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    private $buyer_validation = [
        'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'unique:users,email|email',
        'phone' => 'nullable',
        'country' => 'required',
        'company_name' => 'required',
        'company_address' => 'required',
        'event_rep1' => 'required',
        'event_rep2' => 'required',
        'designation' => 'required',
        'website' => 'required',
    ];

    public function index(Request $request)
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('buyer.create')
            ->with('isCreate', true);
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
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {

        $id = Auth::user()->id;

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            // Join buyers table to users table, filter, then paginate
            $buyers = DB::table('final_schedules')
                ->join('buyers', 'buyers.buyer_id', '=', 'final_schedules.buyer_id')
                ->join('users', 'users.id', '=', 'buyers.user_id')
                ->join('event_params', 'event_params.id', '=', 'final_schedules.event_param_id')
                ->select('*', 'buyers.id as buyer_id')
                ->where('final_schedules.seller_id', 'LIKE', "%$keyword%")
                ->orWhere('event_params.start_time', 'LIKE', "%$keyword%")
                ->orWhere('event_params.end_time', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            // Join buyers table to users table, then paginate

            $buyers = DB::table('final_schedules')
                ->join('buyers', 'buyers.id', '=', 'final_schedules.buyer_id')
                ->join('sellers', 'sellers.id', '=', 'final_schedules.seller_id')
                ->join('users', 'users.id', '=', 'sellers.user_id')
                ->join('event_params', 'event_params.id', '=', 'final_schedules.event_param_id')
                ->join('events', 'final_schedules.event_id', '=', 'events.id')
                ->select(
                    'users.last_name as lname',
                    'users.first_name as fname',
                    'buyers.event_rep1 as rep1',
                    'buyers.event_rep2 as rep2',
                    'events.event_name as event_name',
                    'events.event_date as event_date',
                    'events.event_place as venue',
                    'event_params.start_time as s_time',
                    'event_params.end_time as e_time')
                ->orderBy('events.event_date', 'asc', 'event_params.s_time', 'asc')
                ->paginate($perPage);
        }

        $buyer = Buyer::findOrFail($id)->where("buyers.user_id", "=", "$id")->first();

        $buyerID = Buyer::where('user_id', Auth::user()->id)
            ->pluck('id');

            //gets all schedule
        $schedule = DB::table('final_schedules')
            ->join('event_params','final_schedules.event_param_id','=','event_params.id')
            ->where('final_schedules.buyer_id','=', $buyerID)
            ->get();

        // gets event information
        $eventOfBuyer = Event::whereIn('id', EventBuyer::where('buyer_id','=',$buyerID)
            ->pluck('event_id'))
            ->get();

        $info = DB::table('final_schedules')
            ->join('buyers' ,'final_schedules.buyer_id', '=' ,'buyers.id')
            ->select('seller_id','event_param_id')
            ->where('buyers.id' ,'=',$buyerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $seller = DB::table('users')
            ->join('sellers', 'users.id','=','sellers.user_id')
            ->get();

        return view('buyer.show', compact('buyer'), ['role' => 'Buyer'])
            ->with('buyers', $buyers)
            ->with('schedule',$schedule)
            ->with('buyerEvent',$eventOfBuyer)
            ->with('info',$info)
            ->with('seller',$seller);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $id = Auth::user()->id;

        $buyer = Buyer::findOrFail($id)
            ->select('buyers.*', 'buyers.id as buyer_id')
            ->where("buyers.user_id", "=", "$id")->first();

        return view('buyer.edit', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate($this->buyer_validation);
        $requestData = $request->all();

        $buyer = Buyer::findOrFail($id)->where("buyers.user_id", "=", "$id")->first();
        $buyer->update($requestData);

        $user = User::findOrFail($buyer->user->id);
        $user->update($requestData);

        if($request->file('company_logo')!=null){
            $logo = 'company_logo.' . 'jpg';

            $request->file('company_logo')->move(
                base_path() . '/public/uploads/'.$id.'/', $logo
            );
        }

        return redirect('buyer/profile')->with('flash_message', 'Buyer updated!');
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
        BuyerProfile::destroy($id);

        Session::flash('flash_message', 'buyer deleted!');

        return redirect('buyer');
    }
}
