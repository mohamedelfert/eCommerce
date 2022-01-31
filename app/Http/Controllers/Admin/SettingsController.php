<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function setting()
    {
        // $setting = Settings::findOrFail(1); Or but if use finOrFail(id) if id not exists return 404 - if use orderBy('id') its ok.
        // $setting = Settings::orderBy('id', 'desc')->first();
        // now i use setting() helper function return -> Settings::orderBy('id', 'desc')->first();
        return view('admin.settings', ['title' => trans('admin.settings')]);
    }

    public function setting_save(Request $request)
    {
        $data = $request->except('_token', '_method');
        Settings::orderBy('id', 'asc')->update($data);
        toastr()->success(trans('admin_validation.update'));
        return back();
    }
}
