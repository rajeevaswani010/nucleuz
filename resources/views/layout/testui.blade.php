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
                            <h4 class="m-b-10">{{ __("Testing UI") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Testing UI") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                    <div class="booking-edit-panel" id="changeDatePanel">
                            <div class="card">
                                    <div class="card-header">
                                        <h3 style="display:inline-block;">{{ __("Change Reservation Date") }}</h3>
                                        <button class="btn btn-sm btn-danger" style="float:right;" onclick="hideEditPanels();"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <form id="changeDatesForm"  method="POST">
                                            @csrf
                                            <div class="row">    
                                                <div class="col-lg-3 mb-4">
                                                    <label>Vehicle <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="VehicleData" name="vehicle_id">
                                                        <option value="">{{ __("Select") }}</option>
                                                    </select>
                                                </div>   
                                                <div class="col-lg-3 mb-4">
                                                    <label>{{ __("Pickup Date") }}<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control number" name="pickup_date_time" value="" required>
                                                </div>
                                                <div class="col-lg-3 mb-4">
                                                    <label>{{ __("DropOFF Date") }}<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control number" name="dropoff_date" value="" required >
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-success mt-4" value="Submit">
                                        </form>
                                    </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<script>

    $(document).ready(function(){

        $.ajax({
                url: "{{ URL('Booking/GetAvailableCarTypes') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                data: null,
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 0){
                        alert("Available vehicles info is not available.")
                    } else {
                        var select = $('#changeDatesForm #VehicleData');
                        select.innerHTML='';
                        var opt = document.createElement('option');
                        opt.value = "";
                        // opt.innerHTML = '--Select Vehicle--';
                        // select.append(opt);

                        JsData.Data.forEach(function(item, index, array) {
                            console.log(`Item at index ${index} is `);
                            console.log(item);
                            var opt = document.createElement('option');
                            opt.value = item.id
                            opt.innerHTML = item.car_type+" / "+item.make+" / "+item.model+" / "+item.variant+" / "+item.reg_no;
                            select.append(opt);
                        });
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to get images. Error:"+jqXHR.status);
                    // onFailure({
                    //     "Status":jqXHR.status
                    //     ,"Message":jqXHR.statusText
                    // });
                }              
        });

    });

    $('#changeDatesForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission
            //showloading();

            var formdata = new FormData(this);
            formdata.append("booking_id",182);

            $.ajax({
                url: "{{ URL('Booking/changeDates') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set the content type to false to let the server handle it
                data: formdata,
                success: function( data, textStatus, jqXHR ) {
                    JsData = JSON.parse(data);
                    console.log(JsData);
                    if(JsData.Status == 1){
                        toastr["success"](JsData.Message);
                        // window.location.reload();
                    } else {
                        alert(JsData.Message);
                    }
                    hideloading();
                },
                error: function( jqXHR, textStatus, errorThrown ) {
                    console.error("Fail to get images. Error:"+jqXHR.status);
                    hideloading();
                    toastr["error"](jqXHR.statusText);
                }              
            });
    });


</script>

@endsection