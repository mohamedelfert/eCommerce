@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px" href="{{ adminUrl('trademarks') }}">
                    <i class="fa fa-undo"></i> رجوع للعلامات التجارية
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url'=>adminUrl('trademarks/'.$trade_mark->id),'files'=>true,'method'=>'PUT','class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('name_ar',trans('admin.name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_ar',$trade_mark->name_ar,['class'=>'form-control','id'=>'name_ar','placeholder'=>'اسم العلامة التجارية']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name_en',trans('admin.name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_en',$trade_mark->name_en,['class'=>'form-control','id'=>'name_en','placeholder'=>'Trade Mark Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('logo',trans('admin.trade_mark_logo'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::file('logo',['class'=>'form-control']) !!}
                </div>
                @if(!empty($trade_mark->logo))
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="{{ Storage::url($trade_mark->logo) }}" alt="logo" style="width: 90px;height: 80px;">
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
