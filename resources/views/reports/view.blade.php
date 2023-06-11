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
                    <div class="col">
                        <label>{{ __("Report Type") }}</label>
                        <select class="form-control" name="report_type" id="report_type" onchange = "onReportTypeChange()">
                            <option value="">{{ __("") }}</option>
                            <option @if(@$_GET['report_type'] == "On Rent") selected @endif value="On Rent">{{ __("On Rent") }}</option>
                            <option @if(@$_GET['report_type'] == "Reservation") selected @endif value="Reservation">{{ __("Reservation") }}</option>
                            <option @if(@$_GET['report_type'] == "Returns") selected @endif value="Returns">{{ __("Returns") }}</option>
                            <option @if(@$_GET['report_type'] == "Available") selected @endif value="Available">{{ __("Available") }}</option>
                            <option @if(@$_GET['report_type'] == "Billing") selected @endif value="Billing">{{ __("Billing") }}</option>
                        </select>
                    </div>

                    <div class="col">
                        <label>{{ __("Vehicle Type") }}</label>
                        <select class="form-control" name="vehicle_type">
                            <option value="">{{ __("All") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "Hatchback") selected @endif value="Hatchback">{{ __("Hatchback") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "Sedan") selected @endif value="Sedan">{{ __("Sedan") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "SUV") selected @endif value="SUV">{{ __("SUV") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "MUV") selected @endif value="MUV">{{ __("MUV") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "Coupe") selected @endif value="Coupe">{{ __("Coupe") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "Convertibles") selected @endif value="Convertibles">{{ __("Convertibles") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "Pickup Trucks") selected @endif value="Pickup Trucks">{{ __("Pickup Trucks") }}</option>
                        </select>
                    </div>

                    <div class="col">
                        <label>{{ __("From") }}</label>
                        <input type="date" class="form-control" id="from_date" onchange="validateDateRange()" name="from_date" value="{{ @$_GET['from_date'] }}">
                    </div>

                    <div class="col">
                        <label>{{ __("To") }}</label>
                        <input type="date" class="form-control" id="to_date" onchange="validateDateRange()" name="to_date" value="{{ @$_GET['to_date'] }}">
                    </div>
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
    <th>Available ?</th>
    <th>Quantity</th>
    </tr>
    </thead>

    <tbody>

        @foreach($Data as $DT)
        <tr class="font-style">
        <td>{{ $DT["car_type"] }}</td>
        <td></td>
        <td>{{ $DT["count"] }}</td>
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
    <th>Id</th>
    <th>Car Type</th>
    <th>Reg. No.</th>
    <th>Customer Name</th>
    <th>Contact</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr class="font-style">
        <td>{{ $DT->id }}</td>
        <td>{{ $DT->car_type }}</td>
        <td>{{ $DT->reg_no }}</td>
        <td>{{ $DT->first_name }} {{ $DT->last_name }}</td>
        <td>{{ $DT->mobile }}</td>
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
    <th>Id</th>
    <th>Car Type</th>
    <th>Customer</th>
    <th>Mobile</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr class="font-style">
        <td>{{ $DT->id }}</td>
        <td>{{ $DT->car_type }}</td>
        <td>{{ $DT->first_name }}</td>
        <td>{{ $DT->mobile }}</td>
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
    <th>Id</th>
    <th>Car Type</th>
    <th>Reg. No.</th>
    <th>Customer Name</th>
    <th>Contact</th>
    <th>dropoff date</th>
    </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr class="font-style">
        <td>{{ $DT->id }}</td>
        <td>{{ $DT->car_type }}</td>
        <td>{{ $DT->reg_no }}</td>
        <td>{{ $DT->first_name }} {{ $DT->last_name }}</td>
        <td>{{ $DT->mobile }}</td>
        <td>{{ $DT->dropoff_date }}</td>        
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
                // $("#to_date").prop("disabled",false);
                // $("#from_date").prop("disabled",false);
                break;
            case "On Rent" :
                // $("#to_date").val = "";
                // $("#from_date").val = "";
                // $("#to_date").prop("disabled",true);
                // $("#from_date").prop("disabled",true);
                break;
            case "Returns":
                // $("#to_date").prop("disabled",false);
                // $("#from_date").prop("disabled",false);
                // $("#to_date").val = new Date().toISOString().substr(0,10);
                // $("#from_date").val = new Date().toISOString().substr(0,10);
                break;
            default :
                // Do work here
                console.log("default");
                $("#to_date").prop("disabled",false);
                $("#from_date").prop("disabled",false);
                break;
        }
    }

    function validateDateRange(){
        $from = $("#from_date").val();
        $to = $("#to_date").val();

        $("#to_date").attr("min",$from);
        $("#from_date").attr("max", $to);    
    }

</script>

@endsection