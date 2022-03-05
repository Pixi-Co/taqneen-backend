<div class="row">
	<div class="col-md-12">
		<h4>@trans('product.variations'):</h4>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table bg-gray">
				<tr class="bg-green">
					<th>@trans('product.variations')</th>
					<th>@trans('product.sku')</th>
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
			        @if(!empty($allowed_group_prices))
			        	<th>@trans('lang_v1.group_prices')</th>
			        @endif
			        <th>@trans('lang_v1.variation_images')</th>
				</tr>
				@foreach($product->variations as $variation)
				<tr>
					<td>
						{{$variation->product_variation->name}} - {{ $variation->name }}
					</td>
					<td>
						{{ $variation->sub_sku }}
					</td>
					@can('view_purchase_price')
					<td>
						<span class="display_currency" data-currency_symbol="true">{{ $variation->default_purchase_price }}</span>
					</td>
					<td>
						<span class="display_currency" data-currency_symbol="true">{{ $variation->dpp_inc_tax }}</span>
					</td>
					@endcan
					@can('access_default_selling_price')
						@can('view_purchase_price')
						<td>
							{{ @num_format($variation->profit_percent) }}
						</td>
						@endcan
						<td>
							<span class="display_currency" data-currency_symbol="true">{{ $variation->default_sell_price }}</span>
						</td>
						<td>
							<span class="display_currency" data-currency_symbol="true">{{ $variation->sell_price_inc_tax }}</span>
						</td>
					@endcan
					@if(!empty($allowed_group_prices))
			        	<td class="td-full-width">
			        		@foreach($allowed_group_prices as $key => $value)
			        			<strong>{{$value}}</strong> - @if(!empty($group_price_details[$variation->id][$key]))
			        				<span class="display_currency" data-currency_symbol="true">{{ $group_price_details[$variation->id][$key] }}</span>
			        			@else
			        				0
			        			@endif
			        			<br>
			        		@endforeach
			        	</td>
			        @endif
			        <td>
			        	@foreach($variation->media as $media)
			        		{!! $media->thumbnail([60, 60], 'img-thumbnail') !!}
			        	@endforeach
			        </td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>