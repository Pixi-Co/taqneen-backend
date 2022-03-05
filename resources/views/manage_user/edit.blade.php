@extends('layouts.app')

@section('title', __('user.edit_user'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@trans( 'user.edit_user' )</h1>
    </section>

    <section class="add_user_content add_user_page w3-padding">
 

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item tab-btn-1">
                <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#tab_1" role="tab"
                    aria-controls="pills-home" aria-selected="true">@trans('Personal Information')</a>
            </li>
            <li class="nav-item tab-btn-2">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#tab_2" role="tab"
                    aria-controls="pills-profile" aria-selected="false">@trans('Roles and Permissions')</a>
            </li>
            <li class="nav-item tab-btn-3">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tab_3" role="tab"
                    aria-controls="pills-contact" aria-selected="false">@trans('Sales')</a>
            </li>
            <li class="nav-item tab-btn-4">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tab_4" role="tab"
                    aria-controls="pills-contact" aria-selected="false">@trans('More Informations')</a>
            </li>
            <li class="nav-item tab-btn-5">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tab_5" role="tab"
                    aria-controls="pills-contact" aria-selected="false">@trans('Upload File')</a>
            </li>
            <li class="nav-item tab-btn-6">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tab_6" role="tab"
                    aria-controls="pills-contact" aria-selected="false">@trans('Bank Details')</a>
            </li>
            <li class="nav-item tab-btn-7">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tab_7" role="tab"
                    aria-controls="pills-contact" aria-selected="false">@trans('HRM Details')</a>
            </li>
        </ul>


        {!! Form::open(['url' => action('ManageUserController@update', [$user->id]), 'method' => 'PUT', 'id' => 'user_edit_form']) !!}

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="tab_1" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="panel">
                    <div class="form">
                        <div class="my-3">
                            {!! Form::label('surname', __('business.prefix') . ':') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('surname', $user->surname, ['class' => 'form-control', 'placeholder' => __('business.prefix_placeholder')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('first_name', __('business.first_name') . ':*') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('first_name', $user->first_name, ['class' => 'form-control', 'required', 'placeholder' => __('business.first_name')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('last_name', __('business.last_name') . ':') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => __('business.last_name')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('email', __('business.email') . ':*') !!}
                            <div class="input-icons">
                                <i class="fas fa-envelope input_icon"></i>
                                {!! Form::email('email', $user->email, ['class' => 'form-control', 'required', 'placeholder' => __('business.email')]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="customcheck">
                                {{ __('lang_v1.status_for_user') }}
                                <a href="#">
                                    <span class="fas fa-info-circle" data-toggle="tooltip"
                                        data-original-title="@trans('lang_v1.tooltip_enable_user_active')">
                                    </span>
                                </a>
                                {!! Form::checkbox('is_active', $user->status, $is_checked_checkbox, ['class' => 'customcheck']) !!}
                                <span class="checkmark"></span>
                            </label>
                            @include("layouts.partials.tooltip", ['text' => __('lang_v1.tooltip_enable_user_active')])
                        </div>

                    </div>
                    <center class="form_bottons d-flex justify-content-between">
                        <button type="button" class="btn learn_more_link  next" onclick="gototab(2)">Next</button>
                    </center>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="panel">
                    <div class="form">
                        <div class="my-3">
                            {!! Form::label('username', __('business.username') . ':') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('username', $user->username, ['class' => 'form-control form-control-rounded', 'placeholder' => __('business.username')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('password', __('business.password') . ':*') !!}
                            <div class="input-icons">
                                <i class="fa fa-key input_icon"></i>
                                {!! Form::password('password', ['class' => 'form-control form-control-rounded', 'placeholder' => __('business.password')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('confirm_password', __('business.confirm_password') . ':*') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::password('confirm_password', ['class' => 'form-control form-control-rounded', 'placeholder' => __('business.confirm_password')]) !!}
                            </div>
                        </div>

                        <div class="my-3">
                            <div class="input-icons">
                                {!! Form::label('role', __('user.role') . ':*') !!}
                                @include("layouts.partials.tooltip", ['text' =>
                                __('lang_v1.admin_role_location_permission_help')])
                                {!! Form::select('role', $roles, !empty($user->roles->first()->id) ? $user->roles->first()->id : null, ['class' => 'custom-select border_select']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="customcheck">
                                {{ __('lang_v1.allow_login') }}
                                {!! Form::checkbox('allow_login', 1, !empty($user->allow_login), ['class' => 'customcheck', 'id' => 'allow_login']) !!}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="my-3">
                            <h4>
                                @trans( 'role.access_locations' )
                                @include("layouts.partials.tooltip", ['text' => __('tooltip.access_locations_permission')])
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <div class="form-check inner_checks">
                                    <label class="customcheck">
                                        {{ __('role.all_locations') }}
                                        <a href="#">
                                            <span class="fas fa-info-circle" data-toggle="tooltip"
                                                data-original-title="@trans('tooltip.all_location_permission')"></span>
                                        </a>
                                        {!! Form::checkbox('access_all_locations', 'access_all_locations', !is_array($permitted_locations) && $permitted_locations == 'all', ['class' => 'input-icheck no-icheck']) !!}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @foreach ($locations as $location)
                                    <div class="form-check inner_checks">
                                        <label class="customcheck">
                                            {{ $location->name }}
                                            {!! Form::checkbox('location_permissions[]', 'location.' . $location->id, is_array($permitted_locations) && in_array($location->id, $permitted_locations), ['class' => 'input-icheck no-icheck']) !!}
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <center class="form_bottons d-flex justify-content-between">
                        <button type="button" class="btn learn_more_link previous" onclick="gototab(1)"> Previous</button>
                        <button type="button" class="btn learn_more_link  next" onclick="gototab(3)">Next</button>
                    </center>
                </div>
                <div class="form_bottons d-flex justify-content-center">
                    <button type="submit" class="btn add_btn">Submit</button>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="panel">
                    <div class="form">
                        <div class="my-3">
                            {!! Form::label('cmmsn_percent', __('lang_v1.cmmsn_percent') . ':') !!}
                            @include("layouts.partials.tooltip", ['text' => __('lang_v1.commsn_percent_help')])
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('cmmsn_percent', !empty($user->cmmsn_percent) ? @num_format($user->cmmsn_percent) : 0, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.cmmsn_percent')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('max_sales_discount_percent', __('lang_v1.max_sales_discount_percent') . ':') !!}
                            @include("layouts.partials.tooltip", ['text' => __('lang_v1.max_sales_discount_percent_help')])
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('max_sales_discount_percent', !is_null($user->max_sales_discount_percent) ? @num_format($user->max_sales_discount_percent) : null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.max_sales_discount_percent')]) !!}
                            </div>
                        </div>
                        <div class="form-check">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="customcheck">{{ __('lang_v1.allow_selected_contacts') }}
                                        <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip"
                                                data-original-title="@trans('lang_v1.allow_selected_contacts_tooltip')"></span></a>
                                        <input class="checkbox1" type="checkbox">
                                        {!! Form::checkbox('selected_contacts', 1, $user->selected_contacts, ['class' => 'checkbox1', 'id' => 'selected_contacts']) !!}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div id="autoUpdate" class="autoUpdate selected_contacts_div hide">
                                        {!! Form::label('selected_contacts', __('lang_v1.selected_contacts') . ':') !!}
                                        {!! Form::select('selected_contact_ids[]', $contacts, $contact_access, ['class' => 'form-control mySelect', 'multiple']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center class="form_bottons d-flex justify-content-between">
                        <button class="btn learn_more_link previous" onclick="gototab(2)">Previous</button>
                        <button type="button" class="btn learn_more_link  next" onclick="gototab(4)">Next</button>
                    </center>
                </div>
                <div class="form_bottons d-flex justify-content-center">
                    <button type="submit" class="btn add_btn">Submit</button>
                </div>
            </div>
            <div class="tab-pane " id="tab_4" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="panel">
                    <div class="form">
                        @include('user.form')
                    </div>

                    <br>
                    <center class="form_bottons d-flex justify-content-between">
                        <button type="button" class="btn learn_more_link previous" onclick="gototab(3)"> Previous</button>
                        <button type="button" class="btn learn_more_link  next" onclick="gototab(5)">Next</button>
                    </center>
                </div>
                <div class="form_bottons d-flex justify-content-center">
                    <button type="submit" class="btn add_btn">Submit</button>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_5" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="panel">
                    <div class="form">
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="input-icons">
                                    <label class="customcheck">Upload Document:
                                        <!-- <a href="#"><span class="fas fa-info-circle" data-toggle="tooltip"
                                                            data-original-title="Check/Uncheck to make a user active/inactive."></span></a> -->
                                    </label>
                                </div>
                            </div>
                            <div class="upload-main-wrapper2">
                                <div class="upload-wrapper">
                                    <input type="file" id="upload-file">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet"
                                        viewBox="224.3881704980842 176.8527621722847 221.13266283524905 178.8472378277154"
                                        width="221.13" height="178.85">
                                        <defs>
                                            <path
                                                d="M357.38 176.85C386.18 176.85 409.53 204.24 409.53 238.02C409.53 239.29 409.5 240.56 409.42 241.81C430.23 246.95 445.52 264.16 445.52 284.59C445.52 284.59 445.52 284.59 445.52 284.59C445.52 309.08 423.56 328.94 396.47 328.94C384.17 328.94 285.74 328.94 273.44 328.94C246.35 328.94 224.39 309.08 224.39 284.59C224.39 284.59 224.39 284.59 224.39 284.59C224.39 263.24 241.08 245.41 263.31 241.2C265.3 218.05 281.96 199.98 302.22 199.98C306.67 199.98 310.94 200.85 314.93 202.46C324.4 186.96 339.88 176.85 357.38 176.85Z"
                                                id="b1aO7LLtdW"></path>
                                            <path d="M306.46 297.6L339.79 297.6L373.13 297.6L339.79 255.94L306.46 297.6Z"
                                                id="c4SXvvMdYD">
                                            </path>
                                            <path d="M350.79 293.05L328.79 293.05L328.79 355.7L350.79 355.7L350.79 293.05Z"
                                                id="b11si2zUk">
                                            </path>
                                        </defs>
                                        <g>
                                            <g>
                                                <g>
                                                    <use xlink:href="#b1aO7LLtdW" opacity="1" fill="#ffffff"
                                                        fill-opacity="1"></use>
                                                </g>
                                                <g>
                                                    <g>
                                                        <use xlink:href="#c4SXvvMdYD" opacity="1" fill="#363535"
                                                            fill-opacity="1"></use>
                                                    </g>
                                                    <g>
                                                        <use xlink:href="#b11si2zUk" opacity="1" fill="#363535"
                                                            fill-opacity="1"></use>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <!-- <span class="file-upload-text">Upload File</span> -->
                                    <div class="file-success-text">
                                        <svg version="1.1" id="check" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100"
                                            xml:space="preserve">
                                            <circle
                                                style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-miterlimit:10;"
                                                cx="49.799" cy="49.746" r="44.757" />
                                            <polyline
                                                style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                points="
                                                    27.114,51 41.402,65.288 72.485,34.205 " />
                                        </svg> <span>Successfully</span>
                                    </div>
                                </div>
                                <p id="file-upload-name"></p>
                            </div>

                        </div>
                    </div>

                    <center class="form_bottons d-flex justify-content-between">
                        <button type="button" class="btn learn_more_link previous" onclick="gototab(4)"> Previous</button>
                        <button type="button" class="btn learn_more_link  next" onclick="gototab(6)">Next</button>
                    </center>
                </div>
                <div class="form_bottons d-flex justify-content-center">
                    <button type="submit" class="btn add_btn">Submit</button>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_6" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="panel">
                    <div class="form">
                        <div class="my-3">
                            {!! Form::label('account_holder_name', __('lang_v1.account_holder_name') . ':') !!}
                            <div class="input-icons">

                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('bank_details[account_holder_name]', !empty($bank_details['account_holder_name']) ? $bank_details['account_holder_name'] : null, ['class' => 'form-control form-control-rounded', 'id' => 'account_holder_name', 'placeholder' => __('lang_v1.account_holder_name')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('account_number', __('lang_v1.account_number') . ':') !!}
                            <div class="input-icons">

                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('bank_details[account_number]', !empty($bank_details['account_number']) ? $bank_details['account_number'] : null, ['class' => 'form-control form-control-rounded', 'id' => 'account_number', 'placeholder' => __('lang_v1.account_number')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('bank_name', __('lang_v1.bank_name') . ':') !!}
                            <div class="input-icons">

                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('bank_details[bank_name]', !empty($bank_details['bank_name']) ? $bank_details['bank_name'] : null, ['class' => 'form-control form-control-rounded', 'id' => 'bank_name', 'placeholder' => __('lang_v1.bank_name')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('bank_code', __('lang_v1.bank_code') . ':') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('bank_details[bank_code]', !empty($bank_details['bank_code']) ? $bank_details['bank_code'] : null, ['class' => 'form-control form-control-rounded', 'id' => 'bank_code', 'placeholder' => __('lang_v1.bank_code')]) !!}
                                @include("layouts.partials.tooltip", ['text' => __('lang_v1.bank_code_help')])
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('branch', __('lang_v1.branch') . ':') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('bank_details[branch]', !empty($bank_details['branch']) ? $bank_details['branch'] : null, ['class' => 'form-control form-control-rounded', 'id' => 'branch', 'placeholder' => __('lang_v1.branch')]) !!}
                            </div>
                        </div>
                        <div class="my-3">
                            {!! Form::label('tax_payer_id', __('lang_v1.tax_payer_id') . ':') !!}
                            <div class="input-icons">
                                <i class="fa fa-user input_icon"></i>
                                {!! Form::text('bank_details[tax_payer_id]', !empty($bank_details['tax_payer_id']) ? $bank_details['tax_payer_id'] : null, ['class' => 'form-control form-control-rounded', 'id' => 'tax_payer_id', 'placeholder' => __('lang_v1.tax_payer_id')]) !!}
                                @include("layouts.partials.tooltip", ['text' => __('lang_v1.tax_payer_id_help')])
                            </div>
                        </div>
                    </div>
                    <center class="form_bottons d-flex justify-content-between">
                        <button type="button" class="btn learn_more_link previous" onclick="gototab(5)"> Previous</button>
                        <button type="button" class="btn learn_more_link  next" onclick="gototab(7)">Next</button>
                    </center>
                </div>
                <div class="form_bottons d-flex justify-content-center">
                    <button type="submit" class="btn add_btn">Submit</button>
                </div>
            </div>

            <div class="tab-pane fade" id="tab_7" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="panel">
                    <div class="form">
                        @if (!empty($form_partials))
                            @foreach ($form_partials as $partial)
                                {!! $partial !!}
                            @endforeach
                        @endif

                    </div>
                    <center class="form_bottons d-flex justify-content-between">
                        <button type="button" class="btn learn_more_link previous" onclick="gototab(6)"> Previous</button>
                    </center>
                </div>
                <div class="form_bottons d-flex justify-content-center">
                    <button type="submit" class="btn add_btn">Submit</button>
                </div>

            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection

@section('javascript')
@include("layouts.js.icheck")
    <script type="text/javascript">
        function gototab(id) {
            var tabname = "#tab_" + id;
            var defaultClasses = "tab-pane fade";
            var selectedClasses = "tab-pane fade active in";

            $('.tab-pane').removeClass('active in');
            $(tabname).addClass('active in');

            $('.nav-item').removeClass('active');
            $('.tab-btn-' + id).addClass('active');
        }

        $(document).ready(function() {
            gototab(1);
            __page_leave_confirmation('#user_edit_form');

            $('#selected_contacts').on('ifChecked', function(event) {
                $('div.selected_contacts_div').removeClass('hide');
            });
            $('#selected_contacts').on('ifUnchecked', function(event) {
                $('div.selected_contacts_div').addClass('hide');
            });
            $('#allow_login').on('ifChecked', function(event) {
                $('div.user_auth_fields').removeClass('hide');
            });
            $('#allow_login').on('ifUnchecked', function(event) {
                $('div.user_auth_fields').addClass('hide');
            });
        });

        $('form#user_edit_form').validate({
            rules: {
                first_name: {
                    required: true,
                },
                email: {
                    email: true,
                    remote: {
                        url: "/business/register/check-email",
                        type: "post",
                        data: {
                            email: function() {
                                return $("#email").val();
                            },
                            user_id: {{ $user->id }}
                        }
                    }
                },
                password: {
                    minlength: 5
                },
                confirm_password: {
                    equalTo: "#password",
                },
                username: {
                    minlength: 5,
                    remote: {
                        url: "/business/register/check-username",
                        type: "post",
                        data: {
                            username: function() {
                                return $("#username").val();
                            },
                            @if (!empty($username_ext))
                                username_ext: "{{ $username_ext }}"
                            @endif
                        }
                    }
                }
            },
            messages: {
                password: {
                    minlength: 'Password should be minimum 5 characters',
                },
                confirm_password: {
                    equalTo: 'Should be same as password'
                },
                username: {
                    remote: 'Invalid username or User already exist'
                },
                email: {
                    remote: '{{ __('validation.unique', ['attribute' => __('business.email')]) }}'
                }
            }
        });

    </script>
@endsection
