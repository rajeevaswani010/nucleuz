@extends("layout.default")

@section("content")


<!-- [ Main Content ] start -->
<link rel="stylesheet" href="{{ URL('resources/css/fileuploadwithpreview.css') }}">



<script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>
<script src="{{ URL('resources/js/customer.js') }}"></script>
<script src="{{ URL('resources/js/fileuploadwithpreview.js') }}"></script>

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
                        <div class="form-group col-lg-1 mb-4">
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

                        <div class="form-group col-lg-6 mb-4">
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

                        <div class="form-group col-lg-2 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Gender") }} <span class="text-danger">*</span></label>
                            <select class="form-control font-style" name="gender" id="gender" required>
                                <option value="">{{ __("Select") }}</option>
                                <option @if(@$Customer->gender == "Male") selected @endif value="Male">{{ __("Male") }}</option>
                                <option @if(@$Customer->gender == "Female") selected @endif value="Female">{{ __("Female") }}</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-3 mb-4">
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


                        <div class="form-group col-lg-2 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Date of Birth") }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$Customer->dob }}" required>
                        <!-- <input type="date" class="form-control font-style" name="dob" id="dob" value="{{ @$Customer->dob }}" required max="{{ date('Y-m-d', strtotime('-18 year')) }}"> -->
                        </div>

                        <div class="form-group col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Email") }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-style" name="email" id="email" value="{{ @$Customer->email }}" required>
                        </div>
                        
                        <div class="form-group col-lg-2 mb-4">
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


                        <div class="form-group col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Mobile") }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control font-style" name="mobile" id="mobile" value="{{ @$Customer->mobile }}" required>
                        </div>
                        <div class="form-group col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Insurance Details") }}</label>
                            <textarea type="text" class="form-control font-style" name="insurance" id="insurance">{{ @$Customer->insurance }}</textarea>
                        </div>

                        <div class="form-group col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Permanent Address") }} <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control font-style" name="permanent_address" id="permanent_address" required>{{ @$Customer->permanent_address }}</textarea>
                        </div>

                        <div class="form-group col-lg-4 mb-4">
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
                        
                    <div class="form-group col-6 mb-4">
                        <fieldset class="border rounded-3 p-3 mb-4">
                            <legend class="float-none w-auto px-3">{{ __("Resident Card Details") }}</legend>
                            <div class="row">
                            <div class="col-10">
                                <div id="residency_card" class="file-gallery">
                                    <!-- images will be added here..  -->
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFiles" data-filetype="residency_card">Add Files</button>
                            </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group col-6 mb-4">
                        <fieldset class="border rounded-3 p-3 mb-4">
                            <legend class="float-none w-auto px-3">{{ __("Passport Details") }}</legend>
                            <div class="row">
                            <div class="col-10">
                                <div id="passport_detail" class="file-gallery">
                                    <!-- images will be added here..  -->
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFiles" data-filetype="passport_detail">Add Files</button>
                            </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group col-6 mb-4">
                        <fieldset class="border rounded-3 p-3 mb-4">
                            <legend class="float-none w-auto px-3">{{ __("Driving License") }}</legend>
                            <div class="row">
                            <div class="col-10">
                                <div id="driving_license" class="file-gallery">
                                    <!-- images will be added here..  -->
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFiles" data-filetype="driving_license">Add Files</button>
                            </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group col-6 mb-4">
                        <fieldset class="border rounded-3 p-3 mb-4">
                            <legend class="float-none w-auto px-3">{{ __("Visa") }}</legend>
                            <div class="row">
                            <div class="col-10">
                                <div id="visa_detail" class="file-gallery">
                                    <!-- images will be added here..  -->
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFiles" data-filetype="visa_detail">Add Files</button>
                            </div>
                            </div>
                        </fieldset>
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
    <div class="modal" id="uploadFiles" tabindex="-1" role="dialog" aria-labelledby="uploadFilesModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload Files</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- <file-upload-preview id="car_conditions_image"></file-upload-preview> -->
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="float: left;" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="upload" class="btn btn-primary">Upload</button>
                </div>

            </div>
        </div>
    </div>

    <script>
    var CustomerId = {{ $Customer->id }};

    //load images
    $(document).ready(function() {
        $(".gallery").empty(); //clear off all gallery images
        var images = @json($Customer->images);

        for(var image of images) {
            console.log(image);
            var gallery = document.querySelector('#'+image["type"]);

            var div_gallery_item = document.createElement('div');
            div_gallery_item.classList.add("gallery-item");
            
            var href = document.createElement('a');
            href.classList.add("image");
            href.setAttribute("target","_blank");
            href.setAttribute("href",`{{ URL('public') }}/`+image["link"]);

            const img = document.createElement('img');
            img.setAttribute('src',`{{ URL('public') }}/`+image["link"]);
            href.appendChild(img);

            const delBtn = document.createElement('button');
            delBtn.addEventListener('click', function(id){
                deleteFile(
                    (id)=>{  //on delete success handler.. 
                        $('#'+id+".gallery-item").remove();
                    }
                );
            });
            delBtn.classList.add('del');
            delBtn.classList.add('btn');
            delBtn.classList.add('btn-danger');

            div_gallery_item.appendChild(href);
            div_gallery_item.appendChild(delBtn);
            div_gallery_item.setAttribute("id",image["id"]);

            gallery.appendChild(div_gallery_item);
        }

        //get images
        // getImages(CustomerId);
    });

    var uploadfiletype;

    $('#uploadFiles').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        uploadfiletype = button.data('filetype'); // Extract value from data-filetype attribute
        console.log("file-type: "+uploadfiletype);

        $('#uploadFiles .modal-body').empty();
        $('#uploadFiles .modal-body').append(`<file-upload-preview id="`+uploadfiletype+`"></file-upload-preview>`)                
    });

    $('#uploadFiles .modal-footer button#upload').click(function(){
            console.log("upload btn clicked");

            var fileinput = $('#uploadFiles .modal-body file-upload-preview input')[0]; //get first match. 

            __uploadFiles(
                "{{ URL('Customer/uploadFiles') }}"
                ,fileinput
                ,(formdata) => {
                    formdata.append("customer_id", {{ $Customer->id }});
                    formdata.append("type", uploadfiletype);
                }
                ,(JsData) => {
                    hideloading();
                    $('#uploadFiles').modal("hide");
                    window.location.reload();
                }
                ,(JsData) => {
                    toastr["error"](JsData.Message);
                }
            );
    });

    function deleteFile(onSuccessCb){
                const image_id = event.srcElement.parentElement.getAttribute("id");

                __doAjax (
                    "{{ URL('Customer/deleteFile') }}"
                    ,(formdata)=>{
                        formdata.append('customer_id', {{ $Customer->id }});
                        formdata.append('image_id',image_id);
                    }
                    ,(JsData) => {
                        onSuccessCb(image_id);
                        toastr["success"]("file deleted successfully")
                    }
                    ,(JsData) => {
                        toastr["error"](JsData.Message);
                    }
                );
            }

        //get customer images.. args:{"customer_id":CustomerId}
    // function getImages(CustomerId){
    //     var args = {"customer_id": CustomerId};
        
    //     doAjax (
    //         "{{ URL('getCustomerImages') }}"
    //         ,args
    //         ,(JsData) => {
    //             var data = JsData.Data;
    //             for (var key in data) {
    //                 for (var i = 0; i < data[key].length; i++) {
    //                     var delHandlerArgs = {"id":data[key][i].id, "customer_id":CustomerId};
    //                     addImageUrlToGallery(data[key][i], "file_"+key, deleteFile, delHandlerArgs);
    //                 }
    //             }
    //         }
    //         ,(JsData) => {
    //             alert("Fail to get images.Error:"+JsData.Status+" - "+JsData.Message);
    //         }
    //     );
    // }

    //delete customer file.. 
    // function deleteFile(args){
    //     var formdata = new FormData();
    //     formdata.append('customer_id', args.customer_id);
    //     formdata.append('image_id',args.id);

    //     //
    //     doAjax (
    //         "{{ URL('Customer/deleteFile') }}"
    //         ,formDataToJson(formdata)
    //         ,(JsData) => {
    //             toastr["success"]("file deleted successfully")
    //         }
    //         ,(JsData) => {
    //             toastr["error"](JsData.Message);
    //         }
    //     );
    // }

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