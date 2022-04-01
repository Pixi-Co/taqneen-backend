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
    <img style="height: 26.458333333cm;" src="{{ url('/assets/images/muqeem-pdf/page.png') }}" class="pdf_image w3-display-topleft" alt="">
    
    <!-- /////////////////////////////////////////////////////////////////// -->

    <div class="pdf-data w3-display-topright company_num" style="top: 6.39cm;right: 6cm;" >
        <div style="float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->company_num); $i ++)
            <span style="float: left;width: 0.45cm;font-size: 15px" >
                {{ substr($data->company_num, $i, 1) }}
            </span>
            @endfor
        </div>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.46cm;right: 6.2cm;" >
        <b>{{ $data->name_ar }}</b>
    </div>

    <!-- /////////////////معلومات المستخدم الرئيسى//////////////////////// -->
   
    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.85cm;right: 1.17cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    {{-- <div  class="pdf-data w3-display-topright w3-center" style="top: 10.60cm;right: 2.35cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.60cm;right: 3.55cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div> --}}

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.85cm;right: 5.0cm;" >
        <b>{{ $data->user_name }}</b>
    </div>
  
    <div class="pdf-data w3-display-topright company_num" style="top: 9.85cm;right: 7.9cm;" >
        <div style="float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->id_number); $i ++)
            <span style="float: left;width: 0.48cm;font-size: 15px" >
                {{ substr($data->id_number, $i, 1) }}
            </span>
            @endfor
        </div>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.85cm;right: 13.0cm;" >
        <b>{{ $data->user_phone }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.85cm;right: 15.9cm;font-size: 12px;" >
        <b>{{ $data->user_mail }}</b>
    </div>

    <!-- ////////////////////////معلومات المستخدمين الاخرين////////////////////////////// -->

    {{-- <div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 1.17cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 2.23cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 3.26cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div> --}}

    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.4cm;right: 4.3cm;" >
        <b></b>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 13.5cm;right: 6.9cm;" >
        <div style="width: 0.4cm;float:left;text-align: center" >
            <p></p>
        </div>
    </div>
{{-- 
    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 11.63cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 12.66cm;" >
        <img src="{{ url('/assets/images/muqeem-pdf/check.png') }}" class="" alt="" style="width: 7px;">
    </div> --}}

    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.5cm;right: 14.0cm;font-size: 11px;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.5cm;right: 15.7cm;font-size: 11px;" >
        <b></b>
    </div>

    <!-- //////////////////////////////الاسم والمنصب/////////////////////////////////// -->

    <div  class="pdf-data w3-display-topright w3-center" style="top: 20.7cm;right: 2.7cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center " style="top: 20.7cm;right: 11.8cm;" >
        <b></b>
    </div>


</body>
</html>
