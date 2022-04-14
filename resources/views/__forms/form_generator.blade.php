<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 


<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
<!--
<link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.rtl.full.min.css')}}">
-->
<link rel='stylesheet' href='{{ url('/') }}/formiojs/formio.full.min.css'> 
<script src='{{ url('/') }}/formiojs/formio.full.min.js'></script>

 
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<style>
    body {
        background-color: #fafafa;
    }

    .pdf-viewer {
        width: 80%;
        height: 297mm;
        margin: auto;
        padding: 10px;
        /* 
        background-size: contain;
        background-repeat: no-repeat;*/
        position: relative;
    }

    @font-face {
        font-family: 'my_font';
        src: url('fonts\Tajawal-Regular.ttf') format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    *,
    h1,
    h2,
    h3,
    h4,
    h5,
    h5,
    h6 { 
    }

</style>
<style>
    #draggable {
        width: 150px;
        height: 150px;
        padding: 0.5em;
    }

</style>

<body>

    <br>
    <div style="width: 210mm;margin: auto">
        <label for="">key</label>
        <br>
        <select name="key" id="" class="w3-input">
            @foreach ($keys as $key)
                <option value="{{ $key }}" {{ request()->key == $key ? 'selected' : '' }}>
                    {{ $key }}
                </option>
            @endforeach
        </select>
        <br>
        <button class="w3-button w3-indigo">submit</button>
    </div>
    <br>

    <div class="pdf-viewer w3-card w3-white" id="viewer" >
 

    </div>
    <br>

    <div class="w3-container">

    </div> 
 

    <script>  

        $(document).ready(function() {
            //'{{ url("/forms?action=FORM-GENERATOR-API") }}'
            Formio.builder(document.getElementById('viewer'), {}, {});
        });
    </script>


</body>

</html>
