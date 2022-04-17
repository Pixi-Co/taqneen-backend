<table>
    <tr>
        <th>{{ __('pc_number') }}</th>
        <th>{{ __('company') }}</th>
        <th>{{ __('name') }}</th>
        <th>{{ __('address') }}</th>
        <th>{{ __('zipcode') }}</th>
        <th>{{ __('email') }}</th>
        <th>{{ __('mobile') }}</th>
        <th>{{ __('state') }}</th>
        <th>{{ __('city') }}</th>
        <th>{{ __('sales_agent') }}</th>
        <th>{{ __('status') }}</th>
        <th>{{ __('services') }}</th> 
        <th>{{ __('tax_amount') }}</th>
        <th>{{ __('expenses_amount') }}</th>
        <th>{{ __('final_total') }}</th>
        <th>{{ __('subscription_date') }}</th>
        <th>{{ __('register_date') }}</th>
        <th>{{ __('payment_date') }}</th>
        <th>{{ __('payment_status') }}</th>
        <th>{{ __('payment_method') }}</th>
        <th>{{ __('paper_status') }}</th>
        <th>{{ __('expire_date') }}</th> 
    </tr>

    @foreach ($resources as $resource)  
    <tr>
        <td>{{ $resource->custom_field1 }}</td>
        <td>{{ $resource->supplier_business_name }}</td>
        <td>{{ $resource->name }}</td>
        <td>{{ $resource->address_line_1 }}</td>
        <td>{{ $resource->zip_code }}</td>
        <td>{{ $resource->email }}</td>
        <td>{{ $resource->mobile }}</td>
        <td>{{ $resource->state }}</td>
        <td>{{ $resource->city }}</td>
        <td>{{ optional($resource->user)->user_full_name }}</td>
        <td>{{ $resource->status }}</td>
        <td>{{ $resource->service_names }}</td>
        <td>{{ $resource->tax_amount }}</td>
        <td>{{ $resource->custom_field_1 }}</td>
        <td>{{ $resource->final_total }}</td>
        <td>{{ $resource->transaction_date }}</td>
        <td>{{ $resource->shipping_custom_field_1 }}</td>
        <td>{{ optional($resource->payment)->paid_on }}</td>
        <td>{{ $resource->shipping_custom_field_2 }}</td>
        <td>{{ optional($resource->payment)->method }}</td>
        <td>{{ $resource->sub_type }}</td>
        <td>{{ $resource->expire_date }}</td>
    </tr>
    @endforeach
</table>
