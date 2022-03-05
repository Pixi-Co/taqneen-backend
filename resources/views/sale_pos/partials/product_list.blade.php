
@php
	
	$productsIds = [];
	$counts = [];
@endphp

@foreach($products as $product)
	@php
		$productsIds[$product->product_id] = $product->product_id; 

		if (isset($counts[$product->product_id]))
			$counts[$product->product_id] += 1;
		else 
			$counts[$product->product_id] = 1;
	@endphp
@endforeach

@php
	$productItems = App\Product::whereIn('id', $productsIds)->get();
@endphp
 

@foreach($productItems as $p)
<div 
onclick="chooseProduct('#productModal{{ $p->id }}')"
class="{{ $p->class_type_id > 0? 'col-md-4 col-xs-12' : 'col-md-3 col-xs-12' }} product_list no-print" style="padding: 13px;cursor: pointer" >
	<div 
	class="w3-round-xlarge w3-card text-left w3-display-container" 
	data-variation_id="{{$p->id}}" >

		<div class="w3-large text-left w3-padding">
			{{$p->name}} 
		</div>
		<div class="w3-padding text-left">
			{{ $p->weight }} 
			@if ($p->class_type_id)
			(@trans('sb_'))
			@else
			(@trans('g'))
			@endif
		</div>

		<div class="w3-row w3-block">
			<div class="w3-right w3-padding">
				<div class="image-container" 
				style="
						width: 60px;
						height: 60px;
						border-radius: 5em;
						background-image: url(  {{ $p->image_url }}  );
				background-repeat: no-repeat; background-position: center;
				background-size: cover;">
				
				</div>
			</div>

			<div class="w3-left w3-padding w3-text-orange"  style="vertical-align: bottom;padding-bottom: 50px"> 
				<br>
				<b class="display_currency" > {{ number_format(optional(optional($p->variations())->first())->default_sell_price, 1) }}</b>
			</div>
		</div>
	

	<div class="text_div hidden">
		<small class="text text-muted">{{$p->name}} 
		@if($p->type == 'variable')
			- {{$p->variation}}
		@endif
		</small>

		<small class="text-muted">
			({{$p->sub_sku}})
		</small>
	</div>
		
	</div>
</div>

@php
	$modalWidth = 40;
	$count = $counts[$p->id];
	$cols = "col-md-6 col-xs-6";

	if ($count > 6 && $count <= 15) {
		$modalWidth = 60;
		$cols = "col-md-4 col-xs-12";
	} 
	else if ($count > 15) {
		$modalWidth = 85;
		$cols = "col-md-2 col-xs-12";
	}  

@endphp

<div class="modal fade" id="productModal{{ $p->id }}" tabindex="-1" role="dialog">
	<div class="modal-dialog" style="min-width: {{ $modalWidth }}%" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title">{{ $p->name }}</h4>
		</div>
		<div class="modal-body w3-row" style="padding: 2px!important" >
	  
			@foreach($products as $product)
			@if($product->product_id == $p->id)
			@php
				$p = App\Product::find($product->product_id);
			@endphp
				<div class="{{ $cols }} product_list no-print col-xs-12" style="padding: 8px" >
					<div 
					class="product_box w3-round-xlarge w3-card text-left w3-display-container product-item{{ $product->id }}" 
					data-variation_id="{{$product->id}}" title="{{$product->name}} @if($product->type == 'variable')- {{$product->variation}} @endif {{ '(' . $product->sub_sku . ')'}} @if(!empty($show_prices)) @trans('lang_v1.default') - @format_currency($product->selling_price) @foreach($product->group_prices as $group_price) @if(array_key_exists($group_price->price_group_id, $allowed_group_prices)) {{$allowed_group_prices[$group_price->price_group_id]}} - @format_currency($group_price->price_inc_tax) @endif @endforeach @endif">

						<div class="w3-large text-left w3-padding">
							{{$product->variation}}
						</div>

						<div class="w3-large text-left w3-padding hidden">
							{{$product->name}} 
						</div>

						<div class="w3-row w3-block">
							<div class="w3-right w3-padding">
								<div class="image-container" 
								style="
										width: 60px;
										height: 60px;
										border-radius: 5em;
										background-image: url(
										@if(count($product->media) > 0)
											{{$product->media->first()->display_url}}
										@elseif(!empty($product->product_image))
											{{asset('/uploads/img/' . rawurlencode($product->product_image))}}
										@else
											{{asset('/img/product-default-image.jpg')}}
										@endif
									);
								background-repeat: no-repeat; background-position: center;
								background-size: cover;">
								
								</div>
							</div>

							<div class="w3-left w3-padding w3-text-orange"  style="vertical-align: bottom;padding-bottom: 50px"> 
								<br>
								<b  class="display_currency" > {{ number_format($product->selling_price, 1) }}</b>
							</div>
						</div>
					

					<div class="text_div hidden">
						<small class="text text-muted">{{$product->name}} 
						@if($product->type == 'variable')
							- {{$product->variation}}
						@endif
						</small>

						<small class="text-muted">
							({{$product->sub_sku}})
						</small>
					</div>
						
					</div>
				</div>	
			@endif
				@endforeach




		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
		</div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endforeach



 <!--
	<input type="hidden" id="no_products_found">
	<div class="col-md-12">
		<h4 class="text-center">
			@trans('lang_v1.no_products_to_display')
		</h4>
	</div>
-->
	 