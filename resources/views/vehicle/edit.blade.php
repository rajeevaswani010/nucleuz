@extends("layout.default")

@section("content")

<link rel="stylesheet" href="{{ URL('resources/css/fileuploadwithpreview.css') }}">
<script src="{{ URL('resources/js/fileuploadwithpreview.js') }}"></script>

<style>
#statusactive:checked + label {
    background-color: #198754 !important;
    color: white;
    font-weight: bold;
}

#statusservice:checked + label {
  background-color: #ffa21d !important;
  color: white;
  font-weight: bold;
}

#statusrepair:checked + label {
  background-color: #dc3545 !important;
  color: white;
  font-weight: bold;
}

/* #vehicleinfo.card {
    border-right: 5px solid green;
} */

.flex {
    display: flex;
    align-items: center;
    justify-content: center;
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
                            <h4 class="m-b-10">{{ __("Edit Vehicle") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Edit Vehicle") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card" id="vehicleinfo">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'vehicle/'.$Data->id, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}

                    <div class="row">

                        <div class="row">
                            <div class="form-group col-2">
                                <profile-image-preview 
                                    id="_{{ $Data->id }}" 
                                    @if( $Data->car_image != null )
                                    src="{{ URL('public') }}/{{ $Data->car_image }}"
                                    @endif
                                    > 
                                </profile-image-preview>
                                <!-- <label for="subject" class="col-form-label text-dark">{{ __("Car Image") }}</label>
                                <input class="form-control font-style"  name="car_image" accept="image/png, image/gif, image/jpeg" type="file"  />

                                @if($Data->car_image != "")
                                <a href="{{ URL('public') }}/{{ $Data->car_image }}" target="_blank"><img src="{{ URL('public') }}/{{ $Data->car_image }}" style="width: 200px;"></a>
                                @endif -->
                            </div>

                            <div class="form-group col-6" >
                                <div class="row">
                                    <div class="col-6">
                                        <label for="from" class="col-form-label text-dark">{{ __("Car Type") }}</label>
                                        <select class="form-control font-style" name="car_type" required >
                                            <option value="">{{ __("--Select--") }}</option>
                                            @foreach($AllCarTypes as $CarType)
                                            <option @if($Data->car_type == $CarType->name) selected @endif value="{{ $CarType->name }}">{{ $CarType->name }}</option>
                                            @endforeach
                                            <!-- <option @if($Data->car_type == "hatchback") selected @endif value="Hatchback">{{ __("Hatchback") }}</option>
                                            <option @if($Data->car_type == "sedan") selected @endif value="Sedan">{{ __("Sedan") }}</option>
                                            <option @if($Data->car_type == "suv") selected @endif value="Suv">{{ __("SUV") }}</option>
                                            <option @if($Data->car_type == "muv") selected @endif value="Muv">{{ __("MUV") }}</option>
                                            <option @if($Data->car_type == "coupe") selected @endif value="Coupe">{{ __("Coupe") }}</option>
                                            <option @if($Data->car_type == "convertibles") selected @endif value="Convertibles">{{ __("Convertibles") }}</option>
                                            <option @if($Data->car_type == "pickup trucks") selected @endif value="Pickup Trucks">{{ __("Pickup Trucks") }}</option>
                                            <option @if($Data->car_type == "4wd") selected @endif value="4wd">{{ __("4WD") }}</option> -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="from" class="col-form-label text-dark">{{ __("Make") }}</label>
                                        <select class="form-control font-style" name="make" required >
                                            <option value="">{{ __("Select") }}</option>
                                            @foreach($AllBrands as $Brnd)
                                            <option @if($Data->make == $Brnd->name) selected @endif value="{{ $Brnd->name }}">{{ $Brnd->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="subject" class="col-form-label text-dark">{{ __("Model") }}</label>
                                        <input class="form-control font-style" required name="model" value="{{ $Data->model }}" type="text"  />
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="subject" class="col-form-label text-dark">{{ __("Variant") }}</label>
                                        <input class="form-control font-style" required name="variant" value="{{ $Data->variant }}" type="text"  />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-4">  <!-- vehicle status -->
                                <div  style="float:right;">
                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group" id="statusradio">
                                        <input type="radio" class="btn-check" name="status" id="statusactive" autocomplete="off" value="1" @if($Data->status == 1) checked @endif >
                                        <label class="btn btn-lg btn-outline-success" for="statusactive">Active</label>

                                        <input type="radio" class="btn-check" name="status" id="statusservice" value="2" autocomplete="off" @if($Data->status == 2) checked @endif >
                                        <label class="btn btn-lg btn-outline-warning" for="statusservice">Service</label>

                                        <input type="radio" class="btn-check" name="status" id="statusrepair" value="3" autocomplete="off" @if($Data->status == 3) checked @endif>
                                        <label class="btn btn-lg btn-outline-danger" for="statusrepair">Repair</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <fieldset class="mb-4 border rounded-3 p-3">
                            <!-- <legend class="float-none w-auto px-3">Other Details</legend> -->
                            <div class="row">
                            <div class="form-group col-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Chasis Number") }}</label>
                                <input class="form-control font-style"  name="chasis_no" value="{{ $Data->chasis_no }}" type="text"  />
                            </div>

                            <div class="form-group col-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Engine Number") }}</label>
                                <input class="form-control font-style"  name="engine_no" value="{{ $Data->engine_no }}" type="text"  />
                            </div>

                            <div class="form-group col-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Registration Number") }}</label>
                                <input class="form-control font-style"  name="reg_no" value="{{ $Data->reg_no }}" type="text"  />
                            </div>

                            <div class="form-group col-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("KM Reading") }}</label>
                                <input class="form-control font-style"  name="km_reading" value="{{ $Data->km_reading }}" type="text"  />
                            </div>


                            <div class="form-group col-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Fuel Level Reading") }}</label>
                                <input class="form-control font-style"  name="fuel_level_reading"  value="{{ $Data->fuel_level_reading }}" type="text"  />
                            </div>


                            <div class="form-group col-4">
                                <label for="subject" class="col-form-label text-dark">{{ __("Current Condition") }}</label>
                                <input class="form-control font-style"  name="current_condition" value="{{ $Data->current_condition }}" type="text"  />
                            </div>
                            </div>
                        </fieldset>
                        <div class="row mt-4 mb-2">
                        <!-- <div class="form-group col-4 mt-4">
                            <input class="form-check-input" type="checkbox" name="ac">
                            <label for="subject" class="form-check-label text-dark" style="margin-left:6px;" >{{ __("AC") }}</label>
                        </div> -->
                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("AC") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ac" id="ac1" value="yes" @if( $Data->ac == "yes") checked @endif>
                                <label class="form-check-label" for="ac1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ac" id="ac2" value="no" @if( $Data->ac  == "no") checked @endif >
                                <label class="form-check-label" for="ac2">
                                    No
                                </label>
                            </div>
                        </div>


                        <!-- <div class="form-group col-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Audio") }}</label>
                            <input class="form-control font-style"  name="Audio" value="{{ $Data->Audio }}" type="text"  />
                        </div> -->
                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("Audio") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Audio" id="Audio1" value="yes" @if( $Data->Audio == "yes") checked @endif>
                                <label class="form-check-label" for="Audio1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Audio" id="Audio2" value="no" @if( $Data->Audio  == "no") checked @endif >
                                <label class="form-check-label" for="Audio2">
                                    No
                                </label>
                            </div>
                        </div>

                        <!-- <div class="form-group col-2">
                            <label for="subject" class="col-form-label text-dark">{{ __("GPS") }}</label>
                            <input class="form-control font-style"  name="gps" value="{{ $Data->gps }}" type="text"  />
                        </div> -->
                        <div class="form-group col-3">
                            <label for="subject" class="form-check-label text-dark" style="margin-right:10px;" >{{ __("GPS") }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gps" id="gps1" value="yes" @if( $Data->gps == "yes") checked @endif>
                                <label class="form-check-label" for="gps1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gps" id="gps2" value="no" @if( $Data->gps  == "no") checked @endif >
                                <label class="form-check-label" for="gps2">
                                    No
                                </label>
                            </div>
                        </div>

                        </div>



                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">{{ __("Insurance Details") }}</label>
                            <textarea class="form-control font-style" rows=5 name="insurance_detail">{{ $Data->insurance_detail }}</textarea>
                        </div>



                        <div class="modal-footer">
                            <input class="btn btn-xs btn-primary" type="submit" value="Save">
                        </div>
                        {!! Form::close() !!}

                        @if(Session::has('Danger'))
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                            <div class="alert-text">{!!Session::get('Danger')!!}</div>
                        </div>
                        @endif
                        
                    </div>

                </div>
            </div>
            <div class="card" id="vehicledocs">
                <div class="card-body ">

                <fieldset class="border rounded-3 p-3 mb-4">
                <legend class="float-none w-auto px-3">{{ __("Car Condition") }}</legend>
                <div class="row">
                <div class="col-11">
                    <div id="car_condition" class="file-gallery">
                        <!-- images will be added here..  -->

                        <!-- <div class="gallery-item">
                            @if($Data->car_condition_image != "")
                            <a href="{{ URL('public') }}/{{ $Data->car_condition_image }}" class="image" target="_blank">
                                <img src="{{ URL('public') }}/{{ $Data->car_condition_image }}" style="width: 200px;">
                            </a>
                            <button type="button" class="btn btn-danger del"></button>
                            @endif
                        </div>
                         -->
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFiles" data-filetype="car_condition">Add Files</button>
                </div>
                </div>
                </fieldset>

                <fieldset class="border rounded-3 p-3  mb-4">
                <legend class="float-none w-auto px-3">{{ __("Mulkiya Details") }}</legend>
                <div class="row">
                <div class="col-11">
                    <div id="mulkiya_details" class="file-gallery">
                        <!-- images will be added here..  -->
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFiles" data-filetype="mulkiya_details">Add Files</button>
                </div>
                </div>
                </fieldset>


                <fieldset class="border rounded-3 p-3 mb-4">
                <legend class="float-none w-auto px-3">{{ __("Insurance") }}</legend>
                <div class="row">
                <div class="col-11">
                    <div id="insurance" class="file-gallery">
                        <!-- images will be added here..  -->
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadFiles" data-filetype="insurance">Add Files</button>
                </div>
                </div>
                </fieldset>
                </div>
            </div>
        </div>
    </div>

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
    <!-- [ Main Content ] end -->

        <script>
              $(document).ready(function() {
                var images = @json($Data->images);

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
                        "{{ URL('Vehicle/uploadFiles') }}"
                        ,fileinput
                        ,(formdata) => {
                            formdata.append("vehicle_id", {{ $Data->id }});
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

            $('profile-image-preview input').change( function() {
                console.log("profile pic changed");

                __doAjax(
                        "{{ URL('Vehicle/setDisplayImage') }}"
                        ,(formdata) => {
                            formdata.append("vehicle_id", {{ $Data->id }});
                            formdata.append('car_image', event.target.files[0]);
                        }
                        ,(JsData) => {
                            hideloading();
                            toastr["success"](JsData.Message);
                        }
                        ,(JsData) => {
                            toastr["error"](JsData.Message);
                        }
                    );
            });

            function deleteFile(onSuccessCb){
                const image_id = event.srcElement.parentElement.getAttribute("id");

                __doAjax (
                    "{{ URL('Vehicle/deleteFile') }}"
                    ,(formdata)=>{
                        formdata.append('vehicle_id', {{ $Data->id }});
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

                // Get radio buttons by their IDs
            var activeRadio = document.getElementById('statusactive');
            var serviceRadio = document.getElementById('statusservice');
            var repairRadio = document.getElementById('statusrepair');

            // Add event listener to each radio button
            activeRadio.addEventListener('change', handleRadioChange);
            serviceRadio.addEventListener('change', handleRadioChange);
            repairRadio.addEventListener('change', handleRadioChange);

            // Event handler function
            function handleRadioChange(event) {
                var status = event.target.value;
                console.log('status:', status);

                __doAjax (
                    "{{ URL('Vehicle/setStatus') }}"
                    ,(formdata)=>{
                        formdata.append('vehicle_id', {{ $Data->id }});
                        formdata.append('status',status);
                    }
                    ,(JsData) => {
                        toastr["success"](JsData.Message);
                    }
                    ,(JsData) => {
                        toastr["error"](JsData.Message);
                    }
                );
            }

        </script>

    </div>
</div>


@endsection