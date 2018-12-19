<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CityDataTable;
use App\Model\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CityDataTable $city
     * @return \Illuminate\Http\Response
     */
    public function index(CityDataTable $city)
    {
        //
        return $city->render('admin.cities.index', ['title' => trans('admin.citiesTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = $this->pluckCountries();
        return view('admin.cities.create', ['title' => trans('admin.createCity'), 'countries' => $countries]);
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
            'country_id' => 'required|exists:countries,id'
        ], [], [
            'name_ar' => trans('admin.form.city_ar'),
            'name_en' => trans('admin.form.city_en'),
            'country_id' => trans('admin.form.country'),
        ]);

        $city = City::create($data);
        return redirect()->route('cities.index')->with(['success' => trans('admin.cityCreated')]);
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
        $city = City::findOrFail($id);
        $title = trans('admin.editCity', ['name' => lang() == 'ar' ? $city->name_ar : $city->name_en]);
        return view('admin.cities.edit', compact('city', 'title', 'countries'));
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
            'country_id' => 'required|exists:countries,id'
        ], [], [
            'name_ar' => trans('admin.form.city_ar'),
            'name_en' => trans('admin.form.city_en'),
            'country_id' => trans('admin.form.country'),
        ]);

        $city = City::findOrFail($id);

        $city->update($data);;

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
            City::destroy($request->input('check'));
        } else
        {
            return back();
        }

        return back()->with(['success' => trans('admin.countryDeleted')]);
    }

    public function pluckCountries()
    {
        $name = 'name_' . lang();
        return \App\Model\Country::pluck($name, 'id')->all();
    }

}
