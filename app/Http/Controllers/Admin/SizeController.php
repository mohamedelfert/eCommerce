<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SizeDatatable;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(SizeDatatable $size)
    {
        return $size->render('admin.sizes.index', ['title' => trans('admin.sizes')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_size');
        return view('admin.sizes.create', compact('title'));
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
            'name_ar' => 'required|unique:sizes',
            'name_en' => 'required|unique:sizes',
            'department_id' => 'required|numeric',
            'is_public' => 'required|in:yes,no',
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
            'department_id.required' => trans('admin_validation.department_id_required'),
            'department_id.numeric' => trans('admin_validation.numeric'),
            'is_public.required' => trans('admin_validation.is_public_required'),
            'is_public.in' => trans('admin_validation.in'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['department_id'] = $request->department_id;
        $data['is_public'] = $request->is_public;

        Size::create($data);
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
        $size = Size::findOrFail($id);
        $title = trans('admin.edit_size');
        return view('admin.sizes.edit', compact('title', 'size'));
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
            'name_ar' => 'required|unique:sizes,name_ar,' . $id,
            'name_en' => 'required|unique:sizes,name_en,' . $id,
            'department_id' => 'required|numeric',
            'is_public' => 'required|in:yes,no',
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
            'department_id.required' => trans('admin_validation.department_id_required'),
            'department_id.numeric' => trans('admin_validation.numeric'),
            'is_public.required' => trans('admin_validation.is_public_required'),
            'is_public.in' => trans('admin_validation.in'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $size = Size::findOrFail($id);
        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['department_id'] = $request->department_id;
        $data['is_public'] = $request->is_public;

        $size->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('sizes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Size::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                Size::find($id)->delete();
            }
        } else {
            Size::find($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
