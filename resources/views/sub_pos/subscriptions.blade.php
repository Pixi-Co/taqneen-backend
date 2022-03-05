@extends('layouts.app')
@section('title', __( 'lang_v1.subscriptions'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@trans( 'lang_v1.subscriptions') @show_tooltip(__('lang_v1.recurring_invoice_help'))</h1>
</section>

<!-- Main content -->
<section class="content no-print">
	<div class="w3-white w3-round w3-padding"> 
        <div class="box-">
            @can('sell.view')
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('subscriptions_filter_date_range', __('report.date_range') . ':') !!}
                            {!! Form::text('subscriptions_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                        </div>
                    </div>
                </div>
                @include('sub_pos.partials.subscriptions_table')
            @endcan
        </div>
    </div>
</section>
@stop

@section('javascript')
@include('sub_pos.partials.subscriptions_table_javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection