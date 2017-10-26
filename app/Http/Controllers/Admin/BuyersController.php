<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Buyer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class BuyersController extends Controller
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
            $buyers = Buyer::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $buyers = Buyer::paginate($perPage);
        }

        return view('admin.buyers.index', compact('buyers'));
//        return view('admin.buyers.index')
//            ->with('buyers', $buyers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.buyers.create');
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
        $email = $request->email;

        $user = new User();
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->password = bcrypt("password");
        $user->email = $request->email;
        $user->created_at = Carbon::now();
        $user->role = "buyer";
        $user->activated = 0;
        $user->save();

        $user = User::where('email', $email)->first();

        $buyer = new Buyer();
        $buyer->user_id = $user->id;
        $buyer->save();

        Session::flash('flash_message', 'Buyer added!');

        return redirect('admin/buyers');
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
        $buyer = Buyer::findOrFail($id);

        return view('admin.buyers.show', compact('buyer'));
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
        $buyer = Buyer::findOrFail($id);

        return view('admin.buyers.edit', compact('buyer'));
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
        
        $buyer = Buyer::findOrFail($id);
        $buyer->update($requestData);

        Session::flash('flash_message', 'Buyer updated!');

        return redirect('admin/buyers');
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
        Buyer::destroy($id);

        Session::flash('flash_message', 'Buyer deleted!');

        return redirect('admin/buyers');
    }
}
