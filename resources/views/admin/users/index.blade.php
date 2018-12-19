@extends('admin.index')

@section('content')

    {{-- Modal --}}
    <div class="modal modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('admin.modal.usersDeleteTitle')</h4>
                </div>
                <div class="modal-body">
                    <p class="no-records-msg hidden">@lang('admin.modal.noRecordsMsg')</p>
                    <p class="records-msg hidden">{!! trans('admin.modal.recordsMsg') !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger records-btn hidden" id="confirmDelete">@lang('admin.modal.confirm')</button>
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
                    <div class="">
                        {!! Form::open([
                            'method' => 'DELETE',
                            'id' => 'adminsForm',
                            'url' => route('users.destroy.all')
                        ]) !!}
                        {!! $dataTable->table([
                            'class' => 'table table-striped table-hover table-bordered',
                        ], true) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

        @endsection

@push('styles')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/design/admin') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">--}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.bootstrap.min.css">
@endpush

@push('scripts')
<!-- DataTables -->
<script src="{{ asset('/design/admin') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/design/admin') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
{{--<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>--}}
<script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.bootstrap.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush