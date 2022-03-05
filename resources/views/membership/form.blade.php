<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans('add product')</h4>
        </div>
        @php
            $form_class = empty($duplicate_membership) ? 'create' : '';
        @endphp

        {!! Form::open(['url' => action('MemberShipController@store'), 'method' => 'post', 'id' => 'membership_add_form', 'class' => 'membership_form' . $form_class, 'files' => true]) !!}
        <div class="modal-body">
            <a href="#" class="w3-block w3-padding" onclick="$('.basic-product-info').slideToggle(500)"
                style="border-bottom: 1px solid gray;">
                <b>
                    <i class="fa fa-angle-right"></i>
                    @trans('membership basic info')
                </b>
            </a>
            <br>


            <input type="hidden" name="unit_id" value="{{ optional(Subscription::getSubscriptionUnit())->id }}">
            <input type="hidden" name="type" value="single" id="type" >


            <div class="row basic-product-info">
                <div class="col-md-6 " style="padding: 0px!important">

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('membership name') *</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('name', !empty($duplicate_product->name) ? $duplicate_product->name : '', ['class' => 'form-control w3-light-gray w3-light-gray', 'required', 'placeholder' => __('membership name')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('subscription number') *</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('subscription_number', null, ['class' => 'form-control', 'required', 'placeholder' => __('subscription_number')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('subscription days')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('days', null, ['class' => 'form-control', 'placeholder' => __('days')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('stop_max_times')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('stop_max_times', null, ['class' => 'form-control', 'placeholder' => __('stop_max_times')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('stop_max_days')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('stop_max_days', null, ['class' => 'form-control', 'placeholder' => __('stop_max_days')]) !!}
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
                                <b>@trans("class type") *</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select(
                                    'class_type_id',
                                    Modules\Subscription\Entities\ClassType::active()->pluck('name', 'id')->toArray(),
                                    null,
                                    ['class' => 'form-control select2', 'required', 'placeholder' => __('select class type'), 'id' => 'class_type_id'],
                                ) !!}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6" style="padding: 0px!important">

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
                                <b>@trans('product.selling_price_tax_type')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive', ['class' => 'form-control select2', 'required', 'onchange' => 'this.value > 0? $(".tax-field").show() : $(".tax-field").hide()']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col @if (!session('business.enable_price_tax')) hide__ @endif" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.applicable_tax')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('tax', $taxes, null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2'], $tax_attributes) !!}
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
            <br>
            <div class="row"> 

                <div class="col-md-12">

                    <div style="overflow: auto" id="product_form_part">
                        @include('membership.partials.single_product_form_part', ['profit_percent' => $default_profit_percent])
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
 

<script>
    $('.select2').select2();
</script>
@php $asset_v = env('APP_VERSION'); @endphp
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    $('input, textarea, select').each(function() {
        if (!$(this).attr('id'))
            $(this).attr('id', $(this).attr('name'));
    });

    // convert form to ajax
    formAjax(false, function(r) {
        var product = r.data;
        // add step1 content
         
        product_table.ajax.reload();

        //$('.product-steps').modal('show'); 
    }, '#membership_add_form');

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


        $('form').addClass('form');

    });
</script>
