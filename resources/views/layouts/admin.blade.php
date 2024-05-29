<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fiber Telecom</title>

    {{--Favicon--}}
    <link rel="icon" href="{{ asset('/images/fiber_logo-updated.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!--google icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css')}}">
    {{-- Theme css --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/theme.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css')}}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{-- <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    <script src="https://kit.fontawesome.com/1d3f86284c.js" crossorigin="anonymous"></script>
</head>
   
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm sidebar-closed sidebar-collapse">
    <div class="wrapper" id="app">
        <div id="global-loader"></div>

        @include('admin.includes.sidebar')
        @include('admin.includes.navbar')

        @yield('admin-content')


        {{-- <div id="sidebar-overlay"></div> --}}
    </div>

    {{-- App js --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- jQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- Theme js --}}
    {{-- <script src="{{ mix('js/theme.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>
    {{-- custom js--}}
    <script src="{{asset('js/custom.js')}}"></script>
</body>

</html>