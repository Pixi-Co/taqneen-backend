 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>@trans( 'restaurant.tables' )
         <small>@trans( 'restaurant.manage_your_tables' )</small>
     </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
 </section>

 <div class="page-title hidden">
     {{ __('restaurant.tables') }}
 </div>

 <!-- Main content -->
 <section class="content">
 
     @can('restaurant.create')
         <div class="">
             <button type="button" class="add_btn btn-modal"
                 data-href="{{ action('Restaurant\TableController@create') }}" data-container=".tables_modal">
                 <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
         </div>
     @endcan
     @can('restaurant.view')
         <div class="table-responsive w3-light-gray"  >
            <table data-title="{{__( 'restaurant.tables' )}}" 
            class="table table-bordered table-striped" 
            id="tables_table">
                <thead>
                    <tr>
                        <th>@trans( 'restaurant.table' )</th>
                        <th>@trans( 'purchase.business_location' )</th>
                        <th>@trans( 'restaurant.description' )</th>
                        <th>@trans( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
         </div>
     @endcan

     <div class="modal fade tables_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>
 <!-- /.content -->
 
 <script type="text/javascript">
     $(document).ready(function() {

         $(document).on('submit', 'form#table_add_form', function(e) {

            if ($(this).attr('listnered') == 1) 
                return 0;
            else {
                $(this).attr('listnered', 1);
            }
             e.preventDefault();
             var data = $(this).serialize();

             $.ajax({
                 method: "POST",
                 url: $(this).attr("action"),
                 dataType: "json",
                 data: data,
                 success: function(result) {
                     if (result.success == true) {
                         $('div.tables_modal').modal('hide');
                         toastr.success(result.msg);
                         tables_table.ajax.reload();
                     } else {
                         toastr.error(result.msg);
                     }
                 }
             });
         });

         //Brands table
         var tables_table = $('#tables_table').DataTable({
             processing: true,
             serverSide: true,
             ajax: '/modules/tables',
             @include("layouts.partials.datatable_plugin")
             columnDefs: [{
                 "targets": 3,
                 "orderable": false,
                 "searchable": false
             }],
             columns: [{
                     data: 'name',
                     name: 'res_tables.name'
                 },
                 {
                     data: 'location',
                     name: 'BL.name'
                 },
                 {
                     data: 'description',
                     name: 'description'
                 },
                 {
                     data: 'action',
                     name: 'action'
                 }
             ],
         });

         $(document).on('click', 'button.edit_table_button', function() {

             $("div.tables_modal").load($(this).data('href'), function() {

                 $(this).modal('show');

                 $('form#table_edit_form').submit(function(e) {

                    if ($(this).attr('listnered') == 1) 
                        return 0;
                    else {
                        $(this).attr('listnered', 1);
                    }
                     e.preventDefault();
                     var data = $(this).serialize();

                     $.ajax({
                         method: "POST",
                         url: $(this).attr("action"),
                         dataType: "json",
                         data: data,
                         success: function(result) {
                             if (result.success == true) {
                                 $('div.tables_modal').modal('hide');
                                 toastr.success(result.msg);
                                 tables_table.ajax.reload();
                             } else {
                                 toastr.error(result.msg);
                             }
                         }
                     });
                 });
             });
         });

         $(document).on('click', 'button.delete_table_button', function() {
             swal({
                 title: LANG.sure,
                 text: LANG.confirm_delete_table,
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
                             if (result.success == true) {
                                 toastr.success(result.msg);
                                 tables_table.ajax.reload();
                             } else {
                                 toastr.error(result.msg);
                             }
                         }
                     });
                 }
             });
         });
     });
 </script> 
