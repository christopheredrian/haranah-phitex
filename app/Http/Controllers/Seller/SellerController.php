<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Seller;
use App\User;
use App\FinalSchedule;
use App\EventParam;
use App\Event;
use App\EventSeller;
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

class SellerController extends Controller
{
    private $seller_validation = [
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
        return view('seller.create')
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
     * Shows all event for this particular logged in seller
     * @return
     */

    public function show(Request $request)
    {
        $id = Auth::user()->id;
        $seller = Seller::where("sellers.user_id", "=", "$id")->first();

        $sellerID = Seller::where('user_id', Auth::user()->id)
            ->pluck('id');

            //gets all schedule
        $schedule = DB::table('final_schedules')
            ->join('event_params','final_schedules.event_param_id','=','event_params.id')
            ->where('final_schedules.seller_id','=', $sellerID)
            ->get();

        // gets event information
        $eventOfSeller = Event::whereIn('id', EventSeller::where('seller_id','=',$sellerID)
            ->pluck('event_id'))
            ->get();

        $info = DB::table('final_schedules')
            ->join('sellers' ,'final_schedules.seller_id', '=' ,'sellers.id')
            ->select('buyer_id','event_param_id')
            ->where('sellers.id' ,'=',$sellerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $buyer = DB::table('users')
            ->join('buyers', 'users.id','=','buyers.user_id')
            ->get();

        return view('seller.index', compact('seller'), ['role' => 'Seller'])
            ->with('sellers', $seller)
            ->with('schedule',$schedule)
            ->with('sellerEvent',$eventOfSeller)
            ->with('info',$info)
            ->with('buyer',$buyer);
    }


    public function showEvents()
    {
        // TODO: Another refactor later
        $seller = Seller::where('user_id', Auth::user()->id)
            ->first();

        $sellerID = Seller::where('user_id', Auth::user()->id)
            ->pluck('id');
        // note: to be refactored

        //table column where  id
        $schedule = DB::table('final_schedules')
            ->join('event_params','final_schedules.event_param_id','=','event_params.id')
            ->where('final_schedules.seller_id','=', $sellerID)
            ->get();

        // gets the buyer_id and event_param_id
        $info = DB::table('final_schedules')
            ->join('sellers' ,'final_schedules.seller_id', '=' ,'sellers.id')
            ->select('buyer_id','event_param_id')
            ->where('sellers.id' ,'=',$sellerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $buyer = DB::table('users')
            ->join('buyers', 'users.id','=','buyers.user_id')
            ->get();

        return view('seller.event')
            ->with('events',$seller->events)
            ->with('schedule',$schedule)
            ->with('info',$info)
            ->with('buyer',$buyer);
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



        foreach($request->values as $item){
            $seller_preference = \App\SellerPreference::create();
            $seller_preference->event_id=$id;
            $seller_preference->seller_id=\App\Seller::where('user_id','=',Auth::user()->id)->first()->id;
            $pieces = explode("-", $item);
            $seller_preference->buyer_id=$pieces[0];
            $seller_preference->rank=$pieces[1];
            $seller_preference->save();
        }

        //table column where  id
        $schedule = DB::table('final_schedules')
            ->join('event_params','final_schedules.event_param_id','=','event_params.id')
            ->where('final_schedules.seller_id','=', $sellerID)
            ->get();

        $seller = Seller::where('user_id', Auth::user()->id)
            ->first();

        $sellerID = Seller::where('user_id', Auth::user()->id)
            ->pluck('id');

        $schedule = EventParam::whereIn('event_id', FinalSchedule::where('seller_id', '=', $sellerID)
            ->pluck('event_param_id'))
            ->get();

        $info = DB::table('final_schedules')
            ->join('sellers' ,'final_schedules.seller_id', '=' ,'sellers.id')
            ->select('buyer_id','event_param_id')
            ->where('sellers.id' ,'=',$sellerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $buyer = DB::table('users')
            ->join('buyers', 'users.id','=','buyers.user_id')
            ->get();
        return view('seller.event')
            ->with('events',$seller->events)
            ->with('schedule',$schedule)
            ->with('info',$info)
            ->with('buyer',$buyer);

    }

    public function showBuyerProfile($id)
    {
        $buyer = Buyer::find($id);
        return view('seller.cbuyer',compact($buyer));
    }
}
