@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '#do_search', function () {
                var search = $('.search').val();
                if (search !== '' || search !== null) {
                    $.ajax({
                        url: '{{ adminUrl('products/search') }}',
                        dataType: 'json',
                        type: 'post',
                        data: {_token: '{{ csrf_token() }}', search: search, product_id: '{{ $product->id }}'},
                        beforeSend: function () {
                            $('.loading_search').removeClass('d-none');
                        },
                        success: function (data) {
                            if (data.status == true) {
                                if (data.total > 0) {
                                    var items = '';
                                    $.each(data.results, function (key, value) {
                                        items += '<li><lable>' +
                                            '<input type="checkbox" name="related[]" value="' + value.id + '">'
                                            + value.title + '</lable></li>'; // or
                                        {{--if (value.id !== {{ $product->id }}) {--}}
                                        {{--    items += '<li>' + value.title + '</li>';--}}
                                        {{--}--}}
                                    });
                                    $('.products').html(items);
                                }
                                $('.loading_search').addClass('d-none');
                            }
                        },
                        error: function (data) {

                        }
                    });
                }
            });
        });
    </script>
@endpush

<div class="tab-pane fade" id="related_product" role="tabpanel"
     aria-labelledby="product_other_data-tab">
    <div class="tab-custom-content">
        <div class="div_inputs" style="margin-bottom: 20px">
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar search" name="search" type="search"
                           placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <div class="btn btn-navbar">
                            <i class="fas fa-search" id="do_search"></i>
                            <i class="fa fa-spinner fa-spin d-none loading_search"></i>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 15px">
                <ol class="products"></ol>
                <ol>
                    @foreach($product->related()->get() as $related)
                        <li>
                            <lable>
                                <input type="checkbox" checked name="related[]" value="{{ $related->related_product }}">
                                {{ $related->product->title }}
                            </lable>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
