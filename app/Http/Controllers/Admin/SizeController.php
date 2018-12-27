<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SizeDataTable;
use App\Model\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SizeDataTable $size
     * @return \Illuminate\Http\Response
     */
    public function index(SizeDataTable $size)
    {
        //
        return $size->render('admin.sizes.index', ['title' => trans('admin.sizesTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = trans('admin.createSize');
        return view('admin.sizes.create', compact('title'));
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
            'name_ar' => 'required|min:2|max:16',
            'name_en' => 'required|min:2|max:16',
            'department_id' => 'required|exists:departments,id',
            'is_public' => 'required|in:yes,no',
        ], [], [
            'name_ar' => trans('admin.form.size_ar'),
            'name_en' => trans('admin.form.size_en'),
            'department_id' => trans('admin.form.department'),
            'is_public' => trans('admin.form.public'),
        ]);


        $size = Size::create($data);
        return redirect()->route('sizes.index')->with(['success' => trans('admin.sizeCreated')]);
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
        $size = Size::findOrFail($id);
        $name = 'name_' . lang();
        $title = trans('admin.editSize', ['name' => $size->$name]);
        return view('admin.sizes.edit', compact('size', 'title'));
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
        $data = $this->validate($request, [
            'name_ar' => 'required|min:2|max:16',
            'name_en' => 'required|min:2|max:16',
            'department_id' => 'required|exists:departments,id',
            'is_public' => 'required|in:yes,no',
        ], [], [
            'name_ar' => trans('admin.form.size_ar'),
            'name_en' => trans('admin.form.size_en'),
            'department_id' => trans('admin.form.department'),
            'is_public' => trans('admin.form.public'),
        ]);

        $size = Size::findOrFail($id);

        $size->update($data);;

        return back()->with(['success' => trans('admin.sizeUpdated')]);

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

        Size::destroy($request->input('check'));
        return back()->with(['success' => trans('admin.sizeDeleted')]);
    }

}
