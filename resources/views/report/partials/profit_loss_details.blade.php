<div class="row">
    <div class="col-xs-6">
        @component('components.widget')
            <table class="table table-striped">
                <tr>
                    <td>{{ __('report.opening_stock') }} <br><small class="text-muted">(@trans('lang_v1.by_purchase_price'))</small>:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['opening_stock']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('report.opening_stock') }} <br><small class="text-muted">(@trans('lang_v1.by_sale_price'))</small>:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['opening_stock_by_sp']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('home.total_purchase') }}:<br><small class="text-muted">(@trans('product.exc_of_tax'), @trans('sale.discount'))</small></td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('report.total_stock_adjustment') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_adjustment']}}</span>
                    </td>
                </tr> 
                <tr>
                    <td>{{ __('G & A Expenses') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_expense']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_purchase_shipping_charge') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase_shipping_charge']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_transfer_shipping_charge') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_transfer_shipping_charges']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_sell_discount') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_discount']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_reward_amount') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_reward_amount']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_sell_return') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_return']}}</span>
                    </td>
                </tr>
                @foreach($data['left_side_module_data'] as $module_data)
                    <tr>
                        <td>{{ $module_data['label'] }}:</td>
                        <td>
                            <span class="display_currency" data-currency_symbol="true">{{ $module_data['value'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endcomponent
    </div>
    
    <div class="col-xs-6">
        @component('components.widget')
            <table class="table table-striped">
                <tr>
                    <td>{{ __('report.closing_stock') }} <br><small class="text-muted">(@trans('lang_v1.by_purchase_price'))</small>:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['closing_stock']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('report.closing_stock') }} <br><small class="text-muted">(@trans('lang_v1.by_sale_price'))</small>:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['closing_stock_by_sp']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('home.total_sell') }}: <br>
                        <!-- sub type for total sales -->
                        @if(count($data['total_sell_by_subtype']) > 1)
                        <ul>
                            @foreach($data['total_sell_by_subtype'] as $sell)
                                <li>
                                    <span class="display_currency" data-currency_symbol="true">
                                        {{$sell->total_before_tax}}    
                                    </span>
                                    @if(!empty($sell->sub_type))
                                        &nbsp;<small class="text-muted">({{ucfirst($sell->sub_type)}})</small>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        @endif
                        <small class="text-muted"> 
                            (@trans('product.exc_of_tax'), @trans('sale.discount'))
                        </small>
                    </td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_sell']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_sell_shipping_charge') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_shipping_charge']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('report.total_stock_recovered') }}:</td>
                    <td>
                         <span class="display_currency" data-currency_symbol="true">{{$data['total_recovered']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_purchase_return') }}:</td>
                    <td>
                         <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase_return']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_purchase_discount') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase_discount']}}</span>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('lang_v1.total_sell_round_off') }}:</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_round_off']}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    &nbsp;
                    </td>
                </tr>
                @foreach($data['right_side_module_data'] as $module_data)
                    <tr>
                        <td>{{ $module_data['label'] }}:</td>
                        <td>
                            <span class="display_currency" data-currency_symbol="true">{{ $module_data['value'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endcomponent
    </div>
</div>
<br>
<div class="row">
     
        <div class="col-md-6">
            <div class="box w3-white w3-padding text-center w3-display-container" style="height: 140px;" >
                <br>
                <span class="w3-text-gray">
                    {{ __('lang_v1.gross_profit') }}
                </span>

                <h1 class="w3-text-deep-orange">
                    <span class="display_currency w3-xxlarge" data-currency_symbol="true">{{$data['gross_profit']}}</span>
                </h1>
                <!--
                <small class="help-block">
                    (@trans('lang_v1.total_sell_price') - @trans('lang_v1.total_purchase_price'))
                    @if(!empty($data['gross_profit_label']))
                        + {{$data['gross_profit_label']}}
                    @endif
                </small>
            -->

                <div class="w3-display-topleft w3-padding w3-block text-left"> 
                    <button 
                    type="button" 
                    class="btn w3-text-deep-orange popover_btn" 
                    data-toggle="popover" 
                    data-trigger="hover" 
                    title="{{ __('lang_v1.gross_profit') }}" 
                    data-content="<div class='text-capitalize'>{{ __('Gross profit = Total Sales - COGS <br> COGS = (Opening Stock((By purchase price)) + Total purchase) - Closing stock(By purchase price)') }}</div>">
                        <i class="fa fa-info-circle"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box w3-white w3-padding text-center w3-display-container" style="height: 140px;">
                <br>
                <span class="w3-text-gray">
                    {{ __('report.net_profit') }}
                </span>

                <h1 class="w3-text-deep-orange">
                    <span class="display_currency w3-xxlarge" data-currency_symbol="true">{{$data['net_profit']}}</span>
                </h1> 

                <div class="w3-display-topleft w3-padding w3-block text-left"> 
                    <button 
                    type="button" 
                    class="btn w3-text-deep-orange popover_btn"  
                    data-toggle="popover" 
                    data-trigger="hover" 
                    title="{{ __('report.net_profit') }}" 
                    data-content="<div class='text-capitalize'>{{ __('(Gross Profit + otder income ) - G&A Expenses') }}</div>">
                        <i 
                         class="fa fa-info-circle"></i>
                    </button>
                </div>
            </div>
        </div>
   
</div>

<script>
    $('.popover_btn').popover({html: true})
    
</script>
