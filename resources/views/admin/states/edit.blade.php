@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('states') }}">
                    <i class="fa fa-undo"></i> رجوع للمناطق / الأحياء
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url'=>adminUrl('states/'.$state->id),'method'=>'PUT','class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('state_name_ar',trans('admin.state_name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('state_name_ar',$state->state_name_ar,['class'=>'form-control','id'=>'state_name_ar','placeholder'=>'اسم المنطقة / الحي']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('state_name_en',trans('admin.state_name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('state_name_en',$state->state_name_en,['class'=>'form-control','id'=>'state_name_en','placeholder'=>'State Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('country_id',trans('admin.country_id'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('country_id',App\Models\Country::pluck('country_name_'.session('lang'),'id'),$state->country_id,
                                    ['class'=>'custom-select rounded-0 country_id','placeholder'=>'Select Country']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('city_id',trans('admin.city_id'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10 city_id">
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function() {
            @if($state->country_id)
            $.ajax({
                url: "{{ adminUrl('states/create') }}",
                type: "GET",
                dataType: "html",
                data: {country_id:'{{$state->country_id}}',select:'{{$state->city_id}}'},
                success: function(data) {
                    $('.city_id').html(data);
                }
            });
            @endif
            $(document).on('change','.country_id', function() {
                var country_id = $('.country_id option:selected').val();
                if (country_id) {
                    $.ajax({
                        url: "{{ adminUrl('states/create') }}",
                        type: "GET",
                        dataType: "html",
                        data: {country_id:country_id,select:''},
                        success: function(data) {
                            $('.city_id').html(data);
                        }
                    });
                } else {
                    $('.city_id').html('');
                }
            });
        });
    </script>
@endpush
