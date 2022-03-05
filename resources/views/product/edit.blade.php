@extends('layouts.app')
@section('title', __('product.edit_product'))

@section('css')
    <style>
        .col-lg-4,
        .col-md-4,
        .col-sm-4 {
            min-height: 84px;
        }

        .tax-field {
            display: block
        }

        .add-product-price-table tr::first-line {
            background-color: white !important;
            color: black !important;
        }

        .more-info {
            display: none;
        }

        input[type=text],
        input[type=number] {
            background-color: #f1f5f8;
        }

    </style>
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@trans('product.edit_product')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['url' => action('ProductController@update', [$product->id]), 'method' => 'PUT', 'id' => 'product_add_form', 'class' => 'product_form', 'files' => true]) !!}
        <input type="hidden" id="product_id" value="{{ $product->id }}">

        @component('components.widget', ['class' => 'box-primary'])
            <div class="w3-padding">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('name', __('product.product_name') . ':*') !!}
                            {!! Form::text('name', $product->name, ['class' => 'form-control', 'required', 'placeholder' => __('product.product_name')]) !!}
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if (!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
                        <div class="form-group">
                            {!! Form::label('sku', __('product.sku') . ':*') !!} @show_tooltip(__('tooltip.sku'))
                            {!! Form::text('sku', $product->sku, ['class' => 'form-control', 'placeholder' => __('product.sku'), 'required', 'readonly']) !!}
                        </div>
                    </div>

                    @can_bt(['product.barcode_type'])
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('barcode_type', __('product.barcode_type') . ':*') !!}
                            {!! Form::select('barcode_type', $barcode_types, $product->barcode_type, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']) !!}
                        </div>
                    </div>
                    @endcan_bt


                    @can_bt(['subscription.class_type'])
                    <div class="col-md-4 w3-padding">
                        <div class="form-group">
                            <label for="">@trans("class type")</label>
                            {!! Form::select(
    'class_type_id',
    Modules\Subscription\Entities\ClassType::active()->pluck('name', 'id')->toArray(),
    $product->class_type_id,
    ['class' => 'form-control select2', 'placeholder' => __('select class type'), 'id' => 'class_type_id'],
) !!}
                        </div>
                    </div>
                    @endcan_bt

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('unit_id', __('product.unit') . ':*') !!}
                            <div class="input-group">
                                {!! Form::select('unit_id', $units, $product->unit_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required']) !!}
                                <span class="input-group-btn">
                                    <button type="button" @if (!auth()->user()->can('unit.create')) disabled @endif
                                        class="btn btn-default add_select_btn w3-round btn-modal new-theme"
                                        data-href="{{ action('UnitController@create', ['quick_add' => true]) }}"
                                        title="@trans('unit.add_unit')" data-container=".view_modal"><i
                                            class="fa fa-plus-circle text-primary fa-lg w3-text-white"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    @can_bt(['product.sub_unit'])
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if (!session('business.enable_sub_units')) hide @endif">
                        <div class="form-group">
                            {!! Form::label('sub_unit_ids', __('lang_v1.related_sub_units') . ':') !!} @show_tooltip(__('lang_v1.sub_units_tooltip'))

                            <select name="sub_unit_ids[]" class="form-control select2" multiple id="sub_unit_ids">
                                @foreach ($sub_units as $sub_unit_id => $sub_unit_value)
                                    <option value="{{ $sub_unit_id }}" @if (is_array($product->sub_unit_ids) && in_array($sub_unit_id, $product->sub_unit_ids)) selected @endif>
                                        {{ $sub_unit_value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endcan_bt

                    @can_bt(['product.brand'])
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding ">
                        <div class="form-group">
                            {!! Form::label('brand_id', __('product.brand') . ':') !!}
                            <div class="input-group">
                                {!! Form::select('brand_id', $brands, $product->brand_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                                <span class="input-group-btn">
                                    <button type="button" @if (!auth()->user()->can('brand.create')) disabled @endif
                                        class="btn btn-default add_select_btn w3-round btn-modal new-theme"
                                        data-href="{{ action('BrandController@create', ['quick_add' => true]) }}"
                                        title="@trans('brand.add_brand')" data-container=".view_modal"><i
                                            class="fa fa-plus-circle text-primary fa-lg w3-text-white"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endcan_bt



                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if (!session('business.enable_category')) hide @endif">
                        <div class="form-group">
                            {!! Form::label('category_id', __('product.category') . ':') !!}
                            {!! Form::select('category_id', $categories, $product->category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                        </div>
                    </div>

                    @can_bt(['product.sub_category'])
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if (!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
                        <div class="form-group">
                            {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                            {!! Form::select('sub_category_id', $sub_categories, $product->sub_category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                        </div>
                    </div>
                    @endcan_bt

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.product_location_help'))
                            {!! Form::select('product_locations[]', $business_locations, $product->product_locations->pluck('id'), ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations']) !!}
                        </div>
                    </div>

                    @can_bt(['product.warranty'])
                    <div class="col-lg-6 col-md-6 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                            {!! Form::select('warranty_id', $warranties, $product->warranty_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]) !!}
                        </div>
                    </div>
                    @endcan_bt

                    <!-- include module fields -->
                    @if (!empty($pos_module_data))
                        @foreach ($pos_module_data as $key => $value)
                            @if (!empty($value['view_path']))
                                @includeIf($value['view_path'], ['view_data' => $value['view_data']])
                            @endif
                        @endforeach
                    @endif

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('image', __('lang_v1.product_image') . ':') !!}
                            {!! Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*']) !!}
                            <small>
                                <b>@trans('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                                    1000000)]) - </b>
                                <b>@trans('lang_v1.aspect_ratio_should_be_1_1')</b>
                            </small>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            <br>
                            <label>
                                {!! Form::checkbox('enable_stock', 1, $product->enable_stock, ['class' => 'input-icheck', 'id' => 'enable_stock']) !!} <strong>@trans('product.manage_stock')</strong>
                            </label>@show_tooltip(__('tooltip.enable_stock')) <p class="help-block">
                                <i>@trans('product.enable_stock_help')</i>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-4" id="alert_quantity_div" @if (!$product->enable_stock) style="display:none" @endif>
                        <div class="form-group">
                            {!! Form::label('alert_quantity', __('product.alert_quantity') . ':') !!} @show_tooltip(__('tooltip.alert_quantity'))
                            {!! Form::number('alert_quantity', $product->alert_quantity, ['class' => 'form-control', 'placeholder' => __('product.alert_quantity'), 'min' => '0']) !!}
                        </div>
                    </div>

                    @can_bt(['product.brochure'])
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('product_brochure', __('lang_v1.product_brochure') . ':') !!}
                            {!! Form::file('product_brochure', ['id' => 'product_brochure', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]) !!}
                            <small>
                                <p class="help-block">
                                    @trans('purchase.max_file_size', ['size' => (config('constants.document_size_limit') /
                                    1000000)])
                                    @includeIf('components.document_help_text')
                                </p>
                            </small>
                        </div>
                    </div>
                    @endcan_bt

                    <div class="col-lg-12 col-md-12 col-sm-12 w3-padding">
                        <div class="form-group">
                            {!! Form::label('product_description', __('lang_v1.product_description') . ':') !!}
                            {!! Form::textarea('product_description', $product->product_description, ['class' => 'form-control']) !!}
                        </div>
                    </div>


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
                        <div class="col-sm-4 @if ($hide) hide @endif">
                            <div class="form-group">
                                <div class="multi-input">
                                    @php
                                        $disabled = false;
                                        $disabled_period = false;
                                        if (empty($product->expiry_period_type) || empty($product->enable_stock)) {
                                            $disabled = true;
                                        }
                                        if (empty($product->enable_stock)) {
                                            $disabled_period = true;
                                        }
                                    @endphp
                                    {!! Form::label('expiry_period', __('product.expires_in') . ':') !!}<br>
                                    {!! Form::text('expiry_period', @num_format($product->expiry_period), ['class' => 'form-control pull-left input_number', 'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;', 'disabled' => $disabled]) !!}
                                    {!! Form::select('expiry_period_type', ['months' => __('product.months'), 'days' => __('product.days'), '' => __('product.not_applicable')], $product->expiry_period_type, ['class' => 'form-control select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type', 'disabled' => $disabled_period]) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @can_bt(['product.imei'])
                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('enable_sr_no', 1, $product->enable_sr_no, ['class' => 'input-icheck']) !!} <strong>@trans('lang_v1.enable_imei_or_sr_no')</strong>
                            </label>
                            @show_tooltip(__('lang_v1.tooltip_sr_no'))
                        </div>
                    </div>
                    @endcan_bt

                    <!--
                                            <div class="col-sm-4 w3-padding">
                                                <div class="form-group">
                                                    <label>
                                                        {!! Form::checkbox('not_for_selling', 1, $product->not_for_selling, ['class' => 'input-icheck']) !!} <strong>@trans('lang_v1.not_for_selling')</strong>
                                                    </label> @show_tooltip(__('lang_v1.tooltip_not_for_selling'))
                                                </div>
                                            </div>
                                            -->

                    <!--custom fields-->
                    @can_bt(['product.woocommerce'])
                    @include('layouts.partials.module_form_part')
                    @endcan_bt

                    <!-- Rack, Row & position number -->
                    @if (session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))
                        <div class="col-md-12">
                            <h4>@trans('lang_v1.rack_details'):
                                @show_tooltip(__('lang_v1.tooltip_rack_details'))
                            </h4>
                        </div>
                        @foreach ($business_locations as $id => $location)
                            <div class="col-sm-3">
                                <div class="form-group">
                                    {!! Form::label('rack_' . $id, $location . ':') !!}


                                    @if (!empty($rack_details[$id]))
                                        @if (session('business.enable_racks'))
                                            {!! Form::text('product_racks_update[' . $id . '][rack]', $rack_details[$id]['rack'], ['class' => 'form-control', 'id' => 'rack_' . $id]) !!}
                                        @endif

                                        @if (session('business.enable_row'))
                                            {!! Form::text('product_racks_update[' . $id . '][row]', $rack_details[$id]['row'], ['class' => 'form-control']) !!}
                                        @endif

                                        @if (session('business.enable_position'))
                                            {!! Form::text('product_racks_update[' . $id . '][position]', $rack_details[$id]['position'], ['class' => 'form-control']) !!}
                                        @endif
                                    @else
                                        {!! Form::text('product_racks[' . $id . '][rack]', null, ['class' => 'form-control', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')]) !!}

                                        {!! Form::text('product_racks[' . $id . '][row]', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.row')]) !!}

                                        {!! Form::text('product_racks[' . $id . '][position]', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.position')]) !!}
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    @endif


                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('weight', __('lang_v1.weight') . ':') !!}
                            {!! Form::text('weight', $product->weight, ['class' => 'form-control', 'placeholder' => __('lang_v1.weight')]) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @php
                        $custom_labels = json_decode(session('business.custom_labels'), true);
                        $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
                        $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
                        $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
                        $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
                    @endphp
                    <!--custom fields-->
                    @if (!empty($custom_labels['product']['custom_field_1']))
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('product_custom_field1', $product_custom_field1 . ':') !!}
                                {!! Form::text('product_custom_field1', $product->product_custom_field1, ['class' => 'form-control', 'placeholder' => $product_custom_field1]) !!}
                            </div>
                        </div>
                    @endif

                    @if (!empty($custom_labels['product']['custom_field_2']))
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('product_custom_field2', $product_custom_field2 . ':') !!}
                                {!! Form::text('product_custom_field2', $product->product_custom_field2, ['class' => 'form-control', 'placeholder' => $product_custom_field2]) !!}
                            </div>
                        </div>
                    @endif

                    @if (!empty($custom_labels['product']['custom_field_3']))
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('product_custom_field3', $product_custom_field3 . ':') !!}
                                {!! Form::text('product_custom_field3', $product->product_custom_field3, ['class' => 'form-control', 'placeholder' => $product_custom_field3]) !!}
                            </div>
                        </div>
                    @endif

                    @if (!empty($custom_labels['product']['custom_field_4']))
                        <div class="col-sm-3">
                            <div class="form-group">
                                {!! Form::label('product_custom_field4', $product_custom_field4 . ':') !!}
                                {!! Form::text('product_custom_field4', $product->product_custom_field4, ['class' => 'form-control', 'placeholder' => $product_custom_field4]) !!}
                            </div>
                        </div>
                    @endif

                    @if (!empty($custom_labels['product']['custom_field_5']))
                        <div class="col-sm-3 @if (!session('business.enable_price_tax')) hide @endif">
                            <div class="form-group" style="max-width: 350px;margin: auto">
                                {!! Form::label('tax', __('product.applicable_tax') . ':') !!}
                                {!! Form::select('tax', $taxes, $product->tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2 applicable-tax', 'onchange' => 'this.value > 0? $(".tax-field").show() : $(".tax-field").hide()'], $tax_attributes) !!}
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        @endcomponent


        @component('components.widget', ['class' => 'box-primary w3-padding'])
            <div class="row">

                <div class="w3-padding">
                    <div class="row">
                        <div class="col-md-6 tax-   @if (!session('business.enable_price_tax')) hide @endif">
                            <div class="form-group">
                                {!! Form::label('tax_type', __('product.selling_price_tax_type') . ':*') !!}
                                {!! Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], $product->tax_type, ['class' => 'form-control select2', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-6 tax-  ">
                            <div class="form-group">
                                {!! Form::label('type', __('product.product_type') . ':*') !!} @show_tooltip(__('tooltip.product_type'))
                                {!! Form::select('type', $product_types, $product->type, ['class' => 'form-control select2', 'required', 'disabled', 'data-action' => 'edit', 'data-product_id' => $product->id]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group col-sm-12" id="product_form_part"></div>
                <input type="hidden" id="variation_counter" value="0">
                <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">
            </div>
        @endcomponent

        <div class="row">
            <input type="hidden" name="submit_type" id="submit_type">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="btn-group">
                        <!--
                                        @if ($selling_price_group_count) <button type="submit" value="submit_n_add_selling_prices"
                                                class="btn btn-warning submit_product_form">@trans('lang_v1.save_n_add_selling_price_group_prices')</button> 
                                                @endif

                                        @can('product.opening_stock')
                                                            <button type="submit" @if (empty($product->enable_stock)) disabled="true" @endif id="opening_stock_button"
                                                                value="update_n_edit_opening_stock"
                                                                class="btn bg-purple submit_product_form">@trans('lang_v1.update_n_edit_opening_stock')</button>
                                        @endcan

                                                <button type="submit" value="save_n_add_another"
                                                    class="btn bg-maroon submit_product_form">@trans('lang_v1.update_n_add_another')</button>
                                                -->
                        <button type="submit" value="submit"
                            class="btn btn-primary submit_product_form">@trans('messages.update')</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

    @include("product.product_steps")

@endsection

@section('javascript')
    <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        // convert form to ajax
        formAjax(false, function(r) {
            var product = r.data;
            // add step1 content
            $.get("{{ url('/products/add-selling-prices') }}/" + product.id, function(res) {
                $('#step1').html(res);
                //
                formAjax(true, null, "#selling_price_form");
            });

            $.get("{{ url('/opening-stock/add') }}/" + product.id, function(res) {
                res = res.replace(/modal/g, '_modal');
                $('#step2').html(res);
                //
                formAjax(true, null, "#add_opening_stock_form");
            });

            $('.product-steps').show();
            $('.first-nav').click();
        }, '#product_add_form');
        $(document).ready(function() {
            __page_leave_confirmation('#product_add_form');



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



            setTimeout(function() {
                $('.add-product-price-table').find('tr').addClass('w3-light-gray');
                $('.add-product-price-table').find('th').addClass('w3-white');
            }, 2000);

            $('.applicable-tax').change();
        });
    </script>
@endsection
