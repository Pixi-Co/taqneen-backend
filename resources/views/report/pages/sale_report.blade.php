@extends('layouts.app')
@section('title', __('business.sale'))


@section("css")
<style>
    .media-body {
        width: auto!important;
    }
</style>
@endsection

@section('content')


    <section class="content">
        <section class="sale_report">
            <div class="">
                <div class="container-fluid">
                   
                    <div class="product-items">
                        <div class="row">

                            @if(auth()->user()->can('profit_loss_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/profit-loss') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">@trans( 'report.profit_loss' )</h4>
                                                  
                                                  <span>Summary or breakdown of products and how well
                                                    they have been selling.</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if(auth()->user()->can('profit_loss_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/aging') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">@trans( 'Aging Report' )</h4>
                                                  
                                                  <span>Summary or breakdown of products and how well
                                                    they have been selling.</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @can_bt(['income_statement_report'])
                            @if(auth()->user()->can('profit_loss_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/income-statement') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">@trans( 'Income Statement Report' )</h4>
                                                  
                                                  <span>Summary or breakdown of products and how well
                                                    they have been selling.</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @endcan_bt
                            
                            @if(auth()->user()->can('purchase_n_sell_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/product-sell-report') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">{{ __('lang_v1.product_sell_report')}}</h4>
                                                  
                                                  <span>Summary or breakdown of products and how well
                                                    they have been selling.</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if(auth()->user()->can('tax_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/tax-report') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">@trans( 'report.tax_report' )</h4>
                                                  
                                                  <span>@trans( 'report.tax_report_msg' )</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if(auth()->user()->can('expense_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/expense-report') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">{{ __('report.expense_report')}}</h4>
                                                  
                                                  <span>Summary or breakdown of products and how well
                                                    they have been selling.</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if(auth()->user()->can('purchase_n_sell_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/sell-payment-report') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">{{ __('lang_v1.sell_payment_report')}}</h4>
                                                  
                                                  <span>Summary or breakdown of products and how well
                                                    they have been selling.</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if(auth()->user()->can('purchase_n_sell_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/purchase-sell') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">@trans( 'report.purchase_sell' )</h4>
                                                  
                                                  <span>@trans( 'report.purchase_sell_msg' )</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            @if(auth()->user()->can('sales_representative.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/sales-representative-report') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">{{ __('report.sales_representative')}}</h4>
                                                  
                                                  <span>Summary or breakdown of products and how well
                                                    they have been selling.</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endif

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection

@section('javascript')

@endsection
