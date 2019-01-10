@push('styles')
    <link rel="stylesheet" href="{{ asset('design/admin/plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('design/admin/plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('design/admin/plugins/datepicker/locales/bootstrap-datepicker.ar.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            rtl: Boolean({!! direction() == 'rtl' ? 1  : 0 !!}),
            language: String('{!! lang() !!}'),
            format: "yyyy-mm-dd",
            autoclose: true,
            clearBtn: true,
            todayBtn: "linked",
        });


        checkStatusInput();
        $('#inputStatus').on('change', function () {
            checkStatusInput();
        });
        // a function to show the rejected reason input if the status is rejected
        function checkStatusInput() {
            var status = $('#inputStatus').val();
            if(status === 'rejected') {
                $('.reject-row').removeClass('hidden');
            } else {
                $('.reject-row').addClass('hidden');
            }
        }
    </script>
@endpush


<div id="settings" class="tab-pane fade">
    <h3>@lang('admin.form.settings')</h3>

    <div class="row">
        <div class="col-md-8 col-lg-6">
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                {!! Form::label('inputPrice', trans('admin.form.price')) !!}
                {!! Form::number('price', $product->price, ['id' => 'inputPrice', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('start_at') ? 'has-error' : '' }}">
                {!! Form::label('inputStart', trans('admin.form.start_at')) !!}
                {!! Form::text('start_at', $product->start_at, ['id' => 'inputStart', 'class' => 'form-control datepicker']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('end_at') ? 'has-error' : '' }}">
                {!! Form::label('inputEnd', trans('admin.form.end_at')) !!}
                {!! Form::text('end_at', $product->end_at, ['id' => 'inputEnd', 'class' => 'form-control datepicker']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-6">
            <div class="form-group {{ $errors->has('price_offer') ? 'has-error' : '' }}">
                {!! Form::label('inputPriceOffer', trans('admin.form.price_offer')) !!}
                {!! Form::number('price_offer', $product->price_offer, ['id' => 'inputPriceOffer', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('start_offer_at') ? 'has-error' : '' }}">
                {!! Form::label('inputStartOffer', trans('admin.form.start_offer_at')) !!}
                {!! Form::text('start_offer_at', $product->start_offer_at, ['id' => 'inputStartOffer', 'class' => 'form-control datepicker']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('end_offer_at') ? 'has-error' : '' }}">
                {!! Form::label('inputEndOffer', trans('admin.form.end_offer_at')) !!}
                {!! Form::text('end_offer_at', $product->end_offer_at, ['id' => 'inputEndOffer', 'class' => 'form-control datepicker']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-6">
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                {!! Form::label('inputStatus', trans('admin.form.status')) !!}
                {!! Form::select('status', [
                    'pending' => trans('admin.form.pending'), 'active' => trans('admin.form.active'), 'rejected' => trans('admin.form.rejected')
                    ],
                    $product->status, ['id' => 'inputStatus', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row reject-row hidden">
        <div class="col-md-8 col-lg-6">
            <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                {!! Form::label('inputReason', trans('admin.form.reject_reason')) !!}
                {!! Form::textarea('reason', $product->reason, ['id' => 'inputReason', 'class' => 'form-control', 'rows' => 6]) !!}
            </div>
        </div>
    </div>

</div>