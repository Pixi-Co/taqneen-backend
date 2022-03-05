@extends('layouts.app')
@section('title', __('report.customer') . ' - ' . __('report.supplier') . ' ' . __('report.reports'))


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

                            @if(auth()->user()->can('purchase_n_sell_report.view'))
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/reports/purchase-payment-report') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('lang_v1.purchase_payment_report')}}
                                                  </h4>
                                                  
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
                                <a target="_blank" href="{{ url('/reports/product-purchase-report') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('lang_v1.product_purchase_report')}}
                                                  </h4>
                                                  
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
