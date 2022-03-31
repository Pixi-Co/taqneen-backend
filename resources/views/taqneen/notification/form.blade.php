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
    <h3>@trans('notification template')</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard')</li>
    <li class="breadcrumb-item active">@trans('notification template')</li>
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
                                        <div class="row product-page-main">
                                            <div class="col-sm-12">
                                                <select class="form-control"
                                                    onclick="$('.tab-pane').removeClass('fade active show');$('#' + this.value).addClass('fade active show')">
                                                    @foreach ($trigers as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="tab-content" id="top-tabContent">
                                                    <br>
                                                    <br>
                                                    <b>@trans('tags')</b>
                                                    <br>
                                                    @foreach ($tags as $key => $value)
                                                        <a class="btn btn-primary btn-xs" style="margin: 1px" href="#"
                                                            data-bs-original-title="" title="">
                                                            {{ $key }}
                                                        </a>
                                                    @endforeach
                                                    <br>
                                                    <br>
                                                    @foreach ($trigers as $key => $value)
                                                        <div class="tab-pane {{ $loop->iteration == 1 ? 'fade active show' : '' }}"
                                                            id="{{ $key }}" role="tabpanel"
                                                            aria-labelledby="top-home-tab">

                                                            <div class="row">
                                                                <form method="post"
                                                                    action="{{ url('/notification-template') }}"
                                                                    class="form">
                                                                    @csrf
                                                                    {!! Form::hidden('template_for', $key, []) !!}
                                                                    {!! Form::hidden('email_body', '', []) !!}

                                                                    <div class="form-group">
                                                                        <b>@trans('action name')</b>
                                                                        {!! Form::text('triger_name', __($value), ['class' => 'form-control', 'readonly']) !!}
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <br>
                                                                        <b>@trans('subject')</b>
                                                                        {!! Form::text('subject', $resource->subject, ['class' => 'form-control', 'required']) !!}
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <br>
                                                                        <b>@trans('emails')</b> {{ __('or write email tag') }} 
                                                                        
                                                                        <span  class="btn btn-primary btn-xs" style="margin: 1px" 
                                                                            data-bs-original-title="" title="">
                                                                            {sales_commision_email}
                                                                        </span> 
                                                                        <span class="btn btn-primary btn-xs" style="margin: 1px" 
                                                                            data-bs-original-title="" title="">
                                                                            {customer_email}
                                                                        </span>
                                                                        {!! Form::text('cc', $resource->cc, ['class' => 'form-control', '', 'placeholder' => 'email1@example.com,email2@example.com', 'required']) !!}
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <br>
                                                                        <b>@trans('email_body')</b>
                                                                        {!! Form::textarea('email_body_' . $key, $resource->email_body, ['class' => 'form-control']) !!}
                                                                    </div>

                                                                    <div class="form-group w3-center">
                                                                        <br>
                                                                        <button type="submit"
                                                                            onclick="setEmailBody(this, '{{ $key }}')"
                                                                            class="btn btn-primary">@trans('save')</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
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

    <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

    <script>
        function setEmailBody(btn, triger) {
            var form = btn.form;
            console.log(form.email_body);
            var instance = "email_body_" + triger;
            form.email_body.value = CKEDITOR.instances[instance].getData();
        }

        @foreach ($trigers as $key => $value)
            CKEDITOR.replace( '{{ 'email_body_' . $key }}' );
        @endforeach


        $(document).ready(function() {
            formAjax(true);
        });
    </script>
@endsection
