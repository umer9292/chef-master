<!DOCTYPE html>
<html lang="en">
    <head><base href="">
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Chef | Master</title>
        <meta name="description" content="Updates and statistics" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/plugins/global/plugins.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/style.bundle.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/css/themes/layout/header/base/light.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/header/menu/light.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/brand/dark.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/themes/layout/aside/dark.css?v=7.0.5')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />

{{--        <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" type="text/css">

        <!-- dataTables css & js files -->
        <link href="{{asset('css/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

        @yield('extra-css')
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
            <!--begin::Logo-->
            <a href="{{route('admin.dashboard')}}">
                <img alt="Logo" src="{{asset('assets/media/logos/logo-light.png')}}" />
            </a>
            <!--end::Logo-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Aside Mobile Toggle-->
                <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Aside Mobile Toggle-->
                <!--begin::Header Menu Mobile Toggle-->
                <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Header Menu Mobile Toggle-->
                <!--begin::Topbar Mobile Toggle-->
                <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </button>
                <!--end::Topbar Mobile Toggle-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-row flex-column-fluid page">
                <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                    <!--begin::Brand-->
                    @include('admin.partial.brand')
                    <!--end::Brand-->
                    <!--begin::Aside Menu-->
                    @include('admin.partial.sidebar')
                    <!--end::Aside Menu-->
                </div>
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    @include('admin.partial.header')
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @include('admin.partial.subheader')
                        @include('admin.extras.message')
                        @yield('content')
                    </div>
                    @include('admin.partial.footer')
                </div>
            </div>
        </div>
        <!-- begin::User Panel-->
        <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
            <!--begin::Header-->
            <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                <h3 class="font-weight-bold m-0">User Profile</h3>
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="offcanvas-content pr-5 mr-n5">
                <!--begin::Header-->
                <div class="d-flex align-items-center mt-5">
                    <div class="symbol symbol-100 mr-5">
                        <div class="symbol-label" style="background-image:url({{asset('assets/media/users/umer.jpg')}})"></div>
                        <i class="symbol-badge bg-success"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{\Auth::user()->name}}</a>
                        <div class="text-muted mt-1">Web Developer</div>
                        <div class="navi mt-2">
                            <a href="#" class="navi-item">
                                <span class="navi-link p-0 pb-2">
                                    <span class="navi-icon mr-1">
                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary">{{\Auth::user()->email}}</span>
                                </span>
                            </a>
                            <a href="{{ route('logout') }}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                               onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                {{ __('Sign Out') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-8 mb-5"></div>
                <!--end::Separator-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>


        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <script src="{{asset('assets/plugins/global/plugins.bundle.js?v=7.0.5')}}"></script>
        <script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5')}}"></script>
        <script src="{{asset('assets/js/scripts.bundle.js?v=7.0.5')}}"></script>
        <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.5')}}"></script>
        <script src="{{asset('assets/js/pages/widgets.js?v=7.0.5')}}"></script>
        <script src="{{asset('js/dataTables.min.js')}}"></script>
        <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
        <script src="{{asset('js/select2.min.js')}}"></script>
        <script src="{{asset('js/toastr.min.js')}}"></script>
        <script>
            $('.element').tooltip();

            $(document).ready(function() {
                $('.select2').select2();
            });

        </script>
        @yield('extra-js')
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error('{{ $error }}');
                </script>
            @endforeach
        @endif

        {!! Toastr::message() !!}
    </body>
</html>
