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
<h3>@trans($key)</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@trans('dashboard_')</li>
<li class="breadcrumb-item active">@trans($key)</li> 
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
                                    <div class="card-body"> 
                                        <a role="button" href="{{ url('customer-form') }}/{{ $key }}" class="btn btn-primary" >@trans('add_' . $key)</a>
                                        

                                        
                                        
                                        <div class="table-responsive pt-3">
                                            <table class="display" id="advance-4">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@trans('company_number')</th>
                                                        <th>@trans('form_number')</th> 
                                                        <th>@trans('created_by')</th>
                                                        <th>@trans('create_at')</th>
                                                        <th>-</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($resources as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->company_number }}</td>                       
                                                            <td>{{ $item->token }}</td>                       
                                                            <td> 
                                                                {{ optional($item->user)->getUserFullNameAttribute() }}</td> 
                                                            <td>{{ $item->created_at }}</td> 
                                                            <td>
                                                                <div style="width: 150px" >
                                                                    <a 
                                                                    class="w3-btn w3-card w3-white w3-text-red"
                                                                    style="width: 25px;height: 25px;border-radius: 5em;padding: 5px;"
                                                                    href="{{ url('/customer-pdf') }}/{{ $item->id }}">
                                                                        <i class="fa fa-file-pdf-o"></i>
                                                                    </a>
                                                                    @can('customer_form.edit')
                                                                    <a 
                                                                    class="w3-btn w3-card w3-white w3-text-orange"
                                                                    style="width: 25px;height: 25px;border-radius: 5em;padding: 5px;"
                                                                    href="{{ url('/customer-form/edit/') }}/{{ $item->id }}">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    @endcan
                                                                    @can('customer_form.remove')
                                                                    <a 
                                                                    class="w3-btn w3-card w3-white w3-text-red"
                                                                    style="width: 25px;height: 25px;border-radius: 5em;padding: 5px;"
                                                                    onclick="destroy('{{ url('/customer-form') }}/{{ $item->id }}')">
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
