@extends("layout.default")

@section("content")

<div class="border-bottom-2 py-32pt position-relative z-1">
    <div class="container-fluid page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h2 class="mb-0">{{ __("Reports") }}</h2>
            </div>
        </div>
    </div>
</div>


<?php
                  // echo '<pre>';print_r($Data);echo '</pre>';die();
                    ?>

<div class="container-fluid page__container mt-5 mb-5">
    <div class="table-responsive"
         data-toggle="lists"
         data-lists-sort-by="js-lists-values-employee-name"
         data-lists-values='["js-lists-values-employee-name", "js-lists-values-employer-name", "js-lists-values-projects", "js-lists-values-activity", "js-lists-values-earnings"]'>

         <form>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <label>{{ __("Report Type") }}</label>
                        <select class="form-control" name="report_type">
                            <option value="">{{ __("All") }}</option>
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
                        <label>{{ __("Pickup From Date") }}</label>
                        <input type="date" class="form-control" name="from_date" value="{{ @$_GET['from_date'] }}">
                    </div>

                    <div class="col">
                        <label>{{ __("Pickup To Date") }}</label>
                        <input type="date" class="form-control" name="to_date" value="{{ @$_GET['to_date'] }}">
                    </div>
                    <div class="col"><button class="btn btn-success mt-4" name="search" value="search" role="button"><i class="material-icons">search</i></button></div>
                </div>
            </div>
        </form>

        <div class="card mt-3">
            <div class="card-body">
               {{-- @if(isset($_GET['search']) && $_GET['search'] == "search")--}}
                <table class="table mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Car Detail") }}</a></th>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Chasis") }}</a></th>
                            <th><a href="javascript:void(0)" class="sort" data-sort="js-lists-values-employee-name">{{ __("Reg. No") }}</a></th>
                        </tr>
                    </thead>

                    <tbody class="list" id="search">
                        @foreach($Data as $DT)
                        <tr>
                            <td>
                                <div class="d-flex flex-column">
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->car_type }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->make }}</strong></p>
                                    <p class="mb-0"><strong class="js-lists-values-employee-name">{{ $DT->model }}</strong></p>
                                </div>
                            </td>
                            <td>{{ $DT->chasis_no }}</td>
                            <td>{{ $DT->reg_no }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--@endif--}}
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