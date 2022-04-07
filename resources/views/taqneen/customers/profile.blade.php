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
                                <div class="col-md-12">
                                    <div class="card card-primary">

                                        <div class="container rounded bg-white mt-5 mb-5">
                                            <div class="row">
                                                <div class="col-md-3 border-right">
                                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                                        <img class="rounded-circle mt-5" width="150px"
                                                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                                                            class="font-weight-bold">{{ $customer->name }}</span><span
                                                            class="text-black-50">{{ $customer->email }}</span><span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 border-right">
                                                    <form action="{{ '/customers/' . $customer->id }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" value="profile" name=profile>
                                                        <div class="p-3 py-5">
                                                            {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="text-right">Profile Settings</h4>
                                                        </div> --}}
                                                            <div class="row mt-2">
                                                                <div class="col-md-6"><label
                                                                        class="labels">@trans('first name')</label><input type="text" name="first_name"
                                                                        class="form-control"
                                                                        value="{{ $customer->first_name }}" required>
                                                                </div>
                                                                <div class="col-md-6"><label
                                                                        class="labels">@trans('last name')</label><input type="text"
                                                                        class="form-control" name="last_name"
                                                                        value=" {{ $customer->last_name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-12"><label
                                                                        class="labels">@trans('mobile')</label><input
                                                                        type="text" class="form-control" name="mobile"
                                                                        value="{{ $customer->mobile }}" required></div>
                                                                <div class="col-md-12 mt-3"><label
                                                                        class="labels">@trans('email')</label><input
                                                                        type="text" class="form-control" name="email"
                                                                        value="{{ $customer->email }}" required></div>
                                                                <div class="row mt-3">
                                                                    <div class="col-md-6"><label
                                                                            class="labels">@trans('state')</label><input
                                                                            type="text" class="form-control"
                                                                            name="country"
                                                                            value="{{ $customer->country }}"></div>
                                                                    <div class="col-md-6"><label
                                                                            class="labels">@trans('city')</label><input
                                                                            type="text" class="form-control" name="city"
                                                                            value="{{ $customer->city }}"></div>
                                                                </div>
                                                                <div class="col-md-12 mt-3"><label
                                                                        class="labels">@trans('address')</label><input
                                                                        type="text" class="form-control"
                                                                        name="address_line_1"
                                                                        value="{{ $customer->address_line_1 }}"></div>
                                                                <div class="col-md-12 mt-3"><label
                                                                        class="labels">@trans('appartment')</label><input
                                                                        type="text" class="form-control"
                                                                        name="address_line_2"
                                                                        value="{{ $customer->address_line_2 }}"></div>
                                                                <div class="col-md-12 mt-3"><label
                                                                        class="labels">@trans('zipcode')</label><input
                                                                        type="text" class="form-control" name="zip_code"
                                                                        value="{{ $customer->zip_code }}"></div>
                                                                <div class="col-md-12 mt-3"><label
                                                                        class="labels">@trans('accountant no')</label><input type="text"
                                                                        class="form-control"
                                                                        value="{{ $customer->custom_field1 }}"></div>

                                                            </div>

                                                            <div class="mt-5 text-center"><button
                                                                    class="btn btn-primary profile-button"
                                                                    type="submit">@trans('save')</button></div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="p-3 py-5">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center experience">
                                                            <span>@trans('subscriptions')</span>
                                                        </div><br>
                                                        {{-- <div class="col-md-12"><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                                                        <div class="col-md-12"><input type="text" class="form-control" placeholder="additional details" value=""></div> --}}
                                                        <div class=" col-md-12">
                                                            <div class="">
                                                                <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" id="icon-home-tab"
                                                                            data-bs-toggle="tab" href="#active-subscriptions"
                                                                            role="tab" aria-controls="icon-home"
                                                                            aria-selected="false" data-bs-original-title=""
                                                                            title=""> 
                                                                            {{ __('active_subscriptions') }}
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="profile-icon-tab"
                                                                            data-bs-toggle="tab" href="#renew-subscriptions"
                                                                            role="tab" aria-controls="profile-icon"
                                                                            aria-selected="true" data-bs-original-title=""
                                                                            title=""> 
                                                                            {{ __('renewed_subscriptions') }}
                                                                        </a>
                                                                    </li>
                                                                </ul>

                                                                <div class="tab-content" id="icon-tabContent">

                                                                    <div class="tab-pane fade active show" id="active-subscriptions"
                                                                        role="tabpanel" aria-labelledby="icon-home-tab">
                                                                        @foreach ($customer->subscriptions()->get() as $item)
                                                                        @foreach ($item->subscription_lines()->get() as $line)
                                                                            <div class="card" style="width: 18rem;"> 
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">
                                                                                        {{ optional($line->service()->first())->name }}
                                                                                    </h5>
                                                                                    <p>{{ optional($line->package()->first())->name }}
                                                                                    </p>
                                                                                    <span class="badge w3-green">{{ __('active') }}</span>
                                                                                    <p class="card-text">
                                                                                    <h6>@trans('subscription date'):
                                                                                        {{ $item->transaction_date }}</h6>
                                                                                    <h6>@trans('expire date'):
                                                                                        {{ $item->expire_date }}</h6>
                                                                                    </p>
                                                                                    <a target="_blank"
                                                                                        href="{{ url('/subscriptions') }}/{{ $item->id }}/edit"
                                                                                        role="button"
                                                                                        class="btn btn-primary">@trans('edit')</a>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endforeach
                                                                    </div>

                                                                    <div class="tab-pane" id="renew-subscriptions"
                                                                        role="tabpanel" aria-labelledby="profile-icon-tab">
                                                                        @foreach ($customer->subscriptions()->onlyTrashed()->get() as $item)
                                                                        @foreach ($item->subscription_lines()->get() as $line)
                                                                            <div class="card" style="width: 18rem;"> 
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">
                                                                                        {{ optional($line->service()->first())->name }}
                                                                                    </h5>
                                                                                    <p>{{ optional($line->package()->first())->name }}
                                                                                    </p>
                                                                                    <span class="badge w3-red">{{ __('renewed_') }}</span>
                                                                                    <p class="card-text">
                                                                                    <h6>@trans('subscription date'):
                                                                                        {{ $item->transaction_date }}</h6>
                                                                                    <h6>@trans('expire date'):
                                                                                        {{ $item->expire_date }}</h6>
                                                                                    </p>
                                                                                    <a target="_blank"
                                                                                        href="{{ url('/subscriptions') }}/{{ $item->id }}/edit"
                                                                                        role="button"
                                                                                        class="btn btn-primary">@trans('edit')</a>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endforeach
                                                                    </div>
                                                                     
                                                                </div>
                                                            </div>
 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
@endsection
