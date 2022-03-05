 <section class="content-header hidden">
     <h1>@trans( 'invoice.invoice_settings' )
         <small>@trans( 'invoice.manage_your_invoices' )</small>
     </h1>
 </section>
 

 <!-- Main content -->
 <section class="content">
     <div class="row">
         <div class="col-md-12">
             <!-- Custom Tabs -->
             <div class="nav-tabs-custom">
                 <ul class="hidden">
                     <li class="active"><a href="#tab_1" data-toggle="tab"
                             aria-expanded="true">@trans('invoice.invoice_schemes')</a></li>
                     <li class=""><a href="#tab_2" data-toggle="tab"
                             aria-expanded="false">@trans('invoice.invoice_layouts')</a></li>
                 </ul>
                 <div class="">

                     @if (request()->tab == '1')
                     <div class=" page-title hidden">
                        @trans( 'invoice.all_your_invoice_schemes' )
                     </div>
                         <div class="w3-padding">
                             <div class="">
                                 <div class="text-right">
                                     <button type="button" class="add_btn btn-modal "
                                         data-href="{{ action('InvoiceSchemeController@create') }}"
                                         data-container=".invoice_modal">
                                         <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
                                 </div>
                             </div>
                             <br>
                             <div class="">
                                 <div class="">
                                     <div class="table-responsive w3-light-gray">
                                         <table data-title="@trans( 'invoice.all_your_invoice_schemes' )"
                                             class="table table-bordered table-striped" id="invoice_table">
                                             <thead>
                                                 <tr>
                                                     <th>@trans( 'invoice.name' )
                                                         @show_tooltip(__('tooltip.invoice_scheme_name'))</th>
                                                     <th>@trans( 'invoice.prefix' )
                                                         @show_tooltip(__('tooltip.invoice_scheme_prefix'))</th>
                                                     <th>@trans( 'invoice.start_number' )
                                                         @show_tooltip(__('tooltip.invoice_scheme_start_number'))</th>
                                                     <th>@trans( 'invoice.invoice_count' )
                                                         @show_tooltip(__('tooltip.invoice_scheme_count'))</th>
                                                     <th>@trans( 'invoice.total_digits' )
                                                         @show_tooltip(__('tooltip.invoice_scheme_total_digits'))</th>
                                                     <th>@trans( 'messages.action' )</th>
                                                 </tr>
                                             </thead>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @elseif (request()->tab == '2')
                         <!-- /.tab-pane -->
                         <div class="w3-padding">
                             <div class="row">
                                 <div class="w3-large page-title hidden">
                                     @trans( 'invoice.all_your_invoice_layouts' )
                                 </div>
                                 <div class="text-right">
                                     <a class="add_btn" target="_blank"
                                         href="{{ action('InvoiceLayoutController@create') }}">
                                         <i class="fa fa-plus"></i> @trans( 'messages.add' )</a>
                                 </div>
                                 <div class="row">
                                     @foreach ($invoice_layouts as $layout)
                                         <div class="col-sm-6 w3-display-container" style="padding: 5px">
                                             <div 
                                             class="w3-padding w3-round w3-white icon-link w3-border w3-border-green">
                                                 <div class="w3-row">
                                                     <div class="col-sm-2 col-xs-2 text-left">
                                                        <a target="_blank" href="{{ action('InvoiceLayoutController@edit', [$layout->id]) }}">
                                                            <img 
                                                            src="{{ asset('/images/invoice.png') }}" class="w3-block"
                                                            alt="">
                                                         </a>
                                                     </div>
                                                     
                                                     <div class="col-sm-9 col-xs-9 text-left">
                                                        <div class="w3-large">
                                                            <a target="_blank" href="{{ action('InvoiceLayoutController@edit', [$layout->id]) }}">
                                                                <i class="fas fa-newspaper new-theme-text"></i> 
                                                                {{ $layout->name }}
                                                            </a>
                                                        </div>
                                                        <p>
                                                           @if ($layout->locations->count())
                                                               <span class="link-des">
                                                                   <b class="hidden">@trans('invoice.used_in_locations'): </b>
                                                                   <i class="fa fa-map-marker new-theme-text"></i> 
                                                                   @foreach ($layout->locations as $location)
                                                                       <span class="label new-theme w3-text-white" style="margin: 3px" >
                                                                            {{ $location->name }}
                                                                       </span>
                                                                       @if (!$loop->last)
                                                                           
                                                                       @endif 
                                                                   @endforeach
                                                               </span>
                                                           @endif
                                                       </p>
      
                                                       <div class="w3-display-topright">
                                                           @if ($layout->is_default)
                                                               <span class="badge bg-green">@trans("barcode.default")</span>
                                                           @endif
                                                       </div>
                                                     </div>
                                                 </div> 
                                             </div> 
                                         </div>
                                         @if ($loop->iteration % 4 == 0) 
                                         @endif
                                     @endforeach
                                 </div>
                             </div>
                             <br>
                         </div>
                     @endif

                     <!-- /.tab-pane -->
                 </div>
                 <!-- /.tab-content -->
             </div>
             <!-- nav-tabs-custom -->
         </div>
     </div>

     <div class="modal fade invoice_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>
     <div class="modal fade invoice_edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>
 <!-- /.content -->

 <script>
     var invoice_table = $('#invoice_table').DataTable({
         processing: true,
         serverSide: true,
         bPaginate: false,
         ajax: '/invoice-schemes',
         @include("layouts.partials.datatable_plugin")
         columnDefs: [{
             targets: 4,
             orderable: false,
             searchable: false,
         }, ],
     });
     $(document).on('submit', 'form#invoice_scheme_add_form', function(e) {

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
                     $('div.invoice_modal').modal('hide');
                     $('div.invoice_edit_modal').modal('hide');
                     toastr.success(result.msg);
                     invoice_table.ajax.reload();
                 } else {
                     toastr.error(result.msg);
                 }
             },
         });
     });
     $(document).on('click', 'button.set_default_invoice', function() {

        if ($(this).attr('listnered') == 1) 
            return 0;
        else {
            $(this).attr('listnered', 1);
        }
         var href = $(this).data('href');
         var data = $(this).serialize();

         $.ajax({
             method: 'get',
             url: href,
             dataType: 'json',
             data: data,
             success: function(result) {
                 if (result.success === true) {
                     toastr.success(result.msg);
                     invoice_table.ajax.reload();
                 } else {
                     toastr.error(result.msg);
                 }
             },
         });
     });
     $('.invoice_edit_modal').on('shown.bs.modal', function() {
         show_invoice_preview();
     });
     $(document).on('click', 'button.delete_invoice_button', function() {
         swal({
             title: LANG.sure,
             text: LANG.delete_invoice_confirm,
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
                             invoice_table.ajax.reload();
                         } else {
                             toastr.error(result.msg);
                         }
                     },
                 });
             }
         });
     });
 </script>
