<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-layout-style="detached"
    data-sidebar="{{ $mode }}" data-topbar="dark" data-sidebar-size="lg" data-bs-theme="{{ $mode }}"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | BYT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Thimbiri Wewa Resort Wilpattu" name="description" />
    <meta content="CyberWolf Solutions (Pvt) Ltd." name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" /> --}}
    @vite(['resources/js/app.js'])





    <!-- FullCalendar CSS -->
    <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet">
    <!-- Add this to app.css via compilation -->

    <script src="{{ asset('js/fullcalendar.js') }}"></script>
    <script src="{{ asset('resources/js/app.js') }}"></script>
    <!-- Add to app.js via npm -->

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">
    @include('layouts.head-css')

    <style>
        /* Gradient Backgrounds */
        .bg-gradient-blue {
            background: linear-gradient(135deg, #ffc37a, #ffd7b5);
            /* Subtle beige gradient */
        }
    
        .bg-gradient-gray {
            background: linear-gradient(135deg, #e18b8b, #ffd6d6);
            /* Soft gray gradient */
        }
    
        .bg-gradient-green {
            background: linear-gradient(135deg, #a7ff8a, #9dc685);
            /* Calm green gradient */
        }
    
        .bg-gradient-beige {
            background: linear-gradient(135deg, #69317f, #e990ff);
            /* Muted blue gradient */
        }
    
        .bg-gradient-teal {
            background: linear-gradient(135deg, #80fffb, #7dacab);
            /* Light teal gradient */
        }
    
        /* General Card Styles */
        .card {
            border-radius: 15px !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15); /* Increased shadow */
        }
    
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.25); /* Increased hover shadow */
        }
    
        .card-title {
            font-size: 2rem;
            font-weight: 700;
            color: rgb(57, 56, 56); /* Set font color to black */
        }
    
        .card-text {
            font-size: 1rem;
            font-weight: 500;
            color: rgb(56, 56, 55); /* Set font color to black */
        }
    </style>
    
</head>

@section('body')
    @include('layouts.body')
@show
<!-- Begin page -->
<div id="loader" class="position-absolute d-none"
    style="z-index: 9999;top:0;left:0;user-select: none;background-color:#0000007b;width:100vmax;height:100%;display: flex;
justify-content: center;
align-items: center;">
    @include('layouts.loader')
</div>
<div id="layout-wrapper">
    @include('layouts.topbar')
    @include('layouts.sidebar')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer')
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="showCanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">More</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="body">
    </div>
</div>
<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body">
            </div>
        </div>
    </div>
</div>
<!-- JAVASCRIPT -->
@include('layouts.vendor-scripts')
</body>

</html>
