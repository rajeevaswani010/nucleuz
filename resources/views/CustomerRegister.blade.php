@extends("layout.front")

@section("content")
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">Register</h2>
            </div>
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

    {!! Form::open(['url' => 'CustomerRegister', 'id' => 'BookingForm', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
    <div class="card">
        <div class="card-header"><h4>Customer Details</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <label>Salutation <span class="text-danger">*</span></label>
                    <select class="form-control" name="title" id="title" required>
                        <option value="">Select</option>
                        <option>Mr.</option>
                        <option>Mrs.</option>
                        <option>Miss.</option>
                        <option>Dr.</option>
                        <option>Eng.</option>
                        <option>Coln.</option>
                        <option>M/s</option>
                        <option>Ms.</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-4">
                    <label>First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="first_name" value="{{ $Customer->first_name }}" required>
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" name="middle_name" value="{{ $Customer->middle_name }}">
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="last_name" value="{{ $Customer->last_name }}" required>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Gender <span class="text-danger">*</span></label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="">Select</option>
                        <option value="Male">{{ __("Male") }}</option>
                        <option value="Female">{{ __("Female") }}</option>
                    </select>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="dob" value="{{ $Customer->dob }}" required>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Nationality <span class="text-danger">*</span></label>
                    <select class="form-control" name="nationality" id="nationality" required>
                        <option value="">Select</option>
                        @foreach($Conuntry as $Cont)
                        <option value="{{ $Cont->name }}">{{ $Cont->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" value="{{ $Customer->email }}" required readonly>
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Country Code <span class="text-danger">*</span></label>
                    <select class="form-control" name="country_code" id="country_code" required>
                        <option value="">Select</option>
                        @foreach($Conuntry as $Cont)
                        <option value="{{ $Cont->phonecode }}">{{ $Cont->name }} - {{ $Cont->phonecode }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Mobile <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="mobile" value="{{ $Customer->mobile }}" required>
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Insurance Details</label>
                    <input type="text" class="form-control" name="insurance" value="{{ $Customer->insurance }}">
                </div>

                <div class="col-lg-6 mb-4">
                    <label>Permanent Address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="permanent_address"  required>{{ $Customer->permanent_address }}</textarea>
                </div>

                <div class="col-lg-6 mb-4">
                    <label>Temp Address</label>
                    <textarea type="text" class="form-control" name="temp_address">{{ $Customer->temp_address }}</textarea>
                </div>
                
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            <label>Resident Card Details</label>
                            <input type="file" class="form-control" name="residency_card" value="{{ $Customer->residency_card }}">
                        </div>
                        <div class="col-lg-2">or</div>
                        <div class="col-lg-5 mb-4">
                            <label>Passport Details</label>
                            <input type="file" class="form-control" name="passport_detail" value="{{ $Customer->passport_detail }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <label>Driving License <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="driving_license" value="{{ old('driving_license') }}" required>
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Visa</label>
                    <input type="file" class="form-control" name="visa_detail" value="{{ old('visa_detail') }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-header"><h4>Booking Details</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <label>{{ __("Date of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" required onchange="fetchAvailableVehicles(event)" id="pickupDate" name="PickupDate" min="{{ date('Y-m-d') }}" >
                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("Time of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" id="pickupTime" required name="PickupTime">
                </div>

                <div class="col-lg-12 mb-4">
                    <label>{{ __("Vehicle") }} <span class="text-danger">*</span></label><span style="float:right; font-style:italic; color:red;">[ Vehicle option shown in <b>RED</b> means is not available ]</span>
                    <select class="form-control" required id="VehicleData" onchange="fetchReviews()" name="vehicle_id">
                        <option value="">{{ __("Select") }}</option>
                        <!-- <option value="Hatchback">{{ __("Hatchback") }}</option>
                        <option value="Sedan">{{ __("Sedan") }}</option>
                        <option value="SUV">{{ __("SUV") }}</option>
                        <option value="MUV">{{ __("MUV") }}</option>
                        <option value="Coupe">{{ __("Coupe") }}</option>
                        <option value="Convertibles">{{ __("Convertibles") }}</option>
                        <option value="Pickup Trucks">{{ __("Pickup Trucks") }}</option> -->
                    </select>
                </div>

                <div class="col-lg-6 mb-4">
                    <label>{{ __("Tarrif") }} <span class="text-danger">*</span></label>
                    <select class="form-control" required id="TarrifData" onchange="fetchReviews()" name="tarrif_type">
                        <option value="">{{ __("Select") }}</option>
                        <option value="Daily">{{ __("Daily") }}</option>
                        <option value="Weekly">{{ __("Weekly") }}</option>
                        <option value="Monthly">{{ __("Monthly") }}</option>
                    </select>
                </div>

                <div class="col-lg-6 mb-4">
                    <label id="UpdateTextDay">{{ __("No of Days") }} <span class="text-danger">*</span></label>
                    <input type="number" step="0" class="form-control" name="tarrif_detail" required id="NoOfDays" onblur="fetchReviews()">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Payment Mode") }} <span class="text-danger">*</span></label>
                    <select class="form-control" required name="payment_mode" onchange="PayMethod(this.value)">
                        <option value="">{{ __("Select") }}</option>
                        <option value="Cash">{{ __("Cash") }}</option>
                        <option value="Card">{{ __("Card") }}</option>
                        <option value="Credit">{{ __("Credit") }}</option>
                    </select>
                </div>

                <div class="col-lg-4 mb-4" id="ShowCardDiv" style="display: none">
                    <label>{{ __("Card Details") }} <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="card_details">
                </div>
                
                <div class="col-lg-4 mb-4">
                    <label>{{ __("Location of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="pickup_location">
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header"><h4>Tentative Billable Amount</h4></div>
        <div class="card-body">
            <div class="float-right" id="LoadSubTotal"><b>0.0</b></div>
            <div class="float-right">Sub Total: &nbsp;</div>
            <div class="clearfix"></div>

            <div class="float-right" id="LoadTax"><b>0.0</b></div>
            <div class="float-right">VAT: &nbsp;</div>
            <div class="clearfix"></div>
            
            <div class="float-right" id="LoadGrandTotal"><b>0.0</b></div>
            <div class="float-right">Grand Total: &nbsp;</div>
            <div class="clearfix"></div>

            <hr>
            
            <div class="float-right" id="LoadDue"><b>0.0</b></div>
            <div class="float-right">Estimated Amount: &nbsp;</div>
            <div class="clearfix"></div>
            <div class="float-right"><span style="float-right font-style:italic; color:red;">*The above value may change at the time of vehicle return</span> </div>
        </div>
    </div>

    <div class="alert alert-danger" id="ErrorText" style="display: none"></div>
    <div class="alert alert-success" id="SuccessText" style="display: none"></div>

    <div id="LoadingStatus" style="display: none" class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>
    <button class="btn btn-success mt-4" onClick="SaveManager()" id="LoginBtn">Submit</button>
    {!! Form::close() !!}
</div>

@endsection


@section("ExtraJS")
<script type="text/javascript">

    //update customer data.. from $customer arg.
    $("#title").val('<?php echo $Customer->title ?>');
    $("#gender").val('<?php echo $Customer->gender ?>');
    $("#nationality").val('<?php echo $Customer->nationality ?>');

    console.log("setting country code - <?php echo $Customer->country_code ?>");
    $("#country_code").val('<?php echo $Customer->country_code ?>');


    function fetchAvailableVehicles( e ){

        $.ajax({
        url: "{{ URL('Booking/GetAvailableCarTypes') }}",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            pickupDate: $("#pickupDate").val(),
        },
        success: function( data, textStatus, jqXHR ) {

                JsData = JSON.parse(data);
                console.log(JsData);
                select = document.getElementById('VehicleData');
                select.innerHTML='';
                var opt = document.createElement('option');
                opt.value = "asdfad";
                opt.innerHTML = '--Select Vehicle--';
                select.appendChild(opt);

                for (const key in JsData) {
                    var opt = document.createElement('option');
                    opt.value = key;
                    opt.innerHTML = key.toUpperCase();
                    if(JsData[key]<=0) {
                        opt.disabled = "disabled";
                        opt.style = "color:red; font-style: italic;";
                    }
                    select.appendChild(opt);
                }  
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            alert("Fail to fetch vehicles for selected date. Please contact company for assistance. Error: " + errorThrown);             
        }
        });
    }

    function fetchReviews(){
        if($("#TarrifData").val() == "Daily"){
            $("#UpdateTextDay").html('No of Days <span class="text-danger">*</span>');
        }
        
        if($("#TarrifData").val() == "Weekly"){
            $("#UpdateTextDay").html('No of Weeks <span class="text-danger">*</span>');
        }
        
        if($("#TarrifData").val() == "Monthly"){
            $("#UpdateTextDay").html('No of Months <span class="text-danger">*</span>');
        }
        
        $.ajax({
          url: "{{ URL('Customer/Review') }}",
          method: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            vehicle: $("#VehicleData").val(),
            tarrif: $("#TarrifData").val(),
            days: $("#NoOfDays").val(),
            company: "{{ $InviteObj->company_id }}",
            tax: 5,
          },
          success: function( data, textStatus, jqXHR ) {
              JsData = JSON.parse(data);
              $("#LoadSubTotal").html(JsData.SubTotal);
              $("#LoadTax").html(JsData.Tax);
              $("#LoadGrandTotal").html(JsData.GrandTotal);
              $("#LoadDue").html(JsData.Due);
          },
          error: function( jqXHR, textStatus, errorThrown ) {
              
          }
        });
    }

    function SaveManager(){
        $("#BookingForm").unbind('submit').bind('submit',function(e) {
            $("#LoginBtn").fadeOut("fast");
            $("#LoadingStatus").fadeIn("fast");
            $("#ErrorText").fadeOut("fast");
            $("#SuccessText").fadeOut("fast");
            
            var formObj = $(this);
            var formURL = formObj.attr("action");
            if( window.FormData !== undefined ) {
                var formData = new FormData(this);
                $.ajax({
                  url: formURL,
                  type: "POST",
                  data:  formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  success: function( data, textStatus, jqXHR ) {
                      JsData = JSON.parse(data);
                      
                      console.log(JsData);
                      
                      if(JsData.Status == 0){
                          $("#ErrorText").html(JsData.Message);
                          $("#ErrorText").fadeIn("fast");
                          
                          $("#LoginBtn").fadeIn("fast");
                          $("#LoadingStatus").fadeOut("fast");
                      }else{
                          $("#SuccessText").html(JsData.Message);
                          $("#SuccessText").fadeIn("fast");
                          window.location = "{{ URL('thank-you') }}";
                      }
                  },
                  error: function( jqXHR, textStatus, errorThrown ) {
                      $("#ErrorText").html("Some Error Occure. Please Try Again Later");
                      $("#ErrorText").fadeIn("fast");
                      
                      $("#LoginBtn").fadeIn("fast");
                      $("#LoadingStatus").fadeOut("fast");
                  }
                });
                e.preventDefault();
            }
        });
    }

    function PayMethod(val){
        if(val != "Card"){
            $("#ShowCardDiv").css("display", "none");
        }else{
            $("#ShowCardDiv").css("display", "block");
        }
    }

    $('.number').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
});
</script>
@endsection