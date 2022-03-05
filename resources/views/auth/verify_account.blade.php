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
  
            <div class="row step step1">

                <div class="col-12">
                    <div class="panel radio-toolbar w3-padding modal-lg" style="max-width: 400px;">
                        <img src="{{ url('/images/email_sent.jpg') }}" style="width: 50%;margin: auto;" alt="">
                        <br>
                        <h4>@trans('Check your email')</h4>
                        <p>
                            {!! str_replace("{email}", "<b>".request()->email."</b>", __('We sent an email to {email} Inside you’ll find a link you need to click to verify your email. This lets us verify it’s really you who’s requesting the free trial!')) !!}
                        </p>
                        <br>
                        <p>
                            {{ __('If you didn’t get the email, we can send it again.') }} <a onclick="verifyEmail('{{ request()->email }}')" href="#">{{ __('try again') }}</a>
                        </p>
                    </div>
            
                </div>
            
            </div>
            </div>
            
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

        function verifyEmail(email) {
            var data = {
                email: email,
                _token: '{{ csrf_token() }}'
            };

            $.post("{{ route('business.postverfiy') }}", $.param(data), function(r){
                if (r.success == 1) {
                    toastr.success(r.msg);
                } else {
                    toastr.error(r.msg);
                }
            });
        }
    </script>


    <script>
         
    </script>

    <script>
         
    </script>
</body>

</html>
