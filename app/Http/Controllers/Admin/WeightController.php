<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WeightDatatable;
use App\Http\Controllers\Controller;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(WeightDatatable $weight)
    {
        return $weight->render('admin.weights.index', ['title' => trans('admin.weights')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_weight');
        return view('admin.weights.create', compact('title'));
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
            'name_ar' => 'required|unique:weights',
            'name_en' => 'required|unique:weights',
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;

        Weight::create($data);
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
        $weight = Weight::findOrFail($id);
        $title = trans('admin.edit_weight');
        return view('admin.weights.edit', compact('title', 'weight'));
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
            'name_ar' => 'required|unique:weights,name_ar,' . $id,
            'name_en' => 'required|unique:weights,name_en,' . $id,

        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $weight = Weight::findOrFail($id);
        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;

        $weight->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('weights'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Weight::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                Weight::find($id)->delete();
            }
        } else {
            Weight::find($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
