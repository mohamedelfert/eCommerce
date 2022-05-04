@extends('admin.index')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ App\Models\Product::count() }}</h3>
                        <p>{{ trans('admin.products') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ adminUrl('products') }}" class="small-box-footer">{{ trans('admin.more_info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ App\Models\Department::count() }}</h3>
                        <p>{{ trans('admin.departments') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ adminUrl('departments') }}" class="small-box-footer">{{ trans('admin.more_info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ App\User::count() }}</h3>
                        <p>{{ trans('user.users') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ adminUrl('user') }}" class="small-box-footer">{{ trans('admin.more_info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ App\Models\TradeMark::count() }}</h3>
                        <p>{{ trans('admin.trademarks') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ adminUrl('trademarks') }}" class="small-box-footer">{{ trans('admin.more_info') }} <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-0">{{ trans('admin.statistics') }}</h4>
                            </div>
                        </div>
                        <div class="card-body" style="width:100%;">
                            {!! $chartjs->render() !!}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
