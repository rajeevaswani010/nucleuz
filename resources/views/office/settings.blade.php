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
                            <h4 class="m-b-10">{{ __("Settings") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __("Settings") }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                {!! Form::open(['url' => 'settings/', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}


                {{--<input type="hidden" name="lang" value="{{ session('Lang') }}">--}}

                    <div class="row">

                        <div class="form-group col-6">
                            <label for="subject" class="col-form-label text-dark">{{ __("Name") }}</label>
                            <input class="form-control font-style" required name="name" type="text" value="{{ $Data->name }}" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="from" class="col-form-label text-dark">{{ __("Address") }}</label>
                            <input class="form-control font-style"  name="address" type="text" value="{{ $Data->address }}" required />
                        </div>
                        <div class="form-group col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Company Logo") }}</label>
                            <input type="file" class="form-control font-style" name="logo" id="logoInput"  onchange="previewFile(this);">
                                @if(@$Data->logo != "")
                                    <img id="logo" src="{{ URL('public') }}/{{ @$Data->logo }}" style="width: 100px">
                                @else
                                    <img id="logo" style="width: 100px">
                                @endif
                            <script>
                                function previewFile(input){
                                    //do something here.... below is not working.

                                    // if (input.files & input.files[0]) {
                                    //     console.log("flag 1");
                                    //     const reader = new FileReader();
                                        
                                    //     reader.onload = function(e) {
                                    //         console.log("flag 2");
                                    //         $("#logo").attr('src',e.target.result);
                                    //     };
                                    //     console.log("flag 3");

                                    //     reader.readAsDataURL(input.files[0]);
                                    // } else {
                                    //     console.log("flag 0");
                                    // }
                                }
                            </script>
                        </div>
                        <div class="form-group col-lg-4 mb-4">
                            <label for="subject" class="col-form-label text-dark">{{ __("Company Page") }}</label>
                            <input type="file" class="form-control font-style" name="page" id="pageInput"  onchange="previewFile(this);">
                                @if(@$Data->page != "")
                                    <img id="page" src="{{ URL('public') }}/{{ @$Data->page }}" style="width: 100px">
                                @else
                                    <img id="page" style="width: 100px">
                                @endif
                            <script>
                                function previewFile(input){
                                    //do something here.... below is not working.

                                    // if (input.files & input.files[0]) {
                                    //     console.log("flag 1");
                                    //     const reader = new FileReader();
                                        
                                    //     reader.onload = function(e) {
                                    //         console.log("flag 2");
                                    //         $("#logo").attr('src',e.target.result);
                                    //     };
                                    //     console.log("flag 3");

                                    //     reader.readAsDataURL(input.files[0]);
                                    // } else {
                                    //     console.log("flag 0");
                                    // }
                                }
                            </script>
                        </div>
                        <div class="form-group col-lg-2 mb-4">
                            <label class="col-form-label text-dark">{{ __("License Expiry In Month") }}<span class="text-danger">*</span></label>
                            <select class="form-control" name="license_expiry_in_month" id="license_expiry_in_month" required>
                                <option @if($Data->license_expiry_in_month == "1") selected @endif value="1">1</option>
                                <option @if($Data->license_expiry_in_month == "2")  selected @endif value="2">2</option>
                                <option @if($Data->license_expiry_in_month == "3") selected @endif value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 mb-4">
                            <label class="col-form-label text-dark">{{ __("Residence Expiry In Month") }}<span class="text-danger">*</span></label>
                            <select class="form-control" name="residence_expiry_in_month" id="residence_expiry_in_month" required>
                                <option @if($Data->residence_expiry_in_month == "1") selected @endif value="1">1</option>
                                <option @if($Data->residence_expiry_in_month == "2")  selected @endif value="2">2</option>
                                <option @if($Data->residence_expiry_in_month == "3") selected @endif value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2 mb-4">
                            <label class="col-form-label text-dark">{{ __("Billing Method") }}<span class="text-danger">*</span></label>
                            <select class="form-control" name="billing_method" id="billing_method" required>
                                <option @if($Data->billing_method == "Fixed") selected @endif value="Fixed">{{ __("Fixed") }}</option>
                                <option @if($Data->billing_method == "Hybrid")  selected @endif value="Hybrid">{{ __("Hybrid") }}</option>
                                <option @if($Data->billing_method == "Pro-Rata") selected @endif value="Pro-Rata">{{ __("Pro-Rata") }}</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 mb-4">
                            <label class="col-form-label text-dark">{{ __("Reason For Vehicle Replacement") }}<span class="text-danger">*</span></label>
                            <select class="form-control" name="reason_for_vehicle_replacement" id="reason_for_vehicle_replacement" required>
                                <option @if($Data->reason_for_vehicle_replacement == "Others") selected @endif value="Others">{{ __("Others") }}</option>
                                <option @if($Data->reason_for_vehicle_replacement == "Issue-In-Vehicle")  selected @endif value="Issue-In-Vehicle">{{ __("Issue-In-Vehicle") }}</option>
                                <option @if($Data->reason_for_vehicle_replacement == "Upgrade-The-Vehicle") selected @endif value="Upgrade-The-Vehicle">{{ __("Upgrade-The-Vehicle") }}</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 mb-6">
                            <div>
                                <label class="col-form-label text-dark" for="terms_conditions">{{ __("Billing Terms") }}<span class="text-danger">*</span></label>
                                <button type="button" class="btn btn-danger btn-sm align-middle" style="float:right; margin-left:5px;" id="clear">{{ __("clear") }}</button>
                                <button type="button" class="btn btn-primary btn-sm align-middle" style="float:right; margin-left:5px;" id="setDefaultTerms">{{ __("Set default terms") }}</button>
                            </div>
                            <textarea class="form-control" name="terms_conditions" id="terms_conditions" rows="8"  placeholder="Enter Terms & conditions" >{{ $Data->terms_conditions }}</textarea>
                        </div>
                        <script>
                            $("#terms_conditions").val("This is just tentative billing amount. Actual value might change on vehicle return based on based on vehicle condition or additional KMs etc.");

                            // Add an onclick event listener
                            $("button#setDefaultTerms").click(function () {
                                $("#terms_conditions").val("This is just tentative billing amount. Actual value might change on vehicle return based on vehicle condition or additional KMs etc.");
                            });

                            $("button#clear").click(function () {
                                $("#terms_conditions").val("");
                            });
                        </script>
                        <div class="modal-footer">
                            <input name="lang" type="hidden" value="en">
                            <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Save") }}' onclick="saveAlert();">
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
        </div>
    </div>
    <script>
        function saveAlert(){
            //toastr.info("settings saved");
            alert("Settings saved.")
        }
    </script>
    <!-- [ Main Content ] end -->
    </div>
</div>


@endsection