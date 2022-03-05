<table style="width:100%;">
	<thead>
		<tr>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>
			    <div class="row">
    			    <div class="col-md-12 text-center">
        			    
        				<div class="col-md-4 pull-right" style="width:25%;">
        				    <!-- Logo -->
                    		@if(!empty($receipt_details->logo))
                    			<img src="{{$receipt_details->logo}}" class="img center-block">
                    			<br/>
                    		@endif
        				</div>
        				
    				</div>
				</div>
			    <div class="row">
			        <div class="col-md-12 text-center">
        				<h4>ORIGINAL INVOICE</h4>
        			</div>
                </div>
    			
			</td>
		</tr>

		<tr>
			<td>


<div class="row"> 
    <div  class="col-md-12 width-100">
        
        <div style="display: inline-block; padding-right:5px; width:15%; font-size: 12px !important"> <b class="pull-right">الفرع</b><br/> <b class="pull-left">BRANCH</b> </div>
	    <div style="display: inline-block; width:74%; font-size: 12px !important"> {!! $receipt_details->address !!} </div>
	    
	    <div style="display: inline-block; margin-right:5px; width:15%; font-size: 12px !important"> <b class="pull-right">العميل</b> <br/> <b class="pull-left">CUSTOMER</b> </div>
	    <div style="display: inline-block; width:73%; font-size: 12px !important"> {{ $receipt_details->customer_name }} </div>
	    
    </div>
</div>


<div class="row invoice-info">
    <div class="col-md-4 invoice-col">
		<div class="word-wrap">
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"><b class="pull-right">نوع البيع</b> <br/> <b class="pull-left">SALE TYPE</b></div>
		    <p style="display: inline-block; font-size: 12px !important">@foreach($receipt_details->payments as $payment) {{ $payment['method'] }} @endforeach </p>
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">رقم التسجيل الضريبي للعميل</b> <br/><b class="pull-left">CUSTOMER TAX File No</b></div>
		    @if(!empty($receipt_details->customer_tax_number)) <p style="display: inline-block; font-size: 12px !important">{{ $receipt_details->customer_tax_number }}</p> @endif
			
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">تحرير الفاتورة الى</b> <br/><b class="pull-left">Bill To ADDRESS</b></div>
		    @if(!empty($receipt_details->customer_custom_field4)) <p style="display: inline-block; font-size: 12px !important">{{ $receipt_details->customer_custom_field4 }}</p> @endif</p>
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important">  <b class="pull-right">رقم التليفون</b><br/><b class="pull-left">PHONE NUMBER</b></div>
		    @if(!empty($receipt_details->customer_landline)) <p style="display: inline-block; font-size: 12px !important">{{ $receipt_details->customer_landline }}</p> @endif</p>
		    
		</div>

    </div>
    <div class="col-md-4 invoice-col">
		<div class="word-wrap">
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">رقم الفاتورة</b><br/><b class="pull-left">INVOICE NO.</b> </div>
		    <p style="display: inline-block; font-size: 12px !important">@if(!empty($receipt_details->invoice_no)) {{$receipt_details->invoice_no}} @endif </p>
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">رقم أمر الشراء</b><br/><b class="pull-left">P.O.NO.</b> </div>
		    <p style="display: inline-block; font-size: 12px !important">@if(!empty($receipt_details->customer_custom_field2)) {{ $receipt_details->customer_custom_field2 }} @endif </p>
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">رقم أمر التحضير</b><br/><b class="pull-left">DRAFT NO.</b> </div>
		    <p style="display: inline-block; font-size: 12px !important">@if(!empty($receipt_details->customer_custom_field3)) {{ $receipt_details->customer_custom_field3 }} @endif </p>
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">رقم الجوال</b><br/><b class="pull-left">MOBILE UMBER</b> </div>
		    <p style="display: inline-block; font-size: 12px !important">@if(!empty($receipt_details->customer_mobile)) {{ $receipt_details->customer_mobile }} @endif </p>
		    
		</div>

    </div>
    <div class="col-md-4 invoice-col">
		<div class="word-wrap">
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">التاريخ</b><br/><b class="pull-left">DATE</b> </div>
		    <p style="display: inline-block; font-size: 12px !important">@if(!empty($receipt_details->invoice_date)) {{$receipt_details->invoice_date}} @endif </p>
		    
		    <div class="width-50" style="display: inline-block; margin-right:5px; font-size: 12px !important"> <b class="pull-right">البائع</b><br/><b class="pull-left">SALESMAN</b> </div>
		    <p style="display: inline-block; font-size: 12px !important">@if(!empty($receipt_details->sales_person)) {{ $receipt_details->sales_person }} @endif </p>
		    
		</div>

    </div>
</div>


<div class="row">
	@includeIf('sale_pos.receipts.partial.common_repair_invoice')
</div>

<div class="row">
	<div class="col-xs-12">
		<br/>
		<table class="table table-bordered table-slim">
			<thead style="background-color: #E7F3FD !important; color:black !important; font-size: 12px !important">
				<tr class="bg-info" style="background-color: #E7F3FD !important;" 
				    class="table-no-side-cell-border table-no-top-cell-border text-center">
					<th class="text-center" style="background-color: #E7F3FD !important;width: 5% !important">السطر <br/> Line</th>
					
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
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 10% !important;">
					     رقم الشاسيه <br/> Chassis NO.
					</th>

					<th  class="text-center" style="background-color: #E7F3FD !important; width: 20% !important">
					    رقم المودیل والوصف <br/> Model No. & Description
        			</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 8% !important;">
					    رقم اللوحة <br/> Plate No.
					</th>

					<th class="text-center" style="background-color: #E7F3FD !important; width: 7% !important;">
					    سعر البيع  <br/> Selling Price
					</th>

					<th class="text-center" style="background-color: #E7F3FD !important; width: 7% !important;">
					   الاضافات <br/> Extra Charges
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 5% !important;">
					   الخصم <br/> Disc 
					</th>

					<th class="text-center" style="background-color: #E7F3FD !important; width: 7% !important;">
					   صافى القيمه <br/> Net AMT
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 10% !important;">
					   نسبة ضريبة القيمة المضافة <br/> VAT%
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 13% !important;">
					      ضريبة القيمة المضافة <br/> VAT
					</th>
					
					<th class="text-center" style="background-color: #E7F3FD !important; width: 12% !important;">
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
						<td class="text-center" style=" font-size: 12px !important">
							{{$loop->iteration}}
						</td>
						
                        <td class="text-center" style=" font-size: 12px !important">
						    @if($chassi_modifier) {{$chassi_modifier}} @endif
						</td>

						<td style="word-break: break-all; font-size: 12px !important">
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
                        
                        <td class="text-center" style=" font-size: 12px !important">
                            @if(!empty($receipt_details->customer_custom_field1)){{ $receipt_details->customer_custom_field1 }} @endif
						</td>
						
						<td class="text-center" style=" font-size: 12px !important">
							{{$line['unit_price_exc_tax']}}
						</td>
						
						<td class="text-center" style=" font-size: 12px !important">
							0.00
						</td>
						
						<td class="text-center" style=" font-size: 12px !important">
							{{ $receipt_details->discount_no_currency }}
						</td>
						
						<td class="text-center" style=" font-size: 12px !important">
						    {{ $line['unit_price_after_discount'] }}
						</td>
						
						<td class="text-center" style=" font-size: 12px !important">
						    {{ $line['line_tax_percent'] }} %
						</td>
						
						<td class="text-center" style=" font-size: 12px !important">
							{{$receipt_details->tax_no_currency}}
							
						</td>
						
						<td class="text-center" style=" font-size: 12px !important">
							{{$line['line_total']}}
						</td>
						
					</tr>
					@php $total_selling_price += $line['unit_price_before_discount_unformatted']; @endphp 
					
					
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
						    @if($modifier['unit_price_exc_tax'] != 0.00)
						    
							<tr>
								<td class="text-center">
									&nbsp;
								</td>
								
								<td class="text-center">
									&nbsp;
								</td>
								
								<td class="text-center" style=" font-size: 12px !important">
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif 
		                            @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif 
		                        </td>
		                        
		                        <td class="text-center">
									&nbsp;
								</td>

								<td class="text-center">
									&nbsp;
								</td>
								
								<td class="text-center" style=" font-size: 12px !important">
									{{$modifier['unit_price_exc_tax']}}
									
								</td>
								
								<td class="text-center">
								    {{ $modifier['disc'] }}
								</td>
								
								<td class="text-center" style=" font-size: 12px !important">
									{{$modifier['unit_price_exc_tax']}}
									
								</td>
								
								<td class="text-center" style=" font-size: 12px !important">
									{{ $line['line_tax_percent'] }} %
								</td>
								
								<td class="text-center" style=" font-size: 12px !important">
									{{  number_format($modifier['unit_price_inc_tax_unformatted'] - $modifier['unit_price_exc_tax_unformatted'],2) }}
									
								</td>
								
								<td class="text-center" style=" font-size: 12px !important">
									{{$modifier['line_total']}}
								</td>
							</tr>
							
							@php $total_extra_charges += $modifier['unit_price_exc_tax_unformatted']; @endphp 
							
							
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

<div class="row">
    <div class="col-xs-4 text-right">
        <table style="border-collapse: collapse; width: 100%;" border="1">
            <tbody>
                <tr>
                    <td style="width: 100%;">
                        <strong>
                            <p style="direction: rtl; text-align:center; padding: 2%; font-size: 12px !important">لقد استلمت السيارة / السيارات بحالة سليمة و كاملة العدة و اللوازم و ذلك بعد معاينتها كاملة. من المفهوم أن الشركة المنتجة لها الحق في تغيير الشكل أو الموديل في أي وقت و بدون سابق إخطار و توقيع العميل أدناه على الاستلام يعني قبول السيارة / السيارات بحالتها</p>
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-8" style="margin-left: 0px;">
        <table style="border-collapse: collapse; width: 100%;" border="1">
            <tbody>
            <tr>
                <td class="text-center" style="width: 10%; font-size: 12px !important"><strong> ريال سعودى <br> SAR</strong></td>
                <td class="text-center" style="width: 15%; font-size: 12px !important">
                    <strong>
                    {{ number_format($total_selling_price,2) }} <br/>
                     إجمالى سعر البيع  <br> Total Selling Price
                    </strong>
                </td>
                <td class="text-center" style="width: 15%; font-size: 12px !important">
                    <strong>
                    {{ number_format($total_extra_charges,2) }} <br/>
                     إجمالى الاضافات   <br> Total Extra Charges
                    </strong>
                </td>
                <td class="text-center" class="text-center" style="width: 15%; font-size: 12px !important">
                    <strong>
                    {{ $receipt_details->discount_no_currency }} <br/>
                     إجمالى الخصم  <br> Total Discount
                    </strong>
                </td>               
                <td class="text-center" style="width: 15%; font-size: 12px !important">
                    <strong>
                    {{ number_format($receipt_details->subtotal_unformatted,2) }} <br/>
                     إجمالى صافى القيمة   <br> Total Net Amount
                    </strong>
                </td>
                <td class="text-center" style="width: 15%; font-size: 12px !important">
                    <strong>
                    {{ $receipt_details->tax_no_currency }} <br/>
                     إجمالى ضريبة القيمة المضافة   <br> Total VAT Charges
                    </strong>
                </td>
                <td class="text-center" style="width: 15%; font-size: 12px !important">
                    <strong>
                    {{ number_format($receipt_details->total_no_currency,2) }} <br/>
                     إجمالى القيمة   <br> Total Payment
                    </strong> 
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</div>

<div class="row" style=" margin-top: 30px;">
    <div class="col-xs-7">
        <strong>
            <p class="text-left" style="font-size: 15px !important">We undertake that the vehicle title will be retained in our name for a minimum period of six months from this date
        </strong>
        <br/>
        <table style="border-collapse: collapse; height: 144px; margin-left: auto; margin-right: auto;" border="0">
            <tbody>
                <tr style="height: 53px;">
                    <td class="text-center" style="width: 33.3333%; height: 53px; font-size: 15px !important">
                        <strong>
                            <p>مدير المعرض</p>
                            <p>Showroom manager</p>
                        </strong>
                    </td>
                    <td class="text-center" style="width: 33.3333%; height: 53px; font-size: 15px !important">
                        <strong>
                            <p>العميل</p>
                            <p>Customer</p>
                        </strong>
                    </td>
                    <td class="text-center" style="width: 33.3333%; height: 53px; font-size: 15px !important">
                        <strong>
                            <p>البائع</p>
                            <p>Sales man</p>
                        </strong>
                    </td>
                    </tr>
                    <tr style="height: 91px;">
                        <td style="width: 33.3333%; text-align: center; height: 91px;"></td>
                        <td style="width: 33.3333%; text-align: center; height: 91px;"></td>
                        <td style="width: 33.3333%; text-align: center; height: 91px;">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-5">
        <div class="col-xs-12">
            <table style="border-collapse: collapse; width : 100%" border="1">
            <tbody>
                <tr>
                    <td colspan="3" style="font-size: 12px !important; padding-left: 5px; padding-right: 5px;"><strong>Charges <p class="text-right pull-right" style="display:inline-block;">الاضافات</p></strong> </td>
                </tr>
                <tr>
                    <td style="width: 33.3333%; font-size: 12px !important; padding-left: 5px;">REG &amp; PLATES<br />TRANSPORTATION<br />SERVICE CHARGES<br />ADDITIONAL OPT<br />INSURANCE<br />OTHER CHARGES</td>
                    <td style="width: 33.3333%; font-size: 12px !important; text-align: center;">RE<br />TR<br />SE<br />OT<br />IN<br />OT</td>
                    <td style="width: 33.3333%; font-size: 12px !important; padding-right: 5px; text-align: right;">لوحات و إستمارة<br />شحن<br />صيانة<br />إضافات أخرى<br />تأمين<br />أخرى</td>
                </tr>
            </tbody>
        </table>
        </div>
        <br/>
        <div class="col-xs-12" style=" margin-top: 10px; width: 100%;">
            <table style="border-collapse: collapse; width: 100%;" border="1">
            <tbody>
                <tr>
                    <td style="width: 50%; font-size: 12px !important; text-align: center;">
                        <strong>رقم التسجيل الضريبي</strong>
                    </td>
                    <td style="width: 50%; font-size: 12px !important; text-align: center;" rowspan="2"><strong>300792591600003</strong></td>
                </tr>
                <tr>
                    <td style="width: 50%; font-size: 12px !important; text-align: center;"><strong>TAX FILE NO.</strong></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="row" style=" margin-top: 30px;">
    <div class="col-xs-12">
        <table style="border-collapse: collapse; width: 100%;" border="1">
        <tbody>
        <tr>
        <td style="width: 25%;">
        </td>
        <td style="width: 75%; font-size: 12px !important; text-align: right;">
            <strong>
            Balupaid Automotive Co. | Paid Up Capital 1,000,000S.R. | C.R 4030219586 | C.C 164110
            <br/>
            س.ت 4030219586 | غ.ت 164110 |  رأس المال المدفوع 1,000,000 ريال سعودى | شركة بالبيلد للسيارات
            </strong>
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
