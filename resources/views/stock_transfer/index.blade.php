@extends('layouts.app')
@section('title', __('lang_v1.stock_transfers'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@trans('lang_v1.stock_transfers')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print"> 
    @component('components.widget', ['class' => 'box-primary w3-display-container', 'title' => ''])
       

        <div class="w3-display-topright">
            <a class="add_btn" href="{{action('StockTransferController@create')}}">
            <i class="fa fa-plus"></i> @trans('messages.add')</a>
        </div>
        <br>
        <br>
        <br>
      
        <div class="table-responsive w3-light-gray">
            <table data-title="{{ __('lang_v1.all_stock_transfers') }}" class="table table-bordered table-striped ajax_view" id="stock_transfer_table">
                <thead>
                    <tr>
                        <th>@trans('messages.date')</th>
                        <th>@trans('purchase.ref_no')</th>
                        <th>@trans('lang_v1.location_from')</th>
                        <th>@trans('lang_v1.location_to')</th>
                        <th>@trans('sale.status')</th>
                        <th>@trans('lang_v1.shipping_charges')</th>
                        <th>@trans('stock_adjustment.total_amount')</th>
                        <th>@trans('purchase.additional_notes')</th>
                        <th>@trans('messages.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent
</section>

@include('stock_transfer.partials.update_status_modal')

<section id="receipt_section" class="print_section"></section>

<!-- /.content -->
@stop
@section('javascript')
	<script src="{{ asset('js/stock_transfer.js?v=' . $asset_v) }}"></script>
@endsection