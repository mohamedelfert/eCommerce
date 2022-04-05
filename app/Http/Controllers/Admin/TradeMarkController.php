<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TradeMarkDatatable;
use App\Http\Controllers\Controller;
use App\Models\TradeMark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class TradeMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(TradeMarkDatatable $trade_mark)
    {
        return $trade_mark->render('admin.trademarks.index', ['title' => trans('admin.trademarks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = trans('admin.new_trade_mark');
        return view('admin.trademarks.create', compact('title'));
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'logo' => 'required|' . validate_image(),
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar'),
            'name_en.required' => trans('admin_validation.name_en'),
            'logo.required' => trans('admin_validation.logo_required'),
            'logo.image' => trans('admin_validation.logo_type'),
            'logo.mimes' => trans('admin_validation.logo_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        TradeMark::create($data);
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
        $trade_mark = TradeMark::findOrFail($id);
        $title = trans('admin.edit_trade_mark');
        return view('admin.trademarks.edit', compact('title', 'trade_mark'));
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'logo' => 'required|sometimes|nullable|' . validate_image(),
        ];
        $validate_msg_ar = [
            'name_ar.required' => trans('admin_validation.name_ar'),
            'name_en.required' => trans('admin_validation.name_en'),
            'logo.required' => trans('admin_validation.logo_required'),
            'logo.image' => trans('admin_validation.logo_type'),
            'logo.mimes' => trans('admin_validation.logo_exe'),
        ];
        $data = $this->validate($request, $rules, $validate_msg_ar);

        $trade_mark = TradeMark::findOrFail($id);
        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;
        if ($request->hasFile('logo')) {
            $data['logo'] = upload_file()->upload([
                'file' => 'logo',
                'path' => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => TradeMark::find($id)->logo,
            ]);
        }

        $trade_mark->update($data);
        toastr()->success(trans('admin_validation.update'));
        return redirect(adminUrl('trademarks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $trade_mark = TradeMark::findOrFail($id);
        Storage::delete($trade_mark->logo);
        $trade_mark->delete();
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request)
    {
        if (is_array($request->box)) {
            foreach ($request->box as $id) {
                $trade_mark = TradeMark::find($id);
                Storage::delete($trade_mark->logo);
                $trade_mark->delete();
            }
        } else {
            $trade_mark = TradeMark::find($request->box);
            Storage::delete($trade_mark->logo);
            $trade_mark->delete();
        }
        toastr()->error(trans('admin_validation.delete'));
        return redirect()->back();
    }
}
