<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class SellersController extends Controller
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
            $sellers = DB::table('buyers')
                ->join('users', 'users.id', '=', 'sellers.user_id')
                ->select('users.*')
                ->where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $sellers = DB::table('sellers')
                ->join('users', 'users.id', '=', 'sellers.user_id')
                ->select('users.*')
                ->paginate($perPage);
        }

        return view('admin.sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sellers.create');
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
        $request->password = bcrypt($request->password);
        $requestData = $request->all();
        $email = $request->email;

        User::create($requestData);
        $user = User::where('email', $email)->first();

        $seller = new Seller();
        $seller->user_id = $user->id;
        $seller->save();

        Session::flash('flash_message', 'Seller added!');

        return redirect('admin/sellers');
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
        $seller = Seller::findOrFail($id);

        return view('admin.sellers.show', compact('seller'));
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
        $seller = Seller::findOrFail($id);

        return view('admin.sellers.edit', compact('seller'));
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
        
        $seller = Seller::findOrFail($id);
        $seller->update($requestData);

        Session::flash('flash_message', 'Seller updated!');

        return redirect('admin/sellers');
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
        Seller::destroy($id);

        Session::flash('flash_message', 'Seller deleted!');

        return redirect('admin/sellers');
    }
}
