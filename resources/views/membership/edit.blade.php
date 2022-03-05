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
        {!! Form::open(['url' => action('MemberShipController@update', [$product->id]), 'method' => 'PUT', 'id' => 'product_add_form', 'class' => 'product_form', 'files' => true]) !!}
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

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('subscription_number', __('subscription_number') . ':*') !!}
                            {!! Form::number('subscription_number', $product->subscription_number, ['class' => 'form-control', 'required', 'placeholder' => __('subscription_number')]) !!}
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('days', __('days')) !!}
                            {!! Form::number('days', $product->days, ['class' => 'form-control', 'placeholder' => __('days')]) !!}
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('stop_max_times', __('stop_max_times')) !!}
                            {!! Form::number('stop_max_times', $product->stop_max_times, ['class' => 'form-control', 'placeholder' => __('stop_max_times')]) !!}
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('stop_max_days', __('stop_max_days')) !!}
                            {!! Form::number('stop_max_days', $product->stop_max_days, ['class' => 'form-control', 'placeholder' => __('stop_max_days')]) !!}
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if (!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
                        <div class="form-group">
                            {!! Form::label('sku', __('product.sku') . ':*') !!} @show_tooltip(__('tooltip.sku'))
                            {!! Form::text('sku', $product->sku, ['class' => 'form-control', 'placeholder' => __('product.sku'), 'required', 'readonly']) !!}
                        </div>
                    </div> 

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
     
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if (!session('business.enable_category')) hide @endif">
                        <div class="form-group">
                            {!! Form::label('category_id', __('product.category') . ':') !!}
                            {!! Form::select('category_id', $categories, $product->category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                        <div class="form-group">
                            {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.product_location_help'))
                            {!! Form::select('product_locations[]', $business_locations, $product->product_locations->pluck('id'), ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations']) !!}
                        </div>
                    </div>
      
                    <input type="hidden" name="unit_id" value="{{ optional(Subscription::getSubscriptionUnit())->id }}">
                    <input type="hidden" name="type" value="single">



                    <div class="col-lg-12 col-md-12 col-sm-12 w3-padding">
                        <div class="form-group">
                            {!! Form::label('product_description', __('lang_v1.product_description') . ':') !!}
                            {!! Form::textarea('product_description', $product->product_description, ['class' => 'form-control']) !!}
                        </div>
                    </div> 
     
                </div>
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
            </div>
        @endcomponent
 

        <div class="row">
            <input type="hidden" name="submit_type" id="submit_type">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="btn-group"> 
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
        formAjax(true, function(r) {
            var product = r.data;
            // add step1 content

            return 0;
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
