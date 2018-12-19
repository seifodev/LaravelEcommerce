<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StateDataTable;
use App\Model\City;
use App\Model\State;
use App\Model\Country;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param StateDataTable $state
     * @return \Illuminate\Http\Response
     */
    public function index(StateDataTable $state)
    {
        //
        return $state->render('admin.states.index', ['title' => trans('admin.statesTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // If AJAX Request
        if($request->ajax())
        {
            $name = 'cities.name_' . (lang() == 'ar' ? 'ar' : 'en') . ' as name';
            return Country::whereId($request->input('id'))->first()->cities()->select([$name, 'id'])->get();
        }

        // HTTP Request
        $countries = $this->pluckCountries();
        return view('admin.states.create', ['title' => trans('admin.createState'), 'countries' => $countries]);
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
            'city_id' => 'required|exists:cities,id'
        ], [], [
            'name_ar' => trans('admin.form.state_ar'),
            'name_en' => trans('admin.form.state_en'),
            'city_id' => trans('admin.form.city'),
        ]);

        $state = State::create($data);
        return redirect()->route('states.index')->with(['success' => trans('admin.stateCreated')]);
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
        $countries = $this->pluckCountries();
        $state = State::findOrFail($id);
        $title = trans('admin.editState');
        return view('admin.states.edit', compact('state', 'title', 'countries'));
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
            'city_id' => 'required|exists:cities,id'
        ], [], [
            'name_ar' => trans('admin.form.state_ar'),
            'name_en' => trans('admin.form.state_en'),
            'city_id' => trans('admin.form.city'),
        ]);

        $state = State::findOrFail($id);

        $state->update($data);;

        return back()->with(['success' => trans('admin.cityUpdated')]);

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

        if($request->has('check') && is_array($request->input('check')))
        {
            State::destroy($request->input('check'));
        } else
        {
            return back();
        }

        return back()->with(['success' => trans('admin.stateDeleted')]);
    }

    public function pluckCountries()
    {
        $name = 'name_' . lang();
        return \App\Model\Country::pluck($name, 'id')->all();
    }

}
