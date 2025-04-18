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
                            <h4 class="m-b-10">{{ __("Add Vehicle") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Add Vehicle") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'vehicle', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}

                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="from" class="col-form-label text-dark">{{ __("Car Type") }}<span class="text-danger">*</span></label>
                            <select class="form-control font-style" name="car_type" required>
                            <option value="">{{ __("Select") }}</option>
                            @foreach($AllCarTypes as $CarType)
                            <option>{{ $CarType->name }}</option>
                            @endforeach
                            <!-- <option value="Hatchback">{{ __("Hatchback") }}</option>
                            <option value="Sedan">{{ __("Sedan") }}</option>
                            <option value="SUV">{{ __("SUV") }}</option>
                            <option value="MUV">{{ __("MUV") }}</option>
                            <option value="Coupe">{{ __("Coupe") }}</option>
                            <option value="Convertibles">{{ __("Convertibles") }}</option>
                            <option value="Pickup Trucks">{{ __("Pickup Trucks") }}</option> -->
                        </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="from" class="col-form-label text-dark">{{ __("Make") }}<span class="text-danger">*</span></label>
                            <select class="form-control font-style" name="make" required>
                            <option value="">{{ __("Select") }}</option>
                            @foreach($AllBrands as $Brnd)
                            <option>{{ $Brnd->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Model") }}<span class="text-danger">*</span></label>
                            <input class="form-control font-style" required name="model" value="{{ old('model') }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Variant") }}<span class="text-danger">*</span></label>
                            <input class="form-control font-style" required name="variant" value="{{ old('variant') }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Chasis Number") }}<span class="text-danger">*</span></label>
                            <input class="form-control font-style" required name="chasis_no" value="{{ old('chasis_no') }}" type="text"  />
                        </div>



                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Engine Number") }}</label>
                            <input class="form-control font-style"  name="engine_no" value="{{ old('engine_no') }}" type="text"  />
                        </div>



                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Registration Number") }}<span class="text-danger">*</span></label>
                            <input class="form-control font-style" required name="reg_no" value="{{ old('reg_no') }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("KM Reading") }}<span class="text-danger">*</span></label>
                            <input class="form-control font-style" required name="km_reading" value="{{ old('km_reading') }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Fuel Level Reading") }}</label>
                            <input class="form-control font-style"  name="fuel_level_reading" value="{{ old('fuel_level_reading') }}" type="text"  />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Current Condition") }}</label>
                            <input class="form-control font-style"   name="current_condition" value="{{ old('current_condition') }}" type="text"  />
                        </div>



                        <div class="row mt-4 mb-2">
                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("AC") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ac" id="ac1" value="yes" >
                                <label class="form-check-label" for="ac1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ac" id="ac2" value="no" checked>
                                <label class="form-check-label" for="ac2">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("Audio") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Audio" id="Audio1" value="yes" >
                                <label class="form-check-label" for="Audio1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Audio" id="Audio2" value="no" checked >
                                <label class="form-check-label" for="Audio2">
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("GPS") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gps" id="gps1" value="yes" >
                                <label class="form-check-label" for="gps1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gps" id="gps2" value="no" checked>
                                <label class="form-check-label" for="gps2">
                                    No
                                </label>
                            </div>
                        </div>

                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Car Image") }}</label>
                            <input class="form-control font-style"  name="car_image" accept="image/png, image/gif, image/jpeg" type="file"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Car Conditions Image") }}</label>
                            <input class="form-control font-style"  name="car_condition_image" accept="image/png, image/gif, image/jpeg" type="file"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Mulkiya Details") }}<span class="text-danger">*</span></label>
                            <input class="form-control font-style" required name="mulkiya_details" accept="image/png, image/gif, image/jpeg" type="file"  />
                        </div>



                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Insurance Details") }}</label>
                            <textarea class="form-control font-style" name="insurance_detail">{{ old('insurance_detail') }}</textarea>
                        </div>


                        <div class="modal-footer">
                            <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Save") }}'>
                        </div>
                        {!! Form::close() !!}

                        @if(Session::has('Danger'))
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{!!Session::get('Danger')!!}</div>
                        </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
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