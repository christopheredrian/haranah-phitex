<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SuperAdministrator;
use Illuminate\Http\Request;
use Session;

class SuperAdministratorsController extends Controller
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
            $superadministrators = SuperAdministrator::where('user_id', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $superadministrators = SuperAdministrator::paginate($perPage);
        }

        return view('admin.super-administrators.index', compact('superadministrators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.super-administrators.create');
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
        
        SuperAdministrator::create($requestData);

        Session::flash('flash_message', 'SuperAdministrator added!');

        return redirect('admin/super-administrators');
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
        $superadministrator = SuperAdministrator::findOrFail($id);

        return view('admin.super-administrators.show', compact('superadministrator'));
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
        $superadministrator = SuperAdministrator::findOrFail($id);

        return view('admin.super-administrators.edit', compact('superadministrator'));
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
        
        $superadministrator = SuperAdministrator::findOrFail($id);
        $superadministrator->update($requestData);

        Session::flash('flash_message', 'SuperAdministrator updated!');

        return redirect('admin/super-administrators');
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
        SuperAdministrator::destroy($id);

        Session::flash('flash_message', 'SuperAdministrator deleted!');

        return redirect('admin/super-administrators');
    }
}
