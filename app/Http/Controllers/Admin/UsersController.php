<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDatatable;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatable $user)
    {
        return $user->render('admin.users.index',['title' => trans('user.users_control')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('user.new_user');
        return view('admin.users.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'level' => 'required|in:user,vendor,company',
        ];
        $validate_msg_ar = [
            'name.required' => trans('user_validation.name_required'),
            'email.required' => trans('user_validation.email_required'),
            'email.email' => trans('user_validation.email_email'),
            'email.unique' => trans('user_validation.email_unique'),
            'password.required' => trans('user_validation.password_required'),
            'password.min' => trans('user_validation.password_min'),
            'level.required' => trans('user_validation.level_required'),
            'level.in' => trans('user_validation.level_in'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['level'] = $request->level;
        User::create($data);
        toastr()->success(trans('user_validation.success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $title = trans('user.edit_user');
        return view('admin.users.edit', compact('title','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6',
            'level' => 'required|in:user,vendor,company',
        ];
        $validate_msg_ar = [
            'name.required' => trans('user_validation.name_required'),
            'email.required' => trans('user_validation.email_required'),
            'email.email' => trans('user_validation.email_email'),
            'email.unique' => trans('user_validation.email_unique'),
            'password.required' => trans('user_validation.password_required'),
            'password.min' => trans('user_validation.password_min'),
            'level.required' => trans('user_validation.level_required'),
            'level.in' => trans('user_validation.level_in'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $user = User::findOrFail($id);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['level'] = $request->level;
        $user->update($data);
        toastr()->success(trans('user_validation.update'));
        return redirect(adminUrl('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        toastr()->error(trans('user_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        User::whereIn('id',$request->box)->delete();
        toastr()->error(trans('user_validation.delete'));
        return redirect()->back();
    }
}
