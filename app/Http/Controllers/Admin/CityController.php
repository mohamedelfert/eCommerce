<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CityDatatable;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *cities
     * @return Response
     */
    public function index(CityDatatable $city)
    {
        return $city->render('admin.cities.index', ['title' => trans('admin.cities')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_city');
        return view('admin.cities.create', compact('title'));
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
            'city_name_ar' => 'required',
            'city_name_en' => 'required',
            'country_id' => 'required|exists:countries,id',
        ];
        $validate_msg_ar = [
            'city_name_ar.required' => trans('admin_validation.city_name_ar'),
            'city_name_en.required' => trans('admin_validation.city_name_en'),
            'country_id.required' => trans('admin_validation.country_name_' . session('lang')),
            'country_id.exists' => trans('admin_validation.exists'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['city_name_ar'] = $request->city_name_ar;
        $data['city_name_en'] = $request->city_name_en;
        $data['country_id'] = $request->country_id;

        City::create($data);
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
        $city = City::findOrFail($id);
        $title = trans('admin.edit_city');
        return view('admin.cities.edit', compact('title', 'city'));
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
            'city_name_ar' => 'required',
            'city_name_en' => 'required',
            'country_id' => 'required|exists:countries,id',
        ];
        $validate_msg_ar = [
            'city_name_ar.required' => trans('admin_validation.city_name_ar'),
            'city_name_en.required' => trans('admin_validation.city_name_en'),
            'country_id.required' => trans('admin_validation.country_name_' . session('lang')),
            'country_id.exists' => trans('admin_validation.exists'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $city = City::findOrFail($id);
        $data['city_name_ar'] = $request->city_name_ar;
        $data['city_name_en'] = $request->city_name_en;
        $data['country_id'] = $request->country_id;

        $city->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        City::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                City::findOrFail($id)->delete();
            }
        } else {
            City::findOrFail($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
