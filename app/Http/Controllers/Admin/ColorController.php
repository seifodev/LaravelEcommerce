<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ColorDataTable;
use App\Model\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ColorDataTable $color
     * @return \Illuminate\Http\Response
     */
    public function index(ColorDataTable $color)
    {
        //
        return $color->render('admin.colors.index', ['title' => trans('admin.colorsTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = trans('admin.createColor');
        return view('admin.colors.create', compact('title'));
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
            'color' => 'required',
        ], [], [
            'name_ar' => trans('admin.form.color_ar'),
            'name_en' => trans('admin.form.color_en'),
            'color' => trans('admin.form.color'),
        ]);


        $color = Color::create($data);
        return redirect()->route('colors.index')->with(['success' => trans('admin.colorCreated')]);
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
        $color = Color::findOrFail($id);
        $name = 'name_' . lang();
        $title = trans('admin.editColor', ['name' => $color->$name]);
        return view('admin.colors.edit', compact('color', 'title'));
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
            'color' => 'required',
        ], [], [
            'name_ar' => trans('admin.form.color_ar'),
            'name_en' => trans('admin.form.color_en'),
            'color' => trans('admin.form.color'),
        ]);

        $color = Color::findOrFail($id);

        $color->update($data);;

        return back()->with(['success' => trans('admin.colorUpdated')]);

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

        Color::destroy($request->input('check'));
        return back()->with(['success' => trans('admin.colorDeleted')]);
    }

}
