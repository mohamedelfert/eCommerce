<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDatatable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
        $product = Product::create([
            'title' => '',
            'description' => '',
            'photo' => '',
            'size' => '',
            'weight' => '',
        ]);
        if (!empty($product)) {
            return redirect(adminUrl('products/' . $product->id . '/edit'));
        }
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
            'description' => 'required',
        ];
        $validate_msg_ar = [
            'title.required' => trans('admin_validation.title_required'),
            'description.required' => trans('admin_validation.description_required'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['title'] = $request->title;
        $data['description'] = $request->description;

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
        return view('admin.products.product',
            ['title' => trans('admin.create_or_edit_product', ['title' => $product->title]),
                'product' => $product]);
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
            'description' => 'required|unique:products,description,' . $id,

        ];
        $validate_msg_ar = [
            'title.required' => trans('admin_validation.title_required'),
            'description.required' => trans('admin_validation.description_required'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $product = Product::findOrFail($id);
        $data['title'] = $request->title;
        $data['description'] = $request->description;

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

    public function upload_main_photo($id)
    {
        $product = Product::find($id);
        if (request()->hasFile('file')) {
            $product->update([
                'photo' => upload_file()->upload([
                    'file' => 'file',
                    'path' => 'products/' . $id,
                    'upload_type' => 'single',
                    'delete_file' => Product::find($id)->photo,
                ])
            ]);
            return response(['status' => true, 'photo' => $product->photo], 200);
        }
    }

    public function delete_main_photo($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->photo);
        $product->update(['photo' => '']);
    }

    public function upload_file($id)
    {
        if (request()->hasFile('file')) {
            $file_id = upload_file()->upload([
                'file' => 'file',
                'path' => 'products/' . $id,
                'upload_type' => 'files',
                'file_type' => 'product',
                'relation_id' => $id,
            ]);
            return response(['status' => true, 'id' => $file_id], 200);
        }
    }

    public function delete_file(Request $request)
    {
        if (request()->has('id')) {
            upload_file()->delete($request->id);
        }
    }

    public function prepare_size_weight()
    {
        if (request()->ajax() and request()->has('dep_id')) {
            $sizes = Size::whereIn('department_id', explode(',', get_parent_department(request('dep_id'))))
                ->pluck('name_' . session('lang'), 'id');

//            $department_list = array_diff(explode(',', get_parent_department(request('dep_id'))), [request('dep_id')]);
//            $size_1 = Size::where('is_public', 'yes')
//                ->whereIn('department_id', $department_list)
//                ->pluck('name_' . session('lang'), 'id');
//            $size_2 = Size::where('department_id', request('dep_id'))
//                ->pluck('name_' . session('lang'), 'id');
//            $sizes = array_merge(json_decode($size_1, true), json_decode($size_2, true));

            $weights = Weight::pluck('name_' . session('lang'), 'id');
            return view('admin.products.ajax.size_weight', compact('sizes', 'weights'))->render();
        }
    }
}
