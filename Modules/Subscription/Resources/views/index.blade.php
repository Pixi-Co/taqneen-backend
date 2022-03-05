@extends('layouts.app')

@section('css')
    <style>
        .tab {
            display: none;
        }
 

        .tab-trainer .content,
        .tab-trainer .box-body,
        .tab-trainer .box {
            padding: 0px !important;
        }

        .class-type-fa {
            margin: 7px;
            border-radius: 6em;
            width: 60px;
            height: 60px;
            color: white;
            text-align: center;
            padding-top: 20px;
        }

    </style>
@endsection

@section('content')
    <div id="app-sub" class="w3-display-container home">
        <div class="row">
            <ul class="sub-nav nav nav-pills mb-3 setting-tabs" style="display: none" id="pills-tab" role="tablist">
 

                @can_bt(['subscription.class_type'])
                @can('subscription.class_types.view')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showTab('class-type')">
                        <img src="{{ url('/images/sub/class_type.png') }}" width="30" alt="">
                        <b>{{ __('class types') }}</b>
                    </a>
                </li>
                @endcan
                @endcan_bt

                @can_bt(['subscription.subscription'])
                @can('subscription.view')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showTab('subscription')">
                        <img src="{{ url('/images/sub/subscription.png') }}" width="30" alt="">
                        <b>{{ __('subscriptions') }}</b>
                    </a>
                </li>
                @endcan
                @endcan_bt

                @can_bt(['subscription.member'])
                @can('customer.view')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showTab('member')">
                        <img src="{{ url('/images/sub/members.png') }}" width="30" alt="">
                        <b>{{ __('members') }}</b>
                    </a>
                </li>
                @endcan
                @endcan_bt
                
                @can_bt(['subscription.rate'])
                @can('subscription.rates.view')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showTab('rate')">
                        <img src="{{ url('/images/sub/rate.png') }}" width="30" alt="">
                        <b>{{ __('rates') }}</b>
                    </a>
                </li>
                @endcan
                @endcan_bt

                @can_bt(['subscription.trainer'])
                @can('subscription.trainers.view')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showTab('trainer')">
                        <img src="{{ url('/images/sub/trainer.png') }}" width="30" alt="">
                        <b>{{ __('trainers') }}</b>
                    </a>
                </li>
                @endcan
                @endcan_bt

                @can_bt(['subscription.session'])
                @can('subscription.sessions.view')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showTab('session')">
                        <img src="{{ url('/images/sub/session.png') }}" width="30" alt="">
                        <b>{{ __('sessions') }}</b>
                    </a>
                </li>
                @endcan
                @endcan_bt

                @can_bt(['subscription.calendar'])
                @can('subscription.calendar')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="showTab('calendar')">
                        <img src="{{ url('/images/sub/calendar.png') }}" width="30" alt="">
                        <b>{{ __('calendar') }}</b>
                    </a>
                </li>
                @endcan
                @endcan_bt

            </ul>
            <br>
        </div> 

        <div class="row">
            <div class="col-md-12"> 

                @can_bt(['subscription.class_type'])
                @can('subscription.class_types.view')
                <div class="tab tab-class-type">
                    @include("subscription::class_type.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.measurment'])
                @can('subscription.view')
                <div class="tab tab-measurment">
                    @include("subscription::measurment.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.member'])
                @can('customer.view')
                <div class="tab tab-member">
                    @include("subscription::user.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.trainer'])
                @can('subscription.trainers.view')
                <div class="tab tab-trainer">
                    @include("subscription::trainer.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.rate'])
                @can('subscription.rates.view')
                <div class="tab tab-rate">
                    @include("subscription::rate.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.session'])
                @can('subscription.sessions.view')
                <div class="tab tab-session">
                    @include("subscription::session.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.calendar'])
                @can('subscription.calendar')
                <div class="tab tab-calendar">
                    @include("subscription::calendar.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.calendar'])
                @can('subscription.football_calendar')
                <div class="tab tab-football_calendar">
                    @include("subscription::football_calendar.index")
                </div>
                @endcan
                @endcan_bt

                @can_bt(['subscription.subscription'])
                @can('subscription.view')
                <div class="tab tab-subscription">
                    @include("subscription::subscription.index")
                </div>
                @endcan
                @endcan_bt

                @can('subscription.football_orders.view')
                <div class="tab tab-football_order">
                    @include("subscription::football_order.index")
                </div>
                @endcan
                
                @can('subscription.sessions.show')
                @include("subscription::session.show")
                @endcan
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="{{ url('/js/pos.js') }}"></script>


    <script>
        @php
        $business_id = request()->session()->get('user.business_id');
        @endphp
        var businessId = '{{ $business_id }}';
 

        function showTab(name) {
            $('#app-sub .sub-nav').hide();
            $(".tab").hide();
            $(".tab-" + name).show();
        }

        var app = new Vue({
            el: '#app-sub',
            data: {
                class_types: [],
                measurments: [],
                members: [],
                business_id: businessId,
                class_type_resource: {},
                member_resource: {},
                trainer_resource: {},
                rate_resource: {},
                measurment_resource: {},
                session_resource: {},
                football_order_resource: {},
            }
        });

        @if (request()->tab)
        showTab('{{ request()->tab }}');
        @endif
    </script>
    @include("subscription::class_type.scripts")
    @include("subscription::measurment.scripts")
    @include("subscription::user.scripts")
    @include("subscription::trainer.scripts")
    @include("subscription::session.scripts")
    @include("subscription::calendar.scripts")
    @include("subscription::football_calendar.scripts")
    @include("subscription::rate.scripts")
    @include("subscription::subscription.scripts")
    @include("subscription::football_order.scripts")
@endsection
