@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Edit Booking Data") }}</h2>
            </div>

            <div><a href="{{ URL('booking') }}"><button class="btn btn-primary">{{ __("Go Back") }}</button></a></div>
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
        
        <div class="float-left"><h1>{{ __("Booking Details") }} : #{{ $Booking->id }}</h1></div>
        
        @if($Booking->status != 4)
            @if($Booking->pickup_date_time > date("Y-m-d H:i:s") && $Booking->status != 3)
            <div class="float-right"><a href="{{ URL('booking') }}/{{ $Booking->id }}"><button class="btn btn-success">Assign Vehicle</button></a></div>
            @endif
            
            @if($Booking->status == 1)
            <div class="float-right mr-5"><a href="{{ URL('BookingCancel') }}/{{ $Booking->id }}" onClick="return cancelBooking()"><button class="btn btn-danger">Cancel Booking</button></a></div>
            @endif
        @endif
        
        <div class="clearfix"></div>

        <div style="float: left; width: 45%;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>{{ $Booking->customer->title }} {{ $Booking->customer->first_name }} {{ $Booking->customer->last_name }}</h2>
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
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>{{ __("Booking Details") }}</h2>
                    <div class="mt-4"><b>{{ __("Tarrif") }}</b> {{ $Booking->tarrif_type }}</div>
                    <div class="mt-2"><b>{{ __("No. of Days") }}</b> {{ $Booking->tarrif_detail }}</div>
                    <div class="mt-2"><b>{{ __("Per Day KM Allocations") }}</b> {{ $Booking->km_allocation }}</div>
                    <div class="mt-2"><b>{{ __("Date & Time of Pickup") }}</b> {{ date("d F, Y H:i A", strtotime($Booking->pickup_date_time)) }}</div>
                    <div class="mt-2"><b>{{ __("Drop Off Date") }}</b> {{ date("d F, Y", strtotime($Booking->dropoff_date)) }}</div>
                    <div class="mt-2"><b>{{ __("Location of Pickup") }}</b> {{ $Booking->pickup_location }}</div>
                    <div class="mt-2"><b>{{ __("KM Reading at time of pickup") }}</b> {{ $Booking->km_reading_pickup }}</div>
                    <div class="mt-2"><b>{{ __("KM Reading at Drop Off") }}</b> {{ $Booking->km_drop_time }}</div>
                    <div class="mt-2"><b>{{ __("Payment Mode") }}</b> {{ $Booking->payment_mode }}</div>
                    <div class="mt-2"><b>{{ __("Additional Detail") }}</b> {{ $Booking->additional_info }}</div>
                </div>
            </div>
        </div>

        <div style="float: left; margin-left: 5%; width: 45%;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>{{ __("Payment Details") }}</h2>
                    <div class="mt-4"><b>{{ __("Sub Total") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
                    <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(((($Booking->sub_total-$Booking->discount_amount) * $Booking->tax_percentage) / 100), 2) }}</div>
                    <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
                    <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
                    <div class="mt-2"><b>{{ __("Additional KM") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(($Booking->additional_km_reunning * $Booking->additional_kilometers_amount), 2) }}</div>
                    <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
                </div>
            </div>
        </div>

        <div style="clear: both; margin-top: 40px;">&nbsp;</div>
        
        @if($Booking->customer->residency_card != "")
        <div style="float: left; width: 19%; margin-right: 1%; margin-bottom: 10px;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <b>{{ __("Resident Card") }}</b>
                    <a href="{{ URL('public') }}/{{ $Booking->customer->residency_card }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->customer->residency_card }}" style="max-width: 100%"></a>
                </div>
            </div>
        </div>
        @endif
        
        @if($Booking->customer->passport_detail != "")
        <div style="float: left; width: 19%; margin-right: 1%; margin-bottom: 10px;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <b>{{ __("Passport Details") }}</b>
                    <a href="{{ URL('public') }}/{{ $Booking->customer->passport_detail }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->customer->passport_detail }}" style="max-width: 100%"></a>
                </div>
            </div>
        </div>
        @endif
        
        @if($Booking->customer->driving_license != "")
        <div style="float: left; width: 19%; margin-right: 1%; margin-bottom: 10px;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <b>{{ __("Driving License") }}</b>
                    <a href="{{ URL('public') }}/{{ $Booking->customer->driving_license }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->customer->driving_license }}" style="max-width: 100%"></a>
                </div>
            </div>
        </div>
        @endif
        
        @if($Booking->customer->visa_detail != "")
        <div style="float: left; width: 19%; margin-right: 1%; margin-bottom: 10px;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <b>{{ __("Visa") }}</b>
                    <a href="{{ URL('public') }}/{{ $Booking->customer->visa_detail }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->customer->visa_detail }}" style="max-width: 100%"></a>
                </div>
            </div>
        </div>
        @endif
        
        @if($Booking->car_image != "")
        <div style="float: left; width: 19%; margin-right: 1%; margin-bottom: 10px;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <b>{{ __("Car Image") }}</b>
                    <a href="{{ URL('public') }}/{{ $Booking->car_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->car_image }}" style="max-width: 100%"></a>
                </div>
            </div>
        </div>
        @endif

        <div class="clearfix"></div>


    @if(Session::has('Danger'))
    <div class="alert alert-danger" role="alert">
        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
        <div class="alert-text">{!!Session::get('Danger')!!}</div>
    </div>
    @endif
    
    @if($Booking->status == 3)
    <div class="card">
        <div class="card-body">
            <h3>{{ __("Drop off Detail") }}</h3>
            
            <div><b>{{ __("KM at time of Drop Off") }} :</b> {{ $Booking->km_drop_time }}</div>
            <div><b>{{ __("Dmage") }} :</b> {{ ($Booking->dmage == 0) ? "No Damage" : "Damage" }}</div>
            <div><b>{{ __("Final Amount Paid") }} :</b> OMR {{ $Booking->final_amount_paid }}</div>
            @if($Booking->damge_image != "")
            <div class="mt-3">
                <b>{{ __("Car Image") }}</b>
                <a href="{{ URL('public') }}/{{ $Booking->damge_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Booking->damge_image }}" style="max-width: 100px"></a>
            </div>
            @endif
        </div>
    </div>
    @endif

    @if($Booking->status != 3 && $Booking->status != 4)
    
    @if($Booking->drop_off_confirm == 0 && $Booking->status == 2)
    <div class="card">
        <div class="card-body">
    {!! Form::open(['url' => 'BookingExceed/'.$Booking->id, 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-lg-6">
            <label>{{ __("Drop off Date") }} <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="dropoff_date" value="{{ date('Y-m-d', strtotime($Booking->dropoff_date)) }}" min="{{ date('Y-m-d', strtotime($Booking->dropoff_date)) }}" required>
        </div>
        
        <div class="col-lg-6">
            <label>{{ __("Drop off Time") }} <span class="text-danger">*</span></label>
            <input type="time" class="form-control" name="dropoff_time" min="{{ date('H:i:s') }}" value="{{ date('H:i:s') }}" required>
        </div>
        
        <div class="col-lg-6 mt-3">
            <input type="checkbox" value="1" name="drop_off_confirm"> {{ __("Drop Off Vehicle?") }}
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
    </div>
    </div>
    @endif
    
    
    @if($Booking->drop_off_confirm == 1 && $Booking->km_drop_time == "")
    <div class="card">
        <div class="card-body">
    {!! Form::open(['url' => 'booking/'.$Booking->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label>{{ __("KM at time of Drop") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="km_drop_time" required value="{{ $Booking->km_drop_time }}">
        </div>
    
    
    <div class="col-lg-6 mb-4">
            <label>{{ __("Discount") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="discount_amount" id="discount_amount" onBlur="CalDis()" required value="{{ $Booking->discount_amount }}">
        </div>
        
        <div class="col-lg-12 mb-4" id="disNotBox" style="display: none">
            <label>{{ __("Discount Note") }}</label>
            <input type="text" class="form-control" name="discount_note" value="{{ $Booking->discount_note }}">
        </div>
        
        <div class="col-lg-6 mb-4">
            <label>{{ __("Additional Charges") }}</label>
            <input type="text" class="form-control" name="additional_charges" id="additioanl_amount" value="{{ $Booking->additional_charges }}">
        </div>
        
        <div class="col-lg-6 mb-4">
            <label>{{ __("Any demage") }} <span class="text-danger">*</span></label><br>
            <input type="radio" name="dmage" value="0" checked> {{ __("No Damage") }} &nbsp;&nbsp;
            <input type="radio" name="dmage" value="1"> {{ __("Damage") }}
        </div>

        <div class="col-lg-6 mb-4">
            <label>{{ __("Image of Car While Drop") }} <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="damge_image" required>
        </div>
        
    </div>
    <button class="btn btn-success mt-4">{{ __("Save") }}</button>
    {!! Form::close() !!}
    </div>
    </div>
    @endif
    
    
    @if($Booking->drop_off_confirm == 1 && $Booking->km_drop_time != "")
    <h2>Complete Booking</h2>
    {!! Form::open(['url' => 'booking/'.$Booking->id, 'enctype' => 'multipart/form-data', "onSubmit" => "return consub()", 'method' => 'PUT']) !!}
    <div class="row">
        <div class="col-lg-6 mb-4">
            <label>{{ __("Final Amount Paid") }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="final_amount_paid" readonly required value="{{ $Booking->grand_total - $Booking->advance_amount }}" id="final_amount_paid">
        </div>
    </div>

    <button class="btn btn-success mt-4">{{ __("Close Booking") }}</button>
    {!! Form::close() !!}
    
    @endif
    
    
    <div class="card mt-5">
        <div class="card-body">
            <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                <h2>{{ __("Payment Details") }}</h2>
                <div class="mt-4"><b>{{ __("Sub Total") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
                <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(((($Booking->sub_total-$Booking->discount_amount) * $Booking->tax_percentage) / 100), 2) }}</div>
                <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
                <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
                <div class="mt-2"><b>{{ __("Additional KM") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(($Booking->additional_km_reunning * $Booking->additional_kilometers_amount), 2) }}</div>
                <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
            </div>
        </div>
    </div>

    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
    @endif
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
    
    function cancelBooking(){
        if(confirm("Are you sure to cancel this booking")){
            return true;
        }
        return false;
    }
    
    function consub(){
        if(confirm("Are you sure to close this booking")){
            return true;
        }
        
        return false;
    }
</script>
@endsection