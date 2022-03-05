 <div class="page-title hidden">
     @trans( 'expense.expense_categories' )
 </div>

 <!-- Main content -->
 <section class="content w3-display-container">

     <div class=" w3-display-topright">
         <button type="button" class="add_btn btn-modal" data-href="{{ action('ExpenseCategoryController@create') }}"
             data-container=".expense_category_modal">
             <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
     </div>
     <br>
     <br>
     <br>
     <div class="table-responsive w3-light-gray">
         <table data-title="{{ __('expense.all_your_expense_categories') }}"
             class="table table-bordered table-striped" id="expense_category_table">
             <thead>
                 <tr>
                     <th>@trans( 'expense.category_name' )</th>
                     <th>@trans( 'expense.category_code' )</th>
                     <th>@trans( 'messages.action' )</th>
                 </tr>
             </thead>
         </table>
     </div>

     <div class="modal fade expense_category_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>
 <!-- /.content -->

 <script class="expense-category-script" >
     //Expense category table
     var expense_cat_table = $('#expense_category_table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '/expense-categories',
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
             targets: 2,
             orderable: false,
             searchable: false,
         }, ],
     });
 
     $(document).on('submit', 'form#expense_category_add_form', function(e) {

        if ($(this).attr('listnered') == 1) 
            return 0;
        else {
            $(this).attr('listnered', 1);
        }
         e.preventDefault();
         var data = $(this).serialize();

         alert('expense category ajax');
         $.ajax({
             method: 'POST',
             url: $(this).attr('action'),
             dataType: 'json',
             data: data,
             success: function(result) {
                 if (result.success === true) {
                     $('div.expense_category_modal').modal('hide');
                     toastr.success(result.msg);
                     expense_cat_table.ajax.reload();
                 } else {
                     toastr.error(result.msg);
                 }
             },
         });
     });
     $(document).on('click', 'button.delete_expense_category', function() {
         swal({
             title: LANG.sure,
             text: LANG.confirm_delete_expense_category,
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
                         if (result.success === true) {
                             toastr.success(result.msg);
                             expense_cat_table.ajax.reload();
                         } else {
                             toastr.error(result.msg);
                         }
                     },
                 });
             }
         });
     });
 </script>
