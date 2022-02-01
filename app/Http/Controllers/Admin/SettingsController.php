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
        $rules = [
            'logo' => validate_image(),
            'icon' => validate_image(),
        ];
        $validate_msg_ar = [
            'logo.image' => trans('admin.logo_type'),
            'logo.mimes' => trans('admin.logo_exe'),
            'icon.image' => trans('admin.icon_type'),
            'icon.mimes' => trans('admin.icon_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        if ($request->hasFile('logo')) {
//            !empty(setting()->logo) ? Storage::delete(setting()->logo) : '';
//            $data['logo'] = $request->file('logo')->store('settings');
            // use UploadController to upload files
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo,
            ]);
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = upload_file()->upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->icon,
            ]);
        }
        Settings::orderBy('id', 'asc')->update($data);
        toastr()->success(trans('admin_validation.update'));
        return back();
    }
}
