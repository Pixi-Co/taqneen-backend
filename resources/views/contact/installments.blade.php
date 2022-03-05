<table data-title="@trans('installments of ') {{ $contact->name }}" class="table table-bordered table-striped" >
    <thead>
        <tr>
            <th>@trans("date")</th>
            <th>@trans("value")</th>
            <th>@trans("transaction")</th>
            <th>@trans("user")</th>
            <th>@trans("notes")</th>
            <th>@trans("paid")</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($installments as $installment)
        <tr>
            <td>{{ $installment->date }}</td>
            <td>{{ number_format($installment->value, 2) }}</td>
            <td>{{ $installment->invoice_no }}</td>
            <td>{{ $installment->user_name }}</td>
            <td>{{ $installment->notes }}</td>
            <td>
                @if($installment->paid == 1)
                <span class="label w3-green">@trans('on')</span>
                @else
                <span class="label w3-dark-gray">@trans('off')</span>
                @endif
            </td>
            <td>
                @if ($installment->paid == 0)
                <a href="http://127.0.0.1:8000/payments/pay-contact-due/270?type=sell" 
                data-value="{{ $installment->value }}"
                data-notes="{{ $installment->notes }}"
                data-installment_id="{{ $installment->id }}"
                class="btn w3-green pay_sale_due">
                    <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
                    @trans('pay')
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
