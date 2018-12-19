<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CountryDataTable;
use App\Model\Country;
use Up;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CountryDataTable $country
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDataTable $country)
    {
        //
        return $country->render('admin.countries.index', ['title' => trans('admin.countriesTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.countries.create', ['title' => trans('admin.createCountry')]);
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
            'mob' => 'required',
            'code' => 'required',
            'logo' => validImg(),
        ], [], [
            'name_ar' => trans('admin.form.country_ar'),
            'name_en' => trans('admin.form.country_en'),
            'mob' => trans('admin.form.country_mob'),
            'code' => trans('admin.form.country_code'),
            'logo' => trans('admin.form.country_logo'),
        ]);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'countries',
            ]);
        }

        $country = Country::create($data);
        return redirect()->route('countries.index')->with(['success' => trans('admin.countryCreated')]);
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
        $country = Country::findOrFail($id);
        $title = trans('admin.editCountry', ['name' => $country->name_en]);
        return view('admin.countries.edit', compact('country', 'title'));
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
            'mob' => 'required',
            'code' => 'required',
            'logo' => 'nullable|image:mimes:jpeg,bmp,gif,png',
        ], [], [
            'name_ar' => trans('admin.form.country_ar'),
            'name_en' => trans('admin.form.country_en'),
            'mob' => trans('admin.form.country_mob'),
            'code' => trans('admin.form.country_code'),
            'logo' => trans('admin.form.country_logo'),
        ]);

        $country = Country::findOrFail($id);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'countries',
                'delete' => $country->logo,
            ]);
        } else
        {
            unset($data['logo']);
        }



        $country->update($data);;

        return back()->with(['success' => trans('admin.countryUpdated')]);

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
            foreach($request->input('check') as $id)
            {
                $country = Country::findOrFail($id);
                \Storage::delete($country->logo);
                $country->delete();
            }
        } else
        {
            return back();
        }

        return back()->with(['success' => trans('admin.countryDeleted')]);
    }

}
