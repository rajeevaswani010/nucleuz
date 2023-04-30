@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Add Pricing") }}</h2>
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

    {!! Form::open(['url' => 'pricing', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
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
            <label>{{ __("Daily Pricing") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="daily_pricing" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Weekly Pricing") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="weekly_pricing" required>
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Monthly Pricing") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="monthly_pricing" required>
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
</div>
@endsection