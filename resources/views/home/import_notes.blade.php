<div class="w3-row import_note" id="import_note_product" style="display: none" >
    <div class="col-sm-12">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.instructions')])
            <strong>@trans('lang_v1.instruction_line1')</strong><br>
            @trans('lang_v1.instruction_line2')
            <br><br>
            <table class="table table-striped">
                <tr>
                    <th>@trans('lang_v1.col_no')</th>
                    <th>@trans('lang_v1.col_name')</th>
                    <th>@trans('lang_v1.instruction')</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>@trans('product.product_name') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                    <td>@trans('lang_v1.name_ins')</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>@trans('product.brand') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>@trans('lang_v1.brand_ins') <br><small class="text-muted">(@trans('lang_v1.brand_ins2'))</small>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>@trans('product.unit') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                    <td>@trans('lang_v1.unit_ins')</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>@trans('product.category') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>@trans('lang_v1.category_ins') <br><small
                            class="text-muted">(@trans('lang_v1.category_ins2'))</small></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>@trans('product.sub_category') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>@trans('lang_v1.sub_category_ins') <br><small
                            class="text-muted">({!! __('lang_v1.sub_category_ins2') !!})</small></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>@trans('product.sku') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>@trans('lang_v1.sku_ins')</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>@trans('product.barcode_type') <small class="text-muted">(@trans('lang_v1.optional'),
                            @trans('lang_v1.default'): C128)</small></td>
                    <td>@trans('lang_v1.barcode_type_ins') <br>
                        <strong>@trans('lang_v1.barcode_type_ins2'): C128, C39, EAN-13, EAN-8, UPC-A, UPC-E, ITF-14</strong>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>@trans('product.manage_stock') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                    <td>@trans('lang_v1.manage_stock_ins')<br>
                        <strong>1 = @trans('messages.yes')<br>
                            0 = @trans('messages.no')</strong>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>@trans('product.alert_quantity') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                    </td>
                    <td>@trans('product.alert_quantity')</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>@trans('product.expires_in') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>@trans('lang_v1.expires_in_ins')</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>@trans('lang_v1.expire_period_unit') <small
                            class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>@trans('lang_v1.expire_period_unit_ins')<br>
                        <strong>@trans('lang_v1.available_options'): days, months</strong>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>@trans('product.applicable_tax') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                    </td>
                    <td>@trans('lang_v1.applicable_tax_ins') {!! __('lang_v1.applicable_tax_help') !!}</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>@trans('product.selling_price_tax_type') <small
                            class="text-muted">(@trans('lang_v1.required'))</small></td>
                    <td>@trans('product.selling_price_tax_type') <br>
                        <strong>@trans('lang_v1.available_options'): inclusive, exclusive</strong>
                    </td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>@trans('product.product_type') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                    <td>@trans('product.product_type') <br>
                        <strong>@trans('lang_v1.available_options'): single, variable</strong>
                    </td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>@trans('product.variation_name') <small
                            class="text-muted">(@trans('lang_v1.variation_name_ins'))</small></td>
                    <td>@trans('lang_v1.variation_name_ins2')</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>@trans('product.variation_values') <small
                            class="text-muted">(@trans('lang_v1.variation_values_ins'))</small></td>
                    <td>{!! __('lang_v1.variation_values_ins2') !!}</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td> @trans('lang_v1.purchase_price_inc_tax')<br><small
                            class="text-muted">(@trans('lang_v1.purchase_price_inc_tax_ins1'))</small></td>
                    <td>{!! __('lang_v1.purchase_price_inc_tax_ins2') !!}</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>@trans('lang_v1.purchase_price_exc_tax') <br><small
                            class="text-muted">(@trans('lang_v1.purchase_price_exc_tax_ins1'))</small></td>
                    <td>{!! __('lang_v1.purchase_price_exc_tax_ins2') !!}</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>@trans('lang_v1.profit_margin') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                    </td>
                    <td>@trans('lang_v1.profit_margin_ins')<br>
                        <small class="text-muted">{!! __('lang_v1.profit_margin_ins1') !!}</small>
                    </td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>@trans('lang_v1.selling_price') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                    </td>
                    <td>@trans('lang_v1.selling_price_ins')<br>
                        <small class="text-muted">{!! __('lang_v1.selling_price_ins1') !!}</small>
                    </td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>@trans('lang_v1.opening_stock') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                    </td>
                    <td>@trans('lang_v1.opening_stock_ins') {!! __('lang_v1.opening_stock_help_text') !!}<br>
                    </td>
                </tr>
                <tr>
                    <td>22</td>
                    <td>@trans('lang_v1.opening_stock_location') <small class="text-muted">(@trans('lang_v1.optional'))
                            <br>@trans('lang_v1.location_ins')</small></td>
                    <td>@trans('lang_v1.location_ins1')<br>
                    </td>
                </tr>
                <tr>
                    <td>23</td>
                    <td>@trans('lang_v1.expiry_date') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>{!! __('lang_v1.expiry_date_ins') !!}<br>
                    </td>
                </tr>
                <tr>
                    <td>24</td>
                    <td>@trans('lang_v1.enable_imei_or_sr_no') <small class="text-muted">(@trans('lang_v1.optional'),
                            @trans('lang_v1.default'): 0)</small></td>
                    <td><strong>1 = @trans('messages.yes')<br>
                            0 = @trans('messages.no')</strong><br>
                    </td>
                </tr>
                <tr>
                    <td>25</td>
                    <td>@trans('lang_v1.weight') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>@trans('lang_v1.optional')<br>
                    </td>
                </tr>
                <tr>
                    <td>26</td>
                    <td>@trans('lang_v1.rack') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>{!! __('lang_v1.rack_help_text') !!}</td>
                </tr>
                <tr>
                    <td>27</td>
                    <td>@trans('lang_v1.row') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>{!! __('lang_v1.row_help_text') !!}</td>
                </tr>
                <tr>
                    <td>28</td>
                    <td>@trans('lang_v1.position') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>{!! __('lang_v1.position_help_text') !!}</td>
                </tr>
                <tr>
                    <td>29</td>
                    <td>@trans('lang_v1.image') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td>{!! __('lang_v1.image_help_text', ['path' => 'public/uploads/' . config('constants.product_img_path')]) !!}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>30</td>
                    <td>@trans('lang_v1.product_description') <small
                            class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>31</td>
                    <td>@trans('lang_v1.product_custom_field1') <small
                            class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>32</td>
                    <td>@trans('lang_v1.product_custom_field2') <small
                            class="text-muted">(@trans('lang_v1.optional'))</small></td>
                </tr>
                <tr>
                    <td>33</td>
                    <td>@trans('lang_v1.product_custom_field3') <small
                            class="text-muted">(@trans('lang_v1.optional'))</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>34</td>
                    <td>@trans('lang_v1.product_custom_field4') <small
                            class="text-muted">(@trans('lang_v1.optional'))</small></td>
                </tr>
                <tr>
                    <td>35</td>
                    <td>@trans('lang_v1.not_for_selling') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                    </td>
                    <td><strong>1 = @trans('messages.yes')<br>
                            0 = @trans('messages.no')</strong><br>
                    </td>
                </tr>
                <tr>
                    <td>36</td>
                    <td>@trans('lang_v1.product_locations') <small class="text-muted">(@trans('lang_v1.optional'))</small>
                    </td>
                    <td>@trans('lang_v1.product_locations_ins')
                    </td>
                </tr>

            </table>
        @endcomponent
    </div>
</div>


@php
$date_formats = App\Business::date_formats();
$date_format = session('business.date_format');
$date_format = isset($date_formats[$date_format]) ? $date_formats[$date_format] : $date_format;
@endphp
<div class="w3-row import_note" id="import_note_open_stock" style="display: none">
    <div class="col-sm-12">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.instructions')])
        <strong>@trans('lang_v1.instruction_line1')</strong><br>@trans('lang_v1.instruction_line2')
        <br><br>
        <table class="table table-striped">
            <tr>
                <th>@trans('lang_v1.col_no')</th>
                <th>@trans('lang_v1.col_name')</th>
                <th>@trans('lang_v1.instruction')</th>
            </tr>
            <tr>
                <td>1</td>
                <td>@trans('product.sku')<small class="text-muted">(@trans('lang_v1.required'))</small></td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>@trans('business.location') <small class="text-muted">(@trans('lang_v1.optional')) <br>@trans('lang_v1.location_ins')</small></td>
                <td>@trans('lang_v1.location_ins1')<br>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>@trans('lang_v1.quantity') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td>@trans('purchase.unit_cost_before_tax') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
                <td></td>
            </tr>
            <tr>
                <td>5</td>
                <td>@trans('lang_v1.lot_number') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                <td></td>
            </tr>
            <tr>
                <td>6</td>
                <td>@trans('lang_v1.expiry_date') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
                <td>{!! __('lang_v1.expiry_date_in_business_date_format') !!} <br/> <b>{{$date_format}}</b></td>
            </tr>
        </table>
    @endcomponent
    </div>
</div>


<div class="w3-row import_note" id="import_note_contact" style="display: none">
    <div class="w3-large">
        @trans('lang_v1.instruction_line1')<br>
        @trans('lang_v1.instruction_line2')
    </div>
    <br><br>
    <table class="table table-striped">
        <tr>
            <th>@trans('lang_v1.col_no')</th>
            <th>@trans('lang_v1.col_name')</th>
            <th>@trans('lang_v1.instruction')</th>
        </tr>
        <tr>
            <td>1</td>
            <td>@trans('contact.contact_type') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
            <td>{!! __('lang_v1.import_contact_type_ins') !!}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>@trans('business.prefix') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>3</td>
            <td>@trans('business.first_name') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>4</td>
            <td>@trans('lang_v1.middle_name') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>5</td>
            <td>@trans('business.last_name') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>6</td>
            <td>@trans('business.business_name') <br><small
                    class="text-muted">(@trans('lang_v1.required_if_supplier'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>7</td>
            <td>@trans('lang_v1.contact_id') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>@trans('lang_v1.contact_id_ins')</td>
        </tr>
        <tr>
            <td>8</td>
            <td>@trans('contact.tax_no') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>9</td>
            <td>@trans('lang_v1.opening_balance') <small class="text-muted">(@trans('lang_v1.optional'))</small>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>10</td>
            <td>@trans('contact.pay_term') <br><small
                    class="text-muted">(@trans('lang_v1.required_if_supplier'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>11</td>
            <td>@trans('contact.pay_term_period') <br><small
                    class="text-muted">(@trans('lang_v1.required_if_supplier'))</small></td>
            <td><strong>@trans('lang_v1.pay_term_period_ins')</strong></td>
        </tr>
        <tr>
            <td>12</td>
            <td>@trans('lang_v1.credit_limit') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>13</td>
            <td>@trans('business.email') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>14</td>
            <td>@trans('contact.mobile') <small class="text-muted">(@trans('lang_v1.required'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>15</td>
            <td>@trans('contact.alternate_contact_number') <small
                    class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>16</td>
            <td>@trans('contact.landline') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>17</td>
            <td>@trans('business.city') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>18</td>
            <td>@trans('business.state') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>19</td>
            <td>@trans('business.country') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>20</td>
            <td>@trans('lang_v1.address_line_1') <small class="text-muted">(@trans('lang_v1.optional'))</small>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>21</td>
            <td>@trans('lang_v1.address_line_2') <small class="text-muted">(@trans('lang_v1.optional'))</small>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>22</td>
            <td>@trans('business.zip_code') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>23</td>
            <td>@trans('lang_v1.dob') <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>@trans('lang_v1.dob_ins') ({{ \Carbon::now()->format('Y-m-d') }})</td>
        </tr>
        @php
            $custom_labels = json_decode(session('business.custom_labels'), true);
        @endphp
        <tr>
            <td>24</td>
            <td>{{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}
                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>25</td>
            <td>{{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}
                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>26</td>
            <td>{{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}
                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>27</td>
            <td>{{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}
                <small class="text-muted">(@trans('lang_v1.optional'))</small></td>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>

@php 
$import_fields =  [
    'invoice_no' => ['label' => __('sale.invoice_no')],
    'customer_name' => ['label' => __('sale.customer_name')],
    'customer_phone_number' => ['label' => __('lang_v1.customer_phone_number'), 'instruction' => __('lang_v1.either_cust_email_or_phone_required')],
    'customer_email' => ['label' => __('lang_v1.customer_email'), 'instruction' => __('lang_v1.either_cust_email_or_phone_required')],
    'date' => ['label' => __('sale.sale_date'), 'instruction' => __('lang_v1.date_format_instruction')],
    'product' => ['label' => __('product.product_name'), 'instruction' => __('lang_v1.either_product_name_or_sku_required')],
    'sku' => ['label' => __('lang_v1.product_sku'), 'instruction' => __('lang_v1.either_product_name_or_sku_required')],
    'quantity' => ['label' => __('lang_v1.quantity'), 'instruction' => __('lang_v1.required')],
    'unit' => ['label' => __('lang_v1.product_unit')],
    'unit_price' => ['label' => __('sale.unit_price')],
    'item_tax' => ['label' => __('lang_v1.item_tax')],
    'item_discount' => ['label' => __('lang_v1.item_discount')],
    'item_description' => ['label' => __('lang_v1.item_description')],
    'order_total' => ['label' => __('lang_v1.order_total')],
];
@endphp 

<div class="w3-row import_note" id="import_note_sales" style="display: none">
    <div class="col-md-12">
        @component('components.widget', ['title' => __('lang_v1.instructions')])
        <table class="table table-condensed">
            <tr>
                <td>1.</td>
                <td>@trans('lang_v1.upload_data_in_excel_format')</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>@trans('lang_v1.choose_location_and_group_by')</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>@trans('lang_v1.map_columns_with_respective_sales_fields')</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>
                    <table class="table table-striped table-slim">
                        <tr>
                            <th>@trans('lang_v1.importable_fields')</th>
                            <th>@trans('lang_v1.instructions')</th>
                        </tr>
                        @foreach($import_fields as $key => $value)
                            <tr>
                                <td>
                                    {{$value['label']}}
                                </td>
                                <td>
                                    <small>{{$value['instruction'] ?? ''}}</small>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
        @endcomponent
    </div>
</div>
