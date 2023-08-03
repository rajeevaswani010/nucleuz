<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container">
        <div><img src="{{ URL('public/logo.png') }}" style="width: 20%;"></div>

        <h1>Your Nucleuz Booking ID : #{{ $Booking->id }}</h1>

        <div style="float: left; width: 45%;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 350px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>{{ $Booking->customer->title }} {{ $Booking->customer->first_name }} {{ $Booking->customer->last_name }}</h2>
                    <div class="mt-4"><b>Gender</b> {{ $Booking->customer->gender }}</div>
                    <div class="mt-2"><b>DOB</b> {{ date("d/m/Y", strtotime($Booking->customer->dob)) }}</div>
                    <div class="mt-2"><b>Nationality</b> {{ $Booking->customer->nationality }}</div>
                    <div class="mt-2"><b>Email</b> {{ $Booking->customer->email }}</div>
                    <div class="mt-2"><b>Mobile</b> {{ $Booking->customer->mobile }}</div>
                    <div class="mt-2"><b>Insurance Details</b> {{ $Booking->customer->insurance }}</div>
                    <div class="mt-2"><b>Permanent Address</b> {{ $Booking->customer->permanent_address }}</div>
                    <div class="mt-2"><b>Temp Address</b> {{ $Booking->customer->temp_address }}</div>
                </div>
            </div>
        </div>

        <div style="float: left; margin-left: 5%; width: 45%;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 350px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>Vehicle Details</h2>
                    <div class="mt-4"><b>Car Type</b> {{ $Booking->vehicle->car_type }}</div>
                    <div class="mt-2"><b>Make</b> {{ $Booking->vehicle->make }}</div>
                    <div class="mt-2"><b>Model</b> {{ $Booking->vehicle->model }}</div>
                    <div class="mt-2"><b>Variant</b> {{ $Booking->vehicle->variant }}</div>
                    <div class="mt-2"><b>Chasis Number</b> {{ $Booking->vehicle->chasis_no }}</div>
                    <div class="mt-2"><b>Registration Number</b> {{ $Booking->vehicle->reg_no }}</div>
                    <div class="mt-2"><b>AC</b> {{ $Booking->vehicle->ac }}</div>
                    <div class="mt-2"><b>Audio</b> {{ $Booking->vehicle->audio }}</div>
                    <div class="mt-2"><b>GPS</b> {{ $Booking->vehicle->gps }}</div>
                    <div class="mt-2"><b>Insurance Details</b> {{ $Booking->vehicle->insurance_detail }}</div>
                </div>
            </div>
        </div>

        <div style="clear: both; margin-top: 40px;">&nbsp;</div>

        <div style="float: left; width: 45%;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 250px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>Booking Details</h2>
                 <!--   <div class="mt-4"><b>Tarrif</b> {{ $Booking->tarrif_type }}</div>  -->
                    <div class="mt-2"><b>No. of Days</b> {{ $Booking->tarrif_detail }}</div>
                    <div class="mt-2"><b>Per Day KM Allocations</b> {{ $Booking->km_allocation }}</div>
                    <div class="mt-2"><b>Date & Time of Pickup</b> {{ date("d F, Y H:i A", strtotime($Booking->pickup_date_time)) }}</div>
                    <div class="mt-2"><b>Date & Time of Drop Off</b> {{ date("d F, Y H:i A", strtotime($Booking->dropoff_date)) }}</div>
                    <div class="mt-2"><b>Location of Pickup</b> {{ $Booking->pickup_location }}</div>
                    <div class="mt-2"><b>KM Reading at time of pickup</b> {{ $Booking->km_reading_pickup }}</div>
                    <div class="mt-2"><b>Payment Mode</b> {{ $Booking->payment_mode }}</div>
                    <div class="mt-2"><b>Additional Detail</b> {{ $Booking->additional_info }}</div>
                </div>
            </div>
        </div>

        <div style="float: left; margin-left: 5%; width: 45%;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 250px;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h2>Payment Details</h2>
                    <div class="mt-4"><b>Sub Total : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->sub_total, 2) }}</div>
                    <div class="mt-2"><b>VAT ({{ $Booking->tax_percentage }}%) : &nbsp;&nbsp;&nbsp;</b> OMR {{ number_format(((($Booking->sub_total-$Booking->discount_amount) * $Booking->tax_percentage) / 100), 2) }}</div>
                    <div class="mt-2"><b>Discount : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->discount_amount, 2) }}</div>
                    <div class="mt-2"><b>Advance Amount : &nbsp;&nbsp;&nbsp;&nbsp;</b> OMR {{ number_format($Booking->advance_amount, 2) }}</div>
                    <div class="mt-2"><b>Grand Total : &nbsp;OMR {{ number_format(($Booking->grand_total - $Booking->advance_amount), 2) }}</b> </div>
                    
                    <div class="mt-2"><b>Final Paid Amount : &nbsp;OMR {{ number_format(($Booking->final_amount_paid), 2) }}</b> </div>
                </div>
            </div>
        </div>

        <div style="clear: both; margin-top: 40px;">&nbsp;</div>
        
        @if($Booking->car_image != "")
        <div style="float: left; width: 40%; margin-right: 2%; margin-bottom: 10px;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h4>Car Image</h4>
                    <img src="{{ URL('public') }}/{{ $Booking->car_image }}" style="max-width: 100%; height: 300px">
                </div>
            </div>
        </div>
        @endif
        
        @if($Booking->damge_image != "")
        <div style="float: left; width: 40%; margin-right: 2%; margin-bottom: 10px;">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem;">
                <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                    <h4>Car Image ON Delivery</h4>
                    <img src="{{ URL('public') }}/{{ $Booking->damge_image }}" style="max-width: 100%; height: 300px">
                </div>
            </div>
        </div>
        @endif

    </div>
  </body>
</html>