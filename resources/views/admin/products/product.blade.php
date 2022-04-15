@extends('admin.index')
@section('content')

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"/>
    @endpush
    @push('js')
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
        <script type="text/javascript">
            $(".js-example-placeholder-multiple").select2({
                placeholder: "Select Status"
            });
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
            $(document).ready(function () {
                $('#dropzoneFileUpload').dropzone({
                    url: '{{ adminUrl('upload/image/'.$product->id) }}',
                    paramName: 'file',
                    uploadMultiple: false,
                    maxFiles: 15,
                    maxFilesize: 2, // MB
                    acceptedFiles: 'image/*',
                    dictDefaultMessage: '{{ trans('admin.dropzoneMessage') }}',
                    params: {
                        _token: '{{ csrf_token() }}'
                    }, init: function () {
                        @foreach($product->files()->get() as $file)
                        var mockFile = {
                            name: '{{ $file->name }}',
                            size: '{{ $file->size }}',
                            type: '{{ $file->mime_type }}'
                        };
                        // this.emit('addedfile', mockFile); OR
                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, '{{ url('storage/'. $file->full_file) }}');
                        @endforeach
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
                        <a class="nav-link" id="product_size_weight-tab" data-toggle="pill"
                           href="#product_size_weight" role="tab" aria-controls="product_size_weight"
                           aria-selected="false">{{ trans('admin.product_size_weight') }} <i
                                class="fas fa-pound-sign"></i> </a>
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
                    @include('admin.products.tabs.product_size_weight')
                    @include('admin.products.tabs.product_other_data')

                </div>

                <hr>

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

            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
