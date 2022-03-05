<div class="row">
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<div class="table-responsive">
			<table class="table table-condensed bg-gray">
				<tr>
					<th>@trans('sale.product')</th>
					<th>@trans('sale.qty')</th>
					<th>@trans('sale.unit_price')</th>
					<th>@trans('sale.subtotal')</th>
				</tr>
				@foreach( $stock_adjustment_details as $details )
					<tr>
						<td>
							{{ $details->product }} 
							@if( $details->type == 'variable')
							 {{ '-' . $details->product_variation . '-' . $details->variation }} 
							@endif 
							( {{ $details->sub_sku }} )
						</td>
						<td>
							{{@num_format($details->quantity)}}
						</td>
						<td>
							{{@num_format($details->unit_price)}}
						</td>
						<td>
							{{@num_format($details->unit_price * $details->quantity)}}
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>