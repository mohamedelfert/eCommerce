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
            'sitename_ar' => 'required',
            'sitename_en' => 'required',
            'email' => 'required|email',
            'main_lang' => 'required',
            'status' => 'required',
            'logo' => validate_image(),
            'icon' => validate_image(),
            'description' => 'required',
            'keywords' => 'required',
            'message_maintenance' => 'required',
        ];
        $validate_msg_ar = [
            'sitename_ar.required' => trans('admin.v_sitename_ar'),
            'sitename_en.required' => trans('admin.v_sitename_en'),
            'email.required' => trans('admin.site_email_required'),
            'email.email' => trans('admin.site_email'),
            'main_lang.required' => trans('admin.site_main_lang'),
            'status.required' => trans('admin.site_status'),
            'logo.image' => trans('admin.logo_type'),
            'logo.mimes' => trans('admin.logo_exe'),
            'icon.image' => trans('admin.icon_type'),
            'icon.mimes' => trans('admin.icon_exe'),
            'description.required' => trans('admin.desc_required'),
            'keywords.required' => trans('admin.keywords_required'),
            'message_maintenance.required' => trans('admin.maintenance_required'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['sitename_ar'] = $request->sitename_ar;
        $data['sitename_en'] = $request->sitename_en;
        $data['email'] = $request->email;
        $data['main_lang'] = $request->main_lang;
        $data['description'] = $request->description;
        $data['keywords'] = $request->keywords;
        $data['status'] = $request->status;
        $data['message_maintenance'] = $request->message_maintenance;

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
