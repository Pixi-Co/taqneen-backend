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
    <h3>{{__('support.ticket_statuses')}}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('dashboard_')</li>
    <li class="breadcrumb-item">
        <a href="{{__('support.ticket_priorities')}}">{{__('support.ticket_statuses')}}</a>
    </li>
    <li class="breadcrumb-item active">{{__('support.add_ticket_statuses')}}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('tickets.statues.store')}}" method="post" >
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
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-primary">

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">{{__('support.status_name')}}</label>
                                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="{{__('support.ticket_pstatus_name')}}">
                                            @if($errors->has('name'))
                                                <div class="text text-danger">
                                                    {{$errors->first('name')}}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="color" class="form-label">{{__('support.description')}}</label>
                                            <textarea name="description" class="form-control">

                                            </textarea>
                                            @if($errors->has('description'))
                                                <p class="text text-danger">
                                                    {{$errors->first('description')}}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" name="is_send_mail"  type="checkbox" id="flexCheckDefault" {{old('is_send_mail')!==null? 'checked':''}}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{__('support.send_mail')}}
                                                </label>
                                            </div>
                                            @if($errors->has('is_send_mail'))
                                                <p class="text text-danger">
                                                    {{$errors->first('is_send_mail')}}
                                                </p>
                                            @endif
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
        import Init from "../../../../public/js/init";
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
@endsection
