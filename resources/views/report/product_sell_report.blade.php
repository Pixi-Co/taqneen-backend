@extends('layouts.app')
@section('title', __('lang_v1.product_sell_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>{{ __('lang_v1.product_sell_report')}}</h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'product_sell_report_form' ]) !!}
                <div class="w3-padding">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            {!! Form::label('search_product', __('lang_v1.search_product') . ':') !!}
                                <div class="input- "> 
                                    <input type="hidden" value="" id="variation_id">
                                    {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('customer_id', __('contact.customer') . ':') !!}
                                <div class="input- "> 
                                    {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('location_id', __('purchase.business_location').':') !!}
                                <div class="input- "> 
                                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('product_sr_date_filter', __('report.date_range') . ':') !!}
                                {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'product_sr_date_filter', 'readonly']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('product_sr_start_time', __('lang_v1.time_range') . ':') !!}
                            @php
                                $startDay = Carbon::now()->startOfDay();
                                $endDay   = $startDay->copy()->endOfDay();
                            @endphp
                            <div class="form-group">
                                {!! Form::text('start_time', @format_time($startDay), ['style' => __('lang_v1.select_a_date_range'), 'class' => 'form-control width-50 f-left', 'id' => 'product_sr_start_time']); !!}
                                {!! Form::text('end_time', @format_time($endDay), ['class' => 'form-control width-50 f-left', 'id' => 'product_sr_end_time']); !!}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-pills  setting-tabs w3-block w3-padding">
                    <li class="nav-item active" onclick="editDatatable()" >
                        <a class="nav-link" href="#psr_detailed_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list" aria-hidden="true"></i> @trans('lang_v1.detailed')</a>
                    </li>
                    <li class="nav-item" onclick="editDatatable()" >
                        <a class="nav-link" href="#psr_detailed_with_purchase_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list" aria-hidden="true"></i> @trans('lang_v1.detailed_with_purchase')</a>
                    </li>
                    <li class="nav-item" onclick="editDatatable()" >
                        <a class="nav-link" href="#psr_grouped_tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i> @trans('lang_v1.grouped')</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="psr_detailed_tab">
                        <div class="table-responsive w3-light-gray">
                            <table data-title="@trans('lang_v1.detailed')" class="table table-bordered table-striped" 
                            id="product_sell_report_table">
                                <thead>
                                    <tr>
                                        <th>@trans('sale.product')</th>
                                        <th>@trans('product.sku')</th>
                                        <th>@trans('sale.customer_name')</th>
                                        <th>@trans('lang_v1.contact_id')</th>
                                        <th>@trans('sale.invoice_no')</th>
                                        <th>@trans('messages.date')</th>
                                        <th>@trans('sale.qty')</th>
                                        <th>@trans('sale.unit_price')</th>
                                        <th>@trans('sale.discount')</th>
                                        <th>@trans('sale.tax')</th>
                                        <th>@trans('sale.price_inc_tax')</th>
                                        <th>@trans('sale.total')</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="6"><strong>@trans('sale.total'):</strong></td>
                                        <td id="footer_total_sold"></td>
                                        <td></td>
                                        <td></td>
                                        <td id="footer_tax"></td>
                                        <td></td>
                                        <td><span class="display_currency" id="footer_subtotal" data-currency_symbol ="true"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="psr_detailed_with_purchase_tab">
                        <div class="table-responsive w3-light-gray">
                            @if(session('business.enable_lot_number'))
                                <input type="hidden" id="lot_enabled">
                            @endif
                            <table data-title="@trans('lang_v1.detailed_with_purchase')" class="table table-bordered table-striped" 
                            id="product_sell_report_with_purchase_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@trans('sale.product')</th>
                                        <th>@trans('product.sku')</th>
                                        <th>@trans('sale.customer_name')</th>
                                        <th>@trans('sale.invoice_no')</th>
                                        <th>@trans('messages.date')</th>
                                        <th>@trans('lang_v1.purchase_ref_no')</th>
                                        <th>@trans('lang_v1.lot_number')</th>
                                        <th>@trans('lang_v1.supplier_name')</th>
                                        <th>@trans('sale.qty')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="psr_grouped_tab">
                        <div class="table-responsive w3-light-gray">
                            <table data-title="@trans('lang_v1.grouped')" class="table table-bordered table-striped" 
                            id="product_sell_grouped_report_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>@trans('sale.product')</th>
                                        <th>@trans('product.sku')</th>
                                        <th>@trans('messages.date')</th>
                                        <th>@trans('report.current_stock')</th>
                                        <th>@trans('report.total_unit_sold')</th>
                                        <th>@trans('sale.total')</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="bg-gray font-17 footer-total text-center">
                                        <td colspan="4"><strong>@trans('sale.total'):</strong></td>
                                        <td id="footer_total_grouped_sold"></td>
                                        <td><span class="display_currency" id="footer_grouped_subtotal" data-currency_symbol ="true"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection
