@inject('request', 'Illuminate\Http\Request')
@php

$user_id = request()
    ->session()
    ->get('user.id');
$user = App\User::where('id', $user_id)
    ->with(['media'])
    ->first();
$config_languages = config('constants.langs');
$languages = [];
foreach ($config_languages as $key => $value) {
    $languages[$key] = $value['full_name'];
}
@endphp
<!-- Main Header -->
<header class="main-header no-print" style="position: relative;">


    <!-- Header Navbar -->
    <nav class="navbar row navbar-static-top top-nav w3-white" style="width: 100%" role="navigation">
        <div class="navbar-overflow w3-block"    >
        
        <!-- Sidebar toggle button mobile-->
        <a 
        href="#" class="sidebar-toggle-mobile w3-left w3-padding" 
        style="padding: 20px!important"  role="button"> 
            <span class="fa fas fa-bars"></span>
        </a>
        <a 
        href="#" class="sidebar-toggle-mobile-header- hidden w3-left w3-padding" 
        style="padding: 20px!important"  role="button"> 
            <span class="fa fas fa-th-list"></span>
        </a>

        
        <div class="text-right w3-text-white w3-padding btn hidden" id="mobileToggleHeader-" >
            <i class="fas fa fa-bars w3-large  "></i>
        </div>
        <!-- Sidebar toggle button-->
        <a href="#" 
        onclick="$('.treeview-menu').hide()"
        class="sidebar-toggle w3-left" data-toggle="offcanvas" role="button">
          &#9776;
          <span class="sr-only">Toggle navigation</span>
        </a>

        @if (Module::has('Superadmin'))
            @includeIf('superadmin::layouts.partials.active_subscription')
        @endif

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">


            
            <!--
            @can('superadmin')
                <a  href="/supportboard/admin.php" id="" title="{{ __('support board chat') }}" data-toggle="tooltip"
                    data-placement="bottom" class="btn m-8 btn-sm mt-10"> 
                    <img src="{{ url('/supportboard/media/icon.png') }}" width="21px" alt="">
                </a>
            @endcan

            @if (Module::has('Essentials'))
                @includeIf('essentials::layouts.partials.header_part')
            @endif
            
            <button id="mobileToggleHeader" type="button"
                class="btn btn-flat pull-left m-8 btn-sm mt-10 hidden-xs"  >
                <strong><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i></strong>
            </button>

            <div class="btn-group shortcut-section w3-display-container">
                <button id="header_shortcut_dropdown" type="button"
                    class="btn dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-plus-circle fa-lg"></i>
                </button>
                <ul class="dropdown-menu material-shadow">
                    @if (config('app.env') != 'demo')
                        <li>
                            <a href="{{ route('calendar') }}">
                                <i class="fas fa-calendar-alt" aria-hidden="true"></i> @trans('lang_v1.calendar')
                            </a>
                        </li>
                    @endif
                    @if (Module::has('Essentials'))
                        <li>
                            <a href="#" class="btn-modal"
                                data-href="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@create') }}"
                                data-container="#task_modal">
                                <i class="fas fa-clipboard-check" aria-hidden="true"></i> @trans(
                                'essentials::lang.add_to_do' )
                            </a>
                        </li>
                    @endif 
                    @if (auth()->user()->can('supplier.create') ||
                        auth()->user()->can('customer.create') ||
                        auth()->user()->can('supplier.view_own') ||
                        auth()->user()->can('customer.view_own'))
                   
                    <li>
                        <a  href="{{ url('/contacts?type=supplier&action=create') }}">
                            <i class="fa fa-address-book " aria-hidden="true"></i>
                            @trans('add supplier')
                        </a>
                    </li>
                    <li>
                        <a  href="{{ url('/contacts?type=customer&action=create') }}">
                            <i class="fa fa-address-book " aria-hidden="true"></i>
                            @trans('add customer')
                        </a>
                    </li>
                    @endif
                    @can('product.create')
                    <li>
                        <a  href="{{ action('ProductController@index') }}?action=create">
                            <i class="fa fa-cubes " aria-hidden="true"></i>
                            @trans('messages.product_add')
                        </a>
                    </li>
                    @endcan
                    @can_bt(["subscription.module"])
                    <li>
                        <a  href="{{ action('MemberShipController@index') }}?action=create">
                            <i class="fa fa-trophy " aria-hidden="true"></i>
                            @trans('add membership')
                        </a>
                    </li>
                    <li>
                        <a  href="/sub/receiption">
                            <i class="fa fa-calendar " aria-hidden="true"></i>
                            @trans('receiption page')
                        </a>
                    </li>
                    @endcan_bt
                    @can('purchase.create')
                    <li>
                        <a  href="{{ action('PurchaseController@create') }}">
                            <i class="fa fa-shopping-cart " aria-hidden="true"></i>
                            @trans('messages.purchase_add')
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            <button id="btnCalculator" title="@trans('lang_v1.calculator')" type="button"
                class="w3-display-container btn btn-flat pull-left m-8 btn-sm mt-10 popover-default hidden-xs" data-toggle="popover"
                data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true"
                data-placement="bottom">
                <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
            </button>

            @if ($request->segment(1) == 'pos')
                @can('view_cash_register')
                    <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}"
                        data-toggle="tooltip" data-placement="bottom"
                        class="btn btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".register_details_modal"
                        data-href="{{ action('CashRegisterController@getRegisterDetails') }}">
                        <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
                    </button>
                @endcan
                @can('close_cash_register')
                    <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}"
                        data-toggle="tooltip" data-placement="bottom"
                        class="btn btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".close_register_modal"
                        data-href="{{ action('CashRegisterController@getCloseRegister') }}">
                        <strong><i class="fa fa-window-close fa-lg"></i></strong>
                    </button>
                @endcan
            @endif

            @if (in_array('pos_sale', $enabled_modules))
                @can('sell.create')
                    <a href="{{ action('SellPosController@create') }}"  title="@trans('sale.pos_sale')"
                        data-toggle="tooltip" data-placement="bottom" class="btn pull-left m-8 btn-sm mt-10 pos-link">
                        <strong><i class="fa fa-th-large"></i> &nbsp; @trans('sale.pos_sale')</strong>
                    </a>
                @endcan
            @endif
            @can_bt(['subscription.module'])
                @can('subscription.create')
                    <a href="{{ action('SubSellPosController@create') }}"  title="@trans('sub_pos')" data-toggle="tooltip" data-placement="bottom" class="btn pull-left m-8 btn-sm mt-10 pos-link">
                        <strong><i class="fa fa-th-large"></i> &nbsp; @trans('sub_pos')</strong>
                    </a>
                @endcan
            @endcan_bt

            @if (Module::has('Repair'))
                <div class="hidden">
                    @includeIf('repair::layouts.partials.header')
                </div>
            @endif

            @can('profit_loss_report.view')
                <button type="button" id="view_todays_profit" title="{{ __('home.todays_profit') }}" data-toggle="tooltip"
                    data-placement="bottom" class="hidden btn m-8 btn-sm mt-10">
                    <strong><i class="fas fa-money-bill-alt fa-lg"></i></strong>
                </button>
            @endcan
        -->

            <button type="button" class="btn m-8 btn-sm mt-10 fullscreen-header-btn" onclick="fullScreen(null)">
                <img src="{{ asset('/img/maximize.svg') }}" width="21px" alt="">
            </button>


            {!! Form::open(['url' => action('UserController@updateProfile'), 'method' => 'post', 'id' => 'edit_user_profile_form', 'files' => true]) !!}
            <div class="dropdown lang btn m-8 btn-sm mt-10">
                <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-expanded="true">
                    <span class=" flag-{{ $user->language }}"></span>
                    <span class="header-lang-label">
                        {{ $languages[$user->language] }}
                    </span>
                </a>
                <div class="dropdown-menu new-shadow lang-dropdown" 
                aria-labelledby="dropdownMenuLink" 
                x-placement="bottom-start"
                style="height: 100px;display: hidden; position: absolute; will-change: transform; top: 10px; left: 0px; transform: translate3d(10px, 22px, 0px);">
                    
                    <input type="hidden" name="is_header" value="1">
                    <input type="hidden" name="language" id="selectedLang"  >
                    @foreach($languages as $key => $value)
                    @if(in_array($key, ['ar', 'en']))
                    <a class="dropdown-item" href="#" onclick="$('#selectedLang').val('{{ $key }}');$('#edit_user_profile_form')[0].submit()" >
                        <span class="flag-{{ $key }}" ></span>
                        
                        {{ $value }}
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
            <!--
            {!! Form::select('language', $languages, $user->language, ['class' => 'form-control select2 hidden']) !!}
            -->
            {!! Form::close() !!}


            @php
                $searchPage = getPages();
            @endphp

            <div class="btn-group search-section">
                <button type="button" 
                data-toggle=""
                onclick="$('.search-dropdown-topbar-').slideToggle(500)" class=" dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-search"></i>
                </button>
                <ul class="dropdown-menu w3-round search-dropdown-topbar-"
                    style="{{  isRtl()? 'right: inherit!important;left: -90px!important;' : ' right: 0px;left:inherit;' }} padding: 4px;width: 320px;top: 55px;background-color: #fafafa">

                    <div class="input- w3-display-container w3-white">

                        <div class="w3-display-topleft"
                            style="padding: 3px!important;width: 100px;z-index: 9;padding-top: 4px!important">
                            <select class="w3-border-0 w3-green" id="selectSearchPage" 
                            style="padding: 5px">
                                @foreach ($searchPage as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" class="form-control" id="inputSearchPage"
                            style="background-color: transparent;padding-left: 110px" placeholder="@trans('search')">

                        <span class="w3-display-topright" style="z-index: 9;padding-top: 4px">
                            <i onclick="searchInPage()" class="btn fa fa-search new-theme-text"></i>
                        </span>
                    </div>
                </ul>
            </div>


            <button type="button" onclick="changeTheme(this)" id="changeThemeButton" class="pull-left m-8 btn-sm mt-10">
                <i class="fas fa-moon"></i>
            </button>


            <div class="m-8 pull-left mt-15 hidden-xs hidden" style="color: #fff;">
                <strong>{{ @format_date('now') }}</strong>
            </div>

            <ul class="nav navbar-nav profile-nav">
                @include('layouts.partials.header-notifications')
                <!-- User Account Menu -->
                <li class="dropdown user user-menu" >
                    <!-- Menu Toggle Button -->
                    <a href="#" data-toggle="dropdown" id="dropdownMenuLink" 
                    
                    class="dropdown-toggle profile-dropdown-link" 
                    _onclick="$('.profile-dropdown').slideToggle(500)">
                        <!-- The user image in the navbar-->
                        @php
                            $profile_photo = auth()->user()->media;
                        @endphp
                        @if (!empty($profile_photo))
                            <img src="{{ $profile_photo->display_url }}" class="user-image" alt="User Image">
                        @else
                            <img src="{{ asset('/images/user.jpg') }}" class="user-image" alt="User Image">
                        @endif
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="username-span" >{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</span>
                    </a>
                    <div class="dropdown-menu profile-dropdown"
                        aria-expanded="true"
                        aria-labelledby="dropdownMenuLink"
                        x-placement="bottom-start"
                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-97px, 40px, 0px);">
                        <div class="pic">
                            <h5>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</h5>
                            <div class="log_user d-flex justify-content-between">
                                <div class="user_timer">
                                    <label id="minutes">14</label>
                                    <label id="colon">:</label>
                                    <label id="seconds">52</label>
                                </div>
                                <div class="clock_out_btn">
                                    <a href="#" class="btn btn-default"> @trans('Clock Out') </a>
                                </div>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <a class="dropdown-item" href="{{ action('UserController@getProfile') }}">
                                    <i class="fa fa-edit"></i> @trans('lang_v1.profile')
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/documentation') }}">
                                    <i class="fas fa-info-circle"></i> @trans('Help & Support')
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item per_btn"
                                    onclick="$('.profile-preferance-body').slideToggle(500)" href="#0">
                                    <i class="fas fa-cogs"></i> @trans('Preferences')
                                </a>
                                <ul class="per_body profile-preferance-body" style="display: block">
                                    <li class="font_size">
                                        <span><i class="fas fa-caret-right"></i> @trans('Font size')</span>
                                        <span>
                                            <i class="fas fa-plus font_plus"></i>
                                            <i class="fas fa-minus font_min"></i>
                                        </span>
                                    </li>

                                    <!--
                                    <li class="color_palette hidden">
                                        <span><i class="fas fa-caret-right"></i> Color Palette</span>
                                        <div class="colors d-flex">
                                            <a class="palette color1"></a>
                                            <a class="palette color2"></a>
                                            <a class="palette color3"></a>
                                        </div>
                                    </li>
                                -->
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ action('Auth\LoginController@logout') }}">
                                    <i class="fas fa-sign-out-alt"></i> @trans('lang_v1.sign_out')
                                </a>
                            </li>
                        </ul>
                    </div>


                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
        </div>
    </nav>
</header>
<div class="header-hr" ></div>


<div class="modal fade modal-header-modal" tabindex="-1" role="dialog">
    
    <div class="modal-dialog modal-sm" role="document">
        <br>
        <br>
        <br>
      <div class="modal-content w3-white" style="background: #fafafa;max-width: 200px;margin: auto">
        
        <div class="modal-body w3-bar-block">

        </div> 
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
