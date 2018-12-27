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
            'route' => 'departments.store',
            'method' => 'POST',
            'class' => 'form-horizontal',
            'files' => true
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name_ar') ? 'has-error' : '' }}">
                {!! Form::label('inputNameAr', trans('admin.form.department_ar'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_ar', old('name_ar'), ['id' => 'inputNameAr', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }}">
                {!! Form::label('inputNameEn', trans('admin.form.department_en'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_en', old('name_en'), ['id' => 'inputNameEn', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                {!! Form::label('inputDep', trans('admin.form.department'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::hidden('parent_id', old('parent_id'), ['id' => 'parent-id']) !!}
                    <div id="departments-tree"></div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {!! Form::label('inputDesc', trans('admin.form.desc'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::textarea('description', old('description'), ['id' => 'inputDesc', 'class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('keywords') ? 'has-error' : '' }}">
                {!! Form::label('inputKeys', trans('admin.form.keys'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::textarea('keywords', old('keywords'), ['id' => 'inputKeys', 'class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                {!! Form::label('inputLogo', trans('admin.form.logo'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::file('icon', ['id' => 'inputLogo', 'class' => 'form-control']) !!}
                </div>
            </div>


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            {!! Form::button(trans('admin.form.create').' <i class="fa fa-plus"></i>', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
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
        $(function () { $('#departments-tree').jstree({
                'plugins' : [ "wholerow", "checkbox" ],
                'core' : {
                    'multiple': false,
                    'data' : {!! departsJson(old('parent_id')) !!},
                },
                'checkbox' : {
                    'deselect_all': true,
                    'three_state' : false,
                }
            }
        ); });

        $('#departments-tree').on("changed.jstree", function (e, data) {
            $('#parent-id').val(data.selected[0]);
        });
    </script>
@endpush
