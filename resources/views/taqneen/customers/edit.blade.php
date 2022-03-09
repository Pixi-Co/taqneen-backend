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
<h3>@trans('customers')</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">@lang('lang.Dashboard')</li>
<li class="breadcrumb-item active">@trans('customers')</li> 
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
                                        <h5>@lang('lang.Opportunities')</h5>
                                    </div> --}}
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <form action="{{ route('customers.update',$customer->id) }}" method="POST" >
                                                @csrf
                                                @method('put')
                                               <fieldset>
                                                   <legend>@trans('Company Info')</legend>
                                                   <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label>@trans('Company Name')</label>
                                                        <input type="text" name="form['supplier_business_name']" class="form-control" placeholder="@trans('company name')" value="{{ $customer->supplier_business_name }}" required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>@trans('Acountant No')</label>
                                                        <input type="text" name="form['custom_field1']" class="form-control" placeholder="@trans('acountant no')" value="{{ $customer->custom_field1 }}" >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label>@trans('Phone ')</label>
                                                        <input type="text" name="form['moblie']" class="form-control" placeholder="@trans('phone ')" value="{{$customer->moblie}}" required>
                                                    </div>

                                                    <div class="form-group col-md-6 pt-3">
                                                        <label>@trans('Email ')</label>
                                                        <input type="text" name="form['email']" class="form-control" placeholder="@trans('Email ')" value="{{ $customer->email }}" required>
                                                    </div>

                                                    <div class="form-group col-md-6 pt-3">
                                                        <label>@trans('State ')</label>
                                                        <input type="text" name="form['state']" class="form-control" placeholder="@trans('state ')" value="{{ $customer->state }}">
                                                    </div>

                                                    <div class="form-group col-md-4 pt-3">
                                                        <label>@trans('Streat  ')</label>
                                                        <input type="text" name="form['address_line_1 ']" class="form-control" placeholder="@trans('streat  ')" value="{{ $customer->address_line_1 }}">
                                                    </div>

                                                    <div class="form-group col-md-4 pt-3">
                                                        <label>@trans('Appartment No ')</label>
                                                        <input type="text" name="form['address_line_2']" class="form-control" placeholder="@trans('appartment no ')" value="{{ $customer->address_line_2 }}">
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4 pt-3">
                                                        <label>@trans('Zip Code   ')</label>
                                                        <input type="text" name="form['zip_code']" class="form-control" placeholder="@trans(' Zip Code  ')" value="{{ $customer->zip_code}}">
                                                    </div>
                            
                                                    
                                                </div>
                                                
                                               </fieldset><br><br>

                                               <fieldset >
                                                <legend>@trans('Customer Info')</legend>
                                                <div class="row">
                                                 <div class="form-group col-md-4">
                                                     <label>@trans('First Name')</label>
                                                     <input type="text" name="form['first_name']" class="form-control" placeholder="@trans('first name')" value="{{ $customer->first_name }}" required>
                                                 </div>
                                                 <div class="form-group col-md-4">
                                                     <label>@trans('Last Name')</label>
                                                     <input type="text" name="form['last_name']" class="form-control" placeholder="@trans('last name')" value="{{ $customer->last_name }}" required>
                                                 </div>
                                             </div>
                                             
                                            </fieldset>

                                            <div class="form-group pt-4">
                                                <button type="submit" class="btn btn-primary">@trans('submit')</button>
                                            </div>
                                            </form>
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
@endsection
