<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>TamUser</title>

    @include('taqneen.customer_forms.pdf.common_style')

<body>
    <img style="height:  26.458333333cm;" src="{{ url('/assets/images/muqeem-pdf/page.png') }}"
        class="pdf_image w3-display-topleft" alt="">

    <!-- /////////////////////////////////////////////////////////////////// -->

    <div class="pdf-data w3-display-topright company_num" style="top: 6.48cm;right: 6cm;">
        <div style="float:left;text-align: center">
            @for ($i = 0; $i < strlen($data->company_num); $i++)
                <span style="float: left;width: 0.45cm;font-size: 15px">
                    {{ substr($data->company_num, $i, 1) }}
                </span>
            @endfor
        </div>
    </div>

    <div class="pdf-data w3-display-topright w3-center" style="top: 7.51cm;right: 6.2cm;">
        <b>{{ $data->name_ar }}</b>
    </div>

    <!-- /////////////////معلومات المستخدم الرئيسى//////////////////////// -->

    <div class="pdf-data w3-display-topright w3-center" style="top: 9.83cm;right: 1.17cm;">
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    {{-- <div  class="pdf-data w3-display-topright w3-center" style="top: 10.60cm;right: 2.35cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.60cm;right: 3.55cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div> --}}

    <div class="pdf-data w3-display-topright w3-center" style="top: 9.83cm;right: 5.0cm;">
        <b>{{ $data->user_name }}</b>
    </div>

    <div class="pdf-data w3-display-topright " style="top: 9.83cm;right: 7.93cm;">
        <div style="float:left;text-align: center">
            @for ($i = 0; $i < strlen($data->user_identifi); $i++)
                <span style="float: left;width: 0.48cm;font-size: 15px">
                    {{ substr($data->user_identifi, $i, 1) }}
                </span>
            @endfor
        </div>
    </div>

    <div class="pdf-data w3-display-topright w3-center" style="top: 9.83cm;right: 13.0cm;">
        <b>{{ $data->user_phone }}</b>
    </div>

    <div class="pdf-data w3-display-topright w3-center" style="top: 9.83cm;right: 15.8cm;font-size: 12px;">
        <b>{{ $data->user_email }}</b>
    </div>

    {{-- /////////////////////// معلومات المستخدم المطلوب حذفه ////////////////////////// --}}
    <div class="pdf-data w3-display-topright w3-center" style="top: 10.48cm;right: 3.62cm;">
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    <div class="pdf-data w3-display-topright w3-center" style="top: 10.50cm;right: 5.0cm;">
        <b>{{ $data->user_name_delete }}</b>
    </div>

    <div class="pdf-data w3-display-topright " style="top: 10.50cm;right: 7.95cm;">
        <div style="float:left;text-align: center">
            @for ($i = 0; $i < strlen($data->user_identifi_delete); $i++)
                <span style="float: left;width: 0.47cm;font-size: 15px">
                    {{ substr($data->user_identifi_delete, $i, 1) }}
                </span>
            @endfor
        </div>
    </div>
    <!-- ////////////////////////معلومات المستخدمين الاخرين////////////////////////////// -->

    @php
        $top1 = 12.52;
        $top2 = 12.52;
    @endphp

    @foreach ($data->other_user_name as $user_name)
        <div class="pdf-data w3-display-topright w3-center" style="top: {{ $top1 }}cm;right: 3.26cm;">
            <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt=""
                style="width: 7px;">
        </div>
        <div class="pdf-data w3-display-topright w3-center" style="top: {{ $top1 }}cm;right: 4.44cm;">
            <b>{{ $user_name }}</b>
        </div>
        @php
            $top1 += 0.6;
        @endphp
    @endforeach

    @foreach ($data->other_user_identifi as $user_identifi)
        <div class="pdf-data w3-display-topright company_num" style="top: {{ $top2 }}cm;right: 7.1cm;">
            <div style="float:left;text-align: center">
                @for ($i = 0; $i < strlen($user_identifi); $i++)
                    <span style="float: left;width: 0.47cm;font-size: 15px">
                        {{ substr($user_identifi, $i, 1) }}
                    </span>
                @endfor
            </div>
        </div>
        @php
            $top2 += 0.6;
        @endphp
    @endforeach


    {{-- <div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 11.63cm;" >
    <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
</div>

<div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 12.66cm;" >
    <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
</div>

<div  class="pdf-data w3-display-topright w3-center" style="top: 13.5cm;right: 14.0cm;font-size: 11px;" >
    <b>your Data</b>
</div>

<div  class="pdf-data w3-display-topright w3-center" style="top: 13.5cm;right: 15.7cm;font-size: 11px;" >
    <b>your Data</b>
</div> --}}


    <!-- //////////////////////////////الاسم والمنصب/////////////////////////////////// -->

    <div class="pdf-data w3-display-topright w3-center" style="top: 19.3cm;right: 2.85cm;">
        <b>{{ $data->applicant_name }}</b>
    </div>

    <div class="pdf-data w3-display-topright w3-center " style="top: 19.3cm;right: 12.11cm;">
        <b>{{ $data->position }}</b>
    </div>


</body>

</html>
 