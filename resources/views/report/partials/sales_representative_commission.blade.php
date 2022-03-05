<div class="table-responsive w3-light-gray">
<table data-title="@trans('lang_v1.sales_with_commission')" class="table table-bordered table-striped" id="sr_sales_with_commission_table" style="width: 100%;">
    <thead>
        <tr>
            <th>@trans('messages.date')</th>
            <th>@trans('sale.invoice_no')</th>
            <th>@trans('sale.customer_name')</th>
            <th>@trans('sale.location')</th>
            <th>@trans('sale.payment_status')</th>
            <th>@trans('total before tax')</th>
            <th>@trans('sale.total_amount')</th>
            <th>@trans('sale.total_paid')</th>
            <th>@trans('sale.total_remaining')</th>
            <th>@trans('percent')</th>
            <th>@trans('percent_calculated')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 footer-total text-center">
            <td colspan="5"><strong>@trans('sale.total'):</strong></td>
            <td id="footer_payment_status_count"></td>
            <td><span class="display_currency" id="footer_sale_total" data-currency_symbol ="true"></span></td>
            <td><span class="display_currency" id="footer_total_paid" data-currency_symbol ="true"></span></td>
            <td class="text-left"><small>@trans('lang_v1.sell_due') - <span class="display_currency" id="footer_total_remaining" data-currency_symbol ="true"></span><br>@trans('lang_v1.sell_return_due') - <span class="display_currency" id="footer_total_sell_return_due" data-currency_symbol ="true"></span></small></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>
</div>
