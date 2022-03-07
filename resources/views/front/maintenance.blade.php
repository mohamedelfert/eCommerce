@extends('front.index')
@section('content')

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product text-center text-danger">
                        <h1>We&rsquo;ll be back soon!</h1>
                        <div>
                            <p class="badge" style="font-size: 15px;background-color: #9e3a3a;padding: 5px">{!! setting()->message_maintenance !!}</p>
                            <p>&mdash; The Team</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
