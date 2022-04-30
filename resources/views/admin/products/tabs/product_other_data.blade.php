@push('js')
    <script type="text/javascript">
        var x = 1;
        $(document).on('click', '.add_input', function () {
            var max_inputs = 10;
            if (x < max_inputs) {
                $('.div_inputs').append('<div class="row">' +
                    '<div class="col">' +
                    '{!! Form::label('input_key',trans('admin.input_key'),['class'=>'col-sm-6 col-form-label']) !!}' +
                    '<div class="col-sm-10">' +
                    '{!! Form::text('input_key[]','',['class'=>'form-control']) !!}' +
                    '</div>' +
                    '</div>' +
                    '<div class="col">' +
                    '{!! Form::label('input_value',trans('admin.input_value'),['class'=>'col-sm-6 col-form-label']) !!}' +
                    '<div class="col-sm-10">' +
                    '{!! Form::text('input_value[]','',['class'=>'form-control']) !!}' +
                    '</div>' +
                    '</div>' +
                    '<a href="#" class="btn btn-danger remove_input" style="margin-top: 35px;"><i class="fa fa-trash"></i></a>' +
                    '</div>');
                x++;
            }
            return false;
        });
        $(document).on('click', '.remove_input', function () {
            $(this).parent('div').remove();
            x--;
            return false;
        });
    </script>
@endpush

<div class="tab-pane fade" id="product_other_data" role="tabpanel"
     aria-labelledby="product_other_data-tab">
    <div class="tab-custom-content">
        <div class="div_inputs" style="margin-bottom: 20px">
            @foreach($product->others_data()->get() as $others)
                <div class="row">
                    <div class="col">
                        {!! Form::label('input_key',trans('admin.input_key'),['class'=>'col-sm-6 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('input_key[]',$others->data_key,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        {!! Form::label('input_value',trans('admin.input_value'),['class'=>'col-sm-6 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('input_value[]',$others->data_value,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <a href="#" class="btn btn-danger remove_input" style="margin-top: 35px;">
                        <i class="fa fa-trash"></i></a>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="col" style="margin-top: 10px;">
            <a href="#" class="btn btn-primary add_input"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>
