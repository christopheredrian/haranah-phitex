<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Buyer_Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class Buyer_ProfileController extends Controller
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
            $buyer_profile = buyer_profile::paginate($perPage);
        } else {
            $buyer_profile = buyer_profile::paginate($perPage);
        }

        return view('buyer_profile.index', compact('buyer_profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('buyer_profile.create');
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
        
        buyer_profile::create($requestData);

        Session::flash('flash_message', 'buyer_profile added!');

        return redirect('buyer_profile');
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
        $buyer_profile = buyer_profile::findOrFail($id);

        return view('buyer_profile.show', compact('buyer_profile'));
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
        $buyer_profile = buyer_profile::findOrFail($id);

        return view('buyer_profile.edit', compact('buyer_profile'));
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
        
        $buyer_profile = buyer_profile::findOrFail($id);
        $buyer_profile->update($requestData);

        Session::flash('flash_message', 'buyer_profile updated!');

        return redirect('buyer_profile');
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
        buyer_profile::destroy($id);

        Session::flash('flash_message', 'buyer_profile deleted!');

        return redirect('buyer_profile');
    }
}
