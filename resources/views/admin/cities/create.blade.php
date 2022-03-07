@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('cities') }}">
                    <i class="fa fa-undo"></i> رجوع للمدن
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['route'=>'cities.store','class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('city_name_ar',trans('admin.city_name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('city_name_ar',old('city_name_ar'),['class'=>'form-control','id'=>'city_name_ar','placeholder'=>'اسم المدينة']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('city_name_en',trans('admin.city_name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('city_name_en',old('city_name_en'),['class'=>'form-control','id'=>'city_name_en','placeholder'=>'City Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('country_id',trans('admin.country_id'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('country_id',App\Models\Country::pluck('country_name_'.session('lang'),'id'),
                        old('country_id'),['class'=>'custom-select rounded-0','placeholder'=>'Select Country']) !!}
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
