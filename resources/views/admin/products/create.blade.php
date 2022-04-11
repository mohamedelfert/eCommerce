@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('products') }}">
                    <i class="fa fa-undo"></i> رجوع للمنتجات
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['route'=>'products.store','files'=>true,'class'=>'form-horizontal']) !!}

            <div>
                <div style="margin-bottom: 15px;">
                    <a type="button" class="btn btn-info" href="#">
                        <i class="fas fa-sd-card"> {{ trans('admin.save') }} </i>
                    </a>
                    <a type="button" class="btn btn-success" href="#">
                        <i class="fa fa-save"> {{ trans('admin.save_continue') }} </i>
                    </a>
                    <a type="button" class="btn btn-secondary" href="#">
                        <i class="fa fa-copy"> {{ trans('admin.product_copy') }} </i>
                    </a>
                    <a type="button" class="btn btn-danger" href="#">
                        <i class="fa fa-trash"> {{ trans('admin.delete') }} </i>
                    </a>
                </div>
                <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product_info-tab" data-toggle="pill"
                           href="#product_info" role="tab" aria-controls="product_info"
                           aria-selected="true">{{ trans('admin.product_info') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="departments-tab" data-toggle="pill"
                           href="#departments" role="tab" aria-controls="departments"
                           aria-selected="false">{{ trans('admin.departments') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_settings-tab" data-toggle="pill"
                           href="#product_settings" role="tab" aria-controls="product_settings"
                           aria-selected="false">{{ trans('admin.product_settings') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_media-tab" data-toggle="pill"
                           href="#product_media" role="tab"
                           aria-controls="product_media" aria-selected="false">{{ trans('admin.product_media') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_size_weight-tab" data-toggle="pill"
                           href="#product_size_weight" role="tab"
                           aria-controls="product_size_weight"
                           aria-selected="false">{{ trans('admin.product_size_weight') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_other_data-tab" data-toggle="pill"
                           href="#product_other_data" role="tab"
                           aria-controls="product_other_data"
                           aria-selected="false">{{ trans('admin.product_other_data') }}</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-above-tabContent">
                    <div class="tab-pane fade show active" id="product_info" role="tabpanel"
                         aria-labelledby="product_info-tab">
                        <div class="tab-custom-content">
                            <p class="lead mb-0">{{ trans('admin.product_info') }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="departments" role="tabpanel"
                         aria-labelledby="departments-tab">
                        <div class="tab-custom-content">
                            <p class="lead mb-0">{{ trans('admin.departments') }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product_settings" role="tabpanel"
                         aria-labelledby="product_settings-tab">
                        <div class="tab-custom-content">
                            <p class="lead mb-0">{{ trans('admin.product_settings') }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product_media" role="tabpanel"
                         aria-labelledby="product_media-tab">
                        <div class="tab-custom-content">
                            <p class="lead mb-0">{{ trans('admin.product_media') }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product_size_weight" role="tabpanel"
                         aria-labelledby="product_size_weight-tab">
                        <div class="tab-custom-content">
                            <p class="lead mb-0">{{ trans('admin.product_size_weight') }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product_other_data" role="tabpanel"
                         aria-labelledby="product_other_data-tab">
                        <div class="tab-custom-content">
                            <p class="lead mb-0">{{ trans('admin.product_other_data') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row" style="margin-top: 25px">
                {!! Form::label('title',trans('admin.product_title'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('title',old('title'),['class'=>'form-control','id'=>'title','placeholder'=>'اسم المنتج']) !!}
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
