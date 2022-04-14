<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    @include('taqneen.customer_forms.pdf.common_style')
<body>
    @foreach (App\CustomerForm::$KEYS_IMAGES[$resource->key] as $image)
        <img style="height: 26.458333333cm;" src="{{ url($image) }}" class="pdf_image" alt="">

        @if ($loop->iteration == 1)

        @foreach ($data as $key => $value)
            @php
                $opt = $options[$key] ?? [];
                $style = 'position: absolute;';
                
                $style .= isset($opt['left']) ? 'left:' . $opt['left'] . ';' : '';
                $style .= isset($opt['top']) ? 'top:' . $opt['top'] . ';' : '';
                $style .= isset($opt['fontSize']) ? 'font-size:' . $opt['fontSize'] . ';' : '';
                $style .= isset($opt['letterSpacing']) ? 'letter-spacing:' . $opt['letterSpacing'] . ';' : '';
                $style .= isset($opt['width']) ? 'width:' . $opt['width'] . ';' : '';
                
                if (isset($opt['replace'])) {
                    $replaces = explode(",", $opt['replace']);
                    if (count($replaces) > 0 && !is_array($value)) {
                        foreach ($replaces as $replace) {
                            $arr = explode("|", $replace);
                            if (count($arr) > 1) {
                                $value = str_replace($arr[0], $arr[1], $value);
                            }
                        }
                    }
                }
            @endphp
            <div style="{{ $style }}" lang="ar">
                {!! is_array($value) ? '' : $value  !!}
            </div>
        @endforeach 
        @endif
    @endforeach

 
</body>
</html>
 