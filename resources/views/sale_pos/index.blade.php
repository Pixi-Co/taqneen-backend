@extends('layouts.app')
@section('title', __( 'sale.list_pos'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@trans('sale.pos_sale')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">


    <div class="text-right">
        <button class="add_btn" onclick="$('.filter').slideToggle(500)" >
            <i class="fa fa-filter"></i> {{ __('report.filters') }}
        </button>
    </div>
    <br>
    <div class="filter w3-round w3-white w3-padding" style="display: none" >
        <div class="row">
            @include('sell.partials.sell_list_filters')
        </div>
    </div> 
    <br>

    @component('components.widget', ['class' => 'box-primary w3-padding w3-display-container', 'title' => ''])
        @can('sell.create') 
                <div class="w3-display-topright">
                    <a class="add_btn" href="{{action('SellPosController@create')}}">
                    <i class="fa fa-plus"></i> @trans('messages.add')</a>
                </div> 
                <br>
                <br>
                <br>
        @endcan
        @can('sell.view')
            <input type="hidden" name="is_direct_sale" id="is_direct_sale" value="0">
            @include('sale_pos.partials.sales_table')
        @endcan
    @endcomponent
</section>
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->


@stop

@section('javascript')
@include('sale_pos.partials.sale_table_javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection