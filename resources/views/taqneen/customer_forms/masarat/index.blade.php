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
                                        <a role="button" href="{{ url('customer-form/subscribe_masarat_model') }}" class="btn btn-primary" >@trans('new_customer_masarat')</a>
                                        @endcan

                                        
                                        
                                        <div class="table-responsive pt-3">
                                            <table class="display" id="advance-4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@trans('company_number')</th>
                                                        <th>@trans('name')</th>
                                                        <th>@trans('commercial_number')</th>
                                                        <th>@trans('release_date')</th>
                                                        <th>@trans('end_date')</th>
                                                        <th>@trans('create_at')</th>
                                                        {{-- <th>@trans('actions')</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $data->company_num }}</td>          
                                                        <td>{{ $data->name_ar }}</td>          
                                                        <td>{{ $data->commercial_number }}</td>          
                                                        <td style="direction: ltr">{{ $data->release_date }}</td>          
                                                        <td style="direction: ltr">{{ $data->end_date }}</td>          
                                                        <td>{{ $item->created_at }}</td>          
                                                                
                                                         
                                                        {{-- <td class="d-flex">
                                                            @can(find_or_create_p('customer.edit'))
                                                            <a role="button" href="/customers/{{ $item->id }}/edit" class="m-1 btn btn-primary btn-sm" >@trans('edit')</a>
                                                            @endcan
                                                            @can(find_or_create_p('customer.show'))
                                                            <a role="button" href="/customers/{{ $item->id }}" class="m-1 btn btn-primary btn-sm" >@trans('show')</a>
                                                            @endcan
                                                            @can(find_or_create_p('customer.delete'))
                                                            <button onclick="destroy('/customers/{{ $item->id }}')" class="m-1 btn btn-danger bt-sm" >@trans('remove')</button>
                                                            @endcan
                                                        </td>      --}}
                                                    </tr> 
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
