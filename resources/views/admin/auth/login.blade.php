@extends('admin.auth.layouts.form')

@section('title') @lang('admin.auth.login_title') @endsection



@section('content')

    @if(count($errors->all()))
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>

    @endif

    <p class="login-box-msg">Sign in to start your session</p>
    {!! Form::open([
        'route' => 'admin.login',
        'method' => 'POST'
    ]) !!}

    <div class="form-group has-feedback">
        {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required']) !!}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember" value="on" {{ old('remember') == 'on' ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            {!! Form::submit('Sign In', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
        </div>
        <!-- /.col -->
    </div>

    {!! Form::close() !!}

    <a href="{{ route('admin.password.forgot') }}">I forgot my password</a><br>


@endsection