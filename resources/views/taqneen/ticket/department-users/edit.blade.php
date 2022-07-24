@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('breadcrumb-title')
    <h3>@trans('department_users')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="{{route('department.users')}}">@trans('department_users')</a>
    </li>
    <li class="breadcrumb-item active">@trans('add_department_users')</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('department.users.update',$targetDepartment->id)}}" method="post" >
            @csrf
            <div class="row">
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">

                        </div><!-- /.container-fluid -->
                    </section>
                    <section class="content">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="text-bold">{{$error}}</li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                        @endif
                                        <div class="card-body">

                                            <div class="col-xs-12 col-md-8" style="margin: 5px">
                                                <label for="name" class="form-label">@trans('ticket_department')</label>
                                                <div class="form-group">
                                                    <select class="form-control" id="main_department">
                                                        <option>@trans('messages.please_select')</option>
                                                    @if(count($mainDepartments))
                                                            @foreach($mainDepartments as $mainDepartment)
                                                                <option value="{{$mainDepartment->id}}" {{$mainDepartment->id==$targetDepartment->department->parent_id?'selected':''}}>{{$mainDepartment->name}}</option>
                                                            @endforeach
                                                    @endif

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-8" style="margin: 5px">
                                                <label for="name" class="form-label">@trans('sub_department')</label>
                                                <div class="form-group">
                                                    <select class="form-control sub_departments" name="sub_department">
                                                        <option>@trans('messages.please_select')</option>
                                                        @if(count($subDepartments))
                                                            @foreach($subDepartments as $sub_department)
                                                                <option class="{{$sub_department->parent_id}}" {{$sub_department->id==$targetDepartment->department_id?'selected':''}} value="{{$sub_department->id}}">{{$sub_department->name}}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-8" style="margin: 5px">
                                                <label for="name" class="form-label">@trans('users')</label>
                                                <div class="form-group">
                                                    <select class="form-control select2" name="user">
                                                        @if(count($users))
                                                            @foreach($users as $user)
                                                                <option value="{{$user->id}}" {{$targetDepartment->user->id == $user->id?'selcted':''}}>
                                                                    {{$user->full_name}}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option value="{{$targetDepartment->user->id}}">{{$targetDepartment->user->full_name}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="is_active"  type="checkbox" id="flexCheckisDefault" {{$targetDepartment->isactive==1?"checked":""}}>
                                                    <label class="form-check-label" for="flexCheckisDefault">
                                                        @trans('is_default')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>

            </div>
            <div class="row">
                <div class="col-12 my-3">
                    <input type="submit" value="@trans('submit')" class="btn btn-primary float-right" data-bs-original-title="" title="">
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        import Init from "../../../../../public/js/init";
        var session_layout = '{{ session()->get('layout') }}';
        export default {
            components: {Init}
        }
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script>
        $( document ).ready(function() {

            $('select[name="sub_department"] option').not(':first').hide();
            $('#main_department').on('change', function() {
                $('select[name="sub_department"] option').not(':first').hide();
                $('.'+this.value+'').show();
            });

            // $('.select2').select2({
            //     placeholder: 'search in users',
            //     ajax: {
            //         url: '/select2-autocomplete-ajax',
            //         dataType: 'json',
            //         delay: 250,
            //         data: function (params) {
            //             return {
            //                 q: params.term,
            //                 user_type:'user'
            //             };
            //         },
            //         processResults: function (data) {
            //             return {
            //                 results:  $.map(data, function (item) {
            //                     return {
            //                         text: item.first_name +""+ item.last_name,
            //                         id: item.id
            //                     }
            //                 })
            //             };
            //         },
            //         cache: true
            //     }
            // });
        });
    </script>
@endsection

