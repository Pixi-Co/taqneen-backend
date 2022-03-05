 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>@trans('business.business_settings')</h1>
     <br>
     @include('layouts.partials.search_settings')
 </section>

<!-- Main content -->
<section class="content">
{!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]) !!}
    <div class="row">
        <div class="col-xs-12">
       <!--  <pos-tab-container> -->
        <div class="col-xs-12 pos-tab-container" style="float: none;height: 700px;z-index: 0!important" >
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pos-tab-menu">
                <div class="list-group">
                    <a href="#" class="list-group-item text-center active">@trans('business.business')</a>
                    <a href="#" class="list-group-item text-center">@trans('business.tax') @show_tooltip(__('tooltip.business_tax'))</a>
                    <a href="#" class="list-group-item text-center">@trans('business.product')</a>
                    <a href="#" class="list-group-item text-center">@trans('contact.contact')</a>
                    <a href="#" class="list-group-item text-center">@trans('business.sale')</a>
                    <a href="#" class="list-group-item text-center">@trans('sale.pos_sale')</a>
                    <a href="#" class="list-group-item text-center">@trans('purchase.purchases')</a>
                    <a href="#" class="list-group-item text-center">@trans('business.dashboard')</a>
                    <a href="#" class="list-group-item text-center">@trans('business.system')</a>
                    <a href="#" class="list-group-item text-center">@trans('lang_v1.prefixes')</a>
                    <a href="#" class="list-group-item text-center">@trans('lang_v1.email_settings')</a>
                    <a href="#" class="list-group-item text-center">@trans('lang_v1.sms_settings')</a>
                    <a href="#" class="list-group-item text-center">@trans('lang_v1.reward_point_settings')</a>
                    <a href="#" class="list-group-item text-center">@trans('lang_v1.modules')</a>
                    @canaccessmodule('custom_field')
                    <a href="#" class="list-group-item text-center">@trans('lang_v1.custom_labels')</a>
                    @endcanaccessmodule
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                <!-- tab 1 start -->
                @include('business.partials.settings_business')
                <!-- tab 1 end -->
                <!-- tab 2 start -->
                @include('business.partials.settings_tax')
                <!-- tab 2 end -->
                <!-- tab 3 start -->
                @include('business.partials.settings_product')

                @include('business.partials.settings_contact')
                <!-- tab 3 end -->
                <!-- tab 4 start -->
                @include('business.partials.settings_sales')
                @include('business.partials.settings_pos')
                <!-- tab 4 end -->
                <!-- tab 5 start -->
                @include('business.partials.settings_purchase')
                <!-- tab 5 end -->
                <!-- tab 6 start -->
                @include('business.partials.settings_dashboard')
                <!-- tab 6 end -->
                <!-- tab 7 start -->
                @include('business.partials.settings_system')
                <!-- tab 7 end -->
                <!-- tab 8 start -->
                @include('business.partials.settings_prefixes')
                <!-- tab 8 end -->
                <!-- tab 9 start -->
                @include('business.partials.settings_email')
                <!-- tab 9 end -->
                <!-- tab 10 start -->
                @include('business.partials.settings_sms')
                <!-- tab 10 end -->
                <!-- tab 11 start -->
                @include('business.partials.settings_reward_point')
                <!-- tab 11 end -->
                <!-- tab 12 start -->
                @include('business.partials.settings_modules')
                @canaccessmodule('custom_field')
                <!-- tab 12 end -->
                @include('business.partials.settings_custom_labels')
                @endcanaccessmodule
            </div>
        </div>
        <!--  </pos-tab-container> -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-danger pull-right" type="submit">@trans('business.update_settings')</button>
        </div>
    </div>
{!! Form::close() !!}
</section>
<!-- /.content --> 
    @include("business.partials.settings_js") 
