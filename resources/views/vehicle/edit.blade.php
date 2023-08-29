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
                            <h4 class="m-b-10">{{ __("Edit Vehicle") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Edit Vehicle") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'vehicle/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}

                    <div class="row">

                        <div class="form-group col-md-4" >
                            <label for="from" class="col-form-label text-dark">{{ __("Car Type") }}</label>
                            <select class="form-control font-style" name="car_type" required >
                            <option value="">{{ __("Select") }}</option>
                            @foreach($AllCarTypes as $CarType)
                            <option @if($Data->car_type == $CarType->name) selected @endif value="{{ $CarType->name }}">{{ $CarType->name }}</option>
                            @endforeach
                            <!-- <option @if($Data->car_type == "hatchback") selected @endif value="Hatchback">{{ __("Hatchback") }}</option>
                            <option @if($Data->car_type == "sedan") selected @endif value="Sedan">{{ __("Sedan") }}</option>
                            <option @if($Data->car_type == "suv") selected @endif value="Suv">{{ __("SUV") }}</option>
                            <option @if($Data->car_type == "muv") selected @endif value="Muv">{{ __("MUV") }}</option>
                            <option @if($Data->car_type == "coupe") selected @endif value="Coupe">{{ __("Coupe") }}</option>
                            <option @if($Data->car_type == "convertibles") selected @endif value="Convertibles">{{ __("Convertibles") }}</option>
                            <option @if($Data->car_type == "pickup trucks") selected @endif value="Pickup Trucks">{{ __("Pickup Trucks") }}</option>
                            <option @if($Data->car_type == "4wd") selected @endif value="4wd">{{ __("4WD") }}</option> -->
                        </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="from" class="col-form-label text-dark">{{ __("Make") }}</label>
                            <select class="form-control font-style" name="make" required >
                            <option value="">{{ __("Select") }}</option>
                            @foreach($AllBrands as $Brnd)
                            <option @if($Data->make == $Brnd->name) selected @endif value="{{ $Brnd->name }}">{{ $Brnd->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Model") }}</label>
                            <input class="form-control font-style" required name="model" value="{{ $Data->model }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Variant") }}</label>
                            <input class="form-control font-style" required name="variant" value="{{ $Data->variant }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Chasis Number") }}</label>
                            <input class="form-control font-style"  name="chasis_no" value="{{ $Data->chasis_no }}" type="text"  />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Engine Number") }}</label>
                            <input class="form-control font-style"  name="engine_no" value="{{ $Data->engine_no }}" type="text"  />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Registration Number") }}</label>
                            <input class="form-control font-style"  name="reg_no" value="{{ $Data->reg_no }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("KM Reading") }}</label>
                            <input class="form-control font-style"  name="km_reading" value="{{ $Data->km_reading }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Fuel Level Reading") }}</label>
                            <input class="form-control font-style"  name="fuel_level_reading"  value="{{ $Data->fuel_level_reading }}" type="text"  />
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Current Condition") }}</label>
                            <input class="form-control font-style"  name="current_condition" value="{{ $Data->current_condition }}" type="text"  />
                        </div>



                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("AC") }}</label>
                            <input class="form-control font-style"  name="ac" value="{{ $Data->ac }}" type="text"  />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Audio") }}</label>
                            <input class="form-control font-style"  name="Audio" value="{{ $Data->Audio }}" type="text"  />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("GPS") }}</label>
                            <input class="form-control font-style"  name="gps" value="{{ $Data->gps }}" type="text"  />
                        </div>

                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Car Image") }}</label>
                            <input class="form-control font-style"  name="car_image" accept="image/png, image/gif, image/jpeg" type="file"  />

                            @if($Data->car_image != "")
                            <a href="{{ URL('public') }}/{{ $Data->car_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Data->car_image }}" style="width: 200px;"></a>
                            @endif
                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Car Conditions Image") }}</label>
                            <input class="form-control font-style"  name="car_condition_image" accept="image/png, image/gif, image/jpeg" type="file"  />

                            @if($Data->car_condition_image != "")
                            <a href="{{ URL('public') }}/{{ $Data->car_condition_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Data->car_condition_image }}" style="width: 200px;"></a>
                            @endif

                        </div>


                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Mulkiya Details") }}</label>
                            <input class="form-control font-style"  name="mulkiya_details" accept="image/png, image/gif, image/jpeg" type="file"  />

                            @if($Data->mulkiya_details != "")
                            <a href="{{ URL('public') }}/{{ $Data->mulkiya_details }}" target="_blank"><img src="{{ URL('public') }}/{{ $Data->mulkiya_details }}" style="width: 200px;"></a>
                            @endif

                        </div>



                        <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Insurance Details") }}</label>
                            <textarea class="form-control font-style" name="insurance_detail">{{ $Data->insurance_detail }}</textarea>
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