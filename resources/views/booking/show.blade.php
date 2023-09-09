@extends("layout.default")

@section("content")
<script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>

<!-- [ Main Content ] start -->
<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">{{ __("Show Booking Data") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Show Booking Data") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">

        
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    <div class="row">

                    <h1>{{ __("Booking Details") }} : #{{ $Booking->id }}</h1>

<div style="float: left; width: 45%;">
    <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
        <div style="flex: 1 1 auto; padding: 1rem 1rem;">
            <!--<h2>{{ $Booking->customer->title }} {{ $Booking->customer->first_name }} {{ $Booking->customer->last_name }}</h2> -->
            <h2>{{ $Booking->customer->title }} {{ $Booking->customer->first_name }}</h2>
            <div class="mt-4"><b>{{ __("Gender") }}</b> {{ $Booking->customer->gender }}</div>
            <div class="mt-2"><b>{{ __("DOB") }}</b> {{ date("d/m/Y", strtotime($Booking->customer->dob)) }}</div>
            <div class="mt-2"><b>{{ __("Nationality") }}</b> {{ $Booking->customer->nationality }}</div>
            <div class="mt-2"><b>{{ __("Email") }}</b> {{ $Booking->customer->email }}</div>
            <div class="mt-2"><b>{{ __("Mobile") }}</b> {{ $Booking->customer->mobile }}</div>
            <div class="mt-2"><b>{{ __("Insurance Details") }}</b> {{ $Booking->customer->insurance }}</div>
            <div class="mt-2"><b>{{ __("Permanent Address") }}</b> {{ $Booking->customer->permanent_address }}</div>
            <div class="mt-2"><b>{{ __("Temp Address") }}</b> {{ $Booking->customer->temp_address }}</div>
        </div>
    </div>
</div>

<div style="float: left; margin-left: 5%; width: 45%;">
    <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
        <div style="flex: 1 1 auto; padding: 1rem 1rem;">
            <h2>{{ __("Vehicle Details") }}</h2>
            <div class="mt-4"><b>{{ __("Car Type") }}</b> {{ $Booking->car_type }}</div>
            <div class="mt-2"><b>{{ __("Make") }}</b> {{ @$Booking->vehicle->make }}</div>
            <div class="mt-2"><b>{{ __("Model") }}</b> {{ @$Booking->vehicle->model }}</div>
            <div class="mt-2"><b>{{ __("Variant") }}</b> {{ @$Booking->vehicle->variant }}</div>
            <div class="mt-2"><b>{{ __("Chasis Number") }}</b> {{ @$Booking->vehicle->chasis_no }}</div>
            <div class="mt-2"><b>{{ __("Registration Number") }}</b> {{ @$Booking->vehicle->reg_no }}</div>
            <div class="mt-2"><b>{{ __("AC") }}</b> {{ @$Booking->vehicle->ac }}</div>
            <div class="mt-2"><b>{{ __("Audio") }}</b> {{ @$Booking->vehicle->audio }}</div>
            <div class="mt-2"><b>{{ __("GPS") }}</b> {{ @$Booking->vehicle->gps }}</div>
            <div class="mt-2"><b>{{ __("Insurance Details") }}</b> {{ @$Booking->vehicle->insurance_detail }}</div>
        </div>
    </div>
</div>

<div style="clear: both; margin-top: 40px;">&nbsp;</div>

<div style="float: left; width: 45%;">
    <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 350px;">
        <div style="flex: 1 1 auto; padding: 1rem 1rem;">
            <h2>{{ __("Booking Details") }}</h2>
          <!--  <div class="mt-4"><b>{{ __("Tarrif") }}</b> {{ $Booking->tarrif_type }}</div>  -->
            <div class="mt-2"><b>{{ __("No. of Days") }}</b> {{ $Booking->tarrif_detail }}</div>
            <div class="mt-2"><b>{{ __("Per Day KM Allocations") }}</b> {{ $Booking->km_allocation }}</div>
            <div class="mt-2"><b>{{ __("Date & Time of Pickup") }}</b> {{ date("d F, Y H:i A", strtotime($Booking->pickup_date_time)) }}</div>
            <div class="mt-2"><b>{{ __("Drop Off Date") }}</b> {{ date("d F, Y", strtotime($Booking->dropoff_date)) }}</div>
            <div class="mt-2"><b>{{ __("Location of Pickup") }}</b> {{ $Booking->pickup_location }}</div>
            <div class="mt-2"><b>{{ __("KM Reading at time of pickup") }}</b> {{ $Booking->km_reading_pickup }}</div>
            <div class="mt-2"><b>{{ __("Payment Mode") }}</b> {{ $Booking->payment_mode }}</div>
            <div class="mt-2"><b>{{ __("Additional Detail") }}</b> {{ $Booking->additional_info }}</div>
        </div>
    </div>
</div>

<div style="float: left; margin-left: 5%; width: 45%;">
    <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 350px;">
        <div style="flex: 1 1 auto; padding: 1rem 1rem;">
            <h2>{{ __("Payment Details") }}</h2>
            <div class="mt-4"><b>{{ __("Sub Total") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
            <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format((($Booking->sub_total * $Booking->tax_percentage) / 100), 2) }}</div>
            <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
            <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
            <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
        </div>
    </div>
</div>

<div style="clear: both; margin-top: 40px;">&nbsp;</div>


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
    <div id="file_residency_card-gallery" class="gallery">
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
        <b>{{ __("Driving Licence") }}</b>
    </div>
    <div class="panel-body">
    <div id="file_residency_card-gallery" class="gallery">
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
    <div id="file_residency_card-gallery" class="gallery">
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

<!-- @if($Booking->car_image != "")
<div style="float: left; width: 19%; margin-right: 1%; margin-bottom: 10px;">
    <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
        <div style="flex: 1 1 auto; padding: 1rem 1rem;">
            <b>{{ __("Car Image") }}</b>
            <a href="{{ URL('public') }}/{{ $Booking->car_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->car_image }}" style="max-width: 100%"></a>
        </div>
    </div>
</div>
@endif -->

    @if($Booking->status == 2)
    <div class="panel card-body col-lg-12 mb-4 mt-4">
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
           </div>
    </div>
    @endif 


<div class="clearfix"></div>



<div class="card">
    <div class="card-body">
        <div style="flex: 1 1 auto; padding: 1rem 1rem;">
            <h2>{{ __("Payment Details") }}</h2>
            <div class="mt-4"><b>{{ __("Sub Total") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
            <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format((($Booking->sub_total * $Booking->tax_percentage) / 100), 2) }}</div>
            <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
            <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
            <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
        </div>
    </div>
</div>




@if($Booking->status == 0)
<div class="card">
<div class="card-body">
    <h3>{{ __("Drop off Detail") }}</h3>
    
    <div><b>{{ __("KM at time of Drop Off") }} :</b> {{ $Booking->km_drop_time }}</div>
    <div><b>{{ __("Dmage") }} :</b> {{ ($Booking->dmage == 0) ? "No Damage" : "Damage" }}</div>
    <div><b>{{ __("Final Amount Paid") }} :</b> OMR {{ number_format($Booking->final_amount_paid, 2) }}</div>
    <div class="mt-3">
        <b>{{ __("Car Image") }}</b>
        <a href="{{ URL('public') }}/{{ $Booking->damge_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->damge_image }}" style="max-width: 100px"></a>
    </div>
</div>
</div>
@endif







    
    

@if($Booking->status != 0)
    
    <div class="card">
        <div class="card-body">
            <h1>{{ __("Assign Vehicle") }}</h1>
    {!! Form::open(['url' => 'booking/'.$Booking->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    
    <div class="row">
        
    <div class="col-lg-9 mb-12">
        <label>Vehicle <span class="text-danger">*</span></label>
        <select class="form-control h-auto" required id="VehicleData" name="vehicle_id">
            <option value="">{{ __("Select") }}</option>
            @foreach($AllVehicles as $ALV)
                <option value="{{ $ALV->id }}">{{ $ALV->car_type }} - {{ $ALV->make }}/{{ $ALV->model }}/{{ $ALV->variant }}/{{ $ALV->reg_no }}</option>
            @endforeach
        </select>
    </div>
    
                <div class="col-lg-3 mb-3">
                    <label>{{ __("KM Reading at time of pickup") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control h-auto" required name="km_reading_pickup">
                </div>

                <div class="col-lg-3 mb-3">
                    <label>{{ __("Per day KM Allocation") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control h-auto" required name="km_allocation" value="{{ $Booking->km_allocation }}">
                </div>
                
    
                <div class="col-lg-3 mb-3">
                    <label>{{ __("Additional KM Amount") }}<span class="text-danger">*</span></label>
                    <input type="text" name="additional_kilometers_amount" class="form-control h-auto number" required value="{{ $Booking->additional_kilometers_amount }}">
                </div>
                

                <div class="col-lg-3 mb-3">
                    <label>{{ __("Advance Amount") }}</label>
                    <input type="text" name="advance_amount" class="form-control h-auto number" value="0" id="AdvaneAmount" required onblur="fetchReviews()">
                </div>

                <div class="col-lg-3 mb-3">
                    <label>{{ __("Discount") }}<span class="text-danger">*</span></label>
                    <input type="text" name="discount_amount" class="form-control h-auto number" id="DiscountAmount" required value="{{ $Booking->discount_amount }}" onblur="fetchReviews()">
                </div>
                

                                
                <div class="col-lg-4 mb-4">
                    <label>{{ __("Licenses Expiry Date") }}<span class="text-danger">*</span></label>
                    <input type="date" class="form-control h-auto number" name="license_expiry_date" value="{{ $Booking->license_expiry_date }}" required min="{{ date('Y-m-d', strtotime('+3 months')) }}">
                </div>
                
                <div class="col-lg-4 mb-4">
                    <label>{{ __("Residency Card ID") }}<span class="text-danger">*</span></label>
                    <input type="text" name="residency_card_id" class="form-control h-auto number" required>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Residence Expiry Date") }}<span class="text-danger">*</span></label>
                    <input type="date" class="form-control h-auto number" name="residence_expiry_date" value="{{ $Booking->residence_expiry_date }}" required min="{{ date('Y-m-d') }}">
                </div>

                <!-- <div class="col-lg-4 mb-4">
                    <label>{{ __("Car Image") }} <span class="text-danger">*</span></label>
                    <input type="file" class="form-control h-auto" required name="car_image">
                </div> -->
                <div >
                    <div id="file_car_image">
                        <label for="subject" class="col-form-label text-dark">{{ __("Car Image") }}</label>
                        <input type="file" multiple class="form-control font-style file_input col-lg-4 mb-4" name="car_image[]" 
                                    id="file_car_image_input" capture onchange="showFileSelection(this,'file_car_image')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        </div>
                    </div>
                </div>

    </div>
    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
    </div>
    </div>

    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    @endif

                    </div>
                </div>
            </div>
        </div>



    </div>



    <!-- [ Main Content ] end -->
    </div>
</div>

<script>
    function CalDis(){
        Disc = $("#discount_amount").val();
        Final = $("#final_amount_paid").val();
        Additional = $("#additioanl_amount").val();
        total = (parseFloat(Final) + parseFloat(Additional)) - parseFloat(Disc);
        $("#final_amount_paid").val(total);
    }
</script>

@endsection