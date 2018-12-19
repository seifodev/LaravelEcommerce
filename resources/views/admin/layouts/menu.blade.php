<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i></a>
            <ul class="dropdown-menu" style="min-width: 100px;">
                <li class="{{ lang() == 'ar' ? 'active' : '' }}"><a class="text-center" href="{{ route('lang', 'ar') }}">عربي</a></li>
                <li class="{{ lang() == 'en' ? 'active' : '' }}"><a class="text-center" href="{{ route('lang', 'en') }}">English</a></li>
            </ul>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ url('/design/admin') }}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ admin()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ url('/design/admin') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                        {{ admin()->user()->name }} - Full Stack Web Developer
                        <small>Member since Nov. 2012</small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                    </div>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-right">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-left">
                        {!! Form::open([
                            'route' => 'admin.logout',
                            'method' => 'POST'
                        ]) !!}
                        {!! Form::submit('Sign Out', ['class' => 'btn btn-default btn-flat']) !!}
                        {!! Form::close() !!}
                    </div>
                </li>
            </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
    </ul>
</div>

