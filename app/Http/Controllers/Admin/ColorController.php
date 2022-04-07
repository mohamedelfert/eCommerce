<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ColorDatatable;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ColorDatatable $color)
    {
        return $color->render('admin.colors.index', ['title' => trans('admin.colors')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_color');
        return view('admin.colors.create', compact('title'));
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
            'name_ar' => 'required|unique:colors',
            'name_en' => 'required|unique:colors',
            'color' => 'required|unique:colors|string',
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
            'color.required' => trans('admin_validation.required'),
            'color.unique' => trans('admin_validation.unique'),
            'color.string' => trans('admin_validation.string'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['color'] = $request->color;

        Color::create($data);
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
        $color = Color::findOrFail($id);
        $title = trans('admin.edit_color');
        return view('admin.colors.edit', compact('title', 'color'));
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
            'name_ar' => 'required|unique:colors,name_ar,' . $id,
            'name_en' => 'required|unique:colors,name_en,' . $id,
            'color' => 'required|string|unique:colors,color,' . $id,

        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar_required'),
            'name_ar.unique' => trans('admin_validation.name_ar_unique'),
            'name_en.required' => trans('admin_validation.name_en_required'),
            'name_en.unique' => trans('admin_validation.name_en_unique'),
            'color.required' => trans('admin_validation.required'),
            'color.unique' => trans('admin_validation.unique'),
            'color.string' => trans('admin_validation.string'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $color = Color::findOrFail($id);
        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        $data['color'] = $request->color;

        $color->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('colors'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Color::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                Color::find($id)->delete();
            }
        } else {
            Color::find($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
