<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Nucleuz Admin</title>
        <link rel="icon" type="image/x-icon" href="https://nucleuz.app/public/favicon.png">
        <meta name="robots" content="noindex">

        <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7COswald:300,400,500,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

        <!-- Perfect Scrollbar -->
        <link type="text/css" href="{{ URL('public/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

        <!-- Material Design Icons -->
        <link type="text/css" href="{{ URL('public/css/material-icons.css') }}" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link type="text/css" href="{{ URL('public/css/fontawesome.css') }}" rel="stylesheet">

        <!-- Preloader -->
        <link type="text/css" href="{{ URL('public/vendor/spinkit.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ URL('public/css/preloader.css') }}" rel="stylesheet">

        <!-- App CSS -->
        <link type="text/css" href="{{ URL('public/css/app.css') }}" rel="stylesheet">


         <!-- My Custom CSS -->
         <link type="text/css" href="{{ URL('public/css/custom.css') }}" rel="stylesheet">

        <!-- Dark Mode CSS (optional) -->
        <link type="text/css" href="{{ URL('public/css/dark-mode.css') }}" rel="stylesheet">

    </head>

    
    <body class="layout-app layout-sticky-subnav ">

        <div class="preloader">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>

        <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <div class="navbar navbar-expand navbar-shadow px-0  pl-lg-16pt navbar-light bg-body" id="default-navbar" data-primary>

                    <!-- Navbar toggler -->
                    <button class="navbar-toggler d-block d-lg-none rounded-0" type="button" data-toggle="sidebar">
                        <span class="material-icons">menu</span>
                    </button>

                    <!-- Navbar Brand -->
                    <a href="{{ URL('dashboard') }}" class="navbar-brand mr-16pt d-lg-none">
                        <img class="navbar-brand-icon mr-0 mr-lg-8pt" src="{{ URL('public/logo.png') }}" width="100" alt="Huma">
                        <span class="d-none d-lg-block">Huma</span>
                    </a>

                    <div class="flex"></div>

                    <div class="nav navbar-nav flex-nowrap d-none d-lg-flex mr-16pt"
                         style="white-space: nowrap;">
                        <div class="nav-item dropdown d-none d-sm-flex">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ session("Lang") }}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header"><strong>{{ __('Select Language') }}</strong></div>
                                <a class="dropdown-item active" href="{{ URL('ChangeLanguage') }}/en">English</a>
                                <a class="dropdown-item"  href="{{ URL('ChangeLanguage') }}/ar">Arabic</a>
                            </div>
                        </div>
                    </div>

                    <div class="nav navbar-nav flex-nowrap d-flex ml-0 mr-16pt">
                        <div class="nav-item dropdown d-none d-sm-flex">
                            <a href="#"
                               class="nav-link d-flex align-items-center dropdown-toggle"
                               data-toggle="dropdown">
                                @if(session("AdminImage") == "")
                                <img width="32" height="32" class="rounded-circle mr-8pt" src="{{ URL('public/images/people/50/guy-3.jpg') }}" alt="account" />
                                @else
                                <img width="32" height="32" class="rounded-circle mr-8pt" src="{{ URL('public') }}/{{ session('AdminImage') }}" alt="account" />
                                @endif
                                <span class="flex d-flex flex-column mr-8pt">
                                    <span class="navbar-text-100">{{ session("AdminName") }}</span>
                                    <small class="navbar-text-50">{{ __('Administrator') }}</small>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header"><strong>{{ __('Account') }}</strong></div>
                                <a class="dropdown-item" href="{{ URL('ChangePassword') }}">{{ __('Edit Account') }}</a>
                            </div>
                        </div>
                        
                        @php
                        $GetUnreadCounter = App\Models\Notification::where("user_id", session("AdminID"))->where("status", 0)->count();
                        $GetNotis = App\Models\Notification::where("user_id", session("AdminID"))->limit(10)->get();
                        @endphp

                        <!-- Notifications dropdown -->
                        <div class="nav-item ml-16pt dropdown dropdown-notifications">
                            <button class="nav-link btn-flush dropdown-toggle"
                                    type="button"
                                    data-toggle="dropdown"
                                    data-dropdown-disable-document-scroll
                                    data-caret="false">
                                <i class="material-icons">notifications</i>
                                @if($GetUnreadCounter > 0)
                                <span class="badge badge-notifications badge-accent">{{ $GetUnreadCounter }}</span>
                                @endif
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div data-perfect-scrollbar
                                     class="position-relative">
                                    <div class="dropdown-header"><strong>{{ __('Booking Notifications') }}</strong></div>
                                    <div class="list-group list-group-flush mb-0">
                                        @foreach($GetNotis as $Notification)
                                        <a href="{{ URL('booking-invite') }}" onClick="ReadNoti('{{ $Notification->id }}')" class="list-group-item list-group-item-action unread">
                                            <span class="d-flex align-items-center mb-1">
                                                <small class="text-black-50">{{ $Notification->created_at->diffForhumans() }}</small>
                                                @if($Notification->status == 0)
                                                <span class="ml-auto unread-indicator bg-accent"></span>
                                                @endif
                                            </span>
                                            <span class="d-flex">
                                                <span class="avatar avatar-xs mr-2">
                                                    <span class="avatar-title rounded-circle bg-light">
                                                        <i class="material-icons font-size-16pt text-accent">account_circle</i>
                                                    </span>
                                                </span>
                                                <span class="flex d-flex flex-column">

                                                    <span class="text-black-70">{{ $Notification->desp }}</span>
                                                </span>
                                            </span>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- // END Notifications dropdown -->
                    </div>
                </div>

                <!-- // END Header -->

                @yield("content")
            </div>
            <!-- // END drawer-layout__content -->

            <!-- drawer -->
            <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
                <div class="mdk-drawer__content">
                    <div class="sidebar sidebar-dark sidebar-left" data-perfect-scrollbar>

                        <a href="{{ URL('dashboard') }}" class="sidebar-brand ">
                            <img class="sidebar-brand-icon" src="{{ URL('public/favicon.png') }}">
                        </a>
                        <ul class="sidebar-menu">
                            <li class="sidebar-menu-item @if($ActiveAction == 'dashboard') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('dashboard') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">insert_chart_outlined</span>
                                    <span class="sidebar-menu-text">{{ __('Dashboard') }}</span>
                                </a>
                            </li>

                            @if(session("AdminRole") == 1)
                            <li class="sidebar-menu-item @if($ActiveAction == 'office') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('office') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">apartment</span>
                                    <span class="sidebar-menu-text">{{ __('Company') }}</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item @if($ActiveAction == 'product') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('product') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">insert_chart_outlined</span>
                                    <span class="sidebar-menu-text">{{ __('Products') }}</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item @if($ActiveAction == 'license') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('license') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">verified_user</span>
                                    <span class="sidebar-menu-text">{{ __('License') }}</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item @if($ActiveAction == 'brand') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('brand') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">insert_chart_outlined</span>
                                    <span class="sidebar-menu-text">{{ __('Brands') }}</span>
                                </a>
                            </li>
                            @endif

                            @if(session("AdminRole") == 2 || session("AdminRole") == 3)
                            @if(session("AdminRole") == 2)
                            <li class="sidebar-menu-item @if($ActiveAction == 'vehicle') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('vehicle') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">directions_car</span>
                                    <span class="sidebar-menu-text">{{ __('Vehicle Master') }}</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item @if($ActiveAction == 'pricing') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('pricing') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">payment</span>
                                    <span class="sidebar-menu-text">{{ __('Pricing Master') }}</span>
                                </a>
                            </li>
                            @endif
                            
                            <li class="sidebar-menu-item @if($ActiveAction == 'booking') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('booking') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">redeem</span>
                                    <span class="sidebar-menu-text">{{ __('Car Rental Bookings') }}</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item @if($ActiveAction == 'booking-invite') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('booking-invite') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">person</span>
                                    <span class="sidebar-menu-text">{{ __('Invite Customer') }}</span>
                                </a>
                            </li>
                            
                            
                            @if(session("AdminRole") == 2)
                            <li class="sidebar-menu-item @if($ActiveAction == 'reports') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('reports') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">insert_chart_outlined</span>
                                    <span class="sidebar-menu-text">{{ __('Reports') }}</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-menu-item @if($ActiveAction == 'customer') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('customer') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">person</span>
                                    <span class="sidebar-menu-text">{{ __('Customer') }}</span>
                                </a>
                            </li>
                            
                            
                            <li class="sidebar-menu-item @if($ActiveAction == 'staff') active @endif">
                                <a class="sidebar-menu-button" href="{{ URL('staff') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">group</span>
                                    <span class="sidebar-menu-text">{{ __('Staff') }}</span>
                                </a>
                            </li>
                            @endif
                            @endif

                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ URL('logout') }}">
                                    <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">logout</span>
                                    <span class="sidebar-menu-text">{{ __('Logout') }}</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- // END drawer -->
        </div>
        <!-- // END drawer-layout -->


        <!-- jQuery -->
        <script src="{{ URL('public/vendor/jquery.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="{{ URL('public/vendor/popper.min.js') }}"></script>
        <script src="{{ URL('public/vendor/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar -->
        <script src="{{ URL('public/vendor/perfect-scrollbar.min.js') }}"></script>

        <!-- DOM Factory -->
        <script src="{{ URL('public/vendor/dom-factory.js') }}"></script>

        <!-- MDK -->
        <script src="{{ URL('public/vendor/material-design-kit.js') }}"></script>

        <!-- App JS -->
        <script src="{{ URL('public/js/app.js') }}"></script>

        <!-- Highlight.js -->
        <script src="{{ URL('public/js/hljs.js') }}"></script>

        <!-- List.js -->
        <script src="{{ URL('public/vendor/list.min.js') }}"></script>
        <script src="{{ URL('public/js/list.js') }}"></script>

        <!-- Tables -->
        <script src="{{ URL('public/js/toggle-check-all.js') }}"></script>
        <script src="{{ URL('public/js/check-selected-row.js') }}"></script>
        

        @yield("ExtraJS")
        
        <script>
            function ReadNoti(id){
                $.ajax({
                  url: "{{ URL('ReadNotification') }}?id="+id,
                  method: "GET",
                  
                  success: function( data, textStatus, jqXHR ) {
                      
                  },
                  error: function( jqXHR, textStatus, errorThrown ) {
                      
                  }
                });
            }
        </script>
    </body>

</html>