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
    <h3>@trans(' category')</h3>
    @if ($category->id)
    <h3>@trans('edit category')</h3>
    @else
    <h3>@trans('add category')</h3>
    @endif
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('lang.Dashboard')</li>
    <li class="breadcrumb-item">
        <a href="/categories">@trans('lang.categories')</a>
    </li>
    @if ($category->id)
    <li class="breadcrumb-item active">@trans('edit category')</li> 
    @else
    <li class="breadcrumb-item active">@trans('add category')</li> 
    @endif
@endsection

@section('content') 
    <div class="container-fluid">
        <form action="{{ $category->id? '/categories/' . $category->id : '/categories' }}" method="post" >
            @csrf
            @if ($category->id)
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
    
                                    <div class="card-body">
                                        <div class="form-group mb-3"> 
                                            <b>@trans('name') *</b>
                                            {!! Form::text("name", $category->name, ["class" => 'form-control mb-3', 'required', "placeholder" => trans('name')]) !!}
                                        </div>
     
                                        
    
                                        <div class="form-group mb-3"> 
                                            <b>@trans('price') *</b>
                                            {!! Form::number("price", $category->price, ["required", "class" => 'form-control mb-3', "placeholder" => trans('price')]) !!}
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
