<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Buyer;
use App\User;
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
        'last_name' => 'required',
        'first_name' => 'required',
        'email' => 'unique:users,email|email',
        'phone' => 'nullable',
        'country' => 'required'
    ];

    public function index(Request $request)
    {

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            // Join buyers table to users table, filter, then paginate

            $buyers = DB::table('buyers')
                ->join('users', 'buyers.user_id', '=', 'users.id')
                ->select('users.*', 'buyers.id as buyer_id')
                ->where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->orWhere('first_name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            // Join buyers table to users table, then paginate

            $buyers = DB::table('buyers')
                ->join('users', 'buyers.user_id', '=', 'users.id')
                ->select('users.*', 'buyers.id as buyer_id')
                ->paginate($perPage);
        }

        return view('buyer.index', compact('buyers'));
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

        // check for User uniqueness (email)
        $request->validate($this->buyer_validation);
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

        $buyer = new Buyer();
        $buyer->phone = $request->phone;
        $buyer->country = $request->country;
        $buyer->user_id = $user->id;
        $buyer->save();

        // haha
        if ($user->activated === 0) {
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

        Session::flash('flash_message', 'Buyer added!');

        return redirect('buyer');
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
        $buyer = Buyer::findOrFail($id);
        return view('buyer.show', compact('buyer'));
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
        $buyer = Buyer::findOrFail($id)->where("buyers.user_id", "=", "$id")->first();
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
    public function update($id, Request $request)
    {

        $request->validate($this->buyer_validation);
        $requestData = $request->all();

        $buyer = Buyer::findOrFail($id)->where("buyers.user_id", "=", "$id")->first();
        $buyer->update($requestData);

        $user = User::findOrFail($buyer->user->id);
        $user->update($requestData);

        Session::flash('flash_message', 'Buyer updated!');

        return redirect('buyer/{user_id}/profile');
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
