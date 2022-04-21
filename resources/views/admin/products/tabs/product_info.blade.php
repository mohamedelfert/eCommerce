<div class="tab-pane fade show active" id="product_info" role="tabpanel"
     aria-labelledby="product_info-tab">
    <div class="tab-custom-content">

        <div class="form-group row">
            {!! Form::label('title',trans('admin.product_title'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('title',$product->title,['class'=>'form-control','id'=>'title',
                'placeholder'=>trans('admin.product_title')]) !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('description',trans('admin.product_description'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('description',$product->description,['class'=>'form-control','id'=>'description',
                'placeholder'=>trans('admin.product_description')]) !!}
            </div>
        </div>

    </div>
</div>
