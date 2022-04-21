<div class="tab-pane fade" id="product_shipping_information" role="tabpanel"
     aria-labelledby="product_size_weight-tab">
    <div class="tab-custom-content">
        <div class="text-center" id="size_weight">
            <h3 class="text-danger" style="margin: 10px 0"> {{ trans('admin.select_department_message') }} </h3>
        </div>
        <hr>
        <div class="info_data d-none row" style="margin-top: 10px">
            <div class="col">
                {!! Form::label('color_id',trans('admin.color'),['class'=>'col-sm-6 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('color_id',App\Models\Color::pluck('name_'.session('lang'),'id'),$product->color_id,
                    ['class'=>'custom-select rounded-0','id'=>'color_id','placeholder'=>trans('admin.color')]) !!}
                </div>
            </div>
            <div class="col">
                {!! Form::label('trade_mark_id',trans('admin.trade_mark'),['class'=>'col-sm-6 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('trade_mark_id',App\Models\TradeMark::pluck('name_'.session('lang'),'id'),
                    $product->trade_mark_id,['class'=>'custom-select rounded-0','id'=>'trade_mark_id',
                    'placeholder'=>trans('admin.trade_mark')]) !!}
                </div>
            </div>
            <div class="col">
                {!! Form::label('manufacture_id',trans('admin.manufacture'),['class'=>'col-sm-6 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('manufacture_id',App\Models\Manufacturer::pluck('name_'.session('lang'),'id'),
                    $product->manufacture_id,['class'=>'custom-select rounded-0','id'=>'manufacture_id',
                    'placeholder'=>trans('admin.manufacture')]) !!}
                </div>
            </div>
        </div>
        <div class="form-group info_data d-none" style="margin-top: 10px">
            {!! Form::label('malls',trans('admin.malls'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-12">
                <select class="js-example-basic-multiple" id="malls" style="width: 100%" name="malls[]"
                        multiple="multiple">
                    @foreach(App\Models\Country::all() as $country)
                        <optgroup label="{{ $country->{'country_name_' . session('lang')} }}">
                            @foreach($country->malls()->get() as $mall)
                                <option value="{{ $mall->id }}">{{ $mall->{'name_' . session('lang')} }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
