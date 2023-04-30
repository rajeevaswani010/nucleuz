<!DOCTYPE html>
<html lang="en" dir="">
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<head>
    <title>Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>

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


        <img src="{{ URL('public/logo.png') }}"  alt="dashboard" class="logo logo-lg">
                
            </a>
        </div>
        <div class="navbar-content">
                            <ul class="dash-navbar">
                   
                </ul>
                            <ul class="dash-navbar">

                            <li class="dash-item dash-hasmenu  @if($ActiveAction == 'dashboard') active @endif">
                            <a href="{{ URL('dashboard') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">Dashboard</span>
                            </a>
                        </li>

                    
                        @if(session("AdminRole") == 1)
                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'office') active @endif">
                            <a href="{{ URL('office') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext">Company</span>
                            </a>
                        </li>
                    
                            <li class="dash-item dash-hasmenu  @if($ActiveAction == 'product') active @endif">
                            <a href="{{ URL('product') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-trophy"></i></span><span class="dash-mtext">Products</span>
                            </a>
                        </li>


                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'license') active @endif">
                            <a href="{{ URL('license') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-arrow-up-right-circle"></i></span><span class="dash-mtext">License</span>
                            </a>
                        </li>
                        
                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'brand') active @endif">
                            <a href="{{ URL('brand') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-gift"></i></span><span class="dash-mtext">Brands</span>
                            </a>
                        </li>
                        @endif


                        @if(session("AdminRole") == 2 || session("AdminRole") == 3)
                            @if(session("AdminRole") == 2)

                        <li class="dash-item dash-hasmenu  @if($ActiveAction == 'vehicle') active @endif">
                            <a href="{{ URL('vehicle') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span><span class="dash-mtext">Vehicle Master</span>
                            </a>
                        </li>

                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'pricing') active @endif">
                            <a href="{{ URL('pricing') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-template"></i></span>
                                <span class="dash-mtext">Pricing Master</span></a>
                        </li>
                        @endif

                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'booking') active @endif">
                            <a href="{{ URL('booking') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext">Car Rental Bookings</span>
                            </a>
                        </li>

                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'booking-invite') active @endif">
                            <a href="{{ URL('booking-invite') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext">Invite Customer</span>
                            </a>
                        </li>



                        @if(session("AdminRole") == 2)
                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'reports') active @endif">
                            <a href="{{ URL('reports') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext">Reports</span>
                            </a>
                        </li>


                        <!--------------------- Start Account ----------------------------------->
                        <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-box"></i></span><span class="dash-mtext">Accounting System 
                        </span><span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu">
                                                    <li class="dash-item ">
                        <a class="dash-link" href="http://localhost/projecterp/customer">Customer</a>
                        </li>

                        <li class="dash-item ">
                        <a class="dash-link" href="http://localhost/projecterp/vender">Vendor</a>
                        </li>

                        <li class="dash-item ">
                        <a class="dash-link" href="http://localhost/projecterp/proposal">Proposal</a>
                        </li>

                        <li class="dash-item dash-hasmenu ">
                        <a class="dash-link" href="#">Banking<span class="dash-arrow">
                            <i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/bank-account">Account</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/bank-transfer">Transfer</a>
                        </li>
                        </ul>
                        </li>

                        <li class="dash-item dash-hasmenu ">
                        <a class="dash-link" href="#">Income<span class="dash-arrow">
                            <i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/invoice">Invoice</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/revenue">Revenue</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/credit-note">Credit Note</a>
                        </li>
                        </ul>
                        </li>
                                                                                        <li class="dash-item dash-hasmenu ">
                        <a class="dash-link" href="#">Expense<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/bill">Bill</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/payment">Payment</a>
                        </li>
                        <li class="dash-item  ">
                            <a class="dash-link" href="http://localhost/projecterp/debit-note">Debit Note</a>
                        </li>
                        </ul>
                        </li>
                                                                                        <li class="dash-item dash-hasmenu ">
                        <a class="dash-link" href="#">Double Entry<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/chart-of-account">Chart of Accounts</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/journal-entry">Journal Account</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/report/ledger">Ledger Summary</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/report/balance-sheet">Balance Sheet</a>
                        </li>
                        <li class="dash-item ">
                            <a class="dash-link" href="http://localhost/projecterp/report/trial-balance">Trial Balance</a>
                        </li>
                        </ul>
                        </li>
                                                                                        <li class="dash-item ">
                        <a class="dash-link" href="http://localhost/projecterp/budget">Budget Planner</a>
                        </li>
                                                                                        <li class="dash-item ">
                        <a class="dash-link" href="http://localhost/projecterp/goal">Financial Goal</a>
                        </li>
                                                                                        <li class="dash-item ">
                        <a class="dash-link" href="http://localhost/projecterp/taxes">Accounting Setup</a>
                        </li>

                                                    <li class="dash-item ">
                        <a class="dash-link" href="http://localhost/projecterp/print-setting">Print Settings</a>
                        </li>

                        </ul>
                        </li>

                        <!--------------------- End Account ----------------------------------->










                        <li class="dash-item dash-hasmenu @if($ActiveAction == 'customer') active @endif">
                            <a href="{{ URL('customer') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext">Customer</span>
                            </a>
                        </li>


                        {{--<li class="dash-item dash-hasmenu @if($ActiveAction == 'staff') active @endif">
                            <a href="{{ URL('staff') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext">Staff</span>
                            </a>
                        </li>--}}

                        @endif
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

                        <a href="{{ URL('logout') }}"  class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>Logout</span>
                        </a>
                       

                    </div>
                </li>

            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                



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

                            <a href="{{ URL('ChangeLanguage') }}/en" class="dropdown-item active">
                                <span>English</span>
                            </a>

                            <a href="{{ URL('ChangeLanguage') }}/ar" class="dropdown-item ">
                                <span>Arabic</span>
                            </a>

                                                
                            </div>
                </li>
            </ul>
        </div>
    </div>
    </header>

<!-- Modal -->
{{--<div class="modal notification-modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button
                    type="button"
                    class="btn-close float-end"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
                <h6 class="mt-2">
                    <i data-feather="monitor" class="me-2"></i>Desktop settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="pcsetting1"
                        checked
                    />
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting1"
                    >Allow desktop notification</label
                    >
                </div>
                <p class="text-muted ms-5">
                    you get lettest content at a time when data will updated
                </p>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting2"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting2"
                    >Store Cookie</label
                    >
                </div>
                <h6 class="mb-0 mt-5">
                    <i data-feather="save" class="me-2"></i>Application settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting3"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting3"
                    >Backup Storage</label
                    >
                </div>
                <p class="text-muted mb-4 ms-5">
                    Automaticaly take backup as par schedule
                </p>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="pcsetting4"/>
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting4"
                    >Allow guest to print file</label
                    >
                </div>
                <h6 class="mb-0 mt-5">
                    <i data-feather="cpu" class="me-2"></i>System settings
                </h6>
                <hr/>
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="pcsetting5"
                        checked
                    />
                    <label class="form-check-label f-w-600 pl-1" for="pcsetting5"
                    >View other user chat</label
                    >
                </div>
                <p class="text-muted ms-5">Allow to show public user message</p>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light-danger btn-sm"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <button type="button" class="btn btn-light-primary btn-sm">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>--}}
<!-- [ Header ] end -->

<!-- [ Main Content ] start -->

@yield("content")


<!-- [ Main Content ] end -->
<footer class="dash-footer">
    <div class="footer-wrapper">
        <div class="py-1">
            <span class="text-muted">  Copyright  <?php echo date('Y'); ?></span>
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
                        name: 'Income',
                        data:  [0,0,0,0,0,0,0,0,0,0,0,0,0,0],

                    },
                ],

                chart: {
                    height: 300,
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
                    categories: ["25-Dec","26-Dec","27-Dec","28-Dec","29-Dec","30-Dec","31-Dec","01-Jan","02-Jan","03-Jan","04-Jan","05-Jan","06-Jan","07-Jan"],
                    title: {
                        text: 'Months'
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
                //     colors: ['#ffa21d', '#FF3A6E'],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // },
                yaxis: {
                    title: {
                        text: 'Income'
                    },

                }

            };
            var arChart = new ApexCharts(document.querySelector("#chart-sales"), chartBarOptions);
            arChart.render();
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
