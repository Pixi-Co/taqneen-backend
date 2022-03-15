

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

					<li class="sidebar-list"><a class="sidebar-link   mt-5  sidebar-title link-nav {{ Route::currentRouteName()=='index' ? 'active' : '' }} " href="{{url('/')}}"><i data-feather="home"> </i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.dashboard') }}</span></a></li>

					 
                    {{------------------------ subscription button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="message-circle"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('subscriptions') }}</span>
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
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == 'customerForm/createCustomerMasarat' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customerForm/createcustomermasarat')}}" >@trans('new customer masarat') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customerForm/createcustomermuqeem')}}" >@trans('new customer muqeem') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customerForm/createcustomernaba')}}" >@trans('new customer naba') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customerForm/createcustomershomoos')}}" >@trans('new customer shomoos') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('customerForm/createcustomertamm')}}" >@trans('new customer tamm') </a></li>
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

                    {{------------------------ reporting button -----------------------------}}
                    <li class="sidebar-list">
						<a class="sidebar-link   sidebar-title " href="#">
							<i data-feather="file-text"></i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.reporting') }}</span>
							<div class="according-menu"><i class="fa fa-angle-"></i></div>
						</a>
						<ul class="sidebar-submenu" >
		                    {{-- <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('mainreport')}}" class="{{ Route::currentRouteName()=='mainreport' ? 'active' : '' }}">تقرير</a></li> --}}
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/reports/services')}}" class="{{ Route::currentRouteName()=='averagereport' ? 'active' : '' }}">@trans('services report')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/reports/sales-commissions')}}" class="{{ Route::currentRouteName()=='financialreport' ? 'active' : '' }}">@trans('sale Commision Report') </a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/billreport')}}" class="{{ Route::currentRouteName()=='billreport' ? 'active' : '' }}">الفواتير</a></li>
		                </ul>
					</li>
                   

					
                    {{------------------------ support button -----------------------------}}
					<li   class=" sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i data-feather="message-circle"></i><span style="font-family:  'Tajawal', sans-serif;" >{{ trans('support') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/support' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" >
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('/supportboard')}}" >@trans('packages')</a></li> 
                        </ul>
                    </li>



                    {{------------------------ Email button -----------------------------}}
					<li class="sidebar-list">
						<a class="sidebar-link    sidebar-title {{request()->segments() == '/email' ? 'active' : '' }}" href="#">
							<i data-feather="mail"></i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.Email') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/email' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->segments() == '/email' ? 'block' : 'none;' }};">
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('email-application')}}" class="{{ Route::currentRouteName()=='email-application' ? 'active' : '' }}">@trans('lang.Emailinbox')</a></li>
		                    {{-- <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('email-compose')}}" class="{{ Route::currentRouteName()=='email-compose' ? 'active' : '' }}">@trans('lang.EmailCompose')</a></li> --}}
		                </ul>
					</li>

                     {{------------------------ marketing button -----------------------------}}
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->segments() == '/users' ? 'active' : '' }}" href="#">
							<i data-feather="mail"></i><span style="font-family:  'Tajawal', sans-serif;">التسويق</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/users' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->segments() == '/users' ? 'block' : 'none;' }};">
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('marketingsms')}}" class="{{ Route::currentRouteName()=='marketingsms' ? 'active' : '' }}">رسالة هاتف</a></li>
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('marketingwatsapp')}}" class="{{ Route::currentRouteName()=='marketingwatsapp' ? 'active' : '' }}">واتس اب</a></li>
                            
                        </ul>
					</li>


                    {{------------------------ chat button -----------------------------}}

					<li class="sidebar-list">
						<a class="sidebar-link    sidebar-title {{request()->segments() == '/chat' ? 'active' : '' }}" href="#">
							<i data-feather="message-circle"></i><span style="font-family:  'Tajawal', sans-serif;">الدعم الفنى</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/chat' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->segments() == '/chat' ? 'block' : 'none;' }};">
                            <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('chat-link')}}" class="{{ Route::currentRouteName()=='chat-link' ? 'active' : '' }}">@trans('lang.Chat')</a></li>
							{{------------------------ support button -----------------------------}}
                            <li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav {{ Route::currentRouteName()=='support-ticket' ? 'active' : '' }}" href="{{url('support-ticket')}}"><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.Support Ticket') }}</span></a></li>
                            <li><a href="{{url('supportdashboard')}}" class="{{ Route::currentRouteName()=='supportdashboard' ? 'active' : '' }}">@trans('lang.Dashboard')</a></li>
						</ul>
					</li>


                    {{------------------------ customers button -----------------------------}}
                    <li class="sidebar-list">
                        <a class="sidebar-link    sidebar-title {{request()->segments() == '/users' ? 'active' : '' }}" href="#">
                            <i data-feather="users"></i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.Customers') }}</span>
                            <div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/users' ? 'down' : 'right' }}"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="display: {{request()->segments() == '/users' ? 'block' : 'none;' }};">
                            <li><a style="font-family:  'Tajawal', sans-serif; "href="{{url('viewcustomers')}}" class="{{ Route::currentRouteName()=='viewcustomers' ? 'active' : '' }}">@trans('lang.viewcustomers')</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif; "href="{{url('addcustomers')}}" class="{{ Route::currentRouteName()=='addcustomers' ? 'active' : '' }}">اضافة عميل</a></li>
                            <li><a style="font-family:  'Tajawal', sans-serif; "href="{{url('viewcustomers')}}" class="{{ Route::currentRouteName()=='viewcustomers' ? 'active' : '' }}">عملاء محتملين</a></li>
                        </ul>
                    </li>

                    {
                    {{------------------------ Opportunities button -----------------------------}}
                    {{-- <li class="sidebar-list">
						<a class="sidebar-link    sidebar-title {{request()->segments() == '/users' ? 'active' : '' }}" href="#">
							<i data-feather="star"></i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.Opportunities') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/users' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->segments() == '/users' ? 'block' : 'none;' }};">
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('viewOpportunities')}}" class="{{ Route::currentRouteName()=='viewOpportunities' ? 'active' : '' }}">@trans('lang.ViewOpportunities')</a></li>
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('addOpportunities')}}" class="{{ Route::currentRouteName()=='addOpportunities' ? 'active' : '' }}">@trans('lang.AddOpportunities') </a></li>
		                </ul>
					</li> --}}

                    {{------------------------ subscription button -----------------------------}}
                    <li class="sidebar-list">
						<a class="sidebar-link    sidebar-title {{request()->segments() == '/users' ? 'active' : '' }}" href="#">
							<i data-feather="list"></i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.subscription') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->segments() == '/users' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->segments() == '/users' ? 'block' : 'none;' }};">
		                    <li><a style="font-family:  'Tajawal', sans-serif;" href="{{url('viewsubscription')}}" class="{{ Route::currentRouteName()=='viewsubscription' ? 'active' : '' }}">@trans('lang.Viewsubscription')</a></li>
		                    <li><a style="font-family:  'Tajawal', sans-serif;"href="{{url('addsubscription')}}" class="{{ Route::currentRouteName()=='addsubscription' ? 'active' : '' }}">اضافة اشتراك</a></li>
		                </ul>
					</li>

                    
                    {{------------------------ permissions button -----------------------------}}
					<li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav {{ Route::currentRouteName()=='permissions' ? 'active' : '' }} " href="{{url('permissions')}}"><i data-feather="calendar"> </i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.permissions') }}</span></a></li>
					{{------------------------ settings button -----------------------------}}
					<li class="sidebar-list">
                        <a class="sidebar-link   sidebar-title link-nav {{ Route::currentRouteName()=='settings' ? 'active' : '' }} " href="{{url('settings')}}">
                        <i data-feather="settings"></i>
                        <span style="font-family:  'Tajawal', sans-serif;">الاعدادات</span>
                        </a>
                    </li>
                    {{------------------------ calendar button -----------------------------}}
					<li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav {{ Route::currentRouteName()=='calendar-basic' ? 'active' : '' }} " href="{{url('calendar-basic')}}"><i data-feather="calendar"> </i><span style="font-family:  'Tajawal', sans-serif;">{{ trans('lang.Calendar') }}</span></a></li>
                    {{------------------------ network button -----------------------------}}
					<li class="sidebar-list"><a class="sidebar-link   sidebar-title link-nav {{ Route::currentRouteName()=='network' ? 'active' : '' }} " href="{{url('network')}}"><i data-feather="calendar"> </i><span style="font-family:  'Tajawal', sans-serif;">ادارة علاقات عامة</span></a></li>
                    

			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>
