@extends("sale_pos.receipts.main")

@section("title")
Receipt-{{$receipt_details->invoice_no}}
@endsection

@section('css')

<style type="text/css">
	.f-8 {
		font-size: 8px !important;
	}
	@media print {
		* {
			font-size: 12px; 
			word-break: break-all;
		}
		.f-8 {
			font-size: 8px !important;
		}
		
	.headings{
		font-size: 16px;
		font-weight: 700;
		text-transform: uppercase;
		white-space: nowrap;
	}
	
	.sub-headings{
		font-size: 15px !important;
		font-weight: 700 !important;
	}
	
	.border-top{
		border-top: 1px solid #242424;
	}
	.border-bottom{
		border-bottom: 1px solid #242424;
	}
	
	.border-bottom-dotted{
		border-bottom: 1px dotted darkgray;
	}
	
	td.serial_number, th.serial_number{
		width: 5%;
		max-width: 5%;
	}
	
	td.description,
	th.description {
		width: 35%;
		max-width: 35%;
	}
	
	td.quantity,
	th.quantity {
		width: 15%;
		max-width: 15%; 
	}
	td.unit_price, th.unit_price{
		width: 25%;
		max-width: 25%; 
	}
	
	td.price,
	th.price {
		width: 20%;
		max-width: 20%; 
	}
	
	.centered {
		text-align: center;
		align-content: center;
	}
	
	.ticket {
		width: 100%;
		max-width: 100%;
	}
	
	img {
		max-width: inherit;
		width: auto;
	}
	
		.hidden-print,
		.hidden-print * {
			display: none !important;
		}
	}
	.table-info {
		width: 100%;
	}
	.table-info tr:first-child td, .table-info tr:first-child th {
		padding-top: 8px;
	}
	.table-info th {
		text-align: left;
	}
	.table-info td {
		text-align: right;
	}
	.logo {
		float: left;
		width:35%;
		padding: 10px;
	}
	
	.text-with-image {
		float: left;
		width:65%;
	}
	.text-box {
		width: 100%;
		height: auto;
	}
	
	.textbox-info {
		clear: both;
	}
	.textbox-info p {
		margin-bottom: 0px
	}
	.flex-box {
		display: flex;
		width: 100%;
	}
	.flex-box p {
		width: 50%;
		margin-bottom: 0px;
		white-space: nowrap;
	}
	
	.table-f-12 th, .table-f-12 td {
		font-size: 12px;
		word-break: break-word;
	}
	
	.bw {
		word-break: break-word;
	}

	*, h1, h2, h3, h4, h5, h6 {  
		font-family: 'Tajawal', Arial, Helvetica, sans-serif;
	}
	@if (isRtl())
	*, h1, h2, h3, h4, h5, h6 {
		direction: rtl;
		text-align: right; 
	}

	.w3-table tr, .w3-table th, .w3-table td {
		text-align: right!important;
	}
	@else   
	.w3-table tr, .w3-table th, .w3-table td {
		text-align: left!important;
	}
	@endif

	.w3-tiny-custom {
		font-size: 5px!important;
	}
	</style>
@endsection

@section("content")
<div class="ticket">
        	
       
	@if(!empty($receipt_details->logo))
		<div class="text-box centered">
			<img style="width: 60%;margin: auto;" src="{{$receipt_details->logo}}" alt="Logo">
		</div>
	@endif  	

	<div class="text-box">
	<!-- Logo -->
	<p class="">

		<!-- business information here -->
		@if(!empty($receipt_details->display_name))
			<h3 class="headings w3-center">
				{{$receipt_details->display_name}}
			</h3> 
		@endif

		<!-- Header text -->
		@if(!empty($receipt_details->header_text))
			<span class="headings">{!! $receipt_details->header_text !!}</span>
			<br/>
		@endif
		
		@if(!empty($receipt_details->address)) 
			<b>@trans('address')</b>  : {!! str_replace("<br>", "", $receipt_details->address) !!}    
			<br>
		@endif
		@if ($receipt_details->commercial_number)
		<span>
			<b>@trans('commercial_number')</b> : {{ $receipt_details->commercial_number }}
		</span>
		<br>
		@endif

		@if ($receipt_details->tax_number)
		<span>
			<b>@trans('tax_number')</b> : {{ $receipt_details->tax_number }}
		</span>
		<br>
		@endif

		@if(!empty($receipt_details->contact))
			{!! $receipt_details->contact !!}
		@endif
		@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
			, 
		@endif
		@if(!empty($receipt_details->website))
			{{ $receipt_details->website }}
		@endif
		@if(!empty($receipt_details->location_custom_fields))
			<br>{{ $receipt_details->location_custom_fields }}
		@endif

		@if(!empty($receipt_details->sub_heading_line1))
			{{ $receipt_details->sub_heading_line1 }}<br/>
		@endif
		@if(!empty($receipt_details->sub_heading_line2))
			{{ $receipt_details->sub_heading_line2 }}<br/>
		@endif
		@if(!empty($receipt_details->sub_heading_line3))
			{{ $receipt_details->sub_heading_line3 }}<br/>
		@endif
		@if(!empty($receipt_details->sub_heading_line4))
			{{ $receipt_details->sub_heading_line4 }}<br/>
		@endif		
		@if(!empty($receipt_details->sub_heading_line5))
			{{ $receipt_details->sub_heading_line5 }}<br/>
		@endif

		@if(!empty($receipt_details->tax_info1))
			<br><b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
		@endif

		@if(!empty($receipt_details->tax_info2))
			<b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}
		@endif

		<!-- Title of receipt -->
		@if(!empty($receipt_details->invoice_heading))
			<br/><span class="sub-headings">{!! $receipt_details->invoice_heading !!}</span>
		@endif
	</p>
	</div>
	<div class="border-top textbox-info">

		<p class="f-left">
			<b>{!! $receipt_details->invoice_no_prefix !!}</b> : {{$receipt_details->invoice_no}}
		</p> 
	</div>
	<div class="textbox-info">
		<p class="f-left">
			<b>{!! $receipt_details->date_label !!}</b> : {{$receipt_details->invoice_date}}
		</p> 
	</div>
	
	@if(!empty($receipt_details->due_date_label))
		<div class="textbox-info">
			<p class="f-left">
				<b>{{$receipt_details->due_date_label}}</b> : {{$receipt_details->due_date ?? ''}}
			</p> 
		</div>
	@endif

	@if(!empty($receipt_details->sales_person_label))
		<div class="textbox-info">
			<p class="f-left">
				<b>{{$receipt_details->sales_person_label}}</b> : {{$receipt_details->sales_person}}
			</p> 
		</div>
	@endif

	@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
		<div class="textbox-info">
			<p class="f-left"><strong>{{$receipt_details->brand_label}}</strong></p>
		
			<p class="f-right">{{$receipt_details->repair_brand}}</p>
		</div>
	@endif

	@if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
		<div class="textbox-info">
			<p class="f-left"><strong>{{$receipt_details->device_label}}</strong></p>
		
			<p class="f-right">{{$receipt_details->repair_device}}</p>
		</div>
	@endif
	
	@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
		<div class="textbox-info">
			<p class="f-left"><strong>{{$receipt_details->model_no_label}}</strong></p>
		
			<p class="f-right">{{$receipt_details->repair_model_no}}</p>
		</div>
	@endif
	
	@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
		<div class="textbox-info">
			<p class="f-left"><strong>{{$receipt_details->serial_no_label}}</strong></p>
		
			<p class="f-right">{{$receipt_details->repair_serial_no}}</p>
		</div>
	@endif

	@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
		<div class="textbox-info">
			<p class="f-left"><strong>
				{!! $receipt_details->repair_status_label !!}
			</strong></p>
			<p class="f-right">
				{{$receipt_details->repair_status}}
			</p>
		</div>
	@endif

	@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
		<div class="textbox-info">
			<p class="f-left"><strong>
				{!! $receipt_details->repair_warranty_label !!}
			</strong></p>
			<p class="f-right">
				{{$receipt_details->repair_warranty}}
			</p>
		</div>
	@endif

	<!-- Waiter info -->
	@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
		<div class="textbox-info">
			<p class="f-left"><strong>
				{!! $receipt_details->service_staff_label !!}
			</strong></p>
			<p class="f-right">
				{{$receipt_details->service_staff}}
			</p>
		</div>
	@endif

	@if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
		<div class="textbox-info">
			<p class="f-left"><strong>
				@if(!empty($receipt_details->table_label))
					<b>{!! $receipt_details->table_label !!}</b>
				@endif
			</strong></p>
			<p class="f-right">
				{{$receipt_details->table}}
			</p>
		</div>
	@endif

	<!-- customer info -->
	<div class="textbox-info">
		@if ($receipt_details->customer_info)
		<p style="vertical-align: top;">
			<b>{{$receipt_details->customer_label }}</b> : {!! str_replace("<br>", ", ", $receipt_details->customer_info) !!}	
		</p>
		@endif
 
	</div>
	
	@if(!empty($receipt_details->client_id_label))
		<div class="textbox-info">
			<p class="f-left"><strong>
				{{ $receipt_details->client_id_label }}
			</strong></p>
			<p class="f-right">
				{{ $receipt_details->client_id }}
			</p>
		</div>
	@endif
	
	@if(!empty($receipt_details->customer_tax_label))
		<div class="textbox-info">
			<p class="f-left"><strong>
				{{ $receipt_details->customer_tax_label }}
			</strong></p>
			<p class="f-right">
				{{ $receipt_details->customer_tax_number }}
			</p>
		</div>
	@endif

	@if(!empty($receipt_details->customer_custom_fields))
		<div class="textbox-info">
			<p class="centered">
				{!! $receipt_details->customer_custom_fields !!}
			</p>
		</div>
	@endif
	
	@if(!empty($receipt_details->customer_rp_label))
		<div class="textbox-info">
			<p class="f-left"><strong>
				{{ $receipt_details->customer_rp_label }}
			</strong></p>
			<p class="f-right">
				{{ $receipt_details->customer_total_rp }}
			</p>
		</div>
	@endif
		
	<table style="margin-top: 10px !important" class="w3-table w3-center">
		<thead  style="border-top: 1px solid gray!important;border-bottom: 1px solid gray!important;"  >
			<tr style="border-top: 1px solid gray!important;border-bottom: 1px solid gray!important;" >
				<!--
				<th class="serial_number w3-tiny-custom f-8">#</th>
				-->
				<th class="description w3-tiny-custom f-8" width="30%">
					<span class="w3-tiny">
						{{$receipt_details->table_product_label}}
					</span>
				</th>
				<th class="quantity text-right w3-tiny-custom f-8">
					<span class="w3-tiny">
						{{$receipt_details->table_qty_label}}
					</span>
				</th>
				@if(empty($receipt_details->hide_price))
				<th class="unit_price text-right w3-tiny-custom f-8">
					<span class="w3-tiny">
						{{$receipt_details->table_unit_price_label}}
					</span>
				</th>
				<th class="price text-right w3-tiny-custom f-8">
					<span class="w3-tiny">
						{{$receipt_details->table_subtotal_label}}
					</span>
				</th>
				@endif
			</tr>
		</thead>
		<tbody>
			@forelse($receipt_details->lines as $line)
				<tr>
					<!--
					<td class="serial_number" style="vertical-align: top;">
						{{$loop->iteration}}
					</td>
				-->
					<td class="description">
						<span class="w3-tiny">
							{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
							@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
							@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
							@if(!empty($line['sell_line_note']))
							<br>
							<span class="f-8">
							{{$line['sell_line_note']}}
							</span>
							@endif 
							@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
							@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif
						</span>
					</td>
					<td class="quantity text-right">
						<span class="w3-tiny">
							{{$line['quantity']}}{{$line['units']}}
						</span>
					</td>
					@if(empty($receipt_details->hide_price))
					<td class="unit_price text-right">
						<span class="w3-tiny">
							{{$line['unit_price_inc_tax']}}
						</span>
					</td>
					<td class="price text-right">
						<span class="w3-tiny">
							{{$line['line_total']}}
						</span>
					</td>
					@endif
				</tr>
				@if(!empty($line['modifiers']))
					@foreach($line['modifiers'] as $modifier)
						<tr>
							<td>
								&nbsp;
							</td>
							<td>
								{{$modifier['name']}} {{$modifier['variation']}} 
								@if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
								@if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif 
							</td>
							<td class="text-right">{{$modifier['quantity']}} {{$modifier['units']}} </td>
							@if(empty($receipt_details->hide_price))
							<td class="text-right">{{$modifier['unit_price_inc_tax']}}</td>
							<td class="text-right">{{$modifier['line_total']}}</td>
							@endif
						</tr>
					@endforeach
				@endif
			@endforeach
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
		</tbody>
	</table>
	@if(!empty($receipt_details->total_quantity_label))
		<table class="w3-table">
			<thead style="border-top: 1px solid gray!important;border-bottom: 1px solid gray!important;">
				<tr>
					<th>{!! $receipt_details->total_quantity_label !!}</th>
					<td>{{$receipt_details->total_quantity}}</td>
				</tr>
			</thead>
		</table> 
	@endif
	@if(empty($receipt_details->hide_price))
		<table class="w3-table">
			<thead style="border-top: 1px solid gray!important;border-bottom: 1px solid gray!important;">
				@if(!empty($receipt_details->subtotal))
				<tr>
					<th>{!! $receipt_details->subtotal_label !!}</th>
					<td>{{$receipt_details->subtotal}}</td>
				</tr>
				@endif
				@if(!empty($receipt_details->shipping_charges))
				<tr>
					<th>{!! $receipt_details->shipping_charges_label !!}</th>
					<td>{{$receipt_details->shipping_charges }}</td>
				</tr>
				@endif 
				@if(!empty($receipt_details->packing_charge))
				<tr>
					<th>{!! $receipt_details->packing_charge_label !!}</th>
					<td>{{$receipt_details->packing_charge }}</td>
				</tr>
				@endif 
				@if(!empty($receipt_details->discount))
				<tr>
					<th>{!! $receipt_details->discount_label !!}</th>
					<td>{{$receipt_details->discount }}</td>
				</tr>
				@endif 
				@if(!empty($receipt_details->reward_point_label))
				<tr>
					<th>{!! $receipt_details->reward_point_label !!}</th>
					<td>{{$receipt_details->reward_point_label }}</td>
				</tr>
				@endif 
				@if(!empty($receipt_details->tax))
				<tr>
					<th>{!! $receipt_details->tax_label !!}</th>
					<td>{{$receipt_details->tax }}</td>
				</tr>
				@endif 
				@if($receipt_details->round_off_amount > 0)
				<tr>
					<th>{!! $receipt_details->round_off_label !!}</th>
					<td>{{$receipt_details->round_off_amount }}</td>
				</tr>
				@endif 
				@if(!empty($receipt_details->total))
				<tr>
					<th>{!! $receipt_details->total_label !!}</th>
					<td>
						{{$receipt_details->total }}
						@if(!empty($receipt_details->total_in_words))
						<br>
						{{$receipt_details->total_in_words }}
						@endif 
					</td>
				</tr>
				@endif  
				@if(!empty($receipt_details->total_paid))
				<tr>
					<th>{!! $receipt_details->total_paid_label !!}</th>
					<td>{{$receipt_details->total_paid}}</td>
				</tr>
				@endif 
				@if(!empty($receipt_details->total_due))
				<tr>
					<th>{!! $receipt_details->total_due_label !!}</th>
					<td>{{$receipt_details->total_due}}</td>
				</tr>
				@endif 
				@if(!empty($receipt_details->all_due))
				<tr>
					<th>{!! $receipt_details->all_bal_label !!}</th>
					<td>{{$receipt_details->all_due}}</td>
				</tr>
				@endif 
			</thead>
		</table>    
  
		@if(!empty($receipt_details->payments))
			@foreach($receipt_details->payments as $payment)
				<div class="flex-box">
					<p class="width-50 text-right">{{$payment['method']}} ({{$payment['date']}}) </p>
					<p class="width-50 text-right">{{$payment['amount']}}</p>
				</div>
			@endforeach
		@endif

	@endif
	<div class="border-bottom width-100">&nbsp;</div>
	@if(empty($receipt_details->hide_price))
		<!-- tax -->
		@if(!empty($receipt_details->taxes))
			<table class="border-bottom width-100 table-f-12">
				@foreach($receipt_details->taxes as $key => $val)
					<tr>
						<td class="left">{{$key}}</td>
						<td class="right">{{$val}}</td>
					</tr>
				@endforeach
			</table>
		@endif
	@endif


	@if(!empty($receipt_details->additional_notes))
		<p class="centered" >
			{!! nl2br($receipt_details->additional_notes) !!}
		</p>
	@endif

	{{-- Barcode --}}
	@if($receipt_details->show_barcode)
		<br/>
 	@endif
	
	<br>
	@if (!empty($receipt_details->qrcode_img))
		<div class="w3-center">   
			<div style="width: 60%;margin-right: 0px;margin: auto!important" 
			class="qrcode" data-width="120" data-height="120"
			data-text="{{ $receipt_details->url }}"></div>
		</div>
	@endif 

	@if(!empty($receipt_details->footer_text))
		<p class="centered">
			{!! $receipt_details->footer_text !!}
		</p>
	@endif
</div>
@endsection 
