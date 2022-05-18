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
    <h3>@trans(' user')</h3>
    @if ($user->id)
    <h3>@trans('edit user')</h3>
    @else
    <h3>@trans('add user')</h3>
    @endif
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="/users">@trans('lang.users')</a>
    </li>
    @if ($user->id)
    <li class="breadcrumb-item active">@trans('edit user')</li> 
    @else
    <li class="breadcrumb-item active">@trans('add user')</li> 
    @endif
@endsection

@section('content') 
    <div class="container-fluid">
        <form action="{{ $user->id? '/userstaq/' . $user->id : '/userstaq' }}" method="post"  enctype="multipart/form-data">
            @csrf
            @if ($user->id)
                @method("put")
            @endif
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
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div class="card-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>@trans(' name')</label>
                                                    <input type="text" name="first_name" class="form-control" placeholder="@trans('first_name')" value="{{ $user->first_name }}" >
                                                </div>
    
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('Email ')</label>
                                                    <input type="email" name="email" class="form-control" placeholder="@trans('Email ')" value="{{ $user->email }}" required>
                                                </div>
    
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('phone ')</label>
                                                    <input type="text" name="contact_number" class="form-control" placeholder="@trans('phone ')" value="{{ $user->contact_number }}" required>
                                                </div>
    
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('commission_type')</label>
                                                    {!! Form::select("custom_field_2", $types, $user->custom_field_2, ["class" => "form-select", "placeholder" => __('commission_type')]) !!}
                                                </div>
    
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('commission_value')</label>
                                                    {!! Form::number("custom_field_3", $user->custom_field_3, ["class" => "form-control"]) !!}
                                                </div>
    
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('address  ')</label>
                                                    <input type="text" name="address" class="form-control" placeholder="@trans('address  ')" value="{{ $user->address }}">
                                                </div>
    
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('select roles  ')</label>
                                                    <select name="roles" id="" class="form-select" required>
                                                       @if ($user->id)
                                                       <option class="form-control" name="role" value="{{ $userRole }}">{{ $userRole}}</option>
                                                       @else
                                                       <option class="form-control" value="role" selected disabled>-- @trans('role') --</option>
                                                       @endif
                                                        
                                                        @foreach ($roles as $role )
                                                        <option class="form-control" name="role_name" value="{{ $role }}"  >{{ $role }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                               
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('image ')</label> <br>
                                                    @if ($user->id)
                                                    <img src="{{ $user->image_path }}" style="width: 100px"class="img-thumbnail image-preview" alt="user image">
                                                    @endif
                                                    <input type="file" name="custom_field_1" class="form-control" placeholder="@trans('image ')" >

                                                </div>
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('password ')</label>
                                                    <input type="password" name="password" class="form-control image" placeholder="@trans('password ')">
                                                </div>
    
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('confirm password  ')</label>
                                                    <input type="password" name="confirm_password" class="form-control" placeholder="@trans('confirm password  ')" >
                                                </div>
    
                                                
                                            
                    
                                        
                                        </div>
                                        
                                        </fieldset><br><br>

                                    
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
        var session_layout = '{{ session()->get('layout') }}';
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
@endsection
