<!-- default value -->
@php
$go_back_url = action('SellPosController@index');
$transaction_sub_type = '';
$view_suspended_sell_url = action('SellController@index') . '?suspended=1';
$pos_redirect_url = action('SellPosController@create');
@endphp

@if (!empty($pos_module_data))
    @foreach ($pos_module_data as $key => $value)
        @php
            if (!empty($value['go_back_url'])) {
                $go_back_url = $value['go_back_url'];
            }
            
            if (!empty($value['transaction_sub_type'])) {
                $transaction_sub_type = $value['transaction_sub_type'];
                $view_suspended_sell_url .= '&transaction_sub_type=' . $transaction_sub_type;
                $pos_redirect_url .= '?sub_type=' . $transaction_sub_type;
            }
        @endphp
    @endforeach
@endif
@inject('request', 'Illuminate\Http\Request')

<div class="w3-block no-print pos-header " style="padding: 0px">
    <input type="hidden" id="pos_redirect_url" class="hidden" value="{{ $pos_redirect_url }}">
    <div class="w3-white w3-text-green w3-block" style="padding: 5px;height: 45px;">
        <div class="row">

            <div class="col-md-3 col-sm-3 col-xs-10 w3-display-container">

                <div class="w3-block location-name-edit-pos input-group w3-row">
                    <label class="w3-left" style="width: 20%!important">
                        @trans('sale.location')
                    </label>
                    <div style="width: 80%!important" class="w3-left" >
                        @if (empty($transaction->location_id))
                            @if (count($business_locations) > 1)
                                {!! Form::select('select_location_id', $business_locations, $default_location->id ?? null, ['class' => 'w3-input w3-border w3-border-green  w3-round input-sm', 'id' => 'select_location_id', 'required', 'autofocus'], $bl_attributes) !!}
                            @else
                                <b>{{ $default_location->name }}</b>
                            @endif
                        @endif

                        @if (!empty($transaction->location_id))
                            <button class="btn btn-flat m-6 m-5">
                                {{ $transaction->location->name }}
                            </button>
                        @endif
                    </div>


                </div>
            </div>

            <div class="col-md-3 text-right w3-hide-small w3-hide-medium">
                <button class="btn btn-flat">
                    <b>{{ @format_datetime('now') }}</b>
                </button>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-2 text-right w3-hide-large w3-hide-medium">
                <button class="btn btn-flat mobile-toggle-pos-header">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="col-md-6 pos-header-icons w3-hide-small">
                <a href="{{ url('/') }}" data-title="{{ __('home page') }}" data-placement="bottom"
                    data-toggle="tooltip" class="btn btn-flat m-6 btn-xs m-5 pull-right">
                    <strong><i class="fa fa-home"></i></strong>
                </a>

                <a href="{{ $go_back_url }}" data-title="{{ __('lang_v1.go_back') }}" data-placement="bottom"
                    data-toggle="tooltip" class="btn btn-flat m-6 btn-xs m-5 pull-right">
                    <strong><i class="fa fa-backward fa-lg"></i></strong>
                </a>

                @if (empty($pos_settings['hide_product_suggestion']) && isMobile())
                    <button type="button" 
                        data-title="{{ __('lang_v1.view_products') }}" data-placement="bottom"
                        class="btn btn-flat m-6 btn-xs m-5 btn-modal pull-right" 
                        data-toggle="modal"
                        data-target="#mobile_product_suggestion_modal">
                        <strong><i class="fa fa-cubes fa-lg"></i></strong>
                    </button>
                @endif

                @can('close_cash_register')
                    <button type="button" id="close_register" data-title="{{ __('cash_register.close_register') }}"
                        data-placement="bottom" data-toggle="tooltip"
                        class="btn btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".close_register_modal"
                        data-href="{{ action('CashRegisterController@getCloseRegister') }}">
                        <strong><i class="fa fa-window-close fa-lg"></i></strong>
                    </button>
                @endcan

                @can('view_cash_register')
                    <button type="button" id="register_details" data-title="{{ __('cash_register.register_details') }}"
                        class="btn btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".register_details_modal"
                        data-placement="bottom" data-toggle="tooltip"
                        data-href="{{ action('CashRegisterController@getRegisterDetails') }}">
                        <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
                    </button>
                @endcan

                <button title="@trans('lang_v1.calculator')" id="btnCalculator" type="button"
                    class="btn btn-flat pull-right m-5 btn-xs mt-10 popover-default" data-toggle="popover"
                    data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true"
                    data-placement="bottom">
                    <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
                </button>

                <button type="button" id="view_suspended_sales" data-title="{{ __('lang_v1.view_suspended_sales') }}"
                    class="btn btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".view_modal"
                    data-placement="bottom" data-toggle="tooltip" data-href="{{ $view_suspended_sell_url }}">
                    <strong><i class="fa fa-pause-circle fa-lg"></i></strong>
                </button>

                <button type="button" data-title="{{ __('lang_v1.full_screen') }}" data-toggle="tooltip"
                    class="btn btn-flat m-6 btn-xs m-5 pull-right" data-placement="bottom" onclick="fullScreen(null)">
                    <i class="fa fa-tv"></i>
                </button>

                <button type="button" class="btn btn-flat m-6 btn-xs m-5 btn-modal pull-right">
                    <i class="fa fa-keyboard" aria-hidden="true" data-container="body" data-toggle="tooltip"
                        data-placement="bottom" data-title="@include('sale_pos.partials.keyboard_shortcuts_details')"
                        data-html="true" data-trigger="hover" data-original-title="" title=""></i>
                </button>

                @if (Module::has('Repair') && $transaction_sub_type != 'repair')
                    @include('repair::layouts.partials.pos_header')
                @endif

                @if (in_array('pos_sale', $enabled_modules) && !empty($transaction_sub_type))
                    @can('sell.create')
                        <a href="{{ action('SellPosController@create') }}" title="@trans('sale.pos_sale')"
                            class="btn btn-flat m-6 btn-xs m-5 pull-right">
                            <strong><i class="fa fa-th-large"></i> &nbsp; @trans('sale.pos_sale')</strong>
                        </a>
                    @endcan
                @endif

                @can_bt(['subscription.calendar'])
                @can('subscription.calendar')
                <a href="{{ url('/sub?tab=calendar') }}" target="_blank" title="@trans('calendar of sessions')"
                    data-placement="bottom" data-toggle="tooltip" class="btn btn-flat m-6 btn-xs m-5 pull-right">
                    <strong><i class="fa fa-calendar"></i></strong>
                </a>
                @endcan
                @endcan_bt

                @can_bt(['subscription.receiption'])
                @can('subscription.receiption')
                <a href="{{ url('/sub/receiption') }}" target="_blank" title="@trans('receiption page')"
                    data-placement="bottom" data-toggle="tooltip" class="btn btn-flat m-6 btn-xs m-5 pull-right">
                    <strong><i class="fas fa-sign-in-alt"></i></strong>
                </a>
                @endcan
                @endcan_bt

                @can_bt(['subscription.session'])
                @can('subscription.sessions.view')
                <a href="{{ url('/sub?tab=session') }}" target="_blank" title="@trans('sessions')"
                    data-placement="bottom" data-toggle="tooltip" class="btn btn-flat m-6 btn-xs m-5 pull-right">
                    <strong><i class="fas fa-clock"></i></strong>
                </a>
                @endcan
                @endcan_bt
            </div>

        </div>
    </div>
</div>

<input type="hidden" class="hidden" name="transaction_sub_type" id="transaction_sub_type"
    value="{{ $transaction_sub_type }}">


<div class="modal fade header-pos-modal-icon">
    <div class="modal-dialog">
        <div class="w3-modal-content mobile-pos-header-content w3-row w3-round w3-padding" >
            
        </div>        
    </div>
</div>
