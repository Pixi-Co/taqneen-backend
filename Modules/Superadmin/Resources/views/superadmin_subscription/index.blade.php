@extends('layouts.app')
@section('title', 'Superadmin Subscription')

@section('content')
@include('superadmin::layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans( 'superadmin::lang.subscription' )
        <small>@trans( 'superadmin::lang.view_subscription' )</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    @include('superadmin::layouts.partials.currency')

    <div class="box box-solid">  
        <div class="box-body">
            @can('superadmin')
                <div class="table-responsive w3-light-gray">
            	<table data-title="@trans('Superadmin Subscription')" class="table table-bordered table-striped" id="superadmin_subscription_table">
            		<thead>
            			<tr>
                            <th>@trans( 'superadmin::lang.business_name' )</th>
            				<th>@trans( 'superadmin::lang.package_name' )</th>
                            <th>@trans( 'superadmin::lang.status' )</th>
                            <th>@trans( 'superadmin::lang.start_date' )</th>
            				<th>@trans( 'superadmin::lang.trial_end_date' )</th>
                            <th>@trans( 'superadmin::lang.end_date' )</th>
            				<th>@trans( 'superadmin::lang.price' )</th>
                            <th>@trans( 'superadmin::lang.paid_via' )</th>
            				<th>@trans( 'superadmin::lang.payment_transaction_id' )</th>
                            <th>@trans( 'superadmin::lang.action' )</th>
            			</tr>
            		</thead>
            	</table>
                </div>
            @endcan
        </div>

    </div>
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

</section>
<!-- /.content -->

@endsection

@section('javascript')
<script>
    $(document).ready(function(){

        // superadmin_subscription_table
        var superadmin_subscription_table = $('#superadmin_subscription_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/superadmin/superadmin-subscription',
                        @include("layouts.partials.datatable_plugin")
                        columnDefs:[{
                                "targets": 9,
                                "orderable": false,
                                "searchable": false
                            }],
                        "fnDrawCallback": function (oSettings) {
                         __currency_convert_recursively($('#superadmin_subscription_table'), true);
                        }
                    });


        // change_status button
        $(document).on('click', 'button.change_status', function(){
            $("div#statusModal").load($(this).data('href'), function(){
                $(this).modal('show');
                $("form#status_change_form").submit(function(e){
                    e.preventDefault();
                    var url = $(this).attr("action");
                    var data = $(this).serialize();
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        data: data,
                        url: url,
                        success:function(result){
                            if( result.success == true){
                                $("div#statusModal").modal('hide');
                                toastr.success(result.msg);
                                superadmin_subscription_table.ajax.reload();
                            }else{
                                toastr.error(result.msg);
                            }
                        }
                    });
                });
            });
        });

        $(document).on('shown.bs.modal', '.view_modal', function(){
            $('.edit-subscription-modal .datepicker').datepicker({
                autoclose: true,
                format:datepicker_date_format
            });
            $("form#edit_subscription_form").submit(function(e){
              e.preventDefault();
              var url = $(this).attr("action");
              var data = $(this).serialize();
              $.ajax({
                  method: "POST",
                  dataType: "json",
                  data: data,
                  url: url,
                  success:function(result){
                      if( result.success == true){
                          $("div.view_modal").modal('hide');
                          toastr.success(result.msg);
                          superadmin_subscription_table.ajax.reload();
                      }else{
                          toastr.error(result.msg);
                      }
                  }
              });
            });
        });

    });
</script>
@endsection
