@extends('layouts.app')
@section('title', __( 'lang_v1.customer_groups' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans( 'shipping.shipping_zones' )</h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'shipping.all_shipping_zones' )])
        @can('customer.create')
            @slot('tool')
                <div class="box-tools">
                    <button data-href="{{action("ShippingFeesController@create", [$company_id])}}" class="btn btn-block btn-primary btn-modal add_shipping_fees_button"><i class="fa fa-plus"></i> Add</button>
                </div>
            @endslot
        @endcan
        @can('customer.view')
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="shipping_fees_table">
                    <thead>
                        <tr>
                            <th>@trans( 'shipping.zone_name' )</th>
                            <th>@trans( 'shipping.amount' )</th>
                            <th>@trans( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
                </div>
        @endcan
    @endcomponent

    <div class="modal fade shipping_fees_form" id="shippingFeesForm" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
    $(document).ready(function(){
        $('#shippingFeesForm').on('shown.bs.modal', function(e) {
            var p = $(this);
            $('#shippingFeesForm .select2').select2({dropdownParent:p});            
        });

        let url = "{{ action('ShippingFeesController@index', ['company' => $company_id ]) }}";
        //Customer Group table
        let shipping_fees_table = $('#shipping_fees_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'zone_name'},
                {data: 'amount'},
                {data: 'action'}
            ]
            // columnDefs: [
            //     {
            //         targets: 2,
            //         orderable: false,
            //         searchable: false,
            //     },
            // ],
        });

        $(document).on('click', 'button.add_shipping_fees_button', function() {
            $('div.shipping_fees_form').load($(this).data('href'), function() {
                $(this).modal('show');

                $('form#shipping_fees_add_form').submit(function(e) {
                    e.preventDefault();
                    let data = $(this).serialize();

                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success === true) {
                                $('div.shipping_fees_form').modal('hide');
                                shipping_fees_table.ajax.reload();
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
