<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<style>
    body {
        background-color: #fafafa;
    }

    .pdf-viewer {
        width: 210mm;
        height: 297mm;
        margin: auto;
        /*
        background-image: url('{{ optional($data)->image }}');
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
        font-family: 'Arial'!important;
        direction: rtl;
    }
</style>
<style>
    #draggable { width: 150px; height: 150px; padding: 0.5em; }
    </style>
<body>

    <br>
    <div style="width: 210mm;margin: auto" >  
        <form action="">
            <label for="">key</label>
            <br>
            <select name="key" id="" class="w3-input" >
                @foreach ($keys as $key => $value)
                <option value="{{ $key }}" {{ request()->key == $key? 'selected' : '' }} >{{ $key }}</option>
                @endforeach
            </select>
            <br>
            <button class="w3-button w3-indigo" >submit</button>
        </form>
    </div>
    <br>

    <div class="pdf-viewer w3-card w3-white">
 
        <img  src="{{ optional($data)->image }}"
        style="position: absolute;width: 100%;top: 0px;left: 0px;height: 26.458333333cm;" alt="">

        
    </div>
    <br>

    <div class="w3-container">

    </div>


    <script>
        var Pdf = {
            data: {},
            unit: 'px',
            createComponent: function(options={}){
                var self = this;
                var component = document.createElement('div');
                component.style.cursor = "move";
                component.style.position = "absolute";
                component.style.left = (options.left? options.left : 0) + this.unit;
                component.style.top = (options.top? options.top : 0) + this.unit;
                component.style.letterSpacing = (options.letterSpacing? options.letterSpacing : 0) + this.unit;
                component.style.fontSize = (options.fontSize? options.fontSize : 0) + this.unit;

                var key = options.key? options.key : '';
                var value = options.value? options.value : '';
                component.innerHTML = value;
                component.setAttribute('data-key', key);
                component.setAttribute('data-value', value);
                component.id = key;

                $('.pdf-viewer').append(component); 
                self.storeMoving(component);

                component.ondblclick = function() {
                    self.showOptionMenu(key);
                };

                $(component).draggable({
                    stop: function( event, ui ) { 
                        self.storeMoving(event.target);
                    }
                });
            },
            storeMoving: function(component){
                var key = $(component).attr('data-key');
                this.data[key] = {
                    top: component.style.top,
                    left: component.style.left,
                    fontSize: component.style.fontSize,
                    letterSpacing: component.style.letterSpacing,
                    dataValue: component.getAttribute('data-value'),
                };

                this.sync();
            },
            sync: function(){
                var params = {
                    _token: '{{ csrf_token() }}',
                    key: '{{ $setting->key }}',
                    data: JSON.stringify(this.data)
                };
                $.get("{{ url('/customer-pdf-viewer') }}", $.param(params), function(){ 
                    console.log('sync done');
                });
            },
            saveOptions: function(key, option, value){
                var component = document.getElementById(key);  
                if (option == 'data-value') {
                    component.setAttribute(option, value);
                    component.innerHTML = value;
                } else
                    component.style[option] = value;

                this.storeMoving(component);
            },
            showOptionMenu: function(key) {
                var component = document.getElementById(key);

                console.log(component);
                var modal = document.createElement('div');
                var content = document.createElement('div');
                // set class
                modal.className = "w3-modal edit-component-modal";
                content.className = "w3-modal-content w3-padding w3-white w3-round w3-display-container w3-animate-zoom";
                content.style.width = "400px";
                // set content
                content.innerHTML = `
                    <div class="w3-display-topright w3-padding" >
                        <button class="" onclick="$('.edit-component-modal').remove();" >&times</button>
                    </div>
                    <table class="w3-table" >
                        <tr>
                            <th>key</th>
                            <td><input  value="${key}" readonly ></td>
                        </tr>
                        <tr>
                            <th>top</th>
                            <td><input  value="${component.style.top}" onchange="Pdf.saveOptions('${key}', 'top', this.value)" ></td>
                        </tr>
                        <tr>
                            <th>left</th>
                            <td><input  value="${component.style.left}"  onchange="Pdf.saveOptions('${key}', 'left', this.value)" ></td>
                        </tr>
                        <tr>
                            <th>value</th>
                            <td><input  value="${component.getAttribute('data-value')}" onchange="Pdf.saveOptions('${key}', 'data-value', this.value)" ></td>
                        </tr>
                        <tr>
                            <th>font size</th>
                            <td><input  value="${component.style.fontSize}" min="1" max="100" onchange="Pdf.saveOptions('${key}', 'fontSize', this.value)" ></td>
                        </tr>
                        <tr>
                            <th>letter spacing</th>
                            <td><input  value="${component.style.letterSpacing}" min="1" max="100" onchange="Pdf.saveOptions('${key}', 'letterSpacing', this.value)" ></td>
                        </tr>
                    </table>
                `;

                // remove old modal
                $('.edit-component-modal').remove();

                // add new
                modal.append(content);
                document.body.append(modal);

                $(modal).show();
            }
        };

        $(document).ready(function(){

            @php 
                $top = 0;
            @endphp
            @foreach ($data as $key => $value)
            @if ($key != "image")
                Pdf.createComponent({
                    key: '{{ $key }}', 
                    value: '{{ $value->dataValue?? $key }}',  
                    letterSpacing: '{{ str_replace(["px", "mm"], "", $value->letterSpacing?? 0) }}', 
                    fontSize: '{{ str_replace(["px", "mm"], "", $value->fontSize?? 15) }}',  
                    left: {{ str_replace(["px", "mm"], "", $value->left?? 0) }},
                    top: {{ str_replace(["px", "mm"], "", $value->top?? $top) }},
                });
            @endif
                @php 
                    $top += 20;
                @endphp
            @endforeach 
 
        });
    </script>
    

</body>

</html>
