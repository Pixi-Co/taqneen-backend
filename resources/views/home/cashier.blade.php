<div class="home">
    <div class="content" id="appContent"> 
        <section class="general-report">
            <div class="row no-gutters">

                <div class="col-md-6 col-lg-3">
                    <div class="items box1">
                        <div class="top">
                            <div>
                                <p>@trans('Draft Sales')</p>
                                <h2 class="counter display_currency">{{ number_format($data['cashier']['draft_sales']) }}</h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-th-large"></i>
                            </span>
                        </div> 
                    </div>
                </div>
                 
                <div class="col-md-6 col-lg-3">
                    <div class="items box1">
                        <div class="top">
                            <div>
                                <p>@trans('Final Sales')</p>
                                <h2 class="counter display_currency">{{ number_format($data['cashier']['final_sales']) }}</h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-th-large"></i>
                            </span>
                        </div> 
                    </div>
                </div>
                 
                <div class="col-md-6 col-lg-3">
                    <div class="items box1">
                        <div class="top">
                            <div>
                                <p>@trans('Pending Sales')</p>
                                <h2 class="counter display_currency">{{ number_format($data['cashier']['pending_sales']) }}</h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-th-large"></i>
                            </span>
                        </div> 
                    </div>
                </div>
                 
                <div class="col-md-6 col-lg-3">
                    <div class="items box1">
                        <div class="top">
                            <div>
                                <p>@trans('Received Sales')</p>
                                <h2 class="counter display_currency">{{ number_format($data['cashier']['received_sales']) }}</h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-th-large"></i>
                            </span>
                        </div> 
                    </div>
                </div>

            </div>
        </section>
        @php
            
        @endphp
        <div class="border_items mt-3 w3-display-container" id="chart1Content">
            <div class="chart1_det row">
                <div class="col-12 head d-flex justify-content-between mb-5">
                    <div>
                        <h4>@trans('Sales Overview')</h4>
                        <p>@trans('Sales Performance for Online and Offline')</p>
                    </div> 
                </div> 
                <div class=" chart_download d-flex justify-content-end w3-display-topright w3-padding">
                    <div class="dropdown show">
                        <button class="btn btn-default dropdown-toggle" type="button" id="menu1"
                            data-toggle="dropdown"> <i class=""> <img
                                    src="{{ asset('images/icons/menu3.svg') }}" /></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-left" style="right: -126px;float: right;left: inherit;top: 5px;" role="menu">
                            <li><a onclick="MyChart.export('#chart1Content', MyChart.FULL_SCREEN)">@trans('View in full screen')</a></li>
                            <li><a onclick="MyChart.export('#chart1Content', MyChart.PRINT)">@trans('Print chart')</a>
                            </li>
                            <hr>
                            <li><a onclick="MyChart.export('#chart1Content', MyChart.PNG)">@trans('Download PNG  image')</a></li>
                            <li><a onclick="MyChart.export('#chart1Content', MyChart.JPG)">@trans('Download JPEG image')</a></li>
                            <li><a onclick="MyChart.export('#chart1Content', MyChart.PDF)">@trans('Download PDF document')</a></li>
                            <li><a onclick="MyChart.export('#chart1Content', MyChart.SVG)">@trans('Download SVG vector image')</a></li>

                        </ul>
                    </div>
                </div>
                <div class="chart-container" style="height: 450px!important;width: 100%">
                    

                    <div id="chart_m_cashier_sales"></div>

                </div>
            </div>
        </div>
        <br> 

        @if (auth()->user()->can('stock_report.view'))
        <div class="product_table">
            <div class="head">
                <div class="row">
                    <div class="col-lg-3">
                        <h5>{{ __('home.product_stock_alert') }} @show_tooltip(__('tooltip.product_stock_alert'))
                        </h5>
                    </div>
                    <div class="col-lg-9 text-right">
                        <ul class="nav nav-pills w3-right" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link w3-round-xxlarge new-shadow" style="border-radius: 5em"
                                    id="productAlertIItem" data-toggle="pill" href="#pills-tab1" role="tab"
                                    aria-controls="pills-tab1" aria-selected="true">@trans('Product Stock Alert')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link w3-round-xxlarge new-shadow" style="border-radius: 5em"
                                    id="productStockItem" data-toggle="pill" href="#pills-tab2" role="tab"
                                    aria-controls="pills-tab2" aria-selected="false">@trans('Stock Expiry Alert')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">
                    <div class="table_container">
                        <div class="@if (session('business.enable_product_expiry') !=1 && auth()->
                        user()->can('stock_report.view')) c @else c @endif">


                            <table data-title="{{ __('home.product_stock_alert') }}" class="table home-table"
                                id="stock_alert_table">
                                <thead>
                                    <tr>
                                        <th>-</th>
                                        <th>@trans( 'sale.product' )</th>
                                        <th>@trans( 'business.location' )</th>
                                        <th>@trans( 'report.current_stock' )</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="hidden">
                    @show_tooltip( __('tooltip.stock_expiry_alert', [ 'days'
                    =>session('business.stock_expiry_alert_days', 30) ]) )
                </div>
                <div class="tab-pane fade" id="pills-tab2" role="tabpanel" aria-labelledby="pills-tab2-tab">
                    <div class="table_container">
                        <table data-title="{{ __('home.stock_expiry_alert') }}" id="stock_expiry_alert_table"
                            class="table home-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>-</th>
                                    <th>@trans('business.product')</th>
                                    <th>@trans('business.location')</th>
                                    <th>@trans('report.stock_left')</th>
                                    <th>@trans('product.expires_in')</th>
                                    <th>@trans( 'messages.action' )</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="user_content_footer">
                <div class="col-12 d-flex justify-content-between">


                </div>
            </div>
        </div>
        @endif

    </div>
</div>
