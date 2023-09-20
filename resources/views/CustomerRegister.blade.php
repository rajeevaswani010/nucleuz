@extends("layout.front")

@section("content")

<script src="{{ URL('public/newasserts/js/jquery.min.js') }}"></script>
<script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>
<script src="{{ URL('resources/js/customer.js') }}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="{{ URL('resources/css/app.css') }}">
<script src="{{ URL('resources/js/app.js') }}"></script>

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div
        class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
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

    {!! Form::open(['url' => 'CustomerRegister', 'id' => 'BookingForm', 'enctype' => 'multipart/form-data', 'method' =>
    'POST']) !!}
    <input type="text" class="form-control" name="invite_id" value="{{ $InviteObj->id }}" hidden>

    <div class="card">
        <div class="card-header">
            <h4>Customer Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2 mb-4">
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

                <div class="col-lg-6 mb-4">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="first_name" value="{{ $Customer->first_name }}" required>
                </div>

               <!-- <div class="col-lg-3 mb-4">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" name="middle_name" value="{{ $Customer->middle_name }}">
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="last_name" value="{{ $Customer->last_name }}" required>
                </div> -->

                <div class="col-lg-2 mb-4">
                    <label>Gender <span class="text-danger">*</span></label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="col-lg-2 mb-4">
                    <label>Nationality <span class="text-danger">*</span></label>
                    <select class="form-control" name="nationality" id="nationality" required>
                        <option value="">Select</option>
                        @foreach($Conuntry as $Cont)
                            <option value="{{ $Cont->name }}">{{ $Cont->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 mb-4">
                    <label>Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="dob" value="{{ $Customer->dob }}" required>
                </div>


                <div class="col-lg-4 mb-4">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" value="{{ $Customer->email }}" required
                        readonly>
                </div>

                <div class="col-lg-2 mb-4">
                    <label>Country Code <span class="text-danger">*</span></label>
                    <select class="form-control" name="country_code" id="country_code" required>
                        <option value="">Select</option>
                        @foreach($Conuntry as $Cont)
                            <option value="{{ $Cont->phonecode }}">{{ $Cont->name }} - {{ $Cont->phonecode }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Mobile <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="mobile" value="{{ $Customer->mobile }}" required>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Insurance Details</label>
                    <!-- <input type="text" class="form-control" name="insurance" value="{{ $Customer->insurance }}"> -->
                    <textarea type="text" class="form-control" name="insurance"  rows="3"
                    required>{{ $Customer->insurance }}</textarea>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Communication Address</label>
                    <textarea type="text" class="form-control"   rows="3"
                        name="temp_address">{{ $Customer->temp_address }}</textarea>
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Permanent Address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="permanent_address"   rows="3"
                        required>{{ $Customer->permanent_address }}</textarea>
                </div>
                <div class="row mr-1 ml-1">
                <div class="col-lg-2 mb-2">
                    <label for="subject"
                        class="col-form-label text-dark">{{ __("Resident Card") }}</label>
                    <input type="file" multiple class="form-control font-style" name="residency_card[]"
                        id="file_residency_card" capture onchange="updateFileList(this,'file_residency_card-gallery')"
                        accept=".jpg,.jpeg,.png">
                    <div id="file_residency_card-gallery" class="gallery">
                    </div>
                </div>
                <div class="col-lg-1 mb-1"><b>OR</b></div>
                <div class="col-lg-2 mb-2">
                    <label for="subject" class="col-form-label text-dark">{{ __("Passport") }}</label>
                    <input type="file" multiple class="form-control font-style" name="passport_detail[]"
                        id="file_passport_detail" capture onchange="updateFileList(this,'file_passport_detail-gallery')"
                        accept=".jpg,.jpeg,.png">
                    <div id="file_passport_detail-gallery" class="gallery">
                    </div>
                </div>

                <div class="col-lg-1"></div>
                <div class="col-lg-3 mb-2">
                    <label for="subject"
                        class="col-form-label text-dark">{{ __("Driving License") }} <span
                            class="text-danger">*</span></label>
                    <input type="file" multiple class="form-control font-style" name="driving_license[]"
                        id="file_driving_license" capture onchange="updateFileList(this,'file_driving_license-gallery')"
                        accept=".jpg,.jpeg,.png">
                    <div id="file_driving_license-gallery" class="gallery">
                    </div>
                </div>

                <div class="col-lg-3 mb-2">
                    <label for="subject" class="col-form-label text-dark">{{ __("Visa") }}</label>
                    <input type="file" multiple class="form-control font-style" name="visa_detail[]"
                        id="file_visa_detail" capture onchange="updateFileList(this,'file_visa_detail-gallery')"
                        accept=".jpg,.jpeg,.png">
                    <div id="file_visa_detail-gallery" class="gallery">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4>Booking Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 mb-8">
                    <label>Vehicle <span class="text-danger">*</span></label>
                    <select class="form-control" required id="VehicleData" onchange="fetchReviews()" name="vehicle_id">
                        <option value="">Select</option>
                        @foreach($VehicleTypes as $vehicle)
                            <option value="{{ $vehicle->car_type }}">{{ $vehicle->car_type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- <div class="col-lg-4 mb-4">
                    <label>Tarrif <span class="text-danger">*</span></label>
                    <select class="form-control" required id="TarrifData" onchange="fetchReviews()" name="tarrif_type">
                        <option value="">Select</option>
                        <option>Daily</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                    </select>
                </div> -->

                <div class="col-lg-4 mb-4">
                    <label id="UpdateTextDay">No of Days <span class="text-danger">*</span></label>
                    <input type="number" step="0" class="form-control" name="tarrif_detail" required id="NoOfDays"
                        onblur="fetchReviews()">
                </div>

                <div class="col-lg-4 mb-5">
                    <label>Date of Pickup <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" required name="PickupDate" id="pickupDate"
                        min="{{ date('Y-m-d') }}">
                </div>

                <div class="col-lg-3 mb-4">
                    <label>Time of Pickup <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" required name="PickupTime" id="pickupTime">
                </div>

                <div class="col-lg-5 mb-3">
                    <label>Location of Pickup <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="pickup_location">
                </div>

                <div class="col-lg-4 mb-4">
                    <label>Payment Mode <span class="text-danger">*</span></label>
                    <select class="form-control" required name="payment_mode" onchange="PayMethod(this.value)">
                        <option value="">Select</option>
                        <option>Cash</option>
                        <option>Card</option>
                        <option>Credit</option>
                    </select>
                </div>

                <div class="col-lg-4 mb-4" id="ShowCardDiv" style="display: none">
                    <label>Card Details <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="card_details">
                </div>

            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4>Tentative Billable Amount</h4>
        </div>
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
            <div class="float-right"><span style="float-right font-style:italic; color:red;">{{ __("*The above value may change at the time of vehicle return") }}</span> </div>
        </div>
    </div>

    <div class="alert alert-danger" id="ErrorText" style="display: none"></div>
    <div class="alert alert-success" id="SuccessText" style="display: none"></div>

    <div id="LoadingStatus" style="display: none" class="spinner-border text-primary" role="status"><span
            class="sr-only">Loading...</span></div>
    <button class="btn btn-success mt-4" onClick="SaveManager()" id="LoginBtn">Submit</button>
    {!! Form::close() !!}
</div>

@endsection


@section("ExtraJS")
<script type="text/javascript">
    //prefilling customer fields based on data  recieved
    $('#title').val('{{ $Customer->title }}')
    $('#gender').val('{{ $Customer->gender }}');
    $('#nationality').val('{{ $Customer->nationality }}');
    $('#country_code').val('{{ $Customer->country_code }}');

    function fetchReviews() {
        // if($("#TarrifData").val() == "Daily"){
        //     $("#UpdateTextDay").html('No of Days <span class="text-danger">*</span>');
        // }

        // if($("#TarrifData").val() == "Weekly"){
        //     $("#UpdateTextDay").html('No of Weeks <span class="text-danger">*</span>');
        // }

        // if($("#TarrifData").val() == "Monthly"){
        //     $("#UpdateTextDay").html('No of Months <span class="text-danger">*</span>');
        // }

        $.ajax({
            url: "{{ URL('Customer/Review') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                vehicle: $("#VehicleData").val(),
                // tarrif: $("#TarrifData").val(),
                days: $("#NoOfDays").val(),
                company: "{{ $InviteObj->company_id }}",
                tax: 5,
            },
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                JsData = JSON.parse(data);
                $("#LoadSubTotal").html(JsData.SubTotal);
                $("#LoadTax").html(JsData.Tax);
                $("#LoadGrandTotal").html(JsData.GrandTotal);
                $("#LoadDue").html(JsData.Due);
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    }

    function SaveManager() {
        $("#BookingForm").unbind('submit').bind('submit', function (e) {
            $("#LoginBtn").fadeOut("fast");
            $("#LoadingStatus").fadeIn("fast");
            $("#ErrorText").fadeOut("fast");
            $("#SuccessText").fadeOut("fast");

            var formObj = $(this);
            var formURL = formObj.attr("action");
            if (window.FormData !== undefined) {
                var formData = new FormData(this);
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data, textStatus, jqXHR) {
                        JsData = JSON.parse(data);

                        console.log(JsData);

                        if (JsData.Status == 0) {
                            $("#ErrorText").html(JsData.Message);
                            $("#ErrorText").fadeIn("fast");

                            $("#LoginBtn").fadeIn("fast");
                            $("#LoadingStatus").fadeOut("fast");
                        } else {
                            $("#SuccessText").html(JsData.Message);
                            $("#SuccessText").fadeIn("fast");
                            window.location = "{{ URL('thank-you') }}";
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
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

    function PayMethod(val) {
        if (val != "Card") {
            $("#ShowCardDiv").css("display", "none");
        } else {
            $("#ShowCardDiv").css("display", "block");
        }
    }

    $('.number').keyup(function () {
        var val = $(this).val();
        if (isNaN(val)) {
            val = val.replace(/[^0-9\.]/g, '');
            if (val.split('.').length > 2)
                val = val.replace(/\.+$/, "");
        }
        $(this).val(val);
    });
</script>
@endsection
