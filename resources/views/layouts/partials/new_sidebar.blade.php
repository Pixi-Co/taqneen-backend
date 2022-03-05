@php
$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
@endphp
@php($moduleUtil = new \App\Utils\ModuleUtil())

<div class="mobile-sidebar new-shadow ">

</div>

<div class="mobile-header- new-shadow ">



</div>


<aside class="main-sidebar material-shadow w3-white">

    <section class="sidebar w3-white">

        <div class="logo w3-block" style="display: block!important">
            <img src="{{ asset('/images/logo.png') }}" alt="">

            <div class="w3-padding w3-tiny" id="nav-icon3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="text-left w3-text-white w3-padding btn" id="mobileToggle">
                <i class="fas fa fa-bars w3-large  "></i>
            </div>
        </div>

        <!--Sidebar Menu-->

        <ul class="sidebar-menu tree w3-animate-left" data-widget="tree"> 
            <li class="">
                <a class="sidemen-item-a" href="{{ action('HomeController@index') }}">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/1.svg') }}" alt="">
                    <span>{{ __('home.home') }}</span>
                </a>
            </li>
           

            @if (auth()->user()->can('customer.view'))
                <li class="treeview" id="tour_step4">
                    <a class="sidemen-item-a" href="#">
                        <img class="fa sidebar-img" src="{{ asset('/images/menu/3.svg') }}" alt="">
                        <span>{{ __('report.customer') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu"> 

                        @if (auth()->user()->can('customer.view'))
                            <li>
                                <a href="{{ action('ContactController@index', ['type' => 'customer']) }}"><i
                                        class="fa fas fa-star"></i>
                                    <span>{{ __('report.customer') }}</span>
                                </a>
                            </li> 
                        @endif
                    </ul>
                </li>
            @endif


            @if (auth()->user()->can('user.view'))
                <li class="treeview" id="tour_step4">
                    <a class="sidemen-item-a" href="#">
                        <img class="fa sidebar-img" src="{{ asset('/images/menu/3.svg') }}" alt="">
                        <span>{{ __('user.users') }}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu"> 

                        @if (auth()->user()->can('user.view'))
                            <li>
                                <a href="{{ url('/users') }}"><i
                                        class="fa fas fa-star"></i>
                                    <span>{{ __('user.users') }}</span>
                                </a>
                            </li> 
                        @endif

                        @if (auth()->user()->can('user.view'))
                            <li>
                                <a href="{{ url('/users/create') }}"><i
                                        class="fa fas fa-star"></i>
                                    <span>{{ __('add user') }}</span>
                                </a>
                            </li> 
                        @endif
                    </ul>
                </li>
            @endif

            @can_bt(['subscription.module'])
            @can('subscription.module')
            <li class="treeview" id="tour_step4">
                <a class="sidemen-item-a" href="#">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/3.svg') }}" alt="">
                    <span>{{ __('subscriptions') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can_bt(['subscription.class_type'])
                    @can("subscription.class_types.view")
                    <li>
                        <a href="{{ url('/sub?tab=class-type') }}"><i class="fa fas fa-star"></i>
                            <span>{{ __('class types') }}</span>
                        </a>
                    </li>
                    @endcan
                    @endcan_bt   
                    @can_bt(['subscription.calendar']) 
                    @can("subscription.calendar")
                    <li>
                        <a href="{{ url('/sub?tab=calendar') }}"><i class="fa fas fa-star"></i>
                            <span>{{ __('calendar') }}</span>
                        </a>
                    </li>
                    @endcan
                    @endcan_bt
                    @can_bt(['subscription.subscription'])
                    @can("subscription.view")
                    <li>
                        <a href="{{ url('/sub?tab=subscription') }}"><i class="fa fas fa-star"></i>
                            <span>{{ __('subscriptions') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/sub/pos/create') }}"><i class="fa fas fa-star"></i>
                            <span>{{ __('create subscription') }}</span>
                        </a>
                    </li>
                    @endcan
                    @endcan_bt
                    @can_bt(['subscription.membership'])

                    @can("subscription.memberships.view")
                    <li>
                        <a href="{{ action('MemberShipController@index') }}"><i class="fa fas fa-list"></i>
                            <span>
                                {{ __('memberships') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can("subscription.memberships.create")
                    <li> 
                        <a href="{{ action('MemberShipController@index') }}?action=create"><i class="fa fas fa-list"></i>
                            <span>
                                {{ __('add membership') }}</span>
                        </a>
                    </li>
                    @endcan

                    @endcan_bt 
                     
                     
  
                </ul>
            </li>
            @endcan
            @endcan_bt
     

  

 

 

            <!--
            <li>
                <a class="sidemen-item-a" href="{{ url('/') }}/notification-templates">
                    <img class="fa sidebar-img" src="{{ asset('/images/menu/16.svg') }}" alt="">
                    <span>Notification Templates</span>
                </a>
            </li>
        -->


            @if (auth()->user()->can('business_settings.access') ||
    auth()->user()->can('barcode_settings.access') ||
    auth()->user()->can('invoice_settings.access') ||
    auth()->user()->can('tax_rate.view') ||
    auth()->user()->can('tax_rate.create') ||
    auth()->user()->can('access_package_subscriptions'))
                <li id="">
                    <a href="{{ url('/') }}/settings" class="sidemen-item-a">
                        <img class="fa sidebar-img" src="{{ asset('/images/menu/18.svg') }}" alt="">
                        <span>{{ __('business.settings') }}</span>
                    </a>
                    <ul class="treeview-menu- hidden">
                        <li>
                            <a href="{{ url('/') }}/settings" id="tour_step2"><i class="fa fas fa-cogs"></i>
                                <span>{{ __('business.settings') }}</span>
                            </a>
                        </li>

                        @can_bt(['kitchen'])
                        @if (in_array('kitchen', $enabled_modules))
                            <li>
                                <a href="{{ action('Restaurant\KitchenController@index') }}"><i
                                        class="fa fas fa-cogs"></i>
                                    <span>{{ __('restaurant.kitchen') }}</span>
                                </a>
                            </li>
                        @endif
                        @endcan_bt

                        @can_bt(['restaurant_order'])
                        @if (in_array('service_staff', $enabled_modules))
                            <li>
                                <a href="{{ action('Restaurant\OrderController@index') }}"><i
                                        class="fa fas fa-cogs"></i>
                                    <span>{{ __('restaurant.orders') }}</span>
                                </a>
                            </li>
                        @endif
                        @endcan_bt

                        <!--
                        @if (auth()->user()->can('business_settings.access'))
                            <li>
                                <a href="{{ url('/') }}/business/settings" id="tour_step2"><i
                                            class="fa fas fa-cogs"></i>
                                    <span>Business Settings</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('/') }}/business/settings" id="tour_step2"><i
                                            class="fa fas fa-cogs"></i>
                                    <span>Business Settings</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('/') }}/business-location"><i class="fa fas fa-map-marker"></i>
                                    <span>Business Locations</span>
                                </a>
                            </li>
                        @endif


                        @if (auth()->user()->can('invoice_settings.access'))
                            <li>
                                <a href="{{ url('/') }}/invoice-schemes"><i class="fa fas fa-file"></i> <span>Invoice
                                Settings</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('barcode_settings.access'))
                            <li>
                                <a href="{{ url('/') }}/barcodes"><i class="fa fas fa-barcode"></i> <span>Barcode
                                Settings</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('access_printers'))
                            <li>
                                <a href="{{ url('/') }}/printers"><i class="fa fas fa-share-alt"></i> <span>Receipt
                                Printers</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->can('tax_rate.view') ||
    auth()->user()->can('tax_rate.create'))
                            <li>
                                <a href="{{ url('/') }}/tax-rates"><i class="fa fas fa-bolt"></i> <span>Tax
                                Rates</span>
                                </a>
                            </li>
                        @endif

                        @if (in_array('types_of_service', $enabled_modules) &&
    auth()->user()->can('access_types_of_service'))
                            <li>
                                <a href="{{ url('/') }}/types-of-service"><i class="fa fas fa-user-circle"></i>
                                    <span>Types of service</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ url('/') }}/subscription"><i class="fa fas fa-sync"></i> <span>Package
                                Subscription</span>
                            </a>
                        </li>
                    -->

                    </ul>
                </li>
            @endif 

        </ul>


    </section>
</aside>
