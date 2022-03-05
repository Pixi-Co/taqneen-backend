<table class="w3-table">
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fa fa-info margin-r-5"></i> @trans('contact.tax_no')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {{ $contact->tax_number }}
                </p>
            </div>
        </td> 
    </tr>
    @if($contact->pay_term_type)
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fa fa-calendar margin-r-5"></i> @trans('contact.pay_term_period')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top"> 
                <p class="text-muted">
                    {{ __('lang_v1.' . $contact->pay_term_type) }}
                </p>
            </div>
        </td> 
    </tr>
    @endif
    @if($contact->pay_term_number)
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fas fa fa-handshake margin-r-5"></i> @trans('contact.pay_term')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {{ $contact->pay_term_number }}
                </p>
            </div>
        </td> 
    </tr>
    @endif
</table>
