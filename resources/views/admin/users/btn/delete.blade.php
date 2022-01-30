<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
   data-toggle="modal" href="#del_user{{ $id }}" title="حذف"><i class="fa fa-trash"></i>
</a>

<!-- This Is For Delete User -->
<div class="modal fade" id="del_user{{ $id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            {!! Form::open(['url' => adminUrl('user/'.$id),'method'=>'DELETE']) !!}
                <div class="modal-header">
                    <h6 class="modal-title">{{ trans('user.delete') }}</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-danger">{{ trans('user.delete_message') }}</h4><br>
                    <div class="form-group row">
                        {!! Form::label('name',trans('user.name'),['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name',$name,['class'=>'form-control','id'=>'name','readonly']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('user.cancel')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('user.delete')}}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- This Is For Delete User -->
