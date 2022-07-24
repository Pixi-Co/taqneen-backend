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
    <h3>@trans('ticket_department')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item active">@lang('support.ticket_department')</li>
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
                                                <a role="button" href="{{route('tickets.departments.create')}}" class="btn btn-primary" >@trans('add new')</a>
                                            @endcan
                                            <div class="table-responsive pt-3">
                                                <table class="display dataTable">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>@trans('name')</th>
                                                        <th>@lang('support.priority')</th>
                                                        <th>@lang('support.date')</th>
                                                        <th>@trans('actions')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($departments as $department)
                                                        <tr>
                                                            <th>{{  $department->name   }}</th>
                                                            <th>-</th>
                                                            <th>{{  $department->created_at   }}</th>
                                                            <th class="d-flex">
                                                                @can(find_or_create_p('user.edit'))
                                                                    <a role="button" href="/userstaq/{{ $department->id }}/edit" class="m-1 btn btn-warning-gradien btn-sm" ><i class="fa fa-edit"></i></a>
                                                                @endcan
                                                                @can(find_or_create_p('user.delete'))
                                                                    <button onclick="destroy('/userstaq/{{ $department->id }}')" class="m-1 btn btn-danger-gradien bt-sm" ><i class="fa fa-trash"></i></button>
                                                                @endcan
                                                            </th>
                                                        </tr>
                                                        @if(count($department->subDepartments))
                                                            @foreach($department->subDepartments as $sub_department)
                                                                <tr>
                                                                    <td>{{  $sub_department->name   }}</td>
                                                                    <td>
                                                                        <span  class="badge" style="background-color: {{$sub_department->priority->color}}">
                                                                            {{$sub_department->priority->name}}
                                                                        </span>
                                                                    </td>
                                                                    <td>{{  $department->created_at   }}</td>
                                                                    <td class="d-flex">
                                                                        @can(find_or_create_p('ticket_departments.edit'))
                                                                            <a role="button" href="{{route('tickets.departments.edit',$department->id)}}" class="m-1 btn btn-warning-gradien btn-sm"><i class="fa fa-edit"></i></a>
                                                                        @endcan
                                                                        @can(find_or_create_p('ticket_departments.delete'))
                                                                            <button onclick="destroy('{{route('tickets.departments.edit',$department->id)}}')" class="m-1 btn btn-danger-gradien bt-sm"><i class="fa fa-trash"></i></button>
                                                                        @endcan
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
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
        $(".dataTable").DataTable({
            "ordering": false
        });
    </script>
@endsection
