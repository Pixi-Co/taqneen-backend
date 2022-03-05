@extends('layouts.app')


@section("content")
 

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans('expense.expenses')</h1>
</section>


<div class="page-title hidden">
    @trans('expense.expenses')
</div> 

<!-- Main content -->
<section class="content">

    <div class="text-right">
        <button class="add_btn" onclick="$('.filter').slideToggle(500)" >
            <i class="fa fa-filter"></i> {{ __('report.filters') }}
        </button>
    </div>
    <br>
    <div class="filter w3-round w3-white w3-padding" style="display: none" >
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    {!! Form::label('expense_for', __('expense.expense_for').':') !!}
                    {!! Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_contact_filter',  __('contact.contact') . ':') !!}
                    {!! Form::select('expense_contact_filter', $contacts, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_category_id',__('expense.expense_category').':') !!}
                    {!! Form::select('expense_category_id', $categories, null, ['placeholder' =>
                    __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_category_id']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_date_range', __('report.date_range') . ':') !!}
                    {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'expense_date_range', 'readonly']); !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('expense_payment_status',  __('purchase.payment_status') . ':') !!}
                    {!! Form::select('expense_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                </div>
            </div>
        </div>
    </div> 
    <br>
 
    <div class="w3-display-container"> 
                 @can('expense.access') 
                        <div class="w3-display-topright">
                            <a class="add_btn" href="{{action('ExpenseController@create')}}">
                            <i class="fa fa-plus"></i> @trans('messages.add')</a>
                        </div>
                        <br> 
                        <br> 
                        <br> 
                @endcan
                <div class="table-responsive w3-light-gray">
                    <table data-title="{{ __('expense.all_expenses') }}" 
                    class="table table-bordered table-striped" id="expense_table">
                        <thead>
                            <tr>
                                <th>@trans('messages.action')</th>
                                <th>@trans('messages.date')</th>
                                <th>@trans('purchase.ref_no')</th>
                                <th>@trans('lang_v1.recur_details')</th>
                                <th>@trans('expense.expense_category')</th>
                                <th>@trans('business.location')</th>
                                <th>@trans('sale.payment_status')</th>
                                <th>@trans('product.tax')</th>
                                <th>@trans('sale.total_amount')</th>
                                <th>@trans('purchase.payment_due')
                                <th>@trans('expense.expense_for')</th>
                                <th>@trans('contact.contact')</th>
                                <th>@trans('expense.expense_note')</th>
                                <th>@trans('lang_v1.added_by')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 text-center footer-total">
                                <td colspan="6"><strong>@trans('sale.total'):</strong></td>
                                <td id="footer_payment_status_count"></td>
                                <td></td>
                                <td><span class="display_currency" id="footer_expense_total" data-currency_symbol ="true"></span></td>
                                <td><span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div> 
    </div>

</section>
<!-- /.content -->
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div> 

@endsection

@section("javascript")
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script> 


<script>
    
   //date filter for expense table
   if ($('#expense_date_range').length == 1) {
       $('#expense_date_range').daterangepicker(
           dateRangeSettings,
           function(start, end) {
               $('#expense_date_range').val(
                   start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
               );
               expense_table.ajax.reload();
           }
       );

       $('#expense_date_range').on('cancel.daterangepicker', function(ev, picker) {
           $('#product_sr_date_filter').val('');
           expense_table.ajax.reload();
       });
   }

   //Expense table
   expense_table = $('#expense_table').DataTable({
       processing: true,
       serverSide: true,
       aaSorting: [
           [1, 'desc']
       ],
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
       ajax: {
           url: '/expenses',
           data: function(d) {
               d.expense_for = $('select#expense_for').val();
               d.contact_id = $('select#expense_contact_filter').val();
               d.location_id = $('select#location_id').val();
               d.expense_category_id = $('select#expense_category_id').val();
               d.payment_status = $('select#expense_payment_status').val();
               d.start_date = $('input#expense_date_range')
                   .data('daterangepicker')
                   .startDate.format('YYYY-MM-DD');
               d.end_date = $('input#expense_date_range')
                   .data('daterangepicker')
                   .endDate.format('YYYY-MM-DD');
           },
       },
       columns: [
           { data: 'action', name: 'action', orderable: false, searchable: false },
           { data: 'transaction_date', name: 'transaction_date' },
           { data: 'ref_no', name: 'ref_no' },
           { data: 'recur_details', name: 'recur_details', orderable: false, searchable: false },
           { data: 'category', name: 'ec.name' },
           { data: 'location_name', name: 'bl.name' },
           { data: 'payment_status', name: 'payment_status', orderable: false },
           { data: 'tax', name: 'tr.name' },
           { data: 'final_total', name: 'final_total' },
           { data: 'payment_due', name: 'payment_due' },
           { data: 'expense_for', name: 'expense_for' },
           { data: 'contact_name', name: 'c.name' },
           { data: 'additional_notes', name: 'additional_notes' },
           { data: 'added_by', name: 'usr.first_name' }
       ],
       fnDrawCallback: function(oSettings) {
           var expense_total = sum_table_col($('#expense_table'), 'final-total');
           $('#footer_expense_total').text(expense_total);
           var total_due = sum_table_col($('#expense_table'), 'payment_due');
           $('#footer_total_due').text(total_due);

           $('#footer_payment_status_count').html(
               __sum_status_html($('#expense_table'), 'payment-status')
           );

           __currency_convert_recursively($('#expense_table'));
       },
       createdRow: function(row, data, dataIndex) {
           $(row)
               .find('td:eq(4)')
               .attr('class', 'clickable_td');
       },
   });

   $('select#location_id, select#expense_for, select#expense_contact_filter, select#expense_category_id, select#expense_payment_status').on(
       'change',
       function() {
           expense_table.ajax.reload();
       }
   );

   //Date picker
   $('#expense_transaction_date').datetimepicker({
       format: moment_date_format + ' ' + moment_time_format,
       ignoreReadonly: true,
   });

   $(document).on('click', 'a.delete_expense', function(e) {
       e.preventDefault();
       swal({
           title: LANG.sure,
           text: LANG.confirm_delete_expense,
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
                           expense_table.ajax.reload();
                       } else {
                           toastr.error(result.msg);
                       }
                   },
               });
           }
       });
   });

   $(document).on('change', '.payment_types_dropdown', function() {
       var payment_type = $(this).val();
       var to_show = null;

       $(this)
           .closest('.payment_row')
           .find('.payment_details_div')
           .each(function() {
               if ($(this).attr('data-type') == payment_type) {
                   to_show = $(this);
               } else {
                   if (!$(this).hasClass('hide')) {
                       $(this).addClass('hide');
                   }
               }
           });

       if (to_show && to_show.hasClass('hide')) {
           to_show.removeClass('hide');
           to_show
               .find('input')
               .filter(':visible:first')
               .focus();
       }
   });

</script>

@endsection
