@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>@trans('subscriptions')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@trans('dashboard')</li>
<li class="breadcrumb-item active">@trans('subscriptions')</li> 
@endsection

@section('content') 
    <div class="container-fluid">
        <div class="row"> 
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">

                 </div><!-- /.container-fluid -->
                </section>
                <section>
                    <section class="content">
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    
                                    {{-- <div class="card-header">
                                        <h5>@trans('lang.Opportunities')</h5>
                                    </div> --}}
                                    <div class="card-body">
                                        @include("taqneen.subscription.filter")
                                        <br>
                                        @can(find_or_create_p('subscription.create'))
                                        <a role="button" href="/subscriptions/create" class="btn btn-primary" >@trans('add new')</a>
                                        @endcan
                                        @can(find_or_create_p('subscription.import'))
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            @trans('subscription import excel')
                                         </button>
                                        @endcan
                                        @can(find_or_create_p('subscription.export'))
                                        <button type="button" class="btn btn-primary" onclick="exportExcel()" >
                                            @trans('subscription export excel')
                                         </button>
                                        @endcan
                                         <div class="table-responsive">
                                             <br>
                                            <table class="display" id="subscriptionTable">
                                                <thead>
                                                    <tr> 
                                                        <th>@trans('company name')</th>
                                                        <th>@trans('first name')</th>
                                                        <th>@trans('expire date')</th>
                                                        <th>@trans('accountant no')</th>
                                                        <th>@trans('services')</th>
                                                        <th>@trans('final total')</th>
                                                        <th>@trans('sales commission agent')</th>
                                                        <th>@trans('status')</th> 
                                                        <th>@trans('payment_status')</th>  
                                                        <th>@trans('actions')</th>
                                                        <th>@trans('share')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>@trans('company name')</th>
                                                        <th>@trans('first name')</th>
                                                        <th>@trans('expire date')</th>
                                                        <th>@trans('accountant no')</th>
                                                        <th>@trans('services')</th>
                                                        <th>@trans('final total')</th>
                                                        <th>@trans('sales commission agent')</th>
                                                        <th>@trans('status')</th> 
                                                        <th>@trans('payment_status')</th>  
                                                        <th>@trans('actions')</th>
                                                        <th>@trans('share')</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div><!-- /.row -->
                        </div><!-- /.container-fluid -->

                      </section>

                </section>
            </div>

        </div>
    </div>

     <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title " id="staticBackdropLabel">@trans('subscriptions import excel')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="lead"> @trans('pleas download template file ')</p>
          <a  href="/subscriptions-download" class="btn btn-primary">@trans('download temblate')</a>
        </div>
        <div class="modal-footer">
            <!-- Button trigger modal -->
            <button id="next" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
               @trans('next')
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close_') }}</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal " id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">@trans('subscriptions import excel')</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/subscriptions-upload_file" method="post" enctype="multipart/form-data">
            @csrf
           @method('post')
        <div class="modal-body">
            <p class="lead"> @trans(' now upload  file ')</p>
                <div class="form-group col-md-12 pt-3">
                    <input type="file" name="import_file"  class="form-control" placeholder="@trans('file ')" >

                </div>
        </div>
        <div class="modal-footer">
            <input type="submit" value="@trans('submit')" class="btn btn-primary float-right" data-bs-original-title="" title="">
            <button id="back" type="button" class="btn btn-info" data-bs-dismiss="modal">@trans('back')</button>

        </div>
    </form>

      </div>
    </div>
  </div>


<script type="text/javascript">
var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection




@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/jszip.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/pdfmake.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/vfs_fonts.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.select.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.html5.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/buttons.print.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
<script src="{{ url('/assets') }}/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
<script>

    function addNote(id) {
        $('#subscriptionNote' + id).modal('show');
    }

    function filter() {
        var data = {
            service_id: $('.service_id').val(),
            user_id: $('.user_id').val(),
            subscription_type: $('.subscription_type').val(),
            payment_status: $('.payment_status').val(),
            transaction_date_start: $('.transaction_date').attr('data-start'),
            transaction_date_end: $('.transaction_date').attr('data-end'),
            expire_date_end: $('.expire_date').attr('data-end'),
            expire_date_start: $('.expire_date').attr('data-start'),
            
            payment_date_end: $('.payment_date').attr('data-end'),
            payment_date_start: $('.payment_date').attr('data-start'),

            register_date_end: $('.register_date').attr('data-end'),
            register_date_start: $('.register_date').attr('data-start'),
        };
        subscriptionTable.ajax.url('/subscriptions-data?' + $.param(data));
        subscriptionTable.ajax.reload();
    }

    function clearSearch() {
        $('.service_id').val('');
        $('.subscription_type').val('');

        $('.transaction_date').val('');
        $('.transaction_date').attr('data-start', '');
        $('.transaction_date').attr('data-end', '');
        
        $('.expire_date').val('');
        $('.expire_date').attr('data-start', '');
        $('.expire_date').attr('data-end', '');
        
        $('.payment_date').val('');
        $('.payment_date').attr('data-start', '');
        $('.payment_date').attr('data-end', '');
        
        $('.register_date').val('');
        $('.register_date').attr('data-start', '');
        $('.register_date').attr('data-end', '');

        $('.user_id').val('');
        subscriptionTable.ajax.url('/subscriptions-data');
        subscriptionTable.ajax.reload();
    }

    function exportExcel() {
        var data = {
            service_id: $('.service_id').val(),
            user_id: $('.user_id').val(),
            subscription_type: $('.subscription_type').val(),
            payment_status: $('.payment_status').val(),
            transaction_date_start: $('.transaction_date').attr('data-start'),
            transaction_date_end: $('.transaction_date').attr('data-end'),
            expire_date_end: $('.expire_date').attr('data-end'),
            expire_date_start: $('.expire_date').attr('data-start'),
            
            payment_date_end: $('.payment_date').attr('data-end'),
            payment_date_start: $('.payment_date').attr('data-start'),

            register_date_end: $('.register_date').attr('data-end'),
            register_date_start: $('.register_date').attr('data-start'),
        };
 
        var href = "{{ url('/subscriptions-export') }}?" + $.param(data);
        window.location = href;
        toastr.success('@trans("done")');
        /*$.get("{{ url('/subscriptions-export') }}?" + $.param(data), function(res){

        });*/
    }
 
    var subscriptionTable = $('#subscriptionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/subscriptions-data',
        "autoWidth": true,
        "lengthMenu": [
            [10, 25, 50, 100, 500, 1000, -1],
            [10, 25, 50, 100, 500, 1000, "All"]
        ],
        dom: 'RlBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            //'csvHtml5',
            //'pdfHtml5',
            'colvis'
        ],
        columnDefs: [{
            targets: 9,
            orderable: false,
            searchable: false,
        },{
            targets: 10,
            orderable: false,
            searchable: false,
        },  ],
        columns: [
            { data: 'supplier_business_name', name: 'contacts.supplier_business_name' },
            { data: 'first_name', name: 'contacts.first_name' },
            { data: 'expire_date', name: 'transactions.expire_date' },
            { data: 'custom_field1', name: 'contacts.custom_field1' },
            { data: 'services', name: 'services' },
            { data: 'final_total', name: 'transactions.final_total' },
            { data: 'created_by', name: 'transactions.created_by' },
            { data: 'status', name: 'transactions.status' },
            { data: 'shipping_custom_field_2', name: 'transactions.shipping_custom_field_2' }, 
            { data: 'action', name: 'action' },
            { data: 'share', name: 'share' },
        ],
    });

    $(document).ready(function(){
        initDateRanger();
    });
</script>

<script>
    $(document).ready(function() {
        $('#next').click(function(){
            $('#staticBackdrop').hide();
            $('#staticBackdrop2').show();
        });
        $('#back').click(function(){
            $('#staticBackdrop2').hide();
            $('#staticBackdrop').show();
        });

        clearSearch();
    })
</script>
@endsection
