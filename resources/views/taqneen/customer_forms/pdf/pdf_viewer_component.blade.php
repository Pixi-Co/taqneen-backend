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
