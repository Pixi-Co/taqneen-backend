<div class="row step step2">

  <div class="col-12" >
    <div class=" panel radio-toolbar modal-sm" 
    style="max-width: 400px"
    style="overflow: hidden" 
    data-select2-id="select2-data-7-12um">
      <div class="w3-block" style="height: 400px;overflow-y: auto;overflow-x: hidden" >
      <input type="hidden" name="currency_id" class="currency_id"  >
   
      @foreach(App\Currency::active()->get() as $item)
      <div class="row justify-content-center">
        <div class="col-md-12 " onclick="$('.currency_id').val('{{ $item->id }}')" >
          
          <input type="radio" id="currency{{ $item->id }}" name="currency" class="currency" value="{{ $item->id }}">
          
          <label for="currency{{ $item->id }}" > 
            <span class="w3-tiny {{ randColor() }} w3-center hidden" 
            style="margin-left: 10px;width: 25px;height: 25px;border-radius: 5em;padding-top: 5px" > 


              {{ $item->symbol }}
            </span> 
            @if ($item->flag)
            <img src="{{ url($item->flag) }}" style="border-radius: 5em;margin-left: 10px" class="flag" >
            @endif

              {{ $item->country }}
         
            <span class="currency_short">{{ $item->code }}</span></label>
        </div>
      </div>
      @endforeach
      </div>
   
      <!--
        <div class="row justify-content-center">
          <div class="col-md-12">
            <input type="radio" id="radioOrange" name="radioCurrency" value="orange">
            <label for="radioOrange"><img class="flag" src="images/flags/united-arab-emirates.svg"> The UAE dirham
              <span class="currency_short">AED</span></label> 
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-12">
            <input type="radio" id="radioQater" name="radioCurrency" value="Qatar">
            <label for="radioQater"><img class="flag" src="images/flags/qatar.svg">The Qatari Riyal
              <span class="currency_short">QR</span></label> 
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-12">
            <input type="radio" id="radioDolar" name="radioCurrency" value="Dolar">
            <label for="radioDolar"><img class="flag" src="images/flags/united-states-of-america.svg"> Us
              <span class="currency_short">$</span></label> 
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-12">
            <input type="radio" id="radioEuro" name="radioCurrency" value="Doalr">
            <label for="radioEuro"><img class="flag" src="images/flags/european-union.svg"> Euro
              <span class="currency_short">€</span></label> 
          </div>
        </div>
        <div class="row justify-content-center mb-2" data-select2-id="select2-data-6-n425">
          <div class="col-md-12" data-select2-id="select2-data-5-30u4">
            <select class="mySelect select2-hidden-accessible" data-target=".reportContent" data-select2-id="select2-data-1-x9js" tabindex="-1" aria-hidden="true"> 
              <option value="option1" data-show=".sales_report_table" data-select2-id="select2-data-3-510s">  Other</option>
              <option value="option2" data-show=".sales_report_linear_chart" data-select2-id="select2-data-9-qrdj"> Demo</option>
             <option value="option3" data-show=".sales_report_column_chart" data-select2-id="select2-data-10-p0ex">  Demo </option>
            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="select2-data-2-9f1z" style="width: 331.95px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-bt68-container" aria-controls="select2-bt68-container"><span class="select2-selection__rendered" id="select2-bt68-container" role="textbox" aria-readonly="true" title="  Other">  Other</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
          </div>
        </div>
      -->
      
       <div class="row justify-content-center w3-padding w3-center"> 
           <br>
           <a  class="btn btn-blue text-center" onclick="gotoStep(3)">
             Continue
           </a> 
       </div>
   </div>

    </div>

  </div>
</div>
