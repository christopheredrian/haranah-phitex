<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
use App\FinalSchedule;
use App\EventParam;
use Illuminate\Support\Facades\Auth;

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
        $events = Buyer::where('user_id', Auth::user()->id)->first()->events;
        return view('buyer.index', ['role' => 'Buyer'])
            ->with('events', $events);
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

    public function sellerIndex()
    {
        //  Insert app-buyer
        // query final schedule
        return view('seller.index', ['role' => 'Seller']);
    }

}
