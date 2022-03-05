<table class="table table-bordered" 
data-title="Contact Payments"
id="contact_payments_table">
    <thead>
        <tr>
            <th>@trans('lang_v1.paid_on')</th>
            <th>@trans('purchase.ref_no')</th>
            <th>@trans('sale.amount')</th>
            <th>@trans('lang_v1.payment_method')</th>
            <th>@trans('account.payment_for')</th>
            <th>@trans('messages.action')</th>
        </tr>
    </thead>
    <tbody>
        @forelse($payments as $payment)
            @php
                $count_child_payments = count($payment->child_payments);
            @endphp
            @include('contact.partials.payment_row', compact('payment', 'count_child_payments', 'payment_types'))

            @if($count_child_payments > 0)
                @foreach($payment->child_payments as $child_payment)
                    @include('contact.partials.payment_row', ['payment' => $child_payment, 'count_child_payments' => 0, 'payment_types' => $payment_types, 'parent_payment_ref_no' => $payment->payment_ref_no])
                @endforeach
            @endif
        @empty
            <tr>
                <td colspan="6" class="text-center">@trans('purchase.no_records_found')</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="text-right" style="width: 100%;" id="contact_payments_pagination">{{ $payments->links() }}</div>


<script>
    
    $('#contact_payments_table').DataTable({ 
        @include("layouts.partials.datatable_plugin")  
    });
    setTimeout(() =>{
        editDatatable();
    }, 500);
</script>
