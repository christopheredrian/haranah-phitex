<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Requests;
use App\Http\Controllers\Controller;

use App\Seller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $seller = seller::paginate($perPage);
        } else {
            $seller = seller::paginate($perPage);
        }

        return view('sellers.index', compact('seller'));
    }
}
