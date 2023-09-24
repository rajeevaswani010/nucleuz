@extends("layout.default")

@section("content")


<!-- [ Main Content ] start -->
<script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>
<script src="{{ URL('resources/js/customer.js') }}"></script>

<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">{{ __("Edit Customer") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Edit Customer") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
            {!! Form::open(['url' => 'customer/update/'.$Customer->id, 'id' => 'CustomerForm', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                <div class="card ">
                    <div class="card-header"><h4>{{ __('Customer Details') }}</h4></div>
                    <div class="card-body">
                    <div class="row mt-4">
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

                        <div class="col-lg-2 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Gender") }} <span class="text-danger">*</span></label>
                            <select class="form-control font-style" name="gender" id="gender" required>
                                <option value="">{{ __("Select") }}</option>
                                <option @if(@$Customer->gender == "Male") selected @endif value="Male">{{ __("Male") }}</option>
                                <option @if(@$Customer->gender == "Female") selected @endif value="Female">{{ __("Female") }}</option>
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
                        <script>
                            $("#nationality").val("{{ $Customer->nationality }}");
                        </script>


                        <div class="col-lg-2 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Date of Birth") }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$Customer->dob }}" required>
                        <!-- <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$Customer->dob }}" required max="{{ date('Y-m-d', strtotime('-18 year')) }}"> -->
                        </div>

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
                        <div class="col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Insurance Details") }}</label>
                            <textarea type="text" class="form-control font-style" name="insurance" id="insurance">{{ @$Customer->insurance }}</textarea>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Permanent Address") }} <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control font-style" name="permanent_address" id="permanent_address" required>{{ @$Customer->permanent_address }}</textarea>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Temp Address") }}</label>
                            <textarea type="text" class="form-control font-style" name="temp_address" id="temp_address">{{ @$Customer->temp_address }}</textarea>
                        </div>
                            
                        <div class="col mt-4">
                            
                            <input class="btn btn-xs btn-primary"  type="submit" value='{{ __("Save") }}'>

                            <a href="{{ URL('booking') }}/create?customerId={{ $Customer->id }}"
                                class="mx-3 btn  btn-primary align-items-center" style="float:right;" 
                                data-url="{{ URL('booking') }}/create"
                                title="Create Booking"
                                data-original-title="Edit">
                                Book A Car 
                            </a>
                        {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h4>{{ __('Upload documents') }}</h4></div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-3 mb-4">
                            <div id="file_residency_card">
                                <label for="subject" class="col-form-label text-dark">{{ __("Resident Card Details") }}</label>
                                <input type="file" multiple class="form-control font-style file_input" name="residency_card[]" 
                                        id="file_residency_card_input" capture onchange="uploadFiles(this, 'file_residency_card')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery mt-2">
                                </div>
                            </div>
                        </div>

                        <div class="col-3 mb-4">
                            <div id="file_passport_detail">
                                <label for="subject" class="col-form-label text-dark">{{ __("Passport Details") }}</label>
                                <input type="file" multiple class="form-control font-style file_input" name="passport_detail[]" 
                                        id="file_passport_detail_input" capture onchange="uploadFiles(this,'file_passport_detail')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery mt-2">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div id="file_driving_license">
                                <label for="subject" class="col-form-label text-dark">{{ __("Driving License") }} <span class="text-danger">*</span></label>
                                <input type="file" multiple class="form-control font-style file_input" name="driving_license[]" 
                                        id="file_driving_license_input" capture onchange="uploadFiles(this,'file_driving_license')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery mt-2">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div id="file_visa_detail">
                                <label for="subject" class="col-form-label text-dark">{{ __("Visa") }}</label>
                                <input type="file" multiple class="form-control font-style file_input" name="visa_detail[]" 
                                        id="file_visa_detail_input" capture onchange="uploadFiles(this,'file_visa_detail')"
                                        accept=".jpg,.jpeg,.png" >
                                <div id="file_gallery" class="gallery mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- <div class="alert alert-danger" id="ErrorText" style="display: none"></div>
    <div class="alert alert-success" id="SuccessText" style="display: none"></div>

    <div id="LoadingStatus" style="display: none" class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div> -->

    <!-- <button class="btn btn-xs btn-primary" onClick="SaveManager()" id="LoginBtn">{{ __("Save") }}</button> -->

    <script>
    var CustomerId = {{ $Customer->id }};

    //load images
    $(document).ready(function() {
        $(".gallery").empty(); //clear off all gallery images

        //get images
        getImages(CustomerId);
    });

        //get customer images.. args:{"customer_id":CustomerId}
    function getImages(CustomerId){
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

    $("#CustomerForm").bind('submit',function(e) {
        var formObj = $(this);
        var formURL = formObj.attr("action");

        if( window.FormData !== undefined ) {
            var formData = new FormData(this);

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
    </script>

        </div>
    </div>
    <!-- [ Main Content ] end -->
    </div>
</div>

@endsection