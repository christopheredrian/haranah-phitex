<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Seller;
use App\User;
use App\Buyer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class BuyerProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $buyer_profile = BuyerProfile::paginate($perPage);
        } else {
            $buyer_profile = BuyerProfile::paginate($perPage);
        }

        return view('buyer.index', compact('buyer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('buyer.create');
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
        
        $requestData = $request->all();

        BuyerProfile::create($requestData);

        Session::flash('flash_message', 'buyer added!');

        return redirect('buyer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $buyer_profile = BuyerProfile::findOrFail($id);

        return view('buyer.show', compact('buyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $buyer_profile = BuyerProfile::findOrFail($id);

        return view('buyer.edit', compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $buyer_profile = BuyerProfile::findOrFail($id);
        $buyer_profile->update($requestData);

        Session::flash('flash_message', 'buyer updated!');

        return redirect('buyer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
