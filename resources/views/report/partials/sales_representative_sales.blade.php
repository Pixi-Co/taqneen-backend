<div class="table-responsive w3-light-gray">
<table data-title="@trans('lang_v1.sales_added')" class="table table-bordered table-striped" id="sr_sales_report" style="width: 100%;">
    <thead>
        <tr>
            <th>@trans('messages.date')</th>
            <th>@trans('sale.invoice_no')</th>
            <th>@trans('sale.customer_name')</th>
            <th>@trans('sale.location')</th>
            <th>@trans('sale.payment_status')</th>
            <th>@trans('sale.total_amount')</th>
            <th>@trans('sale.total_paid')</th>
            <th>@trans('sale.total_remaining')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 footer-total text-center">
            <td colspan="4"><strong>@trans('sale.total'):</strong></td>
            <td id="sr_footer_payment_status_count"></td>
            <td><span class="display_currency" id="sr_footer_sale_total" data-currency_symbol ="true"></span></td>
            <td><span class="display_currency" id="sr_footer_total_paid" data-currency_symbol ="true"></span></td>
            <td class="text-left"><small>@trans('lang_v1.sell_due') - <span class="display_currency" id="sr_footer_total_remaining" data-currency_symbol ="true"></span><br>@trans('lang_v1.sell_return_due') - <span class="display_currency" id="sr_footer_total_sell_return_due" data-currency_symbol ="true"></span></small></td>
        </tr>
    </tfoot>
</table>
</div>
