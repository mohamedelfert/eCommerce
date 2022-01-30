<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDatatable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(AdminDatatable $admin)
    {
        return $admin->render('admin.admins.index', ['title' => trans('admin.admins_control')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_admin');
        return view('admin.admins.create', compact('title'));
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
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ];
        $validate_msg_ar = [
            'name.required' => trans('admin_validation.name_required'),
            'email.required' => trans('admin_validation.email_required'),
            'email.email' => trans('admin_validation.email_email'),
            'email.unique' => trans('admin_validation.email_unique'),
            'password.required' => trans('admin_validation.password_required'),
            'password.min' => trans('admin_validation.password_min'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        Admin::create($data);
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
        $admin = Admin::findOrFail($id);
        $title = trans('admin.edit_admin');
        return view('admin.admins.edit',compact('title','admin'));
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'required|min:6',
//            'password' => 'sometimes|nullable|min:6',  // sometimes|nullable use if password null when update -> user didn't change password.
        ];
        $validate_msg_ar = [
            'name.required' => trans('admin_validation.name_required'),
            'email.required' => trans('admin_validation.email_required'),
            'email.email' => trans('admin_validation.email_email'),
            'email.unique' => trans('admin_validation.email_unique'),
            'password.required' => trans('admin_validation.password_required'),
            'password.min' => trans('admin_validation.password_min'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $admin = Admin::findOrFail($id);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        // check if user change password or not - request has password or not.
//        if ($request->has('password')){
//            $data['password'] = bcrypt($request->password);
//        }
        $admin->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return back();
    }

    public function delete_all(Request $request)
    {
//        Admin::whereIn('id',$request->box)->delete();  // Or
        if (is_array($request->box)){
            Admin::destroy($request->box);
        }else{
            Admin::find($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return back();
    }
}
