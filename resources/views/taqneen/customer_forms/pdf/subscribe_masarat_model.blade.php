<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>TamUser</title>
    @include('taqneen.customer_forms.pdf.common_style')
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
    <style>
        body {
            background-color: #fafafa;
        }
    
        .pdf-viewer {
            width: 210mm;
            height: 297mm;
            margin: auto;
            background-image: url('{{ url('/assets/images/masarat-pdf/page.jpg') }}');
            background-size: contain;
            background-repeat: no-repeat;
            position: relative;
        }
    
    </style>
</head>
<body _style="background-image: url('{{ url('/assets/images/masarat-pdf/page.jpg') }}');background-size: cover;background-repeat: no-repeat;" >
    <br>

    <div class="pdf-viewer w3-card w3-white" id="page" >
        @foreach ($data as $key => $value)
        @php
            $opt = $options[$key]?? []; 
            $style = "position: fixed;";
    
            $style .= isset($opt['left'])? "left:" . $opt['left'] . ";" : ''; 
            $style .= isset($opt['top'])? "top:" . $opt['top'] . ";" : ''; 
            $style .= isset($opt['fontSize'])? "font-size:" . $opt['fontSize'] . ";" : ''; 
            $style .= isset($opt['letterSpacing'])? "letter-spacing:" . $opt['letterSpacing'] . ";" : ''; 
     
        @endphp
        <div style="{{ $style }}" >
            {{ is_array($value)? '' : $value }}
        </div>
        @endforeach
    </div>
    <br>
  
    
 
    <script>
        function generatePDF() {
            var doc = new jsPDF();
             doc.fromHTML(document.getElementById("page"), // page element which you want to print as PDF
             15,
             15, 
             {
               'width': 170
             },
             function(a) 
              {
               doc.save("HTML2PDF.pdf");
             });
           }


        window.onload = function(){
            generatePDF();
        }
    </script>
      
</body>
</html>
 
