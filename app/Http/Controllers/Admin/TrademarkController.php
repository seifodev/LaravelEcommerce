<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TrademarkDataTable;
use App\Model\Trademark;
use Up;

class TrademarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TrademarkDataTable $trademark
     * @return \Illuminate\Http\Response
     */
    public function index(TrademarkDataTable $trademark)
    {
        //
        return $trademark->render('admin.trademarks.index', ['title' => trans('admin.trademarksTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.trademarks.create', ['title' => trans('admin.createTrademark')]);
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
            'logo' => validImg(),
        ], [], [
            'name_ar' => trans('admin.form.trademark_ar'),
            'name_en' => trans('admin.form.trademark_en'),
            'logo' => trans('admin.form.trademark_logo'),
        ]);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'trademarks',
            ]);
        }

        $trademark = Trademark::create($data);
        return redirect()->route('trademarks.index')->with(['success' => trans('admin.trademarkCreated')]);
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
        $trademark = Trademark::findOrFail($id);
        $name = 'name_' . lang();
        $title = trans('admin.editTrademark', ['name' => $trademark->$name]);
        return view('admin.trademarks.edit', compact('trademark', 'title'));
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
            'logo' => 'nullable|image:mimes:jpeg,bmp,gif,png',
        ], [], [
            'name_ar' => trans('admin.form.trademark_ar'),
            'name_en' => trans('admin.form.trademark_en'),
            'logo' => trans('admin.form.trademark_logo'),
        ]);

        $trademark = Trademark::findOrFail($id);

        if($request->hasFile('logo'))
        {
            $data['logo'] =  Up::upload($request, [
                'file' => 'logo',
                'path' => 'trademarks',
                'delete' => $trademark->logo,
            ]);
        } else
        {
            unset($data['logo']);
        }



        $trademark->update($data);;

        return back()->with(['success' => trans('admin.trademarkUpdated')]);

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
                $trademark = Trademark::findOrFail($id);
                \Storage::delete($trademark->logo);
                $trademark->delete();
            }
        } else
        {
            return back();
        }

        return back()->with(['success' => trans('admin.trademarkDeleted')]);
    }

}
