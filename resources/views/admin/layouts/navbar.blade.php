<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        @include('admin.layouts.menu')
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="{{ url('/design/admin') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ admin()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search ...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Main Navigation</li>
            <li class="{{ activeMenu(2, null, true)  }}">
                <a href="{{ aurl() }}">
                    <i class="fa fa-dashboard"></i> <span>@lang('admin.navbar.dashboard')</span>
                </a>
            </li>
            <li class="{{ activeMenu(2, 'settings', true)  }}">
                <a href="{{ route('admin.settings') }}">
                    <i class="fa fa-gears"></i> <span>@lang('admin.navbar.settings')</span>
                </a>
            </li>
            <li class="treeview {{ activeMenu(2, 'admins') }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('admin.navbar.admin') <small class="badge badge-error">3</small></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu(3, null, true) }}"><a href="{{ route('admins.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.admin_admins')</a></li>
                    <li class="{{ activeMenu(3, 'create', true)  }}"><a href="{{ route('admins.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.admin_create')</a></li>
                </ul>
            </li>
            <li class="treeview {{ activeMenu(2, 'users') }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('admin.navbar.user_control')</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu(3, null, true)  }}"><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.users')</a></li>
                    <li class="{{ activeMenu(3, 'create', true)  }}"><a href="{{ route('users.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.user_create')</a></li>
                    <li class=""><a href="{{ route('users.index')  }}?level=user"><i class="fa fa-circle-o"></i> @lang('admin.userLevel.user')</a></li>
                    <li class=""><a href="{{ route('users.index')  }}?level=vendor"><i class="fa fa-circle-o"></i> @lang('admin.userLevel.vendor')</a></li>
                    <li class=""><a href="{{ route('users.index')  }}?level=company"><i class="fa fa-circle-o"></i> @lang('admin.userLevel.company')</a></li>
                </ul>
            </li>
            <li class="treeview {{ activeMenu(2, 'countries') }}">
                <a href="#">
                    <i class="fa fa-flag"></i>
                    <span>@lang('admin.navbar.countries')</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu(3, null, true)  }}"><a href="{{ route('countries.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.countries')</a></li>
                    <li class="{{ activeMenu(3, 'create', true)  }}"><a href="{{ route('countries.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.country_create')</a></li>

                </ul>
            </li>
            <li class="treeview {{ activeMenu(2, 'cities') }}">
                <a href="#">
                    <i class="fa fa-flag"></i>
                    <span>@lang('admin.navbar.cities')</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu(3, null, true)  }}"><a href="{{ route('cities.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.cities')</a></li>
                    <li class="{{ activeMenu(3, 'create', true)  }}"><a href="{{ route('cities.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.city_create')</a></li>

                </ul>
            </li>
            <li class="treeview {{ activeMenu(2, 'states') }}">
                <a href="#">
                    <i class="fa fa-flag"></i>
                    <span>@lang('admin.navbar.states')</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ activeMenu(3, null, true)  }}"><a href="{{ route('states.index') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.states')</a></li>
                    <li class="{{ activeMenu(3, 'create', true)  }}"><a href="{{ route('states.create') }}"><i class="fa fa-circle-o"></i> @lang('admin.navbar.state_create')</a></li>

                </ul>
            </li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>