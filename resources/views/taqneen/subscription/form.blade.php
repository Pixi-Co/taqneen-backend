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
    @if ($subscription->id)
        <h3>@trans('Edit Subscription')</h3>
    @else
        <h3>@trans('Add Subscription')</h3>
    @endif
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">@trans('lang.Dashboard')</li>
    <li class="breadcrumb-item ">@trans('subscriptions')</li>
    @if ($subscription->id)
        <li class="breadcrumb-item active">@trans('Edit Subscription')</li>
    @else
        <li class="breadcrumb-item active">@trans('Add Subscription')</li>
    @endif
@endsection

@section('content')
    <form action="{{ url('/subscriptions/save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $subscription->id }}">
        <div class="container-fluid">
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

                                    <div class="container rounded bg-white mt-5 ">
                                        <div class="row">
                                            <div class="col-md-6 border-right ">
                                                @if ($subscription->id)
                                                    <h2>@trans('Edit Subscription')</h2>
                                                @else
                                                    <h2>@trans('Add Subscription')</h2>
                                                @endif

                                                <div class="mt-3 my-3">
                                                    <label for="">@trans('status')</label>
                                                    {!! Form::select('status', $status, $subscription->status, ['class' => 'form-select']) !!}
                                                </div>


                                                <div class=" form-group d-flex mb-3">
                                                    <div class="col-md-6 ">
                                                        @php
                                                            $customerList = [];
                                                            foreach ($customers as $customer) {
                                                                $customerList[$customer->id] = $customer->name . '-' . $customer->mobile;
                                                            }
                                                        @endphp
                                                        {!! Form::select('contact_id', $customerList, $subscription->contact_id, ['class' => 'form-control select2', 'placeholder' => __('customer'), 'list' => 'customers', 'id' => 'contact_id', 'onchange' => 'subscription.changeContact()']) !!}
                                                        <!--
                                                                        {!! Form::text('contact_id', $subscription->contact_id, ['class' => 'form-control', 'placeholder' => __('customer'), 'list' => 'customers', 'id' => 'contact_id', 'onchange' => 'subscription.changeContact()']) !!}
                                                                        -->
                                                        <datalist id="customers">
                                                            @foreach ($customers as $customer)
                                                                <option value="{{ $customer->id }}">
                                                                    {{ $customer->name }}-{{ $customer->mobile }}
                                                                </option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <button class="btn btn-primary mx-1 " data-bs-toggle="modal"
                                                        data-bs-target="#myModal">@trans('add new')</button>
                                                </div>


                                                <div class="form-group mb-3">
                                                    <label class="my-2" for="user_id">@trans("courier")</label>
                                                    {!! Form::select('created_by', $users, $subscription->created_by, ['class' => 'form-select', $disabled]) !!}
                                                </div>


                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label class="labels">@trans('service')</label>
                                                        {!! Form::select('service_id', $services, null, ['class' => 'form-select mb-3', 'v-model' => 'resource.service_id', 'id' => 'service_id']) !!}
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="labels">@trans('package')</label>
                                                        <select name="package_id" class=" form-select mb-3" id="package_id"
                                                            v-model="resource.package_id">
                                                            @foreach ($packages as $item)
                                                                <option
                                                                    v-if="resource.service_id == '{{ $item->service_id }}'"
                                                                    value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="button" onclick="subscription.add()">
                                                    <i class="fa fa-plus"></i>
                                                </button>

                                                <div class="row">
                                                    <table class="table">
                                                        <tr>
                                                            <th>@trans("service")</th>
                                                            <th>@trans("package")</th>
                                                            <th>@trans("price")</th>
                                                            <th></th>
                                                        </tr>

                                                        <tr v-for="(item, index) in resource.subscription_lines">
                                                            <td>
                                                                <input type="text" v-model="item.service" readonly
                                                                    class="form-control">
                                                                <input type="hidden" v-model="item.service_id"
                                                                    v-bind:name="'subscription_lines['+index+'][service_id]'">
                                                            </td>
                                                            <td>
                                                                <input type="text" v-model="item.package" readonly
                                                                    class="form-control">
                                                                <input type="hidden" v-model="item.package_id"
                                                                    v-bind:name="'subscription_lines['+index+'][package_id]'">
                                                            </td>
                                                            <td>
                                                                <input type="text" v-model="item.total" readonly
                                                                    class="form-control">
                                                                <input type="hidden" v-model="item.total"
                                                                    v-bind:name="'subscription_lines['+index+'][total]'">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger"
                                                                    v-bind:data-index="index"
                                                                    onclick="subscription.remove(this.getAttribute('data-index'))">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="my-2" for="user_id">@trans("taxs")</label>
                                                        <select class="form-select" name="tax_id" id="tax_id"
                                                            v-model="resource.tax_id" onchange="subscription.changeTax()">
                                                            <option value="">@trans('select tax')</option>
                                                            @foreach ($taxs as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                    ({{ $item->amount }} %)
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="my-2" for="user_id">@trans("taxs
                                                            amount")</label>
                                                        <input type="text" name="tax_amount" class="form-control" readonly
                                                            v-model="resource.tax_amount">
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <label class="labels">@trans('additional expenses')</label>
                                                        {!! Form::select('expenses', $expensesList, $subscription->expenses, ['multiple', 'class' => 'form-control select2 expenses', 'onchange' => 'subscription.changeExpenses()']) !!}
                                                        {!! Form::hidden('custom_field_1', $subscription->custom_field_1, ['class' => 'expenses_hidden']) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="labels">@trans('expenses amount')</label>
                                                        <input type="text" name="custom_field_2" readonly
                                                            class="form-control" v-model="resource.custom_field_2">
                                                    </div>
                                                </div>

                                                <div class="row ">
                                                    <div class="col-md-6">
                                                        <label class="labels">@trans('final total')</label>
                                                        <input type="text" name="final_total" class="form-control"
                                                            readonly v-model="resource.final_total">
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="my-2" for="inputName">@trans('subscription
                                                        date')</label>
                                                    {!! Form::datetimeLocal('transaction_date', $subscription->transaction_date, ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="mt-3 my-3">
                                                    <label for="">@trans('payment method')</label>
                                                    {!! Form::select('payment[method]', $payment_methods, $payment->method, ['class' => 'form-select']) !!}
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label class="my-2" for="inputName">@trans('pay date')</label>
                                                    {!! Form::datetimeLocal('payment[paid_on]', $payment->paid_on, ['class' => 'form-control']) !!}
                                                </div>

                                                <div class="mt-3 my-3">
                                                    <label for="">@trans('paper status')</label>
                                                    {!! Form::select('sub_type', $paper_status, $subscription->sub_type, ['class' => 'form-select mb-3']) !!}

                                                </div>




                                                <div>
                                                    <div class="d-inline-block">
                                                        <h6 class="text-muted"><i class="icofont icofont-clip"></i>
                                                            @trans('attachments')
                                                        </h6>
                                                        <a class="text-muted text-end right-download hidden" href="#"><i
                                                                class="fa fa-long-arrow-down me-2"></i>
                                                            @trans('download_all')
                                                        </a>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="attachment">
                                                        <ul class="list-inline">
                                                            @foreach ($subscription->media()->get() as $item)
                                                                <li class="list-inline-item" style="width: 120px">
                                                                    <a target="_blank" href="{{ $item->display_url }}">
                                                                        @if ($item->isImage())
                                                                            <img class="img-fluid"
                                                                                src="{{ $item->display_url }}" alt="">
                                                                        @else
                                                                            <img class="img-fluid"
                                                                                src="{{ asset('assets/images/file.jpg') }}"
                                                                                alt="">
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <br>
                                                        {!! Form::file('file', ['class' => 'form-control']) !!}
                                                    </div>


                                                </div>
                                                <textarea class="form-control my-3" name="notes"
                                                    placeholder="@trans('notes')"></textarea>



                                            </div>
                                            <div class="col-md-6 border-right">
                                                <div class="p-3 py-5">
                                                    <div class="row mt-2">

                                                        <div class="col-md-6">
                                                            <label class="labels">@trans('first_name')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.first_name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="labels">@trans('last_name')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.last_name">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <label class="labels">@trans('mobile')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.mobile">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <label class="labels">@trans('email')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.email">
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-6">
                                                                <label class="labels">@trans('state')</label>
                                                                <input type="text" class="form-control" readonly
                                                                    v-model="resource.contact.state">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="labels">@trans('city')</label>
                                                                <input type="text" class="form-control" readonly
                                                                    v-model="resource.contact.city">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <label class="labels">@trans('address')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.address_line_1">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <label class="labels">@trans('appartment_no')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.address_line_2">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <label class="labels">@trans('zip_code')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.zip_code">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <label class="labels">@trans('accountant_no')</label>
                                                            <input type="text" class="form-control" readonly
                                                                v-model="resource.contact.custom_field1">
                                                        </div>

                                                    </div>

                                                    <div class="mt-5 text-center"><button
                                                            class="btn btn-primary profile-button"
                                                            type="button">@trans('save')</button>
                                                    </div>
                                                    <br>
                                                    <div class="row mt-3">
                                                        <h3>@trans('notes log')</h3>
                                                        @foreach ($subscription->subscription_notes()->get() as $item)
                                                            <div class="card  "  style="padding: 5px!important;margin-bottom: 8px!important" > 
                                                                <div class="card-body"  style="padding: 5px!important">
                                                                    <h6 class="card-title">
                                                                        <i data-feather="message-circle"></i>
                                                                        {{ $item->notes }}
                                                                    </h6>
                                                                    <p class="card-text">
                                                                    </p>
                                                                    <b>@trans('by'): {{ $item->user->first_name }}</b> 
                                                                    <p></p>
                                                                </div>
                                                            </div> 
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

            <div class="mt-5 text-center">
                <button class="btn btn-primary profile-button" type="submit">@trans('submit')</button>
            </div>
            <br>
            </section>
        </div>
        </div>
        </div>
    </form>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

{{-- pop up add new customer --}}
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">اضافة عميل جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">الاسم الاول</label><input
                                type="text" class="form-control" value=""></div>
                        <div class="col-md-6"><label class="labels">الاسم الاخير</label><input
                                type="text" class="form-control" value=""></div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">رقم الجوال</label><input type="text"
                                class="form-control" value=""></div>
                        <div class="col-md-12 mt-3"><label class="labels">البريدالالكترونى</label><input
                                type="text" class="form-control" value=""></div>

                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">الدولة</label><input type="text"
                                    class="form-control" value=""></div>
                            <div class="col-md-6"><label class="labels">المدينة</label><input
                                    type="text" class="form-control" value=""></div>
                        </div>

                        <div class="col-md-12 mt-3"><label class="labels">عنوان الشارع</label><input
                                type="text" class="form-control" value=""></div>
                        <div class="col-md-12 mt-3"><label class="labels">رقم الشقة</label><input type="text"
                                class="form-control" value=""></div>
                        <div class="col-md-12 mt-3"><label class="labels">رمز البريد</label><input type="text"
                                class="form-control" value=""></div>
                        <div class="col-md-12 mt-3"><label class="labels">رقم الحاسب</label><input type="text"
                                class="form-control" value=""></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">اضافة</button>
            </div>
        </div>
    </div>
</div>


@section('script')
    <script type="text/javascript">
        var app = {};

        var subscription = {
            services: <?php echo json_encode($services); ?>,
            packages: <?php echo json_encode($packages); ?>,
            taxs: <?php echo json_encode($taxs); ?>,
            expenses: <?php echo json_encode($expenses); ?>,
            customerObject: <?php echo json_encode($customerObject); ?>,
            resetAddForm: function() {
                $('#service_id').val('');
                $('#package_id').val('');
                app.resource.service_id = null;
                app.resource.package_id = null;
            },
            add: function() {
                var service_id = $('#service_id').val();
                var package_id = $('#package_id').val();
                var package = {};
                for (var index = 0; index < this.packages.length; index++) {
                    var p = this.packages[index];
                    if (p.id == package_id)
                        package = p;
                }

                var item = {
                    service_id: service_id,
                    service: this.services[service_id],
                    package_id: package_id,
                    package: package.name,
                    total: package.price
                };
                app.resource.subscription_lines.push(item);
                this.calculateAll();
                subscription.resetAddForm();
            },
            remove: function(index) {
                app.resource.subscription_lines.splice(index, 1);
                this.calculateAll();
            },
            calcuclateTotal: function() {
                var total = 0;
                for (var index = 0; index < app.resource.subscription_lines.length; index++) {
                    total += app.resource.subscription_lines[index].total;
                }

                app.resource.total = total;
                this.calculateFinalTotal();
            },
            changeTax: function() {
                var tax_id = $('#tax_id').val();
                var taxAmount = 0;
                var tax = {};

                if (tax_id) {
                    tax = this.taxs[tax_id];
                    taxAmount = app.resource.total * (tax.amount / 100);
                    app.resource.tax_amount = taxAmount;
                }

                this.calcuclateTotal();
                this.changeExpenses();
                this.calculateFinalTotal();
            },
            changeExpenses: function() {
                var expenseIds = $('.expenses').val();
                $('.expenses_hidden').val(expenseIds);
                var expensesAmount = 0;

                for (var i = 0; i < expenseIds.length; i++) {
                    var id = expenseIds[i];
                    var expense = this.expenses[id];
                    expensesAmount += expense.price;
                }

                app.resource.custom_field_2 = expensesAmount;
                this.calcuclateTotal();
                this.changeTax();
                this.calculateFinalTotal();
            },
            calculateFinalTotal: function() {
                app.resource.final_total = app.resource.total + app.resource.tax_amount + app.resource
                    .custom_field_2;
            },
            calculateAll: function() {
                this.calcuclateTotal();
                this.changeTax();
                this.changeExpenses();
                this.calculateFinalTotal();
            },
            changeContact: function() {
                var contact_id = $('#contact_id').val();
                var contact = {};

                if (contact_id > 0) {
                    contact = this.customerObject[contact_id];
                }

                app.resource.contact = contact;
            }
        };


        $(document).ready(function() {

            $('.select2').select2();

            $('#contact_id').on('select2:select', function(e) {
                subscription.changeContact();
            });

            $('.expenses').on('select2:select', function(e) {
                subscription.changeExpenses();
            });

            // set expenses
            @if ($subscription->custom_field_1)
                $('.expenses').val(<?php echo json_encode(explode(',', $subscription->custom_field_1)); ?>);
                subscription.changeExpenses();
                subscription.changeTax();
                subscription.changeContact();
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
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
        app = new Vue({
            el: '#app-root',
            data: {
                resource: {
                    tax_id: {{ $subscription->tax_id? $subscription->tax_id : 'null' }},
                    transaction_date: '{{ $subscription->transaction_date }}',
                    custom_field_2: {{ $subscription->custom_field_2? $subscription->custom_field_2  : 0 }},
                    tax_amount: {{ $subscription->tax_amount ? $subscription->tax_amount : 0 }},
                    total: {{ $subscription->getTotal() ? $subscription->getTotal() : 0 }},
                    final_total: {{ $subscription->final_total ? $subscription->final_total : 0 }},
                    @if ($subscription->id)
                        subscription_lines: <?php echo json_encode($subscription->subscription_lines()->get()); ?>,
                        subscription_notes: <?php echo json_encode($subscription->subscription_notes()->get()); ?>,
                    @else
                        subscription_lines: [],
                        subscription_notes: [],
                    @endif
                    contact: <?php echo json_encode($subscription->contact); ?>,
                },
            }
        });
    </script>
@endsection
