@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Edit Vehicle") }}</h2>
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

    {!! Form::open(['url' => 'vehicle/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label>{{ __("Car Type") }} <span class="text-danger">*</span></label>
            <select class="form-control" name="car_type" required>
                <option value="">{{ __("Select") }}</option>
                <option @if($Data->car_type == "Hatchback") selected @endif value="Hatchback">{{ __("Hatchback") }}</option>
                <option @if($Data->car_type == "Sedan") selected @endif value="Sedan">{{ __("Sedan") }}</option>
                <option @if($Data->car_type == "SUV") selected @endif value="SUV">{{ __("SUV") }}</option>
                <option @if($Data->car_type == "MUV") selected @endif value="MUV">{{ __("MUV") }}</option>
                <option @if($Data->car_type == "Coupe") selected @endif value="Coupe">{{ __("Coupe") }}</option>
                <option @if($Data->car_type == "Convertibles") selected @endif value="Convertibles">{{ __("Convertibles") }}</option>
                <option @if($Data->car_type == "Pickup Trucks") selected @endif value="Pickup Trucks">{{ __("Pickup Trucks") }}</option>
            </select>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Make") }} <span class="text-danger">*</span></label>
            <select class="form-control" name="make" required>
                <option value="">{{ __("Select") }}</option>
                @foreach($AllBrands as $Brnd)
                <option @if($Data->make == $Brnd->name) selected @endif>{{ $Brnd->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Model") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="model" value="{{ $Data->model }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Variant") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="variant" value="{{ $Data->variant }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Chasis Number") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="chasis_no" value="{{ $Data->chasis_no }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Engine Number") }}</label>
            <input type="text" class="form-control" name="engine_no" value="{{ $Data->engine_no }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Registration Number") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="reg_no" value="{{ $Data->reg_no }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("KM Reading") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="km_reading" value="{{ $Data->km_reading }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Fuel Level Reading") }}</label>
            <input type="text" class="form-control" name="fuel_level_reading" value="{{ $Data->fuel_level_reading }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Current Condition") }}</label>
            <input type="text" class="form-control" name="current_condition" value="{{ $Data->current_condition }}">
        </div>

        <div class="col-lg-4 mb-4">
            <label>{{ __("AC") }}</label>
            <input type="text" class="form-control" name="ac" value="{{ $Data->ac }}">
        </div>

        <div class="col-lg-4 mb-4">
            <label>{{ __("Audio") }}</label>
            <input type="text" class="form-control" name="Audio" value="{{ $Data->Audio }}">
        </div>

        <div class="col-lg-4 mb-4">
            <label>{{ __("GPS") }}</label>
            <input type="text" class="form-control" name="gps" value="{{ $Data->gps }}">
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Car Image") }}</label>
            <input type="file" class="form-control" name="car_image" accept="image/png, image/gif, image/jpeg">
            @if($Data->car_image != "")
            <a href="{{ URL('public') }}/{{ $Data->car_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Data->car_image }}" style="width: 200px;"></a>
            @endif
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Car Conditions Image") }}</label>
            <input type="file" class="form-control" name="car_condition_image" accept="image/png, image/gif, image/jpeg" >
            @if($Data->car_condition_image != "")
            <a href="{{ URL('public') }}/{{ $Data->car_condition_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Data->car_condition_image }}" style="width: 200px;"></a>
            @endif
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Mulkiya Details") }}</label>
            <input type="file" class="form-control" name="mulkiya_details" accept="image/png, image/gif, image/jpeg" >
            @if($Data->mulkiya_details != "")
            <a href="{{ URL('public') }}/{{ $Data->mulkiya_details }}" target="_blank"><img src="{{ URL('public') }}/{{ $Data->mulkiya_details }}" style="width: 200px;"></a>
            @endif
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Insurance Details") }}</label>
            <textarea type="text" class="form-control" name="insurance_detail">{{ $Data->insurance_detail }}</textarea>
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
</div>
@endsection