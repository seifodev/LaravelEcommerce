@extends('admin.index')

@section('content')

    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('admin.navbar.settings')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        {!! Form::open([
            'route' => 'admin.settings',
            'method' => 'POST',
            'class' => 'form-horizontal',
            'files' => true
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('site_ar') ? 'has-error' : '' }}">
                {!! Form::label('inputSiteAr', trans('admin.form.site_ar'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('site_ar', $settings->site_ar, ['id' => 'inputSiteAr', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('site_en') ? 'has-error' : '' }}">
                {!! Form::label('inputSiteEn', trans('admin.form.site_en'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('site_en', $settings->site_en, ['id' => 'inputSiteEn', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('inputEmail', trans('admin.form.email'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::email('email', $settings->email, ['id' => 'inputEmail', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                {!! Form::label('inputLogo', trans('admin.form.logo'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::file('logo', ['id' => 'inputLogo', 'class' => 'form-control mb-10']) !!}
                    @if($settings->logo)
                        <img src="{{ \Storage::url($settings->logo) }}" alt="" class="img-responsive" style="max-width: 200px">
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                {!! Form::label('inputIcon', trans('admin.form.icon'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::file('icon', ['id' => 'inputIcon', 'class' => 'form-control mb-10']) !!}
                    @if($settings->icon)
                        <img src="{{ \Storage::url($settings->icon) }}" alt="" class="img-responsive" style="max-width: 200px">
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {!! Form::label('inputDesc', trans('admin.form.desc'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::textarea('description', $settings->description, ['id' => 'inputDesc', 'class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('keywords') ? 'has-error' : '' }}">
                {!! Form::label('inputKeys', trans('admin.form.keys'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::textarea('keywords', $settings->keywords, ['id' => 'inputKeys', 'class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('lang') ? 'has-error' : '' }}">
                {!! Form::label('inputLang', trans('admin.form.lang'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('lang', $settings->lang, ['id' => 'inputLang', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                {!! Form::label('inputStatus', trans('admin.form.status'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::select('status', [
                    'open' => trans('admin.form.open'), 'close' => trans('admin.form.close')
                    ], $settings->status, ['id' => 'inputStatus', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>


            <div class="form-group {{ $errors->has('maintenance_msg') ? 'has-error' : '' }}">
                {!! Form::label('inputMsg', trans('admin.form.msg'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::textarea('maintenance_msg', $settings->maintenance_msg, ['id' => 'inputMsg', 'class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            {!! Form::button(trans('admin.form.save').' <i class="fa fa-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
        </div>
        <!-- /.box-footer -->

        {!! Form::close() !!}


    </div>
    <!-- /.box -->

@endsection
