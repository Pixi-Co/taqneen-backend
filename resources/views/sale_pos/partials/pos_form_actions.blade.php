@php
$is_mobile = isMobile();
@endphp

<div
    id="paymentSectionCard"
    class="w3-block text-center w3-white w3-round w3-border w3-border-light-gray w3-padding w3-margin-bottom pos-border">
    <button type="button"
        class="btn bg-maroon @if (!$is_mobile)  @endif
        no-print @if ($pos_settings['disable_express_checkout'] != 0 || !array_key_exists('cash', $payment_types))
        hide @endif pos-express-finalize @if ($is_mobile) col-xs-6 @endif"
        data-pay_method="cash" title="@trans('tooltip.express_checkout')"> <i class="fas fa-money-bill-alt"
            aria-hidden="true"></i> @trans('lang_v1.express_checkout_cash')</button>

            
            <a href="#" role="button" class="btn btn-info text-left @if (!$is_mobile)  @endif no-print @if ($pos_settings['disable_pay_checkout'] != 0) hide @endif @if ($is_mobile) co6 @endif" id="pos-finalize"
                title="@trans('lang_v1.tooltip_checkout_multi_pay')">
                <i class="fas fa-money-check-alt" aria-hidden="true"></i>
                @trans('pay & install')
            </a>

            <!--
    <button type="button" class="btn btn-info @if (!$is_mobile)  @endif btn-flat no-print @if ($is_mobile) col-xs-6 @endif" id="pos-cod-finalize"
        title="@trans('lang_v1.tooltip_checkout_multi_pay')" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fas fa-money-bill-alt"
            aria-hidden="true"></i>
        @trans('COD') 
    </button>
-->

    <div class="btn-group">

        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @trans('pay') <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <!--
            <li class="text-left hidden" > 
                <a href="#" class="text-left @if (!$is_mobile)  @endif btn-flat no-print @if ($is_mobile) col-xs-6 @endif" id="pos-cod-finalize" title="@trans('lang_v1.tooltip_checkout_multi_pay')">
                <i class="fas fa-money-check-alt" aria-hidden="true"></i>
                                COD
                </a>
            </li> 
            
            <li class="text-left ">
                <a href="#" class="text-left @if (!$is_mobile)  @endif btn-flat no-print @if ($pos_settings['disable_pay_checkout'] != 0) hide @endif @if ($is_mobile) col-xs-6 @endif" id="pos-finalize"
                    title="@trans('lang_v1.tooltip_checkout_multi_pay')">
                    <i class="fas fa-money-check-alt" aria-hidden="true"></i>
                    @trans('lang_v1.checkout_multi_pay')
                </a>
            </li>
        -->
            <li class="text-left ">
                <a href="#" class="text-left no-print @if (!empty($pos_settings['disable_suspend'])) c @endif pos-express-finalize @if (!array_key_exists('card', $payment_types)) hide @endif @if ($is_mobile) c @endif" data-pay_method="card"
                    title="@trans('lang_v1.tooltip_express_checkout_card')">
                    <i class="fas fa-credit-card"></i>
                    @trans('lang_v1.express_checkout_card')
                </a>
            </li>
            @if (empty($pos_settings['disable_credit_sale_button']))
                <input type="hidden" name="is_credit_sale" value="0" id="is_credit_sale">
                <li class="text-left ">
                    <a href="#" class=" no-print pos-express-finalize @if ($is_mobile) col-xs-6 @endif"
                        data-pay_method="credit_sale" title="@trans('lang_v1.tooltip_credit_sale')">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        @trans('lang_v1.credit_sale')
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

<div
    class="w3-block text-center w3-white w3-round w3-border w3-border-light-gray w3-padding w3-margin-bottom pos-border">
    <div class="btn-group" role="group" aria-label="...">

        <button type="button"
            class="@if ($is_mobile) col-xs-6 @endif
            btn btn-default btn-default @if ($pos_settings['disable_draft'] != 0) hide
            @endif"
            id="pos-draft">
            <i class="fas fa-edit"></i> @trans('sale.draft')
        </button>

        @if (empty($pos_settings['disable_quotation']))
        <button type="button" class="btn btn-default bg-yellow  @if ($is_mobile) col-xs-6 @endif" id="pos-quotation">
            <i class="fas fa-edit"></i> @trans('lang_v1.quotation')
        </button>
        @endif

        @if (empty($pos_settings['disable_suspend']))
            <button type="button" class="@if ($is_mobile) col-xs-6 @endif btn btn-default no-print pos-express-finalize"
                data-pay_method="suspend" title="@trans('lang_v1.tooltip_suspend')">
                <i class="fas fa-pause" aria-hidden="true"></i>
                @trans('lang_v1.suspend')
            </button>
        @endif
    </div>
</div>
<div class="row hidden">
    <div class="pos-form-actions">
        <div class="col-md-12">
            @if ($is_mobile)
                <div class="col-md-12 text-right">
                    <b>@trans('sale.total_payable'):</b>
                    <input type="hidden" name="final_total" id="final_total_input" value=0>
                    <span id="total_payable_" class="text-success lead text-bold text-right">0</span>
                </div>
            @endif








            @if (!$is_mobile)
                &nbsp;&nbsp;
                <b>@trans('sale.total_payable'):</b>
                <input type="hidden" name="final_total" id="final_total_input" value=0>
                <span id="total_payable_" class="text-success lead text-bold">0</span>
                &nbsp;&nbsp;
            @endif


            @if (!isset($pos_settings['hide_recent_trans']) || $pos_settings['hide_recent_trans'] == 0)
                <button type="button" class="btn btn-primary btn-flat pull-right @if ($is_mobile) col-xs-6 @endif"
                    data-toggle="modal" data-target="#recent_transactions_modal" id="recent-transactions"> <i
                        class="fas fa-clock"></i>
                    @trans('lang_v1.recent_transactions')</button>
            @endif

        </div>
    </div>
</div>
@if (isset($transaction))
    @include('sale_pos.partials.edit_discount_modal', ['sales_discount' => $transaction->discount_amount,
    'discount_type' => $transaction->discount_type, 'rp_redeemed' => $transaction->rp_redeemed, 'rp_redeemed_amount' =>
    $transaction->rp_redeemed_amount, 'max_available' => !empty($redeem_details['points']) ? $redeem_details['points'] :
    0])
@else
    @include('sale_pos.partials.edit_discount_modal', ['sales_discount' => $business_details->default_sales_discount,
    'discount_type' => 'percentage', 'rp_redeemed' => 0, 'rp_redeemed_amount' => 0, 'max_available' => 0])
@endif

@if (isset($transaction))
    @include('sale_pos.partials.edit_order_tax_modal', ['selected_tax' => $transaction->tax_id])
@else
    @include('sale_pos.partials.edit_order_tax_modal', ['selected_tax' => $business_details->default_sales_tax])
@endif

@include('sale_pos.partials.edit_shipping_modal')
