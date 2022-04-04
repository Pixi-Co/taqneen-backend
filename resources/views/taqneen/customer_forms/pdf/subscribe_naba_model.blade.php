<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    @include('taqneen.customer_forms.pdf.common_style')
<body>

    <!-- /////////////////////page 1////////////////////////////////////////////// -->

    <img style="height: 26.458333333cm;" src="{{ url('/assets/images/naba-pdf/page1.png') }}" class="pdf_image " alt="">
    
    @include("taqneen.customer_forms.pdf.pdf_viewer_component", ["data" => $data, "options" => $options])
    <!-- /////////////////////////////////////////////////////////////////// -->
    <img style="height: 1000px;" src="{{ url('assets/images/naba-pdf/page5.png') }}" class="pdf_image " alt="">
</body>
</html>
 
