<div class="row">
	<div class="col-md-12">
		<h4>@trans('lang_v1.combo'):</h4>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table bg-gray">
				<tr class="bg-green">
					<th>@trans('product.product_name')</th>
					@can('view_purchase_price')
						<th>@trans('product.default_purchase_price') (@trans('product.exc_of_tax'))</th>
						<th>@trans('product.default_purchase_price') (@trans('product.inc_of_tax'))</th>
					@endcan
					@can('access_default_selling_price')
						@can('view_purchase_price')
				        	<th>@trans('product.profit_percent')</th>
				        @endcan
				        <th>@trans('product.default_selling_price') (@trans('product.exc_of_tax'))</th>
				        <th>@trans('product.default_selling_price') (@trans('product.inc_of_tax'))</th>
			        @endcan
			        <th>@trans('sale.qty')</th>
			        <th class="text-center">
						@trans('lang_v1.total_amount_exc_tax')
					</th>
			        <th>@trans('lang_v1.variation_images')</th>
				</tr>
				@foreach($combo_variations as $variation)
				<tr>
					<td>
						{{$variation['variation']['product']->name}} 

						@if($variation['variation']['product']->type == 'variable')
							- {{$variation['variation']->name}}
						@endif
						
						({{$variation['variation']->sub_sku}})
					</td>
					@can('view_purchase_price')
						<td>
							<span class="display_currency" data-currency_symbol="true">{{ $variation['variation']->default_purchase_price }}</span>
						</td>
						<td>
							<span class="display_currency" data-currency_symbol="true">{{ $variation['variation']->dpp_inc_tax }}</span>
						</td>
					@endcan
					@can('access_default_selling_price')
						@can('view_purchase_price')
						<td>
							{{ @num_format($variation['variation']->profit_percent) }}
						</td>
						@endcan
						<td>
							<span class="display_currency" data-currency_symbol="true">{{ $variation['variation']->default_sell_price }}</span>
						</td>
						<td>
							<span class="display_currency" data-currency_symbol="true">{{ $variation['variation']->sell_price_inc_tax }}</span>
						</td>
					@endcan
					<td>
						<span class="display_currency" data-currency_symbol="false" data-is_quantity=true >{{$variation['quantity']}}</span> {{$variation['unit_name']}}
					</td>
					<td>
						<span class="display_currency" data-currency_symbol="true">{{$variation['variation']->default_purchase_price * $variation['quantity'] * $variation['multiplier']}}</span>
					</td>
					<td>
			        	@foreach($variation['variation']->media as $media)
			        		{!! $media->thumbnail([60, 60], 'img-thumbnail') !!}
			        	@endforeach
			        </td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
	<div class="col-md-12 text-right">
		<strong>@trans('product.default_selling_price'): </strong> 
		<span class="display_currency" data-currency_symbol="true">{{$product->variations->first()->sell_price_inc_tax}}</span>
	</div>
</div>