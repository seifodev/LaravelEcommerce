@extends('admin.index')

@section('content')

    {{-- Modal --}}
    <div class="modal modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('admin.modal.departDeleteTitle')</h4>
                </div>
                <div class="modal-body">
                    <p class="records-msg">@lang('admin.modal.departDeleteTitle')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger records-btn" id="confirmDelete">@lang('admin.modal.confirm')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin.modal.close')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <a class="btn btn-primary btn-sm" href="{{ route('departments.create') }}"><i class="fa fa-plus"></i></a>
                    <a id="depart-edit" class="btn btn-success btn-sm disabled"><i class="fa fa-edit"></i></a>
                    <a id="depart-delete" class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i></a>
                    {!! Form::open(['method' => 'DELETE', 'id' => 'delete-form']) !!}
                    {!! Form::close() !!}
                    <hr>
                    <div id="departments-tree"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

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
                'data' : {!! departsJson() !!},
                'multiple': false
            },
            'checkbox' : {
                'deselect_all': true,
                'three_state' : false,
            }
        }
        ); });
        $('#departments-tree').on("changed.jstree", function (e, data) {
            if(data.selected.length > 0)
            {
                $('#delete-form').prop('action', '{{ aurl() }}departments/' +  data.selected[0]);
                $('#depart-edit').removeClass('disabled').prop('href', '{{ aurl() }}departments/' + data.selected[0] + '/edit');

                $('#depart-delete').removeClass('disabled').on('click', function (e) {
                     e.preventDefault();
                    $('#delete-modal').modal();
                });

                $('#confirmDelete').on('click', function () {$('#delete-form').submit();});

            } else
            {
                $('#depart-edit').addClass('disabled');
                $('#depart-delete').addClass('disabled');
                $('#delete-form').prop('action', '');
            }
        });
    </script>
@endpush