<!doctype html>
<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendors Min CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/vendors.min.css')}}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/responsive.css')}}">

        <title>@yield('title','Dashboard')</title>

        <link rel="icon" type="image/png" href="{{asset('backend/assets/img/favicon.png')}}">
        @stack('css')
    </head>

    <body>

        <!-- Start Sidemenu Area -->
        @include('admin.helper.sidebar')
        <!-- End Sidemenu Area -->

        <!-- Start Main Content Wrapper Area -->
        <div class="main-content d-flex flex-column">

            <!-- Top Navbar Area -->
            @include('admin.helper.navbar')
            <!-- End Top Navbar Area -->

         @yield('content')

			<div class="flex-grow-1"></div>



        </div>
        <!-- End Main Content Wrapper Area -->


        <!-- Vendors Min JS -->
        <script src="{{asset('backend/assets/js/vendors.min.js')}}"></script>

        @stack('js')

        <!-- Custom JS -->
        <script src="{{asset('backend/assets/js/custom.js')}}"></script>
    </body>
</html>
