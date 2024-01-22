@extends("layout.default")

@section("content")


</style>
<script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>
<script src="{{ URL('resources/js/customer.js') }}"></script>

<!-- [ Main Content ] start -->
<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">{{ __("Add Customer") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Add Customer") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
        {!! Form::open(['url' => 'customer', 'id' => 'CustomerForm', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
        <div class="card ">
        <div class="card-body">
            <div class="row mt-4">
              <div class="col-lg-12 pr-2 pl-2 ">
                <fieldset class="mb-4 border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Basic Information</legend>
                <div class="row">
                <div class="col-lg-1 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Salutation") }} <span class="text-danger">*</span></label>
                    <select class="form-control font-style" name="title" id="title" required>
                        <option value="">{{ __("Select") }}</option>
                        <option @if($Customer->title == "Mr.") selected @endif >Mr.</option>
                        <option @if($Customer->title == "Mrs.") selected @endif >Mrs.</option>
                        <option @if($Customer->title == "Miss.") selected @endif >Miss.</option>
                        <option @if($Customer->title == "Dr.") selected @endif >Dr.</option>
                        <option @if($Customer->title == "Eng.") selected @endif >Eng.</option>
                        <option @if($Customer->title == "Coln.") selected @endif >Coln.</option>
                        <option @if($Customer->title == "M/s.") selected @endif >M/s</option>
                        <option @if($Customer->title == "Ms.") selected @endif >Ms.</option>
                    </select>
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Name") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-style" name="first_name" id="first_name" value="{{ @$Customer->first_name }}" required>
                </div>
               <!-- <div class="col-lg-3 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Middle Name") }}</label>
                    <input type="text" class="form-control font-style" name="middle_name" id="middle_name" value="{{ @$Customer->middle_name }}">
                </div>

                <div class="col-lg-3 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Last Name") }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-style" name="last_name" id="last_name" value="{{ @$Customer->last_name }}" required>
                </div> -->

                <div class="col-lg-2 mb-1">
                    <label for="subject" class="col-form-label text-dark">{{ __("Gender") }} <span class="text-danger">*</span></label>
                    <select class="form-control font-style" name="gender" id="gender" required>
                        <option value="">{{ __("Select") }}</option>
                        <option @if(@$Customer->gender == "Male") selected @endif value="Male">{{ __("Male") }}</option>
                        <option @if(@$Customer->gender == "Female") selected @endif value="Female">{{ __("Female") }}</option>
                    </select>
                </div>

                <div class="col-lg-2 mb-4">
                    <label for="subject" class="col-form-label text-dark">{{ __("Date of Birth") }} <span class="text-danger">*</span></label>
                    <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$Customer->dob }}" required>
                   <!-- <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$Customer->dob }}" required max="{{ date('Y-m-d', strtotime('-18 year')) }}"> -->
                </div>

                <div class="col-lg-2 mb-2">
                    <label for="subject" class="col-form-label text-dark">{{ __("Nationality") }} <span class="text-danger">*</span></label>
                    <select class="form-control font-style" name="nationality" id="nationality" required>
                        <option value="">{{ __("Select") }}</option>
                        @foreach($Conuntry as $Cont)
                        <option value="{{ $Cont->name }}">{{ $Cont->name }}</option>
                        @endforeach
                    </select>
                </div>
                <script>
                    $("#nationality").val("{{ $Customer->nationality }}");
                </script>

                    <div class="col-lg-4 mb-4">
                        <label for="subject" class="col-form-label text-dark">{{ __("Email") }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-style" name="email" id="email" value="{{ @$Customer->email }}" required>
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
                    <script>
                        $("#country_code").val("{{ $Customer->country_code }}");
                    </script>
                    <div class="col-lg-4 mb-4">
                        <label for="subject" class="col-form-label text-dark">{{ __("Mobile") }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-style" name="mobile" id="mobile" value="{{ @$Customer->mobile }}" required>
                    </div>
                  </div>
                </fieldset>
                </div>
                <div class="col-lg-3 pr-2 pl-2 ">
                    <fieldset class="mb-4 border rounded-3 p-3">
                    <legend class="float-none w-auto px-3">Passport Details</legend>
                        <div class="mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Passport No.") }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-style" name="passport_num" id="passport_num" value="{{ @$Customer->passport_num }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Passport Valid upto.") }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control font-style" name="passport_valid_upto" id="passport_valid_upto" value="{{ @$Customer->passport_valid_upto }}" required>
                        </div>
                    </fieldset>
                </div>
                <div class="col-lg-3 pr-2 pl-2 ">
                    <fieldset class="mb-4 border rounded-3 p-3">
                    <legend class="float-none w-auto px-3">Civil ID Details</legend>
                        <div class="mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("ID No.") }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-style" name="id_num" id="id_num" value="{{ @$Customer->id_num }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("ID Valid upto.") }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control font-style" name="id_valid_upto" id="id_valid_upto" value="{{ @$Customer->id_valid_upto }}" required>
                        </div>
                    </fieldset>
                </div>

                <div class="col-lg-6 pr-2 pl-2 ">
                <fieldset class="mb-4 pr-2 pl-2 border rounded-3 p-3">
                <legend class="float-none w-auto px-3">Driving License</legend>
                    <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label for="subject" class="col-form-label text-dark">{{ __("DL No.") }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-style" name="driving_license_num" id="driving_license_num" value="{{ @$Customer->driving_license_num }}" required>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="subject" class="col-form-label text-dark">{{ __("DL Valid upto.") }} <span class="text-danger">*</span></label>
                        <input type="date" class="form-control font-style" name="driving_lic_valid_upto" id="driving_lic_valid_upto" value="{{ @$Customer->driving_lic_valid_upto }}" required>
                    </div>
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="col-form-label text-dark">{{ __("DL Issued by") }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control font-style" name="driving_lic_issuedby" id="driving_lic_issuedby" value="{{ @$Customer->driving_lic_issuedby }}" required>
                    </div>
                </fieldset>
                </div>

                <div class="pr-2 pl-2 ">
                <fieldset class="mb-4 pr-2 pl-2 border rounded-3 p-3">
                    <legend class="float-none w-auto px-3">Address</legend>
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="subject" class="col-form-label text-dark">{{ __("Permanent") }} <span class="text-danger">*</span></label>
                            <textarea type="text" rows=5 class="form-control font-style" name="permanent_address" id="permanent_address" required>{{ @$Customer->permanent_address }}</textarea>
                        </div>
                    
                        <div class="col-1">
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Communication") }}</label>
                                <textarea type="text" rows=5 class="form-control font-style" name="temp_address" id="temp_address">{{ @$Customer->temp_address }}</textarea>
                            </div>
                        </div>
                        <div class="form-check col-1" style="place-item: center;">
                            <button type="button" class="btn btn-primary" id="copy_addr">Copy</button>
                        </div>                    
                    </div>
                </fieldset>
                </div>

                <div class="col-lg-6 pr-2 pl-2 ">
                    <fieldset class="mb-4 pr-2 pl-2 border rounded-3 p-3">
                        <legend class="float-none w-auto px-3">{{ __("Insurance Details") }}</legend>
                        <textarea type="text" rows=5 class="form-control font-style" name="insurance" id="insurance">{{ @$Customer->insurance }}</textarea>
                    </fieldset>
                </div>

                <div class="pr-2 pl-2 ">
                    <fieldset class="mb-4 border rounded-3 p-3">
                    <legend class="float-none w-auto px-3">Upload Documents</legend>
                    <div class="row">
                <div class="col-lg-3 mb-4">
                    <div id="file_residency_card">
                        <label for="subject" class="col-form-label text-dark">{{ __("Resident Card") }}</label>
                        <input type="file" multiple class="form-control font-style file_input" name="residency_card[]" 
                                id="file_residency_card_input" capture onchange="updateFileList(this,'file_residency_card')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div id="file_passport_detail">
                        <label for="subject" class="col-form-label text-dark">{{ __("Passport") }}</label>
                        <input type="file" multiple class="form-control font-style file_input" name="passport_detail[]" 
                                id="file_passport_detail_input" capture onchange="updateFileList(this,'file_passport_detail')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div id="file_driving_license">
                        <label for="subject" class="col-form-label text-dark">{{ __("Driving License") }} <span class="text-danger">*</span></label>
                        <input type="file" multiple class="form-control font-style file_input" name="driving_license[]" 
                                id="file_driving_license_input" capture onchange="updateFileList(this,'file_driving_license')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mb-4">
                    <div id="file_visa_detail">
                        <label for="subject" class="col-form-label text-dark">{{ __("Visa") }}</label>
                        <input type="file" multiple class="form-control font-style file_input" name="visa_detail[]" 
                                id="file_visa_detail_input" capture onchange="updateFileList(this,'file_visa_detail')"
                                accept=".jpg,.jpeg,.png" >
                        <div id="file_gallery" class="gallery">
                        </div>
                    </div>
                </div>
                </div>
                </fieldset>
                </div>
            </div>
        </div>
    </div>



    <!-- <div class="alert alert-danger" id="ErrorText" style="display: none"></div>
    <div class="alert alert-success" id="SuccessText" style="display: none"></div>

    <div id="LoadingStatus" style="display: none" class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div> -->

    <!-- <button class="btn btn-xs btn-primary" onClick="SaveManager()" id="LoginBtn">{{ __("Save") }}</button> -->
    <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Save") }}'>

    {!! Form::close() !!}

    <script>
    $("#CustomerForm").bind('submit',function(e) {
        
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
                            toastr["error"](JsData.Message);
                      }else{
                            var cust_id = JsData.Data.customer_id;
                            console.log(cust_id);
                            window.location.href = "{{ URL('customer') }}/"+cust_id+"/edit";
                      }
                  },
                  error: function( jqXHR, textStatus, errorThrown ) {
                    //some other error.
                  }
                });
                e.preventDefault();
            }
    });

    function deleteFile(args){
        var formdata = new FormData();
        formdata.append('customer_id', args.customer_id);
        formdata.append('image_id',args.id);

        $.ajax({
            url: "{{ URL('Customer/deleteFile') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formdata,
            contentType: false,
            cache: false,
            processData:false,
            success: function( data, textStatus, jqXHR ) {
                JsData = JSON.parse(data);
                console.log(JsData);
                if(JsData.Status == 0){
                    toastr["error"](JsData.Message);
                }else{
                    toastr["success"]("file deleted successfully")
                }
            },
            error: function( jqXHR, textStatus, errorThrown ) {
            //error handle herer TODO
                toastr["error"]("Internal Error");
            }
        });

    }

    function uploadFiles(fileInput, parentDivId){
        console.log("upload file called");
        var files = fileInput.files;
        var type = parentDivId.slice(5);   // for 'file_residency_card' it will return 'residency_card'

        var formdata = new FormData();
        formdata.append('customer_id', CustomerId);
        formdata.append('type',type);
        for (var i = 0; i < files.length; i++) {
            formdata.append('files[]', files[i]);
        }
        console.log(formdata);


        $.ajax({
            url: "{{ URL('Customer/uploadFiles') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formdata,
            contentType: false,
            cache: false,
            processData:false,
            success: function( data, textStatus, jqXHR ) {
                JsData = JSON.parse(data);
                console.log(JsData);
                if(JsData.Status == 0){
                    toastr["error"](JsData.Message);
                }else{
                    for (var key in JsData.Data) {
                            for (var i = 0; i < JsData.Data[key].length; i++) {
                                var delHandlerArgs = {"id":JsData.Data[key][i].id, "customer_id":CustomerId};
                                addImageUrlToGallery(JsData.Data[key][i], "file_"+key, deleteFile, delHandlerArgs);
                            }
                    }
                    toastr["success"]("file uploaded successfully")
                }
            },
            error: function( jqXHR, textStatus, errorThrown ) {
            //error handle herer TODO
                toastr["error"]("Internal Error");
            }
        });
        event.preventDefault();

    }

    </script>

        </div>
    </div>
    <!-- [ Main Content ] end -->
    </div>
</div>

@endsection