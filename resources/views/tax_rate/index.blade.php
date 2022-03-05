 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>@trans( 'tax_rate.tax_rates' )
         <small>@trans( 'tax_rate.manage_your_tax_rates' )</small>
     </h1>
 </section>

 <div class="page-title hidden">
     {{ __('tax_rate.tax_rates') }}
 </div>

 <!-- Main content -->
 <section class="content">

     @can('tax_rate.create')
         <div class="text-right">
             <button type="button" class="add_btn btn-modal" data-href="{{ action('TaxRateController@create') }}"
                 data-container=".tax_rate_modal">
                 <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
         </div>
     @endcan
     @can('tax_rate.view')
         <div class="table-responsive w3-light-gray">
             <table data-title="{{ __('tax_rate.all_your_tax_rates') }}" class="table table-bordered table-striped"
                 id="tax_rates_table">
                 <thead>
                     <tr>
                         <th>@trans( 'tax_rate.name' )</th>
                         <th>@trans( 'tax_rate.rate' )</th>
                         <th>@trans( 'einvoice_tax_code' )</th>
                         <th>@trans( 'messages.action' )</th>
                     </tr>
                 </thead>
             </table>
         </div>
     @endcan
     <br>
     <!--
     @can('tax_rate.create')
         <div class="text-right">
             <button type="button" class="add_btn btn-modal" data-href="{{ action('GroupTaxController@create') }}"
                 data-container=".tax_group_modal">
                 <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
         </div>
     @endcan
     @can('tax_rate.view')
         <div class="table-responsive w3-light-gray">
             <table
                 data-title="@trans( 'tax_rate.tax_groups' ) ( @trans('lang_v1.combination_of_taxes') )"
                 class="table table-bordered table-striped" id="tax_groups_table">
                 <thead>
                     <tr>
                         <th>@trans( 'tax_rate.name' )</th>
                         <th>@trans( 'tax_rate.rate' )</th>
                         <th>@trans( 'tax_rate.sub_taxes' )</th>
                         <th>@trans( 'messages.action' )</th>
                     </tr>
                 </thead>
             </table>
         </div>
     @endcan
        -->

     <div class="modal fade tax_rate_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>
     <div class="modal fade tax_group_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>


 <script>
     
    //Tax Rates table
    var tax_rates_table = $('#tax_rates_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/tax-rates',
        @include("layouts.partials.datatable_plugin")
        columnDefs: [{
            targets: 2,
            orderable: false,
            searchable: false,
        }, ],
    });

    $(document).on('submit', 'form#tax_rate_add_form', function(e) {
        e.preventDefault();

        if ($(this).attr('listnered') == 1) 
            return 0;
        else {
            $(this).attr('listnered', 1);
        }

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
                    $('div.tax_rate_modal').modal('hide');
                    toastr.success(result.msg);
                    tax_rates_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.edit_tax_rate_button', function() {
        $('div.tax_rate_modal').load($(this).data('href'), function() {
            $(this).modal('show');

            $('form#tax_rate_edit_form').submit(function(e) {

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
                            $('div.tax_rate_modal').modal('hide');
                            toastr.success(result.msg);
                            tax_rates_table.ajax.reload();
                            tax_groups_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });
    });

    $(document).on('click', 'button.delete_tax_rate_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_tax_rate,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            tax_rates_table.ajax.reload();
                            tax_groups_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    //End: CRUD for tax Rate
    
    //Tax Rates table
    var tax_groups_table = $('#tax_groups_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/group-taxes',
        @include("layouts.partials.datatable_plugin")
        columnDefs: [{
            targets: [2, 3],
            orderable: false,
            searchable: false,
        }, ],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'amount', name: 'amount' },
            { data: 'sub_taxes', name: 'sub_taxes' },
            { data: 'action', name: 'action' },
        ],
    });
    $('.tax_group_modal').on('shown.bs.modal', function() {
        $('.tax_group_modal')
            .find('.select2')
            .each(function() {
                __select2($(this));
            });
    });

    $(document).on('submit', 'form#tax_group_add_form', function(e) {
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
                    $('div.tax_group_modal').modal('hide');
                    toastr.success(result.msg);
                    tax_groups_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('submit', 'form#tax_group_edit_form', function(e) {
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
                    $('div.tax_group_modal').modal('hide');
                    toastr.success(result.msg);
                    tax_groups_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.delete_tax_group_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_tax_group,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            tax_groups_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
 </script>
