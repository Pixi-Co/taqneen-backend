 
    @php
        $custom_labels = json_decode(session('business.custom_labels'), true);
    @endphp
    <div class="table-responsive w3-light-gray">
        <table data-title="{{ __('subscriptions') }}" class="table table-bordered table-striped ajax_view"
            id="sell_table">
            <thead>
                <th>@trans("date")</th>
                <th>@trans("membership")</th>
                <th>@trans("invoice_number")</th>
                <th>@trans("member")</th>
                <th>@trans("class type")</th>
                <th>@trans("session")</th>
                <th>@trans("pay_status")</th>
                <th>@trans("total")</th>
                <th>@trans("is_expire")</th>
                <th>@trans("is_stop")</th>
                <th>@trans("contacts")</th>
                <th>@trans("actions")</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div> 

<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->
