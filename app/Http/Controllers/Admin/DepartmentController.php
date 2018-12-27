<?php

namespace App\Http\Controllers\Admin;

use App\Model\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.departments.index', ['title' => trans('admin.departmentsTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.departments.create', ['title' => trans('admin.createDepartment')]);
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
        $data = $this->validate($request, [
            'name_ar' => 'required|min:2',
            'name_en' => 'required|min:2',
            'parent_id' => 'nullable|exists:departments,id',
            'description' => 'nullable',
            'keywords' => 'nullable',
            'icon' => 'nullable|image|mimes:jpeg,bmp,png,gif',
        ], [], [
            'name_ar' => trans('admin.form.department_ar'),
            'name_en' => trans('admin.form.department_en'),
            'parent_id' => trans('admin.form.department'),
            'description' => trans('admin.form.desc'),
            'keywords' => trans('admin.form.keys'),
            'icon' => trans('admin.form.logo'),
        ]);

        if($request->hasFile('icon'))
        {
            $data['icon'] = up()->upload($request, [
                'file' => 'icon',
                'path' => 'departments',
            ]);
        }

        Department::create($data);

        return redirect()->route('departments.index')->with(['success' => trans('admin.departmentCreated')]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        $title = trans('admin.editDepartment');
        return view('admin.departments.edit', compact('title', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
        $data = $this->validate($request, [
            'name_ar' => 'required|min:2',
            'name_en' => 'required|min:2',
            'parent_id' => 'nullable|exists:departments,id',
            'description' => 'nullable',
            'keywords' => 'nullable',
            'icon' => 'nullable|image|mimes:jpeg,bmp,png,gif',
        ], [], [
            'name_ar' => trans('admin.form.department_ar'),
            'name_en' => trans('admin.form.department_en'),
            'parent_id' => trans('admin.form.department'),
            'description' => trans('admin.form.desc'),
            'keywords' => trans('admin.form.keys'),
            'icon' => trans('admin.form.logo'),
        ]);

        if($request->hasFile('icon'))
        {
            $data['icon'] = up()->upload($request, [
                'file' => 'icon',
                'path' => 'departments',
                'delete' => $department->icon
            ]);
        }

        $department->update($data);

        return back()->with(['success' => trans('admin.departmentUpdated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
//        $department->icon ? \Storage::delete($department->icon) : NULL;

        $department->delete();
        return back()->with(['success' => trans('admin.departmentDeleted')]);
    }
}
