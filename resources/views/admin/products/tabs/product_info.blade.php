<div class="tab-pane fade show active" id="product_info" role="tabpanel"
     aria-labelledby="product_info-tab">
    <div class="tab-custom-content">

        <div class="form-group row">
            {!! Form::label('product_title',trans('admin.product_title'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('product_title',$product->title,['class'=>'form-control','id'=>'product_title','placeholder'=>'Product Title']) !!}
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('product_content',trans('admin.product_content'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('product_content',$product->content,['class'=>'form-control','id'=>'product_content','placeholder'=>'Product Content']) !!}
            </div>
        </div>

    </div>
</div>
