<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Economy Shuttle</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('/images/logo.ico') }}">
    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="{{ asset('/fontawesome-free/css/all.min.css') }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- app css --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{-- theme css --}}
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ mix('css/front.css') }}">

    <style scoped>
        .navbar-background{
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body>
    <div class="wrapper" id="app">
        <div id="global-loader"></div>

        @include('frontend.includes.navbar')

        @yield('frontend-content')

        @include('frontend.includes.footer')
    </div>

    {{-- app js --}}
    <script src="{{ mix('js/app.js') }}"></script>
    {{-- theme js --}}
    <script src="{{ mix('js/theme.js') }}"></script>
    {{-- custom js--}}
    <script src="{{ mix('js/admin.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyClBMaAaaRWoxV6N5jT1RfFdyeEUS0VhAE"></script>
</body>
</html>
