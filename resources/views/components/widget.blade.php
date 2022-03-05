<div class="box {{$class ?? 'box-solid'}} w3-padding" @if(!empty($id)) id="{{$id}}" @endif style="box-shadow: 0 1px 1px rgb(0 0 0 / 12%)!important" >
    @if(empty($header))
        @if(!empty($title) || !empty($tool))
        <div class="box-header">
            {!!$icon ?? '' !!}
            <h3 class="box-title">{{ $title ?? '' }}</h3>
            {!!$tool ?? ''!!}
        </div>
        @endif
    @else
        <div class="box-header">
            {!! $header !!}
        </div>
    @endif

    <div class="box-body">
        {{$slot}}
    </div>
    <!-- /.box-body -->
</div>
