@extends('admin.index')
@section('content')
    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core": {
                        'data': {!! load_department(old('parent')) !!},
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
                var name = [];
                for(i = 0, j = data.selected.length; i < j ; i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                    name.push(data.instance.get_node(data.selected[i]).text);
                }
                $('#form_delete_department').attr('action','{{adminUrl('departments')}}/'+r.join(', '));
                $('#department_name').text(name.join(', '));
                if(r.join(', ') !== ''){
                    $('.show_btn_control').removeClass('invisible');
                    $('.edit_department').attr('href','{{adminUrl('departments')}}/'+r.join(', ')+'/edit');
                }else{
                    $('.show_btn_control').add('invisible');
                }
            });
        </script>
    @endpush

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div style="margin-bottom: 10px;">
                <a class="btn btn-primary btn-sm" href="{{adminUrl('departments/create')}}">
                    <i class="fas fa-plus"></i> {{trans('admin.new_department')}}
                </a>
                <a class="btn btn-warning btn-sm edit_department show_btn_control invisible" href="">
                    <i class="fas fa-edit"></i> {{trans('admin.edit_department')}}
                </a>
                <a class="btn btn-danger btn-sm delete_department show_btn_control invisible"
                   data-effect="effect-scale" data-toggle="modal" data-target="#del_department">
                    <i class="fas fa-trash"></i> {{trans('admin.delete_department')}}
                </a>
            </div>
            <hr>
            <div id="jstree"></div>
        </div>
    </div>

    <!-- This Is For Delete  -->
    <div class="modal fade" id="del_department">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                {!! Form::open(['url' => '','method'=>'DELETE','id'=>'form_delete_department']) !!}
                <div class="modal-header">
                    <h6 class="modal-title">{{ trans('admin.delete') }}</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-danger">{{ trans('admin.delete_message') }}</h4><br>
                    <div class="form-group row">
                        {!! Form::label('department_name_'.session('lang'),trans('admin.department_name_'.session('lang')),['class'=>'col-sm-5 col-form-label']) !!}
                        <div class="col-sm-6">
                            <span id="department_name" class="form-control"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.cancel')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('admin.delete')}}</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- This Is For Delete -->


@endsection
