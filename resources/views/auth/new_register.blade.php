<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Cuba - Premium Admin Template - @yield('title')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    @yield('css')
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    @include("taqneen.layouts.css")
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style> 
        .login-card .login-main .theme-form label {
            font-size: 15px;
            letter-spacing: .4px;
        }
        .theme-form .checkbox label {
            padding-left: 10px;
        }
        .checkbox label {
            display: inline-block;
            position: relative;
            padding-left: 16px;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .login-card .login-main .theme-form .link {
            position: absolute;
            top: 10px;
            right: 0;
        }

        .form-group {
            position: relative;
        }

        .login-card {
            background-image: url('/images/taqneen_login.jpg')!important;
            background-size: cover;
        }

        *, h1, h2, h3, h4, h5, h6, label{
            font-family: 'Tajawal', sans-serif!important;
            direction: rtl;
            text-align: right!important;
        }
 
    </style>
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <form class="theme-" id="form" method="post" >
            @csrf
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-card">
                        <div>
                            <div>
                                <a class="logo text-center" href="{{ url('/login') }}" style="margin: auto" >
                                    <img class="img-fluid for-light" src="{{ asset('assets/images/logo/login.png') }}"
                                        alt="looginpage">
                                    <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                                        alt="looginpage">
                                    </a>
                                </div>
                                <br>
                            <div class="login-main">
                                <form class="theme-" id="form" method="post" >
                                    @csrf
                                    <h4>{{ __('create_account') }}</h4>
                                    <p>{{ __('enter_your_account_data') }}</p>
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('name') }}</label>
                                        <input class="form-control" type="text" required="" name="name"
                                            placeholder="{{ __('name') }}"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('pc_number') }}</label>
                                        <input class="form-control" type="text" required="" name="pc_number"
                                            placeholder="000000"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('Email') }}</label>
                                        <input class="form-control" type="email" required="" name="email"
                                            placeholder="Test@gmail.com"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('Password') }}</label>
                                        <input class="form-control password" type="password" name="password" required=""
                                            placeholder="">
                                        <strong class="text-danger" >{{ $errors->first('password') }}</strong>
                                        <div class="show-hide " style="left: 20px;right: inherit" onclick="$('.password').attr('type') == 'text'? $('.password').attr('type', 'password') : $('.password').attr('type', 'text')" >
                                            <span class="show"> </span>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0"> 
                                        <button class="btn btn-primary btn-block" type="submit">{{ __('create account') }}</button>
                                    </div> 
                                    <div class="social mt-4 hidden">
                                        
                                    </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    @yield('script')
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('/js/formajax.js') }}"></script>
    <!-- Plugin used-->

    @include("taqneen.layouts.script")

    <script>
        formAjax(true, function(){
            window.location = "{{ url('/login') }}";
        }, "#form");
    </script>    
</body>

</html>
