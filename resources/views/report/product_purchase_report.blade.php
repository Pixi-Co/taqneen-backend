@extends('layouts.app')
@section('title', __('lang_v1.product_purchase_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('lang_v1.product_purchase_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
          {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'product_purchase_report_form' ]) !!}
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
                            {!! Form::label('supplier_id', __('purchase.supplier') . ':') !!}
                            <div class="input- "> 
                                {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
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
        
                            {!! Form::label('product_pr_date_filter', __('report.date_range') . ':') !!}
                            {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'product_pr_date_filter', 'readonly']); !!}
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
            @component('components.widget', ['class' => 'box-primary'])
                <div class="table-responsive w3-light-gray">
                    <table data-title="{{ __('lang_v1.product_purchase_report')}}" class="table table-bordered table-striped" 
                    id="product_purchase_report_table">
                        <thead>
                            <tr>
                                <th>@trans('sale.product')</th>
                                <th>@trans('product.sku')</th>
                                <th>@trans('purchase.supplier')</th>
                                <th>@trans('purchase.ref_no')</th>
                                <th>@trans('messages.date')</th>
                                <th>@trans('sale.qty')</th>
                                <th>@trans('lang_v1.total_unit_adjusted')</th>
                                <th>@trans('lang_v1.unit_perchase_price')</th>
                                <th>@trans('sale.subtotal')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="5"><strong>@trans('sale.total'):</strong></td>
                                <td id="footer_total_purchase"></td>
                                <td id="footer_total_adjusted"></td>
                                <td></td>
                                <td><span class="display_currency" id="footer_subtotal" data-currency_symbol ="true"></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcomponent
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
