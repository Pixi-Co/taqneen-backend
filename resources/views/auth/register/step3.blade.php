 <div class="step step3 panel radio-toolbar text-center">
     <div class="business_type_title my-3">
         <h4>@trans('Let us get to know you')</h4>
         <h6>@trans('Select the use case that best fits your business')</h6>
     </div>
     <input type="hidden" name="businesstype_id" class="businesstype_id" >
     <div class="w3-row justify-content-center text-left"  style="max-width: 66.666667%!important;margin: auto" >
         @foreach (App\BusinessType::active() as $item)
             <div class="col-md-12 text-left" onclick="$('.businesstype_id').val('{{ $item->id }}');" >
                 <div id="bt1" class="business_type">
                     <label class="customcheck" style="padding-left: 10px!important">
                         <input name="businesstype" 
                         class="checkbox2 business-check" 
                         data-id="{{ $item->id }}"
                         type="radio" id="chk1" value="">
                         <i class="{{ $item->icon }}"></i>
                         {{ __($item->name) }}

                         <p id="sb1" class="autoUpdate" style="display: none">
                             {{ __($item->description) }}
                         </p>
                     </label>
                 </div>
             </div>
         @endforeach

     </div>

     <div class=""  style="max-width: 66.666667%!important;margin: auto">

        <h6 class=" my-3">{{ __('Which of these best describes you (Required)') }}</h6>

            <div class="row justify-content-center">

                @foreach (getBusinessDescriptions() as $key => $item)

                    <div class="col-md-6" style="height: 100px">
                        <div style="padding: 5px" class=" text-center w3-display-container">

                            <input 
                            type="radio" 
                            id="radiobtn1{{ $key }}" 
                            name="bussiness_description" 
                            value="{{ $item['name'] }}" 
                            checked="">
                            <label class="text-center" for="radiobtn1{{ $key }}" style="height: 90px">
                                <div class="w3-display-topright w3-block" style="padding-top: 8px"> 
                                    <i class="{{ $item['icon'] }}"></i><br>
                                {{ __($item['name']) }}
                                </div>

                            </label>
                        </div>
                    </div>

                @endforeach

            </div>

     </div>


     <div class="row justify-content-center w3-padding w3-center"> 
        <br>
        <a  class="btn btn-blue text-center" onclick="gotoStep(4)">
          @trans('continue')
        </a> 
    </div>
 </div>
