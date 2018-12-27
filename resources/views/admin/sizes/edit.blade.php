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
            'route' => ['sizes.update', $size->id],
            'method' => 'PUT',
            'class' => 'form-horizontal',
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name_ar') ? 'has-error' : '' }}">
                {!! Form::label('inputNameAr', trans('admin.form.size_ar'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_ar', $size->name_ar, ['id' => 'inputNameAr', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }}">
                {!! Form::label('inputNameEn', trans('admin.form.size_en'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_en', $size->name_en, ['id' => 'inputNameEn', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('department_id') ? 'has-error' : '' }}">
                {!! Form::label('inputDep', trans('admin.form.department'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::hidden('department_id', $size->department_id, ['id' => 'departmentId']) !!}
                    <div id="departments"></div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('is_public') ? 'has-error' : '' }}">
                {!! Form::label('inputPublic', trans('admin.form.public'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::select('is_public', ['yes' => trans('admin.yes'), 'no' => trans('admin.no')], $size->is_public, ['id' => 'inputPublic', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            {!! Form::button(trans('admin.form.save').' <i class="fa fa-edit"></i>', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
        </div>
        <!-- /.box-footer -->

        {!! Form::close() !!}


    </div>
    <!-- /.box -->

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('design/admin/plugins/jstree/themes/default/style.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('design/admin/plugins/jstree/jstree.js') }}"></script>
    <script src="{{ asset('design/admin/plugins/jstree/jstree.wholerow.js') }}"></script>
    <script src="{{ asset('design/admin/plugins/jstree/jstree.checkbox.js') }}"></script>
    <script>
        $('#departments').jstree({
            'plugins' : [ "wholerow", "checkbox" ],
            'core' : {
                'multiple': false,
                'data' : {!! departsJson($size->department_id) !!},
            },
            'checkbox' : {
                'deselect_all': true,
                'three_state' : false,
            }
        });
        $('#departments').on("changed.jstree", function (e, data) {
            $('#departmentId').val(data.selected[0]);
        });
    </script>
@endpush