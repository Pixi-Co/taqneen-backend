@php
$type = 'customer';
$reward_enabled = false;
@endphp
<div class="w3-block w3-display-container">
    <h2>
        {{ __('members') }}
    </h2>
    <hr>
    <div class="w3-display-topright w3-padding">
        @if (auth()->user()->can('supplier.create') ||
    auth()->user()->can('customer.create') ||
    auth()->user()->can('supplier.view_own') ||
    auth()->user()->can('customer.view_own'))
            <div class="w3-block" style="height: 40px">
                <button  class="btn w3-green sb-shadow add_btn btn-modal" style="width: 180px"
                    data-href="{{ action('ContactController@create', ['type' => $type]) }}"
                    data-container=".contact_modal">
                    <i class="fa fa-plus w3-margin-right"></i>
                    {{ __('add member') }}
                </button>
            </div>
            <br>

        @endif
    </div>


    <!-- Main content -->
    <section class="w3-block">

        <input type="hidden" value="{{ $type }}" id="contact_type">




        <div class="table-responsive light-gray w3-border w3-border-light-gray w3-block">

            @if (auth()->user()->can('supplier.view') ||
    auth()->user()->can('customer.view') ||
    auth()->user()->can('supplier.view_own') ||
    auth()->user()->can('customer.view_own'))
                <table data-title="@trans('members')" class="table table-bordered table-striped"
                    id="contact_table">
                    <thead>
                        <tr>
                            <th>@trans('messages.action')</th>
                            <th>@trans('lang_v1.contact_id')</th>
                            @if ($type == 'supplier')
                                <th>@trans('business.business_name')</th>
                                <th>@trans('contact.name')</th>
                                <th>@trans('business.email')</th>
                                <th>@trans('contact.tax_no')</th>
                                <th>@trans('contact.pay_term')</th>
                                <th>@trans('account.opening_balance')</th>
                                <th>@trans('lang_v1.advance_balance')</th>
                                <th>@trans('lang_v1.added_on')</th>
                                <th>@trans('business.address')</th>
                                <th>@trans('contact.mobile')</th>
                                <th>@trans('contact.total_purchase_due')</th>
                                <th>@trans('lang_v1.total_purchase_return_due')</th>
                            @elseif( $type == 'customer')
                                <th>@trans('business.business_name')</th>
                                <th>@trans('user.name')</th>
                                <th>@trans('business.email')</th>
                                <th>@trans('contact.tax_no')</th>
                                <th>@trans('lang_v1.credit_limit')</th>
                                <th>@trans('contact.pay_term')</th>
                                <th>@trans('account.opening_balance')</th>
                                <th>@trans('lang_v1.advance_balance')</th>
                                <th>@trans('lang_v1.added_on')</th>
                                @if ($reward_enabled)
                                    <th id="rp_col">{{ session('business.rp_name') }}</th>
                                @endif
                                <th>@trans('lang_v1.customer_group')</th>
                                <th>@trans('business.address')</th>
                                <th>@trans('contact.mobile')</th>
                                <th>@trans('contact.total_sale_due')</th>
                                <th>@trans('lang_v1.total_sell_return_due')</th>
                            @endif
                            @php
                                $custom_labels = json_decode(session('business.custom_labels'), true);
                            @endphp
                            <!--
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]) }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_6'] ?? __('lang_v1.custom_field', ['number' => 6]) }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_7'] ?? __('lang_v1.custom_field', ['number' => 7]) }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_8'] ?? __('lang_v1.custom_field', ['number' => 8]) }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_9'] ?? __('lang_v1.custom_field', ['number' => 9]) }}
                                    </th>
                                    <th>
                                        {{ $custom_labels['contact']['custom_field_10'] ?? __('lang_v1.custom_field', ['number' => 10]) }}
                                    </th>
                                -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 text-center footer-total">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td @if ($type == 'supplier') colspan="6"
                            @elseif( $type == 'customer')
                                @if ($reward_enabled)
                                    colspan="9"
                                @else
                                    colspan="8" @endif
            @endif>
            <strong>
                @trans('sale.total'):
            </strong>
            </td>
            <td id="footer_contact_due"></td>
            <td id="footer_contact_return_due"></td>
            <!--
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    -->
            </tr>
            </tfoot>
            </table>
            @endif
        </div>

        <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->
</div>
