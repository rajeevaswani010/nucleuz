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
                            <h4 class="m-b-10">Edit Booking Data</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Booking Data</li>
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

                    <div class="float-left"><h1>{{ __("Booking Details") }} : #{{ $Booking->id }}</h1></div>
        
                    @if($Booking->status != 4)
                        @if($Booking->pickup_date_time > date("Y-m-d H:i:s") && $Booking->status != 3)
                        <div class="float-right"><a href="{{ URL('booking') }}/{{ $Booking->id }}"><button class="btn btn-success">{{ __("Assign Vehicle") }}</button></a></div>
                        @endif
                        
                        @if($Booking->status == 1)
                        <div class="float-right mr-5"><a href="{{ URL('BookingCancel') }}/{{ $Booking->id }}" onClick="return cancelBooking()"><button class="btn btn-danger">{{ __("Cancel Booking") }}</button></a></div>
                        @endif
                    @endif
                    
                    <div class="clearfix"></div>

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
                    @if($Booking->status == 1)
                    <div class="mt-4"><b>{{ __("Car Type") }}</b> {{ $Booking->car_type }}</div>
                    @else
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
                    @endif
                </div>
            </div>
        </div>

        <div style="clear: both; margin-top: 40px;">&nbsp;</div>

        <div style="float: left; width: 45%;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>{{ __("Booking Details") }}</h2>
                  <!--  <div class="mt-4"><b>{{ __("Tarrif") }}</b> {{ $Booking->tarrif_type }}</div> 
                    @if($Booking->tarrif_type == "Weekly")
                    <div class="mt-2"><b>{{ __("No. of Weeks") }}</b> {{ $Booking->tarrif_detail }}</div>
                    @elseif ($Booking->tarrif_type == "Monthly")
                    <div class="mt-2"><b>{{ __("No. of Months") }}</b> {{ $Booking->tarrif_detail }}</div>
                    @else
                    <div class="mt-2"><b>{{ __("No. of Days") }}</b> {{ $Booking->tarrif_detail }}</div>
                    @endif  -->
                    <div class="mt-2"><b>{{ __("No. of Days") }}</b> {{ $Booking->tarrif_detail }}</div>
                    <div class="mt-2"><b>{{ __("Per Day KM Allocations") }}</b> {{ $Booking->km_allocation }}</div>
                    <div class="mt-2"><b>{{ __("Date & Time of Pickup") }}</b> {{ date("d F, Y H:i A", strtotime($Booking->pickup_date_time)) }}</div>
                    <div class="mt-2"><b>{{ __("Drop Off Date") }}</b> {{ date("d F, Y ", strtotime($Booking->dropoff_date)) }}</div>
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
                    <h2>{{ __("Tentative Billable Amount") }}</h2>
                    <div class="mt-4"><b>{{ __("Sub Total") }} : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
                    <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(((($Booking->sub_total) * $Booking->tax_percentage) / 100), 2) }}</div>
                    <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
                    <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
                    <div class="mt-2"><b>{{ __("Additional KM Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(($Booking->additional_km_reunning * $Booking->additional_kilometers_amount), 2) }}</div>
                    <div class="mt-2"><b>{{ __("Additional Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->additional_charges, 2) }}</div>
                    <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
                    <div class="mt-2"><b><span style="float:left; font-style:italic; color:red;">*The above value may change at the time of vehicle return</span> </b> </div>
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
                @if( array_key_exists('driving_licence',$CustImagesArr))
                    @foreach($CustImagesArr['driving_licence'] as $CustImg)
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
            <div><b>{{ __("Final Amount Paid") }} :</b> OMR {{ number_format($Booking->final_amount_paid, 2) }}</div>
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
        <!--  <input type="date" class="form-control" name="dropoff_date" value="{{ date('Y-m-d', strtotime($Booking->dropoff_date)) }}" required> -->
        <!--  <input type="date" class="form-control" name="dropoff_date" value="{{ date('Y-m-d', strtotime($Booking->dropoff_date)) }}" min="{{ date('Y-m-d', strtotime($Booking->dropoff_date)) }}" required>  -->
         <input type="date" class="form-control" name="dropoff_date" value="{{ date('Y-m-d', strtotime($Booking->dropoff_date)) }}" min="{{ date('Y-m-d', strtotime('+1 day', strtotime($Booking->pickup_date_time ))) }}" required> 
        </div>
        
        <div class="col-lg-6">
            <label>{{ __("Drop off Time") }} <span class="text-danger">*</span></label>
            <input type="time" class="form-control" name="dropoff_time"  value="{{ date('H:i:s', strtotime('+4 hours')) }}" required>
            <!-- <input type="time" class="form-control" name="dropoff_time" min="{{ date('H:i:s') }}" value="{{ date('H:i:s') }}" required> -->
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
            <input type="text" class="form-control" name="final_amount_paid" readonly required value="{{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}" id="final_amount_paid">
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
                <div class="mt-2"><b>{{ __("VAT") }} ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(((($Booking->sub_total) * $Booking->tax_percentage) / 100), 2) }}</div>
                <div class="mt-2"><b>{{ __("Discount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
                <div class="mt-2"><b>{{ __("Advance Amount") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
                <div class="mt-2"><b>{{ __("Additional KM Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(($Booking->additional_km_reunning * $Booking->additional_kilometers_amount), 2) }}</div>
                <div class="mt-2"><b>{{ __("Additional Charges") }} : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->additional_charges, 2) }}</div>
                <div class="mt-2"><b>{{ __("Grand Total") }} : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
            </div>
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