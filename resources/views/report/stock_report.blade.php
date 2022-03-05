@extends('layouts.app')
@section('title', __('report.stock_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('report.stock_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
               <div class="w3-padding">
                   <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                            {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    @canaccessmodule('category')
    
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('category_id', __('category.category') . ':') !!}
                            {!! Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                        </div>
                    </div>
                @endcanaccessmodule
                    @canaccessmodule('sub_category')
    
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                            {!! Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
                        </div>
                    </div>
                    @endcanaccessmodule
    
                    @canaccessmodule('brand')
    
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('brand', __('product.brand') . ':') !!}
                            {!! Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    @endcanaccessmodule
    
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('unit',__('product.unit') . ':') !!}
                            {!! Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    @if($show_manufacturing_data)
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
        <div class="col-md-3">
            <div class="box text-center w3-text-gray">
                <br>
                <b>@trans('report.closing_stock') (@trans('lang_v1.by_purchase_price'))</b>
                <br>
                <br>
                <h3 id="closing_stock_by_pp" class="mb-0 mt-0 w3-text-deep-orange w3-xlarge"></h3>
                <br>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box  text-center w3-text-gray">
                <br>
                <b>@trans('report.closing_stock') (@trans('lang_v1.by_sale_price'))</b>
                <br>
                <br>
                <h3 id="closing_stock_by_sp" class="mb-0 mt-0 w3-text-deep-orange w3-xlarge"></h3>
                <br>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box text-center w3-text-gray">
                <br>
                <b>@trans('lang_v1.potential_profit')</b>
                <br>
                <br>
                <h3 id="potential_profit" class="mb-0 mt-0 w3-text-deep-orange w3-xlarge"></h3>
                <br>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box text-center w3-text-gray">
                <br>
                <b>@trans('lang_v1.profit_margin')</b>
                <br>
                <br>
                <h3 id="profit_margin" class="mb-0 mt-0 w3-text-deep-orange w3-xlarge"></h3>
                <br>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-solid'])
                @include('report.partials.stock_report_table')
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection
