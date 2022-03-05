<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans('add product')</h4>
        </div>

        {!! Form::open(['url' => action('ProductController@store'), 'method' => 'post', 'id' => 'productFormModal', 'class' => '-form', 'files' => true]) !!}
        <div class="modal-body">
            <a href="#" class="w3-block w3-padding" onclick="$('.basic-product-info').slideToggle(500)"
                style="border-bottom: 1px solid gray;">
                <b>
                    <i class="fa fa-angle-right"></i>
                    @trans('product basic info')
                </b>
            </a>
            <br>
            <div class="row basic-product-info">
                <div class="col-md-6 " style="padding: 0px!important" >

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.product_name') *</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('name', !empty($duplicate_product->name) ? $duplicate_product->name : '', ['class' => 'form-control w3-light-gray w3-light-gray', 'required', 'placeholder' => __('product.product_name')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.sku') *</b> @show_tooltip(__('tooltip.sku'))
                            </div>
                            <div class="col-md-8 w3-display-container">
                                <div class="w3-display-topright w3-padding" style="padding-top: 3px!important">
                                    <button type="button"
                                        onclick="$('input[name=sku]').val(createSku($('.category-pr-' + $('select[name=category_id]').val()).val()))"
                                        class="btn add_select_btn w3-round btn-modal w3-text-green">
                                        <i class="fa fa-magic"></i>
                                    </button>
                                </div>

                                {!! Form::text('sku', '', ['class' => 'form-control w3-light-gray', 'placeholder' => __('product.sku')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.unit') *</b>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    {!! Form::select('unit_id', $units, !empty($duplicate_product->unit_id) ? $duplicate_product->unit_id : session('business.default_unit'), ['class' => 'form-control w3-light-gray select2', 'required']) !!}

                                    <span class="input-group-btn" style="padding-left: 3px">
                                        <button type="button" @if (!auth()->user()->can('unit.create')) disabled @endif
                                            class="btn btn-default add_select_btn w3-round-xlarge btn-modal new-theme sb-shadow"
                                            data-href="{{ action('UnitController@create', ['quick_add' => true]) }}"
                                            title="@trans('unit.add_unit')" data-container=".view_modal"><i
                                                class="fa fa-plus text-primary fa-lg w3-text-white"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6" style="padding: 0px!important" >

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.category')</b>
                            </div>
                            <div class="col-md-8">
                                @foreach ($categories as $key => $value)
                                    @php
                                        $item = App\Category::find($key);
                                    @endphp
                                    <input type="hidden" class="category-pr-{{ $item->id }}"
                                        value="{{ $item->short_code }}">
                                @endforeach
                                {!! Form::select('category_id', $categories, !empty($duplicate_product->category_id) ? $duplicate_product->category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 " style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('business.business_locations') *</b>
                            </div>
                            <div class="col-md-8">
                                @php
                                    $default_location = null;
                                    if (count($business_locations) == 1) {
                                        $default_location = array_key_first($business_locations->toArray());
                                    }
                                @endphp
                                {!! Form::select('product_locations[]', $business_locations, $default_location, ['class' => 'form-control w3-light-gray select2', 'multiple', 'id' => 'product_locations', 'required' => 'required']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('lang_v1.product_description')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::textarea('product_description', !empty($duplicate_product->product_description) ? $duplicate_product->product_description : null, ['rows' => '3', 'class' => 'form-control w3-light-gray']) !!}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end of basic info --->

            </div>

            <a href="#" class="w3-block w3-padding" onclick="$('.more-product-info').slideToggle(500)"
                style="border-bottom: 1px solid gray;">
                <b>
                    <i class="fa fa-angle-right"></i>
                    @trans('product more info')
                </b>
            </a>
            <br>
            <div class="row more-product-info" style="display: none">

 
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('account')</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('account_id', App\Account::forDropdown(null, null), !empty($duplicate_product->account_id) ? $duplicate_product->account_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2']) !!}
                        </div>
                    </div>
                </div> 

                @can_bt(['product.sub_unit'])
                <div class="col-md-6 product-attribute-" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('lang_v1.related_sub_units')</b> @show_tooltip(__('lang_v1.sub_units_tooltip'))
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('sub_unit_ids[]', [], !empty($duplicate_product->sub_unit_ids) ? $duplicate_product->sub_unit_ids : null, ['class' => 'form-control w3-light-gray select2', 'multiple', 'id' => 'sub_unit_ids']) !!}
                        </div>
                    </div>
                </div>
                @endcan_bt

                @can_bt(['product.brand'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.brand')</b>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                {!! Form::select('brand_id', $brands, !empty($duplicate_product->brand_id) ? $duplicate_product->brand_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2']) !!}
                                <span class="input-group-btn" style="padding-left: 3px">
                                    <button type="button" @if (!auth()->user()->can('brand.create')) disabled @endif
                                        class="btn add_select_btn w3-round-xlarge sb-shadow btn-modal new-theme"
                                        data-href="{{ action('BrandController@create', ['quick_add' => true]) }}"
                                        title="@trans('brand.add_brand')" data-container=".view_modal"><i
                                            class="fa fa-plus text-primary fa-lg w3-text-white"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan_bt

                @can_bt(['product.sub_category'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.sub_category')</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('sub_category_id', $sub_categories, !empty($duplicate_product->sub_category_id) ? $duplicate_product->sub_category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2']) !!}
                        </div>
                    </div>
                </div>
                @endcan_bt


                @can_bt(['product.warranty'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('lang_v1.warranty')</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('warranty_id', $warranties, null, ['class' => 'form-control w3-light-gray select2', 'placeholder' => __('messages.please_select')]) !!}
                        </div>
                    </div>
                </div>
                @endcan_bt

                @can_bt(['product.barcode_type'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.barcode_type')</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('barcode_type', $barcode_types, !empty($duplicate_product->barcode_type) ? $duplicate_product->barcode_type : $barcode_default, ['class' => 'form-control w3-light-gray select2', 'required']) !!}
                        </div>
                    </div>
                </div>
                @endcan_bt

                <div class="col-md-6 product-attribute-col @if (!session('business.enable_price_tax')) hide @endif" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.selling_price_tax_type') *</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive', ['class' => 'form-control select2', 'required', 'onchange' => 'this.value > 0? $(".tax-field").show() : $(".tax-field").hide()']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6 product-attribute-col @if (!session('business.enable_price_tax')) hide @endif" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.applicable_tax')</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('tax', $taxes, !empty($duplicate_product->tax) ? $duplicate_product->tax : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2'], $tax_attributes) !!}
                        </div>
                    </div>
                </div>

                @can_bt(['product.weight'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('lang_v1.weight')</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::text('weight', !empty($duplicate_product->weight) ? $duplicate_product->weight : null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('lang_v1.weight')]) !!}
                        </div>
                    </div>
                </div>
                @endcan_bt


                @can_bt(['product.alert_quantity'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.alert_quantity')</b> @include("layouts.partials.tooltip", ["text" =>
                            __('tooltip.alert_quantity')])
                        </div>
                        <div class="col-md-1">
                            <label>
                                {!! Form::checkbox('enable_stock', 1, !empty($duplicate_product) ? $duplicate_product->enable_stock : true, ['class' => 'input-icheck2', 'id' => 'enable_stock']) !!}
                            </label>@show_tooltip(__('tooltip.enable_stock'))
                        </div>
                        <div id="alert_quantity_div" class="col-md-7  @if (!empty($duplicate_product) && $duplicate_product->enable_stock == 0) hide @endif">
                            {!! Form::number('alert_quantity', !empty($duplicate_product->alert_quantity) ? $duplicate_product->alert_quantity : null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('product.alert_quantity'), 'min' => '0']) !!}
                        </div>
                    </div>
                </div>
                @endcan_bt


                @php
                    $custom_labels = json_decode(session('business.custom_labels'), true);
                    $productCustomFields = isset($custom_labels['product']) ? $custom_labels['product'] : [];
                    
                @endphp
                @foreach ($productCustomFields as $key => $value)
                    @php
                    $keyname = 'product_custom_field' . str_replace('custom_field_', '', $key);
                    @endphp
                    @if ($value)
                        <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>{{ $value }} </b>
                                </div>
                                <div class="col-md-8">
                                    {!! Form::text($keyname, !empty($duplicate_product->$keyname) ? $duplicate_product->$keyname : null, ['class' => 'form-control w3-light-gray', 'placeholder' => $value]) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @can_bt(['product.rack_row_position'])
                @if (session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))

                    @foreach ($business_locations as $id => $location)
                        <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                            <div class="row">
                                <div class="col-md-4">
                                    <b>@trans('lang_v1.rack_details') {{ $location }}</b>

                                    @include("layouts.partials.tooltip", ["text" => __('lang_v1.tooltip_rack_details')])
                                </div>
                                <div class="col-md-3">
                                    @if (session('business.enable_racks'))
                                        {!! Form::text('product_racks[' . $id . '][rack]', !empty($rack_details[$id]['rack']) ? $rack_details[$id]['rack'] : null, ['class' => 'form-control w3-light-gray', 'style' => 'margin-bottom: 5px', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')]) !!}
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    @if (session('business.enable_row'))
                                        {!! Form::text('product_racks[' . $id . '][row]', !empty($rack_details[$id]['row']) ? $rack_details[$id]['row'] : null, ['class' => 'form-control w3-light-gray', 'style' => 'margin-bottom: 5px', 'placeholder' => __('lang_v1.row')]) !!}
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if (session('business.enable_position'))
                                        {!! Form::text('product_racks[' . $id . '][position]', !empty($rack_details[$id]['position']) ? $rack_details[$id]['position'] : null, ['class' => 'form-control w3-light-gray', 'style' => 'margin-bottom: 5px', 'placeholder' => __('lang_v1.position')]) !!}
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
                @endcan_bt



                @if (session('business.enable_product_expiry'))
                    @if (session('business.expiry_type') == 'add_expiry')
                        @php
                            $expiry_period = 12;
                            $hide = true;
                        @endphp
                    @else
                        @php
                            $expiry_period = null;
                            $hide = false;
                        @endphp
                    @endif
                    <div class="col-md-6 product-attribute-col @if ($hide) hide- @endif" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.expires_in')</b>
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('expiry_period', !empty($duplicate_product->expiry_period) ? @num_format($duplicate_product->expiry_period) : $expiry_period, ['class' => 'form-control w3-light-gray pull-left input_number', 'placeholder' => __('product.expiry_period')]) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('expiry_period_type', ['months' => __('product.months'), 'days' => __('product.days'), '' => __('product.not_applicable')], !empty($duplicate_product->expiry_period_type) ? $duplicate_product->expiry_period_type : 'months', ['class' => 'form-control w3-light-gray select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type']) !!}
                            </div>
                        </div>
                    </div>
                @endif


                @can_bt(['product.brochure'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('lang_v1.product_brochure')</b>
                            @include("layouts.partials.tooltip", ["text" => __('purchase.max_file_size', ['size' =>
                            (config('constants.document_size_limit') / 1000000)]) .
                            view('components.document_help_text')])

                        </div>
                        <div class="col-md-8">
                            {!! Form::file('product_brochure', ['id' => 'product_brochure', 'class' => 'form-control w3-light-gray', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]) !!}
                        </div>
                    </div>
                </div>
                @endcan_bt

                @can_bt(['product.imei'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('IMEI')</b>
                            @include("layouts.partials.tooltip", ["text" => __('lang_v1.tooltip_sr_no')])
                        </div>
                        <div class="col-md-8">
                            {!! Form::checkbox('enable_sr_no', 1, !empty($duplicate_product) ? $duplicate_product->enable_sr_no : false, ['class' => 'input-icheck2']) !!} <strong>@trans('lang_v1.enable_imei_or_sr_no')</strong>
                        </div>
                    </div>
                </div>
                @endcan_bt

                @can_bt(['product.not_for_selling'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('lang_v1.not_for_selling')</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::checkbox('not_for_selling', 1, !empty($duplicate_product) ? $duplicate_product->not_for_selling : false, ['class' => 'input-icheck2']) !!} <strong>@trans('lang_v1.tooltip_not_for_selling')</strong>
                        </div>
                    </div>
                </div>
                @endcan_bt

                @can_bt(['product.woocommerce'])
                <div class="col-md-6 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('woocommerce')</b>
                        </div>
                        <div class="col-md-8">
                            @include('layouts.partials.module_form_part', ["class" => 'o'])
                        </div>
                    </div>
                </div>
                @endcan_bt



            </div>
            <br>
            <div class="row">

                <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.product_type') *</b>
                            @include("layouts.partials.tooltip", ["text" => __('tooltip.product_type')])
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('type', $product_types, !empty($duplicate_product->type) ? $duplicate_product->type : null, ['class' => 'form-control w3-light-gray', 'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0', 'onchange' => 'show_product_type_form()', 'id' => 'type']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">

                    <div style="overflow: auto" id="product_form_part">
                        @include('product.partials.single_product_form_part', ['profit_percent' => $default_profit_percent])
                    </div>

                    <input type="hidden" id="variation_counter" value="1">
                    <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">

                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
        </div>
        {!! Form::close() !!}

    </div>
</div>

@include("product.product_steps")

<script>
    $('.select2').select2();
</script>
@php $asset_v = env('APP_VERSION'); @endphp
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    $('input, textarea, select').each(function(){ 
        if (!$(this).attr('id')) 
            $(this).attr('id', $(this).attr('name'));
    });

    // convert form to ajax
    formAjax(false, function(r) {
        var product = r.data;
        // add step1 content
        $.get("{{ url('/products/add-selling-prices') }}/" + product.id, function(res) {
            $('#step1').html(res);

            if ($('#step1').find('table').length <= 0)
                $('.product-steps').modal('hide');
            //
            formAjax(true, function(){ product_table.ajax.reload(); }, "#selling_price_form");
        });

        $.get("{{ url('/opening-stock/add') }}/" + product.id, function(res) {
            var container = document.createElement('div');
            container.innerHTML = res;  

            $('#step2').html($(container).find('.modal-content').html()); 
            


            if ($('#step2').find('table').length <= 0)
                $('.product-steps').modal('hide');
            else
                $('.product-steps').modal('show');  

            //
            formAjax(true, function(){ product_table.ajax.reload(); }, "#add_opening_stock_form");
        });

        product_table.ajax.reload();

        //$('.product-steps').modal('show'); 
    }, '#productFormModal');

    $(document).ready(function() { 
        autoloadAppJs(); 
        __page_leave_confirmation('#product_add_form');
        onScan.attachTo(document, {
            suffixKeyCodes: [13], // enter-key expected at the end of a scan
            reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
            onScan: function(sCode, iQty) {
                $('input#sku').val(sCode);
            },
            onScanError: function(oDebug) {
                console.log(oDebug);
            },
            minLength: 2,
            ignoreIfFocusOn: ['input', '.form-control']
            // onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
            //     console.log('Pressed: ' + iKeyCode);
            // }
        });



        $('#enable_stock').iCheck('update', function() {
            if ($('#enable_stock').iCheck('check')) {
                $('#alert_quantity_div').show();
            } else {
                $('#alert_quantity_div').hide();
            }
        });

        $('select[name=repair_model_id]').parent().parent().addClass('w3-padding');

        $('.customcheck').parent()[0].className = "col-lg-4 col-md-4 col-sm-6 w3-padding";

        $('form').addClass('form');

    });
</script>
