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
            'route' => 'malls.store',
            'method' => 'POST',
            'class' => 'form-horizontal',
            'files' => true
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name_ar') ? 'has-error' : '' }}">
                {!! Form::label('inputNameAr', trans('admin.form.mall_ar'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_ar', old('name_ar'), ['id' => 'inputNameAr', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }}">
                {!! Form::label('inputNameEn', trans('admin.form.mall_en'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_en', old('name_en'), ['id' => 'inputNameEn', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                {!! Form::label('inputCName', trans('admin.form.manufacture_contact'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('contact_name', old('contact_name'), ['id' => 'inputCName', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                {!! Form::label('inputEmail', trans('admin.form.email'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::email('email', old('email'), ['id' => 'inputEmail', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                {!! Form::label('inputMobile', trans('admin.form.mobile'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('mobile', old('mobile'), ['id' => 'inputMobile', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('web_site') ? 'has-error' : '' }}">
                {!! Form::label('inputWebsite', trans('admin.form.website'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('web_site', old('web_site'), ['id' => 'inputWebsite', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                {!! Form::label('inputFacebook', trans('admin.form.facebook'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('facebook', old('facebook'), ['id' => 'inputFacebook', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
                {!! Form::label('inputTwitter', trans('admin.form.twitter'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('twitter', old('twitter'), ['id' => 'inputTwitter', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                {!! Form::label('inputLogo', trans('admin.form.logo'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::file('logo', ['id' => 'inputLogo', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                {!! Form::label('inputCountry', trans('admin.form.country'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::select('country_id', $countries, old('country_id'),['id' => 'inputCountry', 'class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                {!! Form::hidden('lat', old('lat'), ['id' => 'us3-lat']) !!}
                {!! Form::hidden('lng', old('lng'), ['id' => 'us3-lng']) !!}
                {!! Form::label('inputAddress', trans('admin.form.address'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('address', old('address'), ['id' => 'us3-address', 'class' => 'form-control']) !!}
                </div>
                <div class="col-xs-12">
                    <div id="us3" style="width: 100%; height: 400px; margin-top: 10px"></div>
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
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key={{ env('MAPS_KEY') }}'></script>
    <script src="{{ asset('design/admin/plugins/locationpicker/locationpicker.jquery.min.js') }}"></script>
    <script>
        $('#us3').locationpicker({
            location: {
                latitude: 30.072879075973194,
                longitude: 31.2291259765625
            },
            radius: 300,
            inputBinding: {
                latitudeInput: $('#us3-lat'),
                longitudeInput: $('#us3-lng'),
                radiusInput: $('#us3-radius'),
                locationNameInput: $('#us3-address')
            },
            enableAutocomplete: true,
            markerIcon: '{{ asset('design/admin/plugins/locationpicker/map-marker-2-xl.png') }}',
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                // Uncomment line below to show alert on each Location Changed event
                //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
            }
        });
    </script>
@endpush
