@extends("layout.default")

@section("content")
<script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>
<script src="{{ URL('resources/js/customer.js') }}"></script>

<style>
.inline-block-div {
    display: inline-block;
    width: fit-content; /* Adjust as needed */
}
/* Initial style for the panel */
.booking-edit-panel {
    display: none;
    padding: 20px;
}

.booking-status {
    padding: 6px;
    font-size: large;
    font-weight: bold;
}

.booking-status.assigned,
.booking-status.cancelled {
    color:white;
}

.center-content {
    display: flex;
    justify-content: center;
    align-items: center;
}

.right-content {
    display: flex;
    justify-content: right;
    align-items: center;
}

.align-vertical-center{
    position: relative;
    top: 50%;
}

/* Hide the up and down arrows in number field */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    appearance: none;
}

.btn-tiny {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}



/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>

<!-- [ Main Content ] start -->
<div class="dash-container">

    <div class="dash-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">{{ __("Edit Booking Data") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Edit Booking Data") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="row mb-4">

                            <div class="float-left col-8"><h1>{{ __("Booking Details") }} : #{{ $Booking->id }}</h1>
                            </div>
                            <div class="col-4 right-content ">
                                @if($Booking->status == 3)
                                <span class="indicator-line rounded bg-success booking-status complete">{{ __("Complete") }}</span>
                                @endif

                                @if($Booking->status == 1)
                                <span class="indicator-line rounded bg-secondary booking-status assigned" >{{ __("Reserved") }}</span>
                                @endif

                                @if($Booking->status == 2 )
                                <span class="indicator-line rounded bg-warning booking-status delivered">{{ __("Delivered") }}</span>
                                @endif

                                @if($Booking->status == 4)
                                <span class="indicator-line rounded bg-danger booking-status cancelled">{{ __("Cancelled") }}</span>
                                @endif

                                @if($Booking->status == 5)
                                <span class="indicator-line rounded bg-info booking-status info">{{ __("DroppedOFF") }}</span>
                                @endif
                            </div>
            
                            <div class="row" style="display:flex;">
                                @if($Booking->status != 4)
                                        @if( ($Booking->status == 1 || $Booking->status == 5) 
                                            && $Booking->drop_off_confirm !=1 
                                            && $Booking->dropoff_date > date('Y-m-d') 
                                        ) <!-- if booking drop off date crosses current date.. do not show assign btn. -->

                                                <div class="inline-block-div mt-3 mr-3"><button class="btn btn-primary" onclick="assignVehicle();">{{ __("Assign") }}</button></div>
                                                <!-- <div class="inline-block-div mt-3 mb-3 mr-3"><button class="btn btn-primary" onclick="changeDates();">{{ __("Change Dates") }}</button></div> -->
                                        
                                        @elseif($Booking->status == 2 )                                        
                                                <div class="inline-block-div mt-3 mr-3"><button class="btn btn-primary" onclick="dropOffVehicle();">{{ __("DropOFF") }}</button></a></div>
                                                <div class="inline-block-div mt-3 mr-3"><button class="btn btn-primary" onclick="changeDropOFF();">{{ __("Change DropOFF Date") }}</button></div>
                                        @endif

                                        @if($Booking->status == 5 && $Booking->drop_off_confirm == 0 )
                                            <div class="inline-block-div mt-3 mr-3"><a href="{{ URL('BookingClose') }}/{{ $Booking->id }}" onClick="return confirmSubmit('Are you sure to close this booking')"><button class="btn btn-danger">{{ __("Close Booking") }}</button></a></div>
                                        @endif
                                        @if($Booking->status == 1)
                                            <div class="inline-block-div mt-3 mr-3"><a href="{{ URL('BookingCancel') }}/{{ $Booking->id }}" onClick="return confirmSubmit('Are you sure to cancel this booking')"><button class="btn btn-danger">{{ __("Cancel Booking") }}</button></a></div>
                                        @endif
                                        <div class="inline-block-div mt-3 right-content" style="flex-grow: 100;">
                                            <a href="{{ URL('/booking/pdf/') }}/{{ $Booking->id }}" target="_blank"><button class="btn btn-primary">{{ __("Print Booking") }}</button></a>
                                        </div>
                                @endif    
                            </div>                
                            <div class="clearfix">&nbsp;</div>

                            <div class="row">
                                <div class="booking-edit-panel" id="assignVehiclePanel">
                                    @if($Booking->status == 1 || $Booking->status == 5)
                                            <div class="card">
                                                    <div class="card-header">
                                                        <h3 style="display:inline-block;">{{ __("Assign Vehicle") }}</h3>
                                                        <button class="btn btn-sm btn-danger" style="float:right;" onclick="hideEditPanels();"><i class="fa fa-times"></i></button>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="assignVehicleForm"  method="POST">
                                                            @csrf
                                                            <div class="row">                            
                                                                <div class="col-lg-2 mb-12">
                                                                    <label>Type <span class="text-danger">*</span></label>
                                                                    <select class="form-control" id="car_type" name="car_type">
                                                                        <option value="">{{ __("-Select-") }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-8 mb-12">
                                                                    <label>Vehicle <span class="text-danger">*</span></label>
                                                                    <select class="form-control" id="VehicleData" name="vehicle_id">
                                                                        <option value="">{{ __("Select") }}</option>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="col-lg-2 mb-3">
                                                                    <label>{{ __("KM Reading at time of pickup") }} <span class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control" required name="km_reading_pickup">
                                                                </div>

                                                                <div class="col-lg-2 mb-3">
                                                                    <label>{{ __("Per day KM Allocation") }} <span class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control" required name="km_allocation" value="{{ $Booking->km_allocation }}">
                                                                </div>
                                                                

                                                                <div class="col-lg-2 mb-3">
                                                                    <label>{{ __("Additional KM Amount") }}<span class="text-danger">*</span></label>
                                                                    <input type="number" name="additional_kilometers_amount" class="form-control number" required value="{{ $Booking->additional_kilometers_amount }}">
                                                                </div>
                                                                

                                                                <div class="col-lg-2 mb-3">
                                                                    <label>{{ __("Advance Amount") }}</label>
                                                                    <input type="number" name="advance_amount" class="form-control number" value="{{ $Booking->advance_amount }}" id="AdvanceAmount" required onblur="fetchReviews()" readonly>
                                                                </div>

                                                                <div class="col-lg-2 mb-3">
                                                                    <label>{{ __("Add advance") }}</label>
                                                                    <input type="number" name="more_advance" class="form-control number" value="0" id="more_advance" min="0" required onblur="fetchReviews()">
                                                                </div>

                                                                <div class="col-lg-2 mb-3">
                                                                    <label>{{ __("Discount") }}<span class="text-danger">*</span></label>
                                                                    <input type="number" name="discount_amount" class="form-control number" id="DiscountAmount" required value="{{ $Booking->discount_amount }}" onblur="fetchReviews()" readonly>
                                                                </div>

                                                                <div class="col-lg-2 mb-3">
                                                                    <label>{{ __("Add discount") }}<span class="text-danger">*</span></label>
                                                                    <input type="number" name="more_discount" class="form-control number" id="more_discount" min="0" required value="0" onblur="fetchReviews()">
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <label>{{ __("Licenses Expiry Date") }}<span class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control number" name="license_expiry_date" value="{{ $Booking->license_expiry_date }}" required min="{{ date('Y-m-d') }}">
                                                                </div>
                                                                
                                                                <div class="col-lg-4 mb-4">
                                                                    <label>{{ __("Residency Card ID") }}<span class="text-danger">*</span></label>
                                                                    <input type="text" name="residency_card_id" class="form-control number" value="{{ $Booking->residency_card_id }}" required>
                                                                </div>

                                                                <div class="col-lg-4 mb-4">
                                                                    <label>{{ __("Residence Expiry Date") }}<span class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control number" name="residence_expiry_date" value="{{ $Booking->residence_expiry_date }}" required min="{{ date('Y-m-d') }}">
                                                                </div>

                                                                <div >
                                                                    <div id="file_car_image">
                                                                        <label>{{ __("Car Image") }} <span class="text-danger">*</span></label>
                                                                        <!-- <label for="subject" class="col-form-label text-dark">{{ __("Car Image") }}</label> -->
                                                                        <input type="file" multiple class="form-control font-style file_input col-lg-4 mb-4" name="car_image[]" 
                                                                                    id="file_car_image_input" capture onchange="showFileSelection(this,'file_car_image')"
                                                                                accept=".jpg,.jpeg,.png" >
                                                                        <div id="file_gallery" class="gallery">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div id="errortext" style="color:red;margin-left:5px;" class="ml-3" hidden>
                                                                <span><i class="fa fa-solid fa-exclamation"></i><span>
                                                                <span id="errortext_p">                                                                    
                                                                </span>
                                                            </div>
                                                            <input type="submit" class="btn btn-success mt-4" value='{{ __("Submit") }}'>
                                                        </form>
                                                    </div>
                                            </div>
                                      </div>
                                    @endif
                                </div>                    
                                <!-- assignVehiclePanel - end -->

                                <div class="booking-edit-panel" id="dropOffVehiclePanel">
                                    <!-- put drop off form here  -->
                                    @if($Booking->status == 2)
                                    <div class="card">
                                                <div class="card-header" >
                                                    <h3 style="display:inline-block;">{{ __("Drop OFF Vehicle") }}</h3>
                                                    <button class="btn btn-sm btn-danger" style="float:right;" onclick="hideEditPanels();"><i class="fa fa-times"></i></button>
                                                </div>
                                                <div class="card-body">
                                                    <form id="dropOffVehicleForm"  method="POST" onSubmit="confirmSubmit">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-4 mb-3">
                                                                    <label class="col-form-label text-dark">{{ __("Current Vehicle") }} <span class="text-danger">*</span></label>
                                                                    <select class="form-control" readonly id="cur_vehicle_id" name="cur_vehicle_id">
                                                                        <option value="{{ $CurrentVehicle->id }}">
                                                                        {{ $CurrentVehicle->car_type }} / {{ $CurrentVehicle->make }}
                                                                        / {{ $CurrentVehicle->model }} / {{ $CurrentVehicle->variant }}
                                                                        / {{ $CurrentVehicle->reg_no }}
                                                                        </option>
                                                                    </select>
                                                                    <!-- <input type="text" class="form-control" name="cur_vehicle_id" readonly  
                                                                        value="{{ $Booking->vehicle_id }}">
                                                                        {{ $Booking->vehicle->make }} / {{ $Booking->vehicle->model }}
                                                                    </input> -->
                                                                </div>
                                                                <div class="col-lg-2 mb-3">
                                                                    <label class="col-form-label text-dark">{{ __("KM at time of Pickup") }} <span class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control" name="km_pick_time" value="{{ $CurrentVehicle->km_reading_pickup }}" readonly>
                                                                </div>                                                                                                                        
                                                                <div class="col-lg-2 mb-3">
                                                                    <label class="col-form-label text-dark">{{ __("KM at time of Drop") }} <span class="text-danger">*</span></label>
                                                                    <input type="number" class="form-control" name="km_drop_time" value="" min="{{ $CurrentVehicle->km_reading_pickup }}">
                                                                </div>                                                                                                                        
                                                                <div class="col-lg-3 mb-3">
                                                                    <label class="col-form-label text-dark">{{ __("Any demage") }} <span class="text-danger">*</span></label><br>
                                                                    <input type="radio" name="dmage" value="0" checked> {{ __("No Damage") }} &nbsp;&nbsp;
                                                                    <input type="radio" name="dmage" value="1"> {{ __("Damage") }}
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label class="col-form-label text-dark">{{ __("Return Notes") }} <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="return_note">
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-check form-check-lg align-vertical-center" style="float: right;">
                                                                        <input class="form-check-input" type="checkbox" value="1" id="confirm_dropoff" name="confirm_dropoff">
                                                                        <label class="form-check-label" for="confirm_dropoff">{{ __("Drop OFF Confirm ?") }}</div>                                                                
                                                                    </div>
                                                                <div class="col-lg-12">
                                                                        <div id="file_damge_image">
                                                                            <label for="subject" class="col-form-label text-dark">{{ __("Image of Car While Drop") }} <span class="text-danger">*</span></label>
                                                                            <input type="file" multiple class="col-lg-4 form-control font-style file_input" name="damge_image[]" 
                                                                                    id="file_damge_image_input" capture onchange="showFileSelection(this,'file_damge_image')"
                                                                                    accept=".jpg,.jpeg,.png" >
                                                                            <div id="file_gallery" class="gallery">
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            <input type="submit" class="btn btn-success mt-4" value='{{ __("Submit") }}'>
                                                    </form>
                                                </div>
                                            </div>
                                    @endif
                                
                                </div>
                                <!-- drop off end -->

                                <div class="booking-edit-panel" id="changeDropOFFPanel">
                                            <div class="card">
                                                    <div class="card-header">
                                                        <h3 style="display:inline-block;">{{ __("Change Reservation Date") }}</h3>
                                                        <button class="btn btn-sm btn-danger" style="float:right;" onclick="hideEditPanels();"><i class="fa fa-times"></i></button>
                                                    </div>
                                                    <div class="card-body">
                                                    <form id="changeDropOFFForm"  method="POST">
                                                            @csrf
                                                            <div class="row">    
                                                                <div class="col-lg-3 mb-4">
                                                                    <label>{{ __("DropOFF Date") }}<span class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control number" name="dropoff_date" id="dropoff_date" value="{{ $Booking->dropOff_date }}" required >
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div id="available_vehicle_types">
                                                                    
                                                                </div>
                                                            </div>
                                                            <input type="submit" class="btn btn-success mt-4" value='{{ __("Submit") }}'>
                                                    </form>
                                                    </div>
                                            </div>
                                      </div>
                                </div>

                                <div class="booking-edit-panel" id="someotherpanel">
                                <!-- put  form here..  -->
                                </div>

                                <!-- booking details starts here -->
                                <div class="row"> 

                                    <div class="col-lg-12">
                                        <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; ">
                                            <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                                                <h2>{{ __("Booking Details") }}</h2>
                                                <div class="row">
                                                    <div class="mt-2 col-lg-4"><b>{{ __("No. of Days") }}</b> {{ $Booking->tarrif_detail }}</div>
                                                    <div class="mt-2 col-lg-4"><b>{{ __("Car Type") }}</b> {{ $Booking->car_type }}</div>
                                                    <div class="mt-2 col-lg-4"><b>{{ __("Location of Pickup") }}</b> {{ $Booking->pickup_location }}</div>
                                                    <div class="mt-2 col-lg-4"><b>{{ __("Date & Time of Pickup") }}</b> {{ date("d F, Y H:i A", strtotime($Booking->pickup_date_time)) }}</div>
                                                    <div class="mt-2 col-lg-4"><b>{{ __("Drop Off Date") }}</b> {{ date("d F, Y ", strtotime($Booking->dropoff_date)) }}</div>
                                                    <div class="mt-2 col-lg-4"><b>{{ __("Per Day KM Allocations") }}</b> {{ $Booking->km_allocation }}</div>
                                                    <!-- <div class="mt-2 col-lg-3"><b>{{ __("KM Reading at time of pickup") }}</b> {{ $Booking->km_reading_pickup }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("KM Reading at Drop Off") }}</b> {{ $Booking->km_drop_time }}</div> -->
                                                    <div class="mt-2 col-lg-4"><b>{{ __("Payment Mode") }}</b> {{ $Booking->payment_mode }}</div>
                                                    <div class="mt-2 col-lg-4"><b>{{ __("Additional Detail") }}</b> {{ $Booking->additional_info }}</div>
                                                </div>
                                                <div class="clearfix">&nbsp;</div>
                                                <div class="row mt-4">
                                                    <h5>{{ __("Vehicle Details") }}</h5>
                                                    <hr/>
                                                        <div  >
                                                            <div class="mt-1" style=" max-height: 250px; overflow:auto;">
                                                            @if($Booking->status == 1)
                                                                <i>{{ __("No Vehicles Assigned") }}</i>
                                                            @else
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{ __("Type") }}</th>
                                                                            <th>{{ __("Make") }}</th>
                                                                            <th>{{ __("Model") }}</th>
                                                                            <th>{{ __("Mfg. Year") }}</th>
                                                                            <th>{{ __("Reg. No.") }}</th>
                                                                            <th>{{ __("Pickup Time") }}</th>
                                                                            <th>{{ __("KM (pickup)") }}</th>
                                                                            <th>{{ __("DropOFF Time") }}</th>
                                                                            <th>{{ __("KM (dropOff)") }}</th>
                                                                            <th>{{ __("KM Driven") }}</th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>                                                                    
                                                                            @foreach($BookingVehicle as $DT)                                                                
                                                                                <tr class="font-style">
                                                                                <td>{{ $DT->car_type }}</td>
                                                                                <td>{{ $DT->make }}</td>
                                                                                <td>{{ $DT->model }}</td>
                                                                                <td>{{ $DT->variant }}</td>
                                                                                <td>{{ $DT->reg_no }}</td>
                                                                                <td>{{ $DT->pickup_date_time }}</td>
                                                                                <td>{{ $DT->km_reading_pickup }}</td>
                                                                                <td>{{ $DT->dropoff_date }}</td>
                                                                                <td>{{ $DT->km_drop_time }}</td>
                                                                                <td>{{ $DT->km_driven }}</td>
                                                                                <td>
                                                                                    <button class="btn btn-primary btn-tiny" onclick="viewVehicleImages({{ $DT->id }});">{{ __("View") }}</button>
                                                                                </td>
                                                                                </tr>
                                                                            @endforeach

                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="clear: both; margin-top: 20px;">&nbsp;</div>

                                    <div class="col-lg-12">
                                        <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                                            <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                                                <!--<h2>{{ $Booking->customer->title }} {{ $Booking->customer->first_name }} {{ $Booking->customer->last_name }}</h2> -->
                                                <h2>{{ $Booking->customer->title }} {{ $Booking->customer->first_name }}</h2>
                                                <div class="row">
                                                    <div class="mt-2 col-lg-3"><b>{{ __("Gender") }}</b> {{ $Booking->customer->gender }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("DOB") }}</b> {{ date("d/m/Y", strtotime($Booking->customer->dob)) }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("Nationality") }}</b> {{ $Booking->customer->nationality }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("Email") }}</b> {{ $Booking->customer->email }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("Mobile") }}</b> {{ $Booking->customer->mobile }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("Insurance Details") }}</b> {{ $Booking->customer->insurance }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("Permanent Address") }}</b> {{ $Booking->customer->permanent_address }}</div>
                                                    <div class="mt-2 col-lg-3"><b>{{ __("Temp Address") }}</b> {{ $Booking->customer->temp_address }}</div>
                                                </div>
                                                <div class="row mt-4">
                                                        <h5>{{ __("Documents") }}</h5>
                                                        <hr/>
                                                    <div class="panel col-lg-3 mb-4">
                                                        <div class="panel-heading">
                                                            <b>{{ __("Resident Card") }}</b>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div id="file_residency_card-gallery" class="gallery">
                                                                @if( array_key_exists('residency_card',$CustImagesArr))
                                                                    @foreach($CustImagesArr['residency_card'] as $CustImg)
                                                                        <!-- <script>console.log({{ $CustImg }});</script> -->
                                                                        <div class="gallery-item">
                                                                            <div class="image">
                                                                                <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                                                                    <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                                                                </a>                        
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="panel col-lg-3 mb-4">
                                                        <div class="panel-heading">
                                                            <b>{{ __("Passport Details") }}</b>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div id="file_passport_detail-gallery" class="gallery">
                                                                @if( array_key_exists('passport_detail',$CustImagesArr))
                                                                    @foreach($CustImagesArr['passport_detail'] as $CustImg)
                                                                        <!-- <script>console.log({{ $CustImg }});</script> -->
                                                                        <div class="gallery-item">
                                                                            <div class="image">
                                                                                <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                                                                    <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                                                                </a>                        
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="panel col-lg-3 mb-4">
                                                        <div class="panel-heading">
                                                            <b>{{ __("Driving License") }}</b>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div id="file_driving_license-gallery" class="gallery">
                                                            @if( array_key_exists('driving_license',$CustImagesArr))
                                                                @foreach($CustImagesArr['driving_license'] as $CustImg)
                                                                    <div class="gallery-item">
                                                                        <div class="image">
                                                                            <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                                                                <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                                                            </a>                        
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel col-lg-3 mb-4">
                                                        <div class="panel-heading">
                                                            <b>{{ __("Visa Detail") }}</b>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div id="file_visa_detail-gallery" class="gallery">
                                                            @if( array_key_exists('visa_detail',$CustImagesArr))
                                                                @foreach($CustImagesArr['visa_detail'] as $CustImg)
                                                                    <!-- <script>console.log({{ $CustImg }});</script> -->
                                                                    <div class="gallery-item">
                                                                        <div class="image">
                                                                            <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                                                                <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                                                            </a>                        
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="clear: both; margin-top: 20px;">&nbsp;</div>

                                    @if( $Booking->status == 1 || $Booking->status == 2 || ($Booking->status == 5 && $Booking->drop_off_confirm == 0))
                                    <div class="col-lg-12">
                                        <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
                                            <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                                                <h2>{{ __("Tentative Billable Amount") }}</h2>
                                                <div class="mt-4"><b>{{ __("Rental") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->total, 2) }}</div>
                                                <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
                                                <div class="mt-2"><b>{{ __("Additional KM Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(($Booking->additional_km_reunning * $Booking->additional_kilometers_amount), 2) }}</div>
                                                <div class="mt-2"><b>{{ __("Additional Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->additional_charges, 2) }}</div>
                                                <div class="mt-2"><b>{{ __("Sub Total") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
                                                @if($Booking->sub_total < 0)
                                                <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(0, 2) }}</div>
                                                @else
                                                <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(((($Booking->sub_total) * $Booking->tax_percentage) / 100), 2) }}</div>
                                                @endif
                                                <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
                                                <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format($Booking->grand_total, 2) }}</b> </div>
                                                <div class="mt-2"><b>{{ __("Due") }} : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
                                                <div class="mt-2"><b><span style="float:left; font-style:italic; color:red;">{{ __("*The above value may change at the time of vehicle return") }}</span> </b> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear: both; margin-top: 20px;">&nbsp;</div>
                                    @endif
                                </div>
                                </div>
                                <!-- <div class="panel card-body col-lg-12 mb-4 mt-4">
                                    <div class="panel-heading">
                                        <b>{{ __("Car Image (Assign)") }}</b>
                                    </div>
                                    <div class="panel-body">
                                    <div id="file_car_image-gallery" class="gallery">
                                        @if( array_key_exists('car_image',$BookingImagesArr))
                                            @foreach($BookingImagesArr['car_image'] as $BookingImg)
                                                <div class="gallery-item">
                                                    <div class="image">
                                                        <a href="{{ URL('public') }}/{{ $BookingImg }}" target="_blank">
                                                            <img src="{{ URL('public') }}/{{ $BookingImg }}" style="max-width: 100%">
                                                        </a>                        
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif 
                                    </div>
                                </div> -->

                                @if(Session::has('Danger'))
                                <div class="alert alert-danger" role="alert">
                                    <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                                    <div class="alert-text">{!!Session::get('Danger')!!}</div>
                                </div>
                                @endif

                                    @if($Booking->status == 5 && $Booking->drop_off_confirm == 1 )
                                        <div id="completeBookingPanel" class="row">
                                        <h2>{{ __("Complete Booking") }}</h2>
                                        {!! Form::open(['id' => 'completeBookingForm', 'url' => 'booking/completeBooking', 'enctype' => 'multipart/form-data', "onSubmit" => "return confirmSubmit('Are you sure you want to close the booking')", 'method' => 'POST']) !!}
                                            <div class="row">
                                                <div class="col-lg-4 mb-4">
                                                    <div class="mb-2">
                                                        <label>{{ __("Total") }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="total" readonly required value="{{ $Booking->total }}" id="total">
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label>{{ __("Additional KM Charges") }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="additional_km_charges" readonly required value="" id="additional_km_charges">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>{{ __("Extra KM") }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="additional_km_reunning" readonly required value="{{ $Booking->additional_km_reunning }}" id="additional_km_reunning	">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>{{ __("Additional Charges (Damage,Penalty,etc.)") }} <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="additional_charges" required value="{{ $Booking->additional_charges }}" id="additional_charges">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>{{ __("Sub Total") }}<span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="sub_total" readonly required value="{{ $Booking->sub_total }}" id="sub_total">
                                                    </div>
                                                    <div class="row mb-2 ">
                                                        <div class="col-lg-4">
                                                            <label>{{ __("Discount Applied") }} <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" name="discount_amount" readonly value="{{ $Booking->discount_amount }}" id="discount_amount">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label>{{ __("More Discount") }} <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" name="more_discount" min="0" value="0" id="more_discount">
                                                        </div>
                                                        <div class="col-lg-4 ">
                                                            <div class="form-check align-vertical-center">
                                                                <label for="waive_100per">{{ __("Waive 100%") }}</label>
                                                                <input class="form-check-input" type="checkbox" id="waive_100per" name="waive_100per">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>{{ __("VAT") }}(5%) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="vat" readonly required value="" id="vat">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>{{ __("Grand Total") }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="grand_total" readonly required value="{{ $Booking->grand_total }}" id="grand_total">
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-lg-6">
                                                            <label>{{ __("Advance Paid") }} <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" name="advance_amount" value="{{ $Booking->advance_amount }} "readonly required value="" id="advance_amount">                                                        
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label>{{ __("Discount Note") }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="discount_note" value="" id="discount_note">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label class="mt-4">{{ __("Final Amount") }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="final_amount_paid" readonly required value="" id="final_amount_paid">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary btn-block mb-4" value="{{ __('Close Booking') }}">
                                            <!-- <button class="btn btn-success mt-4">{{ __("Close Booking") }}</button> -->
                                        {!! Form::close() !!}                                    
                                            <script>
                                                var extraKM = {{ $Booking->additional_km_reunning }} ;
                                                var tariff = {{ $Booking->additional_kilometers_amount }};
                                                $('#additional_km_charges').val((extraKM * tariff).toFixed(2));

                                                var final_amount_paid = {{ $Booking->grand_total - $Booking->advance_amount }}
                                                $('#final_amount_paid').val(final_amount_paid.toFixed(2));

                                                var subtotal = {{ $Booking->sub_total }}
                                                $('#vat').val((subtotal * .05).toFixed(2));

                                                var advance_amt = {{ $Booking->advance_amount }};
                                                $('#advance_amount').val(advance_amt);

                                                $('#additional_charges').on('input', function(event) {
                                                    computeBilling();
                                                });

                                                $('#completeBookingPanel #more_discount').on('input', function(event) {
                                                    computeBilling();
                                                });

                                                $('#waive_100per').on('change', function(event){
                                                    if ($(this).is(':checked')) {
                                                        var subtotal = {{ $Booking->sub_total }};
                                                        var advancepaid = {{ $Booking->advance_amount }};
                                                        var additional_charges = parseFloat($('#additional_charges').val());
                                                        
                                                        var full_discount = subtotal + additional_charges;

                                                        $('#additional_charges').attr('readonly',true);
                                                        $('#completeBookingPanel #more_discount').val(full_discount.toFixed(2));
                                                        $('#completeBookingPanel #more_discount').attr('readonly',true);
                                                        computeBilling();
                                                    } else {
                                                        $('#additional_charges').attr('readonly',false);
                                                        $('#completeBookingPanel #more_discount').val(0);
                                                        $('#completeBookingPanel #more_discount').attr('readonly',false);
                                                        computeBilling();
                                                    }
                                                });
                                           
                                                function computeBilling(){
                                                    console.log("inside compute billing");
                                                    var subtotal = {{ $Booking->sub_total }};
                                                    
                                                    var advancepaid = {{ $Booking->advance_amount }}
                                                    var additional_charges = parseFloat($('#additional_charges').val());
                                                    var more_discount = parseFloat($('#completeBookingPanel #more_discount').val());

                                                    if(isNaN(additional_charges)){
                                                        additional_charges = 0;
                                                    }
                                                    if(isNaN(more_discount)){
                                                        more_discount = 0;
                                                    }
                                                    console.log("additional_charges - " + additional_charges);
                                                    console.log("more_discount - " + more_discount);

                                                    subtotal = subtotal + additional_charges - more_discount;
                                                    console.log("subtotal - " + subtotal);
                                                    var vat = (subtotal * 0.05);
                                                    var grandtotal = subtotal + vat;

                                                    var final_amount_paid = grandtotal - advancepaid

                                                    $('#completeBookingPanel #sub_total').val(subtotal.toFixed(2));
                                                    $('#completeBookingPanel #vat').val(vat.toFixed(2));
                                                    $('#completeBookingPanel #grand_total').val(grandtotal.toFixed(2));
                                                    $('#final_amount_paid').val(final_amount_paid.toFixed(2));
                                                }
                                            </script>
                                    </div>
                                    @endif

                                    @if($Booking->status == 3)
                                    </div> 

                                        <div class="card mt-5">
                                            <div class="card-body">
                                                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                                                    <h2>{{ __("Payment Details") }}</h2>
                                                    <div class="mt-4"><b>{{ __("Rental") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->total, 2) }}</div>
                                                    <div class="mt-2"><b>{{ __("Additional KM Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(($Booking->additional_km_reunning * $Booking->additional_kilometers_amount), 2) }}</div>
                                                    <div class="mt-2"><b>{{ __("Additional Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->additional_charges, 2) }}</div>
                                                    <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
                                                    <div class="mt-2"><b>{{ __("Sub Total") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
                                                    @if($Booking->sub_total < 0)
                                                    <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(0, 2) }}</div>
                                                    @else
                                                    <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(((($Booking->sub_total) * $Booking->tax_percentage) / 100), 2) }}</div>
                                                    @endif
                                                    <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format($Booking->grand_total , 2) }}</b> </div>
                                                    <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                                            <div style="flex: 1 1 auto; padding: 1rem 1rem;">

                                            <h3>{{ __("Drop off Details") }}</h3>
                                            
                                            <div><b>{{ __("Final Amount Paid") }} :</b> OMR {{ number_format($Booking->final_amount_paid, 2 )}}</div>
                                            <!-- @if($Booking->damge_image != "")
                                            <div class="mt-3">
                                                <b>{{ __("Car Image") }}</b>
                                                <a href="{{ URL('public') }}/{{ $Booking->damge_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->damge_image }}" style="max-width: 100px"></a>
                                            </div>
                                            @endif -->
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endif


                                    <div class="clearfix">&nbsp;</div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="clearfix">&nbsp;</div>

                                <!-- <div class="mt-3 mb-3 mr-3">
                                    <a href="{{ URL('/booking/email/') }}/{{ $Booking->id }}"><button class="btn btn-primary"  style="float:right;margin-right:5px;">{{ __("Send Email Again") }}</button></a>
                                </div> -->
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
    <!-- [ Main Content ] end -->

<div class="modal fade" id="booking-images-gallery" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Booking vehicle images</h5>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ URL('public') }}/logo.png" style="width:400px; height: auto;object-fit:cont;" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img src="{{ URL('public') }}/img2.png" style="width:400px; height: auto;object-fit:cont;" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="{{ URL('public') }}/speedy.png" style="width:400px; height: auto;object-fit:cont;" alt="Image 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- for image gallery -->
<div id="booking-img">

</div>

<script>

    function CalDis(){
        Disc = parseInt($("#discount_amount").val());
        if(Disc > 0){
            $("#disNotBox").css("display", "block");
        }else{
            $("#disNotBox").css("display", "none");
        }
    }
    
    function confirmSubmit( msg){
        if(confirm(msg)){
            return true;
        }
        
        return false;
    }

    function viewVehicleImages(booking_vehicle_id){
        console.log(booking_vehicle_id);

        var formdata = new FormData();
        formdata.append("booking_id", {{ $Booking->id }});
        formdata.append("booking_vehicle_id",booking_vehicle_id);

        // $('#booking-images-gallery').modal('show');

        $.ajax({
                url: "{{ URL('Booking/GetBookingVehicleImages') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                data: formdata,
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 0){
                        alert(JsData.Message);
                    } else {
                        const imagePreviewModal = new ImagePreviewModal("booking-img",JsData.Data.BookingImagesArr);
                        imagePreviewModal.show();
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to get images. Error:"+jqXHR.status);
                    // onFailure({
                    //     "Status":jqXHR.status
                    //     ,"Message":jqXHR.statusText
                    // });
                }              
        });

    }

    function assignVehicle(){
        $('.booking-edit-panel').css("display","none");
        

        @if($Booking->pickup_date_time > date('Y-m-d H:i:s', strtotime('+4 hour')))
        //    alert("To Assign Vehicle, Pickup Date Should Be Today's Date, Still You Can Proceed, It Will Update Pickup As Today's Date")
           alert("You are assigning vehicle before the scheduled pickup date. Billing will be adjusted accordingly.")
        @endif

        console.log("{{ $Booking->residency_card_id }}");
        
        $('#assignVehicleForm #car_type').on("change", function(event){
            console.log(event);
            var formdata = new FormData();
            formdata.append("car_type",$(this).val())
            formdata.append("booking_id", {{ $Booking->id }});
            $.ajax({
                    url: "{{ URL('Booking/GetAvailableVehicles') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Set the content type to false to let the server handle it
                    data: formdata,
                    success: function( data, textStatus, jqXHR ) {
                        JsData = JSON.parse(data);
                        console.log(JsData);
                        if(JsData.Status == 0){
                            alert("Available vehicles info is not available.")
                        } else {
                            var select = $('#assignVehicleForm #VehicleData');
                            select.html('');
                            var opt = document.createElement('option');
                            opt.value = "";
                            opt.innerHTML = '--Select Vehicle--';
                            select.append(opt);

                            JsData.Data.forEach(function(item, index, array) {
                                console.log(`Item at index ${index} is `);
                                console.log(item);
                                var opt = document.createElement('option');
                                opt.value = item.id
                                opt.innerHTML = item.car_type+" / "+item.make+" / "+item.model+" / "+item.variant+" / "+item.reg_no;
                                select.append(opt);
                            });
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ) {
                        console.error("Fail to get images. Error:"+jqXHR.status);
                        // onFailure({
                        //     "Status":jqXHR.status
                        //     ,"Message":jqXHR.statusText
                        // });
                    }              
            });
        });

        //get available vehicles types
        var formdata = new FormData();
        $.ajax({
                url: "{{ URL('Vehicle/GetAllCarTypes') }}",
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 0){
                        alert("Available vehicles type info is not available.")
                    } else {
                        console.log(JsData.Data);
                        var select = $('#assignVehicleForm #car_type');
                        select.html('');
                        var opt = document.createElement('option');
                        opt.value = ""
                        opt.innerHTML = "-All-";
                        select.append(opt);

                        const keys = Object.keys(JsData.Data);
                        for (const key of keys) {
                            console.log(key);
                            var opt = document.createElement('option');
                            opt.value = key
                            opt.innerHTML = key;
                            select.append(opt);
                        };

                        select.val('{{ $Booking->car_type }}'); //set current value.. 
                        // const event = new Event('change', { bubbles: true });
                        select.trigger('change');
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to get info. Error:"+jqXHR.status);
                    // onFailure({
                    //     "Status":jqXHR.status
                    //     ,"Message":jqXHR.statusText
                    // });
                }              
        });
            
        //getAvailableVehicleTypes----------------------------

        console.log("{{ $Booking->car_type }}");

        //get available vehicles
        $("#assignVehiclePanel").fadeIn(200); // 200 milliseconds (1 second) animation
    }

    function dropOffVehicle(){
        @if($Booking->dropoff_date > date('Y-m-d H:i:s', strtotime('+4 hour')))
           //alert("To Droff Off Vehicle, Droff Off Date Should Be Todays Date.");
           alert("You are dropping off vehicle prior to scheduled drop off date. Billing will be adjusted accordingly. Kindly use additional charge field at billing time to adjust for any penalties. ");
        @endif

        $('.booking-edit-panel').css("display","none");
        $("#dropOffVehiclePanel").fadeIn(200); // 200 milliseconds (1 second) animation
    }

    function changeDropOFF(){
        $('.booking-edit-panel').css("display","none");
        
        console.log("{{ $Booking->pickup_date_time }}".slice(0,10));
        console.log("{{ $Booking->dropoff_date }}");
        $('#pickup_date').val("{{ $Booking->pickup_date_time }}".slice(0,10));
        $('#dropoff_date').val("{{ $Booking->dropoff_date }}".slice(0,10));
        $('#dropoff_date').attr("min","{{ $Booking->pickup_date_time }}".slice(0,10));
        $("#changeDropOFFPanel").fadeIn(200); // 200 milliseconds (1 second) animation
    }

    function hideEditPanels(){
        $('.booking-edit-panel').css("display","none");
    }

    $('#assignVehicleForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            showloading();

            var formdata = new FormData(this);
            formdata.append("booking_id",{{ $Booking->id }});
            console.log(formDataToJson(formdata));

            $.ajax({
                url: "{{ URL('Booking/assignVehicle') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                data: formdata,
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 1){
                        toastr["success"](JsData.Message);
                        window.location.reload();
                    } else {
                        hideloading();
                        alert(JsData.Message);
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to get images. Error:"+jqXHR.status);
                    hideloading();
                    toastr["error"](jqXHR.statusText);
                }              
            });
        }
    );

    $('#dropOffVehicleForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            showloading();

            var formdata = new FormData(this);
            formdata.append("booking_id",{{ $Booking->id }});
            console.log(formDataToJson(formdata));

            $.ajax({
                url: "{{ URL('Booking/dropOffVehicle') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                data: formdata,
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 1){
                        toastr["success"](JsData.Message);
                        window.location.reload();
                    } else {
                        hideloading();
                        alert(JsData.Message);
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to get images. Error:"+jqXHR.status);
                    hideloading();
                    toastr["error"](jqXHR.statusText);
                }              
            });
    });

    $('#completeBookingForm').submit(function(event){
        event.preventDefault();
        //alert("complete booking");
        showloading();

        var formdata = new FormData(event.target);
        formdata.append("booking_id",{{ $Booking->id }});
        console.log(formDataToJson(formdata));

        $.ajax({
                url: "{{ URL('Booking/completeBooking') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                data: formdata,
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 1){
                        toastr["success"](JsData.Message);
                        window.location.reload();
                    } else {
                        hideloading();
                        alert(JsData.Message);
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to get images. Error:"+jqXHR.status);
                    hideloading();
                    alert(jqXHR.statusText);
                }              
        });
    });

    $("#changeDropOFFForm").submit(function(){
        event.preventDefault();
        //alert("complete booking");
        showloading();

        var formdata = new FormData(event.target);
        formdata.append("booking_id",{{ $Booking->id }});
        console.log(formDataToJson(formdata));

        $.ajax({
                url: "{{ URL('Booking/changeDropOFF') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                data: formdata,
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 1){
                        toastr["success"](JsData.Message);
                        window.location.reload();
                    } else {
                        toastr["error"](JsData.Message);
                    }
                    // hideloading();
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to do operation. Error:"+jqXHR.status);
                    hideloading();
                    alert(jqXHR.statusText);
                }              
        });
    });
</script>

@if($Booking->status == 5 && $Booking->drop_off_confirm == 1)
<script>
    var targetOffset = $("#completeBookingPanel").offset().top;
    // Scroll to the target div
    $("html, body").animate({ scrollTop: targetOffset }, 1000);
</script>
@endif


@endsection