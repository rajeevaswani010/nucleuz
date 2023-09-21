@extends("layout.default")

@section("content")

<link rel="stylesheet"
    href="{{ URL('public/newasserts/plugins/apexcharts/apexcharts.css') }}">

<script src="{{ URL('public/newasserts/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL('public/newasserts/plugins/fullcalendar/index.global.min.js') }}">
</script>

<style>
    .h100 {
        height: 100px;
    }

    .h200 {
        height: 200px;
    }

    .h300 {
        height: 300px;
    }

    .h400 {
        height: 400px;
    }

    .h500 {
        height: 500px;
    }

    .h600 {
        height: 600px;
    }

    .h800 {
        height: 800px;
    }

    .h1000 {
        height: 1000px;
    }

    .card.action {
        background: #584ed2;
    }
    .action img{
        width:100px;
        height:100px;
        position: absolute;
        margin: auto;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
</style>

<script src="{{ URL('public/newasserts/js/fullcalendar-6.1.8/dist/index.global.min.js') }}">
</script>

<!-- [ Main Content ] start -->
<div class="dash-container">
    <div class="dash-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-header-title">
                            <h4 class="m-b-10">{{ __("Dashboard") }}</h4>
                        </div>
                        <ul class="breadcrumb">
                        </ul>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] start -->
        @if(session("AdminRole") != "1")
            <div class="row">

                <div class="col-sm-12 col-lg-8">
                    <div class="row">

                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <a
                                href="{{ URL('reports') }}?report_type=On+Rent&from_date={{ date('Y-m-d') }}">
                                <div class="card  ">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="d-flex align-items-center mb-3 mt-3">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="fa fa-angle-right"></i>
                                                </div>
                                                <div class="ms-3 mb-3 mt-3">
                                                    <h6 class="ml-4">{{ __("On Rent") }}</h6>
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

                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <a
                                href="{{ URL('reports') }}?report_type=Returns&from_date={{ date('Y-m-d') }}">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="d-flex align-items-center mb-3 mt-3">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="fa fa-angle-right"></i>
                                                </div>
                                                <div class="ms-3 mb-3 mt-3">
                                                    <h6 class="ml-4">{{ __("Drop-Off Today") }}</h6>
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

                        <div class="col-sm-6 col-md-6 col-lg-3">
                        <a
                                href="{{ URL('booking') }}?from_date={{ date('Y-m-d') }}&to_date={{ date('Y-m-d') }}">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="d-flex align-items-center mb-3 mt-3">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="fa fa-angle-right"></i>
                                                </div>
                                                <div class="ms-3 mb-3 mt-3">
                                                    <h6 class="ml-4">{{ __("Pickup Today") }}</h6>
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

                        <div class="col-sm-6 col-md-6 col-lg-3">
                        <a href="{{ URL('booking') }}?from_date={{ date('Y-m-d', strtotime('+1 day')) }}&to_date={{ date('Y-m-d', strtotime('+1 day')) }}">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <div class="d-flex align-items-center mb-3 mt-3">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="fa fa-angle-right"></i>
                                                </div>
                                                <div class="ms-3 mb-3 mt-3">
                                                    <h6 class="ml-4">{{ __("Pickup Tomorr.") }}</h6>
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

                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header">
                                    <h5>{{ __("Pick up schedule") }} </h5>
                                </div>
                                <div class="card-body ">
                                    <div id='calendar'>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card h400">
                                <div class="card-header">
                                    <h5>{{ __("Sale Status") }}</h5>
                                </div>
                                <div class="card-body">
                                    <div id='columnchart'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                        <a href="{{ URL('booking/create') }}" data-size="lg" data-url="{{ URL('booking/create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="Create new booking" data-title="Add New Booking">
                            <div class="card h200 action">
                                <div class="card-body">
                                    <img src="{{ URL('public/newasserts/icons/leasing.png') }}" alt="projecterp" class="logo logo-lg">
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                        <a href="{{ URL('reports') }}?report_type=Available&from_date={{ date('Y-m-d') }}&search=search" data-ajax-popup="true" data-bs-toggle="tooltip" title="Check Availability">
                            <div class="card h200 action">
                                <div class="card-body">
                                    <img src="{{ URL('public/newasserts/icons/calendar.png') }}" alt="projecterp" class="logo logo-lg">
                                </div>
                            </div>
                        </a>
                        </div>
                        <div class="col-12">
                            <div class="card h500">
                                <div class="card-header">
                                    <h5>{{ __("Booking Data") }}</h5>
                                </div>
                                <div class="card-body ">
                                    <div id='donutchart'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                            <div class="card h200 ">
                                <div class="card-body">
                                    <h5>acto-1</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-6">
                            <div class="card h200 ">
                                <div class="card-body">
                                    <h5>infocard-1</h5>
                                </div>
                            </div>
                        </div> -->
                    </div>
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
                                        <p class="mb-0">
                                            <strong>{{ __('Number of Company') }}</strong></p>
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
                                        <p class="mb-0">
                                            <strong>{{ __('Number of Users') }}</strong></p>

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
                                        <p class="mb-0">
                                            <strong>{{ __('Number of Active License') }}</strong>
                                        </p>

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
                                        <p class="mb-0">
                                            <strong>{{ __('Number of Expiry License') }}</strong>
                                        </p>
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
                                        <p class="mb-0">
                                            <strong>{{ __('License Products') }}</strong></p>
                                        <br />
                                        <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $totalLicenseProduct }}
                                        </p>
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
                                        <p class="mb-0">
                                            <strong>{{ __('Number of Suspended License') }}</strong>
                                        </p>
                                        <br />
                                        <p class="h2 mb-0 mr-3" style="text-align:center;">{{ $suspendedlicensecount }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif


        <script type="text/javascript">

            @if(session("AdminRole") != "1")

                var calendar;

                document.addEventListener('DOMContentLoaded', function () {

                    // column chart - sale status.....
                    const data = {
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
                            'Dec',
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

                    var options = {
                        series: [{
                            name: 'Sale Status',
                            data: data.datasets[0].data
                        }],
                        chart: {
                            height: '100%',
                            type: 'bar',
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 10,
                                dataLabels: {
                                    position: 'top', // top, center, bottom
                                },
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                                return val;
                            },
                            offsetY: -20,
                            style: {
                                fontSize: '10px',
                                colors: ["#304758"]
                            }
                        },

                        xaxis: {
                            categories: data.labels,
                            position: 'top',
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        colorFrom: '#D8E3F0',
                                        colorTo: '#BED1E6',
                                        stops: [0, 100],
                                        opacityFrom: 0.4,
                                        opacityTo: 0.5,
                                    }
                                }
                            },
                            tooltip: {
                                enabled: true,
                            }
                        },
                        yaxis: {
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                show: false,
                                formatter: function (val) {
                                    return val;
                                }
                            }

                        },
                        title: {
                            text: 'Sale Status',
                            floating: true,
                            offsetY: 330,
                            align: 'center',
                            style: {
                                color: '#444'
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#columnchart"), options);
                    chart.render();
                 //---------------------------------------------------------------

                   // donutchart - vehicle status.....
                   const data2 = {
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

                    options = {
                        series: data2.datasets[0].data,
                        chart: {
                            type: 'donut',
                            height: '100%',
                        },
                        plotOptions: {
                            donut: {
                                expandOnClick: false
                            }
                        },
                        dataLabels:{
                            enabled: false,
                            formatter: function(val){
                                return val;
                            }
                        },
                        labels: data2.labels,
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }]
                    };

                    chart = new ApexCharts(document.querySelector("#donutchart"), options);
                    chart.render();
                 //---------------------------------------------------------------

              //pickup calendar ---------
                    var calendarEl = document.getElementById('calendar');
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            end: 'prev,next',// today',
                            center: 'title',
                            start: '' //'dayGridMonth',//,timeGridWeek,timeGridDay'
                        },
                        aspectRatio: 2,
                        eventClick: function(info){
                            if (info.event.url) {
                                window.open(info.event.url,"_SELF");
                                info.jsEvent.preventDefault();
                            }
                        },
                        events: '/Booking/Get'	//gets the booking from booking controller
                    });

                    calendar.render();

                });
                 //---------------------------------------------------------------

            @endif

        </script>

        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->




@endsection