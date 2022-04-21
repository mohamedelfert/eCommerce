@extends('admin.index')
@section('content')

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"/>
        <style>
            .dz-image img {
                width: 100%;
                height: 100%;
                border-radius: 50%;
            }
        </style>
    @endpush
    @push('js')
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
        <script type="text/javascript">
            // for select with class (js-example-basic-multiple)
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2({
                    placeholder: '{{ trans('admin.select_mall') }}',
                    theme: "classic",
                    allowClear: true
                });
            });

            // for datepicker
            $(function () {
                $(".datepicker").datepicker({
                    rtl: '{{ session('lang') == 'ar' ? true : false }}',
                    language: '{{ session('lang') }}',
                    format: 'yyyy-mm-dd',
                    autoClose: true,
                    todayBtn: true,
                    clearBtn: true,
                });
            });

            // for reason textarea
            $(document).on('change', '.status', function () {
                let status = $('.status option:selected').val();
                if (status === 'refused') {
                    $('.reason').removeClass('d-none');
                } else {
                    $('.reason').addClass('d-none');
                }
            });

            // for dropzone
            Dropzone.autoDiscover = false;
            // Other Product Photos
            $(document).ready(function () {
                $('#dropzoneFileUpload').dropzone({
                    url: '{{ adminUrl('upload/image/'.$product->id) }}',
                    paramName: 'file',
                    uploadMultiple: false,
                    maxFiles: 15,
                    maxFilesize: 2, // MB
                    acceptedFiles: 'image/*',
                    dictDefaultMessage: '{{ trans('admin.dropzoneMessage') }}',
                    dictRemoveFile: '{{ trans('admin.dropzoneRemoveFile') }}',
                    addRemoveLinks: true,
                    params: {
                        _token: '{{ csrf_token() }}'
                    },
                    removedfile: function (file) {
                        $.ajax({
                            url: '{{ adminUrl('delete/image') }}',
                            dataType: 'json',
                            type: 'POST',
                            data: {_token: '{{ csrf_token() }}', id: file.fid}
                        })
                        var mock;
                        return (mock = file.previewElement) != null ? mock.parentNode.removeChild(file.previewElement) : void 0;
                    },
                    init: function () {
                        @foreach($product->files()->get() as $file)
                        var mockFile = {
                            name: '{{ $file->name }}',
                            size: '{{ $file->size }}',
                            type: '{{ $file->mime_type }}',
                            fid: '{{ $file->id }}'
                        };
                        // this.emit('addedfile', mockFile); OR
                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, '{{ url('storage/'. $file->full_path) }}');
                        this.emit('complete', mockFile);
                        @endforeach

                            this.on('sending', function (file, xhr, formData) {
                            formData.append('fid', '');
                            file.fid = '';
                        });

                        this.on('success', function (file, response) {
                            file.fid = response.id;
                        });
                    }
                });
            });

            // Main Product Photo
            $(document).ready(function () {
                $('#mainPhoto').dropzone({
                    url: '{{ adminUrl('upload/product/image/'.$product->id) }}',
                    paramName: 'file',
                    uploadMultiple: false,
                    maxFiles: 1,
                    maxFilesize: 3, // MB
                    acceptedFiles: 'image/*',
                    dictDefaultMessage: '{{ trans('admin.dropzoneMessage') }}',
                    dictRemoveFile: '{{ trans('admin.dropzoneRemoveFile') }}',
                    addRemoveLinks: true,
                    params: {
                        _token: '{{ csrf_token() }}'
                    },
                    removedfile: function (file) {
                        $.ajax({
                            url: '{{ adminUrl('delete/product/image/' . $product->id) }}',
                            dataType: 'json',
                            type: 'POST',
                            data: {_token: '{{ csrf_token() }}'}
                        })
                        var mock;
                        return (mock = file.previewElement) != null ? mock.parentNode.removeChild(file.previewElement) : void 0;
                    },
                    init: function () {
                        @if(!empty($product->photo))
                        var mockFile = {
                            name: '{{ $product->title }}',
                            size: '',
                            type: '',
                        };
                        // this.emit('addedfile', mockFile); OR
                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, '{{ url('storage/'. $product->photo) }}');
                        this.emit('complete', mockFile);
                        @endif

                            this.on('sending', function (file, xhr, formData) {
                            formData.append('fid', '');
                            file.fid = '';
                        });

                        this.on('success', function (file, response) {
                            file.fid = response.id;
                        });
                    }
                });
            });

            // for saving and continue button
            $(document).on('click', '.save_continue', function () {
                var data_form = $('#product_form').serialize();
                $.ajax({
                    url: '{{ adminUrl('products/'.$product->id) }}',
                    dataType: 'json',
                    data: data_form,
                    type: 'POST',
                    beforeSend: function () {
                        $('.loading_save_continue').removeClass('d-none');
                        $('.validate_messages').html('');
                        $('.errors_messages').addClass('d-none');
                    },
                    success: function () {
                        $('.loading_save_continue').addClass('d-none');
                        toastr.success('{{ trans('admin_validation.update') }}');
                    },
                    error: function (response) {
                        $('.loading_save_continue').addClass('d-none');
                        var errors_list = '';
                        $.each(response.responseJSON.errors, function (key, value) {
                            errors_list += '<li>' + value + '</li>'
                        });
                        $('.validate_messages').html(errors_list);
                        $('.errors_messages').removeClass('d-none');
                    }
                });
            });
        </script>
    @endpush

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('products') }}">
                    <i class="fa fa-undo"> رجوع للمنتجات </i>
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url'=>adminUrl('products'),'method'=>'PUT','files'=>true,'class'=>'form-horizontal' ,
            'id'=>'product_form']) !!}

            <div class="alert alert-danger errors_messages d-none">
                <ul class="validate_messages"></ul>
            </div>

            <div>
                <div style="margin-bottom: 15px;">
                    <a type="button" class="btn btn-info save" href="#">
                        <i class="fas fa-sd-card"> {{ trans('admin.save') }} </i>
                    </a>
                    <a type="button" class="btn btn-success save_continue" href="#">
                        <i class="fa fa-save"> {{ trans('admin.save_continue') }} </i>
                        <i class="fa fa-spinner fa-spin d-none loading_save_continue"></i>
                    </a>
                    <a type="button" class="btn btn-secondary product_copy" href="#">
                        <i class="fa fa-copy"> {{ trans('admin.product_copy') }} </i>
                    </a>
                    <a type="button" class="btn btn-danger delete" href="#">
                        <i class="fa fa-trash"> {{ trans('admin.delete') }} </i>
                    </a>
                </div>

                <hr>

                <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product_info-tab" data-toggle="pill"
                           href="#product_info" role="tab" aria-controls="product_info"
                           aria-selected="true">{{ trans('admin.product_info') }} <i class="fas fa-info"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="department-tab" data-toggle="pill"
                           href="#department" role="tab" aria-controls="department"
                           aria-selected="false">{{ trans('admin.department') }} <i class="fas fa-list"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_settings-tab" data-toggle="pill"
                           href="#product_settings" role="tab" aria-controls="product_settings"
                           aria-selected="false">{{ trans('admin.product_settings') }} <i class="fas fa-cog"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_media-tab" data-toggle="pill"
                           href="#product_media" role="tab" aria-controls="product_media"
                           aria-selected="false">{{ trans('admin.product_media') }} <i class="fas fa-photo-video"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_shipping_information-tab" data-toggle="pill"
                           href="#product_shipping_information" role="tab" aria-controls="product_shipping_information"
                           aria-selected="false">{{ trans('admin.product_shipping_information') }} <i
                                class="fas fa-shipping-fast"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product_other_data-tab" data-toggle="pill"
                           href="#product_other_data" role="tab" aria-controls="product_other_data"
                           aria-selected="false">{{ trans('admin.product_other_data') }} <i class="fas fa-database"></i>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="custom-content-above-tabContent">

                    @include('admin.products.tabs.product_info')
                    @include('admin.products.tabs.department')
                    @include('admin.products.tabs.product_settings')
                    @include('admin.products.tabs.product_media')
                    @include('admin.products.tabs.product_shipping_information')
                    @include('admin.products.tabs.product_other_data')

                </div>

                <hr>

                <div style="margin-bottom: 15px;">
                    <a type="button" class="btn btn-info save" href="#">
                        <i class="fas fa-sd-card"> {{ trans('admin.save') }} </i>
                    </a>
                    <a type="button" class="btn btn-success save_continue" href="#">
                        <i class="fa fa-save"> {{ trans('admin.save_continue') }} </i>
                        <i class="fa fa-spinner fa-spin d-none loading_save_continue"></i>
                    </a>
                    <a type="button" class="btn btn-secondary product_copy" href="#">
                        <i class="fa fa-copy"> {{ trans('admin.product_copy') }} </i>
                    </a>
                    <a type="button" class="btn btn-danger delete" href="#">
                        <i class="fa fa-trash"> {{ trans('admin.delete') }} </i>
                    </a>
                </div>

            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
