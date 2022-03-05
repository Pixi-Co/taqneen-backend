@extends("layouts.app")

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="w3-padding" id="app-sub" >

        <section class=" profile_content w3-padding">
            <div class="profile_first_row row d-flex w3-white">
                <div class="profile_first_row_col col-md-4 col-12 d-flex">
                    <!-- <div class="col-md-2"> -->
                    <div class="profile_img">
                        <img src="{{ url('/images/avatar.png') }}" alt="">
                    </div>
                    <!-- </div> -->
                    <div class="profile_title">
                        <h2>{{ $member->name }}</h2>
                        <h4>{{ $member->suppleir_business_name }}</h4>
                        <h4>
                            <button class="btn w3-green sb-shadow" onclick="checkIn('{{ $member->id }}')">@trans("check in")</button>
                        </h4>
                        <h4>
                            <button class="btn w3-green sb-shadow" onclick="createMemberMeasurement({{ $member->id }})">@trans("add measurement")</button>
                        </h4>
                        <h4>
                            <button class="btn w3-red sb-shadow" onclick="stopSubscription()">@trans("stop subscription")</button>
                        </h4>
                    </div>
                </div>
                <div class="profile_first_row_col col-md-4 col-12 profile_Contact ">
                    <h5>@trans("personal info")</h5>
                    @if ($member->email)
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fas fa-envelope"></i> {{ $member->email }}</p>
                    @endif
                    @if ($member->mobile)
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fa fa-phone"></i> {{ $member->mobile }}</p>
                    @endif
                    @if ($member->address_line_1)
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fa fa-map-marker"></i> {{ $member->address_line_1 }}</p>
                    @endif
                    @if ($member->gender)
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fa fa-mars"></i> {{ __($member->gender) }}</p>
                    @endif
                    @if ($member->dob)
                    <p><i class="circle-avatar w3-text-white w3-large margin-r-5 fa fa-calendar"></i> {{ $member->dob }}</p>
                    @endif
                </div>
                <div class="profile_first_row_col col-md-4 col-12 ">
                    <div class="qrcode" data-text="{{ $member->qrcode_link }}" ></div>
                    <br>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h3>{{ count($member->sessions()) }}</h3>
                            <span>@trans("sessions")</span>
                        </div>
                        <div class="col-md-4">
                            <h3>{{ count($member->subscriptions()) }}</h3>
                            <span>@trans("subscriptions")</span>
                        </div>
                        <div class="col-md-4">
                            <h3>{{ count($member->attandances()) }}</h3>
                            <span>@trans("attandances")</span>
                        </div>
                    </div>
                </div>

            </div>
            <br>
            <div class="w3-round w3-white sb-shadow w3-padding">

                <ul class="nav nav-pills mb-3 setting-tabs w3-padding" id="pills-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_1" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("sessions")
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_2" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("subscriptions")
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#tab_3" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            @trans("attendances")
                        </a>
                    </li>
                    @foreach(Modules\Subscription\Entities\Measurement::active() as  $item) 
                    <li class="nav-item">
                        <a class="nav-link" id="companyDetailLink" data-toggle="pill" href="#measure_{{ $item->id }}" role="tab"
                            aria-controls="pills-home" aria-selected="true">
                            {{ $item->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    
                    @foreach(Modules\Subscription\Entities\Measurement::active() as  $row) 
                    <div class="tab-pane fade " id="measure_{{ $row->id }}" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive w3-light-gray">
                            
                            <div id="chart_m_{{ $row->id }}" class="w3-round w3-padding w3-white" style="height: 250px"></div>
                            
                            <table data-title="{{ $row->name }}" class="datatable table table-bordered table-striped" >
                                <thead>
                                    <th>@trans('measurement')</th>
                                    <th>@trans('result')</th>
                                    <th>@trans('date')</th> 
                                </thead>
                                <tbody>
                                    @foreach($member->measurements()->where('measurement_id', $row->id)->get() as  $item) 
                                        <tr>
                                            <td>
                                                {{ $row->name }}
                                            </td>
                                            <td>
                                                {{ $item->result }}
                                            </td>
                                            <td>
                                                {{ $item->date }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="tab-pane fade show active in" id="tab_1" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive w3-light-gray">
                            <table data-title="@trans('sessions')" class="datatable table table-bordered table-striped" >
                                <thead>
                                    <th>@trans('name')</th>
                                    <th>@trans('class type')</th>
                                </thead>
                                <tbody>
                                    @foreach($member->sessions() as $item)
                                        <tr>
                                            <td>
                                                <a href="#" onclick="showSession('{{ $item->id }}')" >{{ $item->name }}</a>
                                            </td>
                                            <td>
                                                {{ optional($item->classType)->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade " id="tab_2" role="tabpanel" aria-labelledby="pills-profile-tab">
                        @include("subscription::subscription.index")
                    </div>

                    <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="table-responsive w3-light-gray">
                            <table data-title="@trans('attandances')" class="datatable table table-bordered table-striped" >
                                <thead>
                                    <th>#</th>
                                    <th>@trans('session')</th>
                                    <th>@trans('date')</th>
                                    <th>@trans('time')</th>
                                </thead>
                                <tbody>
                                    @foreach($member->attandances() as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <a href="#" onclick="showSession('{{ $item->session_id }}')" >{{ optional($item->session)->name }}</a>
                                            </td>
                                            <td>
                                                {{ $item->date }}
                                            </td>
                                            <td>
                                                {{ date('H:i:s', strtotime($item->created_at)) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
                

            </div>



        </section>

        <div class="modal fade checkin-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title text-capitalize">{{ __('choose session') }}</h4>

                    </div>
                    <form action="/sub/member/check-in/{{ $member->id }}" class="form" action="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">@trans("session")</label>
                                {!! Form::select(
    'membership_id',
    $member->subscriptionsQuery()->where('is_expire', '0')->pluck('product_name', 'id')->toArray(),
    null,
    ['class' => 'form-control', 'required', 'placeholder' => __('select session'), 'id' => 'session_id'],
) !!}
                            </div>
                            <input type="hidden" name="" id="member_id" value="{{ $member->id }}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default w3-round-xlarge sb-shadow"
                                data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit"
                                class="btn btn-primary w3-round-xlarge sb-shadow">{{ __('Save changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade stop-subscription-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title text-capitalize">{{ __('stop subscription') }}</h4>

                    </div>
                    <form action="/sub/stop-subscription" class="form" action="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">@trans("subscription")</label>
                                {!! Form::select(
    'id',
    $member->subscriptionsQuery()->where('is_expire', '0')->where('is_stop', '0')->pluck('product_name', 'id')->toArray(),
    null,
    ['class' => 'form-control', 'required', 'placeholder' => __('select subscription'), 'id' => 'subscription_id'],
) !!}
                            </div>
                            <div class="form-group">
                                <label for="">@trans('stop days')</label>
                                <input type="number" name="days" required class="form-control" >
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default w3-round-xlarge sb-shadow"
                                data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit"
                                class="btn btn-primary w3-round-xlarge sb-shadow">{{ __('Save changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('subscription::session.show')
        @include('subscription::member_measurement.form')


    </div>

@endsection

@section('javascript') 
    <script src="{{ url('/') }}/js/lib/chart-apex.js"></script>

    <script>

        function checkIn() {
            var member = $('#member_id').val();
            var session = $('#session_id').val();

            if ($("#session_id option").length > 2) {
                $('.checkin-modal').modal('show');
            } else {
                session = $($("#session_id option")[1]).attr('value');
                submitCheckIn(member, session);
            }
        }

        function submitCheckIn(member_id, session_id) {
            var data = {
                session_id: session_id,
                _token: '{{ csrf_token() }}'
            };
            $.post("{{ url('/sub/member/check-in') }}/" + member_id + "?", function(r) {
                if (r.status == 1) {
                    toastr.success(r.message);

                    // if table of subscription reload it
                    if (sell_table)
                        sell_table.ajax.reload();
                } else {
                    toastr.error(r.message);
                }
            });
        }

        function reset() {
            app.member_measurement_resource = {
                member_id: {{ $member->id }}
            };
        }

        function stopSubscription() {
            $('.stop-subscription-modal').modal('show');
        }
        
        var app = new Vue({
            el: '#app-sub',
            data: {
                class_types: [],
                members: [],
                class_type_resource: {},
                member_resource: {},
                trainer_resource: {},
                member_measurement_resource: {},
                session_resource: {},
            }
        });
        
        $(document).ready(function(){
            $('.datatable').each(function(){
                $(this).DataTable({
                    @include("layouts.partials.datatable_plugin")
                });
            });
        });
    </script>
    
    @foreach(Modules\Subscription\Entities\Measurement::active() as  $row) 
        @php
            //dd($member->getChartDataOfMeasurement($row->id));
        @endphp
        @include("subscription::user.profile_chart_js", ["id" => $row->id, "resource" => $member->getChartDataOfMeasurement($row->id)])
    @endforeach

    @include('subscription::session.scripts')
    @include('subscription::member_measurement.scripts')
    @include("subscription::subscription.scripts", ["query" => "member_id=" . $member->id])
@endsection
