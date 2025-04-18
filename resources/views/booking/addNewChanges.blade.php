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
        {!! Form::open(['url' => 'booking', 'id' => 'BookingForm', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}


        <div class="card ">
        <div class="card-header"><h4>{{ __('Customer Details') }}</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">{{ __('Search by Mobile Number or Email') }}</div>
                <div class="col-lg-6"><input type="text" id="SearchTerm" class="form-control font-style"></div>
                <div class="col-lg-3">
                    <button type="button" onclick="SearchCustomer()" class="btn btn-primary">{{ __('Search') }}</button>
                    <button type="button" onclick="ClearCustomerForm()" class="btn btn-danger">{{ __('Clear Form') }}</button>
                </div>
            </div>
            <div class="text-danger" id="errormsg"></div>
            <hr>
            <div class="row mt-4">
                <div class="col-lg-1 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Salutation") }} <span class="text-danger">*</span></label>
                    <select class="form-control font-style" name="title" id="title" required>
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
                    <input type="text" class="form-control font-style" name="first_name" id="first_name" value="{{ @$CustomerData->first_name }}" required>
                </div>

               <!-- <div class="col-lg-3 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Middle Name") }}</label>
                    <input type="text" class="form-control font-style" name="middle_name" id="middle_name" value="{{ @$CustomerData->middle_name }}">
                </div>

                <div class="col-lg-3 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Last Name") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-style" name="last_name" id="last_name" value="{{ @$CustomerData->last_name }}" required>
                </div> -->

                <div class="col-lg-2 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Gender") }} <span class="text-danger">*</span></label>
                    <select class="form-control font-style" name="gender" id="gender" required>
                        <option value="">{{ __("Select") }}</option>
                        <option @if(@$CustomerData->gender == "Male") selected @endif value="Male">{{ __("Male") }}</option>
                        <option @if(@$CustomerData->gender == "Female") selected @endif value="Female">{{ __("Female") }}</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Nationality") }} <span class="text-danger">*</span></label>
                    <select class="form-control font-style" name="nationality" id="nationality" required>
                        <option value="">{{ __("Select") }}</option>
                        @foreach($Conuntry as $Cont)
                        <option value="{{ $Cont->name }}">{{ $Cont->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-2 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Date of Birth") }} <span class="text-danger">*</span></label>
                    <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$CustomerData->dob }}" required>
                   <!-- <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$CustomerData->dob }}" required max="{{ date('Y-m-d', strtotime('-18 year')) }}"> -->
                </div>

                <div class="col-lg-4 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Email") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-style" name="email" id="email" value="{{ @$CustomerData->email }}" required>
                </div>
                
                <div class="col-lg-2 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Country Code") }} <span class="text-danger">*</span></label>
                    <select class="form-control font-style" name="country_code" id="country_code" title="select country code" required>
                        <option value="">{{ __("Select") }}</option>
                        @foreach($Conuntry as $Cont)
                        <option value="{{ $Cont->phonecode }}" title="{{ $Cont->name }} - {{ $Cont->phonecode }}">{{ $Cont->name }} - {{ $Cont->phonecode }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-4 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Mobile") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-style" name="mobile" id="mobile" value="{{ @$CustomerData->mobile }}" required>
                </div>
                <div class="col-lg-4 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Insurance Details") }}</label>
                    <textarea type="text" class="form-control font-style" name="insurance" id="insurance">{{ @$CustomerData->insurance }}</textarea>
                </div>

                <div class="col-lg-4 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Permanent Address") }} <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control font-style" name="permanent_address" id="permanent_address" required>{{ @$CustomerData->permanent_address }}</textarea>
                </div>

                <div class="col-lg-4 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Temp Address") }}</label>
                    <textarea type="text" class="form-control font-style" name="temp_address" id="temp_address">{{ @$CustomerData->temp_address }}</textarea>
                </div>

                <div class="col-lg-3 mb-4">
                    <div id="file_residency_card">
                        <label for="subject" class="col-form-label text-dark">{{ __("Resident Card Details") }}</label>
                        <input type="file" multiple class="form-control font-style" name="residency_card[]" 
                                id="file_input" capture onchange="updateFileList(this,'file_residency_card')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        @if( array_key_exists('residency_card',$CustImagesArr))
                        @foreach($CustImagesArr['residency_card'] as $CustImg)
                            <!-- <script>console.log({{ $CustImg }});</script> -->
                            <!-- <div class="gallery-item">
                                <div class="image">
                                    <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                        <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                    </a>                        
                                </div>
                            </div> -->
                            <script>
                                addImageUrlToGallery({{ $CustImg }},'file_residency_card');
                            </script>
                        @endforeach
                        @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div id="file_passport_detail">
                        <label for="subject" class="col-form-label text-dark">{{ __("Passport Details") }}</label>
                        <input type="file" multiple class="form-control font-style" name="passport_detail[]" 
                                id="file_input" capture onchange="updateFileList(this,'file_passport_detail')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        @if( array_key_exists('passport_detail',$CustImagesArr))
                        @foreach($CustImagesArr['passport_detail'] as $CustImg)
                            <!-- <script>console.log({{ $CustImg }});</script> -->
                            <!-- <div class="gallery-item">
                                <div class="image">
                                    <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                        <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                    </a>                        
                                </div>
                            </div> -->
                            <script>
                            addImageUrlToGallery({{ $CustImg }},'file_passport_detail');
                            </script>
                        @endforeach
                        @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div id="file_driving_license">
                        <label for="subject" class="col-form-label text-dark">{{ __("Driving License") }} <span class="text-danger">*</span></label>
                        <input type="file" multiple class="form-control font-style" name="driving_license[]" 
                                id="file_input" capture onchange="updateFileList(this,'file_driving_license')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        @if( array_key_exists('driving_license',$CustImagesArr))
                        @foreach($CustImagesArr['driving_license'] as $CustImg)
                            <!-- <script>console.log({{ $CustImg }});</script> -->
                            <!-- <div class="gallery-item">
                                <div class="image">
                                    <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                        <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                    </a>                        
                                </div>
                            </div> -->
                            <script>
                                addImageUrlToGallery({{ $CustImg }},'file_driving_license');
                            </script>
                        @endforeach
                        @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div id="file_visa_detail">
                        <label for="subject" class="col-form-label text-dark">{{ __("Visa") }}</label>
                        <input type="file" multiple class="form-control font-style" name="visa_detail[]" 
                                id="file_input" capture onchange="updateFileList(this,'file_visa_detail')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        @if( array_key_exists('visa_detail',$CustImagesArr))
                        @foreach($CustImagesArr['visa_detail'] as $CustImg)
                            <!-- <script>console.log({{ $CustImg }});</script> -->
                            <!-- <div class="gallery-item">
                                <div class="image">
                                    <a href="{{ URL('public') }}/{{ $CustImg }}" target="_blank">
                                        <img src="{{ URL('public') }}/{{ $CustImg }}" style="max-width: 100%">
                                    </a>                        
                                </div>
                            </div> -->
                            <script>
                                addImageUrlToGallery({{ $CustImg }},'file_visa_detail');
                            </script>
                        @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="card mt-3">
        <div class="card-header"><h4>{{ __("Booking Details") }}</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <label>{{ __("Date of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" required onchange="fetchAvailableVehicles(event)" id="pickupDate" name="PickupDate" min="{{ date('Y-m-d') }}" >
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Time of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" id="pickupTime" onchange="fetchAvailableVehicles()" required name="PickupTime">
                </div>

                <!-- <div class="col-lg-3 mb-4">
                    <label>{{ __("Tarrif") }} <span class="text-danger">*</span></label>
                    <select class="form-control" required id="TarrifData" onchange="fetchAvailableVehicles()" name="tarrif_type">
                        <option value="">{{ __("Select") }}</option>
                        <option value="Daily">{{ __("Daily") }}</option>
                        <option value="Weekly">{{ __("Weekly") }}</option>
                        <option value="Monthly">{{ __("Monthly") }}</option>
                    </select>
                </div> -->

                <div class="col-lg-4 mb-4">
                    <label id="UpdateTextDay">{{ __("No of Days") }} <span class="text-danger">*</span></label>
                    <input type="number" step="0" class="form-control" name="tarrif_detail" required id="NoOfDays" onblur="fetchAvailableVehicles()" min=1 value=1>
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

                <div class="col-lg-9 mb-4">
                    <label>{{ __("Location of Pickup") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="pickup_location" id="pickup_location">
                </div>

                <div class="col-lg-3 mb-4">
                    <label>{{ __("Per day KM Allocation") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="km_allocation">
                </div>


                <div class="col-lg-3 mb-4">
                    <label>{{ __("Payment Mode") }} <span class="text-danger">*</span></label>
                    <select class="form-control" required name="payment_mode" id="payment_mode" onchange="PayMethod(this.value)">
                        <option value="">{{ __("Select") }}</option>
                        <option value="Cash">{{ __("Cash") }}</option>
                        <option value="Card">{{ __("Card") }}</option>
                        <option value="Credit">{{ __("Credit") }}</option>
                    </select>
                </div>

                <div class="col-lg-3 mb-4" id="ShowCardDiv" style="display: none">
                    <label>{{ __("Card Details") }} <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="card_details">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Additional Details like (Child Seat, GPS, Audio)") }}</label>
                    <input type="text" name="additional_info" class="form-control">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Note") }}</label>
                    <input type="text" name="booking_note" class="form-control">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>{{ __("Discount") }} <span class="text-danger">*</span></label>
                    <input type="text" name="discount_amount" class="form-control number" id="DiscountAmount" required value="0" onblur="fetchReviews()">
                </div>
                
                <div class="col-lg-4 mb-4">
                    <label>{{ __("Additional KM Amount") }} <span class="text-danger">*</span></label>
                    <input type="text " name="additional_kilometers_amount" class="form-control number" required value="0">
                </div>
                <div class="col-lg-3 mb-3 d-none">
                    <input type="text" name="invite_id" class="form-control number" id="invite_id" value="{{ @$InviteId }}">
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
    <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Save") }}'>

    {!! Form::close() !!}

        </div>
    </div>
    <!-- [ Main Content ] end -->
    </div>
</div>

<script type="text/javascript">
    //prefilling customer fields based on data  recieved
    @if(!empty($CustomerData)) 
        $('#title').val('{{ $CustomerData->title }}')
        $('#gender').val('{{ $CustomerData->gender }}');
        $('#nationality').val('{{ $CustomerData->nationality }}');
        $('#country_code').val('{{ $CustomerData->country_code }}');
    @endif

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

    $("#BookingForm").submit(function (event) {
            $("#LoginBtn").fadeOut("fast");
            $("#LoadingStatus").fadeIn("fast");
            $("#ErrorText").fadeOut("fast");
            $("#SuccessText").fadeOut("fast");
            
            var formObj = $(this);
            var formURL = formObj.attr("action");

            // var file_types = ['residency_card','passport_detail','driving_license','visa_detail'];
            // file_types.forEach(function(file_type, index) {
            //     console.log(`Element at index ${index} is ${file_type}`);
            //     var imageContainer = $("#file_"+file_type+"  .gallery");
            //     var fileInput = $("#file_"+file_type+" #file_input");
                
            //     var images = imageContainer.querySelectorAll('.gallery-item  img');
            //     console.log("images size - " + images.length);
            //     // var dt = new DataTransfer();
            //     images.forEach(function (image, index2) {
            //         console.log(`img at index2 ${index2} is`);
            //         // Access the image source and alt text
            //         // const src = image.getAttribute('src');
            //         // const alt = image.getAttribute('alt');

            //         // // Perform actions with the image data (example: log to console)
            //         // console.log(`Image ${index2 + 1}:`);
            //         // console.log(`Alt Text: ${alt}`);
            //         // console.log('---');

            //         // dt.items.add(new File([src],alt));
            //     });
            //     // fileInput.files = dt.files;
            // });

            console.log("return here");
            return;
            
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

    // function SaveManager(){
    //     $("#BookingForm").bind('submit',function(e) {
    //         $("#LoginBtn").fadeOut("fast");
    //         $("#LoadingStatus").fadeIn("fast");
    //         $("#ErrorText").fadeOut("fast");
    //         $("#SuccessText").fadeOut("fast");
            
    //         var formObj = $(this);
    //         var formURL = formObj.attr("action");

    //         var file_types = ['residency_card','passport_detail','driving_license','visa_detail'];
    //         file_types.forEach(function(file_type, index) {
    //             console.log(`Element at index ${index} is ${file_type}`);
    //             var imageContainer = $("#file_"+file_type+" #file_gallery");
    //             var fileInput = $("#file_"+file_type+" #file_input");
                
    //             var images = imageContainer.querySelectorAll('.gallery-item img');
    //             console.log("images size - " + images.length);
    //             // var dt = new DataTransfer();
    //             images.forEach(function (image, index2) {
    //                 console.log(`img at index2 ${index2} is`);
    //                 // Access the image source and alt text
    //                 // const src = image.getAttribute('src');
    //                 // const alt = image.getAttribute('alt');

    //                 // // Perform actions with the image data (example: log to console)
    //                 // console.log(`Image ${index2 + 1}:`);
    //                 // console.log(`Alt Text: ${alt}`);
    //                 // console.log('---');

    //                 // dt.items.add(new File([src],alt));
    //             });
    //             // fileInput.files = dt.files;
    //         });
            
    //         if( window.FormData !== undefined ) {
    //             var formData = new FormData(this);
    //             $.ajax({
    //               url: formURL,
    //               type: "POST",
    //               data:  formData,
    //               contentType: false,
    //               cache: false,
    //               processData:false,
    //               success: function( data, textStatus, jqXHR ) {
    //                   JsData = JSON.parse(data);
                      
    //                   if(JsData.Status == 0){
    //                       $("#ErrorText").html(JsData.Message);
    //                       $("#ErrorText").fadeIn("fast");
                          
    //                       $("#LoginBtn").fadeIn("fast");
    //                       $("#LoadingStatus").fadeOut("fast");
    //                   }else{
    //                       $("#SuccessText").html(JsData.Message);
    //                       $("#SuccessText").fadeIn("fast");
    //                       window.location = "{{ URL('booking') }}";
    //                   }
    //                   hideloading();
    //               },
    //               error: function( jqXHR, textStatus, errorThrown ) {
    //                   $("#ErrorText").html("Some Error Occure. Please Try Again Later");
    //                   $("#ErrorText").fadeIn("fast");
                      
    //                   $("#LoginBtn").fadeIn("fast");
    //                   $("#LoadingStatus").fadeOut("fast");
    //                   hideloading();
    //               }
    //             });
    //             e.preventDefault();
    //         }
    //     });
    // }

    function PayMethod(val){
        if(val != "Card"){
            $("#ShowCardDiv").css("display", "none");
        }else{
            $("#ShowCardDiv").css("display", "block");
        }
    }

    function SearchCustomer(){
        Query = $("#SearchTerm").val();
        if(Query == ""){
            return;
        }
        $("#errormsg").html("");

        $.ajax({
          url: "{{ URL('CustomerSearch') }}",
          method: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            term: Query,
          },
          success: function( data, textStatus, jqXHR ) {
              JsData = JSON.parse(data);
              //console.log(JsData);
              $CustomerId = JsData.id;
              if(JsData.title != null){
                  $("#dob").val(JsData.dob);
                  $("#email").val(JsData.email);
                  $("#first_name").val(JsData.first_name);
                  $("#gender").val(JsData.gender);
                  $("#insurance").val(JsData.insurance);
                  //$("#last_name").val(JsData.last_name);
                  //$("#middle_name").val(JsData.middle_name);
                  $("#mobile").val(JsData.mobile);
                  $("#country_code").val(JsData.country_code);
                  $("#nationality").val(JsData.nationality);
                  $("#permanent_address").val(JsData.permanent_address);
                  $("#temp_address").val(JsData.temp_address);
                  $("#title").val(JsData.title);
                  //$("#label_file_residency_card").html(JsData.residency_card);
                  //$("#img_passport_detail").src = "/public/"+JsData.passport_detail;

                  $(".gallery").empty(); //clear off gallery
                  //get images
                    $.ajax({
                        url: "{{ URL('getCustomerImages') }}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            customerId: $CustomerId,
                        },
                        success: function( data, textStatus, jqXHR ) {
                            JsData = JSON.parse(data);
                            for (var key in JsData) {
                                for (var i = 0; i < JsData[key].length; i++) {
                                    addImageUrlToGallery(JsData[key][i], "file_"+key);
                                }
                            }
                        },
                        error: function( jqXHR, textStatus, errorThrown ) {
                            alert("fail to get images");
                            $(".gallery").empty();
                        }              
                    });

              }else{
                $("#errormsg").html("Customer Not Found");
              }
          },
          error: function( jqXHR, textStatus, errorThrown ) {
              
          }
        });
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

