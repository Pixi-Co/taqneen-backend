 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>@trans( 'unit.units' )
         <small>@trans( 'unit.manage_your_units' )</small>
     </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
 </section>

 <div class="page-title hidden">
     {{ __('unit.units') }}
 </div>

 <!-- Main content -->
 <section class="content">
     @can('unit.create')
         <div class="">
             <button type="button" class="add_btn btn-modal" data-href="{{ action('UnitController@create') }}"
                 data-container=".unit_modal">
                 <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
         </div>
     @endcan
     @can('unit.view')
         <div class="table-responsive w3-light-gray">
             <table data-title="{{ __('unit.units') }}" class="table table-bordered table-striped" id="unit_table">
                 <thead>
                     <tr>
                         <th>@trans( 'unit.name' )</th>
                         <th>@trans( 'unit.short_name' )</th>
                         <th>@trans( 'unit.allow_decimal' ) @show_tooltip(__('tooltip.unit_allow_decimal'))</th>
                         <th>@trans( 'einvoice_unit_code' ) @include("layouts.partials.tooltip", ['text' => __('List of unit types allowed as part of the invoice line information as part of the document submission.')])</th>
                         <th>@trans( 'messages.action' )</th>
                     </tr>
                 </thead>
             </table>
         </div>
     @endcan

     <div class="modal fade unit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>
 <!-- /.content -->
 
<script>
    
    //Start: CRUD for unit
    //Unit table
    var units_table = $('#unit_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/units',
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
            targets: 3,
            orderable: false,
            searchable: false,
        }, ],
        columns: [
            { data: 'actual_name', name: 'actual_name' },
            { data: 'short_name', name: 'short_name' },
            { data: 'allow_decimal', name: 'allow_decimal' },
            { data: 'einvoice_unit_code', name: 'einvoice_unit_code' },
            { data: 'action', name: 'action' },
        ],
    });

    $(document).on('submit', 'form#unit_add_form', function(e) {

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
                    $('div.unit_modal').modal('hide');
                    toastr.success(result.msg);
                    units_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button.edit_unit_button', function() {
        $('div.unit_modal').load($(this).data('href'), function() {
            $(this).modal('show');

            $('form#unit_edit_form').submit(function(e) {

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
                            $('div.unit_modal').modal('hide');
                            toastr.success(result.msg);
                            units_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });
    });

    $(document).on('click', 'button.delete_unit_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_unit,
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
                            units_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
</script>
