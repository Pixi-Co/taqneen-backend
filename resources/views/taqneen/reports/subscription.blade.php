@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')    
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>@trans('subscriptions')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard')</li>
    <li class="breadcrumb-item active">@trans('subscriptions')</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">

                    </div><!-- /.container-fluid -->
                </section>
                <section>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">

                                        {{-- <div class="card-header">
                                        <h5>@trans('lang.Opportunities')</h5>
                                    </div> --}}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">@trans('service')</label>
                                                        <select class="form-select  mb-3 service_id">
                                                            <option value="">@trans('all')</option>
                                                            @foreach ($services as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">@trans('subscription type')</label>
                                                        <select class="form-select  mb-3 subscription_type">
                                                            <option value="">@trans('all')</option>
                                                            <option value="new">@trans('new')</option>
                                                            <option value="renew">@trans('renew')</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">@trans('subscription date')</label>
                                                        <input type="text" class="form-control dateranger transaction_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">@trans('expire date')</label>
                                                        <input type="text" class="form-control dateranger expire_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">@trans('payment date')</label>
                                                        <input type="text" class="form-control dateranger payment_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">@trans('sales_commission')</label>
                                                        {!! Form::select("user_id", $users, null, ["class" => "form-select user_id"]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <button class="btn btn-primary"
                                                        onclick="filter()">@trans('search')</button>
                                                    <button class="btn btn-primary"
                                                        onclick="clearSearch()">@trans('clear')</button>
                                                </div>


                                            </div>

                                            <br>
                                            <div class="row" style="display: none" >
                                                <div class="col-md-3 w3-padding">
                                                    <div class="w3-card w3-round card-body w3-center w3-text-dark-gray">
                                                        <h5>
                                                            @trans('total of subscriptions')
                                                        </h5>
                                                        <b>{{ $data['subscription_total'] }}</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 w3-padding">
                                                    <div class="w3-card w3-round card-body w3-center w3-text-red">
                                                        <h5>
                                                            @trans('total of expire subscriptions')
                                                        </h5>
                                                        <b>{{ $data['subscription_expire_total'] }}</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 w3-padding">
                                                    <div class="w3-card w3-round card-body w3-center w3-text-green">
                                                        <h5>
                                                            @trans('total of active subscriptions')
                                                        </h5>
                                                        <b>{{ $data['subscription_active_total'] }}</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 w3-padding">
                                                    <div class="w3-card w3-round card-body w3-center w3-text-deep-orange">
                                                        <h5>
                                                            @trans('total of will expire subscriptions')
                                                        </h5>
                                                        <b>{{ $data['subscription_will_expire_total'] }}</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">@trans('subscription type')</label>
                                                        <select class="form-select  mb-3 subscription_type"  >
                                                            <option value="">@trans('all')</option>
                                                            <option value="new">@trans('new')</option> 
                                                            <option value="renew">@trans('renew')</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div id="subscription_chart" style="display: none" class="w3-block" ></div>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="display" id="subscriptionTable">
                                                    <thead>
                                                        <tr>
                                                            <th>@trans('company name')</th>
                                                            <th>@trans('first name')</th>
                                                            <th>@trans('expire date')</th>
                                                            <th>@trans('phone')</th>
                                                            <th>@trans('services')</th>
                                                            <th>@trans('final total')</th>
                                                            <th>@trans('sales commission agent')</th>
                                                            <th>@trans('status')</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>@trans('company name')</th>
                                                            <th>@trans('first name')</th>
                                                            <th>@trans('expire date')</th>
                                                            <th>@trans('phone')</th>
                                                            <th>@trans('services')</th>
                                                            <th>@trans('final total')</th>
                                                            <th>@trans('sales commission agent')</th>
                                                            <th>@trans('status')</th> 
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->

                    </section>

                </section>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection




@section('script')
   
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/jszip.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/pdfmake.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/vfs_fonts.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.select.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.html5.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.print.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>

    <script>
        function addNote(id) {
            $('#subscriptionNote' + id).modal('show');
        }

        function filter() {
            var data = {
                service_id: $('.service_id').val(),
                user_id: $('.user_id').val(),
                subscription_type: $('.subscription_type').val(),
                transaction_date: $('.transaction_date').val(),
                expire_date: $('.expire_date').val(),
                payment_date: $('.payment_date').val(),
            };
            subscriptionTable.ajax.url('/reports/subscriptions?' + $.param(data));
            subscriptionTable.ajax.reload();
        }

        function clearSearch() {
            $('.service_id').val('');
            $('.subscription_type').val('');

            $('.transaction_date').val('');

            $('.expire_date').val('');

            $('.payment_date').val('');

            $('.user_id').val('');
            subscriptionTable.ajax.url('/reports/subscriptions');
            subscriptionTable.ajax.reload();
        }

        var subscriptionTable = $('#subscriptionTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/reports/subscriptions',
            "autoWidth": true,
            "lengthMenu": [
                [10, 25, 50, 100, 500, 1000, -1],
                [10, 25, 50, 100, 500, 1000, "All"]
            ],
            dom: 'RlBfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                //'csvHtml5',
                //'pdfHtml5',
                'colvis'
            ],
            columnDefs: [{
                targets: 3,
                orderable: false,
                searchable: false,
            }, ],
            columns: [{
                    data: 'supplier_business_name',
                    name: 'supplier_business_name'
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'expire_date',
                    name: 'expire_date'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'services',
                    name: 'services'
                },
                {
                    data: 'final_total',
                    name: 'final_total'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'status',
                    name: 'status'
                }, 
            ],
        });

        $(document).ready(function() {
            initDateRanger();
        });
    </script>

    <script>
        // currently sale
        var options = {
            series: [
                {
                name: 'subscriptions',
                data: [
                    @foreach ($data['chart'] as $key => $value)
                        {{ $key }},
                    @endforeach
                ]
            } 
            ],
            chart: {
                height: 240,
                type: 'area',
                toolbar: {
                    show: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'category',
                low: 0,
                offsetX: 0,
                offsetY: 0,
                show: false,
                categories: [ 
                    @foreach ($data['chart'] as $key => $value)
                        '{{ $value }}',
                    @endforeach
                ],
                labels: {
                    low: 0,
                    offsetX: 0,
                    show: false,
                },
                axisBorder: {
                    low: 0,
                    offsetX: 0,
                    show: false,
                },
            },
            markers: {
                strokeWidth: 3,
                colors: "#ffffff",
                strokeColors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
                hover: {
                    size: 6,
                }
            },
            yaxis: {
                low: 0,
                offsetX: 0,
                offsetY: 0,
                show: false,
                labels: {
                    low: 0,
                    offsetX: 0,
                    show: false,
                },
                axisBorder: {
                    low: 0,
                    offsetX: 0,
                    show: false,
                },
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0,
                    bottom: -15,
                    top: -40
                }
            },
            colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.5,
                    stops: [0, 80, 100]
                }
            },
            legend: {
                show: false,
            },
            tooltip: {
                x: {
                    format: 'MM'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#subscription_chart"), options);
        chart.render();
    </script>
@endsection
