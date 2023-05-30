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
                            <h4 class="m-b-10">Dashboard</h4>
                        </div>
                        <ul class="breadcrumb">
                        </ul>
                    </div>
                    <div class="col">
                     </div>
                </div>
            </div>
        </div>
    <div class="row">


     @if(session("AdminRole") != "1")

    <div class="col-lg-4 col-md-4">
            <a href="{{ URL('reports') }}?report_type=On+Rent&from_date={{ date('Y-m-d') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-primary">
                                <i class="fa fa-angle-right"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4">On Rent</h6>
                            </div>
                        </div>

                        <div class="number-icon ms-3 mb-3 mt-3">
                            <h3>{{ $OnRentVehicle }}</h3>
                        </div>  

                    </div>
                </div>
            </div>
            </a>
        </div>


        <!-- <div class="col-lg-4 col-md-4">
            <a href="{{ URL('reports') }}?report_type=Reservation&from_date={{ date('Y-m-d') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-primary">
                                <i class="fa fa-angle-right"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4">Reservation</h6>
                            </div>
                        </div>

                        <div class="number-icon ms-3 mb-3 mt-3">
                            <h3>{{ $Reservation }}</h3>
                        </div>  

                    </div>
                </div>
            </div>
            </a>
        </div> -->



        <div class="col-lg-4 col-md-4">
            <a href="{{ URL('reports') }}?report_type=Returns&from_date={{ date('Y-m-d') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-primary">
                                <i class="fa fa-angle-right"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4">Return</h6>
                            </div>
                        </div>

                        <div class="number-icon ms-3 mb-3 mt-3">
                            <h3>{{ $Return }}</h3>
                        </div>  

                    </div>
                </div>
            </div>
            </a>
        </div>


        <div class="col-lg-4 col-md-4">
            <a href="{{ URL('reports') }}?report_type=Available&from_date={{ date('Y-m-d') }}&search=search">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-primary">
                                <i class="fa fa-angle-right"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4">Available</h6>
                            </div>
                        </div>

                        <div class="number-icon ms-3 mb-3 mt-3">
                            <h3>{{ $VehicleAvaialble }}</h3>
                        </div>  

                    </div>
                </div>
            </div>
            </a>
        </div>


        <div class="col-lg-4 col-md-4">
            <a href="{{ URL('booking') }}?from_date={{ date('Y-m-d') }}&to_date={{ date('Y-m-d') }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-primary">
                                <i class="fa fa-angle-right"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4">Pick Up Today</h6>
                            </div>
                        </div>
                        <div class="number-icon ms-3 mb-3 mt-3">
                            <h3>{{ $TodayPickup }}</h3>
                        </div>  
                    </div>
                </div>
            </div>
            </a>
        </div>


        <div class="col-lg-4 col-md-4">
            <a href="{{ URL('booking') }}?from_date={{ date('Y-m-d', strtotime('+1 day')) }}&to_date={{ date('Y-m-d', strtotime('+1 day')) }}">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center mb-3 mt-3">
                            <div class="theme-avtar bg-primary">
                                <i class="fa fa-angle-right"></i>
                            </div>
                            <div class="ms-3 mb-3 mt-3">
                                <h6 class="ml-4">Pick Up Tomorrow</h6>
                            </div>
                        </div>
                        <div class="number-icon ms-3 mb-3 mt-3">
                            <h3>{{ $TomorrowPickup }}</h3>
                        </div>  
                    </div>
                </div>
            </div>
            </a>
        </div>



        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header card-header-tabs-basic nav justify-content-center" role="tablist">
                        <div>
                            <a href="#"
                               class="active"
                               data-toggle="tab"
                               role="tab"
                               aria-selected="true">
                                {{ __('Sale Status') }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body d-flex align-items-center justify-content-center" style="height: 480px">
                        
                        <div class="flex" style="max-width: 100%">

                                <div class="chart">
                                    <canvas id="performanceAreaChart"
                                            class="chart-canvas js-update-chart-line js-update-chart-area"
                                            data-chart-line-border-color="primary"
                                            data-chart-line-background-color="gradient:primary"
                                            data-chart-line-background-opacity="0.24"
                                            data-chart-prefix="$"
                                            data-chart-suffix="k"></canvas>
                                </div>
                            </div>
                        
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header card-header-tabs-basic nav justify-content-center" role="tablist">
                        <div>
                            <a href="#"
                               class="active"
                               data-toggle="tab"
                               role="tab"
                               aria-selected="true">
                                {{ __('Vehicle Type') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center" style="height: 480px">
                        <div class="position-relative">
                            <canvas id="locationDoughnutChartLegend" class="chart-canvas" data-chart-line-background-color="primary;accent.300;accent.100"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>{{ __('Pickup Date Wise') }}</h3>
                <table class="table table-bordered table-flush mb-0 thead-border-top-0 table-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <div class="lh-1 d-flex flex-column text-50 my-4pt">
                                    {{ __('Monday') }}
                                </div>
                            </th>
                            <th>
                                <div class="lh-1 d-flex flex-column text-50 my-4pt">
                                    {{ __('Tuesday') }}
                                </div>
                            </th>
                            <th>
                                <div class="lh-1 d-flex flex-column text-50 my-4pt">
                                    {{ __('Wednesday') }}
                                </div>
                            </th>
                            <th>
                                <div class="lh-1 d-flex flex-column text-50 my-4pt">
                                    {{ __('Thursday') }}
                                </div>
                            </th>
                            <th>
                                <div class="lh-1 d-flex flex-column text-50 my-4pt">
                                    {{ __('Friday') }}
                                </div>
                            </th>
                            <th>
                                <div class="lh-1 d-flex flex-column text-50 my-4pt">
                                    {{ __('Saturday') }}
                                </div>
                            </th>
                            <th>
                                <div class="lh-1 d-flex flex-column text-50 my-4pt">
                                    {{ __('Sunday') }}
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @php
                        $WeekDay = date("l", strtotime(date("Y-m-01")));
                        $OffsetIndex = 0;
                        if(strtoupper($WeekDay) == "MONDAY"){
                            $OffsetIndex = 0;
                        }
                        if(strtoupper($WeekDay) == "TUESDAY"){
                            $OffsetIndex = 1;
                        }
                        if(strtoupper($WeekDay) == "WEDNESDAY"){
                            $OffsetIndex = 2;
                        }
                        if(strtoupper($WeekDay) == "THURSDAY"){
                            $OffsetIndex = 3;
                        }
                        if(strtoupper($WeekDay) == "FRIDAY"){
                            $OffsetIndex = 4;
                        }
                        if(strtoupper($WeekDay) == "SATURDAY"){
                            $OffsetIndex = 5;
                        }
                        if(strtoupper($WeekDay) == "SUNDAY"){
                            $OffsetIndex = 6;
                        }

                        $Counter = 1;
                        @endphp

                        <tr>
                            @for($i = 0; $i < $OffsetIndex; $i++)
                                <td>
                                </td>
                                @php
                                $Counter++;
                                @endphp

                                @if($Counter == 8)
                                @php
                                    $Counter = 1;
                                @endphp
                                </tr>
                                @endif
                            @endfor

                            @php
                            $date = new \DateTime('last day of this month');
                            $numDaysOfCurrentMonth = $date->format('d');
                            @endphp

                            @for($k = 1; $k <= $numDaysOfCurrentMonth; $k++)
                            
                            @php
                            $NewDate = date("Y-m-d", strtotime("+".($k-1)." days", strtotime(date("Y-m-01"))));
                            $TodayPickup = App\Models\Booking::where("company_id", session("CompanyLinkID"))->where("pickup_date_time", ">=", $NewDate." 00:00:00")->where("pickup_date_time", "<=", $NewDate." 23:59:59")->count();
                            @endphp

                                <td>
                                    {{ $k }}
                                    <a class="d-flex flex-column border-1 rounded px-8pt py-4pt lh-1 @if($TodayPickup == 0) bg-light @else bg-primary @endif" href="{{ URL('booking') }}?from_date={{ $NewDate }}&to_date={{ $NewDate }}">
                                        {{ $TodayPickup }}
                                    </a>
                                </td>

                                @php
                                $Counter++;
                                @endphp

                                @if($Counter == 8)
                                @php
                                    $Counter = 1;
                                @endphp
                                </tr>
                                @endif
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        @endif

        @if(session("AdminRole") == "1")
    <div class="page-section">


        <div class="row mb-lg-8pt">
            <div class="col-lg-4">
                <a href="{{ URL('office') }}">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                       
                        <div class="flex">
                            <p class="mb-0"><strong>{{ __('Number of Company') }}</strong></p>
                            <br />
                            <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $AllCompany }}</p>
                        </div>
                       
                        
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="{{ URL('license') }}">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                       
                        <div class="flex">
                            <p class="mb-0"><strong>{{ __('Number of Users') }}</strong></p>
                           
                            <br />
                            <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $NumUser }}</p>
                        </div>
                       
                    </div>
                </div>
                </a>
            </div>

            <div class="col-lg-4">
                <a href="{{ URL('license') }}">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex">
                                <p class="mb-0"><strong>{{ __('Number of Active License') }}</strong></p>

                                <br />
                            <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $totalActiveLicense }}</p>
                            </div>
                           
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mb-lg-8pt">
           <div class="col-lg-4">
                <a href="{{ URL('license') }}">
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex">
                                <p class="mb-0"><strong>{{ __('Number of Expiry License') }}</strong></p>
                                <br />
                            <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $ExpLic }}</p>
                            </div>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4">
                <a href="{{ URL('product') }}">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex">
                            <p class="mb-0"><strong>{{ __('License Products') }}</strong></p>
                            <br />
                            <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $totalLicenseProduct }}</p>
                        </div>
                      
                    </div>
                </div>
                </a>
            </div>

            <div class="col-lg-4">
                <a href="{{ URL('license') }}">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex">
                            <p class="mb-0"><strong>{{ __('Number of Suspended License') }}</strong></p>
                            <br />
                            <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $suspendedlicensecount }}</p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    @endif




    
    </div>
    <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->


<script src="{{ URL('public/js/settings.js') }}"></script>
<script src="{{ URL('public/vendor/Chart.min.js') }}"></script>
<script src="{{ URL('public/js/chartjs-rounded-bar.js') }}"></script>
<script src="{{ URL('public/js/chartjs.js') }}"></script>
<script src="{{ URL('public/js/page.ui-charts.js') }}"></script>
<script type="text/javascript">

    const data = {
      labels: [
        'Hatchback',
        'Sedan',
        'SUV',
        'MUV',
        'Coupe',
        'Convertibles',
        'Pickup Trucks'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [{{ $HatchbackBooking }}, {{ $SedanBooking }}, {{ $SUVBooking }}, {{ $MUVBooking }}, {{ $CoupeBooking }}, {{ $ConvertiblesBooking }}, {{ $PickupBooking }}],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(213, 48, 255)',
          'rgb(127, 58, 232)',
          'rgb(76, 77, 255)',
          'rgb(58, 125, 232)',
          'rgb(64, 211, 255)',
          'rgb(237, 203, 171)',
        ],
        hoverOffset: 4
      }]
    };

    const config = {
    type: 'doughnut',
    data: data,
    options: {
        
            legend: {
                display: true,
            }
        
    }
  };


    new Chart(
    document.getElementById('locationDoughnutChartLegend'),
    config
  );

    const data1 = {
      labels: [
        'Jan',
        'Feb',
        'March',
        'April',
        'May',
        'June',
        'July',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dev',
      ],
      datasets: [{
        label: 'Sale Status',
        data: [{{ $MonthArray["Jan"] }}, {{ $MonthArray["Feb"] }}, {{ $MonthArray["Mar"] }}, {{ $MonthArray["Apr"] }}, {{ $MonthArray["May"] }}, {{ $MonthArray["Jun"] }}, {{ $MonthArray["Jul"] }}, {{ $MonthArray["Aug"] }}, {{ $MonthArray["Sep"] }}, {{ $MonthArray["Oct"] }}, {{ $MonthArray["Nov"] }}, {{ $MonthArray["Dec"] }}],
        fill: true,
        borderColor: '#2196f3',
        backgroundColor: '#FFF', // Add custom color background (Points and Fill)
        borderWidth: 2,
        tension: 0.1
      }]
    };

    const config1 = {
    type: 'line',
    maintainAspectRatio: false,
    data: data1,
  };


    new Chart(
    document.getElementById('performanceAreaChart'),
    config1
  );
</script>


@endsection