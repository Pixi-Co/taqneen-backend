@extends("sale_pos.receipts.main")

@section('content')

    <div class="w3-padding">
		<table class="w3-table">
			<tr>
                <td class="text-left w3-padding">
                    <h2>
                        @if (!empty($receipt_details->logo))
                            <img style="width: 120px;margin-right: 0px" src="{{ $receipt_details->logo }}"
                                class="img img-responsive center-block">
                        @else
                            <img style="width: 120px;margin-right: 0px" src="{{ url('/images/logo2.png') }}"
                                class="img img-responsive center-block">
                        @endif
                    </h2>
				</td>
			</tr>
		</table>
        <table class="w3-table">
            <tr>
                <td class="text-left w3-padding">
					
					@if ($receipt_details->show_barcode)
					<div 
					class="qrcode" 
					data-width="100"
					data-height="100"
					data-text="{{ $receipt_details->url }}" ></div>
					<img class=""
						style="width: 160px;display: none"
						src="data:image/png;base64,{{ DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2, 30, [39, 48, 54], true) }}"> 
					@endif

			<!-- Title of receipt -->
			@if (!empty($receipt_details->invoice_heading)) 
				<b
					style="width: 125px;text-transform: uppercase;border-bottom: 2px dashed darkgray;color: black;font-size: 40px;letter-spacing: 5px">
					{!! $receipt_details->invoice_heading !!}
				</b>
			@else
				<b
					style="width: 125px;text-transform: uppercase;border-bottom: 2px dashed darkgray;color: black;font-size: 40px;letter-spacing: 5px">
					{{ __('invoice') }}
				</b>
			@endif
                    <br>
                    <span style="width: auto;text-transform: uppercase;font-size: 25px;">
                        @if (!empty($receipt_details->invoice_no_prefix))
                            {!! $receipt_details->invoice_no_prefix !!}
                        @else
                            {{ __('no') }} :
                        @endif
                        {{ $receipt_details->invoice_no }}


                    </span>
                </td>

                <td class="text-right">
                    <br>
                    <span style="color: rgb(59, 59, 59);letter-spacing: 3px">
                        {{ $receipt_details->invoice_date }}
                    </span>
                </td>
            </tr>
        </table>
        <br>
        <table class="w3-table">
            <tr>
                <td class="text-left w3-padding" style="width: 35%">
                    <!-- Shop & Location Name  -->
                    @if (!empty($receipt_details->display_name))
                        <h6 style="text-transform: capitalize">
                            <i class="fa fa-bank"></i> {{ $receipt_details->display_name }}
                        </h6>
                    @endif

                    <!-- Address -->
                    @if (!empty($receipt_details->address))
                        <h6 style="text-transform: capitalize">
                            <i class="fa fa-map-marker"></i> {!! $receipt_details->address !!}
                        </h6>
                    @endif

                    <!-- contact -->
                    @if (!empty($receipt_details->contact))
                        <h6 style="text-transform: capitalize">
                            <i class="fa fa-phone"></i> {!! $receipt_details->contact !!}
                        </h6>
                    @endif

                    <!-- website -->
                    @if (!empty($receipt_details->website))
                        <h6 style="text-transform: capitalize">
                            <i class="fa fa-globe"></i> {!! $receipt_details->website !!}
                        </h6>
                    @endif

                    <!-- contact -->
                    @if (!empty($receipt_details->location_custom_fields))
                        <h6 style="text-transform: capitalize">
                            <i class="fa"></i> {!! $receipt_details->location_custom_fields !!}
                        </h6>
                    @endif
                </td>

                @if (!empty($receipt_details->header_text) || !empty($receipt_details->sub_heading_line1) || !empty($receipt_details->sub_heading_line2) || !empty($receipt_details->sub_heading_line3) || !empty($receipt_details->sub_heading_line4) || !empty($receipt_details->sub_heading_line5))
                    <td class="text-left" style="width: 35%;">
                        @if (!empty($receipt_details->header_text))
                            <div class="font-size: 18px">
                                <b>{!! $receipt_details->header_text !!}</b>
                            </div>
                        @endif

                        @if (!empty($receipt_details->sub_heading_line1))
                            <span>{{ $receipt_details->sub_heading_line1 }}</span>,
                        @endif

                        @if (!empty($receipt_details->sub_heading_line2))
                            <span>{{ $receipt_details->sub_heading_line2 }}</span>,
                        @endif

                        @if (!empty($receipt_details->sub_heading_line3))
                            <span>{{ $receipt_details->sub_heading_line3 }}</span>,
                        @endif

                        @if (!empty($receipt_details->sub_heading_line4))
                            <span>{{ $receipt_details->sub_heading_line4 }}</span>,
                        @endif

                        @if (!empty($receipt_details->sub_heading_line5))
                            <span>{{ $receipt_details->sub_heading_line5 }}</span>
                        @endif
                    </td>
                @endif

                <td class="text-right" style="width: 30%">

                    <!-- Total Due-->
                    @if (!empty($receipt_details->total_due))
                        {!! $receipt_details->total_due_label !!} :
                        <br>
                        <b
                            style="width: 125px;text-transform: uppercase;border-bottom: 2px dashed darkgray;color: black;font-size: 40px;letter-spacing: 2px">
                            {{ $receipt_details->total_due }}
                        </b>

                    @endif
                </td>
            </tr>
        </table>
        <br>
        <table class="w3-table">
            <td class="text-left" style="width: 30%;text-transform: capitalize">
                <!-- customer info -->

                @if (!empty($receipt_details->customer_name))
                    <b class="header-label">{{ $receipt_details->customer_label }}: </b>
                    {{ $receipt_details->customer_name }}
                    <br>
                @endif

                @if (!empty($receipt_details->customer_info))
                    <b class="header-label">{{ __('customer info') }}: </b>{!! str_replace('<br>', ', ', $receipt_details->customer_info) !!}
                    <br />
                @endif

                @if (!empty($receipt_details->client_id_label))
                    <b class="header-label">{{ $receipt_details->client_id_label }}: </b>
                    {{ $receipt_details->client_id }}
                    <br />
                @endif
                @if (!empty($receipt_details->customer_tax_label))
                    <b class="header-label">{{ $receipt_details->customer_tax_label }}: </b>
                    {{ $receipt_details->customer_tax_number }}
                    <br />
                @endif
                @if (!empty($receipt_details->customer_custom_fields))
                    {!! $receipt_details->customer_custom_fields !!}
                    <br />
                @endif
                @if (!empty($receipt_details->sales_person_label))
                    <b class="header-label">{{ $receipt_details->sales_person_label }}: </b>
                    {{ $receipt_details->sales_person }}
                    <br />
                @endif
                @if (!empty($receipt_details->customer_rp_label))
                    <b class="header-label">{{ $receipt_details->customer_rp_label }}: </b>
                    {{ $receipt_details->customer_total_rp }}
                    <br />
                @endif
            </td>
        </table>
        <br>

        <table class="w3-table w3-bordered">
            <thead>
                <tr>
                    <th width="40%">{{ $receipt_details->table_product_label }}</th>
                    <th class="text-right" width="20%">{{ $receipt_details->table_qty_label }}</th>
                    <th class="text-right" width="20%">{{ $receipt_details->table_unit_price_label }}</th>
                    <th class="text-right" width="20%">{{ $receipt_details->table_subtotal_label }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($receipt_details->lines as $line)
                    <tr>
                        <td>
                            @if (!empty($line['image']))
                                <img src="{{ $line['image'] }}" alt="Image" width="50"
                                    style="float: left; margin-right: 8px;">
                            @endif
                            {{ $line['name'] }} {{ $line['product_variation'] }} {{ $line['variation'] }}
                            @if (!empty($line['sub_sku'])), {{ $line['sub_sku'] }} @endif @if (!empty($line['brand'])), {{ $line['brand'] }} @endif @if (!empty($line['cat_code'])), {{ $line['cat_code'] }}@endif
                            @if (!empty($line['product_custom_fields'])), {{ $line['product_custom_fields'] }} @endif
                            @if (!empty($line['sell_line_note']))
                                <br>
                                <small>
                                    {{ $line['sell_line_note'] }}
                                </small>
                            @endif
                            @if (!empty($line['lot_number']))<br> {{ $line['lot_number_label'] }}:  {{ $line['lot_number'] }} @endif
                            @if (!empty($line['product_expiry'])), {{ $line['product_expiry_label'] }}:  {{ $line['product_expiry'] }} @endif

                            @if (!empty($line['warranty_name'])) <br><small>{{ $line['warranty_name'] }} </small>@endif @if (!empty($line['warranty_exp_date'])) <small>- {{ @format_date($line['warranty_exp_date']) }} </small>@endif
                            @if (!empty($line['warranty_description'])) <small> {{ $line['warranty_description'] ?? '' }}</small>@endif
                        </td>
                        <td class="text-right">{{ $line['quantity'] }} {{ $line['units'] }} </td>
                        <td class="text-right">{{ $line['unit_price_inc_tax'] }}</td>
                        <td class="text-right">{{ $line['line_total'] }}</td>
                    </tr>
                    @if (!empty($line['modifiers']))
                        @foreach ($line['modifiers'] as $modifier)
                            <tr>
                                <td>
                                    {{ $modifier['name'] }} {{ $modifier['variation'] }}
                                    @if (!empty($modifier['sub_sku'])), {{ $modifier['sub_sku'] }} @endif @if (!empty($modifier['cat_code'])), {{ $modifier['cat_code'] }}@endif
                                    @if (!empty($modifier['sell_line_note']))({{ $modifier['sell_line_note'] }}) @endif
                                </td>
                                <td class="text-right">{{ $modifier['quantity'] }} {{ $modifier['units'] }}
                                </td>
                                <td class="text-right">{{ $modifier['unit_price_inc_tax'] }}</td>
                                <td class="text-right">{{ $modifier['line_total'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                @empty
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>

        <table class="w3-table">
            @if (!empty($receipt_details->payments))
                <td class="text-left" style="width: 30%;text-transform: capitalize">
                    <table>
                        @foreach ($receipt_details->payments as $payment)
                            <tr>
                                <td>{{ $payment['method'] }}</td>
                                <td class="text-right">{{ $payment['amount'] }}</td>
                                <td class="text-right">{{ $payment['date'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            @endif

            <td class="text-left" style="width: 30%;text-transform: capitalize">
                <!-- total info -->
				<table class="w3-table">
					@if (!empty($receipt_details->total_paid))
					<tr>
						<th>
							{{ $receipt_details->total_paid_label }}
						</th>
						<td>
							{{ $receipt_details->total_paid }}
						</td>
					</tr>
					@endif
					@if (!empty($receipt_details->total_due))
					<tr>
						<th>
							{{ $receipt_details->total_due_label }}
						</th>
						<td>
							{{ $receipt_details->total_due }}
						</td>
					</tr>
					@endif
					@if (!empty($receipt_details->all_due))
					<tr>
						<th>
							{{ $receipt_details->all_bal_label }}
						</th>
						<td>
							{{ $receipt_details->all_due }}
						</td>
					</tr>
					@endif
				</table>  
            </td>
            <td class="text-left" style="width: 30%;text-transform: capitalize">
                <table class="w3-table">

                    @if (!empty($receipt_details->total_quantity_label))
                        <tr class="color-555">
                            <th style="width:70%">
                                {!! $receipt_details->total_quantity_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->total_quantity }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <th style="width:70%">
                            {!! $receipt_details->subtotal_label !!}
                        </th>
                        <td class="text-right">
                            {{ $receipt_details->subtotal }}
                        </td>
                    </tr>
                    @if (!empty($receipt_details->total_exempt_uf))
                        <tr>
                            <th style="width:70%">
                                @trans('lang_v1.exempt')
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->total_exempt }}
                            </td>
                        </tr>
                    @endif
                    <!-- Shipping Charges -->
                    @if (!empty($receipt_details->shipping_charges))
                        <tr>
                            <th style="width:70%">
                                {!! $receipt_details->shipping_charges_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->shipping_charges }}
                            </td>
                        </tr>
                    @endif

                    @if (!empty($receipt_details->packing_charge))
                        <tr>
                            <th style="width:70%">
                                {!! $receipt_details->packing_charge_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->packing_charge }}
                            </td>
                        </tr>
                    @endif

                    <!-- Discount -->
                    @if (!empty($receipt_details->discount))
                        <tr>
                            <th>
                                {!! $receipt_details->discount_label !!}
                            </th>

                            <td class="text-right">
                                (-) {{ $receipt_details->discount }}
                            </td>
                        </tr>
                    @endif

                    @if (!empty($receipt_details->reward_point_label))
                        <tr>
                            <th>
                                {!! $receipt_details->reward_point_label !!}
                            </th>

                            <td class="text-right">
                                (-) {{ $receipt_details->reward_point_amount }}
                            </td>
                        </tr>
                    @endif

                    <!-- Tax -->
                    @if (!empty($receipt_details->tax))
                        <tr>
                            <th>
                                {!! $receipt_details->tax_label !!}
                            </th>
                            <td class="text-right">
                                (+) {{ $receipt_details->tax }}
                            </td>
                        </tr>
                    @endif

                    @if ($receipt_details->round_off_amount > 0)
                        <tr>
                            <th>
                                {!! $receipt_details->round_off_label !!}
                            </th>
                            <td class="text-right">
                                {{ $receipt_details->round_off }}
                            </td>
                        </tr>
                    @endif

                    <!-- Total -->
                    <tr>
                        <th>
                            {!! $receipt_details->total_label !!}
                        </th>
                        <td class="text-right">
                            {{ $receipt_details->total }}
                            @if (!empty($receipt_details->total_in_words))
                                <br>
                                <small>({{ $receipt_details->total_in_words }})</small>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </table>
		<br>

		
        <div class="row">
            @includeIf('sale_pos.receipts.partial.common_repair_invoice')
        </div>
		<p>{!! nl2br($receipt_details->additional_notes) !!}</p>
		
		<!-- business information here -->
		<div class="col-xs-12 text-center">

			<p>
				@if (!empty($receipt_details->tax_info1))
					<b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
				@endif

				@if (!empty($receipt_details->tax_info2))
					<b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}
				@endif
			</p>


			<!-- Invoice  number, Date  -->
			<p style="width: 100% !important" class="word-wrap">
				<span class="pull-left text-left word-wrap">


					@if (!empty($receipt_details->types_of_service))
						<br />
						<span class="pull-left text-left type-of-service">
							<strong>{!! $receipt_details->types_of_service_label !!}:</strong>
							{{ $receipt_details->types_of_service }}
							<!-- Waiter info -->
							@if (!empty($receipt_details->types_of_service_custom_fields))
								@foreach ($receipt_details->types_of_service_custom_fields as $key => $value)
									<br><strong>{{ $key }}: </strong> {{ $value }}
								@endforeach
							@endif
						</span>
					@endif

					<!-- Table information-->
					@if (!empty($receipt_details->table_label) || !empty($receipt_details->table))
						<br />
						<span class="pull-left text-left table-info">
							@if (!empty($receipt_details->table_label))
								<b>{!! $receipt_details->table_label !!}</b>
							@endif
							{{ $receipt_details->table }}

							<!-- Waiter info -->
						</span>
					@endif

				</span>

				<span class="pull-right text-left">


					@if (!empty($receipt_details->due_date_label))
						<br><b>{{ $receipt_details->due_date_label }}</b> {{ $receipt_details->due_date ?? '' }}
					@endif

					@if (!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
						<br>
						@if (!empty($receipt_details->brand_label))
							<b>{!! $receipt_details->brand_label !!}</b>
						@endif
						{{ $receipt_details->repair_brand }}
					@endif


					@if (!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
						<br>
						@if (!empty($receipt_details->device_label))
							<b>{!! $receipt_details->device_label !!}</b>
						@endif
						{{ $receipt_details->repair_device }}
					@endif

					@if (!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
						<br>
						@if (!empty($receipt_details->model_no_label))
							<b>{!! $receipt_details->model_no_label !!}</b>
						@endif
						{{ $receipt_details->repair_model_no }}
					@endif

					@if (!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
						<br>
						@if (!empty($receipt_details->serial_no_label))
							<b>{!! $receipt_details->serial_no_label !!}</b>
						@endif
						{{ $receipt_details->repair_serial_no }}<br>
					@endif
					@if (!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
						@if (!empty($receipt_details->repair_status_label))
							<b>{!! $receipt_details->repair_status_label !!}</b>
						@endif
						{{ $receipt_details->repair_status }}<br>
					@endif

					@if (!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
						@if (!empty($receipt_details->repair_warranty_label))
							<b>{!! $receipt_details->repair_warranty_label !!}</b>
						@endif
						{{ $receipt_details->repair_warranty }}
						<br>
					@endif

					<!-- Waiter info -->
					@if (!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
						<br />
						@if (!empty($receipt_details->service_staff_label))
							<b>{!! $receipt_details->service_staff_label !!}</b>
						@endif
						{{ $receipt_details->service_staff }}
					@endif
				</span>
			</p>
		</div>

        @if (!empty($receipt_details->footer_text))
            <div class="row">
                <div class="col-xs-12">
                    {!! $receipt_details->footer_text !!}
                </div>
            </div>
        @endif
    </div>

    <br> 
@endsection
 
