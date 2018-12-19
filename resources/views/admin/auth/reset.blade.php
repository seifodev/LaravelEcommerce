@extends('admin.auth.layouts.form')

@section('title') @lang('admin.auth.forgot_title') @endsection



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


    <p class="login-box-msg">Reset your password</p>

    {!! Form::open([
        'route' => ['admin.password.reset', $token],
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

    <div class="form-group has-feedback">
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password', 'required']) !!}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="row">
        <div class="col-xs-4">
            {!! Form::submit('Reset', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
        </div>
        <!-- /.col -->
    </div>

    {!! Form::close() !!}


    <a href="{{ route('admin.login') }}">Sign In</a><br>


@endsection