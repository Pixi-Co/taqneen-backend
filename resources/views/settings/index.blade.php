@extends('layouts.app')
@section('title', '')


@section('css')
    <style>
        .dataTables_wrapper {
            width: 100% !important;
        }

    </style>
@endsection

@section('content')


    <!-- Main content -->
    <section class="full-content setting_page">

        <div class="">
            <!-- ---------------- r_side_menu ----------------- -->

            <!--Contents-->
            <div class="w3-padding">

                <section class="sale_report">
                    <ul class="nav nav-pills mb-3 setting-tabs" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " id="companyDetailLink" data-toggle="pill" href="#tab_5" role="tab"
                                aria-controls="pills-home" aria-selected="true">
                                @trans('messages.company_details')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="companySettingDetailLink" data-toggle="pill" href="#tab_1"
                                role="tab" aria-controls="pills-home" aria-selected="false">
                                @trans("messages.company_settings")
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="integrationLink" data-toggle="pill" href="#tab_2" role="tab"
                                aria-controls="pills-profile" aria-selected="false">
                                @trans("messages.integrations")
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="subscriptionLink" data-toggle="pill" href="#tab_3" role="tab"
                                aria-controls="pills-home" aria-selected="false">
                                @trans('messages.package_subscription')</a>
                        </li>
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" id="productSettingLink" data-toggle="pill" href="#tab_4" role="tab"
                                aria-controls="pills-home" aria-selected="false">
                                @trans("messages.product_settings")
                            </a>
                        </li> 
                    -->

                        @can_bt(['admin_settings'])
                        <!--
                          <li class="nav-item">
                            <a class="nav-link"
                            onclick="$('.tab-pane').removeClass('active in');$('.').addClass('active in')"
                            id="AdminSettingLink"
                            data-toggle="pill"
                            href="#tab_6" role="tab" aria-controls="pills-home" aria-selected="false">
                              @trans("messages.admin_settings")
                            </a>
                          </li>
                        -->
                        @endcan_bt

                    </ul>

                    <div class="tab-content" id="pills-tabContent"> 

                        @include("settings.partials.tab1")

                        @include("settings.partials.tab2")

                        @include("settings.partials.tab3")

                        <!--
                        @include("settings.partials.tab4")
                        -->

                        @include("settings.partials.tab5")


                        @can_bt(['admin_settings'])
                        <!--
                          @include("settings.partials.tab6")
                        -->
                        @endcan_bt

                    </div>
                </section>
                </main>
    </section>

    <div class="modal in" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header dir_rtl">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title"></h4>
                </div>

                <div class="modal-body setting-content" style="padding: 0px!important;overflow: auto!important">

                </div>
                <div class="modal-footer  ">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                        @trans('Close')
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@stop
@section('javascript')
    @include("settings.partials.setting_js")
 
@endsection
