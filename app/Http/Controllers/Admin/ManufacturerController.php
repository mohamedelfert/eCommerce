<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ManufacturerDatatable;
use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ManufacturerDatatable $manufacturer)
    {
        return $manufacturer->render('admin.manufacturers.index', ['title' => trans('admin.manufacturers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_manufacturer');
        return view('admin.manufacturers.create', compact('title'));
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
            'name_ar' => 'required|unique:manufacturers',
            'name_en' => 'required|unique:manufacturers',
            'contact_name' => 'sometimes|nullable|string',
            'email' => 'required|email|unique:manufacturers',
            'phone' => 'required|digits:11|unique:manufacturers',
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
                'path' => 'manufacturers',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        Manufacturer::create($data);
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
        $manufacturer = Manufacturer::findOrFail($id);
        $title = trans('admin.edit_manufacturer');
        return view('admin.manufacturers.edit', compact('title', 'manufacturer'));
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
            'name_ar' => 'required|unique:manufacturers,name_ar,' . $id,
            'name_en' => 'required|unique:manufacturers,name_en,' . $id,
            'contact_name' => 'sometimes|nullable|string',
            'email' => 'required|email|unique:manufacturers,email,' . $id,
            'phone' => 'required|digits:11|unique:manufacturers,phone,' . $id,
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

        $manufacturer = Manufacturer::findOrFail($id);
        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['contact_name'] = $request->contact_name;
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
                'path' => 'manufacturers',
                'upload_type' => 'single',
                'delete_file' => Manufacturer::find($id)->logo,
            ]);
        }

        $manufacturer->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('manufacturers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        Storage::delete($manufacturer->logo);
        $manufacturer->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                $manufacturer = Manufacturer::find($id);
                Storage::delete($manufacturer->logo);
                $manufacturer->delete();
            }
        } else {
            $manufacturer = Manufacturer::find($request->box);
            Storage::delete($manufacturer->logo);
            $manufacturer->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
