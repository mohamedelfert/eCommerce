<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDatatable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ProductDatatable $product)
    {
        return $product->render('admin.products.index', ['title' => trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_product');
        return view('admin.products.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $validate_msg_ar = [
            'title.required' => trans('admin_validation.title_required'),
            'content.required' => trans('admin_validation.content_required'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['title'] = $request->title;
        $data['content'] = $request->content;

        Product::create($data);
        toastr()->success(trans('admin_validation.success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $title = trans('admin.edit_product');
        return view('admin.products.edit', compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|unique:products,title,' . $id,
            'content' => 'required|unique:products,content,' . $id,

        ];
        $validate_msg_ar = [
            'title.required' => trans('admin_validation.title_required'),
            'content.required' => trans('admin_validation.content_required'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $product = Product::findOrFail($id);
        $data['title'] = $request->title;
        $data['content'] = $request->content;

        $product->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                Product::find($id)->delete();
            }
        } else {
            Product::find($request->box)->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
