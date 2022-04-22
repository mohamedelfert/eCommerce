<div class="tab-pane fade" id="product_settings" role="tabpanel"
     aria-labelledby="product_settings-tab">
    <div class="tab-custom-content">

        <div class="row" style="margin-bottom: 20px">
            <div class="col">
                {!! Form::label('price',trans('admin.product_price'),['class'=>'col-sm-5 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('price',$product->price,
                    ['class'=>'form-control','id'=>'price','placeholder'=>trans('admin.product_price')]) !!}
                </div>
            </div>
            <div class="col">
                {!! Form::label('stock',trans('admin.stock'),['class'=>'col-sm-5 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('stock',$product->stock,
                    ['class'=>'form-control','id'=>'stock','placeholder'=>trans('admin.stock')]) !!}
                </div>
            </div>
            <div class="col">
                {!! Form::label('start_at',trans('admin.start_at'),['class'=>'col-sm-5 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('start_at',$product->start_at,
                    ['class'=>'form-control datepicker','id'=>'start_at','autocomplete'=>'off']) !!}
                </div>
            </div>
            <div class="col">
                {!! Form::label('end_at',trans('admin.end_at'),['class'=>'col-sm-5 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('end_at',$product->end_at,
                    ['class'=>'form-control datepicker','id'=>'end_at','autocomplete'=>'off']) !!}
                </div>
            </div>
        </div>

        <hr>

        <div class="row" style="margin-bottom: 20px">
            <div class="col">
                {!! Form::label('offer_price',trans('admin.offer_price'),['class'=>'col-sm-4 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('offer_price',$product->offer_price,
                    ['class'=>'form-control','id'=>'offer_price','placeholder'=>trans('admin.offer_price')]) !!}
                </div>
            </div>
            <div class="col">
                {!! Form::label('offer_start_at',trans('admin.offer_start_at'),['class'=>'col-sm-4 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('offer_start_at',$product->offer_start_at,
                    ['class'=>'form-control datepicker','id'=>'offer_start_at','autocomplete'=>'off']) !!}
                </div>
            </div>
            <div class="col">
                {!! Form::label('offer_end_at',trans('admin.offer_end_at'),['class'=>'col-sm-4 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('offer_end_at',$product->offer_end_at,
                    ['class'=>'form-control datepicker','id'=>'offer_end_at','autocomplete'=>'off']) !!}
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group row">
            {!! Form::label('status',trans('admin.product_status'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                {!! Form::select('status',
                ['pending'=>trans('admin.pending'),'refused'=>trans('admin.refused'), 'active'=>trans('admin.active')],
                $product->status,['class'=>'custom-select rounded-0 status',
                'id'=>'status']) !!}
            </div>
        </div>

        <div class="form-group row reason {{ $product->status != 'refused' ? 'd-none' : '' }}">
            {!! Form::label('reason',trans('admin.reason'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('reason',$product->reason,
                ['class'=>'form-control','id'=>'reason','placeholder'=>trans('admin.reason')]) !!}
            </div>
        </div>

    </div>
</div>
