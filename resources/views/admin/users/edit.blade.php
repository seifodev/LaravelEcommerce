@extends('admin.index')

@section('content')

    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('admin.editUser', ['name' => $user->name]) }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        {!! Form::open([
            'route' => ['users.update', $user->id],
            'method' => 'PUT',
            'class' => 'form-horizontal'
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('inputName', trans('admin.form.name'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name', $user->name, ['id' => 'inputName', 'class' => 'form-control', 'placeholder' => trans('admin.form.namePlaceholder'), 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('inputEmail', trans('admin.form.email'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::email('email', $user->email, ['id' => 'inputEmail', 'class' => 'form-control', 'placeholder' => trans('admin.form.emailPlaceholder'), 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('inputPassword', trans('admin.form.password'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::password('password', ['id' => 'inputPassword', 'class' => 'form-control', 'placeholder' => trans('admin.form.passwordPlaceholder')]) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('inputCPassword', trans('admin.form.cPassword'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::password('password_confirmation', ['id' => 'inputCPassword', 'class' => 'form-control', 'placeholder' => trans('admin.form.cPasswordPlaceholder')]) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                {!! Form::label('inputLevel', trans('admin.userLevel.level'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::select('level', [
                    'user' => trans('admin.userLevel.user'), 'vendor' => trans('admin.userLevel.vendor'), 'company' => trans('admin.userLevel.company')
                    ], $user->level, ['id' => 'inputLevel', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            {!! Form::button(trans('admin.form.save').' <i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
        </div>
        <!-- /.box-footer -->

        {!! Form::close() !!}


    </div>
    <!-- /.box -->

@endsection
