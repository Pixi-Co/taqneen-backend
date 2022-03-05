@extends('layouts.app')
@section('title', __( 'report.purchase_sell' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans( 'report.purchase_sell' )
        <small>@trans( 'report.purchase_sell_msg' )</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2>{{session()->get('business.name')}} - @trans( 'report.purchase_sell' )</h2></div>
    <div class="row no-print">
        <div class="col-md-6 col-xs-6">
            <div class="input- "> 
                 <select class="form-control select2" id="purchase_sell_location_filter">
                    @foreach($business_locations as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-xs-6">
            <div class="form-group ">
                <div class="input- ">
                  <button type="button" class="btn btn-primary" id="purchase_sell_date_filter">
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
        <div class="col-xs-6">
            @component('components.widget', ['title' => __('purchase.purchases')])
                <table class="table table-striped">
                    <tr>
                        <th>{{ __('report.total_purchase') }}:</th>
                        <td>
                            <span class="total_purchase">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('report.purchase_inc_tax') }}:</th>
                        <td>
                             <span class="purchase_inc_tax">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('lang_v1.total_purchase_return_inc_tax') }}:</th>
                        <td>
                             <span class="purchase_return_inc_tax">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('report.purchase_due') }}: @show_tooltip(__('tooltip.purchase_due'))</th>
                        <td>
                             <span class="purchase_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                </table>
            @endcomponent
        </div>

        <div class="col-xs-6">
            @component('components.widget', ['title' => __('sale.sells')])
                <table class="table table-striped">
                    <tr>
                        <th>{{ __('report.total_sell') }}:</th>
                        <td>
                            <span class="total_sell">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('report.sell_inc_tax') }}:</th>
                        <td>
                             <span class="sell_inc_tax">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('lang_v1.total_sell_return_inc_tax') }}:</th>
                        <td>
                             <span class="total_sell_return">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('report.sell_due') }}: @show_tooltip(__('tooltip.sell_due'))</th>
                        <td>
                            <span class="sell_due">
                                <i class="fas fa-sync fa-spin fa-fw"></i>
                            </span>
                        </td>
                    </tr>
                </table>
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box w3-padding w3-round text-center" style="height: 150px" >
                <br>
                <b class="w3-text-gray">
                    {{ __('report.sell_minus_purchase') }}
                </b>
                <br>
                <span class="sell_minus_purchase w3-xxlarge w3-text-deep-orange">
                    <i class="fas fa-sync fa-spin fa-fw"></i>
                </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box w3-padding w3-round text-center" style="height: 150px" >
                <br>
                <b class="w3-text-gray">
                    {{ __('report.difference_due') }}
                </b>
                <br> 
                <span class="difference_due w3-xxlarge w3-text-deep-orange">
                    <i class="fas fa-sync fa-spin fa-fw"></i>
                </span>
            </div>
        </div>
        <div class="col-xs-12 hidden">
            @component('components.widget')
                @slot('title')
                    {{ __('lang_v1.purchase_sell_report_formula') }}  
                    @show_tooltip(__('tooltip.over_all_sell_purchase'))
                @endslot
                <h3 class="text-muted">
                    {{ __('report.sell_minus_purchase') }}: 
                    
                </h3>

                <h3 class="text-muted">
                    : 
                    <span class="difference_due">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
            @endcomponent
        </div>
    </div>
    <div class="row no-print">
        <div class="col-sm-12 text-center">
            <button type="button" class="btn btn-primary " 
            aria-label="Print" onclick="window.print();"
            ><i class="fa fa-print"></i> @trans( 'messages.print' )</button>
        </div>
    </div>
	

</section>
<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>

@endsection
