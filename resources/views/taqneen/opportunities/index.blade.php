@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>@trans('opportunities')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item active">@trans('opportunities')</li>
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
                                            @include('taqneen.opportunities.filter')
                                            @can(find_or_create_p('opportunity.create'))
                                                <a role="button" href="/opportunities/create"
                                                    class="btn btn-primary">@trans('add new')</a>
                                            @endcan
                                            @can(find_or_create_p('opportunity.import'))
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">
                                                    @trans('opportunit import excel')
                                                </button>
                                            @endcan
                                            <div class="table-responsive pt-3">
                                                <table class="display data-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@trans('name')</th>
                                                            <th>@trans('phone')</th>
                                                            <th>@trans('email')</th>
                                                            <th>@trans('serivce')</th> 
                                                            <th>@trans('status')</th>
                                                            <th>@trans('assign_user')</th>
                                                            <th>@trans('publish date')</th>
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title " id="staticBackdropLabel">@trans('opportunities import excel')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead"> @trans('pleas download template file ')</p>
                    <a href="/opportunit-download" class="btn btn-primary">@trans('download temblate')</a>
                </div>
                <div class="modal-footer">
                    <!-- Button trigger modal -->
                    <button id="next" type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop2">
                        @trans('next')
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal " id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@trans('opportunities import excel')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/opportunit-upload_file" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <p class="lead"> @trans(' now upload file ')</p>
                        <div class="form-group col-md-12 pt-3">
                            <input type="file" name="import_file" class="form-control" placeholder="@trans('file ')">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="@trans('submit')" class="btn btn-primary float-right"
                            data-bs-original-title="" title="">
                        <button id="back" type="button" class="btn btn-info"
                            data-bs-dismiss="modal">@trans('back')</button>

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
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>


    <script>
        $(document).ready(function() {
            initDateRanger();
            $('#dob').val('');

            $('.select2').select2({
                placeholder: 'search in users',
                ajax: {
                    url: '/select2-autocomplete-ajax',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            user_type:'user'
                        };
                    },
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.first_name +" "+ item.last_name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "autoWidth": true,
                ajax: {
                    url: "/opportunities",
                    data: function (data) {
                        data.status = $('#status').val(),
                            data.created_by = $('#user_id').val(),
                            data.data_rang = $('#dob').val()
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
                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'service.name', name: 'service_name'},
                    {data: 'custom_field4', name: 'status'},
                    {data: 'oppUser.first_name', name: 'priority_id'},
                    {data: 'dob', name: 'dob'},
                    { data: 'action', name: 'action' }
                ]
            });
            $('#search').on('click',function(){
                table.draw();
            });

            $('#reset').on('click',function(){
                $('#dob').val('');
                $('#user_id').val('');
                $('#status').val('');
                table.on('preXhr.dt',function (e,settings,data){
                    data.status = null,
                        data.created_by = null,
                        data.date_rang = null
                    return false;
                })
                table.draw();
            });

        })
    </script>
@endsection
