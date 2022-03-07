<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StateDatatable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Form;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *cities
     * @return Response
     */
    public function index(StateDatatable $state)
    {
        return $state->render('admin.states.index', ['title' => trans('admin.states')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (request()->ajax()){
            if (request()->has('country_id')){
                $select = request()->has('select') ? request('select') : '';
                return Form::select('city_id',City::where('country_id',request('country_id'))->pluck('city_name_'.session('lang'),'id'),
                        $select,['class'=>'custom-select rounded-0','placeholder'=>'Select City']);
            }
        }
        $title = trans('admin.new_state');
        return view('admin.states.create', compact('title'));
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
            'state_name_ar' => 'required',
            'state_name_en' => 'required',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
        ];
        $validate_msg_ar = [
            'state_name_ar.required' => trans('admin_validation.state_name_ar'),
            'state_name_en.required' => trans('admin_validation.state_name_en'),
            'city_id.required' => trans('admin_validation.city_name_' . session('lang')),
            'city_id.exists' => trans('admin_validation.exists'),
            'country_id.required' => trans('admin_validation.country_name_' . session('lang')),
            'country_id.exists' => trans('admin_validation.exists'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['state_name_ar'] = $request->state_name_ar;
        $data['state_name_en'] = $request->state_name_en;
        $data['city_id'] = $request->city_id;
        $data['country_id'] = $request->country_id;

        State::create($data);
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
        $state = State::findOrFail($id);
        $title = trans('admin.edit_state');
        return view('admin.states.edit', compact('title', 'state'));
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
            'state_name_ar' => 'required',
            'state_name_en' => 'required',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
        ];
        $validate_msg_ar = [
            'state_name_ar.required' => trans('admin_validation.state_name_ar'),
            'state_name_en.required' => trans('admin_validation.state_name_en'),
            'city_id.required' => trans('admin_validation.city_name_' . session('lang')),
            'city_id.exists' => trans('admin_validation.exists'),
            'country_id.required' => trans('admin_validation.country_name_' . session('lang')),
            'country_id.exists' => trans('admin_validation.exists'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $state = State::findOrFail($id);
        $data['state_name_ar'] = $request->state_name_ar;
        $data['state_name_en'] = $request->state_name_en;
        $data['city_id'] = $request->city_id;
        $data['country_id'] = $request->country_id;

        $state->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        State::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                State::findOrFail($id)->delete();
            }
        } else {
            State::findOrFail($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
