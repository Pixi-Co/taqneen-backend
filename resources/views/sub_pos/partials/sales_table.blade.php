@php
    $custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div class="table-responsive w3-light-gray">
    <table data-title="{{ __( 'sale.list_pos') }}" class="table table-bordered table-striped ajax_view" id="sell_table">
        <thead>
            <tr>
                <th>@trans('messages.action')</th>
                <th>@trans('messages.date')</th>
                <th>@trans('sale.invoice_no')</th>
                <th>@trans('sale.customer_name')</th>
                <th>@trans('lang_v1.contact_no')</th>
                <th>@trans('sale.location')</th>
                <th>@trans('sale.payment_status')</th>
                <th>@trans('lang_v1.payment_method')</th>
                <th>@trans('sale.total_amount')</th>
                <th>@trans('sale.total_paid')</th>
                <th>@trans('lang_v1.sell_due')</th>
                <th>@trans('lang_v1.sell_return_due')</th>
                <th>@trans('lang_v1.shipping_status')</th>
                <th>@trans('lang_v1.total_items')</th>
                <th>@trans('lang_v1.types_of_service')</th>
                <th>{{ $custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' )}}</th>
                <th>@trans('lang_v1.added_by')</th>
                <th>@trans('sale.sell_note')</th>
                <th>@trans('sale.staff_note')</th>
                <th>@trans('sale.shipping_details')</th>
                <th>@trans('restaurant.table')</th>
                <th>@trans('restaurant.service_staff')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="6"><strong>@trans('sale.total'):</strong></td>
                <td class="footer_payment_status_count"></td>
                <td class="payment_method_count"></td>
                <td class="footer_sale_total"></td>
                <td class="footer_total_paid"></td>
                <td class="footer_total_remaining"></td>
                <td class="footer_total_sell_return_due"></td>
                <td colspan="2"></td>
                <td class="service_type_count"></td>
                <td colspan="7"></td>
            </tr>
        </tfoot>
    </table>
</div>