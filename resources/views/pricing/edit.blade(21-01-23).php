@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Edit Pricing") }}</h2>
            </div>

            <div><a href="{{ URL('pricing') }}"><button class="btn btn-primary">{{ __("Go Back") }}</button></a></div>
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

    {!! Form::open(['url' => 'pricing/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label>{{ __("Car Type") }} <span class="text-danger">*</span></label>
            <select class="form-control" name="car_type" required>
                <option value="">Select</option>
                <option @if($Data->car_type == "Hatchback") selected @endif value="Hatchback>{{ __("Hatchback") }}</option>
                <option @if($Data->car_type == "Sedan") selected @endif value="Sedan>{{ __("Sedan") }}</option>
                <option @if($Data->car_type == "SUV") selected @endif value="SUV>{{ __("SUV") }}</option>
                <option @if($Data->car_type == "MUV") selected @endif value="MUV>{{ __("MUV") }}</option>
                <option @if($Data->car_type == "Coupe") selected @endif value="Coupe>{{ __("Coupe") }}</option>
                <option @if($Data->car_type == "Convertibles") selected @endif value="Convertibles>{{ __("Convertibles") }}</option>
                <option @if($Data->car_type == "Pickup Trucks") selected @endif value="Pickup Trucks>{{ __("Pickup Trucks") }}</option>
            </select>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Daily Pricing") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="daily_pricing" value="{{ $Data->daily_pricing }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Weekly Pricing") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="weekly_pricing" value="{{ $Data->weekly_pricing }}" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Monthly Pricing") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="monthly_pricing" value="{{ $Data->monthly_pricing }}" required>
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
</div>
@endsection