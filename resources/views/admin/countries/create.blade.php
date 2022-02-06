@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('countries') }}">
                    <i class="fa fa-undo"></i> رجوع للدول
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['route'=>'countries.store','files'=>true,'class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('country_name_ar',trans('admin.country_name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('country_name_ar',old('country_name_ar'),['class'=>'form-control','id'=>'country_name_ar','placeholder'=>'اسم الدوله']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('country_name_en',trans('admin.country_name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('country_name_en',old('country_name_en'),['class'=>'form-control','id'=>'country_name_en','placeholder'=>'Country Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('mob',trans('admin.mob'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('mob',old('mob'),['class'=>'form-control','id'=>'mob','placeholder'=>'Country Symbol']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('code',trans('admin.code'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('code',old('code'),['class'=>'form-control','id'=>'code','placeholder'=>'Code']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('logo',trans('admin.country_logo'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::file('logo',['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
