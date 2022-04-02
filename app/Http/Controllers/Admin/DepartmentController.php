<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *cities
     * @return Response
     */
    public function index()
    {
        $title = trans('admin.departments');
        return view('admin.departments.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_department');
        return view('admin.departments.create', compact('title'));
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
            'department_name_ar' => 'required',
            'department_name_en' => 'required',
            'icon' => 'sometimes|nullable|' . validate_image(),
            'description' => 'sometimes|nullable',
            'keyword' => 'sometimes|nullable',
            'parent_id' => 'sometimes|nullable|numeric',
        ];
        $validate_msg_ar = [
            'department_name_ar.required' => trans('admin_validation.department_name_ar'),
            'department_name_en.required' => trans('admin_validation.department_name_en'),
            'icon.image' => trans('admin_validation.department_icon_type'),
            'icon.mimes' => trans('admin_validation.department_icon_exe'),
            'parent_id.numeric' => trans('admin_validation.department_parent_id'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['department_name_ar'] = $request->department_name_ar;
        $data['department_name_en'] = $request->department_name_en;
        $data['description'] = $request->description;
        $data['keyword'] = $request->keyword;
        $data['parent_id'] = $request->parent_id;
        if ($request->hasFile('icon')) {
            $data['icon'] = upload_file()->upload([
                'file' => 'icon',
                'path' => 'departments',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        Department::create($data);
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
        $department = Department::findOrFail($id);
        $title = trans('admin.edit_department');
        return view('admin.departments.edit', compact('title', 'department'));
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
            'department_name_ar' => 'required',
            'department_name_en' => 'required',
            'icon' => 'sometimes|nullable|' . validate_image(),
            'description' => 'sometimes|nullable',
            'keyword' => 'sometimes|nullable',
            'parent_id' => 'sometimes|nullable|numeric',
        ];
        $validate_msg_ar = [
            'department_name_ar.required' => trans('admin_validation.department_name_ar'),
            'department_name_en.required' => trans('admin_validation.department_name_en'),
            'icon.image' => trans('admin_validation.department_icon_type'),
            'icon.mimes' => trans('admin_validation.department_icon_exe'),
            'parent_id.numeric' => trans('admin_validation.department_parent_id'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $department = Department::findOrFail($id);
        $data['department_name_ar'] = $request->department_name_ar;
        $data['department_name_en'] = $request->department_name_en;
        $data['description'] = $request->description;
        $data['keyword'] = $request->keyword;
        $data['parent_id'] = $request->parent_id;
        if ($request->hasFile('icon')) {
            $data['icon'] = upload_file()->upload([
                'file' => 'icon',
                'path' => 'departments',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        $department->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Department::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                Department::findOrFail($id)->delete();
            }
        } else {
            Department::findOrFail($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
