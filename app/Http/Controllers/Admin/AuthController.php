<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Password;
use App\Mail\AdminPasswordReset;
use Mail;

class AuthController extends Controller
{
    //

    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);
        $remember = $request->input('remember') == 'on' ? true : false;

        // admin() => auth()->guard('admin')
        if(admin()->attempt($credentials, $remember))
        {
            return redirect(aurl());
        }

        return back()->withErrors(['failed' => trans('auth.failed')])->withInput();

    }

    public function logout()
    {
        admin()->logout();
        return redirect()->route('admin.login');
    }

    public function passwordForgotForm()
    {
        return view('admin.auth.forgot');
    }

    public function sendResetEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $email = $request->input('email');
        $user = Admin::whereEmail($email);

        if($user->exists())
        {
            $user = $user->first();

            $token = $this->broker()->createToken($user);
            Mail::to($user)->send(new AdminPasswordReset(['token' => $token, 'user' => $user]));

            return back()->with('sent', trans('passwords.sent'));
        }

        return back()->withErrors(['user' => trans('passwords.user')])->withInput();

    }

    public function passwordResetForm($token)
    {
        return view('admin.auth.reset', compact('token'));
    }
    public function reset(Request $request, $token)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'min:6|confirmed'
        ]);

        $user = Admin::whereEmail($request->input('email'));

        if($user->exists())
        {
            $user = $user->first();

            if($this->broker()->tokenExists($user, $token))
            {
                $user->update([
                    'password' => bcrypt($request->input('password'))
                ]);
                $this->broker()->deleteToken($user);

                // login
                admin()->login($user, false);

                return redirect(aurl())->with(['reset' => trans('passwords.reset')]);
            }

            return back()->withErrors(['token' => trans('passwords.token')])->withInput();
        }

        return back()->withErrors(['user' => trans('passwords.user')])->withInput();
    }


    /**
     * @return \Illuminate\Auth\Passwords\PasswordBroker
     */
    private function broker()
    {
        return Password::broker('admins');
    }
}
