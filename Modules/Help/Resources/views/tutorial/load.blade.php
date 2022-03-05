
<div 
data-id="{{ $tutorial->id }}"
@if ($tutorial->selector)
data-selector="{{ $tutorial->selector }}"
@endif
@if ($tutorial->page)
data-page="{{ $tutorial->page }}"
@endif
class="@if ($tutorial->is_required == '1' || $tutorial->position == 'center') modal show @else w3-display-topbottom @endif tutorial-modal" 
style="overflow: auto;position:fixed;z-index: 99999999999999999999" tabindex="-1" role="dialog">
    <div class="modal-dialog {{ $tutorial->position_class }} {{ $tutorial->modal_class }} {{ $tutorial->position != 'center'? 'w3-padding' : '' }}" 
        style="z-index: 999999999999999999;@if($tutorial->position != 'center') position: fixed @endif"
        role="document">


        
        <div @if ($tutorial->is_required == '0') style="border: 1px solid gray!important" @endif class="w3-white w3-round-large new-shadow animate__animated animate__{{ $tutorial->animation }} modal-content  ">
            <div class="modal-header" style="padding: 10px"> 
                
                <button type="button" 
                class="close" 
                onclick="closeTutorial()"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title w3-text-green">{{ auth()->user()->language == 'ar'? $tutorial->title_ar :  $tutorial->title_en }}</h4>
            </div>
            @if ($tutorial->image)
                <img src="{{ $tutorial->image_url }}" style="padding: 5px;border-radius: 15px" class="w3-block w3-round" alt="">
            @endif
            @if ($tutorial->video)
                <video autoplay  src="{{ $tutorial->video_url }}" style="border-radius: 15px" class="w3-block w3-round" ></video>
            @endif
            <div class="modal-body">
                <p>{{ auth()->user()->language == 'ar'? $tutorial->description_ar :  $tutorial->description_en }}</p>
            </div> 

            @if ($tutorial->path_content)
                {!! view($tutorial->path_content) !!} 
            @endif
            <div class="modal-footer text-center w3-center">  
                

                @if ($tutorial->getPrevId())
                <button type="button" 
                style="width: 100px" 
                class="btn btn-primary w3-display-container text-capitalize" onclick="loadTutorial('{{ $tutorial->getPrevId() }}')" >
                    <i class="fa fa-angle-left w3-left" style="margin-top: 3px"></i>
                    @trans('previous')
                </button>
                @endif

                @if ($tutorial->getNextId())
                <button type="button"
                style="width: 100px" 
                class="btn btn-primary w3-display-container text-capitalize" onclick="loadTutorial('{{ $tutorial->getNextId() }}')" >
                    @trans('next')
                    <i class="fa fa-angle-right w3-right" style="margin-top: 3px"></i>
                </button> 
                @else
                <button type="button"
                style="width: 100px" 
                class="btn btn-primary w3-display-container text-capitalize" onclick="endTutorial()" >
                    @trans('end')
                    <i class="fa fa-angle-right w3-right" style="margin-top: 3px"></i>
                </button> 
                @endif
                
                <!--
                    <label>
                        {!! Form::checkbox('dont_show_again', 0, false, ['class' => 'input-icheck dont_show_again', 'data-id' => $tutorial->id]) !!}
                        {{ __('not show again') }}
                    </label>
                <button type="button" class="btn btn-default" onclick="closeTutorial()" data-dismiss="modal">@trans('close')</button>
                -->
            </div>
            <div class="w3-green w3-round" style="height: 5px;width: {{ $tutorial->getCurrentToturialWidthPercent() }}%" ></div>
            
            <div class="w3-padding">
                {{ $tutorial->step }} / {{ Tutorial::getTotalTutorial() }}
            </div>
        </div>
    </div>
</div>

<script>
    
</script>
