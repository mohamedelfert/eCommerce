@extends('admin.index')
@section('content')
    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core": {
                        'data': {!! load_department($department->parent,$department->id) !!},
                        "themes": {
                            "variant": "large"
                        }
                    },
                    "checkbox": {
                        "keep_selected_style": false
                    },
                    "plugins": ["wholerow"]
                });
            });
            $('#jstree').on("changed.jstree", function (e, data){
                var i , j , r = [];
                for(i = 0, j = data.selected.length; i < j ; i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(', '));
            });
        </script>
    @endpush

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <div style="margin-bottom: 10px;">
                <a type="button" class="btn btn-primary btn-sm" style="margin-left: 15px"
                   href="{{ adminUrl('departments') }}">
                    <i class="fa fa-undo"></i> رجوع للأقسام
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url'=>adminUrl('departments/'.$department->id),'method'=>'PUT','files'=>true,'class'=>'form-horizontal']) !!}
            <div class="form-group row">
                {!! Form::label('department_name_ar',trans('admin.department_name_ar'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('department_name_ar',$department->department_name_ar,['class'=>'form-control','id'=>'department_name_ar','placeholder'=>'اسم القسم']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('department_name_en',trans('admin.department_name_en'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('department_name_en',$department->department_name_en,['class'=>'form-control','id'=>'department_name_en','placeholder'=>'Department Name']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('department_name_en',trans('admin.departments'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    <div id="jstree"></div>
                    <input type="hidden" name="parent" class="parent_id" value="{{old('parent')}}">
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('description',trans('admin.department_description'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('description',$department->description,['class'=>'form-control','id'=>'description','placeholder'=>'Description']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('keyword',trans('admin.department_keyword'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('keyword',$department->keyword,['class'=>'form-control','id'=>'keyword','placeholder'=>'Keyword']) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('icon',trans('admin.department_icon'),['class'=>'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::file('icon',['class'=>'form-control']) !!}
                </div>
                @if(!empty($department->icon))
                    <div class="col-sm-6">
                        <img class="img-fluid mb-3" src="{{ Storage::url($department->icon) }}" alt="logo" style="width: 90px;height: 80px;">
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
