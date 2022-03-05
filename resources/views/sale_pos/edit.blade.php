@extends('layouts.app')

@section('css')
<style>


	.btn .caret {
		display: none;
	}

	.col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
		z-index: inherit!important;
	}
</style> 

@section('title', __('sale.pos_sale'))

@section('content')
<section class="content no-print">
	<input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? ''}}">
	@if(!empty($pos_settings['allow_overselling']))
		<input type="hidden" id="is_overselling_allowed">
	@endif
	@if(session('business.enable_rp') == 1)
        <input type="hidden" id="reward_point_enabled">
    @endif
    @php
		$is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
		$is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
	@endphp
	{!! Form::open(['url' => action('SellPosController@update', [$transaction->id]), 'method' => 'post', 'id' => 'edit_pos_sell_form' ]) !!}
	{{ method_field('PUT') }}
	<input type="hidden" name="cod" id="cod" value="0">
	<div class="row mb-12">
		<div class="col-md-12">
			<div class="w3-padding">
				<div class="row">
					<div class="@if(empty($pos_settings['hide_product_suggestion'])) col-md-7 @else col-md-10 col-md-offset-1 @endif no-padding pr-12">
						<div class="box box-solid mb-12 pos-border  full-height-pos">
							<div class="box-body pb-0">
								{!! Form::hidden('location_id', $transaction->location_id, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser', 'data-default_payment_accounts' => $transaction->location->default_payment_accounts]); !!}
							 
								{!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
								<input type="hidden" id="item_addition_method" value="{{$business_details->item_addition_method}}">
								@include('sale_pos.partials.pos_form_edit')
	
	
									@include('sale_pos.partials.payment_modal')
	
									@if(empty($pos_settings['disable_suspend']))
										@include('sale_pos.partials.suspend_note_modal')
									@endif
	
									@if(empty($pos_settings['disable_recurring_invoice']))
										@include('sale_pos.partials.recurring_invoice_modal')
									@endif
									
									@if(empty($pos_settings['hide_product_suggestion']) && !isMobile())
									<div class="w3-block w3-margin-bottom pos-scroll" style="height: 500px;overflow: auto">
										@include('sale_pos.partials.pos_sidebar')
									</div> 
									@endif

								</div>
							</div>
						</div>
					<div class="col-md-5 no-padding" style="z-index: 1!important" >
						<div class=" full-height-pos2 w3-block w3-margin-bottom w3-white w3-border-light-gray pos-border pos-scroll" 
						style="overflow-x: hidden;overflow-y: auto">
							@include('sale_pos.partials.pos_table')
						</div> 
						<div class="w3-white w3-round w3-padding w3-border w3-border-light-gray w3-margin-bottom pos-border">
							@include('sale_pos.partials.pos_form_totals')
						</div> 
						@include('sale_pos.partials.pos_form_actions')
					</div>
				</div>
			</div>
		</div>
	</div> 
	@include('sale_pos.partials.pos_form_actions', ['edit' => true])
	{!! Form::close() !!}
</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
@if(empty($pos_settings['hide_product_suggestion']) && isMobile())
	@include('sale_pos.partials.mobile_product_suggestions')
@endif
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

@include('sale_pos.partials.configure_search_modal')

@include('sale_pos.partials.recent_transactions_modal')

@include('sale_pos.partials.weighing_scale_modal')

@stop

@section('javascript')
	<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
	@include('sale_pos.partials.keyboard_shortcuts')

	<!-- Call restaurant module if defined -->
    @if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
    	<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
    @endif

    <!-- include module js -->
    @if(!empty($pos_module_data))
	    @foreach($pos_module_data as $key => $value)
            @if(!empty($value['module_js_path']))
                @includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
            @endif
	    @endforeach
	@endif
	

	<script>
		$(document.body).addClass('pos-body');

		function chooseProduct(modalId, replace=null) {
			if ($(modalId).find(".product_box").length > 1) {
				$(modalId).modal('show');
			} else {
				$(modalId).find(".product_box").click();
			}

			if (replace) {
				$(modalId).find(".product_box").attr('replace', replace);
			} else { 
				$(modalId).find(".product_box").attr('replace', '0');
			}
		}

		window.disable_pre_modal = true;
	</script> 
@endsection

@section('css')
	
<style>
	.main-header {
		display: none;
	}

	body {
		background: linear-gradient(-45deg, rgb(241, 245, 248), rgb(241, 245, 248))!important;
	}

	#product_list_body {
		overflow: hidden!important;
		max-height: inherit!important;
	}

	.btn .caret {
		display: none;
	}

	
	/** scroll styles **/


	/* width */
	.pos-scroll::-webkit-scrollbar {
		width: 5px!important;
		height: 8px!important;
	}


	/* Track */

	.pos-scroll::-webkit-scrollbar-track {
		background: #dedcdc94!important;
		border-radius: 5px!important;
	}


	/* Handle */

	.pos-scroll::-webkit-scrollbar-thumb {
		background: #030504!important;
		width: 5px;
		border-radius: 5px!important;
	}


	/* Handle on hover */

	.pos-scroll::-webkit-scrollbar-thumb:hover {
		background: #000000!important;
	} 
	.col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
		z-index: inherit!important;
	}
</style>
	<!-- include module css -->
    @if(!empty($pos_module_data))
        @foreach($pos_module_data as $key => $value)
            @if(!empty($value['module_css_path']))
                @includeIf($value['module_css_path'])
            @endif
        @endforeach
    @endif
@endsection
