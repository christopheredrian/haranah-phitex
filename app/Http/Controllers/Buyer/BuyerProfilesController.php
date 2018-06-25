<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Buyer;
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


class BuyerProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    private $buyer_validation = [
        'company_bg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'unique:users,email|email',
        'phone' => 'nullable|numeric',
        'country' => 'required',
        'company_name' => 'required',
        'company_address' => 'required',
        'event_rep1' => 'required',
        'event_rep2' => 'required',
        'designation' => 'required',
        'website' => 'required',
    ];

    /**
     * Listing of events
     * @param Request $request
     */
    public function events(Request $request)
    {
        return view('buyer.events', ['events' => Auth::user()->buyer->events]);
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
    public function show($id)
    {
        if (!in_array($id, Auth::user()->buyer->events->pluck('id')->toArray())) {
            abort(404);
        }

        $buyer = Auth::user()->buyer;

        $buyerID = Buyer::where('user_id', Auth::user()->id)
            ->pluck('id');

        //gets all schedule
        $schedule = DB::table('final_schedules')
            ->join('event_params', 'final_schedules.event_param_id', '=', 'event_params.id')
            ->where('final_schedules.buyer_id', '=', $buyerID)
            ->get();

        // gets event information

        $eventOfBuyer = Event::find($id);


        $info = DB::table('final_schedules')
            ->join('buyers', 'final_schedules.buyer_id', '=', 'buyers.id')
            ->select('seller_id', 'event_param_id')
            ->where('buyers.id', '=', $buyerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $seller = DB::table('users')
            ->join('sellers', 'users.id', '=', 'sellers.user_id')
            ->get();

        return view('buyer.show', compact('buyer'), ['role' => 'Buyer'])
            ->with('buyers', $buyer)
            ->with('schedule', $schedule)
            ->with('buyerEvent', $eventOfBuyer)
            ->with('info', $info)
            ->with('seller', $seller)
            ->with('event_id', $eventOfBuyer->id);
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
        $buyer = Auth::user()->buyer;

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

//        $user = User::findOrFail($buyer->user->id);
//        $user->update($requestData);

        if ($request->file('company_logo') != null) {
            $logo = 'buyer-' . $buyer->id . '.jpg';

            $path = base_path() . '/public/uploads/' . $logo;
            $buyer->company_logo = $path;

            $request->file('company_logo')->move(
                base_path() . '/public/uploads/', $logo
            );

            $buyer->save();

        }

        if ($request->file('company_bg') != null) {
            $bg = 'buyer-bg-' . $buyer->id . '.jpg';

            $path = base_path() . '/public/uploads/' . $bg;
            $buyer->company_bg = $path;

            $request->file('company_bg')->move(
                base_path() . '/public/uploads/', $bg
            );

            $buyer->save();

        }

        return redirect('buyer/profile/'.$buyer->id)->with('flash_message', 'Buyer updated!');
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
