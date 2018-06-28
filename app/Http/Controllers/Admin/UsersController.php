<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Reset password controller
     * @param Request $request
     * @param $user_id
     */
    public function reset_password(Request $request, $user_id)
    {
        $user = User::find($user_id);
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

    public function passwordForm()
    {
        $role = Auth::user()->role;
        $role = ($role == "superadmin" ? "admin" : $role);
        return view('auth.passwords.change-password', ['role' => $role]);
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // Check if old password is the same as current password provided
            Session::flash('flash_message', 'The password provided for the Current Password field does not match your current password');
            Session::flash('alert-class', 'alert-danger');

        } elseif (!($request->new_password === $request->confirm_new_password)) {
            // Check if new password and confirm new password is the same
            Session::flash('flash_message', 'The password provided for the New Password and Confirm New Password fields do not match');
            Session::flash('alert-class', 'alert-danger');

        } else {
            $current_user = Auth::user();
            $current_user->password = bcrypt($request->new_password);
            $current_user->save();

            Session::flash('flash_message', 'Your password has been updated!');
        }

        return redirect('/change-password');
    }

    public function changeStatus($user_id)
    {
        $user = \App\User::findOrFail($user_id);
        $user->activated = ($user->activated > 0 ? 0 : 1);
        $user->save();
        return back();
    }

    public function verifyUsers(Request $request)
    {
        try {
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get()->toArray();
            $data = array_filter($data, function ($value) {
                return isset($value['name']);
            });
            $event_id = $request->event_id;
            $user_type = $request->user_type;

            if (!empty($data) && count($data)) {
                for ($i = 0; $i < count($data); $i++) {
                    // remove unnecessary column 0
                    unset($data[$i][0]);

                    // check if necessary columns are present in Excel file
                    if (isset($data[$i]['name']) && isset($data[$i]['email']) && isset($data[$i]['position']) && isset($data[$i]['company'])) {
                        // check if account exists using email
                        $data[$i]['isNew'] = User::where('email', $data[$i]['email'])->count() == false ? 1 : 0;

                        // if not new, check if user is verified buyer or seller
                        if (!$data[$i]['isNew'] && $user_type === 'seller') {
                            $data[$i]['isVerifiedSeller'] = User::where('email', $data[$i]['email'])->first()->seller == true ? 1 : 0;
                        } elseif (!$data[$i]['isNew'] && $user_type === 'buyer') {
                            $data[$i]['isVerifiedBuyer'] = User::where('email', $data[$i]['email'])->first()->buyer == true ? 1 : 0;
                        }
                    }
                }

                session(['importData' => $data]);
                session(['importEventID' => $event_id]);
                session(['importUserType' => $user_type]);

                return view('admin.event-' . $user_type . 's.confirmImport')
                    ->with($user_type.'s', $data)
                    ->with('event', Event::find($event_id));
            }

        } catch (\Exception $e) {
            Session::flash('flash_message', 'The following columns are required in the Excel file: Name, Position, Company, Email.');
            Session::flash('alert-class', 'alert-danger');

            return redirect('admin/events/' . $event_id);
        }
    }
}
