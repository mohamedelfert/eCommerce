@extends('admin.index')
@section('content')
    @push('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#jstree').jstree({
                    "core": {
                        'data': [
                            {"id": "ajson1", "parent": "#", "text": "Node 1"},
                            {"id": "ajson2", "parent": "#", "text": "Node 2"},
                            {"id": "ajson3", "parent": "ajson2", "text": "Child 1"},
                            {"id": "ajson4", "parent": "ajson2", "text": "Child 2"},
                            {"id": "ajson5", "parent": "#", "text": "Node 3"},
                            {"id": "ajson6", "parent": "ajson5", "text": "Child 1"},
                            {"id": "ajson7", "parent": "ajson5", "text": "Child 2"},
                            {"id": "ajson8", "parent": "ajson5", "text": "Child 3"},
                        ],
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
            <div id="jstree"></div>
        </div>
    </div>

@endsection
