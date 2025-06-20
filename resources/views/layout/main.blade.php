<!DOCTYPE html>
<html x-data="main" class="" :class="[$store.app.mode]">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Tailwind CSS Admin & Dashboard Template" />
    <meta name="author" content="Webonzer" />

    <!-- Site Tiltle -->
    <title> @yield('title')</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />

    <!-- Custom Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    {{-- select 2 --}}
     <!-- jQuery (Select2 depends on jQuery) -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="{{ asset('assets/css/customselect2.css') }}">
     {{-- datepicker --}}
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>

    {{-- CSS --}}
    @yield('css')
    <style>
       /* body *:not(.fl-wrapper) {
            z-index: auto !important;
        } */
        .fl-wrapper {
            z-index: 2147483647 !important; /* Nilai maksimum z-index */
        }
        [x-cloak] { display: none !important; }
         @media (max-width: 768px) {

            #container {
                margin-bottom: 100px;
            }
        }
    </style>
</head>

<body x-data="main" class="antialiased relative font-inter bg-white dark:bg-black text-black dark:text-white text-sm font-normal overflow-x-hidden vertical" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.rightsidebar ? 'right-sidebar' : '', $store.app.menu, $store.app.layout]">
    <!-- Start Menu Sidebar Olverlay -->
    <div x-cloak class="fixed inset-0 bg-[black]/60 z-40 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>
    <!-- End Menu Sidebar Olverlay -->

    <!-- Start Right Sidebar Olverlay -->
    <div x-cloak class="fixed inset-0 bg-[black]/60 z-50 2xl:hidden" :class="{'hidden' : !$store.app.rightsidebar}" @click="$store.app.rightSidebar()"></div>
    <!-- End Right Sidebar Olverlay -->


    <!-- Start Main Content -->
    <div class="main-container navbar-sticky flex" :class="[$store.app.navbar]">
        <!-- Start Sidebar -->
        @include('layout.partial.sidebar')
        <!-- End sidebar -->

        <!-- Start Content Area -->
        <div class="main-content flex-1">
            <!-- Start Topbar -->
           @include('layout.partial.topbar')
            <!-- End Topbar -->

            <!-- Start Content -->
            <div class="h-[calc(100vh-73px)] overflow-y-auto overflow-x-hidden">
                 <div class="@if(request::is('setelan')) p-0 @else p-3 @endif sm:p-7 min-h-[calc(100vh-145px)]" id="container">
                    @yield('container')
                 </div>
                
                <!-- Start Footer -->
                {{-- <footer class="p-7 bg-white dark:bg-black flex flex-wrap items-center justify-center sm:justify-between gap-3">
                    <p class="text-xs text-black/40 dark:text-white/40">&copy; 2023 Snow</p>
                    <ul class="flex items-center text-black/40 dark:text-white/40 text-xs">
                        <li><a href="javascirpt:;" class="px-2 py-1 hover:text-black dark:hover:text-white transition-all duration-300">About</a></li>
                        <li><a href="javascirpt:;" class="px-2 py-1 hover:text-black dark:hover:text-white transition-all duration-300">Support</a></li>
                        <li><a href="javascirpt:;" class="px-2 py-1 hover:text-black dark:hover:text-white transition-all duration-300">Contact Us</a></li>
                    </ul>
                </footer> --}}
                <!-- End Footer -->
            </div>
            <!-- End Content -->
        </div>
        <!-- End Content Area -->

        <!-- Start Right Sidebar -->
        @include('layout.partial.rightsidebar')
        <!-- End Right Sidebar -->
    </div>
    
    <!-- All javascirpt -->
    <!-- Alpine js -->
    <script src="{{ asset('assets/js/alpine-collaspe.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-persist.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-ui.min.js') }}" ></script>
    <script src="{{ asset('assets/js/alpine.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('js')
</body>
</html>