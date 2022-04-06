@extends('admin.index')
@section('content')

    @push('js')
        <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAAj9p6YXT73sbu32Mblo5RnCAM5FVhlw4'></script>
        <script src="{{ url('/design/admin/dist/js/locationpicker.jquery.js') }}"></script>
        @php
            $latitude = !empty($latitude) ? old($latitude) : '30.044482654784964';
            $longitude = !empty($longitude) ? old($longitude) : '31.23571348190307';
        @endphp
        <script>
            $('#us1').locationpicker({
                location: {
                    latitude: {{ $latitude }},
                    longitude: {{ $longitude }}
                },
                radius: 300,
                markerIcon: '{{url('/assets/images/map-marker-2-xl.png')}}',
                inputBinding: {
                    latitudeInput: $('#latitude'),
                    longitudeInput: $('#longitude'),
                    // radiusInput: $('#us2-radius'),
                    locationNameInput: $('#address')
                }
            });
        </script>
    @endpush

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('manufacturers') }}">
                    <i class="fa fa-undo"></i> رجوع للمصنعين
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['route'=>'manufacturers.store','files'=>true,'class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('name_ar',trans('admin.name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control','id'=>'name_ar','placeholder'=>'اسم المصنع']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name_en',trans('admin.name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control','id'=>'name_en','placeholder'=>'Factory Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name_en',trans('admin.contact_name'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('contact_name',old('contact_name'),['class'=>'form-control','id'=>'contact_name','placeholder'=>'اسم المسؤول عن المصنع']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('email',trans('admin.email'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::email('email',old('email'),['class'=>'form-control','id'=>'email','placeholder'=>'E-mail']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('phone',trans('admin.phone'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('phone',old('phone'),['class'=>'form-control','id'=>'phone','placeholder'=>'Phone']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address',trans('admin.address'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('address',old('address'),['class'=>'form-control','id'=>'address','placeholder'=>'Address']) !!}
                </div>
            </div>
            <div class="form-group row">
                <input type="hidden" name="latitude" id="latitude" value="{{ $latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ $longitude }}">
                <div id="us1" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="form-group row">
                {!! Form::label('facebook',trans('admin.facebook'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('facebook',old('facebook'),['class'=>'form-control','id'=>'facebook','placeholder'=>'Facebook URL']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('twitter',trans('admin.twitter'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('twitter',old('twitter'),['class'=>'form-control','id'=>'twitter','placeholder'=>'Twitter URL']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('website',trans('admin.website'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('website',old('website'),['class'=>'form-control','id'=>'website','placeholder'=>'Website URL']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('logo',trans('admin.manufacturer_logo'),['class'=>'col-sm-2 col-form-label']) !!}
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
