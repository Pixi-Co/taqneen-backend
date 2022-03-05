@if(request()->session()->get('user.business_id') == 3 )
<style>
    table{
        font-family: serif;
        color: rgba(12, 12, 13, 1);
        font-size:17.5px;
    }
    b{
        margin-right: 35px;
    }
    .top-buffer {
        margin-top:10px;
    }
    .top-210-buffer{
        margin-top:15px;
    }
</style>
<!--  -->
<table style="width:100%;  @if(request()->session()->get('user.language') == 'ar') direction: ltr; @endif">
	<thead>
		<tr>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>
<div class="row">
    <div class="col-md-12 text-center">
	    <!-- @if(request()->session()->get('user.language') == 'ar') pull-left @else pull-right @endif -->
		<div class="col-md-4 pull-right" style="width:30%;float:right;">
    		@if(!empty($receipt_details->logo))
    			<img src="{{$receipt_details->logo}}" class="img img-responsive">
    			<br/>
    		@endif
		</div>
		
	</div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
		<span><b>ORIGINAL INVOICE</b></span>
	</div>
</div>
<table style="border-collapse: collapse;margin-left: 15px;width:100%;" border="0">
    <tbody>
        <tr>
            <td style="font-size: 10px !important;vertical-align: top;width:15%;">
                <p style="margin:0;text-align: right;">الفرع</p>
                <strong>
                    <p>BRANCH</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:85%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> {!! $receipt_details->address !!} </p>
            </td>
        </tr>
        <tr>
            <td style="font-size: 10px !important;vertical-align: top;width:15%;">
                <p style="margin:0;text-align: right;">العميل</p>
                <strong>
                    <p>CUSTOMER</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:85%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> {!! $receipt_details->customer_name !!} </p>
            </td>
        </tr>
    </tbody>
</table>

<table style="border-collapse: collapse;margin-left: 15px;width:100%;" border="0">
    <tbody>
        <tr>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">نوع البيع</p>
                <strong>
                    <p>SALE TYPE</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @foreach($receipt_details->payments as $payment) {{ $payment['method'] }} @endforeach </p>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">رقم الفاتورة</p>
                <strong>
                    <p>INVOICE NO.</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->invoice_no)) {{ $receipt_details->invoice_no }} @endif </p>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">التاريخ</p>
                <strong>
                    <p>DATE</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->invoice_date)) {{ $receipt_details->invoice_date }} @endif </p>
            </td>
        </tr>
        <tr>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">رقم التسجيل الضريبي للعميل</p>
                <strong>
                    <p>CUSTOMER TAX File No</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->customer_tax_number)) {{ $receipt_details->customer_tax_number }} @endif </p>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">رقم أمر الشراء</p>
                <strong>
                    <p>P.O.NO.</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->customer_custom_field2)) {{ $receipt_details->customer_custom_field2 }} @endif </p>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">البائع</p>
                <strong>
                    <p>SALESMAN</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->sales_person)) {{ $receipt_details->sales_person }} @endif </p>
            </td>
        </tr>
        <tr>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">تحرير الفاتورة الى</p>
                <strong>
                    <p>Bill To ADDRESS</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->customer_custom_field4)) {{ $receipt_details->customer_custom_field4 }} @endif </p>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">رقم أمر التحضير</p>
                <strong>
                    <p>DRAFT NO.</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->customer_custom_field3)) {{ $receipt_details->customer_custom_field3 }} @endif </p>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">رقم التليفون</p>
                <strong>
                    <p>PHONE NUMBER</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->customer_landline)) {{ $receipt_details->customer_landline }} @endif </p>
            </td>
        </tr>
        <tr>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                <p style="margin:0;text-align: right;">رقم الجوال</p>
                <strong>
                    <p>MOBILE NUMBER</p>
                </strong>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                <p style="font-size: 10px !important;padding-left: 15px;"> @if(!empty($receipt_details->customer_mobile)) {{ $receipt_details->customer_mobile }} @endif </p>
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:13%;">
            </td>
            <td style="font-size: 10px !important;vertical-align: top;width:21%;">
            </td>
        </tr>
    </tbody>
</table>

<div class="row">
	@includeIf('sub_pos.receipts.partial.common_repair_invoice')
</div>

<div class="row">
	<div class="col-xs-12">
		<br/>
		<table class="table table-slim" style="border: 1px solid #000;height: 150px;">
			<thead style="background-color: #E7F3FD !important; color:black !important; font-size: 10px !important">
				<tr class="bg-info" style="background-color: #E7F3FD !important;" 
				    class="table-no-side-cell-border table-no-top-cell-border text-center">
					<th class="text-center" style="background-color: #E7F3FD !important;width: 5% !important;border: 1px solid #000;vertical-align:top;">السطر <br/> Line</th>
					
					@php
						$p_width = 25;
					@endphp
					@if($receipt_details->show_cat_code != 1)
						@php
							$p_width = 35;
						@endphp
					@endif
					
					@php
					    $custom_labels = json_decode(session('business.custom_labels'), true);
                        $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
                        $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
                        $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
                        $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
					@endphp
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 10% !important;border: 1px solid #000;vertical-align:top;">
					     رقم الشاسيه <br/> Chassis NO.
					</th>

					<th  class="text-center" style="background-color: #E7F3FD !important; width: 20% !important;border: 1px solid #000;vertical-align:top;">
					    رقم المودیل والوصف <br/> Model No. & Description
        			</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 8% !important;border: 1px solid #000;vertical-align:top;">
					    رقم اللوحة <br/> Plate No.
					</th>

					<th class="text-center" style="background-color: #E7F3FD !important; width: 7% !important;border: 1px solid #000;vertical-align:top;">
					    سعر البيع  <br/> Selling Price
					</th>

					<th class="text-center" style="background-color: #E7F3FD !important; width: 7% !important;border: 1px solid #000;vertical-align:top;">
					   الاضافات <br/> Extra Charges
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 5% !important;border: 1px solid #000;vertical-align:top;">
					   الخصم <br/> Disc 
					</th>

					<th class="text-center" style="background-color: #E7F3FD !important; width: 7% !important;border: 1px solid #000;vertical-align:top;">
					   صافى القيمه <br/> Net AMT
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 10% !important;border: 1px solid #000;vertical-align:top;">
					   نسبة ضريبة القيمة المضافة <br/> VAT%
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 13% !important;border: 1px solid #000;vertical-align:top;">
					      ضريبة القيمة المضافة <br/> VAT
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 12% !important;border: 1px solid #000;vertical-align:top;">
					   إجمالى القيمة <br/> Total AMT
					</th>
				</tr>
			</thead>
			<tbody>
			    
			    @php
		            $total_selling_price = 0;
		            $total_extra_charges = 0;
		            $total_discount = 0;   
		            $total_vat_charges = 0; 
		            $chassi_modifier = '';
		        @endphp
			    @foreach($receipt_details->lines as $line)
                    @if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
						    @if($modifier['unit_price_exc_tax'] == 0.00)
						        @php $chassi_modifier = $modifier['variation'] @endphp
						    @endif
						@endforeach
					@endif
					<tr>
						<td class="text-center" style="font-size: 10px !important;border-right: 1px solid;">
							{{$loop->iteration}}
						</td>
						
                        <td class="text-center" style="font-size: 10px !important;border-right: 1px solid;">
						    @if($chassi_modifier) {{$chassi_modifier}} @endif
						</td>

						<td style="word-break: break-all; font-size: 10px !important;border-right: 1px solid;">
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
                            
                            @if(!empty($line['sell_line_note']))
                            	<br>
                             <small class="text-muted"><i>{{$line['sell_line_note']}}</i></small>
                             @endif
                            @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif 

                            @if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                            @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif
                        </td>
                        
                        <td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
                            @if(!empty($receipt_details->customer_custom_field1)){{ $receipt_details->customer_custom_field1 }} @endif
						</td>
						
						<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
							{{$line['unit_price_exc_tax']}}
						</td>
						
						<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
							0.00
						</td>
						
						<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
							{{ $receipt_details->discount }}
						</td>
						
						<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
						    {{ $line['unit_price_before_discount_uf'] - $line['line_discount_uf']}}
						</td>
						
						<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
						    {{ $line['tax_percent'] }} %
						</td>
						
						<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
							{{$receipt_details->tax}}
							
						</td>
						
						<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;">
							{{$line['line_total']}}
						</td>
						
					</tr>
					@php $total_selling_price += $line['unit_price_before_discount_uf']; @endphp 
					
					
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
						    @if($modifier['unit_price_exc_tax'] != 0.00)
						    
							<tr style='border-top:none;'>
								<td class="text-center" style="border-right: 1px solid;border-top: none;">
									&nbsp;
								</td>
								
								<td class="text-center" style="border-right: 1px solid;border-top: none;">
									&nbsp;
								</td>
								
								<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif 
		                            @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif 
		                        </td>
		                        
		                        <td class="text-center" style="border-right: 1px solid;border-top: none;">
									&nbsp;
								</td>

								<td class="text-center" style="border-right: 1px solid;border-top: none;">
									&nbsp;
								</td>
								
								<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
									{{$modifier['unit_price_exc_tax']}}
									
								</td>
								
								<td class="text-center" style="font-size: 10px !important;border-right: 1px solid;border-top: none;">
								    {{-- $modifier['disc'] --}}
								    0
								</td>
								
								<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
									{{$modifier['unit_price_exc_tax']}}
									
								</td>
								
								<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
									{{ $line['tax_percent'] }} %
								</td>
								
								<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
									{{  number_format($modifier['unit_price_inc_tax'] - $modifier['unit_price_exc_tax'],2) }}
									
								</td>
								
								<td class="text-center" style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
									{{$modifier['line_total']}}
								</td>
							</tr>
							
							@php $total_extra_charges += $modifier['unit_price_exc_tax']; @endphp 
							
							
							@endif

						@endforeach
					@endif
					
					
				@endforeach
                
              
				@php
					$lines = count($receipt_details->lines);
				@endphp

				

			</tbody>
		</table>
	</div>
</div>

<div class="row top-210-buffer">
    <!-- @if(request()->session()->get('user.language') == 'ar') pull-right @else pull-left @endif -->
    <div class="col-xs-5 text-right ">
        <table style="border-collapse: collapse; width: 100%;" border="1">
            <tbody>
                <tr>
                    <td style="width: 100%;">
                        <p style="text-align: right;padding: 2%;font-size: 13px !important;font-family: sans-serif;">لقد استلمت السيارة / السيارات بحالة سليمة و كاملة العدة و اللوازم و ذلك بعد معاينتها كاملة. من المفهوم أن الشركة المنتجة لها الحق في تغيير الشكل أو الموديل في أي وقت و بدون سابق إخطار و توقيع العميل أدناه على الاستلام يعني قبول السيارة / السيارات بحالتها</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- @if(request()->session()->get('user.language') == 'ar') pull-left @else pull-right @endif -->
    <div class="col-xs-7 " style="margin-left: 0px;">
        <table style="border-collapse: collapse; width: 100%;" border="1">
            <tbody>
            <tr>
                <td class="text-center" style="width: 10%; font-size: 13px !important"><span>ريال سعودي</span><br><strong>SAR</strong></td>
                <td class="text-center" style="width: 15%; font-size: 13px !important">
                    <span>{{ number_format($total_selling_price,2) }}</span>
                    <br/>
                    <span>إجمالى سعر البيع</span>
                    <br/>
                    <strong>
                        Total Selling Price
                    </strong>
                </td>
                <td class="text-center" style="width: 15%; font-size: 13px !important">
                    <span>{{ number_format($total_extra_charges,2) }}</span>
                    <br/>
                    <span>إجمالى الاضافات</span>
                    <br/>
                    <strong>
                        Total Extra Charges
                    </strong>
                </td>
                <td class="text-center" class="text-center" style="width: 15%; font-size: 13px !important">
                    <span>{{ $receipt_details->discount }}</span>
                    <br/>
                    <span>إجمالى الخصم</span>
                    <br/>
                    <strong>
                        Total Discount
                    </strong>
                </td>               
                <td class="text-center" style="width: 15%; font-size: 13px !important">
                    <span>{{ number_format($receipt_details->subtotal_unformatted,2) }}</span>
                    <br/>
                    <span>إجمالى صافى القيمة</span>
                    <br/>
                    <strong>
                        Total Net Amount
                    </strong>
                </td>
                <td class="text-center" style="width: 15%; font-size: 13px !important">
                    <span>{{ $receipt_details->tax }}</span>
                    <br/>
                    <span>إجمالى ضريبة القيمة المضافة</span>
                    <br/>
                    <strong>
                        Total VAT Charges
                    </strong>
                </td>
                <td class="text-center" style="width: 15%; font-size: 13px !important">
                    <span>{{ $receipt_details->total }}</span>
                    <br/>
                    <span>إجمالى القيمة</span>
                    <br/>
                    <strong>
                        Total Payment
                    </strong> 
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</div>

<div class="row" style=" margin-top: 10px;">
    <!-- @if(request()->session()->get('user.language') == 'ar') pull-right @else pull-left @endif -->
    <div class="col-xs-7  ">
        <p class="" style="font-size: 15px !important; ">We undertake that the vehicle title will be retained in our name for a minimum period of six months from this date
        <br/>
        <table style="border-collapse: collapse; height: 144px; margin-left: auto; margin-right: auto;" border="0">
            <tbody>
                <tr style="height: 53px;">
                    <td class="text-center" style="width: 33.3333%; height: 53px; font-size: 15px !important">
                        <p style="margin:0;">مدير المعرض</p>
                        <strong>
                            <p>SHOWROOM  MANAGER</p>
                        </strong>
                    </td>
                    <td class="text-center" style="width: 33.3333%; height: 53px; font-size: 15px !important">
                        <p style="margin:0;">العميل</p>
                        <strong>
                            <p>CUSTOMER</p>
                        </strong>
                    </td>
                    <td class="text-center" style="width: 33.3333%; height: 53px; font-size: 15px !important">
                        <p style="margin:0;">البائع</p>
                        <strong>
                            <p>SALESMAN</p>
                        </strong>
                    </td>
                    </tr>
                    <tr>
                        <td style="width: 33.3333%; text-align: center;"></td>
                        <td style="width: 33.3333%; text-align: center;"></td>
                        <td style="width: 33.3333%; text-align: center;">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--  @if(request()->session()->get('user.language') == 'ar') pull-left @else pull-right @endif -->
    <div class="col-xs-5 ">
        <div class="col-xs-12">
            <table style="border-collapse: collapse; width : 100%;font-size:13px !important;" border="1">
            <tbody>
                <tr>
                    <td colspan="3" style="font-size: 13px !important padding-left: 5px; padding-right: 5px;"><strong style="padding-left:5px;">Charges <p class="text-right pull-right" style="display:inline-block;">إضافات</p></strong> </td>
                </tr>
                <tr>
                    <td style="width: 33.3333%; font-size: 11px !important; padding-left: 5px;">REG &amp; PLATES<br />TRANSPORTATION<br />SERVICE CHARGES<br />ADDITIONAL OPT<br />INSURANCE<br />OTHER CHARGES</td>
                    <td style="width: 33.3333%; font-size: 11px !important; text-align: center;">RE<br />TR<br />SE<br />OT<br />IN<br />OT</td>
                    <td style="width: 33.3333%; font-size: 11px !important; padding-right: 5px; text-align: right;">لوحات و إستمارة<br />شحن<br />صيانة<br />إضافات أخرى<br />تأمين<br />أخرى</td>
                </tr>
            </tbody>
        </table>
        </div>
        <br/>
        <div class="col-xs-12" style="width: 100%;">
            <table style="border-collapse: collapse; width: 100%;margin-top:10px;font-size:13px !important;" border="1">
            <tbody>
                <tr>
                    <td style="width: 50%; font-size: 13px !important; text-align: center;">
                        <strong>رقم التسجيل الضريبي</strong>
                    </td>
                    <td style="width: 50%; font-size: 13px !important; text-align: center;" rowspan="2"><strong>300792591600003</strong></td>
                </tr>
                <tr>
                    <td style="width: 50%; font-size: 13px !important; text-align: center;"><strong>TAX FILE NO.</strong></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    
</div>

<div class="row" style="margin-top:auto;">
    <div class="col-xs-12">
        <table style="border-collapse: collapse; width: 100%;height: 60px;" border="1">
        <tbody>
        <tr>
        <td style="width: 30%;">
            @php $footer_logo = asset('uploads/invoice_logos/Capture2.JPG'); @endphp
            <img src="{{$footer_logo}}" class="img center-block" style="width: 95%;">
        </td>
        <td style="width: 70%; font-size: 10px !important; text-align: right;">
            <p style="font-size: 12px;color: gray;font-weight: bold;">
            Balupaid Automotive Co. | Paid Up Capital 1,000,000S.R. | C.R 4030219586 | C.C 164110
            <br/>
            س.ت 4030219586 | غ.ت 164110 |  رأس المال المدفوع 1,000,000 ريال سعودى | شركة بالبيلد للسيارات
            </p>
        </td>
        </tr>
        </tbody>
        </table>
    </div>
</div>


			</td>
		</tr>
	</tbody>
</table>
@else

<table style="width:100%;">
	<thead>
		<tr>
			<td>
				<p class="text-right">
					<small class="text-muted-imp">
						@if(!empty($receipt_details->invoice_no_prefix))
							{!! $receipt_details->invoice_no_prefix !!}
						@endif

						{{$receipt_details->invoice_no}}
					</small>
				</p>
			</td>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td class="text-center" style="line-height: 15px !important; padding-bottom: 10px !important">
				@if(!empty($receipt_details->header_text))
					{!! $receipt_details->header_text !!}
				@endif

				@php
					$sub_headings = implode('<br/>', array_filter([$receipt_details->sub_heading_line1, $receipt_details->sub_heading_line2, $receipt_details->sub_heading_line3, $receipt_details->sub_heading_line4, $receipt_details->sub_heading_line5]));
				@endphp

				@if(!empty($sub_headings))
					<span>{!! $sub_headings !!}</span>
				@endif

				@if(!empty($receipt_details->invoice_heading))
					<p class="" style="font-weight: bold; font-size: 35px !important">{!! $receipt_details->invoice_heading !!}</p>
				@endif
			</td>
		</tr>

		<tr>
			<td>

<!-- business information here -->
<div class="row invoice-info">

	<div class="col-md-6 invoice-col width-50">

		<div class="text-right font-23">
			@if(!empty($receipt_details->invoice_no_prefix))
				<span class="pull-left">{!! $receipt_details->invoice_no_prefix !!}</span>
			@endif

			{{$receipt_details->invoice_no}}
		</div>

		<!-- Total Due-->
		@if(!empty($receipt_details->total_due))
			<div class="bg-light-blue-active text-right font-23 padding-5">
				<span class="pull-left bg-light-blue-active">
					{!! $receipt_details->total_due_label !!}
				</span>

				{{$receipt_details->total_due}}
			</div>
		@endif

		@if(!empty($receipt_details->all_due))
			<div class="bg-light-blue-active text-right font-23 padding-5">
				<span class="pull-left bg-light-blue-active">
					{!! $receipt_details->all_bal_label !!}
				</span>

				{{$receipt_details->all_due}}
			</div>
		@endif
		
		<!-- Total Paid-->
		@if(!empty($receipt_details->total_paid))
			<div class="text-right font-23 color-555">
				<span class="pull-left">{!! $receipt_details->total_paid_label !!}</span>
				{{$receipt_details->total_paid}}
			</div>
		@endif
		<!-- Date-->
		@if(!empty($receipt_details->date_label))
			<div class="text-right font-23 color-555">
				<span class="pull-left">
					{{$receipt_details->date_label}}
				</span>

				{{$receipt_details->invoice_date}}
			</div>
		@endif
		@if(!empty($receipt_details->due_date_label))
			<div class="text-right font-23 color-555">
				<span class="pull-left">
					{{$receipt_details->due_date_label}}
				</span>

				{{$receipt_details->due_date ?? ''}}
			</div>
		@endif

		<div class="word-wrap">
			@if(!empty($receipt_details->customer_label))
				<b>{{ $receipt_details->customer_label }}</b><br/>
			@endif

			<!-- customer info -->
			@if(!empty($receipt_details->customer_name))
				{{ $receipt_details->customer_name }}<br>
			@endif
			@if(!empty($receipt_details->customer_info))
				{!! $receipt_details->customer_info !!}
			@endif
			@if(!empty($receipt_details->client_id_label))
				<br/>
				<strong>{{ $receipt_details->client_id_label }}</strong> {{ $receipt_details->client_id }}
			@endif
			@if(!empty($receipt_details->customer_tax_label))
				<br/>
				<strong>{{ $receipt_details->customer_tax_label }}</strong> {{ $receipt_details->customer_tax_number }}
			@endif
			@if(!empty($receipt_details->customer_custom_fields))
				<br/>{!! $receipt_details->customer_custom_fields !!}
			@endif
			@if(!empty($receipt_details->sales_person_label))
				<br/>
				<strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}
			@endif

			@if(!empty($receipt_details->customer_rp_label))
				<br/>
				<strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}
			@endif

			<!-- Display type of service details -->
			@if(!empty($receipt_details->types_of_service))
				<span class="pull-left text-left">
					<strong>{!! $receipt_details->types_of_service_label !!}:</strong>
					{{$receipt_details->types_of_service}}
					<!-- Waiter info -->
					@if(!empty($receipt_details->types_of_service_custom_fields))
						<br>
						@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
							<strong>{{$key}}: </strong> {{$value}}@if(!$loop->last), @endif
						@endforeach
					@endif
				</span>
			@endif
		</div>

	</div>

	<div class="col-md-6 invoice-col width-50 color-555">
		
		<!-- Logo -->
		@if(!empty($receipt_details->logo))
			<img src="{{$receipt_details->logo}}" class="img center-block">
			<br/>
		@endif

		<!-- Shop & Location Name  -->
		@if(!empty($receipt_details->display_name))
			<p>
				{{$receipt_details->display_name}}
				@if(!empty($receipt_details->address))
					<br/>{!! $receipt_details->address !!}
				@endif

				@if(!empty($receipt_details->contact))
					<br/>{{ $receipt_details->contact }}
				@endif

				@if(!empty($receipt_details->website))
					<br/>{{ $receipt_details->website }}
				@endif

				@if(!empty($receipt_details->tax_info1))
					<br/>{{ $receipt_details->tax_label1 }} {{ $receipt_details->tax_info1 }}
				@endif

				@if(!empty($receipt_details->tax_info2))
					<br/>{{ $receipt_details->tax_label2 }} {{ $receipt_details->tax_info2 }}
				@endif

				@if(!empty($receipt_details->location_custom_fields))
					<br/>{{ $receipt_details->location_custom_fields }}
				@endif
			</p>
		@endif

		<!-- Table information-->
        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
        	<p>
				@if(!empty($receipt_details->table_label))
					{!! $receipt_details->table_label !!}
				@endif
				{{$receipt_details->table}}
			</p>
        @endif

		<!-- Waiter info -->
		@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
        	<p>
				@if(!empty($receipt_details->service_staff_label))
					{!! $receipt_details->service_staff_label !!}
				@endif
				{{$receipt_details->service_staff}}
			</p>
        @endif



        <div class="word-wrap">

			<p class="text-right color-555">
			@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
				@if(!empty($receipt_details->brand_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->brand_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_brand}}<br>
	        @endif


	        @if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
				@if(!empty($receipt_details->device_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->device_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_device}}<br>
	        @endif

			@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
				@if(!empty($receipt_details->model_no_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->model_no_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_model_no}} <br>
	        @endif

			@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
				@if(!empty($receipt_details->serial_no_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->serial_no_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_serial_no}}<br>
	        @endif
			@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
				@if(!empty($receipt_details->repair_status_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->repair_status_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_status}}<br>
	        @endif
	        
	        @if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
				@if(!empty($receipt_details->repair_warranty_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->repair_warranty_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_warranty}}
				<br>
	        @endif
	        </p>
		</div>
	</div>
</div>

<div class="row">
	@includeIf('sub_pos.receipts.partial.common_repair_invoice')
</div>

<div class="row color-555">
	<div class="col-xs-12">
		<br/>
		<table class="table table-bordered table-no-top-cell-border table-slim">
			<thead>
				<tr style="background-color: #357ca5 !important; color: white !important; font-size: 15px !important" class="table-no-side-cell-border table-no-top-cell-border text-center">
					<td style="background-color: #357ca5 !important; color: white !important;width: 5% !important">#</td>
					
					@php
						$p_width = 25;
					@endphp
					@if($receipt_details->show_cat_code != 1)
						@php
							$p_width = 35;
						@endphp
					@endif
					<td style="background-color: #357ca5 !important; color: white !important; width: {{$p_width}}% !important">
						{{$receipt_details->table_product_label}}
					</td>

					@if($receipt_details->show_cat_code == 1)
						<td style="background-color: #357ca5 !important; color: white !important; width: 10% !important;">{{$receipt_details->cat_code_label}}</td>
					@endif
					
					<td style="background-color: #357ca5 !important; color: white !important;width: 10% !important;">
						{{$receipt_details->table_qty_label}}
					</td>
					<td style="background-color: #357ca5 !important; color: white !important;width: 10% !important;">
						{{$receipt_details->table_unit_price_label}}
					</td>
					<td style="background-color: #357ca5 !important; color: white !important;width: 10% !important;">
						{{$receipt_details->line_discount_label}}
					</td>
					<td style="background-color: #357ca5 !important; color: white !important;width: 10% !important;">
						{{$receipt_details->line_tax_label}}
					</td>
					<td style="background-color: #357ca5 !important; color: white !important;width: 10% !important;">
						{{$receipt_details->table_unit_price_label}} (@trans('product.inc_of_tax'))
					</td>
					<td style="background-color: #357ca5 !important; color: white !important;width: 10% !important;">
						{{$receipt_details->table_subtotal_label}}
					</td>
				</tr>
			</thead>
			<tbody>
				@foreach($receipt_details->lines as $line)
					<tr>
						<td class="text-center">
							{{$loop->iteration}}
						</td>
						<td style="word-break: break-all;">
							@if(!empty($line['image']))
								<img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
							@endif
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
                            @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                            @if(!empty($line['sell_line_note']))
                            	<br>
                             <small class="text-muted">{{$line['sell_line_note']}}</small>
                             @endif
                            @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif 

                            @if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                            @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif
                        </td>

						@if($receipt_details->show_cat_code == 1)
	                        <td>
	                        	@if(!empty($line['cat_code']))
	                        		{{$line['cat_code']}}
	                        	@endif
	                        </td>
	                    @endif

						<td class="text-right">
							{{$line['quantity']}} {{$line['units']}}
						</td>
						<td class="text-right">
							{{$line['unit_price_before_discount']}}
						</td>
						<td class="text-right">
							{{$line['line_discount']}}
						</td>
						<td class="text-right">
							{{$line['tax']}} {{$line['tax_name']}}
						</td>
						<td class="text-right">
							{{$line['unit_price_inc_tax']}}
						</td>
						<td class="text-right">
							{{$line['line_total']}}
						</td>
					</tr>
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
								<td class="text-center">
									&nbsp;
								</td>
								<td>
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif 
		                            @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif 
		                        </td>

								@if($receipt_details->show_cat_code == 1)
			                        <td>
			                        	@if(!empty($modifier['cat_code']))
			                        		{{$modifier['cat_code']}}
			                        	@endif
			                        </td>
			                    @endif

								<td class="text-right">
									{{$modifier['quantity']}} {{$modifier['units']}}
								</td>
								<td class="text-right">
									&nbsp;
								</td>
								<td class="text-center">
									&nbsp;
								</td>
								<td class="text-center">
									&nbsp;
								</td>
								<td class="text-center">
									{{$modifier['unit_price_exc_tax']}}
								</td>
								<td class="text-right">
									{{$modifier['line_total']}}
								</td>
							</tr>
						@endforeach
					@endif
				@endforeach

				@php
					$lines = count($receipt_details->lines);
				@endphp

				@for ($i = $lines; $i < 5; $i++)
    				<tr>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					@if($receipt_details->show_cat_code == 1)
    						<td>&nbsp;</td>
    					@endif
    				</tr>
				@endfor

			</tbody>
		</table>
	</div>
</div>

<div class="row invoice-info color-555" style="page-break-inside: avoid !important">
	<div class="col-md-6 invoice-col width-50">
		<table class="table table-slim">
			@if(!empty($receipt_details->payments))
				@foreach($receipt_details->payments as $payment)
					<tr>
						<td>{{$payment['method']}}</td>
						<td>{{$payment['amount']}}</td>
						<td>{{$payment['date']}}</td>
					</tr>
				@endforeach
			@endif
		</table>
		<b class="pull-left">@trans('lang_v1.authorized_signatory')</b>
	</div>

	<div class="col-md-6 invoice-col width-50">
		<table class="table-no-side-cell-border table-no-top-cell-border width-100 table-slim">
			<tbody>
				@if(!empty($receipt_details->total_quantity_label))
					<tr class="color-555">
						<td style="width:50%">
							{!! $receipt_details->total_quantity_label !!}
						</td>
						<td class="text-right">
							{{$receipt_details->total_quantity}}
						</td>
					</tr>
				@endif
				<tr class="color-555">
					<td style="width:50%">
						{!! $receipt_details->subtotal_label !!}
					</td>
					<td class="text-right">
						{{$receipt_details->subtotal}}
					</td>
				</tr>
				
				<!-- Shipping Charges -->
				@if(!empty($receipt_details->shipping_charges))
					<tr class="color-555">
						<td style="width:50%">
							{!! $receipt_details->shipping_charges_label !!}
						</td>
						<td class="text-right">
							{{$receipt_details->shipping_charges}}
						</td>
					</tr>
				@endif

				@if(!empty($receipt_details->packing_charge))
					<tr class="color-555">
						<td style="width:50%">
							{!! $receipt_details->packing_charge_label !!}
						</td>
						<td class="text-right">
							{{$receipt_details->packing_charge}}
						</td>
					</tr>
				@endif

				<!-- Discount -->
				@if( !empty($receipt_details->discount) )
					<tr class="color-555">
						<td>
							{!! $receipt_details->discount_label !!}
						</td>

						<td class="text-right">
							(-) {{$receipt_details->discount}}
						</td>
					</tr>
				@endif

				@if( !empty($receipt_details->reward_point_label) )
					<tr class="color-555">
						<td>
							{!! $receipt_details->reward_point_label !!}
						</td>

						<td class="text-right">
							(-) {{$receipt_details->reward_point_amount}}
						</td>
					</tr>
				@endif

				@if(!empty($receipt_details->group_tax_details))
					@foreach($receipt_details->group_tax_details as $key => $value)
						<tr class="color-555">
							<td>
								{!! $key !!}
							</td>
							<td class="text-right">
								(+) {{$value}}
							</td>
						</tr>
					@endforeach
				@else
					@if( !empty($receipt_details->tax) )
						<tr class="color-555">
							<td>
								{!! $receipt_details->tax_label !!}
							</td>
							<td class="text-right">
								(+) {{$receipt_details->tax}}
							</td>
						</tr>
					@endif
				@endif

				@if( $receipt_details->round_off_amount > 0)
					<tr class="color-555">
						<td>
							{!! $receipt_details->round_off_label !!}
						</td>
						<td class="text-right">
							{{$receipt_details->round_off}}
						</td>
					</tr>
				@endif
				
				<!-- Total -->
				<tr>
					<th style="background-color: #357ca5 !important; color: white !important" class="font-23 padding-10">
						{!! $receipt_details->total_label !!}
					</th>
					<td class="text-right font-23 padding-10" style="background-color: #357ca5 !important; color: white !important">
						{{$receipt_details->total}}
					</td>
				</tr>
				@if(!empty($receipt_details->total_in_words))
				<tr>
					<td colspan="2" class="text-right">
						<small>({{$receipt_details->total_in_words}})</small>
					</td>
				</tr>
				@endif
			</tbody>
        </table>
	</div>
</div>

<div class="row color-555">
	<div class="col-xs-12">
		<br>
		<p>{!! nl2br($receipt_details->additional_notes) !!}</p>
	</div>
</div>
{{-- Barcode --}}
@if($receipt_details->show_barcode)
<br>
<div class="row">
		<div class="col-xs-12">
			<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
		</div>
</div>
@endif

@if(!empty($receipt_details->footer_text))
	<div class="row color-555">
		<div class="col-xs-12">
			{!! $receipt_details->footer_text !!}
		</div>
	</div>
@endif

			</td>
		</tr>
	</tbody>
</table>

@endif