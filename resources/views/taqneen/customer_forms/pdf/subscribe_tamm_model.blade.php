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
    <img style="height: 26.458333333cm;" src="{{ url('/assets/images/tamm-pdf/page1.png') }}" class="pdf_image" alt="">
  
    <!-- ////////////////////////////////نوع الطلب/////////////////////////////////// -->
    @if ($data->choice_new == 'جديد')
    <div  class="pdf-data w3-display-topright w3-center" style="top: 2.4cm;right: 2.99cm;" >
       <img src="{{ url('/assets/images/tamm-pdf/check.png') }}" class="" alt="" style="width: 10px;">
    </div>
    @else
    <div  class="pdf-data w3-display-topright w3-center" style="top: 2.4cm;right: 4.69cm;" >
       <img src="{{ url('/assets/images/tamm-pdf/check.png') }}" class="" alt="" style="width: 10px;">
    </div>
    @endif

    <!-- //////////////////////////////بيانات المنشأة/////////////////////////////////// -->

    <!-- Row 1  -->
    <div class="pdf-data w3-display-topright company_num" style="top: 3.83cm;right: 4.49cm;" >
        <div style="direction: ltr;float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->company_num); $i ++)
            <span style="float: left;width: 0.62cm;font-size: 16px" >
                {{ substr($data->company_num, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>
    
    <!-- Row 2  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 4.75cm;right: 2.9cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 4.85cm;right: 12.9cm;" >
        <b></b>
    </div>

     <!-- Row 3  -->
     <div  class="pdf-data w3-display-topright w3-center" style="top: 4.91cm;right: 4.9cm;" >
        <b>{{ $data->name_ar }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 4.1cm;right: 13.5cm;" >
        <b></b>
    </div>

     <!-- Row 4  -->
     <div  class="pdf-data w3-display-topright w3-center" style="top: 5.5cm;right: 5cm;" >
        <b>{{ $data->name_en }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 5.9cm;right: 13.6cm;" >
        <b></b>
    </div>

     <!-- Row 5  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.16cm;right: 3.35cm;" >
       @if ($data->company_type == 'شركة')
       <img src="{{ url('/assets/images/tamm-pdf/check.png') }}" class="" alt="" style="width: 10px;">
       @endif
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.19cm;right: 5.4cm;" >
       @if ($data->company_type == 'مؤسسة')
       <img src="{{ url('/assets/images/tamm-pdf/check.png') }}" class="" alt="" style="width: 10px;">
       @endif
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 5.90cm;right: 12.8cm;" >
        <b>{{ $data->enterprise_activity }}</b>
    </div>

     <!-- Row 6  -->
     <div  class="pdf-data w3-display-topright w3-center" style="top: 6.51cm;right: 2.1cm;" >
        <b>{{ $data->city }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.1cm;right: 7.4cm;" >
        <b></b>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.1cm;right: 13.1cm;" >
        <b></b>
    </div>

    <!-- Row 7  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.15cm;right: 2.1cm;" >
        <b>{{ $data->mailbox }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.15cm;right: 8.1cm;" >
        <b>{{ $data->postcode }}</b>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.65cm;right: 15.2cm;" >
        <b></b>
    </div>

    <!-- Row 8  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.70cm;right: 2.5cm;" >
        <b>{{ $data->owner_name }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.70cm;right: 7.4cm;" >
        <b>{{ $data->owner_phone }}</b>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.70cm;right: 13.2cm;" >
        <b>{{ $data->owner_phone2 }}</b>
    </div>

    <!-- Row 9  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.8cm;right: 2.5cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.8cm;right: 7.4cm;" >
        <b></b>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.8cm;right: 13.2cm;" >
        <b></b>
    </div>

    <!-- Row 10  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.64cm;right: 3.7cm;" >
        <b>{{ $data->person_name }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.64cm;right: 7.4cm;" >
        <b>{{ $data->person_phone }}</b>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.4cm;right: 13.2cm;" >
        <b></b>
    </div>

     <!-- Row 11  -->
     <div  class="pdf-data w3-display-topright w3-center" style="top: 9.24cm;right: 5cm;" >
        <b>{{ $data->person_mail }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.24cm;right: 10.1cm;" >
        <b>{{ $data->phone_notfic }}</b>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.24cm;right: 15.9cm;" >
        <b>{{ $data->mail_notfic }}</b>
    </div>

     <!-- Row 12  -->
     <div  class="pdf-data w3-display-topright w3-center" style="top: 9.83cm;right: 3.38cm;" >
        <b>{{ $data->commercial_number }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="direction: ltr;top: 9.83cm;right: 9.48cm;" >
        <b>{{ $data->release_date }}</b>
    </div>
    
    <div  class="pdf-data w3-display-topright w3-center" style="direction: ltr;top: 9.83cm;right: 15.48cm;" >
        <b>{{ $data->end_date }}</b>
    </div>
   
    <!-- Row 13  -->
    
   <div  class="pdf-data w3-display-topright w3-center" style="top: 11.1cm;right: 5cm;" >
    <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.1cm;right: 13.6cm;" >
        <b></b>
    </div>

    <!-- ///////////////////////////التكلفة /////////////////////////////////// -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 12.65cm;right: 4.6cm;" >
        <b></b>
    </div>

    <!-- ///////////////////////////معلومات المستخدم الرئيسى /////////////////////////////////// -->
    <!-- Row 1  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.45cm;right: 5.5cm;" >
        <b>{{ $data->user_name_ar }}</b>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 13.55cm;right: 10.25cm;" >
        <div style="direction: ltr;float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->user_identifi); $i ++)
            <span style="float: left;width: 0.43cm;font-size: 16px" >
                {{ substr($data->user_identifi, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 13.52cm;right: 15.51cm;" >
        <div style="direction: ltr;float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->user_phone); $i ++)
            <span style="float: left;width: 0.41cm;font-size: 16px" >
                {{ substr($data->user_phone, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>

     <!-- Row 2  -->
     <div  class="pdf-data w3-display-topright w3-center" style="top: 15.15cm;right: 2.5cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.15cm;right: 9.0cm;" >
        <b>{{ $data->user_mail }}</b>
    </div>
    @if ($data->lang == 'العربية')
    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.19cm;right: 16.12cm;" >
    <img src="{{ url('/assets/images/tamm-pdf/check.png') }}" class="" alt="" style="width: 10px;">
    </div>

   @else
    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.19cm;right: 18.12cm;" >
        <img src="{{ url('/assets/images/tamm-pdf/check.png') }}" class="" alt="" style="width: 10px;">
    </div>
   @endif
    

    <!-- Row 3  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.75cm;right: 3cm;" >
        <b>{{ $data->user_name_ar }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.75cm;right: 12.4cm;" >
        <b>{{ $data->user_name_en }}</b>
    </div>

    <!-- /////////////////////////// اقرار و تعهد /////////////////////////////////// -->


    <div  class="pdf-data w3-display-topright w3-center" style="top: 17.69cm;right: 2.7cm;" >
        <b>{{ $data->applicant_name }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 17.69cm;right: 12.8cm;" >
        <b>{{ $data->position }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 18.4cm;right: 2.7cm;" >
        <b>{{ $data->identifi_number }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 18.4cm;right: 13cm;" >
        <b>{{ $data->applicant_phone }}</b>
    </div>
    <img style="height:26.458333333cm; " src="{{ url('/assets/images/tamm-pdf/page2.png') }}" class="pdf_image" alt="">

</body>
</html>
 