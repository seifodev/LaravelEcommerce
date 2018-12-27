<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingDataTable;
use App\Model\Shipping;
use Up;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ShippingDataTable $shipping
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDataTable $shipping)
    {
        //
        return $shipping->render('admin.shippings.index', ['title' => trans('admin.shippingsTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $companies = \App\User::select(['id', 'level', 'name'])->where('level', 'company')->pluck('name', 'id')->all();
        $title = trans('admin.createShipping');
        return view('admin.shippings.create', compact('companies', 'title'));
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
            'user_id' => 'required|exists:users,id',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'logo' => validImg(),
        ], [], [
            'name_ar' => trans('admin.form.trademark_ar'),
            'name_en' => trans('admin.form.trademark_en'),
            'user_id' => trans('admin.form.owner'),
            'logo' => trans('admin.form.trademark_logo'),
        ]);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'shippings',
            ]);
        }

        $shipping = Shipping::create($data);
        return redirect()->route('shippings.index')->with(['success' => trans('admin.shippingCreated')]);
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
        $shipping = Shipping::findOrFail($id);
        $name = 'name_' . lang();
        $title = trans('admin.editShipping', ['name' => $shipping->$name]);
        $companies = \App\User::select(['id', 'level', 'name'])->where('level', 'company')->pluck('name', 'id')->all();
        return view('admin.shippings.edit', compact('shipping', 'title', 'companies'));
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
            'user_id' => 'required|exists:users,id',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'logo' => validImg(),
        ], [], [
            'name_ar' => trans('admin.form.trademark_ar'),
            'name_en' => trans('admin.form.trademark_en'),
            'user_id' => trans('admin.form.owner'),
            'logo' => trans('admin.form.trademark_logo'),
        ]);

        $shipping = Shipping::findOrFail($id);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'shippings',
                'delete' => $shipping->logo,
            ]);
        } else
        {
            unset($data['logo']);
        }



        $shipping->update($data);;

        return back()->with(['success' => trans('admin.shippingUpdated')]);

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
                $shipping = Shipping::findOrFail($id);
                \Storage::delete($shipping->logo);
                $shipping->delete();
            }
        } else
        {
            return back();
        }

        return back()->with(['success' => trans('admin.shippingDeleted')]);
    }

}
