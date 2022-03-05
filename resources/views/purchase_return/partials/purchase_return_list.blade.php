<div class="table-responsive w3-light-gray"  >
    <table class="table table-bordered table-striped ajax_view" data-title="{{ __('lang_v1.all_purchase_returns') }}" id="purchase_return_datatable">
        <thead>
            <tr>
                <th>@trans('messages.date')</th>
                <th>@trans('purchase.ref_no')</th>
                <th>@trans('lang_v1.parent_purchase')</th>
                <th>@trans('purchase.location')</th>
                <th>@trans('purchase.supplier')</th>
                <th>@trans('purchase.payment_status')</th>
                <th>@trans('purchase.grand_total')</th>
                <th>@trans('purchase.payment_due') &nbsp;&nbsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="{{ __('messages.purchase_due_tooltip')}}" aria-hidden="true"></i></th>
                <th>@trans('messages.action')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="5"><strong>@trans('sale.total'):</strong></td>
                <td id="footer_payment_status_count"></td>
                <td><span class="display_currency" id="footer_purchase_return_total" data-currency_symbol ="true"></span></td>
                <td><span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>