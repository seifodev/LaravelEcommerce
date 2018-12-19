@extends('admin.index')

@section('content')

    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('admin.createState')</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        {!! Form::open([
            'route' => 'states.store',
            'method' => 'POST',
            'class' => 'form-horizontal',
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name_ar') ? 'has-error' : '' }}">
                {!! Form::label('inputNameAr', trans('admin.form.state_ar'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_ar', old('name_ar'), ['id' => 'inputNameAr', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }}">
                {!! Form::label('inputNameEn', trans('admin.form.state_en'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_en', old('name_en'), ['id' => 'inputNameEn', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                {!! Form::label('inputCountry', trans('admin.form.country'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::select('country_id', $countries, old('country_id'), ['id' => 'inputCountry', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                {!! Form::label('inputCity', trans('admin.form.city'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::select('city_id',[], old('city_id'), ['id' => 'inputCity', 'class' => 'form-control', 'required']) !!}
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

@push('scripts')
    <script>
        $(function () {

            getCities();
            $('body').on('change', '#inputCountry', function () {
                getCities();
            });

        });

        function getCities()
        {
            var countryId = $('#inputCountry').children('option:selected').val();

            if(countryId)
            {
                $.ajax({
                    url: '{{ route('states.create') }}',
                    method: 'GET',
                    data: {id: countryId},
                    success: function (response) {

                        var selects = '';
                        var old = '{{ old('city_id') }}';
                        for(let i = 0; i < response.length; i++) {
                            if(old == response[i].id) {
                                selects += '<option value="' + response[i].id + '" selected>' + response[i].name + '</option>';
                            } else {
                                selects += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                            }
                        }

                        $('#inputCity').html(selects);


                    }
                });
            }
        }
    </script>
@endpush
