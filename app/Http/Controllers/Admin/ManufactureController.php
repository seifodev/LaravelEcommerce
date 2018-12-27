<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ManufactureDataTable;
use App\Model\Manufacture;
use Up;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ManufactureDataTable $manufacture
     * @return \Illuminate\Http\Response
     */
    public function index(ManufactureDataTable $manufacture)
    {
        //
        return $manufacture->render('admin.manufactures.index', ['title' => trans('admin.manufacturesTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.manufactures.create', ['title' => trans('admin.createManufacture')]);
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
        ], [], [
            'name_ar' => trans('admin.form.trademark_ar'),
            'name_en' => trans('admin.form.trademark_en'),
            'contact_name' => trans('admin.form.manufacture_contact'),
            'email' => trans('admin.form.email'),
            'mobile' => trans('admin.form.mobile'),
            'web_site' => trans('admin.form.website'),
            'facebook' => trans('admin.form.facebook'),
            'twitter' => trans('admin.form.twitter'),
            'logo' => trans('admin.form.trademark_logo'),
        ]);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'manufactures',
            ]);
        }

        $manufacture = Manufacture::create($data);
        return redirect()->route('manufactures.index')->with(['success' => trans('admin.manufactureCreated')]);
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
        $manufacture = Manufacture::findOrFail($id);
        $name = 'name_' . lang();
        $title = trans('admin.editManufacture', ['name' => $manufacture->$name]);
        return view('admin.manufactures.edit', compact('manufacture', 'title'));
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
        ], [], [
            'name_ar' => trans('admin.form.trademark_ar'),
            'name_en' => trans('admin.form.trademark_en'),
            'contact_name' => trans('admin.form.manufacture_contact'),
            'email' => trans('admin.form.email'),
            'mobile' => trans('admin.form.mobile'),
            'web_site' => trans('admin.form.website'),
            'facebook' => trans('admin.form.facebook'),
            'twitter' => trans('admin.form.twitter'),
            'logo' => trans('admin.form.trademark_logo'),
        ]);

        $manufacture = Manufacture::findOrFail($id);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'manufactures',
                'delete' => $manufacture->logo,
            ]);
        } else
        {
            unset($data['logo']);
        }



        $manufacture->update($data);;

        return back()->with(['success' => trans('admin.manufactureUpdated')]);

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
                $manufacture = Manufacture::findOrFail($id);
                \Storage::delete($manufacture->logo);
                $manufacture->delete();
            }
        } else
        {
            return back();
        }

        return back()->with(['success' => trans('admin.manufactureDeleted')]);
    }

}
