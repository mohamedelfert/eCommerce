@extends('front.index')
@section('content')

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h1 class="alert alert-danger text-center">{!! setting()->message_maintenance !!}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
