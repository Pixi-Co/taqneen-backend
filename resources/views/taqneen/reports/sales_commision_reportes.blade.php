@extends('taqneen.layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
    <h3>@trans('customers')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
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
                                        <form action="" method="GET">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-md-3 w3-padding">
                                                        <div class="form-group">
                                                            <label for="">@trans('sales commision')</label>
                                                            <select name="user_id" class="form-select  mb-3 ">
                                                                <option value="">@trans('all')</option>
                                                                @foreach ($users as $key => $value)
                                                                    <option value="{{ $key }}">{{ $value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 w3-padding">
                                                        <div class="form-group">
                                                            <label for="">@trans('service')</label>
                                                            <select name="service_id" class="form-select  mb-3 ">
                                                                <option value="">@trans('all')</option>
                                                                @foreach ($services as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 w3-padding">
                                                        <div class="form-group">
                                                            <label for="">@trans('subscription type')</label>
                                                            <select name="type" class="form-select  mb-3 ">
                                                                <option value="">@trans('all')</option>
                                                                <option value="new">@trans('new')</option>
                                                                <option value="renew">@trans('renew')</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('expire date')</label>
                                                            <input type="text"  class="form-control dateranger expire_date"  >
                                                            <input type="hidden" name="" class="expire_date_start" >
                                                            <input type="hidden" name="" class="expire_date_end" >
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('payment date')</label>
                                                            <input type="text"  class="form-control dateranger payment_date"  >
                                                            <input type="hidden" name="" class="payment_date_start" >
                                                            <input type="hidden" name="" class="payment_date_end" >
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group mt-4" style="width: 400px; height: 40px">
                                                    <input type="submit" class="btn btn-primary" value="@trans('submit')">
                                                    <button type="reset" class="btn btn-primary"> @trans('reset')</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="card-body">

                                            <div class="table-responsive pt-3">
                                                <table class="display" id="advance-4">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@trans('name')</th>
                                                            <th>@trans('total new subscription ')</th>
                                                            <th>@trans(' renew subscription aftxpire')</th>
                                                            <th>@trans(' renew subscription before expire')</th>
                                                            <th>@trans(' total subscription before tax')</th>
                                                            <th>@trans('subscription total after taxs')</th>
                                                            <th>@trans('total of oportunities ')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($resources as $resource)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $resource->user_full_name }}</td>
                                                                <td>
                                                                    {{ $resource->subscriptionQueryReport()->where('is_renew', '0')->sum('final_total') }}</td>
                                                                <td>
                                                                    {{ $resource->subscriptionQueryReport()->where('is_renew', '1')->whereRaw('renew_date > expire_date')->sum('final_total') }}
                                                                </td>
                                                                <td>
                                                                    {{ $resource->subscriptionQueryReport()->where('is_renew', '1')->whereRaw('renew_date < expire_date')->sum('final_total') }}
                                                                </td>
                                                                <td>
                                                                    {{ $resource->subscriptionQueryReport()->sum('final_total') - $resource->subscriptionQueryReport()->sum('tax_amount') }}
                                                                </td>
                                                                <td>
                                                                    {{ $resource->subscriptionQueryReport()->sum('final_total') }}
                                                                </td>
                                                                <td>{{ $resource->opportunity_count }}</td>
                                                            </tr>
                                                        @endforeach
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
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

    <script>
        
    $(document).ready(function(){
        initDateRanger();

        $('.expire_date').change(function(){
            $('.expire_date_start').val($('.expire_date').attr('data-start'));
            $('.expire_date_end').val($('.expire_date').attr('data-end'));
        });

        $('.payment_date').change(function(){
            $('.payment_date_start').val($('.payment_date').attr('data-start'));
            $('.payment_date_end').val($('.payment_date').attr('data-end'));
        });
    });
    </script>
@endsection
