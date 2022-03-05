@extends('layouts.app')
@section('title', __('report.sales_representative'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.sales_representative')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'sales_representative_filter_form' ]) !!}
                <div class="w3-padding">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('sr_id',  __('report.user') . ':') !!}
                                {!! Form::select('sr_id', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_users')]); !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('sr_business_id',  __('business.business_location') . ':') !!}
                                {!! Form::select('sr_business_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
        
                        <div class="col-md-3">
                            <div class="form-group">
        
                                {!! Form::label('sr_date_filter', __('report.date_range') . ':') !!}
                                {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sr_date_filter', 'readonly']); !!}
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>

    <!-- Summary -->
    <div class="row">
        <div class="col-md-6">
            <div class="box text-center w3-padding w3-text-gray">
                <br>
                <b>
                    {{ __('report.total_sell') }} - {{ __('lang_v1.total_sales_return') }}:
                </b>
                <div class="w3-text-deep-orange w3-xlarge">
                    <span id="sr_total_sales" class=" w3-xlarge">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                    -
                    <span id="sr_total_sales_return" class=" w3-xlarge">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                    =
                    <span id="sr_total_sales_final" class=" w3-xlarge">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box text-center w3-padding w3-text-gray">
                <br>
                <b>
                    {{ __('report.total_expense') }}: 
                </b>
                <div class="w3-text-deep-orange w3-xlarge">
                    <span id="sr_total_expenses" class=" w3-xlarge" >
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 hidden">
            @component('components.widget', ['title' => __('report.summary')])
                <h3 class="text-muted">
                     
                    
                </h3>
                <div class="hide" id="total_commission_div">
                    <h3 class="text-muted">
                        {{ __('lang_v1.total_sale_commission') }}: 
                        <span id="sr_total_commission">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                    </h3>
                </div>
                <h3 class="text-muted">
                    
                    
                </h3>
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-pills  setting-tabs w3-block w3-padding">
                    <!--
                    <li  class="nav-item hidden"  >
                        <a class="nav-link" href="#sr_sales_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> @trans('lang_v1.sales_added')</a>
                    </li>
                    -->

                    <li  class="nav-item active">
                        <a class="nav-link" href="#sr_commission_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> @trans('lang_v1.sales_with_commission')</a>
                    </li>

                    <!--
                    <li class="nav-item hidden">
                        <a class="nav-link" href="#sr_expenses_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> @trans('expense.expenses')</a>
                    </li>
                -->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="sr_sales_tab">
                        @include('report.partials.sales_representative_sales')
                    </div>

                    <div class="tab-pane active" id="sr_commission_tab">
                        @include('report.partials.sales_representative_commission')
                    </div>

                    <div class="tab-pane" id="sr_expenses_tab">
                        @include('report.partials.sales_representative_expenses')
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection
