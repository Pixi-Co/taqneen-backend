@extends('layouts.app')
@section('title', __('report.register_report'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ __('report.register_report') }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @component('components.filters', ['title' => __('report.filters')])
                    <div class="w3-padding">
                        <div class="row">
                            {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'register_report_filter_form']) !!}
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('register_user_id', __('report.user') . ':') !!}
                                    {!! Form::select('register_user_id', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_users')]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('register_status', __('sale.status') . ':') !!}
                                    {!! Form::select('register_status', ['open' => __('cash_register.open'), 'close' => __('cash_register.close')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all')]) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('register_report_date_range', __('report.date_range') . ':') !!}
                                    {!! Form::text('register_report_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'register_report_date_range', 'readonly']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @component('components.widget', ['class' => 'box-primary '])
                    <div class="table-responsive w3-light-gray">
                        <table data-title="{{ __('report.register_report') }}" class="table table-bordered table-striped"
                            id="register_report_table">
                            <thead>
                                <tr>
                                    <th>@trans('report.open_time')</th>
                                    <th>@trans('report.close_time')</th>
                                    <th>@trans('sale.location')</th>
                                    <th>@trans('report.user')</th>
                                    <th>@trans('cash_register.total_card_slips')</th>
                                    <th>@trans('cash_register.total_cheques')</th>
                                    <th>@trans('cash_register.total_cash')</th>
                                    @if (session('business.common_settings.enable_export_money_to_safe_proccess'))
                                        <th>@trans('for_user')</th>
                                        <th>@trans('safe_status')</th>
                                    @endif

                                    <th>@trans('messages.action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcomponent
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="modal fade view_register" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script>
        //Register report
        register_report_table = $('#register_report_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/reports/register-report',
            // datatable

            "autoWidth": true,
            "lengthMenu": [
                [10, 25, 50, 100, 500, 1000, -1],
                [10, 25, 50, 100, 500, 1000, "All"]
            ],
            dom: 'RlBfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'colvis'
            ],
            columnDefs: [{
                targets: [7],
                orderable: false,
                searchable: false
            }],
            columns: [{
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'closed_at',
                    name: 'closed_at'
                },
                {
                    data: 'location_name',
                    name: 'bl.name'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'total_card_slips',
                    name: 'total_card_slips'
                },
                {
                    data: 'total_cheques',
                    name: 'total_cheques'
                },
                {
                    data: 'closing_amount',
                    name: 'closing_amount'
                },
                @if (session('business.common_settings.enable_export_money_to_safe_proccess'))
                {
                    data: 'for_user_id',
                    name: 'for_user_id'
                },
                {
                    data: 'safe_status',
                    name: 'safe_status'
                },
                @endif
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            fnDrawCallback: function(oSettings) {
                __currency_convert_recursively($('#register_report_table'));
            },
        });
    </script>
@endsection
