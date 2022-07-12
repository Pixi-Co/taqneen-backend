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
    <h3>@trans('services_report')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item active">@trans('services_report')</li>
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
                                        <form action="" class="form" method="GET" id="filterForm" >
                                            <div class="card-header">
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('register_date')</label>
                                                            <input type="text"  class="form-control dateranger register_date"  >
                                                            <input type="hidden" name="register_date_start" class="register_date_start" >
                                                            <input type="hidden" name="register_date_end" class="register_date_end" >
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('transaction_date')</label>
                                                            <input type="text"  class="form-control dateranger transaction_date"  >
                                                            <input type="hidden" name="transaction_date_start" class="transaction_date_start" >
                                                            <input type="hidden" name="transaction_date_end" class="transaction_date_end" >
                                                        </div>
                                                    </div>  

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('expire date')</label>
                                                            <input type="text"  class="form-control dateranger expire_date"  >
                                                            <input type="hidden" name="expire_date_start" class="expire_date_start" >
                                                            <input type="hidden" name="expire_date_end" class="expire_date_end" >
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('payment date')</label>
                                                            <input type="text"  class="form-control dateranger payment_date"  >
                                                            <input type="hidden" name="payment_date_start" class="payment_date_start" >
                                                            <input type="hidden" name="payment_date_end" class="payment_date_end" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('payment status')</label>
                                                            <select name="payment_status" class="form-select  mb-3 subscription_type">
                                                                <option value="">@trans('all')</option>
                                                                <option value="paid">@trans('paid')</option>
                                                                <option value="not_paid">@trans('not_paid')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">@trans('sales commision')</label>
                                                            <select name="user_id" class="form-select  mb-3 user_id">
                                                                <option value="">@trans('all')</option>
                                                                @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->user_full_name }}</option> 
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group mt-4" style="width: 400px; height: 40px">
                                                    <button type="submit" class="btn btn-primary" >@trans('submit')</button>
                                                    <button type="button" onclick="$('.form').find('input, select').val('')" class="btn btn-primary"> @trans('reset')</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="card-body">

                                            <div class="table-responsive pt-3" id="reportTableContainer" >
                                                <table class="display" id="reportTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@trans('service')</th> 
                                                            <th>@trans('number')</th> 
                                                            <th>@trans('total')</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $numbers = 0;
                                                            $total = 0;
                                                        @endphp
                                                        @foreach ($resources as $resource)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td> 
                                                                <td>{{ $resource->name }}</td> 
                                                                <td>{{ $resource->number }}</td> 
                                                                <td>{{ number_format($resource->sum, 2) }} SAR</td> 
                                                            </tr>
                                                            @php
                                                                $numbers += $resource->number;
                                                                $total += $resource->sum;
                                                            @endphp
                                                        @endforeach 
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td></td>
                                                            <td>الاجمالى</td>
                                                            <td>{{ $numbers }}</td>
                                                            <td>{{ number_format($total, 2) }} SAR</td>
                                                        </tr>
                                                    </tfoot>
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
        function initDatatable() {
            $('#reportTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });
        }
        
    $(document).ready(function(){
        initDatatable();
        initDateRanger();

        $('.transaction_date').change(function(){
            $('.transaction_date_start').val($('.transaction_date').attr('data-start'));
            $('.transaction_date_end').val($('.transaction_date').attr('data-end'));
        });

        $('.register_date').change(function(){
            $('.register_date_start').val($('.register_date').attr('data-start'));
            $('.register_date_end').val($('.register_date').attr('data-end'));
        });

        $('.expire_date').change(function(){
            $('.expire_date_start').val($('.expire_date').attr('data-start'));
            $('.expire_date_end').val($('.expire_date').attr('data-end'));
        });

        $('.payment_date').change(function(){
            $('.payment_date_start').val($('.payment_date').attr('data-start'));
            $('.payment_date_end').val($('.payment_date').attr('data-end'));
        });

        // 
        document.getElementById('filterForm').reset();

        formAjax(true, function(res){

            var container = document.createElement('div');
            container.innerHTML = res.data;
 
            $('#reportTableContainer').html($(container).find('#reportTableContainer').html()); 
            initDatatable();
        });
    });
    </script>
@endsection
