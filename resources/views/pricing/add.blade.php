@extends("layout.default")

@section("content")

<!-- [ Main Content ] start -->
<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">Add Pricing</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Pricing</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'pricing', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="from" class="col-form-label text-dark">Car Type</label>
                            <select class="form-control font-style" name="car_type" required>
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

                       

                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">Daily Pricing</label>
                            <input class="form-control font-style" required name="daily_pricing" value="{{ old('daily_pricing') }}" type="text"  />
                        </div>


                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">Weekly Pricing</label>
                            <input class="form-control font-style" required name="weekly_pricing" value="{{ old('weekly_pricing') }}" type="text"  />
                        </div>

                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">Monthly Pricing</label>
                            <input class="form-control font-style" required name="monthly_pricing" value="{{ old('monthly_pricing') }}" type="text"  />
                        </div>



                        <div class="modal-footer">
                            <input class="btn btn-xs btn-primary" type="submit" value="Save">
                        </div>
                        {!! Form::close() !!}

                        @if(Session::has('Danger'))
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{!!Session::get('Danger')!!}</div>
                        </div>
                        @endif
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
    </div>
</div>


@endsection