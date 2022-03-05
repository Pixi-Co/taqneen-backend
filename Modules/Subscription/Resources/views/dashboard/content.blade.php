<div class="home">
    <div class="content" id="appContent">
        <section class="branch {{ count($data['all_locations']) <= 1? 'hidden' : '' }}">
            <div class="form-group col-md-3 col-12 m-0">
                @if (count($data['all_locations']) > 1)
                    {!! Form::select('dashboard_location', $data['all_locations'], null, ['class' => 'imgSelect custom-select form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'dashboard_location']) !!}
                @endif
            </div>
        </section>
        <section class="general-report">
            <div class="row no-gutters">
                <div class="col-md-6 col-lg-3">
                    <div class="items box1">
                        <div class="top">
                            <div>
                                <p>@trans('Total Memberships')</p>
                                <h2 class="counter ">{{ $data['subscription']['total_membership'] }}</h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-th-large"></i>
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="items box2">
                        <div class="top">
                            <div>
                                <p>@trans('Total Sessions')</p>
                                <h2 class="counter ">{{ $data['subscription']['total_session'] }}</h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-calendar"></i>
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="items box3">
                        <div class="top">
                            <div>
                                <p>@trans('Total Trainer')</p>
                                <h2 class="counter ">
                                    {{ $data['subscription']['total_trainer'] }}
                                </h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="items box4">
                        <div class="top">
                            <div>
                                <p>@trans('Total Members')</p>
                                <h2 class="counter ">{{ $data['subscription']['total_member'] }}</h2>
                            </div>
                            <span class="icon">
                                <i class="fas fa-users"></i>
                            </span>
                        </div> 
                    </div>
                </div>
            </div>
        </section>
        @php
            $totalMembership = $data['subscription']['total_membership'];
            $totalSubscription = $data['subscription']['total_subscription'];
            $countSubscriptionNotExpired = $data['subscription']['count_subscription_not_expired'];
            $countSubscriptionExpired = $data['subscription']['count_subscription_expired']; 
            $countSubscription = $data['subscription']['count_subscription']; 
            $resource = $data['subscription']['chart_data']; 
          @endphp
        <div class="border_items mt-3 w3-display-container" id="chart1Content">
            <div class="chart1_det row">
                <div class="col-12 head d-flex justify-content-between mb-5">
                    <div>
                        <h4>@trans('Subscription Overview')</h4>
                        <p>@trans('Subscription Overview chart details')</p>
                    </div>
                    <div>
                        <a href="?sales_overview=week"
                            class="{{ $salesOverview == 'week' ? 'active' : '' }}">@trans('Week')</a>
                        <a href="?sales_overview=month"
                            class="{{ $salesOverview == 'month' ? 'active' : '' }}">@trans('Month')</a>
                        <a href="?sales_overview=year"
                            class="{{ $salesOverview == 'year' ? 'active' : '' }}">@trans('Year')</a>
                    </div>
                </div>
                <div class="col-md-2 items">
                    <h6>@trans('Total Subscription')</h6>
                    <h2><span class="counter display_currency"> {{ number_format($totalSubscription) }}</span></h2> 
                </div>
                <div class="col-md-2 items ">
                    <h6>@trans('Subscription not expired Count')</h6>
                    <h2><span class="counter display_currency">{{ number_format($countSubscriptionNotExpired) }}</span></h2> 
                </div>
                <div class="col-md-2 items down">
                    <h6>@trans('Subscription Expired Count')</h6>
                    <h2><span class="counter display_currency"> {{ number_format($countSubscriptionExpired) }}</span></h2> 
                </div>
                <div class="col-md-2 items">
                    <h6>@trans('All Subscription Count')</h6>
                    <h2><span class="counter display_currency"> {{ number_format($countSubscription) }}</span></h2> 
                </div>
                <div class=" chart_download d-flex justify-content-end w3-display-topright w3-padding">
                    <div class="dropdown show">
                        <button class="btn btn-default dropdown-toggle" type="button" id="menu1"
                            data-toggle="dropdown"> <i class=""> <img src="{{ asset('images/icons/menu3.svg') }}" /></i>
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
                    
                    <div id="chart_m_subscriptions"></div>

                </div>
            </div>
        </div>
        <br>
        <div class="charts_container">
            <div class="row mt-5">
                <div class="col-md-12 col-lg-6 p-1">
                    <div class="chartLine1">
                        <div class="head p-2">
                            <h6>@trans('Subscriptions Of Class Types')</h6> 
                        </div>
                        <div class="border_items" id="chartLine1Content">
                            <div class="chartLine1_det w3-diaplay-container">
                                <div class="items">
                                    <h2 class="main-color">
                                        <b class="counter display_currency">
                                            {{ $data['subscription']['total_class_type'] }}</b>
                                    </h2>
                                    <h6><b>@trans('Total Class Types')</b></h6>
                                </div> 
                                <div class="w3-display-topright" style="padding: 60px">
                                    <div style="float: right" class=" chart_download d-flex justify-content-end">
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="menu1"
                                                data-toggle="dropdown"> <i class=""> <img
                                                        src="{{ asset('images/icons/menu3.svg') }}" /></i>
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                                <li><a
                                                        onclick="MyChart.export('#chartLine1Content', MyChart.FULL_SCREEN)">@trans('View in full screen')</a></li>
                                                <li><a onclick="MyChart.export('#chartLine1Content', MyChart.PRINT)">@trans('Print chart')</a></li>
                                                <hr>
                                                <li><a onclick="MyChart.export('#chartLine1Content', MyChart.PNG)">Download PNG image</a></li>
                                                <li><a onclick="MyChart.export('#chartLine1Content', MyChart.JPG)">@trans('Download JPEG image')</a></li>
                                                <li><a onclick="MyChart.export('#chartLine1Content', MyChart.PDF)">@trans('Download PDF document')</a></li>
                                                <li><a onclick="MyChart.export('#chartLine1Content', MyChart.SVG)">@trans('Download SVG vector image')</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <form style="float: right">
                                        <select name="category" class="custom-select hidden">
                                            <option selected>Filter By Category</option>
                                            <option value="1">Category 1</option>
                                            <option value="2">Category 2</option>
                                            <option value="3">Category 3</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="chart-container chart-content"
                                style="position: relative; height: 300px; width: 100%">
                                <div class="chart-container" style="position: relative; height: 300px; width: 100%">

                                    <div id="chart_m_subscription_classtypes" class="w3-block" ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($data['topseller_membership']['data']) > 0)
                <div class="col-md-6 col-lg-3 p-2">
                    <div class="head p-2">
                        <h6>@trans('Top Seller Memberships')</h6>
                        <a href="#">@trans('See All')</a>
                    </div>
                    <div class="border_items">
                        <div class="chart_download d-flex justify-content-end  ">
                            <div class="dropdown text-right"  >
                                <button class="btn btn-default dropdown-toggle" type="button" id="menu1"
                                    data-toggle="dropdown"> <i class=""> <img
                                            src="{{ asset('images/icons/menu3.svg') }}" /></i>
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                    <li><a onclick="MyChart.export('#myChartContent', MyChart.FULL_SCREEN)">@trans('View in full screen')</a></li>
                                    <li><a onclick="MyChart.export('#myChartContent', MyChart.PRINT)">@trans('Print chart')</a>
                                    </li>
                                    <hr>
                                    <li><a onclick="MyChart.export('#myChartContent', MyChart.PNG)">Download PNG image</a></li>
                                    <li><a onclick="MyChart.export('#myChartContent', MyChart.JPG)">@trans('Download JPEG image')</a></li>
                                    <li><a onclick="MyChart.export('#myChartContent', MyChart.PDF)">@trans('Download PDF document')</a></li>
                                    <li><a onclick="MyChart.export('#myChartContent', MyChart.SVG)">@trans('Download SVG vector image')</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="chart-content" id="myChartContent">
                            <canvas id="myChartMembership" width="200" height="230"></canvas>
                            <div class="pie-det mt-5">
                                <ul>
                                    @php
                                        $classes = ['bg-info', 'bg-warning', 'bg-danger'];
                                    @endphp
                                    @foreach ($data['topseller_membership']['data'] as $item)
                                        <li>
                                            <span class="circ {{ $classes[$loop->iteration - 1] }}"></span>
                                            <b>{{ $data['topseller_membership']['labels'][$loop->iteration - 1] }}</b>
                                            <strong>{{ round(($item / array_sum($data['topseller_membership']['data'])) * 100) }}%</strong>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (count($data['topseller_category']['data']) > 0)
                <div class="col-md-6 col-lg-3 p-2">
                    <div class="head p-2">
                        <h6>@trans('Top Seller Category')</h6>
                        <a href="#">@trans('See All')</a>
                    </div>
                    <div class="border_items">
                        <div class=" chart_download d-flex justify-content-end">
                            <div class="dropdown text-right">
                                <button class="btn btn-default dropdown-toggle" type="button" id="menu1"
                                    data-toggle="dropdown"> <i class=""> <img
                                            src="{{ asset('images/icons/menu3.svg') }}" /></i>
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                    <li><a onclick="MyChart.export('#myChart2Col', MyChart.FULL_SCREEN)">@trans('View in full screen')</a></li>
                                    <li><a onclick="MyChart.export('#myChart2Col', MyChart.PRINT)">@trans('Print chart')</a></li>
                                    <hr>
                                    <li><a onclick="MyChart.export('#myChart2Container', MyChart.PNG)">@trans('Download PNG image')</a></li>
                                    <li><a onclick="MyChart.export('#myChart2Container', MyChart.JPG)">@trans('Download JPEG image')</a></li>
                                    <li><a onclick="MyChart.export('#myChart2Container', MyChart.PDF)">@trans('Download PDF document')</a></li>
                                    <li><a onclick="MyChart.export('#myChart2Container', MyChart.SVG)">@trans('Download SVG vector image')</a></li>

                                </ul>
                            </div>
                        </div>
                        </a>
                        <div class="chart-content" id="myChart2Col">
                            <div class="" id="myChart2Container">
                                <canvas id="myChart2" width="200" height="230"></canvas>
                            </div>

                            <div class="pie-det mt-5">
                                <ul>
                                    @php
                                        $classes = ['bg-info', 'bg-warning', 'bg-danger'];
                                    @endphp
                                    @foreach ($data['topseller_category']['data'] as $item)
                                        <li>
                                            <span class="circ {{ $classes[$loop->iteration - 1] }}"></span>
                                            <b>{{ $data['topseller_category']['labels'][$loop->iteration - 1] }}</b>
                                            <strong>{{ round(($item / array_sum($data['topseller_product']['data'])) * 100) }}%</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <h4 class="notes-title m-3">@trans('Important Notes')</h4>
        <div class="owl-carousel owl-theme notes slider" id="sliderNotes">

            <div class="item" style="padding: 0px;padding-top: 50px;padding-bottom: 30px" v-for="item in data">
                <div class="new-shadow w3-round-xlarge w3-padding w3-white" >
                    <div class="font-medium2 truncate note-task" v-html="item.task">

                    </div>
                    <div class="text-gray-500 mt-1">
                        <small><b v-html="item.estimated_hours"></b> @trans('Hours ago')</small>
                    </div>
                    <div class="text-justify mt-1" v-html="item.description">
    
                    </div>
                    <div class="font-medium2 flex mt-5">
                        <a target="_blank" v-bind:href="'{{ url('/essentials/todo') }}/' + item.id" type="button"
                            class="button">@trans('View Notes')</a>
                    </div>
                </div>
            </div>



        </div>


 
        <div class="product_table">
            <div class="head">
                <div class="row">
                    <div class="col-lg-3">
                        <h5>{{ __('Subscription Alert') }}  
                        </h5>
                    </div>
                    <div class="col-lg-9 text-right">
                        <ul class="nav nav-pills w3-right" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link w3-round-xxlarge new-shadow" style="border-radius: 5em"
                                    id="productAlertIItem" data-toggle="pill" href="#pills-tab1" role="tab"
                                    aria-controls="pills-tab1" aria-selected="true">@trans('Subscription Expired Alert')</a>
                            </li>
                            <!--
                            <li class="nav-item">
                                <a class="nav-link w3-round-xxlarge new-shadow" style="border-radius: 5em"
                                    id="productStockItem" data-toggle="pill" href="#pills-tab2" role="tab"
                                    aria-controls="pills-tab2" aria-selected="false">@trans('Stock Expiry Alert')</a>
                            </li>
                        -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">
                    <div class="table_container">
                        @include("subscription::subscription.index")
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

    </div>
</div>
