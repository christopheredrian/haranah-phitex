<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Seller;
use App\SellerPreferenceCache;
use App\User;
use App\FinalSchedule;
use App\EventParam;
use App\Event;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

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
        'products' => 'required',
    ];

    public function events()
    {
        $events = Auth::user()->seller->events;

        return view('seller.events')
            ->with('events', $events);
    }

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

    public function show(Request $request, $event_id)
    {
        $flag = false;
        $buyer_events = Auth::user()->seller->events;

        foreach ($buyer_events as $buyer_event) {
            if ($buyer_event->id == $event_id) {
                $flag = true;
                break;
            }
        }

        if ($flag) {
            $id = Auth::user()->id;

            $seller = Seller::where("sellers.user_id", "=", "$id")->first();

            $sellerID = Seller::where('user_id', Auth::user()->id)
                ->pluck('id');

            //gets all schedule
            $schedule = DB::table('final_schedules')
                ->join('event_params', 'final_schedules.event_param_id', '=', 'event_params.id')
                ->where('final_schedules.seller_id', '=', $sellerID)
                ->where('final_schedules.event_id', '=', $event_id)
                ->get();

            // gets event information
//        $eventOfSeller = Event::whereIn('id', EventSeller::where('seller_id','=',$sellerID)
//            ->pluck('event_id'))
//            ->get();

            $eventOfSeller = Event::find($event_id);

            $info = DB::table('final_schedules')
                ->join('sellers', 'final_schedules.seller_id', '=', 'sellers.id')
                ->select('buyer_id', 'event_param_id')
                ->where('sellers.id', '=', $sellerID)
                ->get();

            // gets Name (first and last) of buyer in the final schedule
            $buyer = DB::table('users')
                ->join('buyers', 'users.id', '=', 'buyers.user_id')
                ->get();

            $count = \App\SellerPreference::where('seller_preferences.seller_id', '=', $sellerID)
                ->count();

            if ($count > 0) {
                $has_preference = true;
            } else {
                $has_preference = false;
            }

            return view('seller.index', compact('seller'), ['role' => 'Seller'])
                ->with('sellers', $seller)
                ->with('schedule', $schedule)
                ->with('sellerEvent', $eventOfSeller)
                ->with('info', $info)
                ->with('buyer', $buyer)
                ->with('preference', $has_preference)
                ->with('event_id', $event_id);
        } else {
            abort(404);
        }

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
            ->join('event_params', 'final_schedules.event_param_id', '=', 'event_params.id')
            ->where('final_schedules.seller_id', '=', $sellerID)
            ->get();

        // gets the buyer_id and event_param_id
        $info = DB::table('final_schedules')
            ->join('sellers', 'final_schedules.seller_id', '=', 'sellers.id')
            ->select('buyer_id', 'event_param_id')
            ->where('sellers.id', '=', $sellerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $buyer = DB::table('users')
            ->join('buyers', 'users.id', '=', 'buyers.user_id')
            ->get();

        return view('seller.event')
            ->with('events', $seller->events)
            ->with('schedule', $schedule)
            ->with('info', $info)
            ->with('buyer', $buyer);
    }

    /**
     * Shows the seller preference form
     * @param $id
     * @return
     */
    public function sellerPreference($event_id)
    {
        //$buyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',1)
        //->pluck('buyer_id'))
        //->pluck('user_id'))
        //->get();
        //$buyers = DB::table('buyers')->join('users', 'buyers.user_id', '=', 'users.id')->select('users.*', 'buyers.country')->get();
        // return view('seller.list');
        $id = Auth::user()->id;
        $seller = Seller::where('user_id', Auth::user()->id)
            ->first();
        $event = Event::find($event_id);
        $seller_cache = SellerPreferenceCache::where('event_id', $event_id)->where('seller_id', $seller->id)->first();
        return view('seller.list')
            ->with('buyers', $event->buyers)
            ->with('event', $event)
            ->with('seller', $seller)
            ->with('seller_cache', $seller_cache);
    }

    /**
     * Caching the results - Save to Draft button
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cacheSellerPreference(Request $request)
    {
        // Get from request
        $event_id = $request->event_id;
        $seller_id = $request->seller_id;
        $buyer_ids = [];
        if ($request->values) {
            foreach ($request->values as $value) {
                $buyer_ids[] = explode("-", $value)[0];
            }
        }

        // Validate values
        if ($event_id && $seller_id) {
            $seller_preference_cache = SellerPreferenceCache::where('event_id', $event_id)->where('seller_id', $seller_id);
            if (!$seller_preference_cache->exists()) {
                $seller_preference_cache = new SellerPreferenceCache();
            } else {
                $seller_preference_cache = $seller_preference_cache->first();
            }
            $seller_preference_cache->buyer_ids = implode(",", $buyer_ids);
            $seller_preference_cache->event_id = $event_id;
            $seller_preference_cache->seller_id = $seller_id;
            $seller_preference_cache->save();
        } else {

        }


        return redirect('/seller/pick/' . $event_id)->with('flash_message', 'Draft saved!');

    }

    /**
     * Submit user preferences
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submitPreferences(Request $request)
    {
        // Get values from request
        if (!empty($request->values)) {
            foreach ($request->values as $item) {
                $seller_preference = \App\SellerPreference::create();
                $seller_preference->event_id = $request->event_id;
                $seller_preference->seller_id = Auth::user()->seller->id;
                $pieces = explode("-", $item);
                $seller_preference->buyer_id = $pieces[0];
                $seller_preference->rank = $pieces[1];
                $seller_preference->save();
            }
            return redirect('seller/home/' . $request->event_id);
        } else {
            return redirect('seller/pick/' . $request->event_id)->with('status', 'No Buyers selected!');
        }

    }

    public function showBuyerProfile($user_id)
    {
        $buyer = \App\Buyer::find($user_id);
        return view('seller.cbuyer')
            ->with('buyer', $buyer);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate($this->seller_validation);
        $requestData = $request->all();

        $seller = Seller::where("sellers.user_id", "=", "$id")->first();
        $seller->update($requestData);

        $user = User::findOrFail($seller->user->id);
        $user->update($requestData);

        if ($request->file('company_logo') != null) {
            $logo = 'seller-' . $seller->id . '.jpg';

            $request->file('company_logo')->move(
                base_path() . '/public/uploads/', $logo
            );
        }

        return back()->with('flash_message', 'Profile updated!');
    }
}
