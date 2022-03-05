    <link rel="stylesheet" href="{{asset('assets/css/css.css')}}">

<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{url('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
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
					<li class="sidebar-main-title">
						<div>
							<h6 class="lan-1">{{ trans('lang.General') }}  </h6>
                     		<p class="lan-2">{{ trans('lang.Dashboards,widgets & layout.') }}</p>
						</div>
					</li>
					<li class="sidebar-list">
						<label class="badge badge-success">2</label><a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/dashboard' ? 'active' : '' }}" href="#"><i data-feather="home"></i><span class="lan-3">{{ trans('lang.Dashboards') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/dashboard' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/dashboard' ? 'block;' : 'none;' }}">
							<li><a class="lan-4 {{ url::currenturlName()=='index' ? 'active' : '' }}" href="{{url('index')}}">{{ trans('lang.Default') }}</a></li>
                     		<li><a class="lan-5 {{ url::currenturlName()=='dashboard-02' ? 'active' : '' }}" href="{{url('dashboard-02')}}">{{ trans('lang.Ecommerce') }}</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
							<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/widgets' ? 'active' : '' }}" href="#"><i data-feather="airplay"></i><span class="lan-6">{{ trans('lang.Widgets') }}</span>
								<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/widgets' ? 'down' : 'right' }}"></i></div>
							</a>
							<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/widgets' ? 'block;' : 'none;' }}">
			                    <li><a href="{{url('general-widget')}}" class="{{ url::currenturlName()=='general-widget' ? 'active' : '' }}">{{ trans('lang.General') }}</a></li>
			                    <li><a href="{{url('chart-widget')}}" class="{{ url::currenturlName()=='chart-widget' ? 'active' : '' }}">{{ trans('lang.Chart') }}</a></li>
		                  	</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title" href="#"><i data-feather="layout"></i><span class="lan-7">Page layout</span></a>
						<ul class="sidebar-submenu" >
							<li class=" customizer-color"><a href="{{url('index')}}">Boxed</a></li>
							<li class=" customizer-color"><a href="{{url('index')}}">RTL</a></li>
							<li class=" customizer-color dark"><a href="{{url('index')}}">Dark Layout</a></li>
							<li class=" customizer-color"><a href="{{url('index')}}">Hide Nav Scroll</a></li>
							<li class=" customizer-color"><a href="{{url('index')}}">Footer Light</a></li>
							<li class=" customizer-color"><a href="{{url('index')}}">Footer Dark</a></li>
							<li class=" customizer-color"><a href="{{url('index')}}">Footer Fixed</a></li>
						</ul>
					</li>
					<li class="sidebar-main-title">
						<div>
							<h6 class="lan-8">{{ trans('lang.Applications') }}</h6>
                     		<p class="lan-9">{{ trans('lang.Ready to use Apps') }}</p>
						</div>
					</li>
					<li class="sidebar-list">
						<label class="badge badge-danger">{{ trans('lang.New') }}</label>
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/project' ? 'active' : '' }}" href="#">
							<i data-feather="box"></i><span>{{ trans('lang.Project') }} </span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/project' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/project' ? 'block;' : 'none;' }}">
		                    <li><a href="{{url('projects')}}" class="{{ url::currenturlName()=='projects' ? 'active' : '' }}">{{ trans('lang.Project List') }}</a></li>
		                    <li><a href="{{url('projectcreate')}}" class="{{ url::currenturlName()=='projectcreate' ? 'active' : '' }}">{{ trans('lang.Create new') }}</a></li>
		                </ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='file-manager' ? 'active' : '' }}" href="{{url('file-manager')}}">
							<i data-feather="git-pull-request"> </i><span>{{ trans('lang.File manager') }}</span>
						</a>
					</li>
					<li class="sidebar-list">
						<label class="badge badge-info">{{ trans('lang.Latest') }}</label>
						<a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='kanban' ? 'active' : '' }}" href="{{url('kanban')}}">
							<i data-feather="monitor"> </i><span>{{ trans('lang.Kanban Board') }}</span>
						</a>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/ecommerce' ? 'active' : '' }}" href="#"><i data-feather="shopping-bag"></i><span>{{ trans('lang.Ecommerce') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/ecommerce' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/ecommerce' ? 'block' : 'none;' }};">
							<li><a href="{{url('product')}}" class="{{ url::currenturlName()=='product' ? 'active' : '' }}">Product</a></li>
	                        <li><a href="{{url('product-page')}}" class="{{ url::currenturlName()=='product-page' ? 'active' : '' }}">Product page</a></li>
	                        <li><a href="{{url('list-products')}}" class="{{ url::currenturlName()=='list-products' ? 'active' : '' }}">Product list</a></li>
	                        <li><a href="{{url('payment-details')}}" class="{{ url::currenturlName()=='payment-details' ? 'active' : '' }}">Payment Details</a></li>
	                        <li><a href="{{url('order-history')}}" class="{{ url::currenturlName()=='order-history' ? 'active' : '' }}">Order History</a></li>
	                        <li><a href="{{url('invoice-template')}}" class="{{ url::currenturlName()=='invoice-template' ? 'active' : '' }}">Invoice</a></li>
	                        <li><a href="{{url('cart')}}" class="{{ url::currenturlName()=='cart' ? 'active' : '' }}">Cart</a></li>
	                        <li><a href="{{url('list-wish')}}" class="{{ url::currenturlName()=='list-wish' ? 'active' : '' }}">Wishlist</a></li>
	                        <li><a href="{{url('checkout')}}" class="{{ url::currenturlName()=='checkout' ? 'active' : '' }}">Checkout</a></li>
	                        <li><a href="{{url('pricing')}}" class="{{ url::currenturlName()=='pricing' ? 'active' : '' }}">Pricing</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/email' ? 'active' : '' }}" href="#">
							<i data-feather="mail"></i><span>{{ trans('lang.Email') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/email' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/email' ? 'block' : 'none;' }};">
		                    <li><a href="{{url('email-application')}}" class="{{ url::currenturlName()=='email-application' ? 'active' : '' }}">Email App</a></li>
		                    <li><a href="{{url('email-compose')}}" class="{{ url::currenturlName()=='email-compose' ? 'active' : '' }}">Email Compose</a></li>
		                </ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/chat' ? 'active' : '' }}" href="#">
							<i data-feather="message-circle"></i><span>{{ trans('lang.Chat') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/chat' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/chat' ? 'block' : 'none;' }};">
							<li><a href="{{url('chat')}}" class="{{ url::currenturlName()=='chat' ? 'active' : '' }}">Chat App</a></li>
                     		<li><a href="{{url('chat-video')}}" class="{{ url::currenturlName()=='chat-video' ? 'active' : '' }}">Video chat</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/users' ? 'active' : '' }}" href="#">
							<i data-feather="users"></i><span>{{ trans('lang.Users') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/users' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/users' ? 'block' : 'none;' }};">
		                    <li><a href="{{url('user-profile')}}" class="{{ url::currenturlName()=='user-profile' ? 'active' : '' }}">Users Profile</a></li>
		                    <li><a href="{{url('edit-profile')}}" class="{{ url::currenturlName()=='edit-profile' ? 'active' : '' }}">Users Edit</a></li>
		                    <li><a href="{{url('user-cards')}}" class="{{ url::currenturlName()=='user-cards' ? 'active' : '' }}">Users Cards</a></li>
		                </ul>
					</li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='bookmark' ? 'active' : '' }}" href="{{url('bookmark')}}"><i data-feather="heart"> </i><span>{{ trans('lang.Bookmarks') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='contacts' ? 'active' : '' }}" href="{{url('contacts')}}"><i data-feather="list"> </i><span>{{ trans('lang.Contacts') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='task' ? 'active' : '' }}" href="{{url('task')}}"><i data-feather="check-square"> </i><span>{{ trans('lang.Tasks') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='calendar-basic' ? 'active' : '' }} " href="{{url('calendar-basic')}}"><i data-feather="calendar"> </i><span>{{ trans('lang.Calendar') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='social-app' ? 'active' : '' }}" href="{{url('social-app')}}"><i data-feather="zap"> </i><span>{{ trans('lang.Social App') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='to-do' ? 'active' : '' }}" href="{{url('to-do')}}"><i data-feather="clock"> </i><span>{{ trans('lang.To-Do') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName() == 'search' ? 'active' : '' }}" href="{{ url('search') }}"><i data-feather="search"> </i><span>{{ trans('lang.Search Result') }}</span></a></li>
					<li class="sidebar-main-title">
						<div>
							<h6>{{ trans('lang.Forms & Table') }}</h6>
                 			<p>{{ trans('lang.Ready to use froms & tables') }}</p>
						</div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/forms' ? 'active' : '' }}" href="#">
							<i data-feather="file-text"></i><span>{{ trans('lang.Forms') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/forms' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/forms' ? 'block;' : 'none;' }}">
							<li>
								<a class="submenu-title {{ in_array(url::currenturlName(), ['form-validation', 'base-input', 'radio-checkbox-control', 'input-group', 'megaoptions']) ? 'active' : '' }}" href="#">Form Controls
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['form-validation', 'base-input', 'radio-checkbox-control', 'input-group', 'megaoptions']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['form-validation', 'base-input', 'radio-checkbox-control', 'input-group', 'megaoptions']) ? 'block' : 'none;' }};">
									<li><a href="{{url('form-validation')}}" class="{{ url::currenturlName()=='form-validation' ? 'active' : '' }}">Form Validation</a></li>
		                            <li><a href="{{url('base-input')}}" class="{{ url::currenturlName()=='base-input' ? 'active' : '' }}">Base Inputs</a></li>
		                            <li><a href="{{url('radio-checkbox-control')}}" class="{{ url::currenturlName()=='radio-checkbox-control' ? 'active' : '' }}">Checkbox & Radio</a></li>
		                            <li><a href="{{url('input-group')}}" class="{{ url::currenturlName()=='input-group' ? 'active' : '' }}">Input Groups</a></li>
		                            <li><a href="{{url('megaoptions')}}" class="{{ url::currenturlName()=='megaoptions' ? 'active' : '' }}">Mega Options</a></li>
								</ul>
							</li>
							<li>
								<a class="submenu-title {{ in_array(url::currenturlName(), ['datepicker', 'time-picker', 'datetimepicker','daterangepicker' ,'touchspin', 'select2', 'switch', 'typeahead', 'clipboard']) ? 'active' : '' }}" href="#">Form Widgets
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['datepicker', 'time-picker', 'datetimepicker','daterangepicker' ,'touchspin', 'select2', 'switch', 'typeahead', 'clipboard']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['datepicker', 'time-picker', 'datetimepicker','daterangepicker' ,'touchspin', 'select2', 'switch', 'typeahead', 'clipboard']) ? 'block' : 'none;' }};">
										<li><a href="{{url('datepicker')}}" class="{{ url::currenturlName()=='datepicker' ? 'active' : '' }}">Datepicker</a></li>
		                              	<li><a href="{{url('time-picker')}}" class="{{ url::currenturlName()=='time-picker' ? 'active' : '' }}">Timepicker</a></li>
		                              	<li><a href="{{url('datetimepicker')}}" class="{{ url::currenturlName()=='datetimepicker' ? 'active' : '' }}">Datetimepicker</a></li>
		                              	<li><a href="{{url('daterangepicker')}}" class="{{ url::currenturlName()=='daterangepicker' ? 'active' : '' }}">Daterangepicker</a></li>
		                              	<li><a href="{{url('touchspin')}}" class="{{ url::currenturlName()=='touchspin' ? 'active' : '' }}">Touchspin</a></li>
		                              	<li><a href="{{url('select2')}}" class="{{ url::currenturlName()=='select2' ? 'active' : '' }}">Select2</a></li>
		                              	<li><a href="{{url('switch')}}" class="{{ url::currenturlName()=='switch' ? 'active' : '' }}">Switch</a></li>
		                              	<li><a href="{{url('typeahead')}}" class="{{ url::currenturlName()=='typeahead' ? 'active' : '' }}">Typeahead</a></li>
		                              	<li><a href="{{url('clipboard')}}" class="{{ url::currenturlName()=='clipboard' ? 'active' : '' }}">Clipboard</a></li>
								</ul>
							</li>
							<li>
								<a class="submenu-title {{ in_array(url::currenturlName(), ['default-form', 'form-wizard', 'form-wizard-two', 'form-wizard-three']) ? 'active' : '' }}" href="#">Form Layout
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['default-form', 'form-wizard', 'form-wizard-two', 'form-wizard-three']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['default-form', 'form-wizard', 'form-wizard-two', 'form-wizard-three']) ? 'block' : 'none;' }};">
	                              	<li><a href="{{url('default-form')}}" class="{{ url::currenturlName()=='default-form' ? 'active' : '' }}">Default Forms</a></li>
	                              	<li><a href="{{url('form-wizard')}}" class="{{ url::currenturlName()=='form-wizard' ? 'active' : '' }}">Form Wizard 1</a></li>
	                              	<li><a href="{{url('form-wizard-two')}}" class="{{ url::currenturlName()=='form-wizard-two' ? 'active' : '' }}">Form Wizard 2</a></li>
	                              	<li><a href="{{url('form-wizard-three')}}" class="{{ url::currenturlName()=='form-wizard-three' ? 'active' : '' }}">Form Wizard 3</a></li>
	                        	</ul>
							</li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/tables' ? 'active' : '' }}" href="#"><i data-feather="server"></i><span>{{ trans('lang.Tables') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/tables' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/tables' ? 'block;' : 'none;' }}">
							<li>
								<a class="submenu-title  {{ in_array(url::currenturlName(), ['bootstrap-basic-table', 'bootstrap-sizing-table', 'bootstrap-sizing-table', 'bootstrap-border-table', 'bootstrap-styling-table', 'table-components']) ? 'active' : '' }}"  href="#">Bootstrap Tables
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['bootstrap-basic-table', 'bootstrap-sizing-table', 'bootstrap-sizing-table', 'bootstrap-border-table', 'bootstrap-styling-table', 'table-components']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['bootstrap-basic-table', 'bootstrap-sizing-table', 'bootstrap-sizing-table', 'bootstrap-border-table', 'bootstrap-styling-table', 'table-components']) ? 'block' : 'none;' }};">
	                              	<li><a href="{{url('bootstrap-basic-table')}}" class="{{ url::currenturlName()=='bootstrap-basic-table' ? 'active' : '' }}">Basic Tables</a></li>
	                                <li><a href="{{url('bootstrap-sizing-table')}}" class="{{ url::currenturlName()=='bootstrap-sizing-table' ? 'active' : '' }}">Sizing Tables</a></li>
	                              	<li><a href="{{url('bootstrap-border-table')}}" class="{{ url::currenturlName()=='bootstrap-border-table' ? 'active' : '' }}">Border Tables</a></li>
	                              	<li><a href="{{url('bootstrap-styling-table')}}" class="{{ url::currenturlName()=='bootstrap-styling-table' ? 'active' : '' }}">Styling Tables</a></li>
	                              	<li><a href="{{url('table-components')}}" class="{{ url::currenturlName()=='table-components' ? 'active' : '' }}">Table components</a></li>
                       			</ul>
							</li>
							<li>
								<a class="submenu-title  {{ in_array(url::currenturlName(), ['datatable-basic-init', 'datatable-advance', 'datatable-styling', 'datatable-ajax', 'datatable-server-side', 'datatable-plugin', 'datatable-api']) ? 'active' : '' }}" href="#">Data Tables
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['datatable-basic-init', 'datatable-advance', 'datatable-styling', 'datatable-ajax', 'datatable-server-side', 'datatable-plugin', 'datatable-api', 'datatable-data-source']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['datatable-basic-init', 'datatable-advance', 'datatable-styling', 'datatable-ajax', 'datatable-server-side', 'datatable-plugin', 'datatable-api', 'datatable-data-source']) ? 'block' : 'none;' }};">
		                              	<li><a href="{{url('datatable-basic-init')}}" class="{{ url::currenturlName()=='datatable-basic-init' ? 'active' : '' }}">Basic Init</a></li>
		                              	<li><a href="{{url('datatable-advance')}}" class="{{ url::currenturlName()=='datatable-advance' ? 'active' : '' }}">Advance Init</a></li>
		                              	<li><a href="{{url('datatable-styling')}}" class="{{ url::currenturlName()=='datatable-styling' ? 'active' : '' }}">Styling</a></li>
		                              	<li><a href="{{url('datatable-ajax')}}" class="{{ url::currenturlName()=='datatable-ajax' ? 'active' : '' }}">AJAX</a></li>
		                              	<li><a href="{{url('datatable-server-side')}}" class="{{ url::currenturlName()=='datatable-server-side' ? 'active' : '' }}">Server Side</a></li>
		                              	<li><a href="{{url('datatable-plugin')}}" class="{{ url::currenturlName()=='datatable-plugin' ? 'active' : '' }}">Plug-in</a></li>
		                              	<li><a href="{{url('datatable-api')}}" class="{{ url::currenturlName()=='datatable-api' ? 'active' : '' }}">API</a></li>
		                              	<li><a href="{{url('datatable-data-source')}}" class="{{ url::currenturlName()=='datatable-data-source' ? 'active' : '' }}">Data Sources</a></li>
		                        </ul>
							</li>
							<li>
								<a class="submenu-title {{ in_array(url::currenturlName(), ['datatable-ext-autofill', 'datatable-ext-basic-button', 'datatable-ext-col-reorder', 'datatable-ext-fixed-header', 'datatable-ext-html-5-data-export', 'datatable-ext-responsive', 'datatable-ext-row-reorder', 'datatable-ext-scroller']) ? 'active' : '' }}" href="#">Ex. Data Tables
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['datatable-ext-autofill', 'datatable-ext-basic-button', 'datatable-ext-col-reorder', 'datatable-ext-fixed-header', 'datatable-ext-html-5-data-export', 'datatable-ext-key-table', 'datatable-ext-responsive', 'datatable-ext-row-reorder', 'datatable-ext-scroller']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['datatable-ext-autofill', 'datatable-ext-basic-button', 'datatable-ext-col-reorder', 'datatable-ext-fixed-header', 'datatable-ext-html-5-data-export', 'datatable-ext-key-table', 'datatable-ext-responsive', 'datatable-ext-row-reorder', 'datatable-ext-scroller']) ? 'block' : 'none;' }};">
									<li><a href="{{url('datatable-ext-autofill')}}" class="{{ url::currenturlName()=='datatable-ext-autofill' ? 'active' : '' }}">Auto Fill</a></li>
									<li><a href="{{url('datatable-ext-basic-button')}}" class="{{ url::currenturlName()=='datatable-ext-basic-button' ? 'active' : '' }}">Basic Button</a></li>
									<li><a href="{{url('datatable-ext-col-reorder')}}" class="{{ url::currenturlName()=='datatable-ext-col-reorder' ? 'active' : '' }}">Column Reorder</a></li>
									<li><a href="{{url('datatable-ext-fixed-header')}}" class="{{ url::currenturlName()=='datatable-ext-fixed-header' ? 'active' : '' }}">Fixed Header</a></li>
									<li><a href="{{url('datatable-ext-html-5-data-export')}}" class="{{ url::currenturlName()=='datatable-ext-html-5-data-export' ? 'active' : '' }}">HTML 5 Export</a></li>
									<li><a href="{{url('datatable-ext-key-table')}}" class="{{ url::currenturlName()=='datatable-ext-key-table' ? 'active' : '' }}">Key Table</a></li>
									<li><a href="{{url('datatable-ext-responsive')}}" class="{{ url::currenturlName()=='datatable-ext-responsive' ? 'active' : '' }}">Responsive</a></li>
									<li><a href="{{url('datatable-ext-row-reorder')}}" class="{{ url::currenturlName()=='datatable-ext-row-reorder' ? 'active' : '' }}">Row Reorder</a></li>
									<li><a href="{{url('datatable-ext-scroller')}}" class="{{ url::currenturlName()=='datatable-ext-scroller' ? 'active' : '' }}">Scroller</a></li>
								</ul>
							</li>
							<li><a href="{{url('jsgrid-table')}}" class="{{ url::currenturlName()=='jsgrid-table' ? 'active' : '' }}">Js Grid Table </a></li>
						</ul>
					</li>
					<li class="sidebar-main-title">
						<div>
							<h6>{{ trans('lang.Components') }}</h6>
                     		<p>{{ trans('lang.UI Components & Elements') }}</p>
						</div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/ui-kits' ? 'active' : '' }}" href="#"><i data-feather="box"></i><span>{{ trans('lang.Ui Kits') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/ui-kits' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/ui-kits' ? 'block;' : 'none;' }}">
							<li><a href="{{url('state-color')}}" class="{{ url::currenturlName()=='state-color' ? 'active' : '' }}">State color</a></li>
							<li><a href="{{url('typography')}}" class="{{ url::currenturlName()=='typography' ? 'active' : '' }}">Typography</a></li>
							<li><a href="{{url('avatars')}}" class="{{ url::currenturlName()=='avatars' ? 'active' : '' }}">Avatars</a></li>
							<li><a href="{{url('helper-classes')}}" class="{{ url::currenturlName()=='helper-classes' ? 'active' : '' }}">helper classes</a></li>
							<li><a href="{{url('grid')}}" class="{{ url::currenturlName()=='grid' ? 'active' : '' }}">Grid</a></li>
							<li><a href="{{url('tag-pills')}}" class="{{ url::currenturlName()=='tag-pills' ? 'active' : '' }}">Tag & pills</a></li>
							<li><a href="{{url('progress-bar')}}" class="{{ url::currenturlName()=='progress-bar' ? 'active' : '' }}">Progress</a></li>
							<li><a href="{{url('modal')}}" class="{{ url::currenturlName()=='modal' ? 'active' : '' }}">Modal</a></li>
							<li><a href="{{url('alert')}}" class="{{ url::currenturlName()=='alert' ? 'active' : '' }}">Alert</a></li>
							<li><a href="{{url('popover')}}" class="{{ url::currenturlName()=='popover' ? 'active' : '' }}">Popover</a></li>
							<li><a href="{{url('tooltip')}}" class="{{ url::currenturlName()=='tooltip' ? 'active' : '' }}">Tooltip</a></li>
							<li><a href="{{url('loader')}}" class="{{ url::currenturlName()=='loader' ? 'active' : '' }}">Spinners</a></li>
							<li><a href="{{url('dropdown')}}" class="{{ url::currenturlName()=='dropdown' ? 'active' : '' }}">Dropdown</a></li>
							<li><a href="{{url('accordion')}}" class="{{ url::currenturlName()=='accordion' ? 'active' : '' }}">Accordion</a></li>
							<li>
								<a class="submenu-title {{ in_array(url::currenturlName(), ['tab-bootstrap','tab-material']) ? 'active' : '' }}" href="#">Tabs
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['tab-bootstrap','tab-material']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['tab-bootstrap','tab-material']) ? 'block' : 'none;' }};">
									<li><a href="{{url('tab-bootstrap')}}" class="{{ url::currenturlName()=='tab-bootstrap' ? 'active' : '' }}">Bootstrap Tabs</a></li>
                           			<li><a href="{{url('tab-material')}}" class="{{ url::currenturlName()=='tab-material' ? 'active' : '' }}">Line Tabs</a></li>
								</ul>
							</li>
							<li><a href="{{url('box-shadow')}}" class="{{ url::currenturlName()=='box-shadow' ? 'active' : '' }}">Shadow</a></li>
                     		<li><a href="{{url('list')}}" class="{{ url::currenturlName()=='list' ? 'active' : '' }}">Lists</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/bonus-ui' ? 'active' : '' }}" href="#"><i data-feather="folder-plus"></i><span>{{ trans('lang.Bonus Ui') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/ui-kits' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/bonus-ui' ? 'block;' : 'none;' }}">
							<li><a href="{{url('scrollable')}}" class="{{ url::currenturlName()=='scrollable' ? 'active' : '' }}">Scrollable</a></li>
	                        <li><a href="{{url('tree')}}" class="{{ url::currenturlName()=='tree' ? 'active' : '' }}">Tree view</a></li>
	                        <li><a href="{{url('bootstrap-notify')}}" class="{{ url::currenturlName()=='bootstrap-notify' ? 'active' : '' }}">Bootstrap Notify</a></li>
	                        <li><a href="{{url('rating')}}" class="{{ url::currenturlName()=='rating' ? 'active' : '' }}">Rating</a></li>
	                        <li><a href="{{url('dropzone')}}" class="{{ url::currenturlName()=='dropzone' ? 'active' : '' }}">dropzone</a></li>
	                        <li><a href="{{url('tour')}}" class="{{ url::currenturlName()=='tour' ? 'active' : '' }}">Tour</a></li>
	                        <li><a href="{{url('sweet-alert2')}}" class="{{ url::currenturlName()=='sweet-alert2' ? 'active' : '' }}">SweetAlert2</a></li>
	                        <li><a href="{{url('modal-animated')}}" class="{{ url::currenturlName()=='modal-animated' ? 'active' : '' }}">Animated Modal</a></li>
	                        <li><a href="{{url('owl-carousel')}}" class="{{ url::currenturlName()=='owl-carousel' ? 'active' : '' }}">Owl Carousel</a></li>
	                        <li><a href="{{url('ribbons')}}" class="{{ url::currenturlName()=='ribbons' ? 'active' : '' }}">Ribbons</a></li>
	                        <li><a href="{{url('pagination')}}" class="{{ url::currenturlName()=='pagination' ? 'active' : '' }}">Pagination</a></li>
	                        <li><a href="{{url('breadcrumb')}}" class="{{ url::currenturlName()=='breadcrumb' ? 'active' : '' }}">Breadcrumb</a></li>
	                        <li><a href="{{url('range-slider')}}" class="{{ url::currenturlName()=='range-slider' ? 'active' : '' }}">Range Slider</a></li>
	                        <li><a href="{{url('image-cropper')}}" class="{{ url::currenturlName()=='image-cropper' ? 'active' : '' }}">Image cropper</a></li>
	                        <li><a href="{{url('sticky')}}" class="{{ url::currenturlName()=='sticky' ? 'active' : '' }}">Sticky</a></li>
	                        <li><a href="{{url('basic-card')}}" class="{{ url::currenturlName()=='basic-card' ? 'active' : '' }}">Basic Card</a></li>
	                        <li><a href="{{url('creative-card')}}" class="{{ url::currenturlName()=='creative-card' ? 'active' : '' }}">Creative Card</a></li>
	                        <li><a href="{{url('tabbed-card')}}" class="{{ url::currenturlName()=='tabbed-card' ? 'active' : '' }}">Tabbed Card</a></li>
	                        <li><a href="{{url('dragable-card')}}" class="{{ url::currenturlName()=='dragable-card' ? 'active' : '' }}">Draggable Card</a></li>
							<li>
								<a class="submenu-title {{ in_array(url::currenturlName(), ['timeline-v-1','timeline-v-2', 'timeline-small']) ? 'active' : '' }}" href="#">Timeline
									<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['timeline-v-1','timeline-v-2', 'timeline-small']) ? 'down' : 'right' }}"></i></div>
								</a>
								<ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(url::currenturlName(), ['timeline-v-1','timeline-v-2']) ? 'block' : 'none;' }};">
									<li><a href="{{url('timeline-v-1')}}" class="{{ url::currenturlName()=='timeline-v-1' ? 'active' : '' }}">Timeline 1</a></li>
                              		<li><a href="{{url('timeline-v-2')}}" class="{{ url::currenturlName()=='timeline-v-2' ? 'active' : '' }}">Timeline 2</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/builders' ? 'active' : '' }}" href="#"><i data-feather="edit-3"></i><span>{{ trans('lang.Builders') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/builders' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/builders' ? 'block;' : 'none;' }}">
							<li><a href="{{url('form-builder-1')}}" class="{{ url::currenturlName()=='form-builder-1' ? 'active' : '' }}"> Form Builder 1</a></li>
	                        <li><a href="{{url('form-builder-2')}}" class="{{ url::currenturlName()=='form-builder-2' ? 'active' : '' }}"> Form Builder 2</a></li>
	                        <li><a href="{{url('pagebuild')}}" class="{{ url::currenturlName()=='pagebuild' ? 'active' : '' }}">Page Builder</a></li>
	                        <li><a href="{{url('button-builder')}}" class="{{ url::currenturlName()=='button-builder' ? 'active' : '' }}">Button Builder</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/animation' ? 'active' : '' }}" href="#"><i data-feather="cloud-drizzle"></i><span>{{ trans('lang.Animation') }}</span></a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/animation' ? 'block;' : 'none;' }}">
							<li><a href="{{url('animate')}}" class="{{ url::currenturlName()=='animate' ? 'active' : '' }}">Animate</a></li>
	                        <li><a href="{{url('scroll-reval')}}" class="{{ url::currenturlName()=='scroll-reval' ? 'active' : '' }}">Scroll Reveal</a></li>
	                        <li><a href="{{url('aos')}}" class="{{ url::currenturlName()=='aos' ? 'active' : '' }}">AOS animation</a></li>
	                        <li><a href="{{url('tilt')}}" class="{{ url::currenturlName()=='tilt' ? 'active' : '' }}">Tilt Animation</a></li>
	                        <li><a href="{{url('wow')}}" class="{{ url::currenturlName()=='wow' ? 'active' : '' }}">Wow Animation</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/icons' ? 'active' : '' }}" href="#"><i data-feather="command"></i><span>{{ trans('lang.Icons') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/icons' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/icons' ? 'block;' : 'none;' }}">
							<li><a href="{{url('flag-icon')}}" class="{{ url::currenturlName()=='flag-icon' ? 'active' : '' }}">Flag icon</a></li>
							<li><a href="{{url('font-awesome')}}" class="{{ url::currenturlName()=='font-awesome' ? 'active' : '' }}">Fontawesome Icon</a></li>
							<li><a href="{{url('ico-icon')}}" class="{{ url::currenturlName()=='ico-icon' ? 'active' : '' }}">Ico Icon</a></li>
							<li><a href="{{url('themify-icon')}}" class="{{ url::currenturlName()=='themify-icon' ? 'active' : '' }}">Thimify Icon</a></li>
							<li><a href="{{url('feather-icon')}}" class="{{ url::currenturlName()=='feather-icon' ? 'active' : '' }}">Feather icon</a></li>
							<li><a href="{{url('whether-icon')}}" class="{{ url::currenturlName()=='whether-icon' ? 'active' : '' }}">Whether Icon</a></li>
							<li><a href="{{url('simple-line-icon')}}" class="{{ url::currenturlName()=='simple-line-icon' ? 'active' : '' }}">Simple line Icon</a></li>
							<li><a href="{{url('material-design-icon')}}" class="{{ url::currenturlName()=='material-design-icon' ? 'active' : '' }}">Material Design Icon</a></li>
							<li><a href="{{url('pe7-icon')}}" class="{{ url::currenturlName()=='pe7-icon' ? 'active' : '' }}">pe7 icon</a></li>
							<li><a href="{{url('typicons-icon')}}" class="{{ url::currenturlName()=='typicons-icon' ? 'active' : '' }}">Typicons icon</a></li>
							<li><a href="{{url('ionic-icon')}}" class="{{ url::currenturlName()=='ionic-icon' ? 'active' : '' }}">Ionic icon</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/buttons' ? 'active' : '' }}" href="#"><i data-feather="cloud"></i><span>{{ trans('lang.Buttons') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/buttons' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/buttons' ? 'block;' : 'none;' }}">
							<li><a href="{{url('buttons')}}" class="{{ url::currenturlName()=='buttons' ? 'active' : '' }}">Default Style</a></li>
	                        <li><a href="{{url('buttons-flat')}}" class="{{ url::currenturlName()=='buttons-flat' ? 'active' : '' }}">Flat Style</a></li>
	                        <li><a href="{{url('buttons-edge')}}" class="{{ url::currenturlName()=='buttons-edge' ? 'active' : '' }}">Edge Style</a></li>
	                        <li><a href="{{url('raised-button')}}" class="{{ url::currenturlName()=='raised-button' ? 'active' : '' }}">Raised Style</a></li>
	                        <li><a href="{{url('button-group')}}" class="{{ url::currenturlName()=='button-group' ? 'active' : '' }}">Button Group</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/charts' ? 'active' : '' }}" href="#"><i data-feather="bar-chart"></i><span>{{ trans('lang.Charts') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/charts' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{ request()->url()->getPrefix() == '/charts' ? 'block;' : 'none;' }}">
							<li><a href="{{url('echarts')}}" class="{{ url::currenturlName()=='echarts' ? 'active' : '' }}">Echarts</a></li>
							<li><a href="{{url('chart-apex')}}" class="{{ url::currenturlName()=='chart-apex' ? 'active' : '' }}">Apex Chart</a></li>
		                    <li><a href="{{url('chart-google')}}" class="{{ url::currenturlName()=='chart-google' ? 'active' : '' }}">Google Chart</a></li>
		                    <li><a href="{{url('chart-sparkline')}}" class="{{ url::currenturlName()=='chart-sparkline' ? 'active' : '' }}">Sparkline chart</a></li>
		                    <li><a href="{{url('chart-flot')}}" class="{{ url::currenturlName()=='chart-flot' ? 'active' : '' }}">Flot Chart</a></li>
		                    <li><a href="{{url('chart-knob')}}" class="{{ url::currenturlName()=='chart-knob' ? 'active' : '' }}">Knob Chart</a></li>
		                    <li><a href="{{url('chart-morris')}}" class="{{ url::currenturlName()=='chart-morris' ? 'active' : '' }}">Morris Chart</a></li>
		                    <li><a href="{{url('chartjs')}}" class="{{ url::currenturlName()=='chartjs' ? 'active' : '' }}">Chatjs Chart</a></li>
		                    <li><a href="{{url('chartist')}}" class="{{ url::currenturlName()=='chartist' ? 'active' : '' }}">Chartist Chart</a></li>
		                    <li><a href="{{url('chart-peity')}}" class="{{ url::currenturlName()=='chart-peity' ? 'active' : '' }}">Peity Chart </a></li>
						</ul>
					</li>
					<li class="sidebar-main-title">
						<div>
							<h6>{{ trans('lang.Pages') }}</h6>
                     		<p>{{ trans('lang.All neccesory pages added') }}</p>
						</div>
					</li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='landing-page' ? 'active' : '' }}" href="{{url('landing-page')}}"><i data-feather="cast"> </i><span>Landing page</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='sample-page' ? 'active' : '' }}" href="{{url('sample-page')}}"><i data-feather="file-text"> </i><span>{{ trans('lang.Sample page') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='internationalization' ? 'active' : '' }}" href="{{url('internationalization')}}"><i data-feather="globe"> </i><span>{{ trans('lang.Internationalization') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='layout-light' ? 'active' : '' }}" href="{{ url('layout-light') }}" target="_blank"><i data-feather="anchor"></i><span>{{ trans('lang.Starter kit') }}</span></a></li>

					<li class="mega-menu">
						<a class="sidebar-link sidebar-title" href="#"><i data-feather="layers"></i><span>{{ trans('lang.Others') }}</span>
						</a>
						<div class="mega-menu-container menu-content">
							<div class="container-fluid">
								<div class="row">
									<div class="col mega-box">
										<div class="link-section">
											<div class="submenu-title">
												<h5>Error Page</h5>
												<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['error-400', 'error-401', 'error-403', 'error-404', 'error-500', 'error-503']) ? 'down' : 'right' }}"></i></div>
											</div>
											<ul class="submenu-content opensubmegamenu" style="display: {{ in_array(url::currenturlName(), ['error-400', 'error-401', 'error-403', 'error-404', 'error-500', 'error-503']) ? 'block;' : 'none;' }}">
												<li><a href="{{url('error-400')}}" class="{{ url::currenturlName()=='error-400' ? 'active' : '' }}">Error 400</a></li>
		                                       <li><a href="{{url('error-401')}}" class="{{ url::currenturlName()=='error-401' ? 'active' : '' }}">Error 401</a></li>
		                                       <li><a href="{{url('error-403')}}" class="{{ url::currenturlName()=='error-403' ? 'active' : '' }}">Error 403</a></li>
		                                       <li><a href="{{url('error-404')}}" class="{{ url::currenturlName()=='error-404' ? 'active' : '' }}">Error 404</a></li>
		                                       <li><a href="{{url('error-500')}}" class="{{ url::currenturlName()=='error-500' ? 'active' : '' }}">Error 500</a></li>
		                                       <li><a href="{{url('error-503')}}" class="{{ url::currenturlName()=='error-503' ? 'active' : '' }}">Error 503</a></li>
											</ul>
										</div>
									</div>
									<div class="col mega-box">
										<div class="link-section">
											<div class="submenu-title">
												<h5> Authentication</h5>
												<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['login', 'login-one', 'login-two', 'login-bs-validation', 'login-bs-tt-validation', 'login-sa-validation', 'sign-up', 'sign-up-one', 'sign-up-two', 'sign-up-wizard', 'unlock', 'forget-password', 'reset-password', 'maintenance']) ? 'down' : 'right' }}"></i></div>
											</div>
											<ul class="submenu-content opensubmegamenu" style="display: {{ in_array(url::currenturlName(), ['login', 'login-one', 'login-two', 'login-bs-validation', 'login-bs-tt-validation', 'login-sa-validation', 'sign-up', 'sign-up-one', 'sign-up-two', 'sign-up-wizard', 'unlock', 'forget-password', 'reset-password', 'maintenance']) ? 'block;' : 'none;' }}">
												<li><a href="{{url('login')}}" target="_blank">Login Simple</a></li>
			                                    <li><a href="{{url('login-one')}}" target="_blank">Login with bg image</a></li>
			                                    <li><a href="{{url('login-two')}}" target="_blank">Login with image two </a></li>
			                                    <li><a href="{{url('login-bs-validation')}}" target="_blank">Login With validation</a></li>
			                                    <li><a href="{{url('login-bs-tt-validation')}}" target="_blank">Login with tooltip</a></li>
			                                    <li><a href="{{url('login-sa-validation')}}" target="_blank">Login with sweetalert</a></li>
			                                    <li><a href="{{url('sign-up')}}" target="_blank">Register Simple</a></li>
			                                    <li><a href="{{url('sign-up-one')}}" target="_blank">Register with Bg Image </a></li>
			                                    <li><a href="{{url('sign-up-two')}}" target="_blank">Register with Bg video</a></li>
			                                    <li><a href="{{url('sign-up-wizard')}}" target="_blank">Register wizard</a></li>
			                                    <li><a href="{{url('unlock')}}">Unlock User</a></li>
			                                    <li><a href="{{url('forget-password')}}">Forget Password</a></li>
			                                    <li><a href="{{url('reset-password')}}">Reset Password</a></li>
			                                    <li><a href="{{url('maintenance')}}">Maintenance</a></li>
											</ul>
										</div>
									</div>
									<div class="col mega-box">
										<div class="link-section">
											<div class="submenu-title">
												<h5>Coming Soon</h5>
												<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['comingsoon', 'comingsoon-bg-video', 'comingsoon-bg-img']) ? 'down' : 'right' }}"></i></div>
											</div>
											<ul class="submenu-content opensubmegamenu"  style="display: {{ in_array(url::currenturlName(), ['comingsoon', 'comingsoon-bg-video', 'comingsoon-bg-img']) ? 'block;' : 'none;' }}">
												<li><a href="{{url('comingsoon')}}" class="{{ url::currenturlName()=='comingsoon' ? 'active' : '' }}">Coming Simple</a></li>
		                                       <li><a href="{{url('comingsoon-bg-video')}}" class="{{ url::currenturlName()=='comingsoon-bg-video' ? 'active' : '' }}">Coming with Bg video</a></li>
		                                       <li><a href="{{url('comingsoon-bg-img')}}" class="{{ url::currenturlName()=='comingsoon-bg-img' ? 'active' : '' }}">Coming with Bg Image</a></li>
											</ul>
										</div>
									</div>
									<div class="col mega-box">
										<div class="link-section">
											<div class="submenu-title">
												<h5>Email templates</h5>
												<div class="according-menu"><i class="fa fa-angle-{{ in_array(url::currenturlName(), ['basic-template', 'email-header', 'template-email', 'ecommerce-templates', 'email-order-success']) ? 'down' : 'right' }}"></i></div>
											</div>
											<ul class="submenu-content opensubmegamenu" style="display: {{ in_array(url::currenturlName(), ['basic-template', 'email-header', 'template-email', 'ecommerce-templates', 'email-order-success']) ? 'block;' : 'none;' }}">
												<li><a href="{{url('basic-template')}}" class="{{ url::currenturlName()=='basic-template' ? 'active' : '' }}">Basic Email</a></li>
		                                       <li><a href="{{url('email-header')}}" class="{{ url::currenturlName()=='email-header' ? 'active' : '' }}">Basic With Header</a></li>
		                                       <li><a href="{{url('template-email')}}" class="{{ url::currenturlName()=='template-email' ? 'active' : '' }}">Ecomerce Template</a></li>
		                                       <li><a href="{{url('template-email-2')}}" class="{{ url::currenturlName()=='template-email-2' ? 'active' : '' }}">Email Template 2</a></li>
		                                       <li><a href="{{url('ecommerce-templates')}}" class="{{ url::currenturlName()=='ecommerce-templates' ? 'active' : '' }}">Ecommerce Email</a></li>
		                                       <li><a href="{{url('email-order-success')}}" class="{{ url::currenturlName()=='email-order-success' ? 'active' : '' }}">Order Success</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="sidebar-main-title">
						<div>
							<h6>{{ trans('lang.Miscellaneous') }}</h6>
                     		<p>{{ trans('lang.Bouns pages & apps') }}</p>
						</div>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/gallery' ? 'active' : '' }}" href="#"><i data-feather="image"></i><span>{{ trans('lang.Gallery') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/gallery' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/gallery' ? 'block' : 'none;' }};">
							<li><a href="{{url('gallery')}}" class="{{ url::currenturlName()=='gallery' ? 'active' : '' }}">Gallery Grid</a></li>
                        <li><a href="{{url('gallery-with-description')}}" class="{{ url::currenturlName()=='gallery-with-description' ? 'active' : '' }}">Gallery Grid Desc</a></li>
                        <li><a href="{{url('gallery-masonry')}}" class="{{ url::currenturlName()=='gallery-masonry' ? 'active' : '' }}">Masonry Gallery</a></li>
                        <li><a href="{{url('masonry-gallery-with-disc')}}" class="{{ url::currenturlName()=='masonry-gallery-with-disc' ? 'active' : '' }}">Masonry with Desc</a></li>
                        <li><a href="{{url('gallery-hover')}}" class="{{ url::currenturlName()=='gallery-hover' ? 'active' : '' }}">Hover Effects</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/blog' ? 'active' : '' }}" href="#"><i data-feather="film"></i><span>{{ trans('lang.Blog') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/blog' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/blog' ? 'block' : 'none;' }};">
							<li><a href="{{url('blog')}}" class="{{ url::currenturlName()=='blog' ? 'active' : '' }}">Blog Details</a></li>
	                        <li><a href="{{url('blog-single')}}" class="{{ url::currenturlName()=='blog-single' ? 'active' : '' }}">Blog Single</a></li>
	                        <li><a href="{{url('add-post')}}" class="{{ url::currenturlName()=='add-post' ? 'active' : '' }}">Add Post</a></li>
						</ul>
					</li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='faq' ? 'active' : '' }}" href="{{url('faq')}}"><i data-feather="help-circle"> </i><span>{{ trans('lang.FAQ') }}</span></a></li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/job-search' ? 'active' : '' }}" href="#"><i data-feather="package"></i><span>{{ trans('lang.Job Search') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/job-search' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/job-search' ? 'block' : 'none;' }};">
							<li><a href="{{url('job-cards-view')}}" class="{{ url::currenturlName()=='job-cards-view' ? 'active' : '' }}">Cards view</a></li>
		                    <li><a href="{{url('job-list-view')}}" class="{{ url::currenturlName()=='job-list-view' ? 'active' : '' }}">List View</a></li>
		                    <li><a href="{{url('job-details')}}" class="{{ url::currenturlName()=='job-details' ? 'active' : '' }}">Job Details</a></li>
		                    <li><a href="{{url('job-apply')}}" class="{{ url::currenturlName()=='job-apply' ? 'active' : '' }}">Apply</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/learning' ? 'active' : '' }}" href="#"><i data-feather="radio"></i><span>{{ trans('lang.Learning') }}</span>
							<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/learning' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/learning' ? 'block' : 'none;' }};">
							<li><a href="{{url('learning-list-view')}}" class="{{ url::currenturlName()=='learning-list-view' ? 'active' : '' }}">Learning List</a></li>
                     		<li><a href="{{url('learning-detailed')}}" class="{{ url::currenturlName()=='learning-detailed' ? 'active' : '' }}">Detailed Course</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/maps' ? 'active' : '' }}" href="#"><i data-feather="map"></i><span>{{ trans('lang.Maps') }}</span>
								<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/maps' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/maps' ? 'block' : 'none;' }};">
								<li><a href="{{url('map-js')}}" class="{{ url::currenturlName()=='map-js' ? 'active' : '' }}">Maps JS</a></li>
		                        <li><a href="{{url('vector-map')}}" class="{{ url::currenturlName()=='vector-map' ? 'active' : '' }}">Vector Maps</a></li>
						</ul>
					</li>
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title {{request()->url()->getPrefix() == '/editors' ? 'active' : '' }}" href="#"><i data-feather="edit"></i><span>{{ trans('lang.Editors') }}</span>
								<div class="according-menu"><i class="fa fa-angle-{{request()->url()->getPrefix() == '/editors' ? 'down' : 'right' }}"></i></div>
						</a>
						<ul class="sidebar-submenu" style="display: {{request()->url()->getPrefix() == '/editors' ? 'block' : 'none;' }};">
							<li><a href="{{url('summernote')}}" class="{{ url::currenturlName()=='summernote' ? 'active' : '' }}">Summer Note</a></li>
	                        <li><a href="{{url('ckeditor')}}" class="{{ url::currenturlName()=='ckeditor' ? 'active' : '' }}">CK editor</a></li>
	                        <li><a href="{{url('simple-mde')}}" class="{{ url::currenturlName()=='simple-mde' ? 'active' : '' }}">MDE editor</a></li>
	                        <li><a href="{{url('ace-code-editor')}}" class="{{ url::currenturlName()=='ace-code-editor' ? 'active' : '' }}">ACE code editor</a></li>
						</ul>
					</li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName() == 'knowledgebase' ? 'active' : ''}}" href="{{ url('knowledgebase') }}"><i data-feather="sunrise"> </i><span>{{ trans('lang.Knowledgebase') }}</span></a></li>
					<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ url::currenturlName()=='support-ticket' ? 'active' : '' }}" href="{{url('support-ticket')}}"><i data-feather="users"> </i><span>{{ trans('lang.Support Ticket') }}</span></a></li>
				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>

<style type="text/css">
	.page-wrapper.horizontal-wrapper .page-body-wrapper .sidebar-wrapper .sidebar-main .sidebar-links .simplebar-wrapper .simplebar-mask .simplebar-content-wrapper .simplebar-content > li {
		padding-top: unset;
	}
</style>
