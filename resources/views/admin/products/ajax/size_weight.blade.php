<div class="row">
    <div class="col">
        {!! Form::label('size_id',trans('admin.size_id'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('size_id',$sizes,'',['class'=>'custom-select rounded-0','id'=>'size_id',
            'placeholder'=>'Select Size']) !!}
        </div>
    </div>
    <div class="col">
        {!! Form::label('size',trans('admin.size'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('size','',['class'=>'form-control','id'=>'size','placeholder'=>'Size']) !!}
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col">
        {!! Form::label('weight_id',trans('admin.weight_id'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('weight_id',$weights,'',['class'=>'custom-select rounded-0','id'=>'weight_id',
            'placeholder'=>'Select Weight']) !!}
        </div>
    </div>
    <div class="col">
        {!! Form::label('weight',trans('admin.weight'),['class'=>'col-sm-6 col-form-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('weight','',['class'=>'form-control','id'=>'weight','placeholder'=>'Weight']) !!}
        </div>
    </div>
</div>
