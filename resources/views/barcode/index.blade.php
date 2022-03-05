 

    <!-- Main content -->
    <section class="content">
        <div class="text-right">
            <button type="button" class="add_btn btn-modal" data-href="{{ action('BarcodeController@create') }}"
                data-container=".barcodes_modal">
                <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>

        </div>
        <div class="table-responsive w3-light-gray">
            <table data-title="{{ __('barcode.all_your_barcode') }}" class="table table-bordered table-striped" id="barcode_table">
                <thead>
                    <tr>
                        <th>@trans('barcode.setting_name')</th>
                        <th>@trans('barcode.setting_description')</th>
                        <th>@trans('messages.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>
    
    <div class="modal fade barcodes_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>


    <!-- /.content --> 
    <script type="text/javascript">
        $(document).ready(function() {
            var barcode_table = $('#barcode_table').DataTable({
                processing: true,
                serverSide: true,
                buttons: [],
                ajax: '/barcodes',
                @include("layouts.partials.datatable_plugin")
                bPaginate: false,
                columnDefs: [{
                    "targets": 2,
                    "orderable": false,
                    "searchable": false
                }]
            });
            $(document).on('click', 'button.delete_barcode_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_barcode,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result) {
                                if (result.success === true) {
                                    toastr.success(result.msg);
                                    barcode_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
            $(document).on('click', 'button.set_default', function() {
                if ($(this).attr('listnered') == 1) 
                    return 0;
                else {
                    $(this).attr('listnered', 1);
                }
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: "get",
                    url: href,
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success === true) {
                            toastr.success(result.msg);
                            barcode_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });


            $(document).on('click', 'button.edit_barcode_button', function() {
                $('div.barcodes_modal').load($(this).data('href'), function() {
                    $(this).modal('show');
        
                    $('form#edit_barcode_settings_form').submit(function(e) {
                        if ($(this).attr('listnered') == 1) 
                            return 0;
                        else {
                            $(this).attr('listnered', 1);
                        }
                        e.preventDefault();
                        $(this)
                            .find('button[type="submit"]')
                            .attr('disabled', true);
                        var data = $(this).serialize();
        
                        $.ajax({
                            method: 'POST',
                            url: $(this).attr('action'),
                            dataType: 'json',
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    $('div.barcodes_modal').modal('hide');
                                    toastr.success(result.msg);
                                    barcode_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    });
                });
            });


            $(document).on('submit', 'form#add_barcode_settings_form', function(e) {
                if ($(this).attr('listnered') == 1) 
                    return 0;
                else {
                    $(this).attr('listnered', 1);
                }
                e.preventDefault();
                $(this)
                    .find('button[type="submit"]')
                    .attr('disabled', true);
                var data = $(this).serialize();
        
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.barcodes_modal').modal('hide');
                            toastr.success(result.msg);
                            barcode_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });

        });
    </script> 
