@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px" href="{{ adminUrl('products') }}">
                    <i class="fa fa-undo"></i> رجوع للمنتجات
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url'=>adminUrl('products/'.$product->id),'files'=>true,'method'=>'PUT','class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('title',trans('admin.title'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('title',$product->title,['class'=>'form-control','id'=>'title','placeholder'=>'اسم المنتج']) !!}
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
