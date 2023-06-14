@extends("layout.default")

@section("content")

<script>
    //get parameters
        const urlParams = new URLSearchParams(window.location.search);
</script>

<!-- [ Main Content ] start -->
<div class="dash-container">
<div class="dash-content">
<div class="page-header">
<div class="page-block">
<div class="row align-items-center">
<div class="col-auto">
<div class="page-header-title">
<h4 class="m-b-10">Reports</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item">Reports</li>
</ul>
</div>
<div class="col">
<div class="float-end">

{{--<a href="{{ URL('license/create') }}" data-size="lg" data-url="{{ URL('license/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
<i class="ti ti-plus"></i>
</a>--}}

</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">

        {!! Form::open(['url' => 'reports', 'enctype' => 'multipart/form-data', 'method' => 'GET', 'id' => 'form']) !!}
            <div class="card">
                <div class="row">
                    <div class="col-lg-3">
                        <label>{{ __("Report Type") }}</label>
                        <select class="form-control" name="report_type" id="report_type" onchange = "onReportTypeChange()">
                            <option value="">{{ __("") }}</option>
                            <option value="On Rent">{{ __("On Rent") }}</option>
                            <option value="Reservation">{{ __("Reservation") }}</option>
                            <option value="Returns">{{ __("Returns") }}</option>
                            <option value="Available">{{ __("Available") }}</option>
                            <option value="Billing">{{ __("Billing") }}</option>
                        </select>
                        <script>
                                $('#report_type').val(urlParams.get('report_type'));
                        </script>
                    </div>

                    <div class="col-lg-2">
                        <label>{{ __("Vehicle Type") }}</label>
                        <select class="form-control" name="vehicle_type" id="vehicle_type">
                            <option value="">{{ __("All") }}</option>
                            @foreach ($GetAllVehicleTypes as $vehicle)
                             <option value={{ $vehicle['name'] }}>{{ $vehicle['name'] }}</option>
                            @endforeach
                            <script>
                                $('#vehicle_type').val(urlParams.get('vehicle_type'));
                            </script>

                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label>{{ __("From") }}</label>
                        <input type="date" class="form-control" id="from_date" onchange="validateDateRange()" name="from_date" value="{{ @$_GET['from_date'] }}">
                        <!-- <script>
                                console.log(urlParams.get('from_date'));
                                if(urlParams.get('from_date') == ""){
                                    curDate = new Date().toISOString().substr(0,10);
                                    $("#from_date").val(curDate);
                                } else {
                                    $("#from_date").val(urlParams.get('from_date'));
                                }
                        </script> -->
                    </div>

                    <div class="col-lg-2">
                        <label>{{ __("To") }}</label>
                        <input type="date" class="form-control" id="to_date" onchange="validateDateRange()" name="to_date" value="{{ @$_GET['to_date'] }}">
                    </div>
                    <!-- <script>
                                console.log(urlParams.get('to_date'));
                                if(urlParams.get('to_date') == ""){
                                    curDate = new Date().toISOString().substr(0,10);
                                    $("#to_date").val(curDate);
                                } else {
                                    $("#to_date").val(urlParams.get('to_date'));
                                }
                        </script> -->
                    <div class="col"><button class="btn btn-success mt-4" type="submit" name="search" value="search" role="button"><i class="fa fa-sech"> Search</i></button></div>
                </div>
            </div>
        {!! Form::close() !!}



@if(@$_GET['report_type'] == "Available")
<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
    <thead>
    <tr>
    <th>Car Type</th>
    <th>Quantity</th>
    </tr>
    </thead>

    <tbody>

        @foreach($Data as $DT)
        <tr class="font-style">
        <td><strong class="js-lists-values-employee-name">{{ $DT->car_type }}</strong></td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->count }}</strong></td>
        </tr>
        @endforeach

    </tbody>
</table>
</div>
</div>
</div>
@endif
@if(@$_GET['report_type'] == "On Rent")
<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
    <thead>
    <tr>
    <th>Booking Id</th>
    <th>Car Type</th>
    <th>Car Details</th>
    <th>Customer Details</th>
    <th>Pick up</th>
    <th>Drop off</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr class="font-style">
        <td>B000{{ $DT->id }}</td>
        <td>{{ $DT->car_type }}</td>
        <td>
            <div class="d-flex flex-column">
                <p class="mb-0">{{ @$DT->veh_make }}</p>
                <p class="mb-0">{{ @$DT->veh_model }} / {{ @$DT->veh_variant }}</p>
                <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->reg_no }}</strong></p>
            </div>
        </td>
        <td>
            <div class="d-flex flex-column">
                <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->cust_first_name }} {{ $DT->cust_last_name }}</strong></p>
                <p class="mb-0"><i class="fa fa-phone"></i>&nbsp{{ $DT->cust_mobile }}</p>
                <p class="mb-0"><i class="fa fa-envelope"></i>&nbsp{{ $DT->cust_email }}</p>
            </div>
        </td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->pickup_date_time }}</strong></td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->dropoff_date }}</strong></td>
        </tr>
        @endforeach

    </tbody>
</table>
</div>
</div>
</div>
@endif
@if(@$_GET['report_type'] == "Reservation")
<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
    <thead>
    <tr>
    <th>Booking Id</th>
    <th>Car Type</th>
    <th>Customer Details</th>
    <th>Pick up</th>
    <th>Drop off</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr class="font-style">
        <td>B000{{ $DT->id }}</td>
        <td>{{ $DT->car_type }}</td>
        <td>
            <div class="d-flex flex-column">
                <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->cust_first_name }} {{ $DT->cust_last_name }}</strong></p>
                <p class="mb-0"><i class="fa fa-phone"></i>&nbsp{{ $DT->cust_mobile }}</p>
                <p class="mb-0"><i class="fa fa-envelope"></i>&nbsp{{ $DT->cust_email }}</p>
            </div>
        </td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->pickup_date_time }}</strong></td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->dropoff_date }}</strong></td>
        </tr>
        @endforeach

    </tbody>
</table>
</div>
</div>
</div>
@endif
@if(@$_GET['report_type'] == "Returns")
<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
    <thead>
    <tr>
    <th>Booking Id</th>
    <th>Car Type</th>
    <th>Car Details</th>
    <th>Customer Details</th>
    <th>Pick up</th>
    <th>Drop off</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr class="font-style">
        <td>B000{{ $DT->id }}</td>
        <td>{{ $DT->car_type }}</td>
        <td>
            <div class="d-flex flex-column">
                <p class="mb-0">{{ @$DT->veh_make }}</p>
                <p class="mb-0">{{ @$DT->veh_model }} / {{ @$DT->veh_variant }}</p>
                <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->reg_no }}</strong></p>
            </div>
        </td>
        <td>
            <div class="d-flex flex-column">
                <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->cust_first_name }} {{ $DT->cust_last_name }}</strong></p>
                <p class="mb-0"><i class="fa fa-phone"></i>&nbsp{{ $DT->cust_mobile }}</p>
                <p class="mb-0"><i class="fa fa-envelope"></i>&nbsp{{ $DT->cust_email }}</p>
            </div>
        </td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->pickup_date_time }}</strong></td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->dropoff_date }}</strong></td>
        </tr>
        @endforeach

    </tbody>
</table>
</div>
</div>
</div>
@endif
@if(@$_GET['report_type'] == "Billing")
<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable">
    <thead>
    <tr>
    <th>Booking Id</th>
    <th>Car Type</th>
    <th>Car Details</th>
    <th>Customer Details</th>
    <th>Pick up</th>
    <th>Drop off</th>
    <th>Discount</th>
    <th>Grand Total</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr class="font-style">
        <td>B000{{ $DT->id }}</td>
        <td>{{ $DT->car_type }}</td>
        <td>
            <div class="d-flex flex-column">
                <p class="mb-0">{{ @$DT->veh_make }}</p>
                <p class="mb-0">{{ @$DT->veh_model }} / {{ @$DT->veh_variant }}</p>
                <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->reg_no }}</strong></p>
            </div>
        </td>
        <td>
            <div class="d-flex flex-column">
                <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->cust_first_name }} {{ $DT->cust_last_name }}</strong></p>
                <p class="mb-0"><i class="fa fa-phone"></i>&nbsp{{ $DT->cust_mobile }}</p>
                <p class="mb-0"><i class="fa fa-envelope"></i>&nbsp{{ $DT->cust_email }}</p>
            </div>
        </td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->pickup_date_time }}</strong></td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->dropoff_date }}</strong></td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->discount_amount }}</strong></td>
        <td><strong class="js-lists-values-employee-name">{{ $DT->grand_total }}</strong></td>
        </tr>
        @endforeach

    </tbody>
</table>
</div>
</div>
</div>
@endif


</div>
</div>
<!-- [ Main Content ] end -->
</div>
</div>
<script>
    validateDateRange();
    onReportTypeChange();

    function onReportTypeChange(){
        $reportType = $("#report_type").val();
        console.log("inside fucntion on report type change - " + $reportType);

        switch ($reportType) {
            case "Reservation" :
                // Do work here
                $("#to_date").prop("disabled",false);
                $("#from_date").prop("disabled",false);
                break;
            case "On Rent" :
                $("#to_date").val('');
                $("#from_date").val('');
                $("#from_date").prop("disabled", true);
                $("#to_date").prop("disabled",true);
                break;
            case "Returns":
                $("#to_date").prop("disabled",false);
                $("#from_date").prop("disabled",false);
                // curDate = new Date().toISOString().substr(0,10);
                // $("#to_date").val(curDate);
                // $("#from_date").val(curDate)
                break;
            case "Available":
                $("#to_date").prop("disabled",false);
                $("#from_date").prop("disabled",false);
                // curDate = new Date().toISOString().substr(0,10);
                // $("#to_date").val(curDate);
                // $("#from_date").val(curDate)

                // $("#to_date").attr("min",curDate);
                // $("#from_date").attr("min",curDate );    
                break;
            case "Billing":
            default :
                // Do work here
                $("#to_date").prop("disabled",false);
                $("#from_date").prop("disabled",false);
                break;
        }
    }

    function validateDateRange(){
        from = $("#from_date").val();
        to = $("#to_date").val();

        $("#to_date").attr("min",from);
        $("#from_date").attr("max", to);    
    }

</script>

@endsection