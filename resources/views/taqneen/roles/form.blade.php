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
    <h3>@trans('roles')</h3>
    @if ($role->id)
    <h3>@trans('edit roles')</h3>
    @else
    <h3>@trans('add roles')</h3>
    @endif
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="/role">@trans('roles')</a>
    </li>
    @if ($role->id)
    <li class="breadcrumb-item active">@trans('edit roles')</li> 
    @else
    <li class="breadcrumb-item active">@trans('add roles')</li> 
    @endif
@endsection

@section('content') 
    <div class="container-fluid">
        <form action="{{ $role->id? '/role/' . $role->id : '/role' }}" method="post" >
            @csrf
            @if ($role->id)
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
                                        <div class="form-group col-md-4 mb-3"> 
                                            <b>@trans('name') *</b>
                                            {!! Form::text("name", $role->name , ["class" => 'form-control mb-3', 'required', "placeholder" => trans('name')]) !!}
                                        </div>

                                        <div class="view" style="height: 450px;overflow: auto">
                                            <div class="form-group">
                                                <strong>الصلاحيات:</strong>
                                                <br /><br>
                                                <label for=""><input type="checkbox" class="cheack w3-check" id="cheack"> @trans(' select all')   </label>
                                                <br><br><br>
                                                @foreach ($groups as $item)
                                                <h3>@trans($item)</h3>
                                                @foreach ($permission::orderBy('name')->where('group', $item)->get() as $value)
                                                @php
                                                    $checked = $role->hasPermissionTo($value->name)? 'checked' : '';
                                                @endphp
                                                    <label>
                                                        {{ Form::checkbox('permission[]', $value->name, false, ['class' => 'w3-check name', $checked]) }}
                                                        @trans($value->name)
                                                    </label> 
                                                    <br />
                                                @endforeach  
                                                <hr>
                                                <br />
                                                @endforeach
                                                
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

    <script>
         document.getElementById('cheack').onclick = function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>
@endsection
