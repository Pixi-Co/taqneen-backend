@php
$is_mobile = isMobile();
@endphp

<div class="row">
    <div class="col-sm-12 pos_product_div w3-padding">
        <div class="w3-padding w3-display-container">
            <h3>@trans('Current Order')</h3>

            <div class="w3-display-topright w3-padding">
                @if (empty($edit))
                <button type="button" class="btn btn-default @if ($is_mobile) c @else c @endif" id="pos-cancel"> <i
                        class="fas fa-window-close"></i> @trans('sale.cancel')</button>
                @else
                    <button type="button" class="btn btn-default hide @if ($is_mobile) c @else c @endif" id="pos-delete"> <i
                            class="fas fa-trash-alt"></i> @trans('messages.delete')</button>
                @endif
            </div>
        </div>

        <input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{$business_details->sell_price_tax}}">

        <!-- Keeps count of product rows -->
        <input type="hidden" id="product_row_count" 
            value="0">
        @php
            $hide_tax = '';
            if( session()->get('business.enable_inline_tax') == 0){
                $hide_tax = 'hide';
            }
        @endphp
        <table class="table table-responsive" id="pos_table">
            <thead class="hidden" >
                <tr>
                    <th class="tex-center @if(!empty($pos_settings['inline_service_staff'])) col-md-3 @else col-md-4 @endif">	
                        @trans('sale.product') @show_tooltip(__('lang_v1.tooltip_sell_product_column'))
                    </th>
                    <th class="text-center col-md-3">
                        @trans('sale.qty')
                    </th>
                    @if(!empty($pos_settings['inline_service_staff']))
                        <th class="text-center col-md-2">
                            @trans('restaurant.service_staff')
                        </th>
                    @endif
                    <th class="text-center col-md-2 {{$hide_tax}}">
                        @trans('sale.price_inc_tax')
                    </th>
                    <th class="text-center col-md-2">
                        @trans('sale.subtotal')
                    </th>
                    <th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
