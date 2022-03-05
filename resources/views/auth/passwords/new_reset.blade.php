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

    <title>__('lang_v1.reset_password') - {{ config('app.name', 'POS') }}</title> 

    @include("layouts.partials.css")
    @include("layouts.partials.new_css")
    <link rel="stylesheet" href="{{  url('/css/w3.css')  }}">
    <!-- ------- data table style -------------- --> 
    <link rel="stylesheet" href="{{  url('/icheck/skins/flat/green.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/login_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login_style_dark.css') }}">
    <link
      rel="stylesheet"
      href="https://colorlib.com/etc/bwiz/colorlib-wizard-6/fonts/material-design-iconic-font/css/material-design-iconic-font.css"
    />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    @if(in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ||
    request()->language == 'ar')
    <link rel="stylesheet" href="{{ url('/css/custom_rtl.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap.rtl.full.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/rtl.css') }}">
    <style>
        .search-section.search-dropdown-top {
            right: inherit !important;
            left: 0px !important;
        }

        .login_page {
            background-image: url('/images/login_bg2_rtl.png')!important;
            background-position: right!important;
        }

    </style>
    @endif

</head>

<body  style=" background: linear-gradient(-45deg, #fff, #fff);!important" >
    @inject('request', 'Illuminate\Http\Request')
    @if (session('status'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
    @endif
  
    <div class="login-form  login_page">
        <div class="container">
            <div class="login-form col-md-12 col-xs-12 right-col-content">
                <form method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
            
                        <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="@trans('lang_v1.email_address')">
                        <span class="fa fa-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password"
                         required placeholder="@trans('lang_v1.password')">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password_confirmation" required placeholder="@trans('business.confirm_password')">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@trans('lang_v1.reset_password')</button>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
            
    </div>
 
    
    @include('layouts.partials.javascripts')
    
    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
      
    <script type="text/javascript">
        $(document).ready(function(){
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

            $('a.demo-login').click(function(e) {
                e.preventDefault();
                $('#username').val($(this).data('admin'));
                $('#password').val("{{ $password }}");
                $('form#login-form').submit();
            });
        })
    </script>
</body>

</html>
 
