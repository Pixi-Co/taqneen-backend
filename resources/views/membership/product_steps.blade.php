<div class="w3-modal product-steps" style="padding-top: 50px;" >

    <div class="w3-modal-content w3-white w3-card w3-round w3-padding ">
        <center>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link w3-round w3-large first-nav" style="background: transparent;border-radius: 4px!important;"
                       id="pills-home-tab"
                        href="#step1" data-toggle="tab" aria-expanded="true">
                        @trans('lang_v1.add_selling_price_group_prices')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link w3-round w3-large" style="background: transparent;border-radius: 4px!important;"
                        id="pills-profile-tab"
                        href="#step2" data-toggle="tab" aria-expanded="true" aria-controls="pills-profile"
                        aria-selected="false">
                        @trans('lang_v1.add_opening_stock')
                    </a>
                </li>
            </ul>
        </center>
        
        <div class="nav-tabs-custom">

            <div class="tab-content">
                <div class="tab-pane active w3-display-container" id="step1"> 
                </div>

                <div class="tab-pane" id="step2"> 
                </div>
                <br>
                
				<a href="{{ url('/products') }}" type="button" class="btn btn-default no-print" >@trans( 'messages.close' )</a>
            </div>
        </div>
    </div>
</div>

