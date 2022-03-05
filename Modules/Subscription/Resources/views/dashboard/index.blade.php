@extends('layouts.app')

@php

$user_id = request()
    ->session()
    ->get('user.id');
$user = App\User::where('id', $user_id)
    ->with(['media'])
    ->first();
@endphp

@section('css')

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('/') }}/css/lib/animate.css" />

    <link rel="stylesheet" href="{{ url('/') }}/css/lib/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/lib/daterangepicker.css" />

    <style>
        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
            padding: 5px!important;
        }
    </style>
@endsection


@section('title', __('home.home'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header content-header-custom hidden">
        <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}
        </h1>
    </section>
    <!-- Main content -->
    <section class="content content-custom no-print">
        <br>
        @if (auth()->user()->can('dashboard.data'))
            @include("home.new_index", ['data' => $data])
        @endif
    </section>
    <!-- /.content -->
@stop
@section('javascript')
    @if (auth()->user()->can('dashboard.data'))
        <script>
            var salesOverviewData = {!! json_encode($data['sales_overview']['data']) !!};
            var salesOverviewLabels = {!! json_encode($data['sales_overview']['labels']) !!};
            var salesReportData1 = {!! json_encode($data['sales_report']['data1']) !!};
            var salesReportData2 = {!! json_encode($data['sales_report']['data2']) !!};
            var salesReportLabels1 = {!! json_encode($data['sales_report']['labels1']) !!};
            var salesReportLabels2 = {!! json_encode($data['sales_report']['labels2']) !!};
            var topSellerProductData = {!! json_encode($data['topseller_product']['data']) !!};
            var topSellerProductLabels = {!! json_encode($data['topseller_product']['labels']) !!};
            var topSellerCategoryData = {!! json_encode($data['topseller_category']['data']) !!};
            var topSellerCategoryLabels = {!! json_encode($data['topseller_category']['labels']) !!};
        </script>

        <script src="{{ url('/') }}/js/lib/popper.min.js"></script>
        <script src="{{ url('/') }}/js/lib/wow.min.js"></script>
        <script src="{{ url('/') }}/js/lib/jquery.counterup.js"></script>
        <script src="{{ url('/') }}/js/lib/jquery.waypoints.min.js"></script>
        <!-- ------- apex chart -------------- -->
        <!-- ------- chart js -------------- -->
        <script src="{{ url('/') }}/js/lib/chart.js"></script>
        <!-- ----------- datepicker ----------- -->
        <script type="text/javascript" src="{{ url('/') }}/js/lib/moment.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/js/lib/daterangepicker.min.js"></script>
        <!-- ------- charts js   -------------- -->
        <script src="{{ url('/') }}/js/lib/charts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{ url('/') }}/js/lib/chart-apex.js"></script>
        <!-- ------- charts js   -------------- -->
        <!-- ------- custom js   -------------- -->
        <script src="{{ url('/') }}/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>


        <script>
            var app = new Vue({
                el: '#appContent',
                data: {
                    data: []
                }
            });
        </script>
        <script>
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                        opens: "left",
                    },
                    function(start, end, label) {
                        console.log(
                            "A new date selection was made: " +
                            start.format("YYYY-MM-DD") +
                            " to " +
                            end.format("YYYY-MM-DD")
                        );
                    }
                );
            });
        </script>

        <script>
            $(function() {

                $('.imgSelect').select2({
                    width: "100%",
                    templateSelection: iformat,
                    templateResult: iformat,
                    allowHtml: true,
                    minimumResultsForSearch: -1
                });

            });
        </script>

        <!-- ----------- counter timer ------------ -->
        <script type="text/javascript">
            var minutesLabel = document.getElementById("minutes");
            var secondsLabel = document.getElementById("seconds");
            var totalSeconds = 0;
            setInterval(setTime, 1000);

            function setTime() {
                ++totalSeconds;
                secondsLabel.innerHTML = pad(totalSeconds % 60);
                minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
            }

            function pad(val) {
                var valString = val + "";
                if (valString.length < 2) {
                    return "0" + valString;
                } else {
                    return valString;
                }
            }
        </script>

        <!--
        <script>
            $(".per_btn").on("click", function(e) {
                e.stopPropagation();
                $(this).siblings(".per_body").slideToggle();
            });
        </script>  
    -->

        <script>
            $(document).ready(function() {
                $('#productAlertIItem').click();
                __currency_convert_recursively($('.home'));

                // load todos
                $.get("{{ url('/essentials/todo') }}", function(data) {
                    console.log(data);
                    if (data)
                        app.data = data.data;
                    // make slider of notes  
                    setTimeout(function() {
                        $('.slider').owlCarousel({
                            loop: true,
                            rtl: {{ $user->language == 'ar' ? 'true' : 'false' }},
                            margin: 10,
                            center: false,
                            nav: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 1
                                },
                                1000: {
                                    items: 2
                                }
                            }
                        })
                    }, 1000);

                    console.log("language, ", '{{ $user->language }}');
                });

                //atock alert datatables
                var stock_alert_table = $('#stock_alert_table').DataTable({
                    processing: true,
                    serverSide: true,
                    @include("layouts.partials.datatable_plugin")
                    columns: [{
                            data: 'product_image',
                            name: 'product_image'
                        },
                        {
                            data: 'product',
                            name: 'product'
                        },
                        {
                            data: 'location',
                            name: 'location'
                        },
                        {
                            data: 'stock',
                            name: 'stock'
                        },
                    ],
                    ajax: '/home/product-stock-alert',
                    fnDrawCallback: function(oSettings) {
                        __currency_convert_recursively($('#stock_alert_table'));
                    },
                });

                //Stock expiry report table
                stock_expiry_alert_table = $('#stock_expiry_alert_table').DataTable({
                    processing: true,
                    serverSide: true,
                    @include("layouts.partials.datatable_plugin")
                    ajax: {
                        url: '/reports/stock-expiry',
                        data: function(d) {
                            d.exp_date_filter = $('#stock_expiry_alert_days').val();
                        },
                    },
                    order: [
                        [3, 'asc']
                    ],
                    columns: [{
                            data: 'product_image',
                            name: 'product_image'
                        },
                        {
                            data: 'product',
                            name: 'p.name'
                        },
                        {
                            data: 'location',
                            name: 'l.name'
                        },
                        {
                            data: 'stock_left',
                            name: 'stock_left'
                        },
                        {
                            data: 'exp_date',
                            name: 'exp_date'
                        },
                        {
                            data: 'edit',
                            name: 'edit'
                        },
                    ],
                    fnDrawCallback: function(oSettings) {
                        __show_date_diff_for_human($('#stock_expiry_alert_table'));
                        __currency_convert_recursively($('#stock_expiry_alert_table'));
                    },
                });
            });
        </script>



        <script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
        @if (!empty($all_locations))
            {!! $sells_chart_1->script() !!}
            {!! $sells_chart_2->script() !!}
        @endif
    @endif
@endsection
