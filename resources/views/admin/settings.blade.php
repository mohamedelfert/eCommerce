@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url'=>adminUrl('setting'),'files'=>true,'class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('sitename_ar',trans('admin.sitename_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('sitename_ar',setting()->sitename_ar,['class'=>'form-control','id'=>'sitename_ar','placeholder'=>'Site Name Arabic']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('sitename_en',trans('admin.sitename_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('sitename_en',setting()->sitename_en,['class'=>'form-control','id'=>'sitename_en','placeholder'=>'Site Name English']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('email',trans('admin.email'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::email('email',setting()->email,['class'=>'form-control','id'=>'email','placeholder'=>'Email']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('logo',trans('admin.logo'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::file('logo',['class'=>'form-control']) !!}
                </div>
                @if(!empty(setting()->logo))
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="{{ Storage::url(setting()->logo) }}" alt="logo" style="width: 150px;height: 100px;">
                    </div>
                @endif
            </div>
            <div class="form-group row">
                {!! Form::label('icon',trans('admin.icon'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::file('icon',['class'=>'form-control']) !!}
                </div>
                @if(!empty(setting()->icon))
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="{{ Storage::url(setting()->icon) }}" alt="icon" style="width: 100px;height: 80px;">
                    </div>
                @endif
            </div>
            <div class="form-group row">
                {!! Form::label('description',trans('admin.description'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('description',setting()->description,['class'=>'form-control','rows'=>'5']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('keywords',trans('admin.keywords'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('keywords',setting()->keywords,['class'=>'form-control','rows'=>'5']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('main_lang',trans('admin.main_lang'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('main_lang',['ar' => trans('admin.ar'), 'en' => trans('admin.en')],
                        setting()->main_lang,['class'=>'custom-select rounded-0','placeholder'=>'اختر اللغه']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('status',trans('admin.status'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('status',['open' => trans('admin.open'), 'close' => trans('admin.close')],
                        setting()->status,['class'=>'custom-select rounded-0','placeholder'=>'اختر الحاله']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('message_maintenance',trans('admin.message_maintenance'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('message_maintenance',setting()->message_maintenance,['class'=>'form-control','rows'=>'5']) !!}
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.update'),['class'=>'btn btn-block bg-gradient-primary btn-lg','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
