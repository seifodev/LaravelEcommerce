<div id="info" class="tab-pane fade in active">
    <h3>@lang('admin.form.info')</h3>
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
        <div class=" col-md-8 col-lg-6">
            {!! Form::label('inputTitle', trans('admin.form.product_title')) !!}
            {!! Form::text('title', $product->title, ['id' => 'inputTitle', 'class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>