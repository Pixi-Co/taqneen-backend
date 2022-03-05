<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        @php
            $form_id = 'contact_add_form';
            if (isset($quick_add)) {
                $form_id = 'quick_add_contact';
            }
            
            if (isset($store_action)) {
                $url = $store_action;
                $type = 'lead';
                $customer_groups = [];
            } else {
                $url = action('ContactController@store');
                $type = isset($selected_type) ? $selected_type : '';
                $sources = [];
                $life_stages = [];
                $users = [];
            }
            
            $genders = [
                'male' => __('male'),
                'female' => __('female'),
            ];
        @endphp
        {!! Form::open(['url' => $url, 'method' => 'post', 'id' => $form_id]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans('contact.add_contact')</h4>
        </div>

        <div class="modal-body">


            <div class="row">
                {!! Form::hidden('prefix', null) !!}
                {!! Form::hidden('middle_name', "") !!}


               
                <div class="col-md-6">

                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-4">
                            <b>{{ __('contact.contact_type') }}</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('type', $types, $type, ['class' => 'form-control w3-light-gray', 'id' => 'contact_type', 'placeholder' => __('messages.please_select'), 'required']) !!}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-4">
                            <b>{{ __('gender') }} *</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::select('gender', $genders, "male", ['class' => 'form-control w3-light-gray', 'id' => 'gender', 'placeholder' => __('select gender'), 'required']) !!}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-4"  >
                            <b>{{ __('name') }} *</b>
                        </div>
                        <div class="col-md-3" style="padding: 2px!important">
                            {!! Form::text('first_name', null, ['class' => 'form-control w3-light-gray', 'required', 'placeholder' => __('business.first_name')]) !!}
                        </div>
                        <div class="col-md-3" style="padding: 2px!important">
                            {!! Form::text('middle_name', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.middle_name')]) !!}
                        </div>
                        <div class="col-md-2" style="padding: 2px!important">
                            {!! Form::text('last_name', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.last_name')]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-4">
                            <b>{{ __('contact.mobile') }} *</b>
                        </div>
                        <div class="col-md-4">
                            <select name="country_code" required id="country_code" class="form-control w3-light-gray">
                                @foreach (DB::table('countries')->get() as $item)
                                    <option value="{{ $item->phone_code }}" 
                                        {{ $item->phone_code == session('business.common_settings.default_country_code') ? 'selected' : '' }}
                                        >{{ $item->name }}
                                        ({{ $item->phone_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {!! Form::text('mobile', null, ['class' => 'form-control w3-light-gray', 'required', 'placeholder' => __('contact.mobile')]) !!}
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-4">
                            <b>{{ __('business.email') }}</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::email('email', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.email')]) !!}
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-4">
                            <b>{{ __('lang_v1.dob') }}</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::text('dob', null, ['class' => 'form-control dob-date-picker  w3-light-gray', 'placeholder' => __('lang_v1.dob'), 'readonly']) !!}
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 5px">
                        <div class="col-md-4">
                            <b>{{ __('national id') }}</b>
                        </div>
                        <div class="col-md-8">
                            {!! Form::text('national_id', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('national id')]) !!}
                        </div>
                    </div>
                </div>

            </div>

            <br>
            <div class="row">

                <div class="col-md-12 text-center">
                    <button type="button" style="margin-bottom: 10px" class="btn btn-primary w3-round-xlarge more_btn"
                        data-target="#more_div">@trans('lang_v1.more_info') <i class="fa fa-chevron-down"></i></button>
                </div>

                <div id="more_div" class="hide w3-">
                    <div class="col-md-6">

                        @php 
                            $issuerTypes = App\GlobalSetting::getIssuerTypes();
                            $listOfIssuerTypes = [];
                            foreach($issuerTypes as $item) {
                                $listOfIssuerTypes[$item->key] = "(" . $item->key . ") " . __($item->description);
                            }
    
                            $countryCodes = App\GlobalSetting::getCountryCodes();
                            $listOfCountryCodes = [];
                            foreach($countryCodes as $item) {
                                $listOfCountryCodes[$item->code] = session('user.language') == 'ar'? $item->description_ar : $item->description_en;
                            }
                        @endphp     
                        <div class="row customer_fields" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('receiver_types') }}</b>
                                @include("layouts.partials.tooltip", ["text" => __('Type of the issuer - supported values for E invoice')])
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('receiver_type', $listOfIssuerTypes, '', ['class' => 'form-control w3-light-gray']) !!}
                            </div>
                        </div>
                        <div class="row customer_fields" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('country_code_einvoice') }}</b>
                                @include("layouts.partials.tooltip", ["text" => __('Country represented by ISO-3166-2 2 symbol code of the countries. Must be EG for internal business issuers')])
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('country_code_einvoice', $listOfCountryCodes, '', ['class' => 'form-control select2 w3-light-gray']) !!}
                            </div>
                        </div>

                        <div class="row customer_fields" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.customer_group') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('customer_group_id', $customer_groups, '', ['class' => 'form-control w3-light-gray']) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('business.business_name') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('supplier_business_name', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.business_name')]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('contact.alternate_contact_number') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('alternate_number', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('contact.alternate_contact_number')]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('contact.tax_no') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('tax_number', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('contact.tax_no')]) !!}
                            </div>
                        </div>

                        <div class="row opening_balance" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.opening_balance') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('opening_balance', 0, ['class' => 'form-control w3-light-gray input_number']) !!}
                            </div>
                        </div>

                        <div class="row pay_term" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('contact.pay_term') }}</b> @show_tooltip(__('tooltip.pay_term'))
                            </div>
                            <div class="col-md-4">
                                {!! Form::number('pay_term_number', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('contact.pay_term')]) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], '', ['class' => 'form-control  w3-light-gray', 'placeholder' => __('messages.please_select')]) !!}
                            </div>
                        </div>

                        @php
                            $common_settings = session()->get('business.common_settings');
                            $default_credit_limit = !empty($common_settings['default_credit_limit']) ? $common_settings['default_credit_limit'] : null;
                        @endphp
                        <div class="row customer_fields" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.credit_limit') }}</b>
                                <p class="help-block">@trans('lang_v1.credit_limit_help')</p>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('credit_limit', $default_credit_limit ?? null, ['class' => 'form-control input_number w3-light-gray']) !!}
                            </div>
                        </div>

                        <div class="row lead_additional_div" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.source') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('crm_source', $sources, null, ['class' => 'form-control w3-light-gray', 'id' => 'crm_source', 'placeholder' => __('messages.please_select')]) !!}
                            </div>
                        </div>

                        <div class="row lead_additional_div" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.life_stage') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('crm_life_stage', $life_stages, null, ['class' => 'form-control w3-light-gray', 'id' => 'crm_life_stage', 'placeholder' => __('messages.please_select')]) !!}
                            </div>
                        </div>

                        <div class="row lead_additional_div" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.assigned_to') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::select('user_id[]', $users, null, ['class' => 'form-control select2 w3-light-gray', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 100%;']) !!}
                            </div>
                        </div> 
                    </div>

                    <div class="col-md-6">


                        {!! Form::hidden('position', null, ['id' => 'position']) !!}


                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('contact.landline') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('landline', null, ['class' => 'form-control  w3-light-gray', 'placeholder' => __('contact.landline')]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.address_line_1') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('address_line_1', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('lang_v1.address_line_1'), 'rows' => 3]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.address_line_2') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('address_line_2', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('lang_v1.address_line_2'), 'rows' => 3]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('business.city') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('city', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.city')]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('business.state') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('state', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.state')]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('business.country') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('country', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.country')]) !!}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('business.zip_code') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('zip_code', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('business.zip_code_placeholder')]) !!}
                            </div>
                        </div>

                        @php
                            $custom_labels = json_decode(session('business.custom_labels'), true);
                            $contactCustomLabels = isset($custom_labels['contact']) ? $custom_labels['contact'] : [];
                        @endphp
                        <div class="row shipping_addr_div" style="margin-bottom: 5px">
                            <div class="col-md-4">
                                <b>{{ __('lang_v1.shipping_address') }}</b>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('shipping_address', null, ['class' => 'form-control w3-light-gray', 'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']) !!}
                                <div id="map"></div>
                            </div>
                        </div>

                    </div>

                    @foreach ($contactCustomLabels as $key => $value)
                        @if ($value)
                            <div class="col-md-6">
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-md-4">
                                        <b>{{ __($value) }}</b>
                                    </div>
                                    <div class="col-md-8">
                                        {!! Form::text($key, null, ['class' => 'form-control', 'placeholder' => __($value)]) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


                </div>
                @include('layouts.partials.module_form_part')
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
            </div>

            {!! Form::close() !!}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->


    <script>
        $('.more_btn').each(function() {
            $(this).parent().addClass('text-center');
            $(this).removeClass('center-block');
        });
        
    </script>
