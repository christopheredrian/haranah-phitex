<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use App\FinalSchedule;
use App\EventParam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function adminIndex()
    {
        $role = (Auth::user()->role == "superadmin" ? "Super Administrator" : "Administrator");

        return view('home', ['role' => $role]);
    }

    public function buyerIndex()
    {
    //  Insert app-buyer
//        $events = Buyer::where('user_id', Auth::user()->id)->first()->events;
//        return view('buyer.index', ['role' => 'Buyer'])
//            ->with('events', $events);

        $id = Auth::user()->id;

        $buyer = Buyer::findOrFail($id)->where("buyers.user_id", "=", "$id")->first();

        $buyerID = Buyer::where('user_id', Auth::user()->id)
            ->pluck('id');

        //gets all schedule
        $schedule = DB::table('final_schedules')
            ->join('event_params','final_schedules.event_param_id','=','event_params.id')
            ->where('final_schedules.buyer_id','=', $buyerID)
            ->get();

        // gets event information


        $eventOfBuyer= $buyer->event;

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
            ->with('buyers', $buyer)
            ->with('schedule',$schedule)
            ->with('buyerEvent',$eventOfBuyer)
            ->with('info',$info)
            ->with('seller',$seller)
            ->with('event_id', $buyer->event_id);
    }
    /**
        note: table contains
     * event_id
     * buyer_id
     * seller_id
     * event_param_id
     *
     * query event_id in events then get data from event
     **/

    public function sellerIndex(Request $request)
    {
        //  Insert app-buyer
        // query final schedule
        $id = Auth::user()->id;
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sellers = Seller::paginate($perPage);
        } else {
            $sellers = Seller::paginate($perPage);
        }

        $seller = User::findOrFail($id);

        return view('seller.index', compact('seller'))
            ->with('sellers', $sellers);
    }

}
