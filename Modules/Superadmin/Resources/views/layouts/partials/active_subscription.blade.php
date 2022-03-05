@if(!empty($__subscription) && env('APP_ENV') != 'demo')
<i class="fas fa-info-circle pull-left mt-10 cursor-pointer" style= "margin-top: 24px; color:white;display: none" aria-hidden="true" data-toggle="popover" data-html="true" title="@trans('superadmin::lang.active_package_description')" data-placement="right" data-trigger="hover" data-content="
    <table class='table table-condensed'>
     <tr class='text-center'> 
        <td colspan='2'>
            {{$__subscription->package_details['name'] }}
        </td>
     </tr>
     <tr class='text-center'>
        <td colspan='2'>
            {{ @format_date($__subscription->start_date) }} - {{@format_date($__subscription->end_date) }}
        </td>
     </tr>
     <tr> 
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
            @if($__subscription->package_details['location_count'] == 0)
                @trans('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['location_count']}}
            @endif

            @trans('business.business_locations')
        </td>
     </tr>
     <tr>
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
            @if($__subscription->package_details['user_count'] == 0)
                @trans('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['user_count']}}
            @endif

            @trans('superadmin::lang.users')
        </td>
     <tr>
     <tr>
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
            @if($__subscription->package_details['product_count'] == 0)
                @trans('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['product_count']}}
            @endif

            @trans('superadmin::lang.products')
        </td>
     </tr>
     <tr>
        <td colspan='2'>
            <i class='fa fa-check text-success'></i>
            @if($__subscription->package_details['invoice_count'] == 0)
                @trans('superadmin::lang.unlimited')
            @else
                {{$__subscription->package_details['invoice_count']}}
            @endif

            @trans('superadmin::lang.invoices')
        </td>
     </tr>
     
    </table>                     
">
</i>
@endif