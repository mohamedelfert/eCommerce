@extends('admin.index')
@section('content')

    @push('js')
        <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAAj9p6YXT73sbu32Mblo5RnCAM5FVhlw4'></script>
        <script src="{{ url('/design/admin/dist/js/locationpicker.jquery.js') }}"></script>
        @php
            $latitude = !empty($mall->latitude) ? $mall->latitude : '30.044482654784964';
            $longitude = !empty($mall->longitude) ? $mall->longitude : '31.23571348190307';
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
                },
                enableAutocomplete:true
            });
        </script>
    @endpush

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px" href="{{ adminUrl('malls') }}">
                    <i class="fa fa-undo"></i> رجوع للمولات
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url'=>adminUrl('malls/'.$mall->id),'files'=>true,'method'=>'PUT','class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('name_ar',trans('admin.name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_ar',$mall->name_ar,['class'=>'form-control','id'=>'name_ar','placeholder'=>'اسم المول']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name_en',trans('admin.name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_en',$mall->name_en,['class'=>'form-control','id'=>'name_en','placeholder'=>'Mall Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('contact_name',trans('admin.contact_name'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('contact_name',$mall->contact_name,['class'=>'form-control','id'=>'contact_name','placeholder'=>'اسم المسؤول عن المول']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('email',trans('admin.email'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::email('email',$mall->email,['class'=>'form-control','id'=>'email','placeholder'=>'E-mail']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('phone',trans('admin.phone'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('phone',$mall->phone,['class'=>'form-control','id'=>'phone','placeholder'=>'Phone']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('address',trans('admin.address'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('address',$mall->address,['class'=>'form-control','id'=>'address','placeholder'=>'Address']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('country_id',trans('admin.country_id'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('country_id',App\Models\Country::pluck('country_name_'.session('lang'),'id'),
                        $mall->country_id,['class'=>'custom-select rounded-0','placeholder'=>'Select Country']) !!}
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
                    {!! Form::text('facebook',$mall->facebook,['class'=>'form-control','id'=>'facebook','placeholder'=>'Facebook URL']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('twitter',trans('admin.twitter'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('twitter',$mall->twitter,['class'=>'form-control','id'=>'twitter','placeholder'=>'Twitter URL']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('website',trans('admin.website'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('website',$mall->website,['class'=>'form-control','id'=>'website','placeholder'=>'Website URL']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('logo',trans('admin.mall_logo'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::file('logo',['class'=>'form-control']) !!}
                </div>
                @if(!empty($mall->logo))
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="{{ Storage::url($mall->logo) }}" alt="logo" style="width: 90px;height: 80px;">
                    </div>
                @endif
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
