<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Seller;
use App\User;
use App\Buyer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Session;

class SellersController extends Controller
{
    private $seller_validation = [
        'email' => 'unique:users,email|email',
        'phone' => 'nullable',
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
//            $sellers = DB::table('sellers')
//                ->join('users', 'users.id', '=', 'sellers.user_id')
//                ->select('users.*')
//                ->where('user_id', 'LIKE', "%$keyword%")
//                ->orWhere('last_name', 'LIKE', "%$keyword%")
//                ->orWhere('first_name', 'LIKE', "%$keyword%")
//                ->orWhere('email', 'LIKE', "%$keyword%")
//                ->paginate($perPage);
            $sellers = Seller::join('users', 'sellers.user_id', '=', 'users.id')
                ->where('company_name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('event_rep1', 'LIKE', "%$keyword%")
                ->orWhere('event_rep2', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->select('sellers.*')
                ->paginate($perPage);

        } else {
            $sellers = Seller::paginate($perPage);
        }

        return view('admin.sellers.index', [
            'sellers' => $sellers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sellers.create')
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
        $request->validate($this->seller_validation);
        $email = $request->email;

        $user = new User();
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->password = bcrypt("password");
        $user->email = $request->email;
        $user->created_at = Carbon::now();
        $user->role = "buyer";
        $user->activated = $request->activate === 'true' ? 1 : 0;
        $user->save();

        $user = User::where('email', $email)->first();

        $seller = new Seller();
        $seller->phone = $request->phone;
        $seller->country = $request->country;
        $seller->user_id = $user->id;
        $seller->save();

        Session::flash('flash_message', 'Seller added!');
        if ($user->activated === 0) {
            // haha
            $user = User::find($user->id);
            $credentials = ['email' => $user->email];
            $response = Password::sendResetLink($credentials, function (Message $message) {
                $message->subject($this->getEmailSubject());
            });

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    Session::flash('flash_message', 'Password reset confirmation link sent to the user!');
                    return redirect()->back()->with('status', trans($response));
                case Password::INVALID_USER:
                    Session::flash('flash_message', 'Password reset confirmation link not sent to the user!');
                    return redirect()->back()->withErrors(['email' => trans($response)]);
            }
        }
        return redirect('admin/sellers');
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
        $seller = Seller::findOrFail($id);

        return view('admin.sellers.show', compact('seller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $seller = Seller::findOrFail($id);

        return view('admin.sellers.edit', [
            'seller' => $seller,
            'isCreate' => false
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $request->validate($this->seller_validation);
        $requestData = $request->all();

        $seller = Seller::findOrFail($id);
        $seller->update($requestData);

        $user = User::findOrFail($seller->user->id);
        $user->update($requestData);
        Session::flash('flash_message', 'Seller updated!');

        return redirect('admin/sellers');
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
       DB::transaction(function() use ($id){
           User::destroy(Seller::findOrFail($id)->user_id);
           Seller::destroy($id);
           Session::flash('flash_message', 'Seller deleted!');
       });

        return redirect('admin/sellers');
    }


}
