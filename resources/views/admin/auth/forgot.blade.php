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

    @if(session()->has('sent'))
        <p class="alert alert-success">{{ session('sent') }}</p>
        @else
        <p class="login-box-msg">Enter you email address to reset your password</p>

        {!! Form::open([
            'route' => 'admin.password.forgot',
            'method' => 'POST'
        ]) !!}

        <div class="form-group has-feedback">
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-6">
                {!! Form::submit('Send Reset Email', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
            </div>
            <!-- /.col -->
        </div>

        {!! Form::close() !!}
    @endif

    <a href="{{ route('admin.login') }}">Sign In</a><br>


@endsection