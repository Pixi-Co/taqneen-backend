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
    <h3>@lang('support.ticket_statues')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item active">@lang('support.ticket_statues')</li>
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
                                            @can(find_or_create_p('ticket_priority.create'))
                                                <a role="button" href="{{route('tickets.create')}}" class="btn btn-primary" >@trans('add new')</a>
                                            @endcan
                                            <div class="table-responsive pt-3">
                                                <table class="display dataTable">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>@lang('id')</th>
                                                        <th>@trans('title')</th>
                                                        <th>@lang('support.department')</th>
                                                        <th>@lang('support.customer')</th>
                                                        <th>@lang('support.priority')</th>
                                                        <th>@lang('support.user')</th>
                                                        <th>@lang('support.status')</th>
                                                        <th>@lang('support.created_at')</th>
                                                        <th>@trans('actions')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($tickets as $ticket)
                                                            <tr>
                                                                <td><a class="text-info text-bold" href="{{route('tickets.show',$ticket['id'])}}">{{$ticket['id']}}</a></td>
                                                                <td>{{$ticket['title']}}</td>
                                                                <td>{{$ticket['department']}}</td>
                                                                <td>{{$ticket['customer']}}</td>
                                                                <td>
                                                                     <span  class="badge" style="background-color: {{$ticket['priority_color']}}">
                                                                        {{  $ticket['priority'] }}
                                                                     </span>
                                                                </td>
                                                                <td>{{$ticket['user']}}</td>
                                                                <td>{{$ticket['status']}}</td>
                                                                <td>{{$ticket['created_at']}}</td>
                                                                <td class="d-flex">

                                                                    @can(find_or_create_p('user.edit'))
                                                                        <a role="button" href="" class="m-1 btn btn-warning btn-sm" ><i class="fa fa-edit"></i></a>
                                                                    @endcan

                                                                    @can(find_or_create_p('user.delete'))
                                                                        <button onclick="destroy('')" class="m-1 btn btn-danger-gradien bt-sm" ><i class="fa fa-trash"></i></button>
                                                                    @endcan

                                                                    @can(find_or_create_p('user.delete'))
                                                                        <a role="button" href="{{route('tickets.show',$ticket['id'])}}" class="m-1 btn btn-info-gradien bt-sm" ><i class="fa fa-eye"></i></a>
                                                                    @endcan

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
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
        $(".dataTable").DataTable();
    </script>
@endsection
