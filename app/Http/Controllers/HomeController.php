<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
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

    public function buyerIndex(Request $request)
    {
    //  Insert app-buyer
//        $events = Buyer::where('user_id', Auth::user()->id)->first()->events;
//        return view('buyer.index', ['role' => 'Buyer'])
//            ->with('events', $events);

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
                ->join('users', 'users.id', '=', 'buyers.user_id')
                ->join('event_params', 'event_params.id', '=', 'final_schedules.event_param_id')
                ->join('events', 'final_schedules.event_id', '=', 'events.id')
                ->select('*', 'final_schedules.buyer_id as buyer_id',
                    'final_schedules.seller_id as seller_id',
                    'events.event_name as event_name',
                    'events.event_date as event_date',
                    'event_params.start_time as s_time',
                    'event_params.end_time as e_time')
                ->orderBy('events.event_date', 'asc', 'event_params.s_time', 'asc')
                ->paginate($perPage);
        }

        return view('buyer.index', compact('buyers'), ['role' => 'Buyer'])->with('buyers', $buyers);
    }


    public function sellerIndex()
    {
        //  Insert app-buyer
        return view('seller.index', ['role' => 'Seller']);
    }

}
