@extends('layouts.app')
@section('title', __('lang_v1.all_sales'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@trans( 'sale.sells')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">

    <div class="text-left">
        <button class="add_btn" onclick="$('.filter').slideToggle(500)" >
            <i class="fa fa-filter"></i> {{ __('report.filters') }}
        </button>
    </div>
    <br>
    <div class="filter w3-round w3-white w3-padding" style="display: none" >
        <div class="row">
            @include('sell.partials.sell_list_filters')
            @if($is_woocommerce)
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                            {!! Form::checkbox('only_woocommerce_sells', 1, false, 
                            [ 'class' => 'input-icheck', 'id' => 'synced_from_woocommerce']); !!} {{ __('lang_v1.synced_from_woocommerce') }}
                            </label>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div> 
    <br>
    @can('sell.create') 
    <div class="text-left">
        <a class="add_btn" href="{{action('SellController@create')}}">
        <i class="fa fa-plus"></i> @trans('messages.add')</a>
    </div>
    <br> 
    <br> 
    <br> 
@endcan
@if(auth()->user()->can('direct_sell.access') ||  auth()->user()->can('view_own_sell_only') ||  auth()->user()->can('view_commission_agent_sell'))
@php
$custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div class="table-responsive w3-light-gray">
    <table data-title="{{ __( 'lang_v1.all_sales') }}" class="table table-bordered table-striped ajax_view" id="sell_table">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll" data-table-id="product_table"></th>       
                <th>@trans('messages.action')</th>
                <th>@trans('messages.date')</th>
                <th>@trans('sale.invoice_no')</th>
                <th>@trans('sale.customer_name')</th>
                <th>@trans('lang_v1.contact_no')</th>
                <th>@trans('sale.location')</th>
                <th>@trans('sale.payment_status')</th>
                <th>@trans('lang_v1.payment_method')</th>
                <th>@trans('sale.total_amount')</th>
                <th>@trans('sale.total_paid')</th>
                <th>@trans('lang_v1.sell_due')</th> 
                <th>@trans('lang_v1.total_items')</th>  
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="2"><strong>@trans('sale.total'):</strong></td>
                <td class="footer_payment_status_count"></td>
                <td class="payment_method_count"></td>
                <td class="footer_sale_total"></td>
                <td class="footer_total_paid"></td>
                <td class="footer_total_remaining"></td>
                <td class="footer_total_sell_return_due"></td>
                <td colspan="2"></td>
                <td class="service_type_count"></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>
</div>
@endif
</section>
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->

@stop

@section('javascript')
<script type="text/javascript">
$(document).ready( function(){
    //Date range as a button
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sell_table.ajax.reload();
        }
    );
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_list_filter_date_range').val('');
        sell_table.ajax.reload();
    });




            $("#selectAll").on("change", function() {
                if (this.checked) {
                    $('#sell_table').find('tr').addClass('selected');
                } else {
                    sell_table.rows('.selected').nodes().to$().removeClass('selected');
                }
                sell_table.$("input[type='checkbox']").attr('checked', this.checked);
            });

    var sell_table = $('#sell_table').DataTable({
        processing: true,
        serverSide: true, 
        @include("layouts.partials.datatable_plugin")
        select: true,
        __buttons: [{
            text: 'Settle Bulk',
            action: function () {
                let rows = sell_table.rows('.selected').data();
                let ids = [];
                $.each(rows, function (i, val) {
                    ids.push(rows[i]['id']);
                });

                console.log(ids)
                var url = "{{ route('shipping.settle.bulk') }}";

                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {
                        ids: ids
                    },
                    dataType: 'json',
                    success: function (result) {
                        if (result.success == true) {
                            sell_table.ajax.reload();
                            // un checkbix selectAll
                            $('#selectAll').attr('checked', false);
                            toastr.success(result.msg);

                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });

            }
        }],
        "ajax": {
            "url": "/sells",
            "data": function (d) {
                if ($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate
                        .format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
                d.is_direct_sale = 1;

                d.location_id = $('#sell_list_filter_location_id').val();
                d.customer_id = $('#sell_list_filter_customer_id').val();
                d.payment_status = $('#sell_list_filter_payment_status').val();
                d.created_by = $('#created_by').val();
                d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                d.service_staffs = $('#service_staffs').val();

                if ($('#shipping_status').length) {
                    d.shipping_status = $('#shipping_status').val();
                }

                if ($('#shipping_company').length) {
                    d.shipping_company = $('#shipping_company').val();
                }

                @if ($is_woocommerce)
                if ($('#synced_from_woocommerce').is(':checked')) {
                    d.only_woocommerce_sells = 1;
                }
                @endif

                if ($('#only_subscriptions').is(':checked')) {
                    d.only_subscriptions = 1;
                }

                d = __datatable_ajax_callback(d);
            }
        }, 
        columns: [
            {
                data: 'settle',
                orderable: false,
                "searchable": false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                "searchable": false
            },
            {
                data: 'transaction_date',
                name: 'transaction_date'
            },
            {
                data: 'invoice_no',
                name: 'invoice_no'
            },
            {
                data: 'conatct_name',
                name: 'conatct_name'
            },
            {
                data: 'mobile',
                name: 'contacts.mobile'
            },
            {
                data: 'business_location',
                name: 'bl.name'
            },
            {
                data: 'payment_status',
                name: 'payment_status'
            },
            {
                data: 'payment_methods',
                orderable: false,
                "searchable": false
            },
            {
                data: 'final_total',
                name: 'final_total'
            },
            {
                data: 'total_paid',
                name: 'total_paid',
                "searchable": false
            },
            {
                data: 'total_remaining',
                name: 'total_remaining'
            }, 
            {
                data: 'total_items',
                name: 'total_items',
                "searchable": false
            },   
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#sell_table'));
        },
        "footerCallback": function (row, data, start, end, display) {
            var footer_sale_total = 0;
            var footer_total_paid = 0;
            var footer_total_remaining = 0;
            var footer_total_sell_return_due = 0;
            for (var r in data) {
                footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(
                    data[r].final_total).data('orig-value')) : 0;
                footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(
                    data[r].total_paid).data('orig-value')) : 0;
                footer_total_remaining += $(data[r].total_remaining).data('orig-value') ?
                    parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                footer_total_sell_return_due += $(data[r].return_due).data('orig-value') ?
                    parseFloat($(data[r].return_due).data('orig-value')) : 0;
            }

            $('.footer_total_sell_return_due').html(__currency_trans_from_en(
                footer_total_sell_return_due));
            $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining));
            $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
            $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total));

            $('.footer_payment_status_count').html(__count_status(data, 'payment_status'));
            $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
            $('.payment_method_count').html(__count_status(data, 'payment_methods'));
        },
        createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(6)').attr('class', 'clickable_td');
        }
    });
    
    //Delete Sale
    $(document).on('click', '.delete-sale', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).attr('href');
                var is_suspended = $(this).hasClass('is_suspended');
                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            if (typeof sell_table !== 'undefined') {
                                sell_table.ajax.reload();
                            }
                            if (typeof pending_repair_table !== 'undefined') {
                                pending_repair_table.ajax.reload();
                            }
                            //Displays list of recent transactions
                            if (typeof get_recent_transactions !== 'undefined') {
                                get_recent_transactions('final', $('div#tab_final'));
                                get_recent_transactions('draft', $('div#tab_draft'));
                            }
                            if (is_suspended) {
                                $('.view_modal').modal('hide');
                            }
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

            $(document).on('change',
                '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status, #shipping_company',
                function() {
                    sell_table.ajax.reload();
                });
            @if ($is_woocommerce)
                $('#synced_from_woocommerce').on('ifChanged', function(event){
                sell_table.ajax.reload();
                });
            @endif

            $('#only_subscriptions').on('ifChanged', function(event) {
                sell_table.ajax.reload();
            });
        });

        
    </script>
    {{-- <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script> --}}
@endsection
