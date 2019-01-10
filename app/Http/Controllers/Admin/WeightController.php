<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\WeightDataTable;
use App\Model\Weight;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param WeightDataTable $weight
     * @return \Illuminate\Http\Response
     */
    public function index(WeightDataTable $weight)
    {
        //
        return $weight->render('admin.weights.index', ['title' => trans('admin.weightsTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = trans('admin.createWeight');
        return view('admin.weights.create', compact('title'));
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
        ], [], [
            'name_ar' => trans('admin.form.weight_ar'),
            'name_en' => trans('admin.form.weight_en'),
        ]);


        $weight = Weight::create($data);
        return redirect()->route('weights.index')->with(['success' => trans('admin.weightCreated')]);
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
        $weight = Weight::findOrFail($id);
        $name = 'name_' . lang();
        $title = trans('admin.editWeight', ['name' => $weight->$name]);
        return view('admin.weights.edit', compact('weight', 'title'));
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
        ], [], [
            'name_ar' => trans('admin.form.weight_ar'),
            'name_en' => trans('admin.form.weight_en'),
        ]);

        $weight = Weight::findOrFail($id);

        $weight->update($data);;

        return back()->with(['success' => trans('admin.weightUpdated')]);

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

        Weight::destroy($request->input('check'));
        return back()->with(['success' => trans('admin.weightDeleted')]);
    }

}
