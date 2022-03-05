@extends('layouts.app')
@section('title', __('purchase.add_purchase'))


@section("css")
<style>
	.pr-card {
		background-color: #fff;
		box-shadow: 0 10px 20px rgb(0 0 0 / 10%);
		padding: 30px;
		border-radius: 7px;
		margin: 10px 0;
		height: 300px; 
		color: gray;
	}
</style>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans('purchase.add_purchase') <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('purchase.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i></h1>
</section>

<!-- Main content -->
<section class="content">

	<!-- Page level currency setting -->
	<input type="hidden" id="p_code" value="{{$currency_details->code}}">
	<input type="hidden" id="p_symbol" value="{{$currency_details->symbol}}">
	<input type="hidden" id="p_thousand" value="{{$currency_details->thousand_separator}}">
	<input type="hidden" id="p_decimal" value="{{$currency_details->decimal_separator}}">

	@include('layouts.partials.error')

	{!! Form::open(['url' => action('PurchaseController@store'), 'method' => 'post', 'id' => 'add_purchase_form', 'files' => true ]) !!}
	@component('components.widget', ['class' => 'box-primary w3-padding'])
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if(!empty($default_purchase_status)) - @else - @endif">
				<div class="form-group">
					{!! Form::label('supplier_id', __('purchase.supplier') . ':*') !!}
					<div class="input-group"> 
						{!! Form::select('contact_id',$suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
						<span class="input-group-btn">
							<button type="button" style="margin-left: 4px" class="add_new_supplier btn add_select_btn w3-round btn-modal new-theme" data-name="">
								<i class="fa fa-plus-circle text-primary fa-lg w3-text-white"></i></button>
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if(!empty($default_purchase_status)) - @else - @endif">
				<div class="form-group">
					{!! Form::label('ref_no', __('purchase.ref_no').':') !!}
					{!! Form::text('ref_no', null, ['class' => 'form-control']); !!}
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if(!empty($default_purchase_status)) - @else c @endif">
				<div class="form-group">
					{!! Form::label('transaction_date', __('purchase.purchase_date') . ':*') !!}
					<div class="input-"> 
						{!! Form::text('transaction_date', @format_datetime('now'), ['class' => 'form-control', 'readonly', 'required']); !!}
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 w3-padding  @if(!empty($default_purchase_status)) hide @endif">
				<div class="form-group">
					{!! Form::label('status', __('purchase.purchase_status') . ':*') !!} @show_tooltip(__('tooltip.order_status'))
					{!! Form::select('status', $orderStatuses, $default_purchase_status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
				</div>
			</div>
 
			
			@if(count($business_locations) == 1)
				@php 
					$default_location = current(array_keys($business_locations->toArray()));
					$search_disable = false; 
				@endphp
			@else
				@php $default_location = null;
				$search_disable = true;
				@endphp
			@endif
			<div class="col-lg-4 col-md-4 col-sm-6 w3-padding ">
				<div class="form-group">
					{!! Form::label('location_id', __('purchase.business_location').':*') !!}
					@show_tooltip(__('tooltip.purchase_location'))
					{!! Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'], $bl_attributes); !!}
				</div>
			</div>

			<!-- Currency Exchange Rate -->
			<div class="col-lg-4 col-md-4 col-sm-6 w3-padding  @if(!$currency_details->purchase_in_diff_currency) hide @endif">
				<div class="form-group">
					{!! Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*') !!}
					@show_tooltip(__('tooltip.currency_exchange_factor'))
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-info"></i>
						</span>
						{!! Form::number('exchange_rate', $currency_details->p_exchange_rate, ['class' => 'form-control', 'required', 'step' => 0.001]); !!}
					</div>
					<span class="help-block text-danger">
						@trans('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name])
					</span>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
		          <div class="form-group">
		            <div class="multi-input">
		              {!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!} @show_tooltip(__('tooltip.pay_term'))
		              <br/>
		              {!! Form::number('pay_term_number', null, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]); !!}

		              {!! Form::select('pay_term_type', 
		              	['months' => __('lang_v1.months'), 
		              		'days' => __('lang_v1.days')], 
		              		null, 
		              	['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select'), 'id' => 'pay_term_type']); !!}
		            </div>
		        </div>
		    </div>

			<div class="col-lg-12 col-md-12 col-sm-12 w3-padding">
                <div class="form-group">
                    {!! Form::label('document', __('purchase.attach_document') . ':') !!}
                    {!! Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
                    <p class="help-block">
                    	@trans('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                    	@includeIf('components.document_help_text')
                    </p>
                </div>
            </div>
		</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary w3-padding'])
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 w3-padding">
				<div class="form-group">
					<div class="input-group">
						{!! Form::text('search_product', null, ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => $search_disable]); !!}
						<span 
						style="margin: 3px!important;border-radius: 5px!important;color:white!important"
						class="w3-round w3-green input-group-addon w3-round w3-border-0 w3-light-gray">
							<i class="fa fa-search"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 w3-padding text-right">
				<div class="form-group">
					<button tabindex="-1" type="button" class="btn btn-link btn-modal"data-href="{{action('ProductController@quickAdd')}}" 
            	data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> @trans( 'product.add_new_product' ) </button>
				</div>
			</div>
		</div>
		@php
			$hide_tax = '';
			if( session()->get('business.enable_inline_tax') == 0){
				$hide_tax = 'hide';
			}
		@endphp
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-condensed table-bordered text-center table-striped" id="purchase_entry_table">
						<thead>
							<tr class="w3-white" >
								<th>#</th>
								<th>@trans( 'product.product_name' )</th>
								<th>@trans( 'purchase.purchase_quantity' )</th>
								<th>@trans( 'lang_v1.unit_cost_before_discount' )</th>
								<th>@trans( 'lang_v1.discount_percent' )</th>
								<th>@trans( 'purchase.unit_cost_before_tax' )</th>
								<th class="{{$hide_tax}}">@trans( 'purchase.subtotal_before_tax' )</th>
								<th class="{{$hide_tax}}">@trans( 'purchase.product_tax' )</th>
								<th class="{{$hide_tax}}">@trans( 'purchase.net_cost' )</th>
								<th>@trans( 'purchase.line_total' )</th>
								<th class="@if(!session('business.enable_editing_product_from_purchase')) hide @endif">
									@trans( 'lang_v1.profit_margin' )
								</th>
								<th>
									@trans( 'purchase.unit_selling_price' )
									<small>(@trans('product.inc_of_tax'))</small>
								</th>
								@if(session('business.enable_lot_number'))
									<th>
										@trans('lang_v1.lot_number')
									</th>
								@endif
								@if(session('business.enable_product_expiry'))
									<th>
										@trans('product.mfg_date') / @trans('product.exp_date')
									</th>
								@endif
								<th><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody class="w3-light-gray" ></tbody>
					</table>
				</div>
				<hr/>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 w3-padding">
						@trans( 'lang_v1.total_items' ): <span id="total_quantity" class="display_currency" data-currency_symbol="false"></span>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 w3-padding">
						@trans( 'purchase.net_total_amount' ): <span id="total_subtotal" class="display_currency"></span>
						<!-- This is total before purchase tax-->
						<input type="hidden" id="total_subtotal_input" value=0  name="total_before_tax">
					</div>

					<table class="pull-right col-md-12 hidden"> 
						<tr class="hide">
							<th class="col-md-7 text-right">@trans( 'purchase.total_before_tax' ):</th>
							<td class="col-md-5 text-left">
								<span id="total_st_before_tax" class="display_currency"></span>
								<input type="hidden" id="st_before_tax_input" value=0>
							</td>
						</tr> 
					</table>
				</div>

				<input type="hidden" id="row_count" value="0">
			</div>
		</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary'])
		<div class="w3-padding">
			<div class="row">
				<div class="col-lg-12 text-center">
					<b class="w3-large w3-text-gray">@trans( 'purchase.discount' )</b>
					<br>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 w3-padding">
					<div class="pr-card">
						<br>
						<div class="form-group">
							{!! Form::label('discount_type', __( 'purchase.discount_type' ) . ':') !!}
							{!! Form::select('discount_type', [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], '', ['class' => 'form-control select2']); !!}
						</div>
						<div class="form-group">
						{!! Form::label('discount_amount', __( 'purchase.discount_amount' ) . ':') !!}
						{!! Form::text('discount_amount', 0, ['class' => 'form-control input_number', 'required']); !!}
						</div>
						<div class="w3-block w3-margin text-center"> 
							<b>@trans( 'purchase.discount' ):</b>(-) 
							<span id="discount_calculated_amount" class="display_currency">0</span>
						</div>
					</div>
				</div>
				 
				<div class="col-lg-4 col-md-4 col-sm-4 w3-padding">
					<div class="pr-card">
						<br>
						<div class="form-group">
							{!! Form::label('tax_id', __('purchase.purchase_tax') . ':') !!}
							<select name="tax_id" id="tax_id" class="form-control select2" placeholder="'Please Select'">
								<option value="" data-tax_amount="0" data-tax_type="fixed" selected>@trans('lang_v1.none')</option>
								@foreach($taxes as $tax)
									<option value="{{ $tax->id }}" data-tax_amount="{{ $tax->amount }}" data-tax_type="{{ $tax->calculation_type }}">{{ $tax->name }}</option>
								@endforeach
							</select>
							{!! Form::hidden('tax_amount', 0, ['id' => 'tax_amount']); !!}
							</div>
						<div class="w3-block w3-margin text-center"> 
							<b>@trans( 'purchase.purchase_tax' ):</b>(+) 
							<span id="tax_calculated_amount" class="display_currency">0</span>
						</div>
					</div>
				</div>
				 
				<div class="col-lg-4 col-md-4 col-sm-4 w3-padding">
					<div class="pr-card">
						<br>
						<div class="form-group">
						{!! Form::label('shipping_details', __( 'purchase.shipping_details' ) . ':') !!}
						{!! Form::text('shipping_details', null, ['class' => 'form-control']); !!}
						</div>
						<div class="form-group">
						{!! Form::label('shipping_charges','(+) ' . __( 'purchase.additional_shipping_charges' ) . ':') !!}
						{!! Form::text('shipping_charges', 0, ['class' => 'form-control input_number', 'required']); !!}
						</div>
						<div class="w3-block w3-margin text-center"> 
							{!! Form::hidden('final_total', 0 , ['id' => 'grand_total_hidden']); !!}
							<b>@trans('purchase.purchase_total'): </b><span id="grand_total" class="display_currency" data-currency_symbol='true'>0</span>
						</div>
					</div>
				</div>
	
				<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
								{!! Form::label('additional_notes',__('purchase.additional_notes')) !!}
								{!! Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]); !!}
							</div>
					</div>
					
					@php
						$custom_labels = json_decode(session('business.custom_labels'), true); 
						$customPurchase = isset($custom_labels['purchase'])? $custom_labels['purchase'] : [];
					@endphp 
					@foreach ($customPurchase as $key => $value)
					@if ($value)
					<div class="col-md-3">
						<div class="form-group">
							{!! Form::label($key, __($value) . ':') !!}
							{!! Form::text($key, null, ['class' => 'form-control', 
								'placeholder' => __($value)]); !!}
						</div>
					</div>
					@endif
					@endforeach
				</div>
				<table class="table">
				 
				 
					<tr>
						<td colspan="4">
							
						</td>
					</tr>
	
				</table>
				</div>
			</div>
		</div>
	@endcomponent

	@component('components.widget', ['class' => 'box-primary w3-padding', 'title' => ''])
		<div class="text-center w3-large w3-text-gray">
			<b>{{ __('purchase.add_payment') }}</b>
		</div>
		<br>
		<div class="box-body payment_row">
			<div class="row">
				<div class="col-md-12">
					<strong>@trans('lang_v1.advance_balance'):</strong> <span id="advance_balance_text">0</span>
					{!! Form::hidden('advance_balance', null, ['id' => 'advance_balance', 'data-error-msg' => __('lang_v1.required_advance_balance_not_available')]); !!}
				</div>
			</div>
			@include('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true])
			<hr>
			<div class="row">
				<div class="col-sm-12">
					<div class="pull-right"><strong>@trans('purchase.payment_due'):</strong> <span id="payment_due">0.00</span></div>
				</div>
			</div>
		</div>
	@endcomponent 
	<center class="w3-padding" >
		<button type="button" id="submit_purchase_form" style="float: none" class="btn btn-primary add_btn">@trans('messages.save')</button>
	</center>

{!! Form::close() !!}
</section>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
<!-- /.content -->
@endsection

@section('javascript')
	<script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
	<script type="text/javascript">
		$(document).ready( function(){
      		__page_leave_confirmation('#add_purchase_form');
      		$('.paid_on').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });
    	});
    	$(document).on('change', '.payment_types_dropdown, #location_id', function(e) {
		    var default_accounts = $('select#location_id').length ? 
		                $('select#location_id')
		                .find(':selected')
		                .data('default_payment_accounts') : [];
		    var payment_types_dropdown = $('.payment_types_dropdown');
		    var payment_type = payment_types_dropdown.val();
		    var payment_row = payment_types_dropdown.closest('.payment_row');
	        var row_index = payment_row.find('.payment_row_index').val();

	        var account_dropdown = payment_row.find('select#account_' + row_index);
		    if (payment_type && payment_type != 'advance') {
		        var default_account = default_accounts && default_accounts[payment_type]['account'] ? 
		            default_accounts[payment_type]['account'] : '';
		        if (account_dropdown.length && default_accounts) {
		            account_dropdown.val(default_account);
		            account_dropdown.change();
		        }
		    }

		    if (payment_type == 'advance') {
		        if (account_dropdown) {
		            account_dropdown.prop('disabled', true);
		            account_dropdown.closest('.form-group').addClass('hide');
		        }
		    } else {
		        if (account_dropdown) {
		            account_dropdown.prop('disabled', false); 
		            account_dropdown.closest('.form-group').removeClass('hide');
		        }    
		    }
		});
	</script>
	@include('purchase.partials.keyboard_shortcuts')
@endsection
