

<div class="sidebar-wrapper bg-white" >
	<div>
		<div class="bg-white  logo-wrapper" style="height:130px ">
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

					<li class="sidebar-list"><a class="sidebar-link   mt-5  sidebar-title link-nav {{ Route::currentRouteName()=='index' ? 'active' : '' }} " href="{{url('/')}}"><i data-feather="home"> </i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('dashboard') }}</span></a></li>

					 
                    {{------------------------ subscription button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="list"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('subscriptions') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/subscriptions' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/subscriptions')}}" >@trans('view')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/subscriptions/create')}}" >@trans('add') </a></li>
                        </ul>
                    </li>

                    {{------------------------ services button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="server"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('services') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/services' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/services')}}" >@trans('view')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/services/create')}}" >@trans('add') </a></li>
                        </ul>
                    </li>
					
					{{------------------------ customers button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="users"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('customers') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/customers' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/customers')}}" >@trans('view')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/customers/create')}}" >@trans('add') </a></li>
                        </ul>
                    </li>

                    {{------------------------ customers formes -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="users"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('customers forms') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == 'customer-form/createCustomerMasarat' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customer-form/subscribe_masarat_model')}}" >@trans('new customer masarat') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customer-form/subscribe_muqeem_model')}}" >@trans('new customer muqeem') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customer-form/subscribe_naba_model')}}" >@trans('new customer naba') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customer-form/subscribe_shomoos_model')}}" >@trans('new customer shomoos') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customer-form/subscribe_tamm_model')}}" >@trans('new customer tamm') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customer-form/edit_subscribe_muqeem_model')}}" >@trans('form of edit and remove tamm user') </a></li>
                        </ul>
                    </li>

                    {{------------------------ users button -----------------------------}}
                    <li class="sidebar-list">
                        <a class="sidebar-link    sidebar-title 23" href="#">
                            <i data-feather="users"></i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('users') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/userstaq' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/userstaq')}}" >@trans('view')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/userstaq/create')}}" >@trans('add') </a></li>
                        </ul>
                    </li>


					{{------------------------ opportunities button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="star"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('opportunities') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/opportunities' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/opportunities')}}" >@trans('view')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/opportunities/create')}}" >@trans('add') </a></li>
                        </ul>
                    </li>
                    
					
                    {{------------------------ support button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="message-circle"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('support') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/support' ? 'down' : 'right' }}"></i></div>
                        </a> 
                        <ul class="sidebar-submenu"  >
                            
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/support')}}" >@trans('supportboard')</a></li> 
                        </ul>
                    </li>

                    {{------------------------ calendar button -----------------------------}}
					<li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav " href="{{url('/taqneen-calendar')}}"><i data-feather="calendar"> </i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('calendar') }}</span></a></li>
                    

                    {{------------------------ notification-template button -----------------------------}}
					<li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav " href="{{url('/notification-template')}}"><i data-feather="calendar"> </i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('notification template') }}</span></a></li>
                    

                    {{------------------------ reporting button -----------------------------}}
                    <li class="sidebar-list">
						<a class="sidebar-link   sidebar-title " href="#">
							<i data-feather="file-text"></i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('reports') }}</span>
							<div class="according-menu"><i class="fa fa-angle-"></i></div>
						</a>
						<ul class="sidebar-submenu" >
		                    {{-- <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('mainreport')}}" class="{{ Route::currentRouteName()=='mainreport' ? 'active' : '' }}">تقرير</a></li> --}}
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/reports/services')}}" class="{{ Route::currentRouteName()=='averagereport' ? 'active' : '' }}">@trans('services report')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/reports/sales-commissions')}}" class="{{ Route::currentRouteName()=='financialreport' ? 'active' : '' }}">@trans('sale Commision Report') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/reports/subscriptions')}}" class="{{ Route::currentRouteName()=='billreport' ? 'active' : '' }}">@trans('subscriptions')</a></li>
		                </ul>
					</li>

                    {{------------------------ settings button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link    sidebar-title " href="#">
                            <i data-feather="settings"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('settings') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-"></i></div>
                        </a>
                        <ul class="sidebar-submenu"  >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('packages')}}" >@trans('packages')</a></li> 
							<li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('categories')}}" >@trans('Categories')</a></li>
							 <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('taxs')}}" >@trans('Taxs')</a></li> 
							 <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('role')}}" >@trans('roles')</a></li> 
                        </ul>
                    </li>


 

			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
