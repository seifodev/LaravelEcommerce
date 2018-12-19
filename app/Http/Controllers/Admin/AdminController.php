<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDataTable;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $admin)
    {
        //
        return $admin->render('admin.admins.index', ['title' => trans('admin.adminsTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admins.create', ['title' => trans('admin.createAdmin')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|min:4|max:16',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|max:18|confirmed'
        ], [], [
            'name' => trans('admin.form.name'),
            'email' => trans('admin.form.email'),
            'password' => trans('admin.form.password'),
            'password_confirmation' => trans('admin.form.cPassword'),
        ]);

        $password = ['password' => bcrypt($request->input('password'))];
        $data = array_merge($request->only('name', 'email'), $password);
        $admin = Admin::create($data);

        return redirect()->route('admins.index')->with(['success' => trans('admin.adminCreated', ['name' => $admin->name])]);
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
        //
        $admin = Admin::findOrFail($id);
        $title = trans('admin.editAdmin', ['name' => $admin->name]);
        return view('admin.admins.edit', compact('admin', 'title'));
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
        //
        $data =  $this->validate($request, [
            'name' => 'required|min:4|max:16',
            'email' => 'required|email|unique:admins,id,' . $id,
            'password' => 'nullable|min:6|max:18|confirmed'
        ], [], [
            'name' => trans('admin.form.name'),
            'email' => trans('admin.form.email'),
            'password' => trans('admin.form.password'),
            'password_confirmation' => trans('admin.form.cPassword'),
        ]);

        if(!$data['password'])
        {
            unset($data['password']);
        } else
        {
            $data['password'] = bcrypt($data['password']);
        }


        $admin = Admin::findOrFail($id);
        $admin->update($data);;

        return back()->with(['success' => trans('admin.adminUpdated', ['name' => $admin->name])]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {

        return back();

    }

    public function destroyAll(Request $request)
    {
        $records = $request->input('check');
        Admin::destroy($records);
        return back()->with(['success' => trans('admin.adminDeleted', ['records' => count($records)])]);
    }

}
