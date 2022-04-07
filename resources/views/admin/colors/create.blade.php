@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('colors') }}">
                    <i class="fa fa-undo"></i> رجوع للألوان
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['route'=>'colors.store','files'=>true,'class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('name_ar',trans('admin.name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control','id'=>'name_ar','placeholder'=>'اسم اللون']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name_en',trans('admin.name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control','id'=>'name_en','placeholder'=>'Color Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('color',trans('admin.color'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::color('color',old('color'),['class'=>'form-control','id'=>'color','placeholder'=>'اللون']) !!}
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
