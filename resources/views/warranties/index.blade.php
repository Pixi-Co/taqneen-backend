 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>@trans('lang_v1.warranties')
     </h1>
 </section>

 <div class="page-title hidden">
     {{ __('lang_v1.warranties') }}
 </div>

 <!-- Main content -->
 <section class="content">
     <div class="">
         <button type="button" class="add_btn btn-modal"
             data-href="{{ action('WarrantyController@create') }}" data-container=".view_modal">
             <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
     </div>
     <div class="table-responsive w3-light-gray">
         <table data-title="{{ __('lang_v1.warranties') }}" class="table table-bordered table-striped"
             id="warranty_table">
             <thead>
                 <tr>
                     <th>@trans( 'lang_v1.name' )</th>
                     <th>@trans( 'lang_v1.description' )</th>
                     <th>@trans( 'lang_v1.duration' )</th>
                     <th>@trans( 'messages.action' )</th>
                 </tr>
             </thead>
         </table>
     </div>

 </section>
 <!-- /.content -->
 <script type="text/javascript">
     $(document).ready(function() {
         //Status table
         var warranty_table = $('#warranty_table').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{ action('WarrantyController@index') }}",
             @include("layouts.partials.datatable_plugin")
             columnDefs: [{
                 "targets": 3,
                 "orderable": false,
                 "searchable": false
             }],
             columns: [{
                     data: 'name',
                     name: 'name'
                 },
                 {
                     data: 'description',
                     name: 'description'
                 },
                 {
                     data: 'duration',
                     name: 'duration'
                 },
                 {
                     data: 'action',
                     name: 'action'
                 },
             ]
         });

         $(document).on('submit', 'form#warranty_form', function(e) {

            if ($(this).attr('listnered') == 1) 
                return 0;
            else {
                $(this).attr('listnered', 1);
            }
             e.preventDefault();
             $(this).find('button[type="submit"]').attr('disabled', true);
             var data = $(this).serialize();

             $.ajax({
                 method: $(this).attr('method'),
                 url: $(this).attr("action"),
                 dataType: "json",
                 data: data,
                 success: function(result) {
                     if (result.success == true) {
                         $('div.view_modal').modal('hide');
                         toastr.success(result.msg);
                         warranty_table.ajax.reload();
                     } else {
                         toastr.error(result.msg);
                     }
                 }
             });
         });
     });
 </script>
