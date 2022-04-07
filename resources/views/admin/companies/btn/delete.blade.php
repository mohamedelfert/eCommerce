<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
   data-toggle="modal" href="#del_company{{ $id }}" title="حذف"><i class="fa fa-trash"></i>
</a>

<!-- This Is For Delete User -->
<div class="modal fade" id="del_company{{ $id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            {!! Form::open(['url' => adminUrl('companies/'.$id),'method'=>'DELETE']) !!}
                <div class="modal-header">
                    <h6 class="modal-title">{{ trans('admin.delete') }}</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-danger">{{ trans('admin.delete_message') }}</h4><br>
                    <div class="form-group row">
                        {!! Form::label('name_ar',trans('admin.name_ar'),['class'=>'col-sm-5 col-form-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('name_ar',session('lang') == 'ar' ? $name_ar : $name_en,['class'=>'form-control','id'=>'name_ar','readonly']) !!}
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
<!-- This Is For Delete User -->
