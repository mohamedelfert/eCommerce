<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MallDatatable;
use App\Http\Controllers\Controller;
use App\Models\Mall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class MallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MallDatatable $mall)
    {
        return $mall->render('admin.malls.index', ['title' => trans('admin.malls')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_mall');
        return view('admin.malls.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name_ar' => 'required|unique:malls',
            'name_en' => 'required|unique:malls',
            'contact_name' => 'sometimes|nullable|string',
            'country_id' => 'required|exists:countries,id',
            'email' => 'required|email|unique:malls',
            'phone' => 'required|digits:11|unique:malls',
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'address' => 'sometimes|nullable',
            'latitude' => 'sometimes|nullable',
            'longitude' => 'sometimes|nullable',
            'logo' => 'required|' . validate_image(),
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
            'country_id.required' => trans('admin_validation.country_name_' . session('lang')),
            'country_id.exists' => trans('admin_validation.exists'),
            'email.required' => trans('admin_validation.email_required'),
            'email.unique' => trans('admin_validation.email_unique'),
            'phone.required' => trans('admin_validation.phone_required'),
            'phone.unique' => trans('admin_validation.phone_unique'),
            'phone.digits' => trans('admin_validation.phone_digits'),
            'logo.required' => trans('admin_validation.logo_required'),
            'logo.image' => trans('admin_validation.logo_type'),
            'logo.mimes' => trans('admin_validation.logo_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['contact_name'] = $request->contact_name;
        $data['country_id'] = $request->country_id;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['website'] = $request->website;
        $data['address'] = $request->address;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'malls',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        Mall::create($data);
        toastr()->success(trans('admin_validation.success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $mall = Mall::findOrFail($id);
        $title = trans('admin.edit_mall');
        return view('admin.malls.edit', compact('title', 'mall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar' => 'required|unique:malls,name_ar,' . $id,
            'name_en' => 'required|unique:malls,name_en,' . $id,
            'contact_name' => 'sometimes|nullable|string',
            'country_id' => 'required|exists:countries,id',
            'email' => 'required|email|unique:malls,email,' . $id,
            'phone' => 'required|digits:11|unique:malls,phone,' . $id,
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'address' => 'sometimes|nullable',
            'latitude' => 'sometimes|nullable',
            'longitude' => 'sometimes|nullable',
            'logo' => 'required|' . validate_image(),
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
            'country_id.required' => trans('admin_validation.country_name_' . session('lang')),
            'country_id.exists' => trans('admin_validation.exists'),
            'email.required' => trans('admin_validation.email_required'),
            'email.unique' => trans('admin_validation.email_unique'),
            'phone.required' => trans('admin_validation.phone_required'),
            'phone.unique' => trans('admin_validation.phone_unique'),
            'phone.digits' => trans('admin_validation.phone_digits'),
            'logo.required' => trans('admin_validation.logo_required'),
            'logo.image' => trans('admin_validation.logo_type'),
            'logo.mimes' => trans('admin_validation.logo_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $mall = Mall::findOrFail($id);
        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['contact_name'] = $request->contact_name;
        $data['country_id'] = $request->country_id;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['website'] = $request->website;
        $data['address'] = $request->address;
        $data['latitude'] = $request->latitude;
        $data['longitude'] = $request->longitude;
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'malls',
                'upload_type' => 'single',
                'delete_file' => Mall::find($id)->logo,
            ]);
        }

        $mall->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('malls'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $mall = Mall::findOrFail($id);
        Storage::delete($mall->logo);
        $mall->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                $mall = Mall::find($id);
                Storage::delete($mall->logo);
                $mall->delete();
            }
        } else {
            $mall = Mall::find($request->box);
            Storage::delete($mall->logo);
            $mall->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
