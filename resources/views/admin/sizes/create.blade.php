@extends('admin.index')
@section('content')

    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core": {
                        'data': {!! load_department(old('department_id')) !!},
                        "themes": {
                            "variant": "large"
                        }
                    },
                    "checkbox": {
                        "keep_selected_style": true
                    },
                    "plugins": ["wholerow"]
                });
            });
            $('#jstree').on("changed.jstree", function (e, data){
                var i , j , r = [];
                for(i = 0, j = data.selected.length; i < j ; i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                if(r.join(', ') !== ''){
                    $('.department_id').val(r.join(', '));
                }
            });
        </script>
    @endpush

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('sizes') }}">
                    <i class="fa fa-undo"></i> رجوع للقياسات
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['route'=>'sizes.store','files'=>true,'class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('name_ar',trans('admin.name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control','id'=>'name_ar','placeholder'=>'اسم القياس']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('name_en',trans('admin.name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control','id'=>'name_en','placeholder'=>'Size Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('department_id',trans('admin.departments'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    <div id="jstree"></div>
                    <input type="hidden" name="department_id" class="department_id" value="{{ old('department_id') }}">
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('is_public',trans('admin.is_public'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('is_public',['yes'=>trans('admin.yes'),'no'=>trans('admin.no')],old('is_public'),['class'=>'custom-select rounded-0','placeholder'=>'Select ...']) !!}
                </div>
            </div>
            <div class="mb-3" style="margin-top: 5px">
                {!! Form::submit(trans('admin.confirm'),['class'=>'btn btn-primary mb-3','id'=>'send']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
