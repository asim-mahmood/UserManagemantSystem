<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fiber Telecom</title>

    {{--Favicon--}}
    <link rel="icon" href="{{ asset('images/fiber_logo-updated.png') }}">
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

    <style scoped>
        .login-form-position {
            display: flex;
            justify-content: end !important;
            align-content: center !important;
            flex-wrap: wrap !important;
            height: 100vh;
            padding-right: 13rem !important
        }

        .image-logo-width {
            width: 18rem !important;
        }

        .fiber-logo-width {
            width: 9rem !important;
        }

        .login-box-msg {
            padding: 0 3px 20px;
        }

        .btn-login {
            background-color: #144a5b !important;
            border-color: #144a5b !important;
            color: #FFF
        }

        .admin-login {
            background-color: #144a5b !important;
            border-color: 1px solid #024154 !important;
            color: #ffffff;
            border-radius: 2rem !important;
            padding: 0.3rem 1rem !important;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;

        }

        .background-image {
            background-image: url('/images/image1.jpg');
            background-size: cover;
            /* This ensures that the background image covers the entire container */
            background-position: center;
            /* This centers the background image */
            background-repeat: no-repeat;
            position: relative;
        }

        .input-group input.form-control:focus {
            border-color: #7eb8f7;
        }

        .icon-size {
            font-size: 40px;
            color: rgba(0, 0, 0, 0.714);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.247), -1px -1px 2px rgba(255, 255, 255, 0.429);
        }

        .card-bg {
            background-color: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(2px);
        }

        .fiber-tel-nav {
            background-color: rgba(255, 255, 255, 0.526) !important;
            backdrop-filter: blur(2px) !important;
            /* position: absolute; */
            /* top: 0; */
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.551) 0px 3px 3px 0px !important;
        }
        @media  (max-width:630px){
            .login-form-position {
                display: flex;
                justify-content: center !important;
                align-content: center !important;
                flex-wrap: wrap !important;
                height: 100vh;
                padding-right: 2rem !important;
                padding-left: 2rem !important;
            }
            .image-logo-width {
                width: 12rem !important;
            }
        }
    </style>
</head>

<body class="hold-transition background-image">

    <div class="fiber-tel-nav ">
        <nav class="navbar justify-content-between">
            <div class="">
                <img src="images/fiber_logo-updated.png" alt="Flag" class="fiber-logo-width">
            </div>
            <a href="/admin" class="btn btn-info admin-login btn-sm" type="submit">Admin Login</a>
        </nav>
    </div>
    <div class="login-form-position">
        <div class="card-bg border-0 rounded shadow">
            <div class="p-4">
                <div class="text-center pt-3 pb-4 border-bottom border-light">
                    <img src="images/fiber_logo-updated.png" alt="Flag" class="image-logo-width">
                </div>
                <div class="text-center pt-4 pb-1">
                    <i class="fa-solid fa-user-tie icon-size"></i>
                </div>
                <div class="">
                    <h4 class="login-box-msg mb-0">Employee Login</h4>
                </div>
                <form role="form" method="POST" action="{{ route('employee-login') }}">
                    @csrf
                    <label>Login</label>
                    <div class="input-group mb-4">
                        <input type="email" class="form-control" placeholder="User" name="email" autofocus tabindex="1">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>
                        </div>
                    </div>
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="password" tabindex="2">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if($errors->all())
                    <div class="input-group" style="font-size: 1rem;">
                        <p class="text-danger isInvalid">{{$errors->first()}}</p>
                    </div>
                    @endif
                    <div class="form-check mb-4 mt-2">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                    <div class="border-top pt-3 text-right ">
                        <button type="submit" class="btn btn-login btn-flat px-4">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>