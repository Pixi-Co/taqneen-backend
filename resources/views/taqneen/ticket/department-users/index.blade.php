@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
    <h3>@trans('department_users')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item active">@trans('department_users')</li>
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
                                            @can(find_or_create_p('ticket_department.create'))
                                                <a role="button" href="{{route('department.users.create')}}" class="btn btn-primary" >@trans('add new')</a>
                                            @endcan
                                            <div class="table-responsive pt-3">
                                                <table class="display table table-striped dataTable">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>@trans('department')</th>
                                                        <th>@trans('name')</th>
                                                        <th>@trans('status')</th>
                                                        <th>@trans('actions')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($departmentUsers as $department_user)
                                                        <tr>
                                                            <td class="text-center">{{$department_user->department->name}}</td>
                                                            <td class="text-center">{{$department_user->user->first_name." ".$department_user->user->last_name}}</td>
                                                            <td>
                                                                <span  class="badge" style="background-color: {{$department_user->is_active==1?'#2BAD68':"#AD2B52"}}">
                                                                    @if($department_user->is_active==1)
                                                                        @trans('active')
                                                                    @else
                                                                        @trans('not_active')
                                                                    @endif
                                                                </span>
                                                            </td>
                                                            <td class="d-flex">
                                                                @can(find_or_create_p('department_users.delete'))
                                                                    <button onclick="destroy('{{route('department.users.delete',$department_user->id)}}')" class="m-1 btn btn-danger-gradien bt-sm" ><i class="fa fa-trash"></i></button>
                                                                @endcan

                                                                @can(find_or_create_p('department_users.edit'))
                                                                    <a role="button" href="{{route('department.users.edit',$department_user->id)}}" class="m-1 btn btn-warning btn-sm" ><i class="fa fa-edit"></i></a>
                                                                @endcan

                                                                @can(find_or_create_p('department_users.stop'))
                                                                    <a role="button" href="{{route('department.users.stop',$department_user->id)}}" class="m-1 btn btn-primary btn-sm" ><i class="fa fa-retweet"></i></a>
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
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard/default.js')}}"></script>
    <script src="{{asset('assets/js/notify/index.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script>
        $(".dataTable").DataTable();
    </script>
@endsection
