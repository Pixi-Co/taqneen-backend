@extends("sale_pos.receipts.main")


@section('css')
    <style>
        table {
            font-family: serif;
            color: rgba(12, 12, 13, 1);
            font-size: 22.5px;
        }

        b {
            margin-right: 35px;
        }

        p {
            font-size: 12px;
        }

        .top-buffer {
            margin-top: 10px;
        }

        .top-210-buffer {
            /*margin-top:15px;*/
        }

    </style>
@endsection


@section('content')

    <!--  -->
    <table style="width:100%;  @if (request()->session()->get('user.language') == 'ar') direction: ltr; @endif">
        <thead>
            <tr>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <!-- @if (request()->session()->get('user.language') == 'ar') pull-left @else pull-right @endif -->
                            <div class="" style="width:65%;display: inline-block;"><br></div>
                            <div class="" style="width:30%;display: inline-block;">
                                @if (!empty($receipt_details->logo))
                                    <img src="{{ $receipt_details->logo }}" class="img img-responsive">
                                    <br />
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
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @foreach ($receipt_details->payments as $payment) {{ $payment['method'] }} @endforeach
                                    </p>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                                    <p style="margin:0;text-align: right;">رقم الفاتورة</p>
                                    <strong>
                                        <p>INVOICE NO.</p>
                                    </strong>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->invoice_no)) {{ $receipt_details->invoice_no }} @endif </p>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                                    <p style="margin:0;text-align: right;">التاريخ</p>
                                    <strong>
                                        <p>DATE</p>
                                    </strong>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->invoice_date)) {{ $receipt_details->invoice_date }} @endif </p>
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
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->customer_tax_number)) {{ $receipt_details->customer_tax_number }} @endif </p>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                                    <p style="margin:0;text-align: right;">رقم أمر الشراء</p>
                                    <strong>
                                        <p>P.O.NO.</p>
                                    </strong>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->customer_pono)) {{ $receipt_details->customer_pono }} @endif </p>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                                    <p style="margin:0;text-align: right;">البائع</p>
                                    <strong>
                                        <p>SALESMAN</p>
                                    </strong>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->sales_person)) {{ $receipt_details->sales_person }} @endif </p>
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
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->customer_billto)) {{ $receipt_details->customer_billto }} @endif </p>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                                    <p style="margin:0;text-align: right;">رقم أمر التحضير</p>
                                    <strong>
                                        <p>DRAFT NO.</p>
                                    </strong>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->customer_draftno)) {{ $receipt_details->customer_draftno }} @endif </p>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:13%;">
                                    <p style="margin:0;text-align: right;">رقم التليفون</p>
                                    <strong>
                                        <p>PHONE NUMBER</p>
                                    </strong>
                                </td>
                                <td style="font-size: 10px !important;vertical-align: top;width:21%;">
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->customer_landline)) {{ $receipt_details->customer_landline }} @endif
                                    </p>
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
                                    <p style="font-size: 10px !important;padding-left: 15px;"> @if (!empty($receipt_details->customer_mobile)) {{ $receipt_details->customer_mobile }} @endif
                                    </p>
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
                        @includeIf('sale_pos.receipts.partial.common_repair_invoice')
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <br />
                            <table class="table table-slim" style="border: 1px solid #000;height: 100px;">
                                <thead
                                    style="background-color: #E7F3FD !important; color:black !important; font-size: 10px !important">
                                    <tr class="bg-info" style="background-color: #E7F3FD !important;"
                                        class="table-no-side-cell-border table-no-top-cell-border text-center">
                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important;width: 5% !important;border: 1px solid #000;vertical-align:top;">
                                            السطر <br /> Line</th>

                                        @php
                                            $p_width = 25;
                                        @endphp
                                        @if ($receipt_details->show_cat_code != 1)
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

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 10% !important;border: 1px solid #000;vertical-align:top;">
                                            رقم الشاسيه <br /> Chassis NO.
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 20% !important;border: 1px solid #000;vertical-align:top;">
                                            رقم المودیل والوصف <br /> Model No. & Description
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 8% !important;border: 1px solid #000;vertical-align:top;">
                                            رقم اللوحة <br /> Plate No.
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 7% !important;border: 1px solid #000;vertical-align:top;">
                                            سعر البيع <br /> Selling Price
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 7% !important;border: 1px solid #000;vertical-align:top;">
                                            الاضافات <br /> Extra Charges
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 5% !important;border: 1px solid #000;vertical-align:top;">
                                            الخصم <br /> Disc
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 7% !important;border: 1px solid #000;vertical-align:top;">
                                            صافى القيمه <br /> Net AMT
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 10% !important;border: 1px solid #000;vertical-align:top;">
                                            نسبة ضريبة القيمة المضافة <br /> VAT%
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 13% !important;border: 1px solid #000;vertical-align:top;">
                                            ضريبة القيمة المضافة <br /> VAT
                                        </th>

                                        <th class="text-center"
                                            style="background-color: #E7F3FD !important; width: 12% !important;border: 1px solid #000;vertical-align:top;">
                                            إجمالى القيمة <br /> Total AMT
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
                                    @foreach ($receipt_details->lines as $line)
                                        @if (!empty($line['modifiers']))
                                            @foreach ($line['modifiers'] as $modifier)
                                                @if ($modifier['unit_price_exc_tax'] == 0.0)
                                                    @php $chassi_modifier = $modifier['variation'] @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td class="text-center"
                                                style="font-size: 10px !important;border-right: 1px solid;">
                                                {{ $loop->iteration }}
                                            </td>

                                            <td class="text-center"
                                                style="font-size: 10px !important;border-right: 1px solid;">
                                                @if ($chassi_modifier) {{ $chassi_modifier }} @endif
                                            </td>

                                            <td
                                                style="word-break: break-all; font-size: 10px !important;border-right: 1px solid;">
                                                {{ $line['name'] }} {{ $line['product_variation'] }}
                                                {{ $line['variation'] }}
                                                @if (!empty($line['sub_sku'])), {{ $line['sub_sku'] }} @endif @if (!empty($line['brand'])), {{ $line['brand'] }} @endif

                                                @if (!empty($line['sell_line_note']))
                                                    <br>
                                                    <small
                                                        class="text-muted"><i>{{ $line['sell_line_note'] }}</i></small>
                                                @endif
                                                @if (!empty($line['lot_number']))<br> {{ $line['lot_number_label'] }}:  {{ $line['lot_number'] }} @endif
                                                @if (!empty($line['product_expiry'])), {{ $line['product_expiry_label'] }}:  {{ $line['product_expiry'] }} @endif

                                                @if (!empty($line['warranty_name'])) <br><small>{{ $line['warranty_name'] }} </small>@endif @if (!empty($line['warranty_exp_date'])) <small>- {{ @format_date($line['warranty_exp_date']) }} </small>@endif
                                                @if (!empty($line['warranty_description'])) <small> {{ $line['warranty_description'] ?? '' }}</small>@endif
                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                @if (!empty($receipt_details->customer_custom_field1)){{ $receipt_details->customer_custom_field1 }} @endif
                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                {{ $line['unit_price_exc_tax'] }}
                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                0.00
                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                {{ $receipt_details->discount }}
                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                {{ $line['unit_price_before_discount_uf'] - $line['line_discount_uf'] }}
                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                {{ $line['tax_percent'] }} %
                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                {{ $receipt_details->tax }}

                                            </td>

                                            <td class="text-center"
                                                style=" font-size: 10px !important;border-right: 1px solid;">
                                                {{ $line['line_total'] }}
                                            </td>

                                        </tr>
                                        @php $total_selling_price += $line['unit_price_before_discount_uf']; @endphp


                                        @if (!empty($line['modifiers']))
                                            @foreach ($line['modifiers'] as $modifier)
                                                @if ($modifier['unit_price_exc_tax'] != 0.0)

                                                    <tr style='border-top:none;'>
                                                        <td class="text-center"
                                                            style="border-right: 1px solid;border-top: none;">
                                                            &nbsp;
                                                        </td>

                                                        <td class="text-center"
                                                            style="border-right: 1px solid;border-top: none;">
                                                            &nbsp;
                                                        </td>

                                                        <td class="text-center"
                                                            style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
                                                            {{ $modifier['name'] }} {{ $modifier['variation'] }}
                                                            @if (!empty($modifier['sub_sku'])), {{ $modifier['sub_sku'] }} @endif
                                                            @if (!empty($modifier['sell_line_note']))({{ $modifier['sell_line_note'] }}) @endif
                                                        </td>

                                                        <td class="text-center"
                                                            style="border-right: 1px solid;border-top: none;">
                                                            &nbsp;
                                                        </td>

                                                        <td class="text-center"
                                                            style="border-right: 1px solid;border-top: none;">
                                                            &nbsp;
                                                        </td>

                                                        <td class="text-center"
                                                            style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
                                                            {{ $modifier['unit_price_exc_tax'] }}

                                                        </td>

                                                        <td class="text-center"
                                                            style="font-size: 10px !important;border-right: 1px solid;border-top: none;">
                                                            {{-- $modifier['disc'] --}}
                                                            0
                                                        </td>

                                                        <td class="text-center"
                                                            style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
                                                            {{ $modifier['unit_price_exc_tax'] }}

                                                        </td>

                                                        <td class="text-center"
                                                            style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
                                                            {{ $line['tax_percent'] }} %
                                                        </td>

                                                        <td class="text-center"
                                                            style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
                                                            {{ number_format($modifier['unit_price_inc_tax'] - $modifier['unit_price_exc_tax'], 2) }}

                                                        </td>

                                                        <td class="text-center"
                                                            style=" font-size: 10px !important;border-right: 1px solid;border-top: none;">
                                                            {{ $modifier['line_total'] }}
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
                        <!-- @if (request()->session()->get('user.language') == 'ar') pull-right @else pull-left @endif -->
                        <div class="" style="width:45%;display: inline-block;margin-left: 16px;">
                            <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tbody>
                                    <tr>
                                        <td style="width: 100%;">
                                            <p
                                                style="text-align: right;padding: 2%;font-size: 13px !important;font-family: sans-serif;">
                                                لقد استلمت السيارة / السيارات بحالة سليمة و كاملة العدة و اللوازم و ذلك بعد
                                                معاينتها كاملة. من المفهوم أن الشركة المنتجة لها الحق في تغيير الشكل أو
                                                الموديل في أي وقت و بدون سابق إخطار و توقيع العميل أدناه على الاستلام يعني
                                                قبول السيارة / السيارات بحالتها</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-left: 0px;width:50%;display: inline-block;margin-right: 15px;">
                            <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tbody>
                                    <tr>
                                        <td class="text-center" style="width: 10%; font-size: 13px !important"><span>ريال
                                                سعودي</span><br><strong>SAR</strong></td>
                                        <td class="text-center" style="width: 15%; font-size: 13px !important">
                                            <span>{{ number_format($total_selling_price, 2) }}</span>
                                            <br />
                                            <span>إجمالى سعر البيع</span>
                                            <br />
                                            <strong>
                                                Total Selling Price
                                            </strong>
                                        </td>
                                        <td class="text-center" style="width: 15%; font-size: 13px !important">
                                            <span>{{ number_format($total_extra_charges, 2) }}</span>
                                            <br />
                                            <span>إجمالى الاضافات</span>
                                            <br />
                                            <strong>
                                                Total Extra Charges
                                            </strong>
                                        </td>
                                        <td class="text-center" class="text-center"
                                            style="width: 15%; font-size: 13px !important">
                                            <span>{{ $receipt_details->discount }}</span>
                                            <br />
                                            <span>إجمالى الخصم</span>
                                            <br />
                                            <strong>
                                                Total Discount
                                            </strong>
                                        </td>
                                        <td class="text-center" style="width: 15%; font-size: 13px !important">
                                            <span>{{ number_format($receipt_details->subtotal_unformatted, 2) }}</span>
                                            <br />
                                            <span>إجمالى صافى القيمة</span>
                                            <br />
                                            <strong>
                                                Total Net Amount
                                            </strong>
                                        </td>
                                        <td class="text-center" style="width: 15%; font-size: 13px !important">
                                            <span>{{ $receipt_details->tax }}</span>
                                            <br />
                                            <span>إجمالى ضريبة القيمة المضافة</span>
                                            <br />
                                            <strong>
                                                Total VAT Charges
                                            </strong>
                                        </td>
                                        <td class="text-center" style="width: 15%; font-size: 13px !important">
                                            <span>{{ $receipt_details->total }}</span>
                                            <br />
                                            <span>إجمالى القيمة</span>
                                            <br />
                                            <strong>
                                                Total Payment
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- @if (request()->session()->get('user.language') == 'ar') pull-left @else pull-right @endif -->
                    </div>

                    <div class="row">
                        <!-- @if (request()->session()->get('user.language') == 'ar') pull-right @else pull-left @endif -->
                        <div style="width:49%;display: inline-block;margin-left: 12px;">
                            <p class="" style="font-size: 15px !important;padding-left: 10px; ">We undertake
                                that the vehicle title will be retained in our name for a minimum period of six months from
                                this date
                                <br />
                            <table style="border-collapse: collapse; height: 144px; margin-left: auto; margin-right: auto;"
                                border="0">
                                <tbody>
                                    <tr style="height: 53px;">
                                        <td class="text-center"
                                            style="width: 33.3333%; height: 53px; font-size: 15px !important">
                                            <p style="margin:0;">مدير المعرض</p>
                                            <strong>
                                                <p>SHOWROOM MANAGER</p>
                                            </strong>
                                        </td>
                                        <td class="text-center"
                                            style="width: 33.3333%; height: 53px; font-size: 15px !important">
                                            <p style="margin:0;">العميل</p>
                                            <strong>
                                                <p>CUSTOMER</p>
                                            </strong>
                                        </td>
                                        <td class="text-center"
                                            style="width: 33.3333%; height: 53px; font-size: 15px !important">
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
                        <!--  @if (request()->session()->get('user.language') == 'ar') pull-left @else pull-right @endif -->
                        <div style="width:48%;display: inline-block;">
                            <div class="col-xs-12">
                                <table style="border-collapse: collapse; width : 100%;font-size:13px !important;"
                                    border="1">
                                    <tbody>
                                        <tr>
                                            <td colspan="3"
                                                style="font-size: 13px !important padding-left: 5px; padding-right: 5px;">
                                                <strong style="padding-left:5px;">Charges <p class="text-right pull-right"
                                                        style="display:inline-block;">إضافات</p></strong> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 33.3333%; font-size: 11px !important; padding-left: 5px;">REG
                                                &amp; PLATES<br />TRANSPORTATION<br />SERVICE CHARGES<br />ADDITIONAL
                                                OPT<br />INSURANCE<br />OTHER CHARGES</td>
                                            <td style="width: 33.3333%; font-size: 11px !important; text-align: center;">
                                                RE<br />TR<br />SE<br />OT<br />IN<br />OT</td>
                                            <td
                                                style="width: 33.3333%; font-size: 11px !important; padding-right: 5px; text-align: right;">
                                                لوحات و إستمارة<br />شحن<br />صيانة<br />إضافات أخرى<br />تأمين<br />أخرى
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br />
                            <div class="col-xs-12" style="width: 100%;">
                                <table
                                    style="border-collapse: collapse; width: 100%;margin-top:10px;font-size:13px !important;"
                                    border="1">
                                    <tbody>
                                        <tr>
                                            <td style="width: 50%; font-size: 13px !important; text-align: center;">
                                                <strong>رقم التسجيل الضريبي</strong>
                                            </td>
                                            <td style="width: 50%; font-size: 13px !important; text-align: center;"
                                                rowspan="2"><strong>310187810800003</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%; font-size: 13px !important; text-align: center;">
                                                <strong>TAX FILE NO.</strong></td>
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
                                            <img src="{{ $receipt_details->logo }}" class="img center-block"
                                                style="width: 95%;">
                                        </td>
                                        <td style="width: 70%; font-size: 10px !important; text-align: right;">
                                            <p style="font-size: 12px;color: gray;font-weight: bold;margin-top:5px;">
                                                <span style="float:left;padding-left:5px;"><a
                                                        href="https://twitter.com/UNMCOSA/"><img
                                                            src="{{ asset('uploads/extras/twitter.png') }}"
                                                            class="img center-block" style="width: 35px;"></a></span>
                                                <span style="float:left;padding-left:5px;"><a
                                                        href="https://www.instagram.com/UNMCOSA/"><img
                                                            src="{{ asset('uploads/extras/insta.png') }}"
                                                            class="img center-block"
                                                            style="width: 30px;padding-top: 3px;"></a></span>
                                                <span style="padding-right:5px;">العنوان/ المنطقة الشرقية - الدمام - سیھات -
                                                    النابية - طريق الظهران الجبيل</span>
                                                <br />
                                                <span style="padding-right:5px;">فاكس/ ۰۱۳۸۳۸۲٥٥٥</span>
                                                <br />
                                                <span style="padding-right:5px;">ت/ ۰٥۸۱٤٤۱٦٥۸</span>
                                                <br />
                                                <span style="float:left;padding-left:5px;;">ت/ ۰٥٦٦۷۹۹۲۱۲</span><span
                                                    style="padding-right:5px;">ت/ ۰۱۳۸۳۸۱٥٥٥</span>
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
<!-------else@ --------->
 

@endsection
