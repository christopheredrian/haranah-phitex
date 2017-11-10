<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
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


    public function sellerIndex()
    {
        //  Insert app-buyer
        return view('seller.index', ['role' => 'Seller']);
    }

}
