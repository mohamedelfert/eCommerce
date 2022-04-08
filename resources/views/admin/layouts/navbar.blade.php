<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ url('/') }}/design/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
         height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ adminUrl() }}" class="nav-link">{{ trans('admin.home') }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" data-widget="navbar-search" href="#" role="button">--}}
        {{--                <i class="fas fa-search"></i>--}}
        {{--            </a>--}}
        {{--            <div class="navbar-search-block">--}}
        {{--                <form class="form-inline">--}}
        {{--                    <div class="input-group input-group-sm">--}}
        {{--                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
        {{--                        <div class="input-group-append">--}}
        {{--                            <button class="btn btn-navbar" type="submit">--}}
        {{--                                <i class="fas fa-search"></i>--}}
        {{--                            </button>--}}
        {{--                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">--}}
        {{--                                <i class="fas fa-times"></i>--}}
        {{--                            </button>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </form>--}}
        {{--            </div>--}}
        {{--        </li>--}}

        @include('admin.layouts.menu')

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ adminUrl() }}" class="brand-link">
        <img src="{{ url('/') }}/design/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ trans('sidbar.brand') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('/') }}/design/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{admin()->user()->name}} <br> <small><i
                            class="fa fa-circle text-success"></i> Online</small></a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ adminUrl() }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('admin.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item {{ active_menu('admin')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ trans('admin.admins_accounts') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('admin')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('admin') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>{{ trans('admin.admins_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('user')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            {{ trans('user.users_accounts') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ active_menu('user')[1] }}">
                        <li class="nav-item">
                            <a href="{{ adminUrl('user') }}" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>{{ trans('user.users_list') }}</p>
                            </a>
                            <a href="{{ adminUrl('user') }}?level=user" class="nav-link">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>{{ trans('user.user') }}</p>
                            </a>
                            <a href="{{ adminUrl('user') }}?level=vendor" class="nav-link">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>{{ trans('user.vendor') }}</p>
                            </a>
                            <a href="{{ adminUrl('user') }}?level=company" class="nav-link">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>{{ trans('user.company') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('countries')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-flag"></i>
                        <p>
                            {{ trans('admin.countries') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('countries')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('countries') }}" class="nav-link">
                                <i class="nav-icon fas fa-flag-checkered"></i>
                                <p>{{ trans('admin.countries_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('cities')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            {{ trans('admin.cities') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('cities')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('cities') }}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>{{ trans('admin.cities_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('states')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            {{ trans('admin.states') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('states')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('states') }}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>{{ trans('admin.states_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('departments')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            {{ trans('admin.departments') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('departments')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('departments') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>{{ trans('admin.departments_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('trademarks')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>
                            {{ trans('admin.trademarks') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('trademarks')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('trademarks') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>{{ trans('admin.trademarks_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('manufacturers')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-industry"></i>
                        <p>
                            {{ trans('admin.manufacturers') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('manufacturers')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('manufacturers') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>{{ trans('admin.manufacturers_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('companies')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            {{ trans('admin.companies') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('companies')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('companies') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>{{ trans('admin.companies_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('malls')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            {{ trans('admin.malls') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('malls')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('malls') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>{{ trans('admin.malls_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('colors')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-paint-brush"></i>
                        <p>
                            {{ trans('admin.colors') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('colors')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('colors') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>{{ trans('admin.colors_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('sizes')[0] }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-adjust"></i>
                        <p>
                            {{ trans('admin.sizes') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" {{ active_menu('sizes')[1] }}>
                        <li class="nav-item">
                            <a href="{{ adminUrl('sizes') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-ol"></i>
                                <p>{{ trans('admin.sizes_list') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_menu('setting')[0] }}">
                    <a href="{{ adminUrl('setting') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>{{ trans('admin.settings') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
