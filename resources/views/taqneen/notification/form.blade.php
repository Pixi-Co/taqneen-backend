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

                                                <div class="tab-content" id="top-tabContent">
                                                    <br>
                                                    <br>
                                                    <b>@trans('tags')</b>
                                                    <br>
                                                    @foreach ($tags as $key => $value)
                                                        <a class="btn btn-primary btn-xs" onclick="copyTextToClipboard(this.innerText)" style="margin: 1px" href="#"
                                                            data-bs-original-title="" title="">
                                                            {{ $key }}
                                                        </a>
                                                    @endforeach
                                                    <br>
                                                    <br>
                                                    <div class="tab-pane fade active show"
                                                        id="" role="tabpanel"
                                                        aria-labelledby="top-home-tab">

                                                        <div class="row">
                                                            <form method="post" action="{{ url('/notification-template') }}" class="form">
                                                                @csrf 
                                                                {!! Form::hidden('id', $resource->id, []) !!}
                                                                {!! Form::hidden('email_body', '', []) !!}

                                                                <div class="form-group">
                                                                    <b>@trans('action name')</b>
                                                                    {!! Form::select('template_for', $trigers, $resource->template_for, ['class' => 'form-select', 'required']) !!}
                                                                </div>

                                                                <div class="form-group">
                                                                    <br>
                                                                    <b>@trans('subject')</b>
                                                                    {!! Form::text('subject', $resource->subject, ['class' => 'form-control', 'required']) !!}
                                                                </div>

                                                                <div class="form-group">
                                                                    <br>
                                                                    <b>@trans('emails')</b> {{ __('or write email tag') }}

                                                                    <span class="btn btn-primary btn-xs" style="margin: 1px"
                                                                        data-bs-original-title="" onclick="copyTextToClipboard(this.innerText)" title="">
                                                                        {sales_commision_email}
                                                                    </span>
                                                                    <span class="btn btn-primary btn-xs" style="margin: 1px"
                                                                        data-bs-original-title="" onclick="copyTextToClipboard(this.innerText)" title="">
                                                                        {customer_email}
                                                                    </span>
                                                                    <span class="btn btn-primary btn-xs" style="margin: 1px"
                                                                        data-bs-original-title="" onclick="copyTextToClipboard(this.innerText)" title="">
                                                                        {customer_form_user_email}
                                                                    </span>
                                                                    {!! Form::text('cc', $resource->cc, ['class' => 'form-control', '', 'placeholder' => 'email1@example.com,email2@example.com', 'required']) !!}
                                                                </div>

                                                                <div class="form-group">
                                                                    <br>
                                                                    <b>@trans('email_body')</b>
                                                                    {!! Form::textarea('email_body_', $resource->email_body, ['class' => 'form-control']) !!}
                                                                </div>

                                                                <div class="form-group w3-center">
                                                                    <br>
                                                                    <button type="submit"
                                                                        onclick="setEmailBody(this)"
                                                                        class="btn btn-primary">@trans('save')</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
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
        function copyTextToClipboard(text) {
            if (!navigator.clipboard) {
              fallbackCopyTextToClipboard(text);
              return;
            }
            navigator.clipboard.writeText(text).then(function() {
              console.log('Async: Copying to clipboard was successful!');
              toastr.success(text + " {{ __('copied_to_clipboard') }}");
            }, function(err) {
              console.error('Async: Could not copy text: ', err);
            });
        }

        function setEmailBody(btn) {
            var form = btn.form; 
            var instance = "email_body_";
            form.email_body.value = CKEDITOR.instances[instance].getData();
        }

        CKEDITOR.replace( 'email_body_' ); 


        $(document).ready(function() {
            formAjax(true, function(){
                window.location = '{{ url('/notification-template') }}';
            });
        });
    </script>
@endsection
