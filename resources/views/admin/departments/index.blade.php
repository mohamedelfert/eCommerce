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
                    "plugins": ["wholerow", "checkbox"]
                });
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
                <a class="btn btn-danger btn-sm" href="{{adminUrl('departments/destroy')}}">
                    <i class="fas fa-trash"></i> {{trans('admin.delete_department')}}
                </a>
                <a class="btn btn-danger btn-sm" href="{{adminUrl('departments/delete-all')}}">
                    <i class="fas fa-trash-alt"></i> {{trans('admin.delete_all_department')}}
                </a>
            </div>
            <hr>
            <div id="jstree"></div>
        </div>
    </div>

@endsection
