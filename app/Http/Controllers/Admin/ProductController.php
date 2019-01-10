<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductDataTable;
use App\Model\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductDataTable $product
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $product)
    {
        //
        return $product->render('admin.products.index', ['title' => trans('admin.productsTitle')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        $title = trans('admin.createProduct');
//        return view('admin.products.create', compact('title'));

        $product = Product::create([
            'title' => ''
        ]);

        if(!empty($product)) return redirect()->route('products.edit', $product->id);

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
            'product' => 'required',
        ], [], [
            'name_ar' => trans('admin.form.product_ar'),
            'name_en' => trans('admin.form.product_en'),
            'product' => trans('admin.form.product'),
        ]);


        $product = Product::create($data);
        return redirect()->route('products.index')->with(['success' => trans('admin.productCreated')]);
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
        $product = Product::findOrFail($id);
        $title = !empty($product->title) ? $product->title : trans('admin.form.product_new');
        return view('admin.products.product', compact('product', 'title'));
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
            'product' => 'required',
        ], [], [
            'name_ar' => trans('admin.form.product_ar'),
            'name_en' => trans('admin.form.product_en'),
            'product' => trans('admin.form.product'),
        ]);

        $product = Product::findOrFail($id);

        $product->update($data);;

        return back()->with(['success' => trans('admin.productUpdated')]);

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

        Product::destroy($request->input('check'));
        return back()->with(['success' => trans('admin.productDeleted')]);
    }


    public function upload(Product $product, Request $request)
    {

        return up()->upload($request, [
            'file' => 'file',
            'path' => 'products/' . $product->id,
            'model' => $product
        ], true)->pluck('id')->all();
    }

    public function deleteFile(File $file)
    {
        \Storage::delete($file->full_file);
        $file->delete();
    }

}
