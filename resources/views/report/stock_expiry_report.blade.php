@extends('layouts.app')
@section('title', __('report.stock_expiry_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.stock_expiry_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockExpiryReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
                <div class="w3-padding">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('category_id', __('product.category') . ':') !!}
                                {!! Form::select('category', $categories, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                                {!! Form::select('sub_category', array(), null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('brand', __('product.brand') . ':') !!}
                                {!! Form::select('brand', $brands, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('unit', __('product.unit') . ':') !!}
                                {!! Form::select('unit', $units, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('view_stock_filter', __('report.view_stocks') . ':') !!}
                                {!! Form::select('view_stock_filter', $view_stock_filter, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                            </div>
                        </div>
                        @if(Module::has('Manufacturing'))
                            <div class="col-md-3">
                                <div class="form-group">
                                    <br>
                                    <div class="checkbox">
                                        <label>
                                          {!! Form::checkbox('only_mfg', 1, false, 
                                          [ 'class' => 'input-icheck', 'id' => 'only_mfg_products']); !!} {{ __('manufacturing::lang.only_mfg_products') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                <table data-title="{{ __('report.stock_expiry_report')}}" class="table table-bordered table-striped" id="stock_expiry_report_table">
                    <thead>
                        <tr>
                            <th>@trans('business.product')</th>
                            <th>SKU</th>
                            <!-- <th>@trans('purchase.ref_no')</th> -->
                            <th>@trans('business.location')</th>
                            <th>@trans('report.stock_left')</th>
                            <th>@trans('lang_v1.lot_number')</th>
                            <th>@trans('product.exp_date')</th>
                            <th>@trans('product.mfg_date')</th>
                           <!--  <th>@trans('messages.edit')</th> -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="bg-gray font-17 text-center footer-total">
                            <td colspan="3"><strong>@trans('sale.total'):</strong></td>
                            <td id="footer_total_stock_left"></td>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal fade exp_update_modal" tabindex="-1" role="dialog">
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection
