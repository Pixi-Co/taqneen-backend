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

    <title>@trans('lang_v1.register') - {{ config('app.name', 'POS') }}</title>

    @include('layouts.partials.css')
    <link rel="stylesheet" href="{{ url('/css/w3.css') }}">
    <!-- ------- data table style -------------- -->
    <link rel="stylesheet" href="{{ asset('css/lib/datatables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-ltr.min.css') }}" />
    <link rel="stylesheet" href="{{ url('/icheck/skins/flat/green.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login_style_dark.css') }}">
    <link rel="stylesheet"
        href="https://colorlib.com/etc/bwiz/colorlib-wizard-6/fonts/material-design-iconic-font/css/material-design-iconic-font.css" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .toast { 
           background-color: indianred!important;
        }
    </style>
</head>

<?php
$busUtil = new App\Utils\BusinessUtil();
$currencies = $busUtil->allCurrencies();
?>

<body style=" background: linear-gradient(-45deg, #fff, #fff);!important;overflow: hidden">
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}"
            data-msg="{{ session('status.msg') }}">
    @endif

    <div class="login-form  login_page">
        <div class="container">

            {!! Form::open(['url' => route('business.postRegister')]) !!}
            {!! Form::token() !!}
            @php
                $username = old('username');
                $password = null;
                if (config('app.env') == 'demo') {
                    $username = 'admin';
                    $password = '123456';
                
                    $demo_types = [
                        'all_in_one' => 'admin',
                        'super_market' => 'admin',
                        'pharmacy' => 'admin-pharmacy',
                        'electronics' => 'admin-electronics',
                        'services' => 'admin-services',
                        'restaurant' => 'admin-restaurant',
                        'superadmin' => 'superadmin',
                        'woocommerce' => 'woocommerce_user',
                        'essentials' => 'admin-essentials',
                        'manufacturing' => 'manufacturer-demo',
                    ];
                
                    if (!empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types)) {
                        $username = $demo_types[$_GET['demo_type']];
                    }
                }
            @endphp
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="logo">
                        <img src="images/logo.png" alt="" />
                    </div>
                </div>
                <div class="col-md-6 animate__animated animate__fadeInLeft  ">
                    <div class="login_image ">
                        <img src="images/illustration.svg" />
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
                            @trans('lang_v1.register')
                        </h2>
                        <div class="row mb-4 px-3">
                            <button class="btn btn-lg btn-google btn-block text-uppercase " type="submit">
                                <img class="g-logo" src="images/icons/Google_logo.png" alt="Google Logo" />Sign in with
                                Google
                            </button>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div>
                            <small class="or text-center">Or</small>
                            <div class="line"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('name', 'Business Name:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Business name']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('start_date', 'Start Date:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('start_date', null, ['class' => 'form-control start-date-picker', 'placeholder' => 'Start Date', 'readonly']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('currency', 'Currency:') !!}
                                    <div class="input- "> 
                                        {!! Form::select('currency', $currencies, '', ['class' => 'form-control', 'placeholder' => 'Select Currency']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('country', 'Country:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('state', 'State:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'State']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('city', 'City:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('zip_code', 'Zip Code:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => 'Zip/Postal Code']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('landmark', 'Landmark:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('landmark', null, ['class' => 'form-control', 'placeholder' => 'Landmark']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr />
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('tax_label_1', 'Tax 1 Name:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('tax_label_1', null, ['class' => 'form-control', 'placeholder' => 'GST / VAT / Other']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('tax_number_1', 'Tax 1 No.:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('tax_number_1', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('tax_label_2', 'Tax 2 Name:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('tax_label_2', null, ['class' => 'form-control', 'placeholder' => 'GST / VAT / Other']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('tax_number_2', 'Tax 2 No.:') !!}
                                    <div class="input- "> 
                                        {!! Form::text('tax_number_2', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr />
                            </div>



                        <div class="row mb-3 px-3">
                            <div class="mr-2 ">
                                <button type="submit" class="btn btn-blue text-center ">
                                    @trans('lang_v1.register')
                                </button>
                            </div>
                            <div class="">
                                <a href="{{ url('/login') }}"  class="btn btn-blue register_btn text-center">
                                    @trans('lang_v1.login')
                                </a>
                            </div>
                        </div>
                        <div class="row px-3 mt-3">
                            <div class="col-12">
                                <div> By signin In, you agree to our</div>

                                <a class=" login_links" target="_blank"
                                    href="https://vauxerp.com/delivery-policy/">Terms and Conditions</a>
                                &amp;
                                <a class="login_links" target="_blank"
                                    href="https://vauxerp.com/privacy-policy/">Privacy Policy</a>
                            </div>
                        </div>
                        <div class=" mb-4 px-3 hidden">
                            <small class="font-weight-bold">Don t have an account?
                                <a class="text-danger ">Register</a>
                            </small>
                        </div>
                        <br>
                        <br>
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
            {!! Form::close() !!}
        </div>

    </div>


    @if (config('app.env') == 'demo')
        <div class="col-md-12 col-xs-12" style="padding-bottom: 30px;">
            @component('components.widget', [
                'class' => 'box-primary',
                'header' => '<h4 class="text-center">Demo Shops
                    <small><i> Demos are for example purpose only, this application <u>can be used in many other similar
                                businesses.</u></i></small>
                </h4>',
                ])

                <a href="?demo_type=all_in_one" class="btn btn-app bg-olive demo-login" data-toggle="tooltip"
                    title="Showcases all feature available in the application."
                    data-admin="{{ $demo_types['all_in_one'] }}">
                    <i class="fas fa-star"></i> All In One</a>

                <a href="?demo_type=pharmacy" class="btn bg-maroon btn-app demo-login" data-toggle="tooltip"
                    title="Shops with products having expiry dates." data-admin="{{ $demo_types['pharmacy'] }}"><i
                        class="fas fa-medkit"></i>Pharmacy</a>

                <a href="?demo_type=services" class="btn bg-orange btn-app demo-login" data-toggle="tooltip"
                    title="For all service providers like Web Development, Restaurants, Repairing, Plumber, Salons, Beauty Parlors etc."
                    data-admin="{{ $demo_types['services'] }}"><i class="fas fa-wrench"></i>Multi-Service Center</a>

                <a href="?demo_type=electronics" class="btn bg-purple btn-app demo-login" data-toggle="tooltip"
                    title="Products having IMEI or Serial number code." data-admin="{{ $demo_types['electronics'] }}"><i
                        class="fas fa-laptop"></i>Electronics & Mobile Shop</a>

                <a href="?demo_type=super_market" class="btn bg-navy btn-app demo-login" data-toggle="tooltip"
                    title="Super market & Similar kind of shops." data-admin="{{ $demo_types['super_market'] }}"><i
                        class="fas fa-shopping-cart"></i> Super Market</a>

                <a href="?demo_type=restaurant" class="btn bg-red btn-app demo-login" data-toggle="tooltip"
                    title="Restaurants, Salons and other similar kind of shops."
                    data-admin="{{ $demo_types['restaurant'] }}"><i class="fas fa-utensils"></i> Restaurant</a>
                <hr>

                <i class="icon fas fa-plug"></i> Premium optional modules:<br><br>

                <a href="?demo_type=superadmin" class="btn bg-red-active btn-app demo-login" data-toggle="tooltip"
                    title="SaaS & Superadmin extension Demo" data-admin="{{ $demo_types['superadmin'] }}"><i
                        class="fas fa-university"></i> SaaS / Superadmin</a>

                <a href="?demo_type=woocommerce" class="btn bg-woocommerce btn-app demo-login" data-toggle="tooltip"
                    title="WooCommerce demo user - Open web shop in minutes!!" style="color:white !important"
                    data-admin="{{ $demo_types['woocommerce'] }}"> <i class="fab fa-wordpress"></i> WooCommerce</a>

                <a href="?demo_type=essentials" class="btn bg-navy btn-app demo-login" data-toggle="tooltip"
                    title="Essentials & HRM (human resource management) Module Demo" style="color:white !important"
                    data-admin="{{ $demo_types['essentials'] }}">
                    <i class="fas fa-check-circle"></i>
                    Essentials & HRM</a>

                <a href="?demo_type=manufacturing" class="btn bg-orange btn-app demo-login" data-toggle="tooltip"
                    title="Manufacturing module demo" style="color:white !important"
                    data-admin="{{ $demo_types['manufacturing'] }}">
                    <i class="fas fa-industry"></i>
                    Manufacturing Module</a>

                <a href="?demo_type=superadmin" class="btn bg-maroon btn-app demo-login" data-toggle="tooltip"
                    title="Project module demo" style="color:white !important"
                    data-admin="{{ $demo_types['superadmin'] }}">
                    <i class="fas fa-project-diagram"></i>
                    Project Module</a>

                <a href="?demo_type=services" class="btn btn-app demo-login" data-toggle="tooltip"
                    title="Advance repair module demo" style="color:white !important; background-color: #bc8f8f"
                    data-admin="{{ $demo_types['services'] }}">
                    <i class="fas fa-wrench"></i>
                    Advance Repair Module</a>

                <a href="{{ url('docs') }}" target="_blank" class="btn btn-app" data-toggle="tooltip"
                    title="Advance repair module demo" style="color:white !important; background-color: #2dce89">
                    <i class="fas fa-network-wired"></i>
                    Connector Module / API Documentation</a>
            @endcomponent
        </div>
    @endif


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
