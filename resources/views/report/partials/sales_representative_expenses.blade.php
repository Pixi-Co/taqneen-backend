<div class="table-responsive w3-light-gray" >
<table data-title="@trans('expense.expenses')" class="table table-bordered table-striped" id="sr_expenses_report" style="width: 100%;">
    <thead>
        <tr>
            <th>@trans('messages.date')</th>
            <th>@trans('purchase.ref_no')</th>
            <th>@trans('expense.expense_category')</th>
            <th>@trans('business.location')</th>
            <th>@trans('sale.payment_status')</th>
            <th>@trans('sale.total_amount')</th>
            <th>@trans('expense.expense_for')</th>
            <th>@trans('expense.expense_note')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 text-center footer-total">
            <td colspan="4"><strong>@trans('sale.total'):</strong></td>
            <td id="er_footer_payment_status_count"></td>
            <td><span class="display_currency" id="footer_expense_total" data-currency_symbol ="true"></span></td>
            <td colspan="2"></td>
        </tr>
    </tfoot>
</table>
</div>
