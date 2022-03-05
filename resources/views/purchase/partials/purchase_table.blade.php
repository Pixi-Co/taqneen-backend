<div class="table-responsive w3-light-gray">
    <table class="table table-bordered table-striped ajax_view" data-title="@trans('purchase.purchases')" id="purchase_table" style="width: 100%;">
        <thead>
            <tr>
                <th>@trans('messages.action')</th>
                <th>@trans('messages.date')</th>
                <th>@trans('purchase.ref_no')</th>
                <th>@trans('purchase.location')</th>
                <th>@trans('purchase.supplier')</th>
                <th>@trans('purchase.purchase_status')</th>
                <th>@trans('purchase.payment_status')</th>
                <th>@trans('purchase.grand_total')</th>
                <th>@trans('purchase.payment_due') &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="{{ __('messages.purchase_due_tooltip')}}" aria-hidden="true"></i></th>
                <th>@trans('lang_v1.added_by')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="5"><strong>@trans('sale.total'):</strong></td>
                <td class="footer_status_count"></td>
                <td class="footer_payment_status_count"></td>
                <td class="footer_purchase_total"></td>
                <td class="text-left"><small>@trans('report.purchase_due') - <span class="footer_total_due"></span><br>
                @trans('lang_v1.purchase_return') - <span class="footer_total_purchase_return_due"></span>
                </small></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
