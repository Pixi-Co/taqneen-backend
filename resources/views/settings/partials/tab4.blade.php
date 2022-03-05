<div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="product-items">
        <div class="row">

            @can_bt(['modifier_set'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Modifier Sets')</h4>
                                    <span>@trans("modifier sets settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('{{ url('/modules/modifiers') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/modules/modifiers') }}')">
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

            @can_bt(['tables'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('tables')</h4>
                                    <span>@trans("table settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('{{ url('/modules/tables') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/modules/tables') }}')">
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


            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Categories')</h4>
                                    <span>@trans("categories settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('{{ url('/taxonomies?type=product') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/taxonomies?type=product') }}')">
                                            @trans( 'messages.add' )
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @can_bt(['variation'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Variations')</h4>
                                    <span>@trans("variations settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('{{ url('/variation-templates') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/variation-templates') }}')">
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

            @can_bt(['warranties'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Warranties')</h4>
                                    <span>@trans("Warranties settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('{{ url('/warranties') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/warranties') }}')">
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

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Units')</h4>
                                    <span>@trans("Units settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn" onclick="loadSetting('{{ url('/units') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/units') }}')">
                                            @trans( 'messages.add' )
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @can_bt(['brands'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Brands')</h4>
                                    <span>@trans("Brands settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn" onclick="loadSetting('{{ url('/brands') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/brands') }}')">
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


            @can_bt(['selling_price_group'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Selling Price Group')</h4>
                                    <span>@trans("Selling Price Group settings description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('{{ url('/selling-price-group') }}')">
                                            {{ __('messages.manage') }}
                                        </button>

                                        <button class="btn border_btn"
                                            onclick="loadAddSetting('{{ url('/selling-price-group') }}')">
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


            @can_bt(['product_setting'])
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="productCard panel">
                    <div class="card-content">
                        <div class="card-body cleartfix">
                            <div class="media align-items-stretch">
                                <div class="media-body">
                                    <h4>@trans('Product Setting')</h4>
                                    <span>@trans("Product Setting description")</span>
                                    <div class="media_btns">
                                        <button class="btn border_btn"
                                            onclick="loadSetting('/business/settings-tab?setting_type=settings_product')">
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

        </div>
    </div>
</div>
