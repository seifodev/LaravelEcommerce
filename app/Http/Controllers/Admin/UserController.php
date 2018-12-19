<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $user)
    {
        //
        return $user->render('admin.users.index', ['title' => trans('admin.usersTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create', ['title' => trans('admin.createUser')]);
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:18|confirmed',
            'level' => 'required|in:user,vendor,company'
        ], [], [
            'name' => trans('admin.form.name'),
            'email' => trans('admin.form.email'),
            'password' => trans('admin.form.password'),
            'password_confirmation' => trans('admin.form.cPassword'),
            'level' => trans('admin.userLevel.level'),
        ]);

        $password = ['password' => bcrypt($request->input('password'))];
        $data = array_merge($request->only('name', 'email', 'level'), $password);
        $user = User::create($data);

        return redirect()->route('users.index')->with(['success' => trans('admin.userCreated', ['name' => $user->name])]);
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
        $user = User::findOrFail($id);
        $title = trans('admin.editUser', ['name' => $user->name]);
        return view('admin.users.edit', compact('user', 'title'));
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
            'email' => 'required|email|unique:users,id,' . $id,
            'password' => 'nullable|min:6|max:18|confirmed',
            'level' => 'required|in:user,vendor,company'
        ], [], [
            'name' => trans('admin.form.name'),
            'email' => trans('admin.form.email'),
            'password' => trans('admin.form.password'),
            'password_confirmation' => trans('admin.form.cPassword'),
            'level' => trans('admin.userLevel.level'),
        ]);

        if(!$data['password'])
        {
            unset($data['password']);
        } else
        {
            $data['password'] = bcrypt($data['password']);
        }


        $user = User::findOrFail($id);
        $user->update($data);;

        return back()->with(['success' => trans('admin.userUpdated', ['name' => $user->name])]);



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
//        return $request->all();
        $records = $request->input('check');
        User::destroy($records);
        return back()->with(['success' => trans('admin.userDeleted', ['records' => count($records)])]);
    }

}
