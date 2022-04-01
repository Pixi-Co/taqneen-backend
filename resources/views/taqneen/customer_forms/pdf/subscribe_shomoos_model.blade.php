<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>ShomoosUser</title>
    @include('taqneen.customer_forms.pdf.common_style')
<body>
    <img style="height: 26.458333333cm;" src="{{ url('/assets/images/shomoos-pdf/page.png') }}" class="pdf_image w3-display-topleft" alt="">

    <!-- /////////////////بيانات المنشاة  //////////////////////// -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 5.05cm;right: 4.5cm;" >
        <h5>{{ $data->company_name }}</h5>
    </div>

    <!-- row 2 -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 5.05cm;right: 16.4cm;" >
        <span>{{ $data->activity_type }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.15cm;right: 4.5cm;" >
        <h5>{{ $data->owner_name }}</h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.15cm;right: 11.2cm;" >
        <h5>{{ $data->owner_identifi }}</h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.15cm;right: 16.5cm;" >
        <h5>{{ $data->owner_phone }}</h5>
    </div>

   <!-- row 3 -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.85cm;right: 4.5cm;" >
        <h5>{{ $data->city }}</h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.85cm;right: 11.2cm;" >
        <h5>{{ $data->neighborhood_name }}</h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.85cm;right: 16.5cm;" >
        <span>{{ $data->street_name }}</span>
    </div>

    <!-- row 4 -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.65cm;right: 4.6cm;" >
        <p>{{ $data->addrees }}</p>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.65cm;right: 11.3cm;" >
        <p>{{ $data->enterprise_phone }}</p>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.65cm;right: 16.6cm;" >
        <h5>{{ $data->enterprise_fax }}</h5>
    </div>

    <!-- row 5 -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.50cm;right: 4.5cm;" >
        <span>{{ $data->enterprise_email }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.50cm;right: 11.6cm;" >
        <h5>{{ $data->mailbox }}</h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.50cm;right: 16.6cm;" >
        <h5>{{ $data->postcode }}</h5>
    </div>


    <!-- row 6 -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.5cm;right: 4.5cm;" >
        <h5></h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.9cm;right: 11cm;" >
        <h5></h5>
    </div>

    <!-- row 7 -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.1cm;right: 4.5cm;" >
        <h5>{{ $data->user_name }}</h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.1cm;right: 11.2cm;" >
        <h5>{{ $data->user_identifi }}</h5>
    </div>
   
     <!-- row 8 -->
     <div  class="pdf-data w3-display-topright w3-center" style="top: 10.9cm;right: 4.5cm;" >
        <span>{{ $data->user_email }}</span>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.91cm;right: 16.5cm;" >
        <h5>{{ $data->user_phone }}</h5>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.91cm;right: 11.4cm;" >
       @if ($data->id_type =='بطاقة')
       <img src="{{ url('/assets/images/shomoos-pdf/check.png') }}" class="" alt="" style="width: 7px;">
       @endif
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.91cm;right: 12.8cm;" >
       @if ($data->id_type == 'إقامة')
       <img src="{{ url('/assets/images/shomoos-pdf/check.png') }}" class="" alt="" style="width: 7px;">
       @endif
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 12.7cm;right: 14.9cm; direction: ltr" >
        <h3>{{ $data->subscription_date }}</h3>
    </div>
</body>
</html>
 