 <!DOCTYPE html>
 <html lang="ar" dir="rtl">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
     @include('taqneen.customer_forms.pdf.common_style')
 </head>
 <body style="background-image: url('{{ url('/assets/images/masarat-pdf/page.jpg') }}');background-size: cover;background-repeat: no-repeat" >
     
    <img  src="{{ url('/assets/images/masarat-pdf/page.jpg') }}"
        style="position: absolute;width: 100%;top: 0px;left: 0px;height: 26.458333333cm;" alt="">

     <!-- ////////////////////////////////بيانات المنشأة/////////////////////////////////// -->
     @foreach ($data as $key => $value)
         @php
             $opt = $options[$key] ?? [];
             $style = 'position: absolute;';
             
             $style .= isset($opt['left']) ? 'left:' . $opt['left'] . ';' : '';
             $style .= isset($opt['top']) ? 'top:' . $opt['top'] . ';' : '';
             $style .= isset($opt['fontSize']) ? 'font-size:' . $opt['fontSize'] . ';' : '';
             $style .= isset($opt['letterSpacing']) ? 'letter-spacing:' . $opt['letterSpacing'] . ';' : '';
             
         @endphp
         <div style="{{ $style }}" lang="ar" >
             {{ is_array($value) ? '' : $value }}
         </div>
     @endforeach

 </body>

 </html>
