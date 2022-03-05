@extends('layouts.app')
@section('title', __('membership.add_new_membership'))

@section('css')
    <style>
        .col-lg-4,
        .col-md-4,
        .col-sm-4 {
            min-height: 84px;
        }

        .tax-field {
            display: none
        }

        .add-membership-price-table tr::first-line {
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
        <h1>@trans('membership.add_new_membership')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @php
            $form_class = empty($duplicate_membership) ? 'create' : '';
        @endphp

        <div class="w3-">
            {!! Form::open(['url' => action('MemberShipController@store'), 'method' => 'post', 'id' => 'membership_add_form', 'class' => 'membership_form' . $form_class, 'files' => true]) !!}
            @component('components.widget', ['class' => 'box-primary w3-padding'])
                <div class="w3-padding">
                    <d class="row">

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('name', __('membership.membership_name') . ':*') !!}
                                {!! Form::text('name', !empty($duplicate_membership->name) ? $duplicate_membership->name : null, ['class' => 'form-control', 'required', 'placeholder' => __('membership.membership_name')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('subscription_number', __('subscription_number') . ':*') !!}
                                {!! Form::number('subscription_number', null, ['class' => 'form-control', 'required', 'placeholder' => __('subscription_number')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('days', __('days')) !!}
                                {!! Form::number('days', null, ['class' => 'form-control', 'placeholder' => __('days')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('stop_max_times', __('stop_max_times')) !!}
                                {!! Form::number('stop_max_times', null, ['class' => 'form-control', 'placeholder' => __('stop_max_times')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('stop_max_days', __('stop_max_days')) !!}
                                {!! Form::number('stop_max_days', null, ['class' => 'form-control', 'placeholder' => __('stop_max_days')]) !!}
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                @foreach ($categories as $key => $value)
                                    @php
                                        $item = App\Category::find($key);
                                    @endphp
                                    <input type="hidden" class="category-pr-{{ $item->id }}" value="{{ $item->short_code }}">
                                @endforeach
                                {!! Form::label('category_id', __('product.category') . ':') !!}
                                {!! Form::select('category_id', $categories, !empty($duplicate_product->category_id) ? $duplicate_product->category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('sku', __('membership.sku') . ':') !!} @show_tooltip(__('tooltip.sku'))
                                <div class="input-group">
                                    {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __('membership.sku')]) !!}
                                    <span class="input-group-btn" style="padding-left: 3px">
                                        <button type="button"
                                            onclick="$('input[name=sku]').val(createSku($('.category-pr-' + $('select[name=category_id]').val()).val()))"
                                            class="btn btn-default add_select_btn  w3-round btn-modal new-theme">
                                            <i class="fa fa-magic text-primary fa-lg w3-text-white"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>


                        @can_bt(['subscription.class_type'])
                        <div class="col-md-4 w3-padding">
                            <div class="form-group">
                                <label for="">@trans("class type")</label>
                                {!! Form::select('class_type_id',Modules\Subscription\Entities\ClassType::active()->pluck('name', 'id')->toArray(),null,['class' => 'form-control select2', "required", 'placeholder' => __('select class type'), 'id' => 'class_type_id']) !!}
                            </div>
                        </div>
                        @endcan_bt

                        <input type="hidden" name="unit_id" value="{{ optional(Subscription::getSubscriptionUnit())->id }}">
                        <input type="hidden" name="type" value="single">
 
                        @php
                            $default_location = null;
                            if (count($business_locations) == 1) {
                                $default_location = array_key_first($business_locations->toArray());
                            }
                        @endphp
                        <div class="col-lg-4 col-md-4 col-sm-6 w3-padding">
                            <div class="form-group">
                                {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.membership_location_help'))
                                {!! Form::select('product_locations[]', $business_locations, $default_location, ['class' => 'form-control select2', 'multiple', 'id' => 'membership_locations', 'required' => 'required']) !!}
                            </div>
                        </div>  

                        <div class="col-md-6 hidden">
                            <div class="form-group" style="">
                                {!! Form::label('tax_type', __('product.selling_price_tax_type') . ':*') !!}
                                {!! Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive', ['class' => 'form-control select2', 'required', 'onchange' => 'this.value > 0? $(".tax-field").show() : $(".tax-field").hide()']) !!}
                            </div>
                        </div>
                        
                        <div class="tax- form-group col-sm-12" id="product_form_part">
                            @include('membership.partials.single_product_form_part', ['profit_percent' =>
                            $default_profit_percent])
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 w3-padding">
                            <div class="form-group">
                                {!! Form::label('product_description', __('membership_description') . ':') !!}
                                {!! Form::textarea('product_description', !empty($duplicate_membership->membership_description) ? $duplicate_membership->membership_description : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    @endcomponent

                    <div class="row">
                        <input type="hidden" id="variation_counter" value="1">
                        <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">

                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" name="submit_type" id="submit_type">
                            <div class="text-center">
                                <div class="btn-group">
                                    <button type="submit" value="submit"
                                        class="btn btn-primary submit_membership_form">@trans('messages.save')</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

            </div>

    </section>
    <!-- /.content -->

    @include("product.product_steps")
@endsection

@section('javascript')
    @php $asset_v = env('APP_VERSION'); @endphp
    <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

    <script type="text/javascript">
        // convert form to ajax
        formAjax(false, function(r) {
            var membership = r.data;
            // add step1 content
            $.get("{{ url('/memberships/add-selling-prices') }}/" + membership.id, function(res) {
                $('#step1').html(res);
                //
                formAjax(true, null, "#selling_price_form");
            });

            $.get("{{ url('/opening-stock/add') }}/" + membership.id, function(res) {
                res = res.replace(/modal/g, '_modal');
                $('#step2').html(res);
                //
                formAjax(true, null, "#add_opening_stock_form");
            });

            $('.membership-steps').show();
            $('.first-nav').click();
        }, '#membership_add_form');

        $(document).ready(function() {
            __page_leave_confirmation('#membership_add_form');
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
@endsection
