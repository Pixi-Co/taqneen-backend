<table class="table table-condensed bg-gray">
  <tr>
    <th>@trans('purchase.ref_no')</th>
    <th>@trans('lang_v1.paid_on')</th>
    <th>@trans('sale.amount')</th>
    <th>@trans('contact.contact')</th>
    <th>@trans('lang_v1.payment_method')</th>
    <th>@if($child_payments->first()->transaction->type == 'purchase') @trans('purchase.ref_no') @else  @trans('sale.invoice_no') @endif</th>
    <th class="no-print">@trans('messages.action')</th>
  </tr>
  @forelse ($child_payments as $payment)
    <tr>
      <td>{{ $payment->payment_ref_no }}</td>
      <td>{{ @format_datetime($payment->paid_on) }}</td>
      <td><span class="display_currency" data-currency_symbol="true">{{ $payment->amount }}</span></td>
      <td>{{$payment->transaction->contact->name}}</td>
      <td>{{ $payment_types[$payment->method] ?? '' }}</td>
      <td>@if($payment->transaction->type != 'opening_balance') <a data-href="@if($payment->transaction->type == 'sell'){{action('SellController@show', [$payment->transaction_id]) }}@else{{action('PurchaseController@show', [$payment->transaction_id]) }}@endif" href="#" data-container=".view_modal" class="btn-modal">@if($payment->transaction->type == 'sell') {{$payment->transaction->invoice_no}} @else {{$payment->transaction->ref_no}} @endif</a> @else
        @trans('lang_v1.opening_balance_payments')
      @endif</td>
      <td class="no-print">
        <button type="button" class="btn btn-primary btn-xs view_payment" data-href="{{ action('TransactionPaymentController@viewPayment', [$payment->id]) }}" >@trans("messages.view")
                    </button>
      </td>
    </tr>
  @empty
    <tr class="text-center">
      <td colspan="6">@trans('purchase.no_records_found')</td>
    </tr>
  @endforelse
</table>