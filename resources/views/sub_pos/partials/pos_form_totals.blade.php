<div class="row">
    <div class="col-md-12" >
        <table class="table">
            <tr>
                <td class="text-left">
                    @if ($is_discount_enabled)
                        @trans('sale.discount')
                        @show_tooltip(__('tooltip.sale_discount'))
                    @endif
                    @if ($is_rp_enabled)
                        {{ session('business.rp_name') }}
                    @endif
                    (-):
                </td>
                <td class="text-right w3-text-green">
                    <i class="fas fa-edit cursor-pointer" id="pos-edit-discount" title="@trans('sale.edit_discount')"
                        aria-hidden="true" data-toggle="modal" data-target="#posEditDiscountModal"></i>
                    <span id="total_discount">0</span>
                    <input type="hidden" name="discount_type" id="discount_type" value="@if (empty($edit)) {{ 'percentage' }}@else{{ $transaction->discount_type }} @endif" data-default="percentage">

                    <input type="hidden" name="discount_amount" id="discount_amount" value="@if (empty($edit)) {{ @num_format($business_details->default_sales_discount) }} @else {{ @num_format($transaction->discount_amount) }} @endif" data-default="{{ $business_details->default_sales_discount }}">

                    <input type="hidden" name="rp_redeemed" id="rp_redeemed" value="@if (empty($edit)) {{ '0' }}@else{{ $transaction->rp_redeemed }} @endif">

                    <input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="@if (empty($edit)) {{ '0' }}@else {{ $transaction->rp_redeemed_amount }} @endif">

                </td>
            </tr>
            <tr class=" @if ($pos_settings['disable_order_tax'] !=0) hide @endif">
                <td class="text-left">
                    @trans('sale.order_tax')(+): @show_tooltip(__('tooltip.sale_tax'))
                </td>
                <td class="text-right w3-text-green">

                    <i class="fas fa-edit cursor-pointer" title="@trans('sale.edit_order_tax')" aria-hidden="true"
                        data-toggle="modal" data-target="#posEditOrderTaxModal" id="pos-edit-tax"></i>
                    <span id="order_tax">
                        @if (empty($edit))
                            0
                        @else
                            {{ $transaction->tax_amount }}
                        @endif
                    </span>

                    <input type="hidden" name="tax_rate_id" id="tax_rate_id" value="@if (empty($edit)) {{ $business_details->default_sales_tax }} @else {{ $transaction->tax_id }} @endif" data-default="{{ $business_details->default_sales_tax }}">

                    <input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="@if (empty($edit)) {{ @num_format($business_details->tax_calculation_amount) }} @else {{ @num_format(optional($transaction->tax)->amount) }} @endif" data-default="{{ $business_details->tax_calculation_amount }}">

                </td>
            </tr>
            <!--
            <tr class="@if (isset($pos_settings['disable_shipping'])) @if ($pos_settings['disable_shipping'] !=0) hide @endif @endif">
                <td class="text-left">
                    @trans('sale.shipping')(+): @show_tooltip(__('tooltip.shipping'))
                </td>
                <td class="text-right w3-text-green">
                    <i class="fas fa-edit cursor-pointer" title="@trans('sale.shipping')" aria-hidden="true"
                        data-toggle="modal" data-target="#posShippingModal"></i>
                    <span id="shipping_charges_amount">0</span>
                    <input type="hidden" name="shipping_details" id="shipping_details" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->shipping_details }} @endif"
                        data-default="">

                    <input type="hidden" name="shipping_address" id="shipping_address" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->shipping_address }} @endif">

                    <input type="hidden" name="shipping_status" id="shipping_status" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->shipping_status }} @endif">

                    <input type="hidden" name="delivered_to" id="delivered_to" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->delivered_to }} @endif">

                    <input type="hidden" name="shipping_charges" id="shipping_charges" value="@if (empty($edit)) {{ @num_format(0.0) }} @else{{ @num_format($transaction->shipping_charges) }} @endif" data-default="0.00">
                </td>
            </tr>
            -->
			@if (in_array('types_of_service', $enabled_modules))
            <tr>
                <td class="text-left">
					@trans('lang_v1.packing_charge')(+):
                </td>
                <td class="text-right w3-text-green">
					<i class="fas fa-edit cursor-pointer service_modal_btn"></i>
					<span id="packing_charge_text">
						0
					</span>
                </td>
            </tr>
			@endif
            
        </table>
		<table class="table">
			<tr>
                <th class="text-left w3-text-green">
                    @trans('total_of_pos')
                </th>
                <th class="text-right ">
                    <span class="" id="total_payable" >0</span>
                </th>
            </tr>
            @if (!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0)
            <tr>
                <th class="text-left w3-text-green">
					@trans('lang_v1.round_off'):
                </th>
                <th class="text-right ">
					<span id="round_off_text">0</span>
					<input type="hidden" name="round_off_amount" id="round_off_amount" value=0>
                </th>
            </tr>
			@endif 
		</table>
    </div>
</div>
