<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SellerPreference;
use Illuminate\Http\Request;

class SellerPreferencesController extends Controller
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
            $sellerpreferences = SellerPreference::where('event_id', 'LIKE', "%$keyword%")
                ->orWhere('buyer_id', 'LIKE', "%$keyword%")
                ->orWhere('seller_id', 'LIKE', "%$keyword%")
                ->orWhere('rank', 'LIKE', "%$keyword%")
                ->orWhere('priority', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $sellerpreferences = SellerPreference::paginate($perPage);
        }

        return view('admin.seller-preferences.index', compact('sellerpreferences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.seller-preferences.create');
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
        
        SellerPreference::create($requestData);

        return redirect('admin/seller-preferences')->with('flash_message', 'SellerPreference added!');
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
        $sellerpreference = SellerPreference::findOrFail($id);

        return view('admin.seller-preferences.show', compact('sellerpreference'));
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
        $sellerpreference = SellerPreference::findOrFail($id);

        return view('admin.seller-preferences.edit', compact('sellerpreference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $sellerpreference = SellerPreference::findOrFail($id);
        $sellerpreference->update($requestData);

        return redirect('admin/seller-preferences')->with('flash_message', 'SellerPreference updated!');
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
        SellerPreference::destroy($id);

        return redirect('admin/seller-preferences')->with('flash_message', 'SellerPreference deleted!');
    }
}
