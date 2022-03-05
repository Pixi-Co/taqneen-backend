<div class="modal fade product-steps"  >
    <div class="modal-dialog modal-lg">


        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans('add product')</h4>
        </div>

        <div class="w3-modal-content w3-white w3-card w3-round w3-padding ">
            <a href="#" class="w3-block w3-padding" onclick="$('#step1').slideToggle(500)"
                style="border-bottom: 1px solid gray;">
                <b>
                    <i class="fa fa-angle-right"></i>
                    @trans('lang_v1.add_selling_price_group_prices')
                </b>
            </a>
            <br>
            <div class="w3-block" id="step1">

            </div>
            <br>
            <a href="#" class="w3-block w3-padding" onclick="$('#step2').slideToggle(500)"
                style="border-bottom: 1px solid gray;">
                <b>
                    <i class="fa fa-angle-right"></i>
                    @trans('lang_v1.add_opening_stock')
                </b>
            </a>
            <br>
            <div class="w3-block" id="step2">

            </div>
            <div class="modal-footer">
                <button type="button" onclick="saveProductSteps()" class="btn btn-primary">@trans( 'messages.save'
                    )</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
            </div>
        </div>
        
    </div>
</div>
