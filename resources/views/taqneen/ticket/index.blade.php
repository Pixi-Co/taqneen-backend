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
    <h3>@trans('all_tickets')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item active">@trans('all_tickets')</li>
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
                                    <div class="card card-primary">
                                        <div class="card-body">
                                                <form action="{{route('tickets')}}" id="ticketFilterForm" method="get" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3 col-md-4 col-sm-6 ">
                                                            <div class="form-group">
                                                                <label for="formFile" class="form-label">@trans('ticket_titles')</label>
                                                                <select class="form-control sub_departments select2" id="sub_department" name="sub_department">
                                                                    <option disabled selected>@lang('messages.please_select')</option>
                                                                    @if(count($subDepartments))
                                                                        @foreach($subDepartments as $sub_department)
                                                                            <option class="{{$sub_department->parent_id}}" value="{{$sub_department->id}}" {{$sub_department->parent_id==old('sub_department')?'selected':''}}>{{$sub_department->name}}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 col-md-4 col-sm-6 ">
                                                            <div class="form-group">
                                                                <label for="formFile" class="form-label">@trans('ticket_priorities')</label>
                                                                <select class="form-control" name="priority" id="priority">
                                                                    @if(count($priorities))
                                                                        <option disabled selected>@trans('ticket_priorities')</option>
                                                                        @foreach($priorities as $priority)
                                                                            <option value="{{$priority->id}}" {{$priority->id==old('priority')?'selected':''}}>{{$priority->name}}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option disabled>@trans('select_priority')</option>
                                                                    @endif

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 col-md-4 col-sm-6 ">
                                                            <div class="form-group">
                                                                <label for="formFile" class="form-label">@trans('status')</label>
                                                                <select class="form-control" id="status" name="status">
                                                                    @if(count($ticketStatues))
                                                                        <option disabled selected>@trans('status')</option>
                                                                        @foreach($ticketStatues as $ticketStatue)
                                                                            <option value="{{$ticketStatue->id}}" {{$ticketStatue->id == old('status')?'selected':''}}>{{$ticketStatue->name}}</option>
                                                                        @endforeach
                                                                    @else
                                                                        <option disabled>@trans('status')</option>
                                                                    @endif

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 col-md-4 col-sm-6 ">
                                                            <div>
                                                                <label for="computer_number" class="form-label">@trans('computer_num')</label>
                                                                <input class="form-control" name="computer_number" type="text" id="computer_number">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 col-md-4 col-sm-6 ">
                                                            <div>
                                                                <label for="user_name" class="form-label">@trans('user_name')</label>
                                                                <input class="form-control" name="user_name" value="{{old('user_name')}}" type="text" id="user_name">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 col-md-4 col-sm-6 ">
                                                            <div>
                                                                <label for="client_name" class="form-label">@trans('client_name')</label>
                                                                <input class="form-control" value="{{old('client_name')}}" name="client_name" type="text" id="client_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <button role="button" type="button" id="reset" class="btn btn-primary btn-sm">@lang('reset')</button>
                                                        <button type="button" id="search" class="btn btn-primary btn-sm">@lang('search')</button>
                                                    </div>
                                                </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card">

                                        <div class="card-body">
{{--                                            @can(find_or_create_p('ticket_priority.create'))--}}
                                                <a role="button" href="{{route('tickets.create')}}" class="btn btn-primary" >@trans('add new')</a>
{{--                                            @endcan--}}
                                            <div class="table-responsive pt-3">
                                                <table class="display data-table">
                                                    <thead class="text-center">
                                                    <tr>
                                                        <th>@lang('id')</th>
                                                        <th>@trans('title')</th>
                                                        <th>@trans('department')</th>
                                                        <th>@trans('customer')</th>
                                                        <th>@trans('computer_num')</th>
                                                        <th>@trans('priority')</th>
                                                        <th>@trans('user')</th>
                                                        <th>@trans('status')</th>
                                                        <th>@trans('created_at')</th>
                                                        <th>@trans('actions')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
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
    <script type="text/javascript">
        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "autoWidth": true,
                ajax: {
                    url: "{{ route('tickets') }}",
                    data: function (data) {
                        data.status = $('#status').val(),
                            data.priority = $('#priority').val(),
                            data.user_name = $('#user_name').val(),
                            data.client_name = $('#client_name').val(),
                            data.computer_number = $('#computer_number').val(),
                            data.sub_department = $('#sub_department').val();
                    }
                },
                columnDefs: [
                    {
                        targets: '_all',
                        defaultContent: '-'
                    }
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'department.name', name: 'sub_department_id'},
                    {data: 'department.department.name', name: 'main_department_id'},
                    {data: 'agent.first_name', name: 'customer_name'},
                    {data: 'agent.custom_field_1', name: 'computer_number'},
                    {data: 'priority.name', name: 'priority_id'},
                    {data: 'user.first_name', name: 'user_name'},
                    {data: 'status.name', name: 'status_id'},
                    {data: 'created_at', name: 'created_at'},
                    { data: 'action', name: 'action' }
                ]
            });

            $('#search').on('click',function(){
                table.draw();
            });

            $('#reset').on('click',function(){
                $('#ticketFilterForm')[0].reset();
                table.on('preXhr.dt',function (e,settings,data){
                    data.status = null,
                        data.priority = null,
                        data.user_name = null,
                        data.client_name = null,
                        data.priority = null,
                        data.computer_number = null,
                        data.sub_department = null;
                    return false;
                })
                table.draw();
            });

        });
    </script>
@endsection
