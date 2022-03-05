<div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="product-items">
        <div class="row">

            @can_bt(['woocommerce_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/woo.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>@trans('WooCommerce')</h4>
                            <span>@trans('WooCommerce Setting Integrationd description')</span>
                            <div class="media_btns">
                                <button class="btn border_btn" data-toggle="modal" data-target="#wooCommerce_model"
                                onclick="loadSetting('{{ url('/woocommerce/quick-api-settings') }}')">
                                    @trans('Set Up')
                                </button>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            @endcan_bt

            @can_bt(['email_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/email.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>{{ __('business.email') }}</h4>
                            <span>@trans('email setting integration description')>
                            <div class="media_btns">
                                <button class="btn border_btn"
                                    onclick="loadSetting('{{ url('/notification-templates?type=email') }}')">
                                    @trans('Set Up')
                                </button>
                                <button class="btn border_btn" onclick="loadSetting('/business/settings-tab?setting_type=settings_email')">
                                    <i class="fa fa-cogs"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endcan_bt

            
            @can_bt(['sms_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/sms.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>@trans('SMS')</h4>
                            <span>@trans('sms setting integration description')</span>
                            <div class="media_btns">
                                <button class="btn border_btn"
                                onclick="loadSetting('{{ url('/notification-templates?type=sms') }}')">
                                @trans('Set Up')
                                </button>
                                <button class="btn border_btn" onclick="loadSetting('/business/settings-tab?setting_type=settings_sms')">
                                    <i class="fa fa-cogs"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endcan_bt

            
            @can_bt(['whatsapp_integeration'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel ">
                    <div class="row">
                        <div class="col-md-4"> 
                            <div 
                            style="height: 100px;width: 100px;border-radius: 7px;background-image: url({{ url('/images/icons/whatsapp.png') }});background-size: cover;background-position: center"  >

                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4>@trans('Whatsapp')</h4>
                            <span>@trans('Whatsapp settings integration description')</span>
                            <div class="media_btns">
                                <button class="btn border_btn" 
                                    onclick="loadSetting('{{ url('/notification-templates?type=whatsapp') }}')">
                                    @trans('Set Up')
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endcan_bt


        </div>
    </div>
</div>
