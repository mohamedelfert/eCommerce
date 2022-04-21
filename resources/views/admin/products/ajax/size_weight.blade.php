<div class="row">
    <div class="col">
        {!! Form::label('size_id',trans('admin.size_id'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('size_id',$sizes,$product->size_id,['class'=>'custom-select rounded-0','id'=>'size_id',
            'placeholder'=>trans('admin.select_size')]) !!}
        </div>
    </div>
    <div class="col">
        {!! Form::label('size',trans('admin.size'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('size',$product->size,['class'=>'form-control','id'=>'size','placeholder'=>trans('admin.size')]) !!}
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col">
        {!! Form::label('weight_id',trans('admin.weight_id'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('weight_id',$weights,$product->weight_id,['class'=>'custom-select rounded-0','id'=>'weight_id',
            'placeholder'=>trans('admin.select_weight')]) !!}
        </div>
    </div>
    <div class="col">
        {!! Form::label('weight',trans('admin.weight'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('weight',$product->weight,['class'=>'form-control','id'=>'weight','placeholder'=>trans('admin.weight')]) !!}
        </div>
    </div>
</div>
