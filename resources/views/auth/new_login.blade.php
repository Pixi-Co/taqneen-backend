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

    <script src="{{ url('/') }}/supportboard/js/min/jquery.min.js"></script>
    <script id="sbinit" src="{{  url('/')  }}/supportboard/js/main.js"></script> 
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
            background-image: url('{{ url('/images/taqneen_login.jpg') }}')!important;
            background-size: cover;
        }

        *, h1, h2, h3, h4, h5, h6, label{
            font-family: 'Tajawal', sans-serif!important;
            direction: rtl;
            text-align: right!important;
        }
 
    </style>
   
    <style>

    h1, h2, h3, h4, h5, h6, 
    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links li a span, 
    html[dir="rtl"] .page-wrapper.compact-wrapper .page-body-wrapper .sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-submenu>li a {
        font-family: 'Tajawal', sans-serif!important;
    }

    * {
        font-family: 'Tajawal', sans-serif;
    }
    .material-shadow {
        box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%)!important;
    }

    .modal-backdrop{ 
    }

    .customizer-links {
      /*  display: none!important;*/
    }

    #sidebar-menu {
        height: calc(100vh - 146px)!important;
    }

    button:not(:disabled), [type="button"]:not(:disabled), [type="reset"]:not(:disabled), [type="submit"]:not(:disabled),
    .btn-primary:hover, .btn-primary,
    .btn-check:checked+.btn-primary, .btn-check:active+.btn-primary, .btn-primary:active, .btn-primary.active, .show>.btn-primary.dropdown-toggle
     {
        background-color: #104470!important;
        border-color: #104470!important; 
        color: white;
    }

    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li:hover .sidebar-link:not(.active):hover span, .page-wrapper .page-body-wrapper .page-title .breadcrumb .breadcrumb-item a {
        color: #104470!important;
    }

    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li.sidebar-list:hover>a:hover {
        background-color: #10437057!important;
    }

    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.active span, 
    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.active svg, 
    .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content>li .sidebar-link.active .according-menu i {
        color: #104470!important;
    }

    .badge-secondary, .w3-deep-orange {
        background-color: #d35a25!important;
    }

    .customizer-links {
        display: none;
    }
</style>
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <form action="{{ url('/login') }}" method="post">
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
                                <form class="theme-form">
                                    <h4>{{ __('Sign in to account') }}</h4>
                                    <p>{{ __('Enter your email & password to login') }}</p>
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('Email Address Or Username') }}</label>
                                        <input class="form-control" type="text" required="" name="username"
                                            placeholder="Test@gmail.com">
                                        <strong class="text-danger">{{ $errors->first('username') }}</strong>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">{{ __('password_') }}</label>
                                        <input class="form-control password" type="password" name="password" required=""
                                            placeholder="">
                                        <strong class="text-danger" >{{ $errors->first('password') }}</strong>
                                        <div class="show-hide " style="left: 20px;right: inherit" onclick="$('.password').attr('type') == 'text'? $('.password').attr('type', 'password') : $('.password').attr('type', 'text')" >
                                            <span class="show"> </span>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <input id="checkbox1" type="checkbox">
                                            <label class="text-muted" for="checkbox1">{{ __('Remember password') }}</label>
                                        </div> 
                                        <button class="btn btn-primary btn-block" type="submit">{{ __('Sign in') }}</button>
                                        <a class="btn btn-primary btn-block" href="{{ url('/register') }}" type="submit">{{ __('sign_up') }}</a>
                                    </div> 
                                    <div class="social mt-4 hidden">
                                        
                                    </div>
    
                                </form>
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
    <!-- Plugin used-->
</body>

</html>
