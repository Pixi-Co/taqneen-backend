@extends('layouts.app')
@section('title', __('shipping.list_shipping_companies'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="box-header">
        <h1>@trans('shipping.shipping_company')</h1>
        <div class="box-tools">
            <button type="button" class="btn btn-block btn-primary btn-modal"
                data-href="{{ action("ShippingCompanyController@create") }}" data-container=".shipping_company_form">
                <i class="fa fa-plus"></i> Add</button>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    @can('account.access')
    <div class="row">
        @foreach ($companies as $company)
        <div class="col-sm-6">
            <div class="well well-lg">
                <div class="user_box">
                    <div class="d-flex p-4">
                        {{-- <div class="">
                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                src="../images/companies/aramex.jpeg">
                        </div> --}}
                        <div class="user_head">
                            <a href="" class="user_name">{{ $company->name }}</a>
                        </div>
                        <div class="user_buttons d-flex">
                            <button data-href="{{action("ShippingCompanyController@edit", [$company->id])}}" class="btn btn-xs btn-primary edit_shipping_company_button"><i class="glyphicon glyphicon-edit"></i> @trans("messages.edit")</button>
                            <a href="{{action("ShippingFeesController@index", [$company->id])}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> @trans("shipping.list_fees")</a>
{{--                            <a href="{{action("ShippingSettlementController@index", [$company->id])}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> @trans("shipping.list_fees")</a>--}}
{{--                            <button data-href="{{action("ShippingFeesController@create", [$company->id])}}" class="btn btn-xs btn-primary add_shipping_fees_button"><i class="glyphicon glyphicon-edit"></i> @trans("shipping.create_fees")</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endcan

    <div class="modal fade shipping_company_form" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

    <div class="modal fade shipping_fees_form" id="shippingFeesForm" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
<script>
    $(document).ready(function() {

        $('#shippingFeesForm').on('shown.bs.modal', function (e) {
            var p = $(this);
            $('#shippingFeesForm .select2').select2({dropdownParent: p});
        });

        $(document).on('click', 'button.edit_shipping_company_button', function() {
            $('div.shipping_company_form').load($(this).data('href'), function() {
                $(this).modal('show');

                $('form#shipping_company_edit_form').submit(function(e) {
                    e.preventDefault();
                    let data = $(this).serialize();

                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success === true) {
                                $('div.shipping_company_form').modal('hide');
                                location.reload();
                                toastr.success(result.msg);
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                });
            });
        });

    });
</script>
@endsection
