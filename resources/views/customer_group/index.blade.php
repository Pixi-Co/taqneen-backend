@extends('layouts.app')
@section('title', __( 'lang_v1.customer_groups' ))

@section('content') 

<!-- Main content -->
<section class="content new-content">
    @component('components.widget', ['class' => 'box-primary', 'title' => ''])
        @can('customer.create')
            @slot('tool')
                <div class="box-tools">
                    <button type="button" class="add_btn btn-modal" 
                        data-href="{{action('CustomerGroupController@create')}}" 
                        data-container=".customer_groups_modal">
                        <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
                </div>
            @endslot
        @endcan
        @can('customer.view') 
        <div class="table-responsive light-gray w3-border w3-border-light-gray"> 
                <table data-title="{{ __( 'lang_v1.all_your_customer_groups' ) }}" class="table table-bordered table-striped" id="customer_groups_table">
                    <thead>
                        <tr>
                            <th>@trans( 'lang_v1.customer_group_name' )</th>
                            <th>@trans( 'lang_v1.calculation_percentage' )</th>
                            <th>@trans( 'lang_v1.selling_price_group' )</th>
                            <th>@trans( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
                </div>
        @endcan
    @endcomponent

    <div class="modal fade customer_groups_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
    
    //Customer Group table
    var customer_groups_table = $('#customer_groups_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/customer-group',
        "autoWidth": true,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        dom: 'RlBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'colvis'
        ],
        columnDefs: [{
            targets: 2,
            orderable: false,
            searchable: false,
        }, ],
    });

    $(document).on('click', 'button.edit_customer_group_button', function() {
        $('div.customer_groups_modal').load($(this).data('href'), function() {
            $(this).modal('show');

            $('form#customer_group_edit_form').submit(function(e) {
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.customer_groups_modal').modal('hide');
                            toastr.success(result.msg);
                            customer_groups_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });
    });

    $(document).on('click', 'button.delete_customer_group_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_customer_group,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            customer_groups_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
    
    $(document).on('submit', 'form#customer_group_add_form', function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('div.customer_groups_modal').modal('hide');
                    toastr.success(result.msg);
                    customer_groups_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });
    
    $(document).on('change', '#price_calculation_type', function () {
        var price_calculation_type = $(this).val();

        if (price_calculation_type == 'percentage') {
            $('.percentage-field').removeClass('hide');
            $('.selling_price_group-field').addClass('hide');
        } else {
            $('.percentage-field').addClass('hide');
            $('.selling_price_group-field').removeClass('hide');
        }   
    });
</script>
@endsection
