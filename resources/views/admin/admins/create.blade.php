@extends('admin.index')

@section('content')

    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('admin.createAdmin')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        {!! Form::open([
            'route' => 'admins.store',
            'method' => 'POST',
            'class' => 'form-horizontal'
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('inputName', trans('admin.form.name'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name', old('name'), ['id' => 'inputName', 'class' => 'form-control', 'placeholder' => trans('admin.form.namePlaceholder'), 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('inputEmail', trans('admin.form.email'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::email('email', old('email'), ['id' => 'inputEmail', 'class' => 'form-control', 'placeholder' => trans('admin.form.emailPlaceholder'), 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('inputPassword', trans('admin.form.password'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::password('password', ['id' => 'inputPassword', 'class' => 'form-control', 'placeholder' => trans('admin.form.passwordPlaceholder'), 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('inputCPassword', trans('admin.form.cPassword'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::password('password_confirmation', ['id' => 'inputCPassword', 'class' => 'form-control', 'placeholder' => trans('admin.form.cPasswordPlaceholder'), 'required']) !!}
                </div>
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            {!! Form::button(trans('admin.form.create').' <i class="fa fa-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
            {!! Form::reset(trans('admin.form.reset'), ['class' => 'btn btn-default']) !!}
        </div>
        <!-- /.box-footer -->

        {!! Form::close() !!}


    </div>
    <!-- /.box -->

@endsection
