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

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="shipping_settlement_table">
                <thead>
                    <tr>
                        <th>@trans( 'shipping.status' )</th>
                        <th>@trans( 'shipping.final_total' )</th>
                        <th>@trans( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
            </div>

    @endcomponent

    <div class="modal fade settle_shipping_company" id="settleShipping" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
    $(document).ready(function(){

        var url = "{{ action('ShippingSettlementController@index', ['company' => $company_id ]) }}"
        //Customer Group table
        var shipping_fees_table = $('#shipping_settlement_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                { data: 'status' },
                { data: 'final_total' },
                { data: 'action' }
            ]
            // columnDefs: [
            //     {
            //         targets: 2,
            //         orderable: false,
            //         searchable: false,
            //     },
            // ],
        });

    });
</script>
@endsection
