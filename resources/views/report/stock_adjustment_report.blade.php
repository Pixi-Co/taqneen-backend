@extends('layouts.app')
@section('title', __( 'report.stock_adjustment_report' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans( 'report.stock_adjustment_report' )
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6 col-xs-6">
            <div class="input- "> 
                 <select class="form-control select2" id="stock_adjustment_location_filter">
                    @foreach($business_locations as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 col-xs-6">
            <div class="form-group ">
                <div class="input- ">
                  <button type="button" class="btn btn-primary" id="stock_adjustment_date_filter">
                    <span>
                      <i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-6">
            @component('components.widget')
                <div class=" ">
                    <table data-title="{{ __('report.stock_adjustment_report') }}" class="table no-border">
                        <tr>
                            <th>{{ __('report.total_normal') }}:</th>
                            <td>
                                <span class="total_normal">
                                    <i class="fas fa-sync fa-spin fa-fw"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('report.total_abnormal') }}:</th>
                            <td>
                                 <span class="total_abnormal">
                                    <i class="fas fa-sync fa-spin fa-fw"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('report.total_stock_adjustment') }}:</th>
                            <td>
                                <span class="total_amount">
                                    <i class="fas fa-sync fa-spin fa-fw"></i>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            @endcomponent
        </div>

        <div class="col-sm-6">
            @component('components.widget')
                <table class="table no-border">
                    <tr>
                        <th>{{ __('report.total_recovered') }}:</th>
                        <td>
                             <span class="total_recovered">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                </table>
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @component('components.widget', ['class' => 'box-primary', 'title' => __('stock_adjustment.stock_adjustments')])
                <div class="table-responsive w3-light-gray">
                    <table data-title="{{ __('stock_adjustment.stock_adjustments') }}" class="table table-bordered table-striped" id="stock_adjustment_table">
                        <thead>
                            <tr>
                                <th>@trans('messages.action')</th>
                                <th>@trans('messages.date')</th>
                                <th>@trans('purchase.ref_no')</th>
                                <th>@trans('business.location')</th>
                                <th>@trans('stock_adjustment.adjustment_type')</th>
                                <th>@trans('stock_adjustment.total_amount')</th>
                                <th>@trans('stock_adjustment.total_amount_recovered')</th>
                                <th>@trans('stock_adjustment.reason_for_stock_adjustment')</th>
                                <th>@trans('lang_v1.added_by')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>
	

</section>
<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/stock_adjustment.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection
