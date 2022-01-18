<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }

    public function doLogin(Request $request){
        $rememberme = $request->remember_me == 1 ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->email,'password' => $request->password],$rememberme)){
            return redirect('admin');
        }else{
            session()->flash('error',trans('admin.incorrect_information_login'));
//            toastr()->error(trans('messages.delete'));
            return redirect()->back();
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin/login');
    }
}
