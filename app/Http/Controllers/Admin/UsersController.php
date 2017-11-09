<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Session;

class UsersController extends Controller
{
    /**
     * Reset password controller
     * @param Request $request
     * @param $user_id
     */
    public function reset_password(Request $request, $user_id){
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

    public function passwordForm(){
        $role = Auth::user()->role;
        $role = ($role == "superadmin" ? "admin" : $role);
        return view('auth.passwords.change-password', ['role' => $role]);
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->current_password, Auth::user()->password))){
                // Check if old password is the same as current password provided
            Session::flash('flash_message', 'The password provided for the Current Password field does not match your current password');
            Session::flash('alert-class', 'alert-danger');

        } elseif(!($request->new_password === $request->confirm_new_password)){
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

    public function changeStatus($user_id) {
        $user = \App\User::findOrFail($user_id);
        $user->activated = ($user->activated > 0 ? 0 : 1);
        $user->save();
        return back();
    }
}
