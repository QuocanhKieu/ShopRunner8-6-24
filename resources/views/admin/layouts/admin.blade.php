<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href={{asset("front/img/mini-logo-3.svg")}} type="image/x-icon">
    @yield('title')

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admins/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/bootstrap.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('admins/css/adminlte.min.css')}}">--}}

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admins/css/__cdn.jsdelivr.net_npm_alertifyjs@1.14.0_build_css_alertify.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/__cdn.jsdelivr.net_npm_alertifyjs@1.14.0_build_css_themes_bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/__cdn.jsdelivr.net_npm_alertifyjs@1.14.0_build_css_themes_default.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/__cdn.jsdelivr.net_npm_alertifyjs@1.14.0_build_css_themes_semantic.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/http_cdnjs.cloudflare.com_ajax_libs_dropzone_5.9.3_dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/adminlte.min.css')}}">


    {{--    <link rel="stylesheet" href="{{asset('admins/css/all.css')}}">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
{{--    dùng file fontawsome lỗi--}}

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .loginButton, .logoutButton {
            /*padding: 2px;*/
        }
        .nav-sidebar i {
            width: 20px;
            text-align: center;
        }
        /*html,.wrapper,.main-header {*/
        /*    width: 100vw ; !* This will make the table width equal to the maximum screen width *!*/
        /*    overflow-x: auto; !* This will show a horizontal scrollbar when the table width exceeds the screen width *!*/
        /*}*/
        th, td {
            text-align: center !important;
        }
    </style>
    @yield('this-css')
</head>
<div class="preloader flex-column justify-content-center align-items-center" style="">
    <img class="animation__shake" src={{asset("admins/DashboardAdminLte/dist/img/AdminLTELogo.png")}} alt="AdminLTELogo" height="60" width="60">
</div>
<body class="hold-transition sidebar-mini ">

<div class="wrapper">

    <!-- Navbar -->
    @include('admin.partials.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
{{--    @yield() là để chờ section--}}
{{--    @include() là lấy vào luôn--}}
    <!-- /.content-wrapper -->



    <!-- Control Sidebar -->
{{--    <aside class="control-sidebar control-sidebar-dark">--}}
{{--        <!-- Control sidebar content goes here -->--}}
{{--        <div class="p-3">--}}
{{--            <h5>Title</h5>--}}
{{--            <p>Sidebar content</p>--}}
{{--        </div>--}}
{{--    </aside>--}}
    <!-- /.control-sidebar -->



</div>
<!-- Main Footer -->
{{--@include('admin.partials.footer')--}}
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('admins/js/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admins/js/bootstrap.bundle.min.js')}}"></script>


<!-- AdminLTE App -->
<script src="{{asset('admins/js/adminlte.min.js')}}"></script>
<script src="{{asset('admins/js/__cdn.jsdelivr.net_npm_alertifyjs@1.14.0_build_alertify.js')}}"></script>
<script src="{{asset('admins/js/http_cdnjs.cloudflare.com_ajax_libs_dropzone_5.9.3_dropzone.js')}}"></script>
@yield('this-js')
@if (session('error'))
    <script>
        // Show alert with the error message after a delay
        setTimeout(function() {
            alertify.alert('Error', "{{ session('error') }}");
        }, 800); // 2000 milliseconds = 2 seconds
    </script>
@endif
@if (session('success'))
    <script>
        // Show alert with the success message after a delay
        setTimeout(function() {
            alertify.alert('Success', "{{ session('success') }}");
        }, 800); // 2000 milliseconds = 2 seconds
    </script>
@endif

<script>
    setTimeout(function () {
        var $preloader = $('.preloader');

        if ($preloader) {
            $preloader.css('height', 0);
            setTimeout(function () {
                $preloader.children().hide();
            }, 200);
        }
    }, 200);
</script>
</body>
</html>
