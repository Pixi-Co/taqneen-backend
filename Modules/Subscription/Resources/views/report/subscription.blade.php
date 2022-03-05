@extends("layouts.app")


@section('content')
    <div class="w3-padding home">

        <h3 class="text-capitalize">
            @trans('subscription report')
        </h3>

        <div class="w3-block w3-white w3-round sb-shadow w3-padding">
            <div class="row">

                <div class="col-md-3 col-xs-6">
                    <label for="">@trans('members')</label>
                    <select name="" class="form-control" id="member_id">
                        <option value="">@trans('all')</option>
                        @foreach (Modules\Subscription\Entities\Member::active() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-xs-6">
                    <label for="">@trans('class types')</label>
                    <select name="" class="form-control" id="class_type_id">
                        <option value="">@trans('all')</option>
                        @foreach (Modules\Subscription\Entities\ClassType::active() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-xs-6">
                    <label for="">@trans('payment status')</label>
                    <select name="" class="form-control" id="payment_status">
                        <option value="">@trans('all')</option> 
                        <option value="paid">@trans('paid')</option> 
                        <option value="due">@trans('due')</option> 
                        <option value="partial">@trans('partial')</option> 
                    </select>
                </div>

                <div class="col-md-3 col-xs-4 hidden">
                    <label for="">@trans('sessions')</label>
                    <select name="" class="form-control" id="session_id">
                        <option value="">@trans('all')</option>
                        @foreach (Modules\Subscription\Entities\Session::active() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="form-group">
                        <label for="">@trans('is expire')</label>
                        <select name="" class="form-control" id="is_expire">
                            <option value="">@trans('all')</option>
                            <option value="1">@trans('expired')</option>
                            <option value="0">@trans('not expired')</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="form-group">
                        <br>
                        <div class="input-">
                            <input type="hidden" name="start_date" class="start_date">
                            <input type="hidden" name="end_date" class="end_date">
                            <button type="button" class="btn btn-primary" id="profit_loss_date_filter">
                                <span>
                                    <i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}
                                </span>
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xs-4">
                    <div class="form-group">
                        <label for=""></label>
                        <button class="btn w3-green" onclick="filter()">@trans("search")</button>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <div class="row general-report">
            <div class="col-md-6 col-lg-4">
                <div class="items box2">
                    <div class="top">
                        <div>
                            <p>@trans("all subscriptions")</p>
                            <h2 class="counter display_currency">{{ Subscription::activeQuery()->sum('final_total') }}
                            </h2>
                        </div>
                        <span class="icon">
                            <i class="fas fa-warehouse"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="items box2">
                    <div class="top">
                        <div>
                            <p>@trans("expired subscriptions")</p>
                            <h2 class="counter display_currency">
                                {{ Subscription::activeQuery()->where('is_expire', '1')->sum('final_total') }}</h2>
                        </div>
                        <span class="icon">
                            <i class="fas fa-warehouse"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="items box2">
                    <div class="top">
                        <div>
                            <p>@trans("not expired subscriptions")</p>
                            <h2 class="counter display_currency">
                                {{ Subscription::activeQuery()->where('is_expire', '0')->sum('final_total') }}</h2>
                        </div>
                        <span class="icon">
                            <i class="fas fa-warehouse"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="w3-padding w3-block w3-white new-shadow w3-round-xlarge">
                    <h3>@trans("sum of subscriptions for members")</h3>
                    <div id="chart" style="height: 300px"></div>
                </div>
            </div>
        </div>
        <br>

        <div class="w3-block">
            <div class="table-responsive w3-light-gray">
                <table data-title="@trans('subscriptions')" class="table table-bordred table-striped" id="attandanceTable">
                    <thead>
                        <th>@trans("date")</th>
                        <th>@trans("invoice_number")</th>
                        <th>@trans("member")</th>
                        <th>@trans("clas_type")</th>
                        <th>@trans("session")</th>
                        <th>@trans("pay_status")</th>
                        <th>@trans("total")</th>
                        <th>@trans("is_expire")</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@section('javascript')
    <script src="{{ url('/') }}/js/lib/chart-apex.js"></script>
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script>
        //Roles table
        var attandanceTable = {};
        attandanceTable = $('#attandanceTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/sub/report/subscription',
            @include("layouts.partials.datatable_plugin")
            "columns": [{
                    "data": "transaction_date"
                },
                {
                    "data": "invoice_no"
                },
                {
                    "data": "contact_id"
                },
                {
                    "data": "class_type_id"
                },
                {
                    "data": "session"
                },
                {
                    "data": "payment_status"
                },
                {
                    "data": "final_total"
                },
                {
                    "data": "is_expire"
                },
            ],
            "drawCallback": function(settings) {
                __currency_convert_recursively($("table"));
            }
        });


        function filter() {
            var data = {
                start_date: $('.start_date').val(),
                end_date: $('.end_date').val(),
                session_id: $('#session_id').val(),
                payment_status: $('#payment_status').val(),
                class_type_id: $('#class_type_id').val(),
                member_id: $('#member_id').val(),
                is_expire: $('#is_expire').val(),
            };

            attandanceTable.ajax.url('{{ url('/sub/report/subscription') }}' + "?" + $.param(data));
            attandanceTable.ajax.reload();
        }

        function loadChart() {
            var options = {
                annotations: {
                    xaxis: [{
                        //x: new Date("28 Apr 2014").getTime(),
                        borderColor: "#bfc5cc",
                        fillColor: "#bfc5cc",
                        opacity: 1,
                        strokeDashArray: 0,
                        label: {
                            borderColor: "#bfc5cc",
                            style: {
                                color: "#fff",
                                fontSize: "12px",
                                lineHeight: "12px",
                                background: "#bfc5cc",
                            },
                            offsetX: -57,
                            offsetY: 30,
                            orientation: "horizontal",
                            text: "🐂 BOT 2",
                            textAnchor: "left",
                        },
                    }, ],
                },
                chart: {
                    toolbar: {
                        show: false,
                        offsetX: 0,
                        offsetY: 0,
                        tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true | '<img src="/static/icons/reset.png" width="20">',
                            customIcons: []
                        },
                        export: {
                            csv: {
                                filename: 'sales',
                                columnDelimiter: ',',
                                headerCategory: 'category',
                                headerValue: 'value',
                                dateFormatter(timestamp) {
                                    return new Date(timestamp).toDateString()
                                }
                            },
                            svg: {
                                filename: undefined,
                            },
                            png: {
                                filename: undefined,
                            }
                        },
                        autoSelected: 'zoom'
                    },
                    zoom: {
                        enabled: true,
                        type: 'x',
                        autoScaleYaxis: false,
                        zoomedArea: {
                            fill: {
                                color: '#90CAF9',
                                opacity: 0.4
                            },
                            stroke: {
                                color: '#0D47A1',
                                opacity: 0.4,
                                width: 1
                            }
                        }
                    },
                    animations: {
                        enabled: true,
                    },
                    fontFamily: "Roboto, sans-serif",
                    // zoom: {
                    //     autoScaleYaxis: true,
                    //     enabed: true,
                    //     type: 'x',
                    // },
                    height: 350,
                    type: "area",
                    id: "ctxinternalchart",
                },
                colors: ["#41BC85"],
                stroke: {
                    width: [2, 1],
                },
                fill: {
                    // type: 'gradient',
                    // gradient: {
                    //     shadeIntensity: 1,
                    //     opacityFrom: 0.7,
                    //     opacityTo: 1,
                    //     stops: [0, 90, 100]
                    // }
                },
                dataLabels: {
                    enabled: false,
                },
                grid: {
                    padding: {
                        right: 0,
                        left: 0,
                    },
                    borderColor: "#f9f9f9",
                },
                series: [{
                    data: [
                        @foreach (Subscription::chartData() as $item)
                            @if ($item->contact_name)
                                {{ $item->sum_total }},
                            @endif
                        @endforeach
                    ],
                }, ],
                title: {
                    text: undefined,
                    align: "left",
                    offsetX: -6,
                },
                tooltip: {
                    x: {
                        format: "MMM d yyyy",
                    },
                    y: {
                        formatter: function(val) {
                            return val.toFixed(2);
                        },
                        title: {
                            formatter: (seriesName) => "USD",
                        },
                    },
                },
                labels: [
                    @foreach (Subscription::chartData() as $item)
                        @if ($item->contact_name)
                            '{{ $item->contact_name }}',
                        @endif
                    @endforeach
                ],
                xaxis: {
                    crosshairs: {
                        show: true,
                        width: 1,
                        position: "front",
                        opacity: 1,
                        stroke: {
                            color: "#bfc5cc",
                            width: 1,
                            dashArray: 2,
                        },
                        dropShadow: {
                            enabled: false,
                            top: 0,
                            left: 0,
                            blur: 1,
                            opacity: 0.4,
                        },
                    },
                    labels: {
                        format: "MMM yyyy",
                        style: {
                            colors: "#666",
                        },
                    },
                    tickAmount: 4,
                    tickPlacement: "on",
                    tooltip: {
                        enabled: false,
                    },
                    type: "text",
                },
                yaxis: {
                    tickAmount: 4,
                    forceNiceScale: true,
                    labels: {
                        formatter: function(val, index) {
                            return val.toFixed(0);
                        },
                        style: {
                            colors: "#666",
                        },
                    },
                    opposite: is_rtl
                },
                style: {
                    direction: 'rtl'
                },
            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
        }

        loadChart();
    </script>
@endsection
