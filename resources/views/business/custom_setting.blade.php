<div class="w3-padding">
    {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form', 'class' => 'form-settings', 'files' => true]) !!}
@csrf
<div class="w3-block ">
    @if (request()->setting_type == 'settings_business')
    @include('business.partials.settings_business')
    @endif
    <!-- tab 1 end -->
    <!-- tab 2 start -->
    @if (request()->setting_type == 'settings_tax')
    @include('business.partials.settings_tax')
    @endif
    <!-- tab 2 end -->
    <!-- tab 3 start -->
    @if (request()->setting_type == 'settings_product')
    @include('business.partials.settings_product')
    @endif

    @if (request()->setting_type == 'settings_contact')
    @include('business.partials.settings_contact')
    @endif
    <!-- tab 3 end -->
    <!-- tab 4 start -->
    @if (request()->setting_type == 'settings_sales')
    @include('business.partials.settings_sales')
    @include('business.partials.settings_pos')
    @endif
    <!-- tab 4 end -->
    <!-- tab 5 start -->
    @if (request()->setting_type == 'settings_purchase')
    @include('business.partials.settings_purchase')
    @endif
    <!-- tab 5 end -->
    <!-- tab 6 start -->
    @if (request()->setting_type == 'settings_dashboard')
    @include('business.partials.settings_dashboard')
    @endif
    <!-- tab 6 end -->
    <!-- tab 7 start -->
    @if (request()->setting_type == 'settings_system')
    @include('business.partials.settings_system')
    @endif
    <!-- tab 7 end -->
    <!-- tab 8 start -->
    @if (request()->setting_type == 'settings_prefixes')
    @include('business.partials.settings_prefixes')
    @endif
    <!-- tab 8 end -->
    <!-- tab 9 start -->
    @if (request()->setting_type == 'settings_email')
    @include('business.partials.settings_email')
    @endif
    <!-- tab 9 end -->
    <!-- tab 10 start -->
    @if (request()->setting_type == 'settings_sms')
    @include('business.partials.settings_sms')
    @endif
    <!-- tab 10 end -->
    <!-- tab 11 start -->
    @if (request()->setting_type == 'settings_reward_point')
    @include('business.partials.settings_reward_point')
    @endif
    <!-- tab 11 end -->
    <!-- tab 12 start -->
    @if (request()->setting_type == 'settings_modules')
    @include('business.partials.settings_modules')
    @endif 
    <!-- tab 12 end -->
    @if (request()->setting_type == 'settings_custom_labels')
    @include('business.partials.settings_custom_labels') 
    @endif
    @if (request()->setting_type == 'settings_subscription')
    @include('business.partials.settings_subscription')
    @endif
    @if (request()->setting_type == 'settings_einvoice')
    @include('business.partials.settings_einvoice')
    @endif
</div>


<div class="w3-block">
    <div class="w3-center text-center w3-padding">
        <button class="btn w3-green" type="submit">@trans('business.update_settings')</button>
    </div>
</div>
{!! Form::close() !!} 
@include("business.partials.settings_js")

</div>
