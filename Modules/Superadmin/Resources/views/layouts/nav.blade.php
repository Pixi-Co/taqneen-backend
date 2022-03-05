<section class="no-print">
    <nav class="navbar navbar-default bg-white m-4">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{action('\Modules\Superadmin\Http\Controllers\SuperadminController@index')}}"><i class="fa fas fa-users-cog"></i> {{__('superadmin::lang.superadmin')}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav nav-pills mb-3 setting-tabs w3-block w3-padding">
                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'business') class="active" @endif>
                        <a href="{{action('\Modules\Superadmin\Http\Controllers\BusinessController@index')}}">@trans('superadmin::lang.all_business')</a>
                    </li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'superadmin-subscription') class="active" @endif>
                        <a href="{{action('\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController@index')}}">@trans('superadmin::lang.subscription')</a>
                    </li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'packages') class="active" @endif>
                        <a href="{{action('\Modules\Superadmin\Http\Controllers\PackagesController@index')}}">@trans('superadmin::lang.subscription_packages')</a>
                    </li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'settings') class="active" @endif>
                        <a href="{{action('\Modules\Superadmin\Http\Controllers\SuperadminSettingsController@edit')}}">@trans('superadmin::lang.super_admin_settings')</a>
                    </li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'communicator') class="active" @endif>
                        <a href="{{action('\Modules\Superadmin\Http\Controllers\CommunicatorController@index')}}">@trans('superadmin::lang.communicator')</a>
                    </li>

                    <li >
                        <div class="dropdown w3-padding">
                            <a href="#" class="nav-link  dropdown-toggle w3-padding" style="padding: 5px!important;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              @trans('settings') 
                            </a>
                            <ul class="dropdown-menu w3-padding new-shadow" style="padding-left: 0px!important" aria-labelledby="dropdownMenu1"> 
                              <li style="padding-left: 0px" >
                                  <a target="_blank" href="/business_types">@trans('business_types')</a>
                              </li>
          
                              <li  style="padding-left: 0px">
                                  <a target="_blank" href="/language">@trans('languages')</a>
                              </li>
          
                              <li style="padding-left: 0px" >
                                  <a target="_blank" href="/translations">@trans('translations')</a>
                              </li>
          
                              <li style="padding-left: 0px" >
                                  <a target="_blank" href="/tutorial">@trans('tutorial')</a>
                              </li>
                            </ul>
                        </div> 
                    </li>

                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</section>
