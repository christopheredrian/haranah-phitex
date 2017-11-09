<?php

namespace App\Http\Controllers\Seller;

use App\Event;
use App\EventSeller;
use Illuminate\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Seller;
use App\User;
use App\Buyer;
use App\EventBuyer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $seller = seller::paginate($perPage);
        } else {
            $seller = seller::paginate($perPage);
        }

        return view('seller.index', compact('seller'));
    }

    /**
     * Shows all event for this particular logged in seller
     * @return
     */
    public function showEvents()
    {
        // TODO: Another refactor later
        $seller = Seller::where('user_id', Auth::user()->id)
            ->first();
        return view('seller.event')
            ->with('events',$seller->events);
    }

    /**
     * Shows the seller preference form
     * @param $id
     * @return
     */
    public function sellerPreference($id)
    {
        $event = Event::find($id);
//        $buyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',1)
//            ->pluck('buyer_id'))
//            ->pluck('user_id'))
//            ->get();
      //$buyers = DB::table('buyers')->join('users', 'buyers.user_id', '=', 'users.id')->select('users.*', 'buyers.country')->get();
        return view('seller.list')->with('buyers', $event->buyers);
       // return view('seller.list');
    }
}
