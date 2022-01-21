<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $rememberme = $request->remember_me == 1 ? true : false;
        if (admin()->attempt(['email' => $request->email, 'password' => $request->password], $rememberme)) {
            return redirect(adminUrl());
        } else {
            session()->flash('error', trans('admin.incorrect_information_login'));
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(adminUrl('login'));
    }

    public function forgot_password()
    {
        return view('admin.forgot_password');
    }

    public function doForgot_password(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first(); // get admin information
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin); // create new token
            // insert data to password_resets table
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            // send email to reset password
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));
            session()->flash('success', trans('admin.link_reset_sent'));
            return back();
        }
        return back();
    }

    public function reset_password($token)
    {
        // get token information from password_resets
        $check_token = DB::table('password_resets')->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(2))->first();
        // check if token not empty
        if (!empty($check_token)) {
            return view('admin.reset_password', ['data' => $check_token]);
        } else {
            return redirect(adminUrl('forgot/password'));
        }
    }

    public function doReset_password($token)
    {
        $this->validate(request(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [], [
            'password' => 'Password',
            'password_confirmation' => 'Confirmation Password',
        ]);

        // get token information from password_resets
        $check_token = DB::table('password_resets')->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(2))->first();
        // check if token not empty
        if (!empty($check_token)) {
            // update admin details in admins table
            $admin = Admin::where('email', $check_token->email)->update([
                'email' => $check_token->email,
                'password' => bcrypt(request('password'))
            ]);
            // delete data for this admin from password_resets table
            DB::table('password_resets')->where('email', request('email'))->delete();
            // login for this admin after update data
            admin()->attempt(['email' => $check_token->email, 'password' => request('password')],true);
            return redirect(adminUrl());
        } else {
            return redirect(adminUrl('forgot/password'));
        }
    }
}
