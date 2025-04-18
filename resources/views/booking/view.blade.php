@extends("layout.default")

@section("content")

<style>
.booking-status {
    padding: 6px;
    font-size: small;
    font-weight: bold;
}

.booking-status.assigned,
.booking-status.cancelled {
    color:white;
}

.booking-error {
    background: #ffc4c4;
}
.table-hover .booking-error{
    background: #fbe7e7 !important;
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
<h4 class="m-b-10">{{ __("Car Rental Bookings") }}</h4>
</div>
<ul class="breadcrumb">
<li class="breadcrumb-item">
<a href="{{ URL('dashboard') }}">{{ __("Dashboard") }}</a></li>
<li class="breadcrumb-item">{{ __("Car Rental Bookings") }}</li>
</ul>
</div>
<div class="col">
<div class="float-end">

<a href="{{ URL('booking/create') }}" data-size="lg" data-url="{{ URL('booking/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create" data-title="Add New" class="btn btn-sm btn-primary">
<i class="ti ti-plus"></i>
</a>

</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">

<form>
            <div class="card">
                <div class="row row align-items-end m-1">
                    <div class="col">
                        <label>{{ __("Vehicle Type") }}</label>
                        <select class="form-control" name="vehicle_type" id="vehicle_type">
                            <option value="">{{ __("All") }}</option>
                            @foreach ($GetAllVehicleTypes as $vehicle)
                             <option value={{ $vehicle['name'] }}>{{ $vehicle['name'] }}</option>
                            @endforeach
                            <script>
                                @if( isset($_GET['vehicle_type']) )
                                    $('#vehicle_type').val("{{ $_GET['vehicle_type'] }}");
                                @endif
                            </script>
                        </select>
                    </div>

                    <div class="col">
                        <label>{{ __("Pickup From Date") }}</label>
                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{ @$_GET['from_date'] }}" onchange="validateDateRange()">
                        
                    </div>

                    <div class="col">
                        <label>{{ __("Pickup To Date") }}</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{ @$_GET['to_date'] }}" onchange="validateDateRange()">
                    </div>
                    <div class="col">
                        <label>{{ __("Status") }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">{{ __("All") }}</option>
                            <option @if(@$_GET['status'] == 1) selected @endif value=1>{{ __("Reserved") }}</option>
                            <option @if(@$_GET['status'] == 2) selected @endif value=2>{{ __("Delivered") }}</option>
                            <option @if(@$_GET['status'] == 5) selected @endif value=5>{{ __("DroppedOFF") }}</option>
                            <option @if(@$_GET['status'] == 3) selected @endif value=3>{{ __("Complete") }}</option>
                            <option @if(@$_GET['status'] == 4) selected @endif value=4>{{ __("Cancelled") }}</option>
                        </select>
                    </div>
                    <script>
                            @if( isset($_GET['status']) )
                                $('#status').val("{{ $_GET['status'] }}");
                            @endif

                    </script>
                    <div class="col"><button class="btn btn-primary" role="button">{{ __("Search") }}</button></div>
                    <div class="col"><button class="btn btn-primary float-lg-right" style="float:right;" role="button" name="export" value="Export">{{ __("Export") }}</button></div>
                </div>
            </div>
        </form>

        {{--<div class="card">
            <div class="search-form">
                <input type="text" class="form-control search" placeholder="Search ...">
                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
            </div>
        </div>--}}


<div class="card">
<div class="card-body table-border-style">
<div class="table-responsive">
<table class="table datatable  table-hover">
<thead>
<tr>
<th>{{ __("Booking ID") }}</th>
<th>{{ __("Customer") }}</th>
<th>{{ __("Vehicle Type") }}</th>
<th>{{ __("Vehicle") }}</th>
<th>{{ __("Booking") }}</th>
<th>{{ __("Amount") }}</th>
<th>{{ __("Status") }}</th>
<th>{{ __("Updated On") }}</th>
<th>{{ __("Action") }}</th>
</tr>
</thead>

<tbody>

    @foreach($Data as $DT)

    @if(
        ($DT->status == 1 && $DT->pickup_date_time < date('Y-m-d')) ||
        ($DT->status == 2 && $DT->dropoff_date < date('Y-m-d'))
    )
    <tr class="font-style booking-error">
    @else
    <tr class="font-style">
    @endif
    <td>B000{{ $DT->id }}</td>
    <td>
        <div class="d-flex flex-column">
        <!--<p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->customer->first_name }} {{ $DT->customer->last_name }}</strong></p> -->
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->customer->first_name }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->customer->mobile }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->customer->email }}</strong></p>
        </div>
    </td>
    <td>
    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->car_type }}</strong></p>
    </td>

    <td>
    <div class="d-flex flex-column">
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->vehicle->make }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->vehicle->model }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->vehicle->reg_no }}</strong></p>
    </div>
    </td>

    <td>
    <div class="d-flex flex-column">
      <!--  <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->tarrif_type }}</strong></p> -->
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->pickup_location }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ __("Pickup") }} : {{ date("d/m/Y H:i A", strtotime($DT->pickup_date_time)) }}</strong></p>
        <p class="mb-0"><strong class="js-lists-values-employee-name">{{ __("Drop") }}: {{ date("d/m/Y", strtotime($DT->dropoff_date)) }}</strong></p>

    </div>
    </td>
    <td>
        OMR {{ number_format($DT->grand_total, 2) }}
    </td>
    <td>
    @if($DT->status == 3)
    <span class="indicator-line rounded bg-success booking-status complete">{{ __("Complete") }}</span>
    @endif

    @if($DT->status == 1)
    <span class="indicator-line rounded bg-secondary booking-status assigned" >{{ __("Reserved") }}</span>
    @endif

    @if($DT->status == 2)
    <span class="indicator-line rounded bg-warning booking-status delivered">{{ __("Delivered") }}</span>
    @endif

    @if($DT->status == 4)
    <span class="indicator-line rounded bg-danger booking-status cancelled">{{ __("Cancelled") }}</span>
    @endif

    @if($DT->status == 5)
    <span class="indicator-line rounded bg-info booking-status info">{{ __("DroppedOFF") }}</span>
    @endif
</td>
<td>{{ $DT->updated_at }}</td>
    <td class="Action">
        <span>

    <div class="action-btn bg-primary ms-2">
            <a href="{{ URL('booking') }}/{{ $DT->id }}/edit" class="mx-3 btn btn-sm align-items-center" data-url="{{ URL('booking') }}/{{ $DT->id }}/edit" data-ajax-popup="true" data-title="Edit Coupon" data-bs-toggle="tooltip"  title="Edit" data-original-title="Edit">
                <i class="fa fa-pencil-alt text-white"></i>
            </a>
    </div>
    </span>
    </td>
    </tr>
    @endforeach

                        </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<!-- [ Main Content ] end -->
</div>
</div>
<script type="text/javascript">

validateDateRange();

function GoDeleteCat(ID){
    if(confirm("Are you sure to Delete This Record. Once you deleted, no data will be recovered")){
        return true;
    }

    return false;
}

function validateDateRange(){
    $from = $("#from_date").val();
    $to = $("#to_date").val();

    $("#to_date").attr("min",$from);
    $("#from_date").attr("max", $to);
}
</script>

@endsection
