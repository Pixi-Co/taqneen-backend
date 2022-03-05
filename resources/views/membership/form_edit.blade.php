
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content"> 
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans('edit membership')</h4>
        </div>

        {!! Form::open(['url' => action('MemberShipController@update', [$product->id]), 'method' => 'PUT', 'id' => 'product_add_form_edit', 'class' => 'product_form', 'files' => true]) !!}
        <input type="hidden" id="product_id" value="{{ $product->id }}">

        <input type="hidden" name="unit_id" value="{{ optional(Subscription::getSubscriptionUnit())->id }}">
 
        
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
                <div class="col-md-6 " style="padding: 0px!important">

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('membership name') *</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('name', $product->name, ['class' => 'form-control w3-light-gray w3-light-gray', 'required', 'placeholder' => __('membership name')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('subscription number') *</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('subscription_number', $product->subscription_number, ['class' => 'form-control', 'required', 'placeholder' => __('subscription_number')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('stop_max_times')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('stop_max_times', $product->stop_max_times, ['class' => 'form-control', 'placeholder' => __('stop_max_times')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('stop_max_days')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('stop_max_days', $product->stop_max_days, ['class' => 'form-control', 'placeholder' => __('stop_max_days')]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('subscription days')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::number('days', $product->days, ['class' => 'form-control', 'placeholder' => __('days')]) !!}
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

                                {!! Form::text('sku', $product->sku, ['class' => 'form-control w3-light-gray', 'placeholder' => __('product.sku')]) !!}
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
                                    $product->class_type_id,
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
                                {!! Form::select('category_id', $categories, $product->category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2']) !!}
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
                                {!! Form::select('product_locations[]', $business_locations, $product->product_locations->pluck('id'), ['class' => 'form-control w3-light-gray select2', 'multiple', 'id' => 'product_locations', 'required' => 'required']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 product-attribute-col @if (!session('business.enable_price_tax')) hide__ @endif" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.selling_price_tax_type') *</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], $product->tax_type, ['class' => 'form-control select2', 'required', 'onchange' => 'this.value > 0? $(".tax-field").show() : $(".tax-field").hide()']) !!}
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-12 product-attribute-col @if (!session('business.enable_price_tax')) hide__ @endif" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('product.applicable_tax')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('tax', $taxes, $product->tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control w3-light-gray select2'], $tax_attributes) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 product-attribute-col" style="margin-bottom: 5px">
                        <div class="row">
                            <div class="col-md-4">
                                <b>@trans('lang_v1.product_description')</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::textarea('product_description', $product->product_description, ['rows' => '3', 'class' => 'form-control w3-light-gray']) !!}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end of basic info --->

            </div> 
            <br>
            <div class="row">


                <div class="col-md-12 product-attribute-col hidden" style="margin-bottom: 5px">
                    <div class="row">
                        <div class="col-md-4">
                            <b>@trans('product.product_type') *</b>
                            @include("layouts.partials.tooltip", ["text" => __('tooltip.product_type')])
                        </div>
                        <div class="col-md-8">
                            {!! Form::text('type', $product->type, ['class' => 'form-control', 'required', 'readonly', 'data-action' => 'edit', 'data-product_id' => $product->id, "id" => "type"]) !!}                        
                        </div>
                    </div>
                </div>

                <div class="col-md-12"> 

                    <div style="overflow: auto" id="product_form_part">
                    </div>
                    <input type="hidden" id="variation_counter" value="0">
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
    setTimeout(function(){
        
        get_sub_units();
    }, 1000);
</script>
@php $asset_v = env('APP_VERSION'); @endphp
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    $('input, textarea, select').each(function(){ 
        if (!$(this).attr('id')) 
            $(this).attr('id', $(this).attr('name'));
    });


    show_product_type_form(); 
    autoloadAppJs();
    get_sub_units();
    
    // convert form to ajax
    formAjax(true, function(r) { 
        // add step1 content
        $.get("{{ url('/products/add-selling-prices') }}/{{ $product->id }}" , function(res) {
            $('#step1').html(res);

            if ($('#step1').find('table').length <= 0)
                $('.product-steps').modal('hide');
            //
            formAjax(true, function(){ product_table.ajax.reload(); }, "#selling_price_form");
        });

        $.get("{{ url('/opening-stock/add') }}/{{ $product->id }}", function(res) {
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

        $('.first-nav').click();
    }, '#product_add_form_edit');
    
    
    $(document).ready(function() {
        __page_leave_confirmation('#product_add_form_edit');



        $('#enable_stock').iCheck('update', function() {
            if ($('#enable_stock').iCheck('check')) {
                $('#alert_quantity_div').show();
            } else {
                $('#alert_quantity_div').hide();
            }
        });

        $('select[name=repair_model_id]').parent().parent().addClass('w3-padding');
        
        if ($('.customcheck').parent()[0])
        $('.customcheck').parent()[0].className = "col-lg-4 col-md-4 col-sm-6 w3-padding";

        $('form').addClass('form');



        setTimeout(function() {
            $('.add-product-price-table').find('tr').addClass('w3-light-gray');
            $('.add-product-price-table').find('th').addClass('w3-white');
        }, 2000);

        $('.applicable-tax').change();
    });
</script>
