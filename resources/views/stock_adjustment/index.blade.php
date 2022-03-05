@extends('layouts.app')
@section('title', __('stock_adjustment.stock_adjustments'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans('stock_adjustment.stock_adjustments')
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary w3-display-container', 'title' => ''])
         
            <div class="w3-display-topright">
                <a class="add_btn" href="{{action('StockAdjustmentController@create')}}">
                <i class="fa fa-plus"></i> @trans('messages.add')</a>
            </div>
            <br>
            <br>
            <br>
            
        <div class="table-responsive w3-light-gray">
            <table data-title="{{ __('stock_adjustment.all_stock_adjustments') }}" 
            class="table table-bordered table-striped ajax_view" id="stock_adjustment_table">
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

</section>
<!-- /.content -->
@stop
@section('javascript')
	<script src="{{ asset('js/stock_adjustment.js?v=' . $asset_v) }}"></script>
@endsection