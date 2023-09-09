@extends("layout.default")

@section("content")

<script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>
<script src="{{ URL('resources/js/customer.js') }}"></script>

<style>

.scrollable-table-container {
    max-height: 300px; /* Set the maximum height for the table container */
    overflow-y: auto; /* Enable vertical scrolling for the container */
}

.fixed-header-table thead {
    position: sticky;
    top: 0;
    background-color: #fff; /* Optional: Add a background color for the header */
    z-index: 1;
}

.nav-tabs .nav-link, .nav-tabs .nav-link.active, .nav-tabs .nav-link:hover {
    border: 0;
    border-bottom: 1px solid grey;
    color: gray;
    font-size: 16px;
    font-weight: bold;
    
}

.nav-tabs .nav-link {
    color: #000000;
    border-radius: 0;
}

.nav-tabs .nav-link.active {
    color: blue;
    border-bottom: 2px solid blue;
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
                            <h4 class="m-b-10">{{ __("Create Booking") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Create Booking") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">


        <div class="card ">
        <div class="card-header">
        <div class="row">
                <div class="col-lg-3">
                    <h4>{{ __('Select Customer') }}</h4>
                </div>
                <div class="col-lg-9 ">
                    <div class="float-right">
                    <div class="col-lg-2 float-right">
                        <button type="button" onclick="SearchCustomer()" class="btn btn-primary">{{ __('Search') }}</button>
                        <!-- <button type="button" onclick="ClearCustomerForm()" class="btn btn-danger">{{ __('Clear Form') }}</button> -->
                    </div>
                    <div class="col-lg-7 float-right"><input type="text" id="SearchTerm" class="form-control h-auto font-style"></div>
                    <div class="col-lg-3 float-right">{{ __('Search by Mobile Number or Email') }}</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div id="search_results" class="scrollable-table-container">
            </div>
            <div id="selected_customer">
                <label class="col-form-label text-dark"><h3 id="name_heading"></h3></label> 
                <ul class="nav  nav-tabs" id="nav-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="nav_details" data-toggle="tab" href="#customer_details">Details</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="nav_documents"  data-toggle="tab" href="#customer_documents">Documents</a>
                    </li>
                </ul>
                <div class="tab-content"  id="nav-tabcontent" >
                    <div class="tab-pane fade show active"  id="customer_details" role="tabpanel" aria-labelledby="nav_details">
                        <form id="CustomerForm" method="POST">
                        <div class="row mt-4">
                                <div class="col-lg-6 mb-4" style="display: none;">
                                        <input type="text" class="form-control h-auto font-style" name="customer_id" id="customer_id" value="" />
                                </div>
                                <div class="col-lg-1 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Salutation") }} <span class="text-danger">*</span></label> 
                                <select class="form-control h-auto font-style" name="title" id="title" required> 
                                    <option value="">{{ __("Select") }}</option> 
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
                            <div class="col-lg-6 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Name") }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control h-auto font-style" name="first_name" id="first_name" value="" required>
                            </div>
                            <div class="col-lg-2 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Gender") }} <span class="text-danger">*</span></label>
                                <select class="form-control h-auto font-style" name="gender" id="gender" required>
                                    <option value="">{{ __("Select") }}</option>
                                    <option value="Male">{{ __("Male") }}</option>
                                    <option  value="Female">{{ __("Female") }}</option>
                                </select>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Nationality") }} <span class="text-danger">*</span></label>
                                <select class="form-control h-auto font-style" name="nationality" id="nationality" required>
                                    <option value="">{{ __("Select") }}</option>
                                    @foreach($Conuntry as $Cont)
                                    <option value="{{ $Cont->name }}">{{ $Cont->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                $("#nationality").val("");
                            </script>
                            <div class="col-lg-2 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Date of Birth") }} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control h-auto font-style" name="dob" id="dob" value="" required>
                            <!-- <input type="date" class="form-control h-auto font-style" name="dob" id="dob" value="" required max="{{ date('Y-m-d', strtotime('-18 year')) }}"> -->
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Email") }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control h-auto font-style" name="email" id="email" value="" required>
                            </div>
                            
                            <div class="col-lg-2 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Country Code") }} <span class="text-danger">*</span></label>
                                <select class="form-control h-auto font-style" name="country_code" id="country_code" title="select country code" required>
                                    <option value="">{{ __("Select") }}</option>
                                    @foreach($Conuntry as $Cont)
                                    <option value="{{ $Cont->phonecode }}" title="{{ $Cont->name }} - {{ $Cont->phonecode }}">{{ $Cont->name }} - {{ $Cont->phonecode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                $("#country_code").val("");
                            </script>
                            <div class="col-lg-4 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Mobile") }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control h-auto font-style" name="mobile" id="mobile" value="" required>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Insurance Details") }}</label>
                                <textarea type="text" class="form-control h-auto font-style" name="insurance" id="insurance"></textarea>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Permanent Address") }} <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control h-auto font-style" name="permanent_address" id="permanent_address" required></textarea>
                            </div>
                            <div class="col-lg-4 mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Temp Address") }}</label>
                                <textarea type="text" class="form-control h-auto font-style" name="temp_address" id="temp_address"></textarea>
                            </div>
                            <div class="col mt-4">
                                <!-- <input class="btn btn-xs btn-primary" style="float: right;" type="submit" value='{{ __("Save") }}'> -->
                                <button id="customerform_submit" class="btn btn-xs btn-primary" style="float: right;"  type="submit">{{ __("Save") }}</button>
                            </div>
                        </div>    
                        </form>            
                    </div>
                    <div class="tab-pane fade show" id="customer_documents" role="tabpanel" aria-labelledby="nav_documents">
                    <div class="row mt-4">
                        <div class="col-3 mb-4">
                            <div id="file_residency_card">
                                <label for="subject" class="col-form-label text-dark">{{ __("Resident Card Details") }}</label>
                                <input type="file" multiple class="form-control h-auto font-style file_input" name="residency_card[]" 
                                        id="file_residency_card_input" capture onchange="uploadFiles(this, 'file_residency_card')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery">
                                </div>
                            </div>
                        </div>

                        <div class="col-3 mb-4">
                            <div id="file_passport_detail">
                                <label for="subject" class="col-form-label text-dark">{{ __("Passport Details") }}</label>
                                <input type="file" multiple class="form-control h-auto font-style file_input" name="passport_detail[]" 
                                        id="file_passport_detail_input" capture onchange="uploadFiles(this,'file_passport_detail')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div id="file_driving_license">
                                <label for="subject" class="col-form-label text-dark">{{ __("Driving License") }} <span class="text-danger">*</span></label>
                                <input type="file" multiple class="form-control h-auto font-style file_input" name="driving_license[]" 
                                        id="file_driving_license_input" capture onchange="uploadFiles(this,'file_driving_license')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div id="file_visa_detail">
                                <label for="subject" class="col-form-label text-dark">{{ __("Visa") }}</label>
                                <input type="file" multiple class="form-control h-auto font-style file_input" name="visa_detail[]" 
                                        id="file_visa_detail_input" capture onchange="uploadFiles(this,'file_visa_detail')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="text-danger mt-4" id="errormsg"></div>
            <div class="row mt-4">
            </div>
        </div>
    </div>


    {!! Form::open(['url' => 'booking', 'id' => 'BookingForm', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}

    <div class="card mt-3">
        <div class="card-header"><h4>{{ __("Booking Details") }}</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <label>{{ __("Date of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="date" class="form-control h-auto" required onchange="fetchAvailableVehicles(event)" id="pickupDate" name="PickupDate" min="{{ date('Y-m-d') }}" >
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Time of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="time" class="form-control h-auto" id="pickupTime" onchange="fetchAvailableVehicles()" required name="PickupTime">
                </div>

                <!-- <div class="col-lg-3 mb-4">
                    <label>{{ __("Tarrif") }} <span class="text-danger">*</span></label>
                    <select class="form-control h-auto" required id="TarrifData" onchange="fetchAvailableVehicles()" name="tarrif_type">
                        <option value="">{{ __("Select") }}</option>
                        <option value="Daily">{{ __("Daily") }}</option>
                        <option value="Weekly">{{ __("Weekly") }}</option>
                        <option value="Monthly">{{ __("Monthly") }}</option>
                    </select>
                </div> -->

                <div class="col-lg-4 mb-4">
                    <label id="UpdateTextDay">{{ __("No of Days") }} <span class="text-danger">*</span></label>
                    <input type="number" step="0" class="form-control h-auto" name="tarrif_detail" required id="NoOfDays" onblur="fetchAvailableVehicles()" min=1 value=1>
                </div>

                <div class="col-lg-12 mb-4">
                    <label>{{ __("Vehicle") }} <span class="text-danger">*</span></label><span style="float:right; font-style:italic; color:red;">[ Vehicle option shown in <b>RED</b> means is not available ]</span>
                    <select class="form-control h-auto" required id="VehicleData" onchange="fetchReviews()" name="vehicle_id">
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

                <div class="col-lg-9 mb-4">
                    <label>{{ __("Location of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control h-auto" required name="pickup_location" id="pickup_location">
                </div>

                <div class="col-lg-3 mb-4">
                    <label>{{ __("Per day KM Allocation") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control h-auto" required name="km_allocation">
                </div>


                <div class="col-lg-3 mb-4">
                    <label>{{ __("Payment Mode") }} <span class="text-danger">*</span></label>
                    <select class="form-control h-auto" required name="payment_mode" id="payment_mode" onchange="PayMethod(this.value)">
                        <option value="">{{ __("Select") }}</option>
                        <option value="Cash">{{ __("Cash") }}</option>
                        <option value="Card">{{ __("Card") }}</option>
                        <option value="Credit">{{ __("Credit") }}</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-4" id="ShowCardDiv" style="display: none">
                    <label>{{ __("Card Details") }} <span class="text-danger">*</span></label>
                    <input type="file" class="form-control h-auto" name="card_details">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Additional Details like (Child Seat, GPS, Audio)") }}</label>
                    <input type="text" name="additional_info" class="form-control h-auto">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Note") }}</label>
                    <input type="text" name="booking_note" class="form-control h-auto">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Discount") }} <span class="text-danger">*</span></label>
                    <input type="text" name="discount_amount" class="form-control h-auto number" id="DiscountAmount" required value="0" onblur="fetchReviews()">
                </div>
                
                <div class="col-lg-4 mb-4">
                    <label>{{ __("Additional KM Amount") }} <span class="text-danger">*</span></label>
                    <input type="text " name="additional_kilometers_amount" class="form-control h-auto number" required value="0">
                </div>
                <div class="col-lg-3 mb-3 d-none">
                    <input type="text" name="invite_id" class="form-control h-auto number" id="invite_id" value="{{ @$InviteId }}">
                </div>
            </div>
        </div>
    </div>

    <style>
        #LoadSubTotal, #LoadTax, #LoadDiscount, #LoadGrandTotal, #LoadDue{
            margin-left: 100px!important;
            margin-top: -20px!important;
        }
        </style>

    <div class="card mt-5">
        <div class="card-body">
            <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                <h2>{{ __("Review Booking Details") }}</h2>

                <div class="mt-4">
                    <b>{{ __("Sub Total") }} :</b>
                     <div id="LoadSubTotal"><b>0.0</b></div>
                </div>

                <div class="mt-2">
                    <b>{{ __("Discount") }} :</b>
                     <div id="LoadDiscount"><b>0.0</b></div>
                </div>

                <div class="mt-2">
                    <b>{{ __("VAT") }}(5%) :</b>
                     <div id="LoadTax"><b>0.0</b></div>
                </div>

                <div class="mt-2">
                    <b>{{ __("Grand Total") }} :</b>
                    <div id="LoadGrandTotal"><b>0.0</b></div>
                </div>
              
                <div class="mt-2">
                    <b>{{ __("Due") }} :</b>
                    <div id="LoadDue"><b>0.0</b></div>
                </div>
              
                <div class="clearfix"></div>


            </div>
        </div>
    </div>







    <div class="alert alert-danger" id="ErrorText" style="display: none"></div>
    <div class="alert alert-success" id="SuccessText" style="display: none"></div>

    <div id="LoadingStatus" style="display: none" class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>

    <!-- <button class="btn btn-xs btn-primary" onClick="SaveManager()" id="LoginBtn">{{ __("Save") }}</button> -->
    <input class="btn btn-xs btn-primary" id="LoginBtn" type="submit" value='{{ __("Save") }}'>

    {!! Form::close() !!}

        </div>
    </div>
    <!-- [ Main Content ] end -->
    </div>
</div>




<script type="text/javascript">

    var selectedCustId; // this customer id is used for booking.. 

    $(document).ready(function() {
        // Your code here
        selectedCustId = {{ $CustomerID }}
        if( selectedCustId != undefined )
            selectCustomer(selectedCustId);
    });

    //set requirements..
    @if(!empty($Requirements["tarrif_detail"])) 
        $("#NoOfDays").val({{ @$Requirements["tarrif_detail"] }});
    @endif
    @if(!empty($Requirements["tarrif_type"])) 
        // $("#TarrifData").val('{{ @$Requirements["tarrif_type"] }}');
    @endif
    @if(!empty($Requirements["payment_mode"])) 
        $("#payment_mode").val('{{ @$Requirements["payment_mode"] }}');
    @endif
    @if(!empty($Requirements["pickup_location"])) 
        $("#pickup_location").val('{{ @$Requirements["pickup_location"] }}');
    @endif
    @if(!empty($Requirements["PickupTime"])) 
        $("#pickupTime").val('{{ @$Requirements["PickupTime"] }}');
    @endif
    @if(!empty($Requirements["PickupDate"])) 
        $("#pickupDate").val('{{ @$Requirements["PickupDate"] }}');
        fetchAvailableVehicles();
    @endif
    

    // document.getElementById("TarrifData").addEventListener('change', (event) => {
    //     console.log("onchange");
    //     if($("#TarrifData").val() == "Daily"){
    //         $("#UpdateTextDay").html('No of Days <span class="text-danger">*</span>');
    //     }
        
    //     if($("#TarrifData").val() == "Weekly"){
    //         console.log("change label")
    //         $("#UpdateTextDay").html('No of Weeks <span class="text-danger">*</span>');
    //     }
        
    //     if($("#TarrifData").val() == "Monthly"){
    //         $("#UpdateTextDay").html('No of Months <span class="text-danger">*</span>');
    //     }
    // });

    function fetchAvailableVehicles( e ){
        
        $pickupDate = $("#pickupDate").val();
        $pickupTime = $("#pickupTime").val();
        // $tarrif = $("#TarrifData").val();
        $tarrifDetail = $("#NoOfDays").val();

        if($pickupDate && $pickupTime && $tarrifDetail){

            $numOfDays = $tarrifDetail;
            // if($("#TarrifData").val() == "Daily"){
            //     $numOfDays = $tarrifDetail;
            // } else if($("#TarrifData").val() == "Weekly"){
            //     $numOfDays = $tarrifDetail*7;
            // } else if($("#TarrifData").val() == "Monthly"){
            //     $numOfDays = $tarrifDetail*30;
            // }
        
            $.ajax({
                url: "{{ URL('Booking/GetAvailableCarTypes') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    pickupDate: $pickupDate,
                    pickupTime: $pickupTime,
                    numOfDays: $numOfDays
                },
                success: function( data, textStatus, jqXHR ) {

                        JsData = JSON.parse(data);
                        select = document.getElementById('VehicleData');
                        select.innerHTML='';
                        var opt = document.createElement('option');
                        opt.value = "";
                        opt.innerHTML = '--Select Vehicle--';
                        select.appendChild(opt);

                        for (const key in JsData) {
                            var opt = document.createElement('option');
                            opt.value = key;
                            opt.innerHTML = key;
                            if(JsData[key]<=0) {
                                opt.disabled = "disabled";
                                opt.style = "color:red; font-style: italic;";
                            }
                            select.appendChild(opt);
                        }

                        @if(!empty($Requirements["car_type"])) 
                            carType = '{{ @$Requirements["car_type"] }}';
                            if(JsData[carType] > 0) {
                                $("#VehicleData").val(carType);
                                fetchReviews();
                            } else {
                                alert("Customer required cartype - "+carType+" is not available for selected dates."); //style this
                            }
                        @endif
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    alert("Fail to fetch vehicles for selected date. Please contact company for assistance. Error: " + errorThrown);             
                }
            });
        } else {
            console.log("not enough params defined");
        }
        $("#LoadSubTotal").html('<b>0.0</b>');
        $("#LoadTax").html('<b>0.0</b>');
        $("#LoadGrandTotal").html('<b>0.0</b>');
        $("#LoadDiscount").html('<b>0.0</b>');
        //$("#LoadAdvance").html('<b>0.0</b>');
        $("#LoadDue").html('<b>0.0</b>');

    }

    function fetchReviews(){

        // alert('jjjjj');
        // return false;
        $.ajax({
          url: "{{ URL('Booking/Review') }}",
          method: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            vehicle: $("#VehicleData").val(),
            //tarrif: $("#TarrifData").val(),
            days: $("#NoOfDays").val(),
            tax: 5,
            discount: $("#DiscountAmount").val(),
            advance: $("#AdvaneAmount").val(),
          },
          success: function( data, textStatus, jqXHR ) {
              JsData = JSON.parse(data);
              $("#LoadSubTotal").html('<b>'+JsData.SubTotal+'</b>');
              $("#LoadTax").html('<b>'+JsData.Tax+'</b>');
              $("#LoadGrandTotal").html('<b>'+JsData.GrandTotal+'</b>');
              $("#LoadDiscount").html('<b>'+JsData.Discount+'</b>');
              //$("#LoadAdvance").html('<b>'+JsData.Advance+'</b>');
              $("#LoadDue").html('<b>'+JsData.Due+'</b>');
          },
          error: function( jqXHR, textStatus, errorThrown ) {
              
          }
        });
    }

    // function SaveManager(){
        $("#BookingForm").bind('submit',function(e) {

            if(selectedCustId == undefined){
                alert("Kindly select customer.");
                e.preventDefault();
                return;
            }

            $("#LoginBtn").fadeOut("fast");
            $("#LoadingStatus").fadeIn("fast");
            $("#ErrorText").fadeOut("fast");
            $("#SuccessText").fadeOut("fast");
            
            var formObj = $(this);
            var formURL = formObj.attr("action");

            if( window.FormData !== undefined ) {

                var formData = new FormData(this);
                formData.append("customer_id", selectedCustId);

                $.ajax({
                  url: formURL,
                  type: "POST",
                  data:  formData,
                  contentType: false,
                  cache: false,
                  processData:false,
                  success: function( data, textStatus, jqXHR ) {
                      JsData = JSON.parse(data);
                      
                      if(JsData.Status == 0){
                          $("#ErrorText").html(JsData.Message);
                          $("#ErrorText").fadeIn("fast");
                          
                          $("#LoginBtn").fadeIn("fast");
                          $("#LoadingStatus").fadeOut("fast");
                      }else{
                          $("#SuccessText").html(JsData.Message);
                          $("#SuccessText").fadeIn("fast");
                         window.location = "{{ URL('booking') }}";
                      }
                      hideloading();
                  },
                  error: function( jqXHR, textStatus, errorThrown ) {
                      $("#ErrorText").html("Some Error Occure. Please Try Again Later");
                      $("#ErrorText").fadeIn("fast");
                      
                      $("#LoginBtn").fadeIn("fast");
                      $("#LoadingStatus").fadeOut("fast");
                      hideloading();
                  }
                });
                e.preventDefault();
            }
        });
    // }

    function PayMethod(val){
        if(val != "Card"){
            $("#ShowCardDiv").css("display", "none");
        }else{
            $("#ShowCardDiv").css("display", "block");
        }
    }


//customer selection related changes.. 

    $("#selected_customer").css("display", "none");

    $("#CustomerForm").bind('submit',function(e) {
            var formObj = $(this);
            var formURL = formObj.attr("action");

            if( window.FormData !== undefined ) {
                var formData = new FormData(this);
                formData.append("id",selectedCustId);

                //
                doAjax (
                    formURL
                    ,formDataToJson(formData)
                    ,(JsData) => {
                        toastr["success"]("Customer updated successfully")
                    }
                    ,(JsData) => {
                        toastr["error"](JsData.Message);
                    }
                );

                e.preventDefault();
            }
    });

    function SearchCustomer(){
        Query = $("#SearchTerm").val();
        console.log("Query - "+Query);
        if(Query == ""){
            return;
        }
        $("#errormsg").html("");
        
        $('#search_results').css("display","block");
        $('#selected_customer').css("display","none");

        doAjax (
            "{{ URL('CustomerSearch') }}"
            ,{"term": Query}
            ,(JsData) => {
                addCustomerSearchesToTable(JsData.Data);
            }
            ,(JsData) => {
                alert("Internal Error");
            }
        )
    }

    function addCustomerSearchesToTable(data){
        var div = $("#search_results");
        div.empty();
        $("#errormsg").html("");

        div.html('<table  class="table datatable fixed-header-table"> \
                    <thead> \
                        <tr> \
                            <th>Name</th> \
                            <th>Email</th> \
                            <th>Mobile</th> \
                            <th></th> \
                        </tr> \
                    </thead> \
                    <tbody> \
                    </tbody> \
                </table> \
            ');

        var tbody = $("#search_results table tbody");

        if(data.length == 0){
            $("#errormsg").html("No matching Customer Found");
            return;
        }

        data.forEach(function(item){
            // console.log(item);
            var newRow = $("<tr>");
            var cols = "";

            // Generate columns for the new row
            cols += '<td>'+item.name+'</td>'; // You can replace "ID" with the actual data you want to add
            cols += '<td>'+item.email+'</td>'; // You can replace "Name" with the actual data you want to add
            cols += '<td>'+item.mobile+'</td>'; // You can replace "Email" with the actual data you want to add


            newRow.append(cols);

            var btn = $('<button class="btn btn-sm btn-primary">')
            btn.html('Select');
            btn.on('click', function(){
                selectCustomer(item.id);
            });
            var tdBtn = $('<td>'); tdBtn.append(btn);
            newRow.append(tdBtn);

            tbody.append(newRow)
        });

        // table.append(tbody);
        // div.append(table);

        // table.attr("class","datatable");
    }

    function selectCustomer(customerId){
        selectedCustId = customerId;

        $.ajax({
          url: "{{ URL('CustomerGet') }}",
          method: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id: customerId,
          },
          success: function( data, textStatus, jqXHR ) {
              JsData = JSON.parse(JSON.stringify(data));
              console.log(JSON.stringify(JsData[0]));
              selectedCustId = JsData[0].id; //set customer id used for booking.. 
              showCustomer(JsData[0]);
          },
          error: function( jqXHR, textStatus, errorThrown ) {
            console.log("error fetching data");
            alert("Internal Error");
          }
        });

    }

    function showCustomer(JsData) {
        $('#search_results').css("display","none");
        $("#selected_customer").css("display", "block");

        var dynamicUrl = '/customer/update/'+JsData.id;
        $('#CustomerForm').attr("action",dynamicUrl);  //set url with cust id.. 


        $('#search_results').empty();
        //div.html(JSON.stringify(JsData[0]));    
        console.log(JsData);
        
        CustomerId = JsData.id;
        $("#name_heading").html('<u>{{ __('Customer') }}#</u> '+JsData.first_name);
        $("#dob").val(JsData.dob);
        $("#email").val(JsData.email);
        $("#first_name").val(JsData.first_name);
        $("#gender").val(JsData.gender);
        $("#insurance").val(JsData.insurance);
        $("#mobile").val(JsData.mobile);
        $("#country_code").val(JsData.country_code);
        $("#nationality").val(JsData.nationality);
        $("#permanent_address").val(JsData.permanent_address);
        $("#temp_address").val(JsData.temp_address);
        $("#title").val(JsData.title);

        $(".gallery").empty(); //clear off all gallery images

   //get customer images.. args:{"customer_id":CustomerId}
        var args = {"customer_id": CustomerId};
        
        doAjax (
            "{{ URL('getCustomerImages') }}"
            ,args
            ,(JsData) => {
                var data = JsData.Data;
                for (var key in data) {
                    for (var i = 0; i < data[key].length; i++) {
                        var delHandlerArgs = {"id":data[key][i].id, "customer_id":CustomerId};
                        addImageUrlToGallery(data[key][i], "file_"+key, deleteFile, delHandlerArgs);
                    }
                }
            }
            ,(JsData) => {
                alert("Fail to get images.Error:"+JsData.Status+" - "+JsData.Message);
            }
        );
    }

    function ClearCustomerForm(){
        $("#dob").val(null);
        $("#email").val(null);
        $("#first_name").val(null);
        $("#gender").val(null);
        $("#insurance").val(null);
        //$("#last_name").val(JsData.last_name);
        //$("#middle_name").val(JsData.middle_name);
        $("#mobile").val(null);
        $("#country_code").val(null);
        $("#nationality").val(null);
        $("#permanent_address").val(null);
        $("#temp_address").val(null);
        $("#title").val(null);
        //$("#label_file_residency_card").html(JsData.residency_card);
        //$("#img_passport_detail").src = "/public/"+JsData.passport_detail;

        $(".gallery").empty();
        $("input[type='file']").val("");
    }

    //delete customer file.. 
    function deleteFile(args){
        var formdata = new FormData();
        formdata.append('customer_id', args.customer_id);
        formdata.append('image_id',args.id);

        //
        doAjax (
            "{{ URL('Customer/deleteFile') }}"
            ,formDataToJson(formdata)
            ,(JsData) => {
                toastr["success"]("file deleted successfully")
            }
            ,(JsData) => {
                toastr["error"](JsData.Message);
            }
        );
    }

    function uploadFiles(fileInput, parentDivId){
        console.log("upload file called");
        var CustomerId = selectedCustId;
        var type = parentDivId.slice(5);   // for 'file_residency_card' it will return 'residency_card'

        __uploadFiles(
            "{{ URL('Customer/uploadFiles') }}"
            ,fileInput
            ,(formdata) => {
                formdata.append("customer_id", CustomerId);
                formdata.append("type", type);
            }
            ,(JsData) => {
                for (var key in JsData.Data) {
                            for (var i = 0; i < JsData.Data[key].length; i++) {
                                var delHandlerArgs = {"id":JsData.Data[key][i].id, "customer_id":CustomerId};
                                addImageUrlToGallery(JsData.Data[key][i], "file_"+key, deleteFile, delHandlerArgs);
                            }
                }
                toastr["success"]("file uploaded successfully")
            }
            ,(JsData) => {
                toastr["error"](JsData.Message);
            }
        );
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

