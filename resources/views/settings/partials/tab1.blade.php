<div class="tab-pane fade" id="tab_1" role="tabpanel" aria-labelledby="pills-home-tab">

    <div class="product-items">
        <div class="row">

            @can_bt(['tax_rates'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>{{ __('tax_rate.tax_rates') }}</h4>
                                    <span>@trans('tax rate setting details text')</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn" onclick="loadSetting('/tax-rates')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn" onclick="loadAddSetting('/tax-rates')">
                                            @trans( 'messages.add' )
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadSetting('/business/settings-tab?setting_type=settings_tax')">
                                            <i class="fa fa-cogs"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['subscription.module'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>{{ __('subscription settings') }}</h4>
                                    <span>@trans('subscription setting details text')</span>
                                    <div class="media_btns">  
                                        <button class="btn border_btn"
                                            onclick="loadSetting('/business/settings-tab?setting_type=settings_subscription')">
                                            <i class="fa fa-cogs"></i>
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt
 
            @can('einvoice_settings')
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>{{ __('e-invoice settings') }}</h4>
                                    <span>@trans('e-invoice setting details text')</span>
                                    <div class="media_btns">  
                                        <button class="btn border_btn"
                                            onclick="loadSetting('/business/settings-tab?setting_type=settings_einvoice')">
                                            <i class="fa fa-cogs"></i>
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @endcan

            @can_bt(['printers'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>{{ __('printer.printers') }}</h4>
                                    <span>@trans('printers setting details text')</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn" onclick="loadSetting('/printers')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn" onclick="loadAddSetting('/printers')">
                                            @trans( 'messages.add' )
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['settings_modules'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>{{ __('settings_modules') }}</h4>
                                    <span>@trans('settings_modules details text')</span>
                                    <div class="media_btns"> 
                                        <button class="btn border_btn"
                                        onclick="loadSetting('/business/settings-tab?setting_type=settings_modules')" >
                                            <i class="fa fa-cogs"></i>
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['barcode_setting'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Barcodes Settings')</h4>
                                    <span>@trans('barcode setting details text')</span>
                                    <div class="media_btns"> 
                                        <button class="btn border_btn" onclick="loadSetting('/labels/show')">
                                            @trans('Print Barcode')
                                        </button>
                                        <button class="btn border_btn" onclick="loadSetting('/barcodes')">
                                            @trans('Barcode Setting')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['invoice_settings'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Invoice Settings')</h4>
                                    <span>@trans('invoice setting details text')</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn" onclick="loadSetting('/invoice-schemes?tab=1')">
                                            @trans('Invoice Schemes')
                                        </button>
                                        <button class="btn border_btn" onclick="loadSetting('/invoice-schemes?tab=2')">
                                            @trans('Invoice Layouts')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['business_location'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>{{ __('business.business_locations') }}</h4>
                                    <span>@trans('business location setting details text')</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn" onclick="loadSetting('/business-location')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn" onclick="loadAddSetting('/business-location')">
                                            @trans( 'messages.add' )
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['custom_field'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Custom Fields')</h4>
                                    <span>@trans('custom fields setting details text')</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('/business/settings?setting_type=settings_custom_labels')">
                                            @trans('Manage Custom Fields')
                                        </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['purchase_setting'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4> @trans("Purchase") </h4>
                                    <span>@trans("purchase settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('/business/settings-tab?setting_type=settings_purchase')">
                                            <i class="fa fa-cogs"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['weighing_scale'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4> @trans('Weighing Scale barcode Setting') </h4>
                                    <span>@trans('Weighing Scale barcode Setting description')</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('/business/settings?setting_type=settings_weighing')">
                                            @trans('Manage')
                                        </button>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt

            @can_bt(['discounts'])
            @if (auth()->user()->can('discount.access') &&
    auth()->user()->can_access_custom('sells_disocunts'))
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="productCard panel">
                        <div class="card-content">
                            <div class="card-body cleartfix">
                                <div class="media align-items-stretch">
                                    <div class="media-body">
                                        <h4> {{ __('Discounts') }}</h4>
                                        <span>@trans('discount setting details text')</span>
                                        <div class="media_btns">
                                            <button class="btn border_btn" onclick="loadSetting('/discount')">
                                                {{ __('Manage Discounts') }}
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endcan_bt

            @can_bt(['expenses'])
            @if (canAccessModule('expenses'))
                @if (in_array('expenses', $enabled_modules) &&
    (auth()->user()->can('expense.access') ||
        auth()->user()->can('view_own_expense')))
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="productCard panel">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="media-body">
                                            <h4>{{ __('expenses categories') }}</h4>
                                            <span>{{ __('expenses categories sub title') }}</span>
                                            <div class="media_btns">

                                                <button class="btn border_btn"
                                                    onclick="loadSetting('/expense-categories')">
                                                    {{ __('manage') }}
                                                </button>

                                                <button class="btn border_btn"
                                                    onclick="loadAddSetting('/expense-categories')">
                                                    {{ __('add') }}
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @endcan_bt


            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('contact settings')</h4>
                                    <span>@trans("contact settings description")</span>
                                    <div class="media_btns">

                                        <button class="btn border_btn" onclick="loadSetting('/business/settings-tab?setting_type=settings_contact')">
                                           <i class="fa fa-cogs"></i>
                                        </button> 

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('sale and pos settings')</h4>
                                    <span>@trans("sell and pos settings description")</span>
                                    <div class="media_btns">

                                        <button class="btn border_btn" onclick="loadSetting('/business/settings-tab?setting_type=settings_sales')">
                                           <i class="fa fa-cogs"></i>
                                        </button> 

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="productCard panel">
                  <div class="card-content">
                      <div class="card-body cleartfix">
                          <div class="media align-items-stretch">
                              <div class="media-body">
                                  <h4>@trans('Reward Points')</h4>
                                  <span>@trans("Reward Points settings description")</span>
                                  <div class="media_btns">

                                      <button class="btn border_btn" onclick="loadSetting('/business/settings-tab?setting_type=settings_reward_point')">
                                         <i class="fa fa-cogs"></i>
                                      </button> 

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          @can_bt(['manage_my_data_setting'])
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Manage my data')</h4>
                                    <span>@trans('manage my data setting details text')</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn" data-toggle="modal" data-target="#backup_model">
                                            @trans('Backup')
                                        </button>
                                        <button class="btn red_border_btn" data-toggle="modal"
                                            data-target="#reset_data_model">
                                            @trans('Reset Data')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan_bt


        </div>
    </div>
</div>
