<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

}
