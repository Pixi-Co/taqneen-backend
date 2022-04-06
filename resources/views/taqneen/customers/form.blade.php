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
    <h3>@trans('customer')</h3>
    @if ($customer->id)
    <h3>@trans('edit customer')</h3>
    @else
    <h3>@trans('add customer')</h3>
    @endif
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="/customers">@trans('lang.customers')</a>
    </li>
    @if ($customer->id)
    <li class="breadcrumb-item active">@trans('edit customer')</li> 
    @else
    <li class="breadcrumb-item active">@trans('add customer')</li> 
    @endif
@endsection

@section('content') 
    <div class="container-fluid">
        <form action="{{ $customer->id? '/customers/' . $customer->id : '/customers' }}" method="post"  enctype="multipart/form-data">
            @csrf
            @if ($customer->id)
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
                                            <legend>@trans('Company Info')</legend>
                                            <div class="row">
                                             <div class="form-group col-md-4">
                                                 <label>@trans('Company Name')</label>
                                                 <input type="text" name="supplier_business_name" class="form-control" placeholder="@trans('company name')" value="{{ $customer->supplier_business_name }}" required>
                                             </div>
                                             <div class="form-group col-md-4">
                                                 <label>@trans('accountant no')</label>
                                                 <input type="text" name="custom_field1" class="form-control" placeholder="@trans('acountant no')" value="{{ $customer->custom_field1 }}" >
                                             </div>
                                             
                                             <div class="form-group col-md-4">
                                                 <label>@trans('Phone')</label>
                                                 <input type="text" name="mobile" class="form-control" placeholder="@trans('phone ')" value="{{ $customer->mobile }}" required>
                                             </div>

                                             <div class="form-group col-md-6 pt-3">
                                                 <label>@trans('state_')</label>
                                                 <input type="text" name="state" class="form-control" placeholder="@trans('state_')" value="{{ $customer->state }}">
                                             </div>

                                             <div class="form-group col-md-4 pt-3">
                                                 <label>@trans('streat_')</label>
                                                 <input type="text" name="address_line_1" class="form-control" placeholder="@trans('streat_')" value="{{ $customer->address_line_1 }}">
                                             </div>

                                             <div class="form-group col-md-4 pt-3">
                                                 <label>@trans('Appartment No')</label>
                                                 <input type="text" name="address_line_2" class="form-control" placeholder="@trans('appartment no ')" value="{{ $customer->address_line_2 }}">
                                             </div>
                                             
                                             <div class="form-group col-md-4 pt-3">
                                                 <label>@trans('zip_code')</label>
                                                 <input type="text" name="zip_code" class="form-control" placeholder="@trans(' Zip Code  ')" value="{{ $customer->zip_code }}">
                                             </div>
                     
                                             
                                         </div>
                                         
                                        </fieldset><br><br>

                                        <fieldset >
                                            <legend>@trans('Customer Info')</legend>
                                            <div class="row">
                                             <div class="form-group col-md-4">
                                                 <label>@trans('First Name')</label>
                                                 <input type="text" name="first_name" class="form-control" placeholder="@trans('first name')" value="{{ $customer->first_name}}" required>
                                             </div>
                                             <div class="form-group col-md-4">
                                                 <label>@trans('Last Name')</label>
                                                 <input type="text" name="last_name" class="form-control" placeholder="@trans('last name')" value="{{ $customer->last_name }}" required>
                                             </div>
                                         </div>
                                         
                                        </fieldset> <br><br>

                                        <fieldset >
                                            <legend>@trans('User Info')</legend>
                                            <div class="row">
                                             
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('Email ')</label>
                                                    <input type="email" name="email" class="form-control" placeholder="@trans('Email ')" value="{{ $customer->email }}" required>
                                                </div>
                                                <div class="form-group col-md-12 pt-3">
                                                    <label>@trans('select roles  ')</label>
                                                    {!! Form::select("roles", $roles, $customer->role, ["class" => "form-select"]) !!} 
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
                                         
                                        </fieldset>
                                        
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
