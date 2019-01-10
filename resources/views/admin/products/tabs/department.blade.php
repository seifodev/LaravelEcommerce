<div id="department" class="tab-pane fade">
    <h3>@lang('admin.form.department')</h3>
    <div class="form-group {{ $errors->has('department_id') ? 'has-error' : '' }}">
        <div class="col-md-8 col-lg-6">
            {!! Form::label('inputDep', trans('admin.form.department')) !!}
            {!! Form::hidden('department_id', $product->department_id, ['id' => 'inputDep', 'class' => 'form-control']) !!}
            <div id="departments-tree"></div>
        </div>
    </div>
</div>
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
                    'data' : {!! departsJson($product->department_id) !!},
                },
                'checkbox' : {
                    'deselect_all': true,
                    'three_state' : false,
                }
            }
        ); });

        $('#departments-tree').on("changed.jstree", function (e, data) {
            $('#inputDep').val(data.selected[0]);
        });
    </script>
@endpush