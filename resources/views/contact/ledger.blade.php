@if (request()->type != "report")
<!-- app css -->
@if(!empty($for_pdf))
	<link rel="stylesheet" href="{{ asset('css/app.css?v='.$asset_v) }}">
	<link rel="stylesheet" href="{{ asset('css/w3.css') }}">
	<style>
		.circle-avatar {
			width: 30px;
			height: 30px;
			background-color: #41bc85!important;
			color: white;
			border-radius: 5em;
			margin: 0px;
			margin-top: 5px;
			margin-right: 5px;
			padding-top: 8px;
			text-align: center; 
			font-size: 13px!important;
		}
	
		.padding-top {
			padding-top: 5px
		}
		.info_col {
			width: 50%;
			float: left;
			padding-left: 10px;
			padding-right: 10px;
		}
	
		.w3-table th:first-child, .w3-table td:first-child, .w3-table-all th:first-child, .w3-table-all td:first-child {
			padding: 0px!important;
		}
	
		.contact-info-row table tr {
			border: none!important;
		}
	
		.legder-content {
			
		}
	</style>
@endif 
<div class="col-md-6 col-sm-6 col-xs-6 legder-content">

	<table class="w3-table">
		<tr style="padding: 0px!important">
			<th style="padding: 0px!important" >
				<div class="w3-green w3-round w3-block w3-padding">
					@trans('lang_v1.to')
				</div>
			</th>
		</tr>
		<tr>
			<td>
				<strong>
					<i class="circle-avatar w3-large fa fa-map-marker margin-r-5"></i> 
			    	<b>{{$contact->business->name}}</b> 
					{!! str_replace('<br>', ' ', $contact->business->business_address) !!}
				</strong>
			</td>  
		</tr>
		<tr>
			<td>
				<strong>
					<i class="circle-avatar w3-large fas fa-user-tie circle-avatar"></i> 
			    	{{$contact->name}}
				</strong>
			</td>  
		</tr>
		<tr>
			<td>
				<strong>
					<i class="circle-avatar w3-large fa fa-map-marker margin-r-5"></i> 
			    	{!! str_replace("<br>", " ", $contact->contact_address) !!}
				</strong>
			</td>  
		</tr>
		@if(!empty($contact->email))
		<tr>
			<td>
				<strong>
					<i class="circle-avatar w3-large fa fa-envelope margin-r-5"></i> 
			    	{{$contact->email}}
				</strong>
			</td>  
		</tr>
		@endif 
		@if(!empty($contact->mobile))
		<tr>
			<td>
				<strong>
					<i class="circle-avatar w3-large fa fa-phone margin-r-5"></i> 
			    	{{$contact->mobile}}
				</strong>
			</td>  
		</tr>
		@endif 
		@if(!empty($contact->tax_number))
		<tr>
			<td>
				<strong>
					<i class="circle-avatar w3-large fa fa-info margin-r-5"></i> 
			    	{{$contact->tax_number}}
				</strong>
			</td>  
		</tr>
		@endif 
	</table>  
</div>
<div class="col-md-6 col-sm-6 col-xs-6 text-right align-right  ">
	
	<table class="w3-table">
		<tr style="padding: 0px!important">
			<th style="padding: 0px!important" >
				<div class="w3-green w3-round w3-block w3-padding">
					@trans('lang_v1.account_summary')
				</div>
			</th>
		</tr>
		<tr>
			<td>
				<strong>
					<i class="circle-avatar w3-large fas fa-calendar circle-avatar"></i> 
			    	{{$ledger_details['start_date']}} @trans('lang_v1.to') {{$ledger_details['end_date']}}
				</strong>
			</td>  
		</tr>
		<tr>
			<td class="w3-display-container w3-row" >
				<strong class="w3-left" >
					<i class="circle-avatar w3-large fas fa-money-bill-alt circle-avatar"></i> 
			    	<span>
						@trans('lang_v1.opening_balance')
					</span>
				</strong>

				<span class="w3-right w3-text-deep-orange">
					@format_currency($ledger_details['beginning_balance'])
				</span>
			</td>  
		</tr>
		 
		@if( $contact->type == 'supplier' || $contact->type == 'both')
		<tr>
			<td class="w3-display-container w3-row" >
				<strong class="w3-left" >
					<i class="circle-avatar w3-large fas fa-money-bill-alt circle-avatar"></i> 
			    	<span>
						@trans('report.total_purchase')
					</span>
				</strong>

				<span class="w3-right w3-text-deep-orange">
					@format_currency($ledger_details['total_purchase'])
				</span>
			</td>  
		</tr>
		@endif
 
		@if( $contact->type == 'customer' || $contact->type == 'both')
		<tr>
			<td class="w3-display-container w3-row" >
				<strong class="w3-left" >
					<i class="circle-avatar w3-large fas fa-money-bill-alt circle-avatar"></i> 
			    	<span>
						@trans('lang_v1.total_invoice')
					</span>
				</strong>

				<span class="w3-right w3-text-deep-orange">
					@format_currency($ledger_details['total_invoice'])
				</span>
			</td>  
		</tr>
		@endif
		 
		<tr>
			<td class="w3-display-container w3-row" >
				<strong class="w3-left" >
					<i class="circle-avatar w3-large fas fa-money-bill-alt circle-avatar"></i> 
			    	<span>
						@trans('sale.total_paid')
					</span>
				</strong>

				<span class="w3-right w3-text-deep-orange">
					@format_currency($ledger_details['total_paid'])
				</span>
			</td>  
		</tr>
		
		<tr>
			<td class="w3-display-container w3-row" >
				<strong class="w3-left" >
					<i class="circle-avatar w3-large fas fa-money-bill-alt circle-avatar"></i> 
			    	<span>
						@trans('lang_v1.advance_balance')
					</span>
				</strong>

				<span class="w3-right w3-text-deep-orange">
					@format_currency($contact->balance)
				</span>
			</td>  
		</tr> 
		
		<tr>
			<td class="w3-display-container w3-row" >
				<strong class="w3-left" >
					<i class="circle-avatar w3-large fas fa-money-bill-alt circle-avatar"></i> 
			    	<span>
						@trans('lang_v1.balance_due')
					</span>
				</strong>

				<span class="w3-right w3-text-deep-orange">
					@format_currency($ledger_details['balance_due'])
				</span>
			</td>  
		</tr> 
	</table>  
</div>
@endif

<div class="col-md-12 col-sm-12 ">
	<p class="text-center w3-padding" style="text-align: center;">
		<strong>@trans('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']])</strong>
	</p>
	
		<div class="table-responsive w3-light-gray">
	<table data-title="@trans('lang_v1.ledger')" class="text-center table table-striped @if(!empty($for_pdf)) table-pdf td-border @endif" id="ledger_table">
		<thead>
			<tr class="row-border blue-heading">
				@if (request()->type == "report")
				<th width="18%" class="text-center">@trans('contact name')</th>
				@endif

				<th width="18%" class="text-center">@trans('lang_v1.date')</th>
				<th width="9%" class="text-center">@trans('purchase.ref_no')</th>
				<th width="8%" class="text-center">@trans('lang_v1.type')</th>
				<th width="10%" class="text-center">@trans('sale.location')</th>
				<th width="5%" class="text-center">@trans('sale.payment_status')</th>
				<th width="10%" class="text-center">@trans('sale.total')</th>

				<th width="10%" class="text-center">@trans('account.debit')/@trans('account.credit')</th>
				<!--
				<th width="10%" class="text-center">@trans('account.debit')</th>
				<th width="10%" class="text-center">@trans('account.credit')</th>
				-->
				<th width="5%" class="text-center">@trans('lang_v1.payment_method')</th>
				<th width="15%" class="text-center">@trans('report.others')</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ledger_details['ledger'] as $data)
			@php
				if (!isset($type))
					$type = $contact->type;
					
				$accountType = "";
				$accountTypeSpan = format_currency($data['total']);

				if ($type == 'customer') {
					if (in_array(strtolower($data['type']), ['purchase', 'sell_return'])) {
						$accountType = "debit";
						$accountTypeSpan = "<span class='w3-text-red' >- ".$accountTypeSpan."</span>";
					}else if(in_array(strtolower($data['type']),['sell', 'purchase_return', 'opening_balance', 'payment'])) { 
						$accountType = "credit";
						$accountTypeSpan = "<span class='w3-text-green' >+ ".$accountTypeSpan."</span>";
					} else {
						$accountType = ""; 
					} 
				} else {
					// supplier
					if (in_array(strtolower($data['type']), ['purchase', 'sell_return'])) {
						$accountType = "crebit";
						$accountTypeSpan = "<span class='w3-text-red' >+ ".$accountTypeSpan."</span>";
					}else if(in_array(strtolower($data['type']),['sell', 'purchase_return', 'opening_balance', 'payment'])) { 
						$accountType = "dedit";
						$accountTypeSpan = "<span class='w3-text-green' >- ".$accountTypeSpan."</span>";
					} else {
						$accountType = ""; 
					} 
				}
				
				$condition = true;

				if (request()->debit_credit) {
					$condition = $accountType == request()->debit_credit;
				}

			@endphp
			@if ($condition)
				<tr @if(!empty($for_pdf) && $loop->iteration % 2 == 0) class="odd" @endif>

					@if (request()->type == "report")
					<td class="row-border">
						<a href="{{ url('contacts') }}/{{ $data['contact_id'] }}" target="_blank" rel="noopener noreferrer">
							{{ $data['contact_name'] }}
						</a>
					</td>
					@endif

					<td class="row-border">{{@format_datetime($data['date'])}}</td> 
					<td>{{$data['ref_no']}}</td>
					<td>{{$data['type']}}</td>
					<td>{{$data['location']}}</td>
					<td>{{$data['payment_status']}}</td>
					<td class="ws-nowrap text-center">
						{!! $accountTypeSpan !!}
						<!--
							@if($data['total'] !== '') @format_currency($data['total']) @endif
						-->
					</td>

					<td class="ws-nowrap text-center">{!! $accountType !!}</td>
					<!--
					<td class="ws-nowrap text-center">@if($data['debit'] != '') @format_currency($data['debit']) @endif</td>
					<td class="ws-nowrap text-center">@if($data['credit'] != '') @format_currency($data['credit']) @endif</td>
					-->
					<td>{{$data['payment_method']}}</td>
					<td>{!! $data['others'] !!}</td>
				</tr>
			@endif
			@endforeach
		</tbody>
	</table>
	</div>
</div>


<script>
	$('#print_ledger_pdf')[0].className = 'btn w3-round-xxlarge w3-red'; 
	$('#print_ledger_pdf')[0].style = "font-size: 12px;height: 35px;";
	$('#print_ledger_pdf')[0].innerHTML = 'Export To PDF'; 
	$('#send_ledger')[0].className = 'btn w3-round-xxlarge w3-green'; 
	$('#send_ledger')[0].style = "font-size: 12px;height: 35px;";
	$('#send_ledger')[0].innerHTML = 'Send Notification'; 

	editDatatable();
</script>
