@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Add Vehicle") }}</h2>
            </div>

            <div><a href="{{ URL('vehicle') }}"><button class="btn btn-primary">{{ __("Go Back") }}</button></a></div>
        </div>
    </div>
</div>

<div class="container-fluid page__container mt-5 mb-5">
    @if(Session::has('Danger'))
    <div class="alert alert-danger" role="alert">
        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
        <div class="alert-text">{!!Session::get('Danger')!!}</div>
    </div>
    @endif

    {!! Form::open(['url' => 'vehicle', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label>{{ __("Car Type") }} <span class="text-danger">*</span></label>
            <select class="form-control" name="car_type" required>
                <option value="">{{ __("Select") }}</option>
                <option value="Hatchback">{{ __("Hatchback") }}</option>
                <option value="Sedan">{{ __("Sedan") }}</option>
                <option value="SUV">{{ __("SUV") }}</option>
                <option value="MUV">{{ __("MUV") }}</option>
                <option value="Coupe">{{ __("Coupe") }}</option>
                <option value="Convertibles">{{ __("Convertibles") }}</option>
                <option value="Pickup Trucks">{{ __("Pickup Trucks") }}</option>
            </select>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Make") }} <span class="text-danger">*</span></label>
            <select class="form-control" name="make" required>
                <option value="">{{ __("Select") }}</option>
                @foreach($AllBrands as $Brnd)
                <option>{{ $Brnd->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Model") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="model" value="{{ old('model') }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Variant") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="variant" value="{{ old('variant') }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Chasis Number") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="chasis_no" value="{{ old('chasis_no') }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Engine Number") }}</label>
            <input type="text" class="form-control" name="engine_no" value="{{ old('engine_no') }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Registration Number") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="reg_no" value="{{ old('reg_no') }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("KM Reading") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="km_reading" value="{{ old('km_reading') }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Fuel Level Reading") }}</label>
            <input type="text" class="form-control" name="fuel_level_reading" value="{{ old('fuel_level_reading') }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Current Condition") }}</label>
            <input type="text" class="form-control" name="current_condition" value="{{ old('current_condition') }}">
        </div>

        <div class="col-lg-4 mb-4">
            <label>{{ __("AC") }}</label>
            <input type="text" class="form-control" name="ac" value="{{ old('ac') }}">
        </div>

        <div class="col-lg-4 mb-4">
            <label>{{ __("Audio") }}</label>
            <input type="text" class="form-control" name="Audio" value="{{ old('Audio') }}">
        </div>

        <div class="col-lg-4 mb-4">
            <label>{{ __("GPS") }}</label>
            <input type="text" class="form-control" name="gps" value="{{ old('gps') }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Car Image") }}</label>
            <input type="file" class="form-control" name="car_image" accept="image/png, image/gif, image/jpeg" >
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Car Conditions Image") }}</label>
            <input type="file" class="form-control" name="car_condition_image" accept="image/png, image/gif, image/jpeg" >
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Mulkiya Details") }} <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="mulkiya_details" required accept="image/png, image/gif, image/jpeg" >
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Insurance Details") }}</label>
            <textarea type="text" class="form-control" name="insurance_detail">{{ old('insurance_detail') }}</textarea>
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
</div>
@endsection