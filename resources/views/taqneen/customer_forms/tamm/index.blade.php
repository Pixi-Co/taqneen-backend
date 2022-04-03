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
<h3>@trans('customers')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@trans('lang.Dashboard')</li>
<li class="breadcrumb-item active">@trans('customers')</li> 
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
                                        @can(find_or_create_p('customer.create'))
                                        <a role="button" href="{{ url('customer-form/subscribe_tamm_model') }}" class="btn btn-primary" >@trans('new_customer_tamm')</a>
                                        @endcan

                                        
                                        
                                        <div class="table-responsive pt-3">
                                            <table class="display" id="advance-4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@trans('company_number')</th>
                                                        <th>@trans('name')</th>
                                                        <th>@trans('enterprise_activity')</th>
                                                        <th>@trans('create_at')</th>
                                                        <th>-</th>
                                                        {{-- <th>@trans('actions')</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $item->company_num }}</td>          
                                                            <td>{{ $item->name_ar }}</td>          
                                                            <td>{{ $item->enterprise_activity }}</td>          
                                                            <td>{{ $item->created_at }}</td>    
                                                            <td>
                                                                <div style="width: 120px" >
                                                                    <a 
                                                                    class="w3-btn w3-card w3-white w3-text-red"
                                                                    style="width: 30px;height: 30px;border-radius: 5em;padding: 5px;"
                                                                    href="{{ url('/customer-pdf') }}/{{ $item->id }}">
                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                    </a>
                                                                    @can('customer_form.edit')
                                                                    <a 
                                                                    class="w3-btn w3-card w3-white w3-text-orange"
                                                                    style="width: 30px;height: 30px;border-radius: 5em;padding: 5px;"
                                                                    href="{{ url('/customer-edit/subscribe_tamm_model') }}/{{ $item->id }}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    @endcan
                                                                    @can('customer_form.remove')
                                                                    <a 
                                                                    class="w3-btn w3-card w3-white w3-text-red"
                                                                    style="width: 30px;height: 30px;border-radius: 5em;padding: 5px;"
                                                                    onclick="destroy('{{ url('customer-delete/subscribe_muqeem_model') }}/{{ $item->id }}')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                    @endcan
                                                                </div>
                                                            </td>      
                                                        </tr> 
                                                    @endforeach
                                                </tbody>
                                                {{-- <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@trans('name')</th>
                                                        <th>@trans('description')</th>
                                                        <th>@trans('parent package')</th>
                                                        <th>@trans('created_by')</th>
                                                        <th>@trans('actions')</th>
                                                    </tr>
                                                </tfoot> --}}
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



@endsection
