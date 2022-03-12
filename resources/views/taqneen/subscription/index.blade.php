@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
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
                                        <h5>@lang('lang.Opportunities')</h5>
                                    </div> --}}
                                    <div class="card-body">
                                        <a role="button" href="/subscriptions/create" class="btn btn-primary" >@trans('add new')</a>
                                        <div class="table-responsive">
                                            <table class="display" id="subscriptionTable">
                                                <thead>
                                                    <tr> 
                                                        <th>@trans('company name')</th>
                                                        <th>@trans('first name')</th>
                                                        <th>@trans('expire date')</th>
                                                        <th>@trans('phone')</th>
                                                        <th>@trans('services')</th>
                                                        <th>@trans('final total')</th>
                                                        <th>@trans('sales commission agent')</th>
                                                        <th>@trans('status')</th> 
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
                                                        <th>@trans('phone')</th>
                                                        <th>@trans('services')</th>
                                                        <th>@trans('final total')</th>
                                                        <th>@trans('sales commission agent')</th>
                                                        <th>@trans('status')</th> 
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

<script>

    function addNote(id) {
        $('#subscriptionNote' + id).modal('show');
    }


    var subscriptionTable = $('#subscriptionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/subscriptions',
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
            { data: 'supplier_business_name', name: 'supplier_business_name' },
            { data: 'first_name', name: 'first_name' },
            { data: 'expire_date', name: 'expire_date' },
            { data: 'mobile', name: 'mobile' },
            { data: 'services', name: 'services' },
            { data: 'final_total', name: 'final_total' },
            { data: 'created_by', name: 'created_by' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
            { data: 'share', name: 'share' },
        ],
    });
</script>
@endsection
