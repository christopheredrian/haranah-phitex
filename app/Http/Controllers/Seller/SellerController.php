<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Requests;
use App\Http\Controllers\Controller;
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
    public function showEvents()
    {

        //$events=\App\Event::whereIn('id',\App\EventSeller::where('seller_id','=',));
        return view('seller.event');//->with('events',$events);
    }
    public function showList($id)
    {
        $buyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',1)
            ->pluck('buyer_id'))
            ->pluck('user_id'))
            ->get();
      //$buyers = DB::table('buyers')->join('users', 'buyers.user_id', '=', 'users.id')->select('users.*', 'buyers.country')->get();
        return view('seller.list')->with('buyers', $buyers);
       // return view('seller.list');
    }
}
