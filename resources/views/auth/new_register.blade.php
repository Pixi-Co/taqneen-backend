<!DOCTYPE html>
<html>
@php
$config_languages = config('constants.langs');
$languages = [];
foreach ($config_languages as $key => $value) {
    $languages[$key] = $value['full_name'];
}
@endphp

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- fav Icon -->
    <link rel="shortcut icon" href="images/favicon.png" title="Favicon" sizes="16x16" />
    <!--With LTR -->

    <title>register</title>

    @include("layouts.partials.css")
    @include("layouts.partials.new_css")

    <style>
        html,
        body,
        .currency_page {
            height: 100% !important;
            overflow: auto!important;
        }

        .step,
        .step-min {
            display: none;
        }

        .step1 {
            display: block
        }

        .step-min1 {
            display: block
        }

        .toast-success {
            background: #41bc85!important;
            color: white!important;
        }
    </style>
</head>

<body style=" background: linear-gradient(-45deg, #fff, #fff);">

    {!! Form::open(['url' => route('business.postRegister'), 'style' => 'height: 100%', 'id' => 'register_form']) !!}
    {!! Form::token() !!}

    <div class="currency_page business_types pb-5">
        <div class="container " style="margin-top: 0px">

            <input type="hidden" name="google_id" >
            <input type="hidden" name="package_id" class="package_id">

            <div class="row ">
                <img class=" currency_logo" style="width:200px;height: auto" src="images/logo2.png" alt="">
                {!! Form::open(['url' => '', 'method' => 'get', 'files' => true]) !!}
                <div class="dropdown lang btn m-8 btn-sm mt-10">
                    <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-expanded="true">
                        <span class="-flag-{{ request()->language ? request()->language : 'en' }}"></span>
                        {{ $languages[request()->language ? request()->language : 'en'] }}
                    </a>
                    <div class="dropdown-menu new-shadow lang-dropdown" aria-labelledby="dropdownMenuLink"
                        x-placement="bottom-start"
                        style="height: 100px;display: hidden; position: absolute; will-change: transform; top: 10px; left: 0px; transform: translate3d(10px, 22px, 0px);">

                        <input type="hidden" name="is_header" value="1">
                        <input type="hidden" name="language" id="selectedLang">
                        @foreach ($languages as $key => $value)
                            @if (in_array($key, ['ar', 'en']))
                                <a class="dropdown-item" href="?language={{ $key }}"
                                    onclick="$('#selectedLang').val('{{ $key }}');$('#edit_user_profile_form')[0].submit()">
                                    <span class="-flag-{{ $key }}"></span>

                                    {{ $value }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            @include('auth.register.step3')

            @include('auth.register.step1')

            @include('auth.register.step2')

            @include('auth.register.step4')
        </div>
    </div>


    {!! Form::close() !!}

    @include('layouts.partials.javascripts')

    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>

    <script>
        // activate Icheck 
        $('input[type=checkbox]').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        $('.business-check').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        $('.business-check').on('ifChecked', function(event) {
            console.log(event);
            $('.autoUpdate').slideUp(300);
            $(event.target).parent().parent().find('.autoUpdate').slideDown(300);

            $('.businesstype_id').val($(this).attr('data-id'));
            // 
        });
    </script>


    <script>
        function validateOnStep1Old() {
            if (
                !$('input[name=name]').val() ||
                !$('input[name=surname]').val() ||
                !$('input[name=first_name]').val() ||
                !$('input[name=last_name]').val() ||
                !$('input[name=username]').val() ||
                !$('input[name=email]').val() ||
                !$('input[name=password]').val() ||
                !$('input[name=confirm_password]').val()
            ) {
                return false;
            }

            return true;
        }

        function validateOnStep2() {
            if (!$('input[name=currency_id]').val()) {
                return false;
            }

            return true;
        }

        function validateOnStep3() {
            if (!$('.businesstype_id').val()) {
                return false;
            }

            return true;
        }

        function validateOnStep1() {
            if (!document.email_valid) {
              toastr.error("@trans('email not valid')");
              return false;
            }

            if (!validatePassword()) {
                return false;
            }

            return true;
        }

        function gotoStep(step) { 

            if (step == 2) {
                if (!validateOnStep1()) {
                    return false;
                }
            } 

            if (step == 3) {
                if (!validateOnStep2()) {
                    return toastr.error("@trans('choose the currency')");
                }
            }

            if (step == 4) {
                if (!validateOnStep3()) {
                    return toastr.error("@trans('choose your business type')");
                }

                showBusinessType($('.businesstype_id').val()); 
            }


            $('.step').slideUp(300);
            $('.step' + step).slideDown(300);
        }

        function validateStepMin1() {
          if (
            !$('.name').val() &&
            !$('.first_name').val() ||
            !$('.last_name').val()  
            ) 
            return false;
          else 
            return true;
        }

        function gotoStepMin(step) {
            if (step == 2) {
              if (!validateStepMin1()) {
                return toastr.error("@trans('Enter name, First name and Last name')");
              }
            }

            if (step == 2)
              generateUsername();

            $('.step-min').slideUp(300);
            $('.step-min' + step).slideDown(300);
        }

        function showBusinessType(id) { 
            console.log("business id", id);
            $('.business-type').slideUp();
            $('.business-type-' + id).slideDown();
        }

        function choosePackage(package) {
            $('.package_id').val(package);
            $('.btn-package').removeClass('w3-green');
            $('.btn-package').addClass('btn-default');
            $('.btn-package-' + package).removeClass('btn-default');
            $('.btn-package-' + package).addClass('w3-green');
        }

        function generatePassword() {
            var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            var string_length = 10;
            var randomstring = '';
            for (var i = 0; i < string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum, rnum + 1);
            }
            randomstring = randomstring.toLowerCase();

            if (confirm('@trans("generated password is : ")' + randomstring)) { 

                $('.password').val(randomstring);
                $('.confirm_password').val(randomstring);
    
                return randomstring;
            }

            return randomstring;
        }

        function generateUsername() {
          $.get('{{ url("/api/generate-username") }}', function(id){
            var username = $('.first_name').val().toLowerCase() + "_" + $('.last_name').val().toLowerCase() + "_" + id;
            $('.username').val(username);
          }); 
        }

        function validateEmail() {
          var email = $('.email').val();
          var data = {
            email: email
          };
          $.post('{{ url("/api/validate-email") }}', $.param(data), function(valid){
            if (valid == 1) {
              document.email_valid = false;
              $('.email-validation')[0].className = 'email-validation w3-text-red';
              $('.email-validation').text('@trans("email not valid")');
            } else {
              document.email_valid = true;
              $('.email-validation')[0].className = 'email-validation w3-text-green';
              $('.email-validation').text('@trans("email is valid")');
            }
          });
        }

        function validatePassword() {
          var password = $('.password').val();
          var cpassword = $('.confirm_password').val();

          if (password.length < 8) {
            toastr.error("@trans('password must be at least 8 characters')");
            return false;
          } 

          if (password != cpassword) {
            toastr.error("@trans('passwords not matchs')");
            return false;
          } 

          return true;
        }

        function loadGoogleSignIfExists() {
            var googleProfile = JSON.parse(localStorage.getItem('vaux_google_profile'));

            console.log("googleProfile", googleProfile);

            if (googleProfile) {
                $("input[name=google_id]").val(googleProfile.id);
                $("input[name=first_name]").val(googleProfile.first_name);
                $("input[name=last_name]").val(googleProfile.last_name);
                $("input[name=email]").val(googleProfile.email);

                $("input[name=email]").attr('readonly', 'readonly');
                generateUsername();
                validateEmail();
                //
                localStorage.removeItem('vaux_google_profile');
            }
        }
 

        $('input[name=currency_id]').val('');
        loadGoogleSignIfExists();
        
    </script>

    <script>
        $('.slider').owlCarousel({
            loop: true,
            rtl: false,
            margin: 10,
            center: false,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

    </script>
</body>

</html>
