<script type="text/javascript">
    //Date range as a button
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function(start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(
                moment_date_format));
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

    var sell_table = {};
    if ($('#sell_table').length > 0)
    sell_table =  $('#sell_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/sub/report/subscription?{{ isset($query)? $query : '' }}',
        @include("layouts.partials.datatable_plugin")
        "columns": [{
                "data": "transaction_date"
            },
            {
                "data": "product_id"
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
            {
                "data": "is_stop"
            },
            {
                "data": "contacts"
            },
            {
                "data": "actions"
            },
        ],
        "drawCallback": function(settings) {
            __currency_convert_recursively($("table"));
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
                            if (typeof get_recent_transactions !==
                                'undefined') {
                                get_recent_transactions('final', $(
                                    'div#tab_final'));
                                get_recent_transactions('draft', $(
                                    'div#tab_draft'));
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
    $('#synced_from_woocommerce').on('ifChanged', function(event) {
        sell_table.ajax.reload();
    });

    $('#only_subscriptions').on('ifChanged', function(event) {
        sell_table.ajax.reload();
    }); 


    function renewSubscription(id) {
        var data = {
            id: id,
            _token: '{{ csrf_token() }}'
        };
        $.post("{{ url('/sub/renew-subscription') }}", $.param(data), function(res){
            if (res.status == 1) {
                toastr.success(res.message);
                sell_table.ajax.reload();
            } else {
                toastr.error(res.message);
            }
        });
    }
</script>
