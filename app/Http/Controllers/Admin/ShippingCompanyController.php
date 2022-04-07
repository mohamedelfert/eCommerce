<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ShippingCompanyDatatable;
use App\Http\Controllers\Controller;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ShippingCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ShippingCompanyDatatable $company)
    {
        return $company->render('admin.companies.index', ['title' => trans('admin.companies')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_shipping_company');
        return view('admin.companies.create', compact('title', 'users'));
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
            'name_ar' => 'required|unique:shipping_companies',
            'name_en' => 'required|unique:shipping_companies',
            'user_id' => 'required|numeric',
            'phone' => 'required|digits:11|unique:shipping_companies',
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
        $data['user_id'] = $request->user_id;
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
                'path' => 'companies',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        ShippingCompany::create($data);
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
        $shippingCompany = ShippingCompany::findOrFail($id);
        $title = trans('admin.edit_shipping_company');
        return view('admin.companies.edit', compact('title', 'shippingCompany'));
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
            'name_ar' => 'required|unique:shipping_companies,name_ar,' . $id,
            'name_en' => 'required|unique:shipping_companies,name_en,' . $id,
            'user_id' => 'required|numeric',
            'phone' => 'required|digits:11|unique:shipping_companies,phone,' . $id,
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
            'phone.required' => trans('admin_validation.phone_required'),
            'phone.unique' => trans('admin_validation.phone_unique'),
            'phone.digits' => trans('admin_validation.phone_digits'),
            'logo.required' => trans('admin_validation.logo_required'),
            'logo.image' => trans('admin_validation.logo_type'),
            'logo.mimes' => trans('admin_validation.logo_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $shippingCompany = ShippingCompany::findOrFail($id);
        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['user_id'] = $request->user_id;
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
                'path' => 'companies',
                'upload_type' => 'single',
                'delete_file' => ShippingCompany::find($id)->logo,
            ]);
        }

        $shippingCompany->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('companies'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $shippingCompany = ShippingCompany::findOrFail($id);
        Storage::delete($shippingCompany->logo);
        $shippingCompany->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                $shippingCompany = ShippingCompany::find($id);
                Storage::delete($shippingCompany->logo);
                $shippingCompany->delete();
            }
        } else {
            $shippingCompany = ShippingCompany::find($request->box);
            Storage::delete($shippingCompany->logo);
            $shippingCompany->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
