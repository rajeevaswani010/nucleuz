@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Car Rental Bookings") }}</h2>
            </div>

            <div><a href="{{ URL('booking/create') }}"><button class="btn btn-primary">{{ __("Add New") }}</button></a></div>
        </div>
    </div>
</div>

<div class="container-fluid page__container mt-5 mb-5">
    <div class="table-responsive">

         <form>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <label>{{ __("Vehicle Type") }}</label>
                        <select class="form-control" name="vehicle_type">
                            <option value="">{{ __("All") }}</option>
                            <option @if(@$_GET['vehicle_type'] == "Hatchback") selected @endif>Hatchback</option>
                            <option @if(@$_GET['vehicle_type'] == "Sedan") selected @endif>Sedan</option>
                            <option @if(@$_GET['vehicle_type'] == "SUV") selected @endif>SUV</option>
                            <option @if(@$_GET['vehicle_type'] == "MUV") selected @endif>MUV</option>
                            <option @if(@$_GET['vehicle_type'] == "Coupe") selected @endif>Coupe</option>
                            <option @if(@$_GET['vehicle_type'] == "Convertibles") selected @endif>Convertibles</option>
                            <option @if(@$_GET['vehicle_type'] == "Pickup Trucks") selected @endif>Pickup Trucks</option>
                        </select>
                    </div>

                    <div class="col">
                        <label>{{ __("Pickup From Date") }}</label>
                        <input type="date" class="form-control" name="from_date" value="{{ @$_GET['from_date'] }}">
                    </div>

                    <div class="col">
                        <label>{{ __("Pickup To Date") }}</label>
                        <input type="date" class="form-control" name="to_date" value="{{ @$_GET['to_date'] }}">
                    </div>
                    <div class="col"><button class="btn btn-success mt-4" role="button"><i class="material-icons">search</i></button></div>
                    <div class="col"><button class="btn btn-success mt-4" role="button" name="export" value="Export">{{ __("Export") }}</button></div>
                </div>
            </div>
        </form>

        <div class="card-header mt-3">
            <div class="search-form">
                <input type="text" class="form-control search" placeholder="Search ...">
                <button class="btn" type="button" role="button"><i class="material-icons">search</i></button>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th><a href="javascript:void(0)">{{ __("Booking ID") }}</a></th>
                            <th><a href="javascript:void(0)">{{ __("Customer") }}</a></th>
                            <th><a href="javascript:void(0)">{{ __("Vehicle") }}</a></th>
                            <th><a href="javascript:void(0)">{{ __("Booking") }}</a></th>
                            <th><a href="javascript:void(0)">{{ __("Amount") }}</a></th>
                            <th><a href="javascript:void(0)">{{ __("Status") }}</a></th>
                            <th class="pl-0">{{ __("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="search">
                        @foreach($Data as $DT)
                        <tr>
                            <td>{{ $DT->id }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->customer->first_name }} {{ $DT->customer->last_name }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->customer->mobile }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->customer->email }}</strong></p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->car_type }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->vehicle->make }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ @$DT->vehicle->model }}</strong></p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->tarrif_type }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->pickup_location }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ __("Pickup") }} : {{ date("d/m/Y H:i A", strtotime($DT->pickup_date_time)) }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ __("Drop") }}: {{ date("d/m/Y", strtotime($DT->dropoff_date)) }}</strong></p>

                                </div>
                            </td>
                            <td>OMR {{ number_format($DT->grand_total, 2) }}</td>
                            <td>
                                @if($DT->status == 3)
                                {{ __("Complete") }}
                                <span class="indicator-line rounded bg-success"></span>
                                @endif

                                @if($DT->status == 1)
                                {{ __("Assigned") }}
                                <span class="indicator-line rounded bg-primary"></span>
                                @endif
                                
                                @if($DT->status == 2)
                                {{ __("Delivered") }}
                                <span class="indicator-line rounded bg-warning"></span>
                                @endif
                                
                                @if($DT->status == 4)
                                {{ __("Cancelled") }}
                                <span class="indicator-line rounded bg-danger"></span>
                                @endif
                            </td>
                            <td class="text-right pl-0">
                                <a href="{{ URL('booking') }}/{{ $DT->id }}/edit" class="text-50"><i class="material-icons">edit</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function GoDeleteCat(ID){
    if(confirm("Are you sure to Delete This Record. Once you deleted, no data will be recovered")){
        return true;
    }
    
    return false;
}
</script>
@endsection