@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#jstree').jstree({
                "core": {
                    'data': {!! load_department($product->department_id) !!},
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
            for(i = 0, j = data.selected.length; i < j ; i++){
                r.push(data.instance.get_node(data.selected[i]).id);
            }
            if(r.join(', ') !== ''){
                $('.department_id').val(r.join(', '));
            }
        });
    </script>
@endpush

<div class="tab-pane fade" id="department" role="tabpanel"
     aria-labelledby="department-tab">
    <div class="tab-custom-content">

        <div class="form-group row">
            {!! Form::label('department_id',trans('admin.department'),['class'=>'col-sm-2 col-form-label']) !!}
            <div class="col-sm-10">
                <div id="jstree"></div>
                <input type="hidden" name="department_id" class="department_id" value="{{ $product->department_id }}">
            </div>
        </div>

    </div>
</div>
