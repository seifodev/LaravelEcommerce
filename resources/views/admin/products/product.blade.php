@extends('admin.index')

@section('content')

    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        {!! Form::open([
            'route' => ['products.update', $product->id],
            'method' => 'PUT',
            'files' => true,
        ]) !!}

        <div class="box-body">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#info">@lang('admin.form.info') <i class="fa fa-info-circle"></i></a></li>
                <li><a data-toggle="tab" href="#department">@lang('admin.form.department') <i class="fa fa-list"></i></a></li>
                <li><a data-toggle="tab" href="#settings">@lang('admin.form.settings') <i class="fa fa-gears"></i></a></li>
                <li><a data-toggle="tab" href="#media">@lang('admin.form.media') <i class="fa fa-floppy-o"></i></a></li>
                <li><a data-toggle="tab" href="#size-weight">@lang('admin.form.size-weight') <i class="fa fa-truck"></i></a></li>
                <li><a data-toggle="tab" href="#other">@lang('admin.form.other') <i class="fa fa-info"></i></a></li>
            </ul>

            <div class="tab-content">
                @include('admin.products.tabs.info')
                @include('admin.products.tabs.department')
                @include('admin.products.tabs.settings')
                @include('admin.products.tabs.media')
                @include('admin.products.tabs.size-weight')
                @include('admin.products.tabs.other')
            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            {!! Form::button(trans('admin.form.save').' <i class="fa fa-check"></i>', ['class' => 'btn btn-info']) !!}
            {!! Form::button(trans('admin.form.save-continue').' <i class="fa fa-save"></i>', ['class' => 'btn btn-success']) !!}
            {!! Form::button(trans('admin.form.copy').' <i class="fa fa-copy"></i>', ['class' => 'btn btn-warning']) !!}
            {!! Form::button(trans('admin.form.delete').' <i class="fa fa-trash"></i>', ['class' => 'btn btn-danger']) !!}
        </div>
        <!-- /.box-footer -->

        {!! Form::close() !!}


    </div>
    <!-- /.box -->

@endsection


