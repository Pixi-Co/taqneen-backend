@extends('layouts.app')
@section('title', __('subscription reports'))


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

                            @can_bt(['subscription.attendance'])
                            @can('subscription.report.attendances')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/sub/report/attendance') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('attendance report')}}
                                                  </h4>
                                                  
                                                  <span>@trans('attendance report sub title')</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endcan
                            @endcan_bt

                            @can_bt(['subscription.trainer_report'])
                            @can('subscription.report.trainers')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/sub/report/trainer') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('trainer report')}}
                                                  </h4>
                                                  
                                                  <span>@trans('trainer report sub title')</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endcan

                            @can('subscription.report.trainer_percents')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/sub/report/trainer-percents') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('trainer percents report')}}
                                                  </h4>
                                                  
                                                  <span>@trans('trainer percents report sub title')</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endcan

                            @endcan_bt
 
                            @can_bt(['subscription.subscription_report'])
                            @can('subscription.report.subscriptions')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/sub/report/subscription') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('subscription report')}}
                                                  </h4>
                                                  
                                                  <span>@trans('subscription report sub title')</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endcan
                            @endcan_bt
 
                            @can_bt(['subscription.measurement_report'])
                            @can('subscription.report.measurements')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/sub/report/measurement') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('measurement report')}}
                                                  </h4>
                                                  
                                                  <span>@trans('measurement report sub title')</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endcan
                            @endcan_bt
                            

                            @can_bt(['subscription.rate_report'])
                            @can('subscription.report.rates')
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <a target="_blank" href="{{ url('/sub/report/rate') }}" class="productCard panel zoom-in">
                                    <div class="card-content">
                                        <div class="card-body"> 
                                            <div class="media w3-display-container">
                                                <div class="media-left card_img">  
                                                    <img src="{{ url('/images/icons/business-report.svg') }}" />  
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">
                                                    {{ __('rates report')}}
                                                  </h4>
                                                  
                                                  <span>@trans('rates report sub title')</span>

                                                    
                                                    <div class="w3-display-topright w3-padding"> 
                                                        <i class="fas fa-angle-double-right green_title"></i>
                                                    </div>
                                                </div>
                                              </div> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endcan
                            @endcan_bt
  
                             
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection

@section('javascript')

@endsection
