@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{__('support.department_users')}}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="{{__('support.ticket_priorities')}}">{{__('support.ticket_priorities')}}</a>
    </li>
    <li class="breadcrumb-item active">{{__('support.add_ticket_priority')}}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('tickets.departments.store')}}" method="post" >
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
                                                <div class="form-group">
                                                    <select class="form-control" id="main_departments" name="department_id">
                                                        <option>please select main department</option>
                                                    @if(count($mainDepartments))
                                                            @foreach($mainDepartments as $mainDepartment)
                                                                <option value="{{$mainDepartment->id}}">{{$mainDepartment->name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option>please select priority</option>
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-8" style="margin: 5px">
                                                <div class="form-group">
                                                    <select class="form-control sub_departments" name="sub_department">
                                                        <option>please select sub department</option>
                                                        @if(count($subDepartments))
                                                            @foreach($subDepartments as $sub_department)
                                                                <option class="{{$sub_department->parent_id}}" value="{{$sub_department->id}}">{{$sub_department->name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option>please select sub department</option>
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-md-8" style="margin: 5px">
                                                <div class="form-group">
                                                    <select class="form-control" name="department_id">
                                                        @if(count($users))
                                                            @foreach($users as $user)
                                                                <option value="{{$user->id}}">{{$user->first_name}}</option>
                                                            @endforeach
                                                        @else
                                                            <option>please select one/more user</option>
                                                        @endif

                                                    </select>
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
        import Init from "../../../../public/js/init";
        var session_layout = '{{ session()->get('layout') }}';
        export default {
            components: {Init}
        }
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script>
        $( document ).ready(function() {

            $('select[name="sub_department"] option').not(':first').hide();
            $('#main_departments').on('change', function() {
                $('select[name="sub_department"] option').not(':first').hide();
                $('.'+this.value+'').show();
            });
        });
    </script>
@endsection
