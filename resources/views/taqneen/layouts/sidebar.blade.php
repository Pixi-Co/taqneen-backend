

<div class="sidebar-wrapper  " >
	<div>
		<div class="  logo-wrapper" style="height:130px ">
			<a href="{{url('/')}}"><img class="img-fluid for-light " src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{url('/')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>          
                     
					<li class="sidebar-list"><a class="sidebar-link   mt-5  sidebar-title link-nav {{ Route::currentRouteName()=='index' ? 'active' : '' }} " href="{{url('/')}}"><i data-feather="home"> </i><span >{{ trans('dashboard') }}</span></a></li>
                 

                    {{------------------------ subscription button -----------------------------}}
                    @can(find_or_create_p('subscription.view'))
					<li   class=" sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="list"></i><span  >{{ trans('subscriptions') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/subscriptions' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu">
                            @can(find_or_create_p('subscription.view'))
                            <li><a  href="{{url('/subscriptions')}}" >@trans('view')</a></li>
                            @endcan
                            @can(find_or_create_p('subscription.create'))
                            <li><a  href="{{url('/subscriptions/create')}}" >@trans('add') </a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    {{------------------------ services button -----------------------------}}
                    @can(find_or_create_p('service.view'))
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="server"></i><span  >{{ trans('services') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/services' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            @can(find_or_create_p('service.view'))
                            <li><a  href="{{url('/services')}}" >@trans('view')</a></li>
                            @endcan
                            @can(find_or_create_p('service.create'))
                            <li><a  href="{{url('/services/create')}}" >@trans('add') </a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
					
					{{------------------------ customers button -----------------------------}}
                    @can(find_or_create_p('customer.view'))
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="users"></i><span  >{{ trans('customers') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/customers' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            @can(find_or_create_p('customer.view'))
                            <li><a  href="{{url('/customers')}}" >@trans('view')</a></li>
                            @endcan
                            @can(find_or_create_p('customer.create'))
                            <li><a  href="{{url('/customers/create')}}" >@trans('add') </a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    {{------------------------ customers formes -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="users"></i><span  >{{ trans('customers forms') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == 'customer-form/createCustomerMasarat' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a  href="{{url('customer-form/subscribe_masarat_model/index')}}" >@trans('new customer masarat') </a></li>
                            <li><a  href="{{url('customer-form/subscribe_muqeem_model/index')}}" >@trans('new customer muqeem') </a></li>
                            <li><a  href="{{url('customer-form/subscribe_naba_model/index')}}" >@trans('new customer naba') </a></li>
                            <li><a  href="{{url('customer-form/subscribe_shomoos_model/index')}}" >@trans('new customer shomoos') </a></li>
                            <li><a  href="{{url('customer-form/subscribe_tamm_model/index')}}" >@trans('new customer tamm') </a></li>
                            <li><a  href="{{url('customer-form/edit_subscribe_muqeem_model')}}" >@trans('form of edit and remove tamm user') </a></li>
                        </ul>
                    </li>

                    {{------------------------ users button -----------------------------}}
                    @can(find_or_create_p('user.view'))
                    <li class="sidebar-list">
                        <a class="sidebar-link    sidebar-title 23" href="#">
                            <i data-feather="users"></i><span >{{ trans('users') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/userstaq' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            @can(find_or_create_p('user.view'))
                            <li><a  href="{{url('/userstaq')}}" >@trans('view')</a></li>
                            @endcan
                            @can(find_or_create_p('user.create'))
                            <li><a  href="{{url('/userstaq/create')}}" >@trans('add') </a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan


					{{------------------------ opportunities button -----------------------------}}
                    @can(find_or_create_p('opportunity.view'))
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="star"></i><span  >{{ trans('opportunities') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/opportunities' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            @can(find_or_create_p('opportunity.view'))
                            <li><a  href="{{url('/opportunities')}}" >@trans('view')</a></li>
                            @endcan
                            @can(find_or_create_p('opportunity.create'))
                            <li><a  href="{{url('/opportunities/create')}}" >@trans('add') </a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    
					
                    {{------------------------ support button -----------------------------}}
                    @can(find_or_create_p('support.view'))
					<li   class=" sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="message-circle"></i><span  >{{ trans('support') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/support' ? 'down' : 'right' }}"></i></div>
                        </a> 
                        <ul class="sidebar-submenu"  >
                            @can(find_or_create_p('support.supportboard'))
                            <li><a  href="{{url('/support')}}" >@trans('supportboard')</a></li> 
                            @endcan
                            @can(find_or_create_p('support.ticket'))
                            <li><a  href="{{url('/ticket')}}" >@trans('ticket')</a></li> 
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can(find_or_create_p('calendar.view'))
                    {{------------------------ calendar button -----------------------------}}
					<li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav " href="{{url('/taqneen-calendar')}}"><i data-feather="calendar"> </i><span >{{ trans('calendar') }}</span></a></li>
                    @endcan

                    @can(find_or_create_p('notification_template.view'))
                    {{------------------------ notification-template button -----------------------------}}
					<li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav " href="{{url('/notification-template')}}"><i data-feather="calendar"> </i><span >{{ trans('notification template') }}</span></a></li>
                    @endcan

                    {{------------------------ reporting button -----------------------------}}
                    @can(find_or_create_p('report.view'))
                    <li class="sidebar-list">
						<a class="sidebar-link   sidebar-title " href="#">
							<i data-feather="file-text"></i><span >{{ trans('reports') }}</span>
							<div class="according-menu"><i class="fa fa-angle-"></i></div>
						</a>
						<ul class="sidebar-submenu" >
		                    {{-- <li><a  href="{{url('mainreport')}}" class="{{ Route::currentRouteName()=='mainreport' ? 'active' : '' }}">تقرير</a></li> --}}
                            @can(find_or_create_p('report.service'))
                            <li><a  href="{{url('/reports/services')}}" class="{{ Route::currentRouteName()=='averagereport' ? 'active' : '' }}">@trans('services report')</a></li>
                            @endcan
                            @can(find_or_create_p('report.sales_commission'))
                            <li><a  href="{{url('/reports/sales-commissions')}}" class="{{ Route::currentRouteName()=='financialreport' ? 'active' : '' }}">@trans('sale Commision Report') </a></li>
                            @endcan
                            @can(find_or_create_p('report.subscription'))
                            <li><a  href="{{url('/reports/subscriptions')}}" class="{{ Route::currentRouteName()=='billreport' ? 'active' : '' }}">@trans('subscriptions')</a></li>
                            @endcan
                        </ul>
					</li>
                    @endcan

                    {{------------------------ settings button -----------------------------}}
                    @can(find_or_create_p('setting.view'))
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="settings"></i><span  >{{ trans('settings') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-"></i></div>
                        </a>
                        <ul class="sidebar-submenu"  >
                            @can(find_or_create_p('setting.package'))
                            <li><a  href="{{url('packages')}}" >@trans('packages')</a></li> 
							@endcan
                            @can(find_or_create_p('setting.expense'))
                            <li><a  href="{{url('categories')}}" >@trans('lang.categories')</a></li>
							@endcan
                            @can(find_or_create_p('setting.tax'))
                            <li><a  href="{{url('taxs')}}" >@trans('taxs section')</a></li> 
							@endcan
                            @can(find_or_create_p('setting.role'))
                            <li><a  href="{{url('role')}}" >@trans('roles')</a></li> 
                            @endcan
                        </ul>
                    </li>
                    @endcan


 

			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
