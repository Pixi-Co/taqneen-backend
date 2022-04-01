<div class="sidebar-wrapper bg-white">
    <div>
        <div class="bg-white  logo-wrapper" style="height:130px ">
            <a href="/home"><img class="img-fluid for-light " src="{{ asset('assets/images/logo/logo.png') }}"
                    alt=""><img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                    alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="/home"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">

                    <li class="sidebar-list">
                        <a class="sidebar-link   mt-5  sidebar-title link-nav {{ Route::currentRouteName() == 'index' ? 'active' : '' }} "
                            href="/home">
                            <i data-feather="home"> </i>
                            <span style="font-family:   sans-serif;">{{ trans('lang.dashboard') }}</span>
                        </a>
                    </li>

                    {{-- ---------------------- customers button --------------------------- --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link    sidebar-title {{ request()->route()->getPrefix() == '/users'? 'active': '' }}"
                            href="#">
                            <i data-feather="users"></i><span
                                style="font-family:   sans-serif;">{{ __('report.customer') }}</span>
                            <div class="according-menu">
                                <i
                                    class="fa fa-angle-{{ request()->route()->getPrefix() == '/customers'? 'down': 'right' }}"></i>
                            </div>
                        </a>
                        <ul class="sidebar-submenu"
                            style="display: {{ request()->route()->getPrefix() == '/users'? 'block': 'none;' }};">
                            <li>
                                <a style="font-family:   sans-serif; "
                                    href="{{ action('ContactController@index', ['type' => 'customer']) }}"
                                    class="{{ Route::currentRouteName() == 'viewcustomers' ? 'active' : '' }}">
                                    {{ __('report.customer') }}
                                </a>
                            </li>
                        </ul>
                    </li>



                    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
