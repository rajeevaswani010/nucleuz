
<!DOCTYPE html>
<html lang="en" dir="">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<head>
    <title>{{ $ActiveAction ? $ActiveAction : 'Dashboard' }} </title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script> -->

    <!-- Meta -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="https://nucleuz.app/public/favicon.png" type="image" sizes="16x16">

    <!-- Favicon icon -->

    <!-- Calendar-->
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/plugins/main.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/plugins/style.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/plugins/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/plugins/animate.min.css') }}">
    <!-- font css -->
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/fonts/material.css') }}">

    <!--bootstrap switch-->
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/plugins/bootstrap-switch-button.min.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/css/custom.css') }}" id="main-style-link">
    <script src="{{ URL('public/newasserts/js/jquery.min.js') }}"></script>
    
    <link rel="stylesheet" href="{{ URL('resources/css/app.css') }}">
    </head>
<body class="theme-4">

<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<nav class="dash-sidebar light-sidebar transprent-bg">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="{{ URL('dashboard') }}" class="b-brand">
            <img src="{{ URL('public/logo.png') }}" alt="projecterp" class="logo logo-lg">
            </a>
        </div>
        <div class="navbar-content">
    <ul class="dash-navbar">
<!--------------------- Start Dashboard ----------------------------------->
    <li class="dash-item dash-hasmenu dash-trigger">

    <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">Dashboard</span>
        <span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>

    <ul class="dash-submenu">

            
               <li class="dash-item @if($ActiveAction == 'dashboard') active @endif">
                    <a class="dash-link" href="{{ URL('dashboard') }}">Overview</a>
             </li>                                       
    </ul>
</li>

    @if(session("AdminRole") == 1)
    <li class="dash-item dash-hasmenu @if($ActiveAction == 'office') active @endif">
        <a href="{{ URL('office') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext">Company</span>
        </a>
    </li>

    <li class="dash-item dash-hasmenu @if($ActiveAction == 'license') active @endif">
        <a href="{{ URL('license') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-clipboard"></i></span><span class="dash-mtext">Licenses</span>
        </a>
    </li>

    <li class="dash-item dash-hasmenu @if($ActiveAction == 'product') active @endif">
        <a href="{{ URL('product') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext">Products</span>
        </a>
    </li>

    <li class="dash-item dash-hasmenu @if($ActiveAction == 'brand') active @endif">
        <a href="{{ URL('brand') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-layers-difference"></i></span><span class="dash-mtext">Brands</span>
        </a>
    </li>
    @endif

    @if(session("AdminRole") == 2 || session("AdminRole") == 3)

        <li class="dash-item dash-hasmenu @if($ActiveAction == 'vehicle') active @endif">
        <a href="{{ URL('vehicle') }}" class="dash-link">
            <span class="dash-micon">
                <i class="ti ti-headphones"></i></span><span class="dash-mtext">Vehicle Master</span>
        </a>
      </li>

      @if(session("AdminRole") == 2)
      <li class="dash-item dash-hasmenu @if($ActiveAction == 'staff') active @endif">
        <a href="{{ URL('staff') }}" class="dash-link">
            <span class="dash-micon">
                <i class="fa fa-user-circle"></i></span><span class="dash-mtext">Staff</span>
        </a>
      </li>

      <li class="dash-item dash-hasmenu @if($ActiveAction == 'pricing') active @endif">
        <a href="{{ URL('pricing') }}" class="dash-link">
            <span class="dash-micon">
                <i class="fa fa-compress"></i></span><span class="dash-mtext">Pricing Master</span>
        </a>
      </li>
      @endif
  
        <li class="dash-item dash-hasmenu @if($ActiveAction == 'booking') active @endif">
        <a href="{{ URL('booking') }}" class="dash-link">
            <span class="dash-micon">
                <i class="fa fa-car"></i></span><span class="dash-mtext">Car Rental Bookings</span>
        </a>
       </li>

        <li class="dash-item dash-hasmenu @if($ActiveAction == 'booking-invite') active @endif">
        <a href="{{ URL('booking-invite') }}" class="dash-link">
            <span class="dash-micon"><i class="fa fa-users"></i></span><span class="dash-mtext">Invite Customer</span>
        </a>
      </li>
    @endif

    <!--------------------- Start Account ----------------------------------->
    @if(session("AdminRole") == 2)
    <li class="dash-item dash-hasmenu @if($ActiveAction == 'reports') active @endif">
        <a href="{{ URL('reports') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-share"></i></span><span class="dash-mtext">Reports</span>
        </a>
    </li>
    <li class="dash-item dash-hasmenu
                ">
                <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-box"></i></span><span class="dash-mtext">Accounting System 
                    </span><span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                </a>
            <ul class="dash-submenu">

              <li class="dash-item ">
                    <a class="dash-link @if($ActiveAction == 'customer') active @endif" href="{{ URL('customer') }}">Customer</a>
                </li>

               <li class="dash-item ">
                    <a class="dash-link" href="javascript:void(0)">Vendor</a>
                </li>
                <li class="dash-item ">
                    <a class="dash-link @if($ActiveAction == 'bookingreciepts') active @endif" href="{{ URL('bookingreciepts') }}">Booking Receipt</a>
                </li>

                <li class="dash-item ">
                    <a class="dash-link @if($ActiveAction == 'bookinginvoice') active @endif" href="{{ URL('bookinginvoice') }}">Invoices</a>
                </li>

              
                  <li class="dash-item dash-hasmenu ">
                    <a class="dash-link" href="#">Banking<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Account</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Transfer</a>
                        </li>
                    </ul>
                </li>
                                                                                        <li class="dash-item dash-hasmenu ">
                    <a class="dash-link" href="#">Income<span class="dash-arrow">
                        <i data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Invoice</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Revenue</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Credit Note</a>
                        </li>
                    </ul>
                </li>
                                                                                        <li class="dash-item dash-hasmenu ">
                    <a class="dash-link" href="#">Expense<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Bill</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Payment</a>
                        </li>
                        <li class="dash-item  ">
                            <a class="dash-link" href="javascript:void(0)">Debit Note</a>
                        </li>
                    </ul>
                </li>
                                                                                        <li class="dash-item dash-hasmenu ">
                    <a class="dash-link" href="#">Double Entry<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Chart of Accounts</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Journal Account</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Ledger Summary</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Balance Sheet</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="javascript:void(0)">Trial Balance</a>
                        </li>
                    </ul>
                </li>
                                                                                        <li class="dash-item ">
                    <a class="dash-link" href="javascript:void(0)">Budget Planner</a>
                </li>
                                                                                        <li class="dash-item ">
                    <a class="dash-link" href="javascript:void(0)">Financial Goal</a>
                </li>
                                                                                        <li class="dash-item ">
                    <a class="dash-link" href="javascript:void(0)">Accounting Setup</a>
                </li>
            
                                                    <li class="dash-item ">
                    <a class="dash-link" href="javascript:void(0)">Print Settings</a>
                </li>
            
        </ul>
    </li>
    @endif
          
<!--------------------- End Account ----------------------------------->


    @if(session("AdminRole") == 2)

      {{--<li class="dash-item dash-hasmenu @if($ActiveAction == 'customer') active @endif">
        <a href="{{ URL('customer') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext">Customer</span>
        </a>
      </li>--}}

    @endif


</ul>
                        </div>
</div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="dash-header transprent-bg">
<div class="header-wrapper">
<div class="me-auto dash-mob-drp">
<ul class="list-unstyled">
<li class="dash-h-item mob-hamburger">
<a href="#!" class="dash-head-link" id="mobile-collapse">
<div class="hamburger hamburger--arrowturn">
    <div class="hamburger-box">
        <div class="hamburger-inner"></div>
    </div>
</div>
</a>
</li>

<li class="dropdown dash-h-item drp-company">
<a
class="dash-head-link dropdown-toggle arrow-none me-0"
data-bs-toggle="dropdown"
href="#"
role="button"
aria-haspopup="false"
aria-expanded="false"
>
<span class="theme-avtar">
@if(session("AdminImage") == "")
        <img src="{{ URL('public/images/people/50/guy-3.jpg') }}" class="img-fluid rounded-circle">
        @else
        <img src="{{ URL('public') }}/{{ session('AdminImage') }}" class="img-fluid rounded-circle">
        @endif
</span>
<span class="hide-mob ms-2">Hi, {{ session("AdminName") }}</span>
<i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
</a>
<div class="dropdown-menu dash-h-dropdown">

<a href="{{ URL('ChangePassword') }}" class="dropdown-item">
    <i class="ti ti-user"></i>
    <span>Profile</span>
</a>

<a href="{{ URL('logout') }}" class="dropdown-item">
    <i class="ti ti-user"></i>
    <span>Logout</span>
</a>

</div>
</li>

</ul>
</div>

<div class="ms-auto">
<ul class="list-unstyled">
{{--<li class="dropdown dash-h-item drp-notification">
<a class="dash-head-link arrow-none me-0" href="http://localhost/projecterp/chats" aria-haspopup="false"
    aria-expanded="false">
    <i class="ti ti-brand-hipchat"></i>
    <span class="bg-danger dash-h-badge message-toggle-msg  message-counter custom_messanger_counter beep"> 0<span
            class="sr-only"></span>
    </span>
</a>
</li>--}}

<li class="dropdown dash-h-item drp-language">
<a
class="dash-head-link dropdown-toggle arrow-none me-0"
data-bs-toggle="dropdown"
href="#"
role="button"
aria-haspopup="false"
aria-expanded="false"
>
<i class="ti ti-world nocolor"></i>
<span class="drp-text hide-mob">{{ session("Lang") }}</span>
<i class="ti ti-chevron-down drp-arrow nocolor"></i>
</a>
<div class="dropdown-menu dash-h-dropdown dropdown-menu-end">

    <a href="{{ URL('ChangeLanguage') }}/en" class="dropdown-item ">
        <span>English</span>
    </a>

    <a href="{{ URL('ChangeLanguage') }}/ar" class="dropdown-item ">
        <span>Arabic</span>
    </a>
                           
        <h></h>
        </div>
</li>
</ul>
        </div>
    </div>
    </header>


<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
@yield("content")
<!-- [ Main Content ] end -->
<footer class="dash-footer">
    <div class="footer-wrapper">
        <div class="py-1">
            <span class="text-muted">  Copyright <?php echo date('Y'); ?></span>
        </div>

    </div>
</footer>


<!-- Warning Section Ends -->
<!-- Required Js -->
<script src="{{ URL('public/newasserts/js/jquery.form.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/dash.js') }}"></script>
<script src="{{ URL('public/newasserts/js/moment.min.js') }}"></script>



<!-- Apex Chart -->
<script src="{{ URL('public/newasserts/assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/simple-datatables.js') }}"></script>
<!-- Apex Chart -->
<script src="{{ URL('public/newasserts/assets/js/plugins/apexcharts.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/main.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/flatpickr.min.js') }}"></script>

<script src="{{ URL('public/newasserts/js/jscolor.js') }}"></script>

<script>
    var site_currency_symbol_position = 'pre';
    var site_currency_symbol = '$';
</script>
<script src="{{ URL('public/newasserts/js/custom.js') }}"></script>

    <script>
                (function () {
            var chartBarOptions = {
                series: [
                    {
                        name: "Income",
                        data:["0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00"]
                    },
                    {
                        name: "Expense",
                        data: ["0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00","0.00"]
                    }
                ],

                chart: {
                    height: 250,
                    type: 'area',
                    // type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories:["31-Jan","30-Jan","29-Jan","28-Jan","27-Jan","26-Jan","25-Jan","24-Jan","23-Jan","22-Jan","21-Jan","20-Jan","19-Jan","18-Jan","17-Jan"],
                    title: {
                        text: 'Date'
                    }
                },
                colors: ['#6fd944', '#6fd944'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                // markers: {
                //     size: 4,
                //     colors: ['#6fd944', '#FF3A6E'],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // },
                yaxis: {
                    title: {
                        text: 'Amount'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#cash-flow"), chartBarOptions);
            arChart.render();
        })();
        (function () {
            var options = {
                chart: {
                    height: 180,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: "Income",
                    data: [0,0,0,0,0,0,0,0,0,0,0,0]
                }, {
                    name: "Expense",
                    data: [0,0,0,0,0,0,0,0,0,0,0,0]
                }],
                xaxis: {
                    categories: ["January","February","March","April","May","June","July","August","September","October","November","December"],
                },
                colors: ['#3ec9d6', '#FF3A6E'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                // markers: {
                //     size: 4,
                //     colors:  ['#3ec9d6', '#FF3A6E',],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#incExpBarChart"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: [],
                colors: [],
                labels: [],
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#expenseByCategory"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    height: 140,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                        }
                    }
                },
                series: [],
                colors: [],
                labels:  [],
                legend: {
                    show: true
                }
            };
            var chart = new ApexCharts(document.querySelector("#incomeByCategory"), options);
            chart.render();
        })();
            </script>





<script>

    feather.replace();
    var pctoggle = document.querySelector("#pct-toggler");
    if (pctoggle) {
        pctoggle.addEventListener("click", function () {
            if (
                !document.querySelector(".pct-customizer").classList.contains("active")
            ) {
                document.querySelector(".pct-customizer").classList.add("active");
            } else {
                document.querySelector(".pct-customizer").classList.remove("active");
            }
        });
    }

    var themescolors = document.querySelectorAll(".themes-color > a");
    for (var h = 0; h < themescolors.length; h++) {
        var c = themescolors[h];

        c.addEventListener("click", function (event) {
            var targetElement = event.target;
            if (targetElement.tagName == "SPAN") {
                targetElement = targetElement.parentNode;
            }
            var temp = targetElement.getAttribute("data-value");
            removeClassByPrefix(document.querySelector("body"), "theme-");
            document.querySelector("body").classList.add(temp);
        });
    }
    //
    // var custthemebg = document.querySelector("#cust-theme-bg");
    // custthemebg.addEventListener("click", function () {
    //     if (custthemebg.checked) {
    //         document.querySelector(".dash-sidebar").classList.add("transprent-bg");
    //         document
    //             .querySelector(".dash-header:not(.dash-mob-header)")
    //             .classList.add("transprent-bg");
    //     } else {
    //         document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
    //         document
    //             .querySelector(".dash-header:not(.dash-mob-header)")
    //             .classList.remove("transprent-bg");
    //     }
    // });

    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }
</script>
<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
<script >
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher("", {
    encrypted: true,
    cluster: "",
    authEndpoint: 'chats/chat/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }
  });
</script>
<script src="{{ URL('public/newasserts/js/chatify/code.js') }}"></script>
<script>
  // Messenger global variable - 0 by default
  messenger = "";
</script>
</body>
</html>
