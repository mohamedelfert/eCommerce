@extends('admin.index')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {!! Form::open(['url' => adminUrl('user/destroy/all'),'id'=>'data_form','method'=>'DELETE']) !!}
            {!! $dataTable->table(['class' => 'dataTable table table-striped table-bordered table-hover'],true) !!}
            {!! Form::close() !!}
        </div>
    </div>


    <!-- This Is For Delete Checked boxes -->
    <div class="modal fade" id="delete_all">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ trans('user.delete') }}</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="empty_record d-none">
                        <h5 class="text-danger">{{trans('user.select_items')}} <span class="record_count"></span></h5>
                    </div>
                    <div class="not_empty_record d-none">
                        <h5 class="text-danger">{{trans('user.delete_item')}} <span class="record_count"></span></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="empty_record d-none">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('user.cancel')}}</button>
                    </div>
                    <div class="not_empty_record d-none">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('user.cancel')}}</button>
                        <button type="submit" class="btn btn-danger del_all">{{trans('user.confirm')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- This Is For Delete Checked boxes -->

    @push('js')
        <script>
            delete_all();
        </script>
        {!! $dataTable->scripts() !!}
    @endpush

@endsection
