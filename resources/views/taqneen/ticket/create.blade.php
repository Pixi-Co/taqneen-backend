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
    <h3>@lang('support.ticket_statues')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="{{route('tickets.statues')}}">@lang('support.ticket_statues')</a>
    </li>
    <li class="breadcrumb-item active">@lang('support.add_ticket_statuses')</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('tickets.store')}}" method="post" enctype="multipart/form-data">
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
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    @if(!empty(auth()->user())&&auth()->user()->user_type==\App\Enum\UserType::$USERCUSTOMER)
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="computer_number" class="form-label">@lang('support.computer_number')<b class="text-danger">*</b></label>
                                                <input type="text" name="computer_num" value="{{isset($authedUser)?$authedUser->custom_field1:''}}" class="form-control" id="computer_number" placeholder="700xxxxxxxxxxx">
                                                @if($errors->has('computer_number'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('computer_number')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">@lang('support.email')</label>
                                                <input type="text" name="client_email" value="{{isset($authedUser)?$authedUser->email:''}}" class="form-control">
                                                @if($errors->has('client_email'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('client_email')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">@lang('support.name')</label>
                                                <input type="text" name="client_name" value="{{isset($authedUser)?$authedUser->name:''}}" class="form-control" id="name">
                                                @if($errors->has('client_name'))
                                                    <div class="text text-danger">
                                                        {{$errors->first('client_name')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    @endif

                                    @if(!empty(auth()->user())&&auth()->user()->user_type==\App\Enum\UserType::$USER)
                                            <div class="col-xs-12 col-md-8" style="margin: 5px">
                                            <label for="name" class="form-label">@lang('support.client_name')<b class="text-danger">*</b></label>
                                            <div class="form-group">
                                                <select class="form-control select2" id="main_department">
                                                    <option>@lang('messages.please_select')</option>
                                                    @if(count($users))
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->full_name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option>@lang('messages.please_select')</option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                        <label for="name" class="form-label">@lang('support.ticket_department')<b class="text-danger">*</b></label>
                                        <div class="form-group">
                                            <select class="form-control" id="main_department">
                                                <option>@lang('messages.please_select')</option>
                                                @if(count($mainDepartments))
                                                    @foreach($mainDepartments as $mainDepartment)
                                                        <option value="{{$mainDepartment->id}}">{{$mainDepartment->name}}</option>
                                                    @endforeach
                                                @else
                                                    <option>@lang('messages.please_select')</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-md-6">
                                        <label for="name" class="form-label">@lang('support.sub_department')<b class="text-danger">*</b></label>
                                        <div class="form-group">
                                            <select class="form-control sub_departments" name="sub_department">
                                                <option>@lang('messages.please_select')</option>
                                                @if(count($subDepartments))
                                                    @foreach($subDepartments as $sub_department)
                                                        <option class="{{$sub_department->parent_id}}" value="{{$sub_department->id}}">{{$sub_department->name}}</option>
                                                    @endforeach
                                                @else
                                                    <option>@lang('messages.please_select')</option>
                                                @endif

                                            </select>

                                            @if($errors->has('sub_department'))
                                                <div class="text text-danger">
                                                    {{$errors->first('sub_department')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12" style="margin: 5px">
                                        <div class="form-group mb-3">
                                            <label for="color" class="form-label">@lang('support.status_desc')<b class="text-danger">*</b></label>
                                            <textarea name="description" class="form-control">

                                            </textarea>
                                            @if($errors->has('description'))
                                                <p class="text text-danger">
                                                    {{$errors->first('description')}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-8" style="margin: 5px">
                                        <div class="form-group mb-3">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">@lang('support.upload_file')</label>
                                                <input class="form-control" name="file" type="file" id="formFile">
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
            $('#main_department').on('change', function() {
                $('select[name="sub_department"] option').not(':first').hide();
                $('.'+this.value+'').show();
            });

            $('form').on('keyup', '#computer_number', function(e){
                if(e.keyCode == '13'){
                    alert('ok');
                    $.ajax({
                        //do Ajax stuff
                    });
                }
            });
        });
    </script>
@endsection
