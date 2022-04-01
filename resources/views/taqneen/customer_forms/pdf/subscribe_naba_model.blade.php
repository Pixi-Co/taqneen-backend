<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>NabaUser</title>
    @include('taqneen.customer_forms.pdf.common_style')
<body>

    <!-- /////////////////////page 1////////////////////////////////////////////// -->

    <img style="height: 26.458333333cm;" src="{{ url('/assets/images/naba-pdf/page1.png') }}" class="pdf_image " alt="">

    <!-- ////////////////////////////الباقة/////////////////////////////////////// -->
   @foreach ($data->portal_naba as $item)
   @if ($item == 'بوابةنبأ')
        <div  class="pdf-data w3-display-topright w3-center" style="top:3.02cm;right: 3.2cm;" >
            <img src="{{ url('assets/images/naba-pdf/check.png') }}" class="" alt="" style="width: 10px;">
        </div>
    @elseif ($item == 'نبأالمباشرة')
        <div  class="pdf-data w3-display-topright w3-center" style="top: 3.02cm;right: 5.1cm;" >
            <img src="{{ url('assets/images/naba-pdf/check.png') }}" class="" alt="" style="width: 10px;">
        </div>
    @elseif($item == 'نبأالأساسية')
        <div  class="pdf-data w3-display-topright w3-center" style="top: 3.02cm;right: 7.2cm;" >
            <img src="{{ url('assets/images/naba-pdf/check.png') }}" class="" alt="" style="width: 10px;">
        </div>
    @endif
  
   @endforeach
         
    
   
    <!-- ////////////////////////////////بيانات المنشأة/////////////////////////////////// -->
    
    <!-- Row 1  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 4.49cm;right: 3.8cm;" >
        <b>{{ $data->name_ar }}</b>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 4.47cm;right: 13.8cm;" >
        <div style="float:left;text-align: center; direction: ltr;padding-top: 3px" >
            @for($i = 0; $i < strlen($data->pc_num); $i ++)
            <span style="float: left;width: 0.51cm;font-size: 15px" >
                {{ substr($data->pc_num, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>

    <!-- Row 2  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 5.01cm;right: 3.8cm;" >
        <b>{{ $data->name_en }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top:5.1cm;right: 12.6cm;" >
        <b>{{ $data->owner_name }}</b>
    </div>

    <!-- Row 3  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 5.53cm;right: 2.8cm;" >
        <b>{{ $data->city }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 5.53cm;right: 12.55cm;" >
        <b>{{ $data->owner_phone }}</b>
    </div>

    <!-- Row 4  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top:6.13cm;right: 4.5cm;" >
        <b>{{ $data->company_website }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.08cm;right: 13.8cm;" >
        <div style="float:left;text-align: center;direction: ltr" >
            @for($i = 0; $i < strlen($data->commercial_number); $i ++)
            <span style="float: left;width: 0.51cm;font-size: 15px" >
                {{ substr($data->commercial_number, $i, 1) }}
            </span>
            @endfor 
            {{-- <h2>{{trim(chunk_split($data->commercial_number, 1, ' '))  }}</h2> --}}
        </div>
    </div>

    <!-- Row 5  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.58cm;right: 3.8cm;" >
        <b>{{ $data->company_email }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 6.58cm;right: 14.25cm;" >
        <div style="direction: ltr;text-align: centerdirection: ltr" >
            <h3>{{ $data->end_date}}</h3>
        </div>
    </div>

    <!-- Row 6  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.56cm;right: 4.7cm;" >
        <b>{{ $data->building_num }}</b>
    </div>
    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.56cm;right: 6.8cm;" >
        <p>{{ $data->street }}</p>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.56cm;right: 9.3cm;" >
        <b>{{ $data->district }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.56cm;right: 11.78cm;" >
        <b>{{ $data->city }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.56cm;right: 14.48cm;" >
        <b>{{ $data->postal_code }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 7.11cm;right: 16.5cm;" >
        <b></b>
    </div>
    

    <!-- ///////////////////////////////////معلومات مدير المنشأة//////////////////////////////// -->
    <!-- Row 1  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 8.58cm;right: 3.5cm;" >
        <b>{{ $data->leader_name }}</b>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 8.58cm;right: 11.1cm; direction:ltr">
        <div style="float:left;text-align: center" >
            @for($i = 0; $i < strlen($data->leader_idenitiy); $i ++)
            <span style="float: left;width: 0.78cm;font-size: 16px" >
                {{ substr($data->leader_idenitiy, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>

    <!-- Row 2  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top:9.15cm;right: 4.2cm;" >
        <b>{{ $data->leader_phone }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.15cm;right: 10.7cm;" >
        <b>{{ $data->leader_phone2 }}</b>
    </div>

    <!-- Row 3  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 9.72cm;right: 3.66cm;" >
        <b>{{ $data->leader_email }}</b>
    </div>

    
    <!-- ///////////////////////////////////معلوات الاتصال الرئيسية//////////////////////////////// -->

    <!-- Row 1  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 10.83cm;right: 3.5cm;" >
        <b>{{ $data->user_name }}</b>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 10.83cm;right: 10.98cm;" >
        <div style="float:left;text-align: center;direction: ltr;" >
            @for($i = 0; $i < strlen($data->user_idenitiy); $i ++)
            <span style="float: left;width: 0.78cm;font-size: 16px" >
                {{ substr($data->user_idenitiy, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>

    <!-- Row 2  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.39cm;right: 4.2cm;" >
        <b>{{ $data->user_phone }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.39cm;right: 10.7cm;" >
        <b>{{ $data->user_phone2 }}</b>
    </div>

    <!-- Row 3  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 11.99cm;right: 3.69cm;" >
        <b>{{ $data->user_email }}</b>
    </div>

    <!-- ///////////////////////////////معلومات ممثلي المشترك//////////////////////////////////// -->

    <!-- Row 1  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 13.55cm;right: 3.5cm;" >
        <b>{{ $data->sub_represent_name }}</b>
    </div>

    <div class="pdf-data w3-display-topright company_num" style="top: 13.55cm;right: 12.0cm;" >
        <div style="float:left;text-align: center;direction: ltr" >
            @for($i = 0; $i < strlen($data->sub_represent_idenitiy); $i ++)
            <span style="float: left;width: 0.6cm;font-size: 16px" >
                {{ substr($data->sub_represent_idenitiy, $i, 1) }}
            </span>
            @endfor 
        </div>
    </div>

    <!-- Row 2  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.05cm;right: 4.2cm;" >
        <b>{{ $data->sub_represent_phone }}</b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.05cm;right: 12.42cm;" >
        <b>{{ $data->sub_represent_phone2 }}</b>
    </div>

    <!-- Row 3  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 14.45cm;right: 3.6cm;" >
        <b>{{ $data->sub_represent_email }}</b>
    </div>

    <!-- //////////////////////////////المدة///////////////////////////////////// -->

    <!-- Row 1  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 15.72cm;right: 8.0cm;" >
        <b>{{ $data->sub_type }}</b>
    </div>

    <!-- Row 2  -->
    <div  class="pdf-data w3-display-topright w3-center" style="top: 16.19cm;right: 4.5cm;" >
        <b>{{ $data->cost_data }}</b>
    </div>
   
    <!-- //////////////////////////الشروط والاحكام///////////////////////////////////////// -->

    <img style="height: 1000px;" src="{{ url('assets/images/naba-pdf/page2.png') }}" class="pdf_image " alt="">
    <img style="height: 1000px;" src="{{ url('assets/images/naba-pdf/page3.png') }}" class="pdf_image" alt="">
    <img style="height: 1000px;" src="{{ url('assets/images/naba-pdf/page4.png') }}" class="pdf_image " alt="">

    <!-- /////////////////////////ملحق نموزج المفوضين////////////////////////////////////////// -->
    
    <div  class="pdf-data w3-display-topright w3-center" style="top: 118.35cm;right: 11.0cm;" >
        <b></b>
    </div>
   
    <div  class="pdf-data w3-display-topright w3-center" style="top: 125.50cm;right: 2.0cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 125.50cm;right: 5.3cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 125.50cm;right: 8.7cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 125.50cm;right: 11.8cm;" >
        <b></b>
    </div>

    <div  class="pdf-data w3-display-topright w3-center" style="top: 125.50cm;right: 15.7cm;" >
        <b></b>
    </div>
    <!-- /////////////////////////////////////////////////////////////////// -->
    <img style="height: 1000px;" src="{{ url('assets/images/naba-pdf/page5.png') }}" class="pdf_image " alt="">
</body>
</html>
 
