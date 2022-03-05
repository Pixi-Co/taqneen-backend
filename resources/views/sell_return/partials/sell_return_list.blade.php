<div class="table-responsive w3-light-gray">
    <table data-title="@trans('lang_v1.sell_return')" class="table table-bordered table-striped ajax_view" id="sell_return_table">
        <thead>
            <tr>
                <th>@trans('messages.date')</th>
                <th>@trans('sale.invoice_no')</th>
                <th>@trans('lang_v1.parent_sale')</th>
                <th>@trans('sale.customer_name')</th>
                <th>@trans('sale.location')</th>
                <th>@trans('purchase.payment_status')</th>
                <th>@trans('sale.total_amount')</th>
                <th>@trans('purchase.payment_due')</th>
                <th>@trans('return_reason')</th>
                <th>@trans('messages.action')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="6"><strong>@trans('sale.total'):</strong></td>
                <td id="footer_payment_status_count_sr"></td>
                <td><span class="display_currency" id="footer_sell_return_total" data-currency_symbol ="true"></span></td>
                <td><span class="display_currency" id="footer_total_due_sr" data-currency_symbol ="true"></span></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
