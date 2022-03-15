@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
    <h3>@trans('customers')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard')</li>
    <li class="breadcrumb-item active">@trans('calendar')</li>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Main content -->
        <section class="content card">
            <div class="row">
                <div class="col-sm-3 w3-padding">
                    <div class="card card-solid">
                        <div class="card-body w3-padding">
                            <div class="w3-padding">
                                <div class="">
                                    <div class="w3-padding w3-center">
                                        <img src="{{ url('/images/sub/calendar.png') }}" style="width: 100px" alt="">
                                        <h3>
                                            @trans("expired subscriptions")
                                        </h3>
                                    </div>
                                    <hr>


                                    @foreach ($services as $item)
                                        <div class="">
                                            <div class="form-group">
                                                <label>
                                                    {!! Form::checkbox('events', $item->id, true, ['class' => 'input-icheck event_check', 'data-id' => $item->id]) !!} <span class="label w3-round"
                                                        style="background-color: red">{{ $item->name }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="calendarSub"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection




@section('script')
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script type="text/javascript">
        var subcalendar = {};
        $(document).ready(function() {
            var events = [];
            $.each($("input[name='events']:checked"), function() {
                events.push($(this).val());
            });

            subcalendar = $('#calendarSub').fullCalendar({
                header: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                contentHeight: 'auto',
                eventLimit: 2,
                eventSources: [{
                    url: '/taqneen-calendar-api',
                    type: 'get',
                    data: {
                        events: events,
                    }
                }],
                eventRender: function(event, element) {
                    if (event.title_html) {
                        element.find('.fc-title').html(event.title_html);
                    }
                    if (event.event_url) {
                        element.attr('href', event.event_url);
                    }
                }, 
                //editable: true,
                eventClick: function(calEvent, jsEvent, view) {
                    console.log(calEvent, jsEvent, view);
                    //window.location.href='/schedule/appointments/'+calEvent.id+'/detail';            
                }
            });
        });

        $(document).on('change', '#user_id, #location_id', function() {
            reload_calendar();
        });

        $(document).on('change', '.event_check', function() {
            reload_calendar();
        });

        function reload_calendar() {
            data = [];
            if ($('select#location_id').length) {
                data.location_id = $('select#location_id').val();
            }
            if ($('select#user_id').length) {
                data.user_id = $('select#user_id').val();
            }

            data.session_id = $('#session_id').val();
            data.trainer_id = $('#trainer_id').val();

            var events = [];
            $.each($("input[name='events']:checked"), function() {
                if ($(this).iCheck('check'))
                    events.push($(this).data('id'));
            });

            data.events = events;
            data.is_football = '{{ request()->is_football == 1 ? '1' : '0' }}';

            var events_source = {
                url: '/sub/calendar/get',
                type: 'get',
                data: data,
            }
            $('#calendarSub').fullCalendar('removeEventSource', events_source);
            $('#calendarSub').fullCalendar('addEventSource', events_source);
        }
    </script>

@endsection
