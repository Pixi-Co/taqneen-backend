 <!-- Content Header (Page header) -->
 <section class=" hidden">
     <h1>@trans( 'restaurant.modifier_sets' )
         <small>@trans( 'restaurant.manage_your_modifiers' )</small>
     </h1> 
 </section>

 <div class="page-title hidden">
     {{ __('restaurant.modifiers') }}
 </div>

 <!-- Main content -->
 <section class="content">
 
     @can('restaurant.create')
         <div class="">
             <button type="button" class="add_btn btn-modal"
                 data-href="{{ action('Restaurant\ModifierSetsController@create') }}" data-container=".modifier_modal">
                 <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
         </div>
     @endcan
     @can('restaurant.view')
         <div class="table-responsive w3-light-gray">
            <table data-title="{{ __('restaurant.modifiers') }}" class="table table-bordered table-striped" id="modifier_table">
                <thead>
                    <tr>
                        <th>@trans( 'restaurant.modifier_sets' )</th>
                        <th>@trans( 'restaurant.modifiers' )</th>
                        <th>@trans( 'restaurant.products' )</th>
                        <th>@trans( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
         </div>
     @endcan

 </section>
 <!-- /.content -->
 
 <div class="modal fade modifier_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

 <script type="text/javascript">
     $(document).ready(function() {

         $(document).on('click', 'button.remove-modifier-row', function(e) {
             $(this).closest('tr').remove();
         });

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
                         $('div.modifier_modal').modal('hide');
                         toastr.success(result.msg);
                         modifier_table.ajax.reload();
                     } else {
                         toastr.error(result.msg);
                     }
                 }
             });
         });

         //Brands table
         var modifier_table = $('#modifier_table').DataTable({
             processing: true,
             serverSide: true,
             ajax: '/modules/modifiers',
             @include("layouts.partials.datatable_plugin")
             columnDefs: [{
                 "targets": [1, 2, 3],
                 "orderable": false,
                 "searchable": false
             }],
             columns: [{
                     data: 'name',
                     name: 'name'
                 },
                 {
                     data: 'variations',
                     name: 'variations'
                 },
                 {
                     data: 'modifier_products',
                     name: 'modifier_products'
                 },
                 {
                     data: 'action',
                     name: 'action'
                 }
             ],
         });

         $(document).on('click', 'button.edit_modifier_button', function() {

             $("div.modifier_modal").load($(this).data('href'), function() {

                 $(this).modal('show');

                 $('form#edit_form').submit(function(e) {

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
                                 $('div.modifier_modal').modal('hide');
                                 toastr.success(result.msg);
                                 modifier_table.ajax.reload();
                             } else {
                                 toastr.error(result.msg);
                             }
                         }
                     });
                 });
             });
         });

         $(document).on('click', 'button.delete_modifier_button', function() {
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
                                 modifier_table.ajax.reload();
                             } else {
                                 toastr.error(result.msg);
                             }
                         }
                     });
                 }
             });
         });

         $(document).on('click', 'button.add-modifier-row', function() {
             $('table#add-modifier-table').append($(this).data('html'));
         });

         $(document).on('click', 'button.remove_modifier_product', function() {
             swal({
                 title: LANG.sure,
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
             }).then((willDelete) => {
                 if (willDelete) {
                     $(this).closest('tr').remove();
                 }
             });
         });

     }); 
