@extends("layout.default")

@section("content")
<style>
#statusactive:checked + label {
    background-color: #198754 !important;
    color: white;
    font-weight: bold;
}

#statusservice:checked + label {
  background-color: #ffa21d !important;
  color: white;
  font-weight: bold;
}

#statusrepair:checked + label {
  background-color: #dc3545 !important;
  color: white;
  font-weight: bold;
}

/* #vehicleinfo.card {
    border-right: 5px solid green;
} */

</style>

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
            <div class="card" id="vehicleinfo">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'vehicle/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}

                    <div class="row">

                        <div class="row">
                            <div class="form-group col-4" >
                                <label for="from" class="col-form-label text-dark">{{ __("Car Type") }}</label>
                                <select class="form-control font-style" name="car_type" required >
                                    <option value="">{{ __("--Select--") }}</option>
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
                            <div class="form-group col-5">
                            </div>
                            <div class="form-group col-3">  <!-- vehicle status -->
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group" id="statusradio">
                                    <input type="radio" class="btn-check" name="status" id="statusactive" autocomplete="off" value="1" @if($Data->status == 1) checked @endif >
                                    <label class="btn btn-lg btn-outline-success" for="statusactive">Active</label>

                                    <input type="radio" class="btn-check" name="status" id="statusservice" value="2" autocomplete="off" @if($Data->status == 2) checked @endif >
                                    <label class="btn btn-lg btn-outline-warning" for="statusservice">Service</label>

                                    <input type="radio" class="btn-check" name="status" id="statusrepair" value="3" autocomplete="off" @if($Data->status == 3) checked @endif>
                                    <label class="btn btn-lg btn-outline-danger" for="statusrepair">Repair</label>
                                </div>

                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusradio1" value="1">
                                    <label class="form-check-label" for="statusradio1">ACTIVE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusradio2" value="2">
                                    <label class="form-check-label" for="statusradio2">SERVICE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusradio3" value="3">
                                    <label class="form-check-label" for="statusradio3">REPAIR</label>
                                </div>                             -->
                            </div>
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

                        <div class="row mt-4 mb-2">
                        <!-- <div class="form-group col-4 mt-4">
                            <input class="form-check-input" type="checkbox" name="ac">
                            <label for="subject" class="form-check-label text-dark" style="margin-left:6px;" >{{ __("AC") }}</label>
                        </div> -->
                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("AC") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ac" id="ac1" value="yes" @if( $Data->ac == "yes") checked @endif>
                                <label class="form-check-label" for="ac1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ac" id="ac2" value="no" @if( $Data->ac  == "no") checked @endif >
                                <label class="form-check-label" for="ac2">
                                    No
                                </label>
                            </div>
                        </div>


                        <!-- <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Audio") }}</label>
                            <input class="form-control font-style"  name="Audio" value="{{ $Data->Audio }}" type="text"  />
                        </div> -->
                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("Audio") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Audio" id="Audio1" value="yes" @if( $Data->Audio == "yes") checked @endif>
                                <label class="form-check-label" for="Audio1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Audio" id="Audio2" value="no" @if( $Data->Audio  == "no") checked @endif >
                                <label class="form-check-label" for="Audio2">
                                    No
                                </label>
                            </div>
                        </div>

                        <!-- <div class="form-group col-2">
                            <label for="subject" class="col-form-label text-dark">{{ __("GPS") }}</label>
                            <input class="form-control font-style"  name="gps" value="{{ $Data->gps }}" type="text"  />
                        </div> -->
                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("GPS") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gps" id="gps1" value="yes" @if( $Data->gps == "yes") checked @endif>
                                <label class="form-check-label" for="gps1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gps" id="gps2" value="no" @if( $Data->gps  == "no") checked @endif >
                                <label class="form-check-label" for="gps2">
                                    No
                                </label>
                            </div>
                        </div>

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