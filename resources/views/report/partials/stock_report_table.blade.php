<div class="table-responsive w3-light-gray stock-table">
    <table data-title="{{ __('report.stock_report') }}" class="table table-bordered table-striped" id="stock_report_table">
        <thead>
            <tr>
                <th>SKU</th>
                <th>@trans('business.product')</th>
                <th>@trans('sale.location')</th>
                <th>@trans('sale.unit_price')</th>
                <th>@trans('report.current_stock')</th>
                @can('view_product_stock_value')
                <th class="stock_price">@trans('lang_v1.total_stock_price') <br><small>(@trans('lang_v1.by_purchase_price'))</small></th>
                <th>@trans('lang_v1.total_stock_price') <br><small>(@trans('lang_v1.by_sale_price'))</small></th>
                <th>@trans('lang_v1.potential_profit')</th>
                @endcan
                <th>@trans('report.total_unit_sold')</th>
                <th>@trans('lang_v1.total_unit_transfered')</th>
                <th>@trans('lang_v1.total_unit_adjusted')</th>
                @if($show_manufacturing_data)
                    <th class="current_stock_mfg">@trans('manufacturing::lang.current_stock_mfg') @show_tooltip(__('manufacturing::lang.mfg_stock_tooltip'))</th>
                @endif
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="4"><strong>@trans('sale.total'):</strong></td>
                <td class="footer_total_stock"></td>
                @can('view_product_stock_value')
                <td class="footer_total_stock_price"></td>
                <td class="footer_stock_value_by_sale_price"></td>
                <td class="footer_potential_profit"></td>
                @endcan
                <td class="footer_total_sold"></td>
                <td class="footer_total_transfered"></td>
                <td class="footer_total_adjusted"></td>
                @if($show_manufacturing_data)
                    <td class="footer_total_mfg_stock"></td>
                @endif
            </tr>
        </tfoot>
    </table>
</div>
