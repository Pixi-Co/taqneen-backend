<!DOCTYPE html>
<html>

<head> 
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    @if (isRtl())  
    <link rel="stylesheet" href="{{  url('/css/bootstrap.rtl.full.min.css')  }}">
    @endif
    <style>
        *, h1, h2, h3, h4, h5, h6 {
            font-family:  Arial, Helvetica, sans-serif;
        }

        .text-right  {
            text-align: right!important;
        }

        .text-left  {
            text-align: left!important;
        }
        .fa {
            min-width: 20px
        }

        .header-label {
            min-width: 60px
        }

        @if (isRtl())  
        *, h1, h2, h3, h4, h5, h6 {
            direction: rtl;
        }
        .text-right  {
            text-align: left!important;
        }

        .text-left  {
            text-align: right!important;
        }

        .w3-col {
            float: right!important;
        }
        @endif
    </style>
    @yield('css')

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ url('/qrcode/qrcode.min.js') }}"></script>
</head>

<body >

    @yield("content")

    <div class="w3-center">
        <b>copywrite @ vauxerp.com</b>
    </div>

    @yield('javascript')
    

<script> 

    $('.qrcode').each(function(){
        var self = this;
        var qrcode = new QRCode(self, {
            text: $(this).data('text'),
            width: $(this).data('width')? $(this).data('width') : 128,
            height: $(this).data('height')? $(this).data('height') : 128,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    });

    setTimeout(function(){
        window.print();
    }, 1000);
 
</script>

</body>

</html>
