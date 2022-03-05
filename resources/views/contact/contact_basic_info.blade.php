<table class="w3-table">
    <tr>
        <td style="width: 40%">
            <i class="w3-large fas fa-user-tie circle-avatar"></i>
            <b class="w3-text-deep-orange">
                {{ $contact->name }}
            </b>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                @if($contact->type == 'both')
                {{__('role.customer')}} & {{__('role.supplier')}}
                @elseif(($contact->type != 'lead'))
                    {{__('role.'.$contact->type)}}
                @endif
            </div>
        </td> 
    </tr>
    <tr>
        <td style="width: 40%">
            <i class="circle-avatar w3-large fa fa-map-marker margin-r-5"></i> 
            @trans('business.address')
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {!! str_replace("<br>", " ", $contact->contact_address) !!}
                </p>
            </div>
        </td> 
    </tr>
    @if($contact->supplier_business_name)
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fa fa-briefcase margin-r-5"></i> 
            @trans('business.business_name')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {{ $contact->supplier_business_name }}
                </p>
            </div>
        </td> 
    </tr>
    @endif 
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fa fa-mobile margin-r-5"></i> @trans('contact.mobile')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {{ $contact->mobile }}
                </p>
            </div>
        </td> 
    </tr>
    @if($contact->landline)
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fa fa-phone margin-r-5"></i> @trans('contact.landline')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {{ $contact->landline }}
                </p>
            </div>
        </td> 
    </tr> 
    @endif
    @if($contact->alternate_number)
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fa fa-phone margin-r-5"></i> @trans('contact.alternate_contact_number')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {{ $contact->alternate_number }}
                </p>
            </div>
        </td> 
    </tr> 
    @endif
    @if($contact->dob)
    <tr>
        <td style="width: 40%">
            <strong><i class="circle-avatar w3-large fa fa-calendar margin-r-5"></i> @trans('lang_v1.dob')</strong>
        </td>
        <td style="width: 60%">
            <div class="padding-top">
                <p class="text-muted">
                    {{ @format_date($contact->dob) }}
                </p>
            </div>
        </td> 
    </tr> 
    @endif
</table> 
