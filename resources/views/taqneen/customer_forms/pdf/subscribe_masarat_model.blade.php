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
    <img __style="height: 26.458333333cm" src="{{ url('/assets/images/masarat-pdf/page.jpg') }}" class="pdf_image w3-display-topleft"alt="">
    
    <!-- ////////////////////////////////بيانات المنشأة/////////////////////////////////// -->
    
    <!-- Row 1  -->
    <div class="pdf-data w3-display-topright company_num" style="top: 6.6cm;right: 0.9cm;" >
        <div style="float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->company_num); $i ++)
            <span style="float: left;width: 0.38cm;font-size: 15px" >
                {{ substr($data->company_num, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="direction: ltr; top: 6.6cm;right: 4.8cm;" >
        <span>{{ $data->release_date }}</span>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 6.6cm;right: 8.4cm;" >
        <div style="float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->commercial_number); $i ++)
            <span style="float: left;width: 0.38cm;font-size: 15px" >
                {{ substr($data->commercial_number, $i, 1) }}
            </span>
            @endfor
        </div>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="direction: ltr; top:6.6cm;right: 12.5cm;" >
        <span>{{ $data->end_date }}</span>
    </div>

     <!-- Row 2  -->
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.5cm;right: 1.1cm;" >
        <b>{{ $data->fullname_ar }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.5cm;right: 8.5cm;" >
        <b>{{ $data->fullname_en }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.5cm;right: 12.5cm;" >
        <b>{{ $data->name_ar }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.5cm;right: 15.5cm;" >
        <b>{{ $data->name_en }}</b>
    </div>

    <!-- ////////////////////////////عنوان المنشأة/////////////////////////////////// -->

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.4cm;right: 1.1cm;" >
        <span>{{ $data->city }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.4cm;right: 4.2cm;" >
        <span>{{ $data->mailbox }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.4cm;right: 7.2cm;" >
        <span>{{ $data->postcode }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.4cm;right: 9.99cm;" >
        <span>{{ $data->compony_phone }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.4cm;right: 12.99cm;" >
        <span>{{ $data->fax_num }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.4cm;right: 16cm;" >
        <span>{{ $data->company_website }}</span>
    </div>

    <!-- /////////////////////////معلومات مدير المنشأة/////////////////////////////////// -->

    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.46cm;right: 1.1cm;" >
        <span>{{ $data->owner_name }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.46cm;right: 4.85cm;" >
        <span>{{ $data->owner_number }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.46cm;right: 8.4cm;" >
        <span>{{ $data->owner_phone }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="font-size: 14px;top: 11.46cm;right: 11.75cm;" >
        <span >{{ $data->company_email }}</span >
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.46cm;right: 15.85cm;" >
        <span>{{ $data->identity }}</span>
    </div>

    <!-- //////////////////////بيانات المستخدم الرئيسي/////////////////////////////////// -->

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.43cm;right: 1.1cm;" >
        <span></span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.43cm;right: 4.71cm;" >
        <span></span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.43cm;right: 7.93cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.43cm;right: 11.76cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.43cm;right: 15.01cm;" >
        <b></b>
    </div>

    <!-- //////////////////////الخدمات ضمن مسارات/////////////////////////////////// -->
@foreach ($data->select_service as $item)
    @if ( $item == 'خدمة إدارة تأجير المركبات')
        <div  class="pdf-data w3-display-topright w3-center" style="top:14.59cm;right: .99cm;" >
            <img src="{{ url('/assets/images/masarat-pdf/check.png') }}" class="" alt="" style="width: 10px;">
        </div>
        @elseif ($item == 'خدمة إدارة الصيانة والتشغيل للمركبات')
        <div  class="pdf-data w3-display-topright w3-center" style="top: 15.1cm;right: .99cm;" >
            <img src="{{ url('/assets/images/masarat-pdf/check.png') }}" class="" alt="" style="width: 10px;">
        </div>
        @elseif( $item == 'خدمة تتبع المركبات شاملة إدارة الصيانة والتشغيل')
        <div  class="pdf-data w3-display-topright w3-center" style="top: 15.59cm;right: .99cm;" >
            <img src="{{ url('/assets/images/masarat-pdf/check.png') }}" class="" alt="" style="width: 10px;">
        </div>
    @endif

    
@endforeach
   
   
      
</body>
</html>
 
