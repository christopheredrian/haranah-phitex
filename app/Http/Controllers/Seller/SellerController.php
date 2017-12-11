<?php

namespace App\Http\Controllers\Seller;

use App\Event;
use App\EventSeller;
use Illuminate\Http\Requests;
use App\FinalSchedule;
use App\EventParam;

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

        $sellerID = Seller::where('user_id', Auth::user()->id)
            ->pluck('id');


        //table column where  id
        $schedule = EventParam::whereIn('event_id', FinalSchedule::where('seller_id', '=', $sellerID)
            ->pluck('event_param_id'))
            ->get();

        return view('seller.event')
            ->with('events',$seller->events)
            ->with('schedule',$schedule);
    }

    /**
     * Shows the seller preference form
     * @param $id
     * @return
     */
    public function sellerPreference($id)
    {
        //$buyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',1)
            //->pluck('buyer_id'))
            //->pluck('user_id'))
            //->get();
        //$buyers = DB::table('buyers')->join('users', 'buyers.user_id', '=', 'users.id')->select('users.*', 'buyers.country')->get();
        // return view('seller.list');
        $event = Event::find($id);
        return view('seller.list')
            ->with('buyers', $event->buyers)
            ->with('event', $event);
    }
    public function submitPreferences(Request $request, $id)
    {

//        echo "Event id: $id <br>";
//        echo 'The values ($request->values): <br>';
//        print_r($request->values);
//        echo  'Where $request->values contains an array of: (buyer_id-rank)';
        $sellerID = Seller::where('user_id', Auth::user()->id)
            ->pluck('id');


        //table column where  id
        $schedule = EventParam::whereIn('event_id', FinalSchedule::where('seller_id', '=', $sellerID)
            ->pluck('event_param_id'))
            ->get();
        foreach($request->values as $item){
            $seller_preference = \App\SellerPreference::create();
            $seller_preference->event_id=$id;
            $seller_preference->seller_id=\App\Seller::where('user_id','=',Auth::user()->id)->first()->id;
            $pieces = explode("-", $item);
            $seller_preference->buyer_id=$pieces[0];
            $seller_preference->rank=$pieces[1];
            $seller_preference->save();
        }
        $seller = Seller::where('user_id', Auth::user()->id)
            ->first();
        return view('seller.event')->with('events',$seller->events)->with('schedule',$schedule);

    }

    public function showBuyerProfile($id)
    {
        $buyer = Buyer::find($id);
        return view('seller.cbuyer',compact($buyer));
    }
}
