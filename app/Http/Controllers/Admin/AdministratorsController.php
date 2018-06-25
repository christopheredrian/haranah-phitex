<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Administrator;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class AdministratorsController extends Controller
{
    private $admin_validation = [
        'name' => 'required',
        'email' => 'unique:users,email|email',
    ];

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
            $administrators = User::where('role', "admin")
                ->where('user_id', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $administrators = User::where('role', "admin")
                ->paginate($perPage);
        }

        return view('admin.administrators.index', compact('administrators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.administrators.create')
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
        
//        $requestData = $request->all();
//
//        Administrator::create($requestData);
//
//        Session::flash('flash_message', 'Administrator added!');
//
//        return redirect('admin/administrators');

        // check for User uniqueness (email)
        $request->validate($this->admin_validation);
        $email = $request->email;
        $user = new User();
        $user->name = $request->name;

        // insert password generator here
        $user->password = bcrypt("password");

        $user->email = $request->email;
        $user->created_at = Carbon::now();
        $user->role = "admin";
        $user->activated = 1;
        $user->save();

        $user = User::where('email', $email)->first();

        Session::flash('flash_message', 'Administrator added!');

        return redirect('admin/administrators');
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
        $administrator = User::findOrFail($id);

        return view('admin.administrators.show', compact('administrator'));
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
        $administrator = User::findOrFail($id);

        return view('admin.administrators.edit', compact('administrator'));
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
        
        $administrator = User::findOrFail($id);
        $administrator->update($requestData);

        Session::flash('flash_message', 'Administrator updated!');

        return redirect('admin/administrators');
    }

    /**
     * Show the profile of the admin
     *
     * @return \Illuminate\View\View
     */
    public function account()
    {
        return view('admin.administrators.account');
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
        User::destroy($id);

        Session::flash('flash_message', 'Administrator deleted!');

        return redirect('admin/administrators');
    }
}
