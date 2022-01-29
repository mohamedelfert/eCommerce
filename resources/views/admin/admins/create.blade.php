@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px" href="{{ adminUrl('admin') }}">
                    <i class="fa fa-undo"></i> رجوع للمشرفين
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['route'=>'admin.store','class'=>'form-horizontal']) !!}
                <div class="form-group row">
                    {!! Form::label('name',trans('admin.name'),['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name',old('name'),['class'=>'form-control','id'=>'name','placeholder'=>'Admin Name']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('email',trans('admin.email'),['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::email('email',old('email'),['class'=>'form-control','id'=>'email','placeholder'=>'Admin Email']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('password',trans('admin.password'),['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Password']) !!}
                    </div>
                </div>
                <div class="mb-3" style="margin-top: 5px">
                    {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
