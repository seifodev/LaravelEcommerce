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
            'route' => ['shippings.update', $shipping->id],
            'method' => 'PUT',
            'class' => 'form-horizontal',
            'files' => true
        ]) !!}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name_ar') ? 'has-error' : '' }}">
                {!! Form::label('inputNameAr', trans('admin.form.shipping_ar'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_ar', $shipping->name_ar, ['id' => 'inputNameAr', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name_en') ? 'has-error' : '' }}">
                {!! Form::label('inputNameEn', trans('admin.form.shipping_en'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::text('name_en', $shipping->name_en, ['id' => 'inputNameEn', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                {!! Form::label('inputOwner', trans('admin.form.owner'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::select('user_id', $companies, $shipping->user_id, ['id' => 'inputOwner', 'class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                {!! Form::label('inputLogo', trans('admin.form.logo'), ['class' => 'control-label col-sm-2']) !!}
                <div class="col-md-8 col-lg-6">
                    {!! Form::file('logo', ['id' => 'inputLogo', 'class' => 'form-control']) !!}
                    <div>
                        @if($shipping->logo)
                            <img src="{{ Storage::url($shipping->logo) }}" alt="" style="display: block; max-width: 200px; margin-top: 10px">
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                {!! Form::hidden('lat', $shipping->lat, ['id' => 'us3-lat']) !!}
                {!! Form::hidden('lng', $shipping->lng, ['id' => 'us3-lng']) !!}
                <div class="col-xs-12">
                    <div id="us3" style="width: 100%; height: 400px; margin-top: 10px"></div>
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

@push('scripts')
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key={{ env('MAPS_KEY') }}'></script>
    <script src="{{ asset('design/admin/plugins/locationpicker/locationpicker.jquery.min.js') }}"></script>
    <script>
        $('#us3').locationpicker({
            location: {
                latitude: {!! $shipping->lat !!},
                longitude: {!! $shipping->lng !!}
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
