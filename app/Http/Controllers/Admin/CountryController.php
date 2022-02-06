<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDatatable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(CountryDatatable $country)
    {
        return $country->render('admin.countries.index', ['title' => trans('admin.countries')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_country');
        return view('admin.countries.create', compact('title'));
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
            'country_name_ar' => 'required',
            'country_name_en' => 'required',
            'mob' => 'required',
            'code' => 'required',
            'logo' => 'required|' . validate_image(),
        ];
        $validate_msg_ar = [
            'country_name_ar.required' => trans('admin_validation.country_name_ar'),
            'country_name_en.required' => trans('admin_validation.country_name_en'),
            'mob.required' => trans('admin_validation.mob'),
            'code.required' => trans('admin_validation.code'),
            'logo.required' => trans('admin_validation.country_logo_required'),
            'logo.image' => trans('admin_validation.country_logo_type'),
            'logo.mimes' => trans('admin_validation.country_logo_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['country_name_ar'] = $request->country_name_ar;
        $data['country_name_en'] = $request->country_name_en;
        $data['mob'] = $request->mob;
        $data['code'] = $request->code;
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        Country::create($data);
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
        $country = Country::findOrFail($id);
        $title = trans('admin.edit_country');
        return view('admin.countries.edit', compact('title', 'country'));
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
            'country_name_ar' => 'required',
            'country_name_en' => 'required',
            'mob' => 'required',
            'code' => 'required',
            'logo' => 'required|sometimes|nullable|' . validate_image(),
        ];
        $validate_msg_ar = [
            'country_name_ar.required' => trans('admin_validation.country_name_ar'),
            'country_name_en.required' => trans('admin_validation.country_name_en'),
            'mob.required' => trans('admin_validation.mob'),
            'code.required' => trans('admin_validation.code'),
            'logo.required' => trans('admin_validation.country_logo_required'),
            'logo.image' => trans('admin_validation.country_logo_type'),
            'logo.mimes' => trans('admin_validation.country_logo_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $country = Country::findOrFail($id);
        $data['country_name_ar'] = $request->country_name_ar;
        $data['country_name_en'] = $request->country_name_en;
        $data['mob'] = $request->mob;
        $data['code'] = $request->code;
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'countries',
                'upload_type' => 'single',
                'delete_file' => Country::find($id)->logo,
            ]);
        }

        $country->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('countries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        Storage::delete($country->logo);
        $country->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)){
            foreach ($request->box as $id){
                $country = Country::find($id);
                Storage::delete($country->logo);
                $country->delete();
            }
        }else{
            $country = Country::find($request->box);
            Storage::delete($country->logo);
            $country->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
