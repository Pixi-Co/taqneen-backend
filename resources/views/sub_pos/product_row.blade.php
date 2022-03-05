<tr class="product_row product-row-number-{{$row_count}}" data-row_index="{{$row_count}}">
	<td>
		@php 
			$productItem = App\Product::find($product->product_id);
 
			$p = App\Variation::find($product->variation_id);

			if (!$p)
				$p = $productItem;

			$product_name = $product->product_name . '<br/>' . $product->sub_sku ;
			if(!empty($product->brand)){ $product_name .= ' ' . $product->brand ;}
 
		@endphp

		

		@if( ($edit_price || $edit_discount) && empty($is_direct_sell) )
		<div title="@trans('lang_v1.pos_edit_product_price_help')" class=" w3-text-dark-gray" > 
			<img 
			src="
			@if(count($p->media) > 0)
				{{$p->media->first()->display_url}}
			@elseif(!empty($p->product_image))
				{{asset('/uploads/img/' . rawurlencode($p->product_image))}}
			@else
				@php
					$image = optional(App\Product::find($product->product_id))->image_url;
				@endphp
				{{ $image? $image : asset('/img/product-default-image.jpg')}}
			@endif" 
			style="width: 50px;height: 50px;border-radius: 5em">
			
			<b style="padding: 5px" >{!! $product_name !!}
				<span 
		class="text-link text-info cursor-pointer w3-text-dark-gray" 
		data-toggle="modal" data-target="#row_edit_product_price_modal_{{$row_count}}">
			<i class="fa fa-edit"></i>
			<!--
				{!! $product_name !!}
			&nbsp;<i class="fa fa-info-circle"></i>
			-->
		</span>
			</b>

		
		</div>
		@else
			{!! $product_name !!}
		@endif
		<input type="hidden" class="enable_sr_no" value="{{$product->enable_sr_no}}">
		<input type="hidden" name="products[{{ $row_count }}][class_type_id]" class="class_type_id" value="{{$productItem->class_type_id}}">
		<input type="hidden" 
			class="product_type" 
			name="products[{{$row_count}}][product_type]" 
			value="{{$product->product_type}}">

		@php
			$hide_tax = 'hide';
	        if(session()->get('business.enable_inline_tax') == 1){
	            $hide_tax = '';
	        }
	        
			$tax_id = $product->tax_id;
			$item_tax = !empty($product->item_tax) ? $product->item_tax : 0;
			$unit_price_inc_tax = $product->sell_price_inc_tax;
			if($hide_tax == 'hide'){
				$tax_id = null;
				$unit_price_inc_tax = $product->default_sell_price;
			}

			$discount_type = !empty($product->line_discount_type) ? $product->line_discount_type : 'fixed';
			$discount_amount = !empty($product->line_discount_amount) ? $product->line_discount_amount : 0;
			
			if(!empty($discount)) {
				$discount_type = $discount->discount_type;
				$discount_amount = $discount->discount_amount;
			}
  			$sell_line_note = '';
  			if(!empty($product->sell_line_note)){
  				$sell_line_note = $product->sell_line_note;
  			}
  		@endphp

		@if(!empty($discount))
			{!! Form::hidden("products[$row_count][discount_id]", $discount->id); !!}
		@endif

		@php
			$warranty_id = !empty($action) && $action == 'edit' && !empty($product->warranties->first())  ? $product->warranties->first()->id : $product->warranty_id;
		@endphp

		@if(empty($is_direct_sell))
		<div class="modal fade row_edit_product_price_model" id="row_edit_product_price_modal_{{$row_count}}" tabindex="-1" role="dialog">
			@include('sub_pos.partials.row_edit_product_price_modal')
		</div>
		@endif

		<!-- Description modal end -->
		@if(in_array('modifiers' , $enabled_modules))
			<div class="modifiers_html">
				@if(!empty($product->product_ms))
					@include('restaurant.product_modifier_set.modifier_for_product', array('edit_modifiers' => true, 'row_count' => $loop->index, 'product_ms' => $product->product_ms ) )
				@endif
			</div>
		@endif

		@php
			$max_qty_rule = $product->qty_available;
			$max_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $product->formatted_qty_available, 'unit' => $product->unit  ]);
		@endphp

		@if( session()->get('business.enable_lot_number') == 1 || session()->get('business.enable_product_expiry') == 1)
		@php
			$lot_enabled = session()->get('business.enable_lot_number');
			$exp_enabled = session()->get('business.enable_product_expiry');
			$lot_no_line_id = '';
			if(!empty($product->lot_no_line_id)){
				$lot_no_line_id = $product->lot_no_line_id;
			}
		@endphp
		@if(!empty($product->lot_numbers))
			<select class="hidden form-control lot_number input-sm" name="products[{{$row_count}}][lot_no_line_id]" @if(!empty($product->transaction_sell_lines_id)) disabled @endif>
				<option value="">@trans('lang_v1.lot_n_expiry')</option>
				@foreach($product->lot_numbers as $lot_number)
					@php
						$selected = "";
						if($lot_number->purchase_line_id == $lot_no_line_id){
							$selected = "selected";

							$max_qty_rule = $lot_number->qty_available;
							$max_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $lot_number->qty_formated, 'unit' => $product->unit  ]);
						}

						$expiry_text = '';
						if($exp_enabled == 1 && !empty($lot_number->exp_date)){
							if( \Carbon::now()->gt(\Carbon::createFromFormat('Y-m-d', $lot_number->exp_date)) ){
								$expiry_text = '(' . __('report.expired') . ')';
							}
						}

						//preselected lot number if product searched by lot number
						if(!empty($purchase_line_id) && $purchase_line_id == $lot_number->purchase_line_id) {
							$selected = "selected";

							$max_qty_rule = $lot_number->qty_available;
							$max_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $lot_number->qty_formated, 'unit' => $product->unit  ]);
						}
					@endphp
					<option value="{{$lot_number->purchase_line_id}}" data-qty_available="{{$lot_number->qty_available}}" data-msg-max="@trans('lang_v1.quantity_error_msg_in_lot', ['qty'=> $lot_number->qty_formated, 'unit' => $product->unit  ])" {{$selected}}>@if(!empty($lot_number->lot_number) && $lot_enabled == 1){{$lot_number->lot_number}} @endif @if($lot_enabled == 1 && $exp_enabled == 1) - @endif @if($exp_enabled == 1 && !empty($lot_number->exp_date)) @trans('product.exp_date'): {{@format_date($lot_number->exp_date)}} @endif {{$expiry_text}}</option>
				@endforeach
			</select>
		@endif
	@endif
	@if(!empty($is_direct_sell))
  		<br>
  		<textarea class="form-control" name="products[{{$row_count}}][sell_line_note]" rows="2">{{$sell_line_note}}</textarea>
  		<p class="help-block"><small>@trans('lang_v1.sell_line_description_help')</small></p>
	@endif
	</td>

	<td class="hidden" >
		<select class="w3-input" name="products[{{ $row_count }}][session_id]" required >
			@foreach (Subscription::$session::where('class_type_id', $productItem->class_type_id)->get() as $session)
				<option value="{{ $session->id }}">{{ $session->name }}</option>
			@endforeach
		</select>
	</td>

	<td>
		{{-- If edit then transaction sell lines will be present --}}
		@if(!empty($product->transaction_sell_lines_id))
			<input type="hidden" name="products[{{$row_count}}][transaction_sell_lines_id]" class="form-control" value="{{$product->transaction_sell_lines_id}}">
		@endif

		<input type="hidden" name="products[{{$row_count}}][product_id]" class="form-control product_id" value="{{$product->product_id}}">
		<input type="hidden" name="products[{{$row_count}}][unit_price]" class="hidden_product_unit_price" value="{{@num_format(!empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price)}}">
		<input type="hidden" name="products[{{$row_count}}][item_tax]" class="hidden_product_unit_price" value="{{ $product->tax }}">
		<input type="hidden" name="products[{{$row_count}}][tax_type]" class="hidden_product_unit_price" value="{{ $product->tax_type }}">
		<input type="hidden" name="products[{{$row_count}}][tax]" class="hidden_product_tax_id" value="{{ $product->tax }}">

		<input type="hidden" value="{{$product->variation_id}}" 
			name="products[{{$row_count}}][variation_id]" class="row_variation_id">

		<input type="hidden" value="{{$product->enable_stock}}" 
			name="products[{{$row_count}}][enable_stock]">
		
		@if(empty($product->quantity_ordered))
			@php
				$product->quantity_ordered = 1;
			@endphp
		@endif

		@php
			$multiplier = 1;
			$allow_decimal = true;
			if($product->unit_allow_decimal != 1) {
				$allow_decimal = false;
			}
		@endphp
		@foreach($sub_units as $key => $value)
        	@if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key)
        		@php
        			$multiplier = $value['multiplier'];
        			$max_qty_rule = $max_qty_rule / $multiplier;
        			$unit_name = $value['name'];
        			$max_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $max_qty_rule, 'unit' => $unit_name  ]);

        			if(!empty($product->lot_no_line_id)){
        				$max_qty_msg = __('lang_v1.quantity_error_msg_in_lot', ['qty'=> $max_qty_rule, 'unit' => $unit_name  ]);
        			}

        			if($value['allow_decimal']) {
        				$allow_decimal = true;
        			}
        		@endphp
        	@endif
        @endforeach
		<div class="input-group input-number hidden">
			<span class="input-group-btn"><button type="button" class="btn btn-default btn-flat quantity-down"><i class="fa fa-minus text-"></i></button></span>
		<input 
			type="text" 
			data-min="1" 
			onchange="$(this).parent().parent().parent().find('.row-total').text(parseFloat($(this).parent().parent().parent().find('.row-total').attr('data-price')) * this.value)"
			class="form-control pos_quantity_ input_number mousetrap input_quantity_" 
			value="{{@format_quantity($product->quantity_ordered)}}" 
			name="products[{{$row_count}}][quantity]" 
			data-allow-overselling="@if(empty($pos_settings['allow_overselling'])){{'false'}}@else{{'true'}}@endif" 
			@if($allow_decimal) 
				data-decimal=1 
			@else 
				data-decimal=0 
				data-rule-abs_digit="true" 
				data-msg-abs_digit="@trans('lang_v1.decimal_value_not_allowed')" 
			@endif
			data-rule-required="true" 
			data-msg-required="@trans('validation.custom-messages.this_field_is_required')" 
			@if($product->enable_stock && empty($pos_settings['allow_overselling']) )
				data-rule-max-value="{{$max_qty_rule}}" data-qty_available="{{$product->qty_available}}" data-msg-max-value="{{$max_qty_msg}}" 
				data-msg_max_default="@trans('validation.custom-messages.quantity_not_available', ['qty'=> $product->formatted_qty_available, 'unit' => $product->unit  ])" 
			@endif 
		>
			<span class="input-group-btn"><button type="button" class="btn btn-default btn-flat quantity-up"><i class="fa fa-plus text-"></i></button></span>
		</div>
		
		<input type="hidden" name="products[{{$row_count}}][product_unit_id]" value="{{$product->unit_id}}">
		@if(count($sub_units) > 0)
			<div class="hidden">
				<br>
				<select name="products[{{$row_count}}][sub_unit_id]" class="form-control input-sm sub_unit">
					@foreach($sub_units as $key => $value)
						<option value="{{$key}}" data-multiplier="{{$value['multiplier']}}" data-unit_name="{{$value['name']}}" data-allow_decimal="{{$value['allow_decimal']}}" @if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key) selected @endif>
							{{$value['name']}}
						</option>
					@endforeach
			</select>
			</div>
		@else
			<span class="hidden">
				{{$product->unit}}
			</span>
		@endif

		<input type="hidden" class="base_unit_multiplier" name="products[{{$row_count}}][base_unit_multiplier]" value="{{$multiplier}}">

		<input type="hidden" class="hidden_base_unit_sell_price" value="{{$product->default_sell_price / $multiplier}}">
		
		{{-- Hidden fields for combo products --}}
		@if($product->product_type == 'combo' && !empty($product->combo_products))

			@foreach($product->combo_products as $k => $combo_product)

				@if(isset($action) && $action == 'edit')
					@php
						$combo_product['qty_required'] = $combo_product['quantity'] / $product->quantity_ordered;

						$qty_total = $combo_product['quantity'];
					@endphp
				@else
					@php
						$qty_total = $combo_product['qty_required'];
					@endphp
				@endif

				<input type="hidden" 
					name="products[{{$row_count}}][combo][{{$k}}][product_id]"
					value="{{$combo_product['product_id']}}">

					<input type="hidden" 
					name="products[{{$row_count}}][combo][{{$k}}][variation_id]"
					value="{{$combo_product['variation_id']}}">

					<input type="hidden"
					class="combo_product_qty" 
					name="products[{{$row_count}}][combo][{{$k}}][quantity]"
					data-unit_quantity="{{$combo_product['qty_required']}}"
					value="{{$qty_total}}">

					@if(isset($action) && $action == 'edit')
						<input type="hidden" 
							name="products[{{$row_count}}][combo][{{$k}}][transaction_sell_lines_id]"
							value="{{$combo_product['id']}}">
					@endif

			@endforeach
		@endif
	</td>
	@if(!empty($is_direct_sell))
		<td class='hidden' @if(!auth()->user()->can('edit_product_price_from_sale_screen')) hide @endif">
			<input type="text" name="products[{{$row_count}}][unit_price]" class="form-control pos_unit_price input_number mousetrap" value="{{@num_format(!empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price)}}">
		</td>
		<td class='hidden' @if(!$edit_discount) hide @endif>
			{!! Form::text("products[$row_count][line_discount_amount]", @num_format($discount_amount), ['class' => 'form-control input_number row_discount_amount']); !!}<br>
			{!! Form::select("products[$row_count][line_discount_type]", ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $discount_type , ['class' => 'form-control row_discount_type']); !!}
			@if(!empty($discount))
				<p class="help-block">{!! __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]) !!}</p>
			@endif
		</td>
		<td class="text-center {{$hide_tax}}">
			{!! Form::hidden("products[$row_count][item_tax]", @num_format($item_tax), ['class' => 'item_tax']); !!}
		
			{!! Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['placeholder' => 'Select', 'class' => 'form-control tax_id'], $tax_dropdown['attributes']); !!}
		</td>
		@if(!empty($warranties))
			{!! Form::select("products[$row_count][warranty_id]", $warranties, $warranty_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control']); !!}
		@endif
	@endif
	@if(!empty($pos_settings['inline_service_staff']) && !empty($waiters))
		<td class="hidden" >
			<div class="form-group">
				<div class="input-group">
					{!! Form::select("products[" . $row_count . "][res_service_staff_id]", $waiters, !empty($product->res_service_staff_id) ? $product->res_service_staff_id : null, ['class' => 'form-control select2 order_line_service_staff', 'placeholder' => __('restaurant.select_service_staff'), 'required' => (!empty($pos_settings['is_service_staff_required']) && $pos_settings['is_service_staff_required'] == 1) ? true : false ]); !!}
				</div>
			</div>
		</td>
	@endif
	<td class="{{$hide_tax}}">
		<input type="text" name="products[{{$row_count}}][unit_price_inc_tax]" class="form-control pos_unit_price_inc_tax input_number" value="{{@num_format($unit_price_inc_tax)}}" @if(!$edit_price) readonly @endif @if(!empty($pos_settings['enable_msp'])) data-rule-min-value="{{$unit_price_inc_tax}}" data-msg-min-value="{{__('lang_v1.minimum_selling_price_error_msg', ['price' => @num_format($unit_price_inc_tax)])}}" @endif>
	</td>
	<td class="text-center">
		@php
			$subtotal_type = !empty($pos_settings['is_pos_subtotal_editable']) ? 'text' : 'hidden';

		@endphp
		<input type="{{$subtotal_type}}" class="form-control pos_line_total @if(!empty($pos_settings['is_pos_subtotal_editable'])) input_number @endif" value="{{@num_format($product->quantity_ordered*$unit_price_inc_tax )}}">
		<span class="display_currency pos_line_total_text @if(!empty($pos_settings['is_pos_subtotal_editable'])) hide @endif" data-currency_symbol="true">{{$product->quantity_ordered*$unit_price_inc_tax}}</span>
	</td>
	<td>
		@if($productItem->variations->count() > 1)
		<div class="pos_variations" style="padding: 5px">
			<a  href="#" 
				onclick="chooseProduct('#productModal{{ $product->product_id }}', 'product-row-number-{{$row_count}}')"
				class="pt-3 w3-" 
				id="pos-edit-order_details" 
				title="Edit " aria-hidden="true" 
				data-toggle="modal" 
				data-target="#posEditOrderDetails"> 
					<i class="fa fa-shopping-basket mr-1 w3-" style="margin-right: 4px"  ></i>
					Order Details
				</a>
		</div>
		@endif
	</td>
	<td style="padding: 12px">
		<p class="font-weight-bolder">
			<b><b data-price="{{ $product->default_sell_price }}" class="row-total" >{{ $product->default_sell_price * (isset($quantity)? $quantity : $product->quantity) }}</b></b>
		</p>
	</td>
	<td class="text-center " style="padding: 12px" >
		<i 
			class="fa fa-times text- pos_remove_row cursor-pointer btn btn-default" 
			aria-hidden="true"></i>
	</td>
</tr>
