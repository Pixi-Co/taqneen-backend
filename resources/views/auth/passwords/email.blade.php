<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('lang_v1.reset_password') }} - {{ config('app.name', 'POS') }}</title>

    @include('layouts.partials.css')
    <link rel="stylesheet" href="{{ url('/css/w3.css') }}">
    <!-- ------- data table style -------------- -->
    <link rel="stylesheet" href="{{ asset('/css/lib/datatables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-ltr.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/icheck/skins/flat/green.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom_css.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login_style_dark.css') }}">
    <link rel="stylesheet"
        href="https://colorlib.com/etc/bwiz/colorlib-wizard-6/fonts/material-design-iconic-font/css/material-design-iconic-font.css" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style=" background: linear-gradient(-45deg, #fff, #fff);!important">
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}"
            data-msg="{{ session('status.msg') }}">
    @endif

    <div class="login-form  login_page">
        <div class="container">

            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="logo">
                            <img src="{{ url('/images/logo.png') }}" alt="" />
                        </div>
                    </div>
                    <div class="col-md-6 animate__animated animate__fadeInLeft  ">
                        <div class="login_image ">
                            <img src="{{ url('/images/illustration.svg') }}" />
                            <div class="w3-text-white w3-xlarge">
                                A few more clicks to
                                <br />
                                sign in to your account.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 animate__animated animate__fadeInRight">
                        <div class="border-0 ">
                            <h2 class=" mb-3 w3-xxlarge"> 
                                @trans('lang_v1.reset_password')
                            </h2>  

                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autofocus
                                    placeholder="@trans('lang_v1.email_address')">
                                <span class="fa fa-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" 
                                style="width: 100%!important"
                                class="w3-round-xlarge btn  btn-blue w3-green btn-block  w3-block">
                                    @trans('lang_v1.send_password_reset_link')
                                </button>
                            </div>


                            <div class="row mb-3 px-3">
                                <div class="mr-2">
                                    <a type="submit" href="{{ url('/login') }}" class="btn btn-blue w3-green  text-center">
                                        @trans('lang_v1.login')
                                    </a>
                                </div> 
                            </div>
                            <div class="row px-3 mt-3">
                                <div class="col-12">
                                    <div> By signin In, you agree to our</div>

                                    <a class=" login_links" target="_blank" href="https://vauxerp.com/delivery-policy/">Terms and Conditions</a>
                                    &amp;
                                    <a class="login_links" target="_blank" href="https://vauxerp.com/privacy-policy/">Privacy Policy</a>
                                </div>
                            </div>
                            <div class=" mb-4 px-3 hidden">
                                <small class="font-weight-bold">Don t have an account?
                                    <a class="text-danger ">Register</a>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <div class="dark_btn">
                            <a href="#" onclick="changeTheme(this)" class="dark_light register_dark_btn">
                                <span id="dark_light_btn"><i class="fas fa-moon"></i> </span>
                            </a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


    @include('layouts.partials.javascripts')
    @include('layouts.partials.new_javascript')

    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2_register').select2();

            $('input[type=checkbox]').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green',
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#change_lang').change(function() {
                window.location = "{{ route('login') }}?lang=" + $(this).val();
            });


        })
    </script>
</body>

</html>
