<!DOCTYPE html>
<html>
<title>@trans(optional($resource)->key? optional($resource)->key : '')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
    body { 
    }

    .pdf_image {
        width: 100%;
    }

    .pdf-data  {
        z-index: 5; 
    }

    .company_num {
        text-align: center;
    }
</style>
<body>

    <img src="{{ url('/pdf_image/tam.png') }}" class="pdf_image w3-display-topleft" alt="">

    <div class="pdf-data w3-display-topright company_num" style="top: 7.1cm;right: 5.6cm;" >
        @for ($index = 0; $index < strlen($resource->form('company_num')); $index ++)
            <div style="width: 0.4cm;float:left;text-align: center" >
                {{ $resource->form('company_num')[$index] }}
            </div>
        @endfor
    </div>
 
</body>

</html>
