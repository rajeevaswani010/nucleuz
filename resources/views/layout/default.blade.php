
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


    <link rel="stylesheet" href="{{ URL('public/newasserts/plugins/bootstrap/css/bootstrap.min.css') }}">

    <script src="{{ URL('public/newasserts/plugins/jquery/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ URL('public/newasserts/plugins/popper/popper.min.js') }}"></script>
    <script src="{{ URL('public/newasserts/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

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

    <!-- toastr css -->
    <link rel="stylesheet" href="{{ URL('public/newasserts/plugins/toastr/toastr.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ URL('public/newasserts/assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ URL('public/newasserts/css/custom.css') }}" id="main-style-link">

    <script src="{{ URL('public/newasserts/js/jquery.min.js') }}"></script>
    <script src="{{ URL('public/newasserts/plugins/toastr/toastr.min.js') }}"></script>
    
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        //current user settings are fetched and loaded here.. 
    // let settings = {};
    // $.ajax({
    //     url: "{{ URL('office/getCurrentSettings') }}",
    //     method: "POST",
    //     headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //     contentType: false,
    //     cache: false,
    //     processData:false,
    //     encode: true,
    //     data:{},
    //     success: function( data, textStatus, jqXHR ) {
    //         JsData = JSON.parse(data);
    //         if(JsData.Status == 0){
    //             console.log("unable to fetch settings for the user.. ");
    //         }else{
    //             console.log(JsData);
    //             settings.logo = JsData.Data.logo;
    //             //populate other data also.. 
    //             if(JsData.Data.logo != null)
    //                 $('img#logo').attr("src","{{ URL('public') }}/"+JsData.Data.logo);
    //             console.log(settings);
    //         }
    //     },
    //     error: function( jqXHR, textStatus, errorThrown ) {
    //         console.log("unable to fetch settings for the user.. ");
    //     }
    // })

    </script>

    <!-- pusher event listener script..  -->
    <script src="{{ URL('public/newasserts/plugins//pusher/pusher.min.js') }}"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('c110e27ab4f0b7b2a002', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('popup-channel');
        channel.bind('user-register', function(data) {
            alert(JSON.stringify(data));
        });

    </script>

    <script>

        @isset($company_logo) 
        console.log( '{{ $company_logo }}' );
        @endisset
        @isset($company_name) 
        console.log( '{{ $company_name }}' );
        @endisset
        @isset($company_addr) 
        console.log( '{{ $company_addr }}' );
        @endisset

        //a navtive event bus for communication between main section and side / upper tabs. Also notifications.. 
        const myEventBus = (function(){
            this.domObj = new Comment('my-event-bus'); //this dom element is used as an anchor for event bus callbacks.

            this.subscribe = function(event, fn, options){
                this.domObj.addEventListener(event, fn, options);
            }

            this.publish = function(event){
                this.domObj.dispatchEvent(event);
            }
            
            this.getEventListener = function(){
                return this.domObj;
            }
            
            return this;
        })();

    </script>

    <!-- app css -->
    <link rel="stylesheet" href="{{ URL('resources/css/components.css') }}">
    <link rel="stylesheet" href="{{ URL('resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ URL('resources/css/profileImageWithPreviewEdit.css') }}">

    <script src="{{ URL('resources/js/components.js') }}"></script>
    <script src="{{ URL('resources/js/profileImageWithPreviewEdit.js') }}"></script>
    <script src="{{ URL('resources/js/app.js') }}"></script>
    <script src="{{ URL('resources/js/multipleFileUpload.js') }}"></script>
    <script src="{{ URL('resources/js/notifications.js') }}"></script>
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
            @isset($company_logo)
            <img src="{{ URL('public') }}/{{ $company_logo }}" alt="projecterp" class="logo logo-lg" id="logo">
            @else
            <img src="{{ URL('public') }}/logo.png" alt="projecterp" class="logo logo-lg" id="logo">
            @endisset
            </a>
        </div>
        <div class="navbar-content">
    <ul class="dash-navbar">
<!--------------------- Start Dashboard ----------------------------------->
    <li class="dash-item dash-hasmenu dash-trigger">

    <a href="{{ URL('dashboard') }}" class="dash-link "><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">{{ __("Dashboard") }}</span>
        <!-- <span class="dash-arrow"><i data-feather="chevron-right"></i></span> -->
    </a>

    <!-- <ul class="dash-submenu">

            
               <li class="dash-item @if($ActiveAction == 'dashboard') active @endif">
                    <a class="dash-link" href="{{ URL('dashboard') }}">Overview</a>
             </li>                                       
    </ul> -->
</li>

    @if(session("AdminRole") == 1)
    <li class="dash-item dash-hasmenu @if($ActiveAction == 'office') active @endif">
        <a href="{{ URL('office') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext">{{ __("Company") }}</span>
        </a>
    </li>

    <li class="dash-item dash-hasmenu @if($ActiveAction == 'license') active @endif">
        <a href="{{ URL('license') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-clipboard"></i></span><span class="dash-mtext">{{ __("Licenses") }}</span>
        </a>
    </li>

    <li class="dash-item dash-hasmenu @if($ActiveAction == 'product') active @endif">
        <a href="{{ URL('product') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span class="dash-mtext">{{ __("Products") }}</span>
        </a>
    </li>

    <li class="dash-item dash-hasmenu @if($ActiveAction == 'brand') active @endif">
        <a href="{{ URL('brand') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-layers-difference"></i></span><span class="dash-mtext">{{ __("Brands") }}</span>
        </a>
    </li>
    @endif

    @if(session("AdminRole") == 2 || session("AdminRole") == 3)

        <li class="dash-item dash-hasmenu @if($ActiveAction == 'vehicle') active @endif">
        <a href="{{ URL('vehicle') }}" class="dash-link">
            <span class="dash-micon">
                <i class="ti ti-headphones"></i></span><span class="dash-mtext">{{ __("Vehicle Master") }}</span>
        </a>
      </li>

      @if(session("AdminRole") == 2)
      <li class="dash-item dash-hasmenu @if($ActiveAction == 'staff') active @endif">
        <a href="{{ URL('staff') }}" class="dash-link">
            <span class="dash-micon">
                <i class="fa fa-user-circle"></i></span><span class="dash-mtext">{{ __("Staff") }}</span>
        </a>
      </li>

      <li class="dash-item dash-hasmenu @if($ActiveAction == 'pricing') active @endif">
        <a href="{{ URL('pricing') }}" class="dash-link">
            <span class="dash-micon">
                <i class="fa fa-compress"></i></span><span class="dash-mtext">{{ __("Pricing Master") }}</span>
        </a>
      </li>
      @endif
  
        <li class="dash-item dash-hasmenu @if($ActiveAction == 'booking') active @endif">
        <a href="{{ URL('booking') }}" class="dash-link">
            <span class="dash-micon">
                <i class="fa fa-car"></i></span><span class="dash-mtext">{{ __("Car Rental Bookings") }}</span>
        </a>
       </li>
       <!-- <li class="dash-item dash-hasmenu @if($ActiveAction == 'bookingVehicles') active @endif">
        <a href="{{ URL('bookingVehicles') }}" class="dash-link">
            <span class="dash-micon">
                <i class="fa fa-car"></i></span><span class="dash-mtext">{{ __("Booking Vehicles") }}</span>
        </a>
       </li> -->

        <li class="dash-item dash-hasmenu @if($ActiveAction == 'booking-invite') active @endif">
        <a href="{{ URL('booking-invite') }}" class="dash-link">
            <span class="dash-micon"><i class="fa fa-share"></i></span><span class="dash-mtext">{{ __("Invite Customer") }}</span>
        </a>
      </li>
      <li class="dash-item dash-hasmenu @if($ActiveAction == 'customer') active @endif">
        <a href="{{ URL('customer') }}" class="dash-link">
            <span class="dash-micon"><i class="fa fa-users"></i></span><span class="dash-mtext">{{ __("Customers") }}</span>
        </a>
    </li>

    @endif

    <!--------------------- Start Account ----------------------------------->
    @if(session("AdminRole") == 2)
    <li class="dash-item dash-hasmenu @if($ActiveAction == 'reports') active @endif">
        <a href="{{ URL('reports') }}" class="dash-link">
            <span class="dash-micon"><i class="ti ti-share"></i></span><span class="dash-mtext">{{ __("Reports") }}</span>
        </a>
    </li>
    <li class="dash-item dash-hasmenu @if($ActiveAction == 'settings') active @endif">
        <a href="{{ URL('settings') }}" class="dash-link">
            <span class="dash-micon"><i class="fa fa-cog"></i></span><span class="dash-mtext">{{ __("Settings") }}</span>
        </a>
    </li>
<!--
    <li class="dash-item dash-hasmenu @if($ActiveAction == 'testui') active @endif">
        <a href="{{ URL('testui') }}" class="dash-link">
            <span class="dash-micon"><i class="fa fa-bolt"></i></span><span class="dash-mtext">{{ __("testui") }}</span>
        </a>
    </li>
-->
    <li class="dash-item dash-hasmenu
                ">
                <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-box"></i></span><span class="dash-mtext">{{ __("Accounting System") }} 
                    </span><span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                </a>
            <ul class="dash-submenu">

               <li class="dash-item ">
                    <a class="dash-link" href="javascript:void(0)">Vendor</a>
                </li>
                <li class="dash-item ">
                    <a class="dash-link @if($ActiveAction == 'bookingreciepts') active @endif" href="{{ URL('bookingreciepts') }}">{{ __("Booking Receipt") }}</a>
                </li>

                <li class="dash-item ">
                    <a class="dash-link @if($ActiveAction == 'bookinginvoice') active @endif" href="{{ URL('bookinginvoice') }}">{{ __("Invoices") }}</a>
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
        <img src="{{ URL('public/user.png') }}" class="img-fluid rounded-circle">
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

<!-- Notifications dropdown -->
<!-- <li class="dropdown dash-h-item ">
    <div class="dropdown dropdown-notifications">
        <button type="button" id="notification-btn" class="btn btn-light" >
            <i class="fa fa-regular fa-bell" aria-hidden="true"> </i>
            <span class="badge" >
            124 </span>
        </button>    
        <div class="card" id="notification-panel">
        </div>
    </div>
</div> -->
<!-- // END Notifications dropdown -->
<!-- </li> -->


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

<style>
.spanner{
  position:absolute;
  top: 50%;
  left: 0%;
  background: #2a2a2a55;
  width: 100%;
  display:block;
  text-align:center;
  height: 100%;
  color: #FFF;
  transform: translateY(-50%);
  z-index: 10000;
  visibility: hidden;
}

.overlay{
    position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black overlay */
            display: none; /* Initially hidden */
            z-index: 999; /* Adjust the z-index to c*/
}

.loader,
.loader:before,
.loader:after {
  border-radius: 50%;
  width: 2.5em;
  height: 2.5em;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation: load7 1.8s infinite ease-in-out;
  animation: load7 1.8s infinite ease-in-out;
}
.loader {
    position: absolute;
    top: 40%;
    left: 50%;
}
@-webkit-keyframes load7 {
  0%,
  80%,
  100% {
    box-shadow: 0 2.5em 0 -1.3em;
  }
  40% {
    box-shadow: 0 2.5em 0 0;
  }
}
@keyframes load7 {
  0%,
  80%,
  100% {
    box-shadow: 0 2.5em 0 -1.3em;
  }
  40% {
    box-shadow: 0 2.5em 0 0;
  }
}

.show{
  visibility: visible;
}

/* Styling for the overlay */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black overlay */
    display: none; /* Initially hidden */
    z-index: 100000; /* Adjust the z-index to control the overlay's stacking order */
}

.loader {
  font-size: 10px;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  position: relative;
  text-indent: -9999em;
  animation: mulShdSpin 1.1s infinite ease;
  transform: translateZ(0);
  position: absolute;
}
@keyframes mulShdSpin {
  0%,
  100% {
    box-shadow: 0em -2.6em 0em 0em #ffffff, 1.8em -1.8em 0 0em rgba(255,255,255, 0.2), 2.5em 0em 0 0em rgba(255,255,255, 0.2), 1.75em 1.75em 0 0em rgba(255,255,255, 0.2), 0em 2.5em 0 0em rgba(255,255,255, 0.2), -1.8em 1.8em 0 0em rgba(255,255,255, 0.2), -2.6em 0em 0 0em rgba(255,255,255, 0.5), -1.8em -1.8em 0 0em rgba(255,255,255, 0.7);
  }
  12.5% {
    box-shadow: 0em -2.6em 0em 0em rgba(255,255,255, 0.7), 1.8em -1.8em 0 0em #ffffff, 2.5em 0em 0 0em rgba(255,255,255, 0.2), 1.75em 1.75em 0 0em rgba(255,255,255, 0.2), 0em 2.5em 0 0em rgba(255,255,255, 0.2), -1.8em 1.8em 0 0em rgba(255,255,255, 0.2), -2.6em 0em 0 0em rgba(255,255,255, 0.2), -1.8em -1.8em 0 0em rgba(255,255,255, 0.5);
  }
  25% {
    box-shadow: 0em -2.6em 0em 0em rgba(255,255,255, 0.5), 1.8em -1.8em 0 0em rgba(255,255,255, 0.7), 2.5em 0em 0 0em #ffffff, 1.75em 1.75em 0 0em rgba(255,255,255, 0.2), 0em 2.5em 0 0em rgba(255,255,255, 0.2), -1.8em 1.8em 0 0em rgba(255,255,255, 0.2), -2.6em 0em 0 0em rgba(255,255,255, 0.2), -1.8em -1.8em 0 0em rgba(255,255,255, 0.2);
  }
  37.5% {
    box-shadow: 0em -2.6em 0em 0em rgba(255,255,255, 0.2), 1.8em -1.8em 0 0em rgba(255,255,255, 0.5), 2.5em 0em 0 0em rgba(255,255,255, 0.7), 1.75em 1.75em 0 0em #ffffff, 0em 2.5em 0 0em rgba(255,255,255, 0.2), -1.8em 1.8em 0 0em rgba(255,255,255, 0.2), -2.6em 0em 0 0em rgba(255,255,255, 0.2), -1.8em -1.8em 0 0em rgba(255,255,255, 0.2);
  }
  50% {
    box-shadow: 0em -2.6em 0em 0em rgba(255,255,255, 0.2), 1.8em -1.8em 0 0em rgba(255,255,255, 0.2), 2.5em 0em 0 0em rgba(255,255,255, 0.5), 1.75em 1.75em 0 0em rgba(255,255,255, 0.7), 0em 2.5em 0 0em #ffffff, -1.8em 1.8em 0 0em rgba(255,255,255, 0.2), -2.6em 0em 0 0em rgba(255,255,255, 0.2), -1.8em -1.8em 0 0em rgba(255,255,255, 0.2);
  }
  62.5% {
    box-shadow: 0em -2.6em 0em 0em rgba(255,255,255, 0.2), 1.8em -1.8em 0 0em rgba(255,255,255, 0.2), 2.5em 0em 0 0em rgba(255,255,255, 0.2), 1.75em 1.75em 0 0em rgba(255,255,255, 0.5), 0em 2.5em 0 0em rgba(255,255,255, 0.7), -1.8em 1.8em 0 0em #ffffff, -2.6em 0em 0 0em rgba(255,255,255, 0.2), -1.8em -1.8em 0 0em rgba(255,255,255, 0.2);
  }
  75% {
    box-shadow: 0em -2.6em 0em 0em rgba(255,255,255, 0.2), 1.8em -1.8em 0 0em rgba(255,255,255, 0.2), 2.5em 0em 0 0em rgba(255,255,255, 0.2), 1.75em 1.75em 0 0em rgba(255,255,255, 0.2), 0em 2.5em 0 0em rgba(255,255,255, 0.5), -1.8em 1.8em 0 0em rgba(255,255,255, 0.7), -2.6em 0em 0 0em #ffffff, -1.8em -1.8em 0 0em rgba(255,255,255, 0.2);
  }
  87.5% {
    box-shadow: 0em -2.6em 0em 0em rgba(255,255,255, 0.2), 1.8em -1.8em 0 0em rgba(255,255,255, 0.2), 2.5em 0em 0 0em rgba(255,255,255, 0.2), 1.75em 1.75em 0 0em rgba(255,255,255, 0.2), 0em 2.5em 0 0em rgba(255,255,255, 0.2), -1.8em 1.8em 0 0em rgba(255,255,255, 0.5), -2.6em 0em 0 0em rgba(255,255,255, 0.7), -1.8em -1.8em 0 0em #ffffff;
  }
}
/* Additional styling for the content within the overlay */
.overlay-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    /* padding: 40px; */
    border-radius: 5px;
}

</style>

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

<div class="overlay" id="fullViewportOverlay">
    <div class="overlay-content">
        <span id="default-spinner" class="loader"></span>
    </div>
</div>

<!-- Warning Section Ends -->
<!-- Required Js -->
<script src="{{ URL('public/newasserts/js/jquery.form.js') }}"></script>
<!-- <script src="{{ URL('public/newasserts/assets/js/plugins/popper.min.js') }}"></script> -->
<script src="{{ URL('public/newasserts/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/dash.js') }}"></script>
<script src="{{ URL('public/newasserts/js/moment.min.js') }}"></script>


    <!-- COMMENTED as of now.. dont know where it is used. -->
<!-- Apex Chart -->
<!-- <script src="{{ URL('public/newasserts/assets/js/plugins/bootstrap-switch-button.min.js') }}"></script> -->
<script src="{{ URL('public/newasserts/assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/simple-datatables.js') }}"></script>
<!-- <script src="{{ URL('public/newasserts/assets/js/plugins/apexcharts.min.js') }}"></script> -->
<!-- <script src="{{ URL('public/newasserts/assets/js/plugins/main.min.js') }}"></script> -->
<!-- <script src="{{ URL('public/newasserts/assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ URL('public/newasserts/assets/js/plugins/flatpickr.min.js') }}"></script> -->

<script src="{{ URL('public/newasserts/js/jscolor.js') }}"></script>

<script>
    var site_currency_symbol_position = 'pre';
    var site_currency_symbol = '$';
</script>
<script src="{{ URL('public/newasserts/js/custom.js') }}"></script>

<!-- show overlay progress here.. -->
<script>
function showloading(){ 
    console.log("inside showloading");
    document.getElementById('fullViewportOverlay').style.display = 'block';
}

function hideloading(){
    console.log("inside hideloading");
    document.getElementById('fullViewportOverlay').style.display = 'none';
}


// showloading();
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
<!-- <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
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
</script> -->
</body>
</html>
