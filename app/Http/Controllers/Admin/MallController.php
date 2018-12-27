<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MallDataTable;
use App\Model\Mall;
use Up;

class MallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MallDataTable $mall
     * @return \Illuminate\Http\Response
     */
    public function index(MallDataTable $mall)
    {
        //
        return $mall->render('admin.malls.index', ['title' => trans('admin.mallsTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $country_name = 'name_' . lang() . ' as name';
        $countries = \App\Model\Country::select('id', $country_name)->pluck('name', 'id')->all();
        $title = trans('admin.createMall');
        return view('admin.malls.create', compact('title', 'countries'));
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
            'contact_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'web_site' => 'nullable',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'address' => 'nullable',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'logo' => validImg(),
            'country_id' => 'required|exists:countries,id'
        ], [], [
            'name_ar' => trans('admin.form.mall_ar'),
            'name_en' => trans('admin.form.mall_en'),
            'contact_name' => trans('admin.form.manufacture_contact'),
            'email' => trans('admin.form.email'),
            'mobile' => trans('admin.form.mobile'),
            'web_site' => trans('admin.form.website'),
            'facebook' => trans('admin.form.facebook'),
            'twitter' => trans('admin.form.twitter'),
            'logo' => trans('admin.form.logo'),
        ]);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'malls',
            ]);
        }

        $mall = Mall::create($data);
        return redirect()->route('malls.index')->with(['success' => trans('admin.mallCreated')]);
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
        $mall = Mall::findOrFail($id);
        $name = 'name_' . lang();
        $title = trans('admin.editMall', ['name' => $mall->$name]);
        $country_name = 'name_' . lang() . ' as name';
        $countries = \App\Model\Country::select('id', $country_name)->pluck('name', 'id')->all();
        return view('admin.malls.edit', compact('mall', 'title', 'countries'));
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
            'contact_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'web_site' => 'nullable',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'address' => 'nullable',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'logo' => validImg(),
            'country_id' => 'required|exists:countries,id'
        ], [], [
            'name_ar' => trans('admin.form.mall_ar'),
            'name_en' => trans('admin.form.mall_en'),
            'contact_name' => trans('admin.form.manufacture_contact'),
            'email' => trans('admin.form.email'),
            'mobile' => trans('admin.form.mobile'),
            'web_site' => trans('admin.form.website'),
            'facebook' => trans('admin.form.facebook'),
            'twitter' => trans('admin.form.twitter'),
            'logo' => trans('admin.form.logo'),
        ]);

        $mall = Mall::findOrFail($id);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'malls',
                'delete' => $mall->logo,
            ]);
        } else
        {
            unset($data['logo']);
        }



        $mall->update($data);;

        return back()->with(['success' => trans('admin.mallUpdated')]);

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
                $mall = Mall::findOrFail($id);
                \Storage::delete($mall->logo);
                $mall->delete();
            }
        } else
        {
            return back();
        }

        return back()->with(['success' => trans('admin.mallDeleted')]);
    }

}
