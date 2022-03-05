 
@extends('layouts.app')
@section('title', 'Bussiess Type')
    
@section('content')
 
<!-- Main content -->
<section class="content"> 
        <div class="">
            <button type="button" class="add_btn btn-modal" data-href="{{ action('BussinessTypeController@create') }}"
                data-container=".buss_modal">
                <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
        </div>  
        <div class="table-responsive w3-light-gray">
            <table data-title="Bussiess Type" class="table table-bordered table-striped" id="bussinesType_table">
                <thead>
                    <tr>
                        <th>@trans( 'user.name' )</th>
                        <th>@trans( 'brand.short_description' )</th>
                        <th>@trans( 'lang_v1.is_active' )</th>
                        <th>@trans( 'lang_v1.icon' )</th>
                        <th>@trans( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        </div> 


    <div class="modal fade buss_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content --> 
@stop
@section('javascript')

 
<script>
    
    //bussiness type table
    var buss_table = $('#bussinesType_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/business_types',
        @include("layouts.partials.datatable_plugin")
        columnDefs: [{
            targets: 2,
            orderable: false,
            searchable: false,
        }, ],
        columns: [
            {
                data: 'name' 
            },
            {
                data: 'description'
            },
            { 
                data: 'active'
            },
            { 
                data: 'icon'
            },
            { 
                data: 'action'
            }
        ], 
        "initComplete": function(settings, json) { 
            $(document).on('click', 'button.delete_bussinesstype_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_bus,
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
                                    buss_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
            
            $(document).on('click', 'button.edit_bussinesstype_button', function() {
                $('div.buss_modal').load($(this).data('href'), function() {
                    $(this).modal('show');

                    $('form#bus_edit_form').submit(function(e) {
                        e.preventDefault();
                        $(this)
                            .find('button[type="submit"]')
                            .attr('disabled', true);
                        var data = $(this).serialize();

                        $.ajax({
                            method: 'POST',
                            url: $(this).attr('action'),
                            dataType: 'json',
                            data: data,
                            success: function(result) {
                                if (result.success == true) {
                                    $('div.buss_modal').modal('hide');
                                    toastr.success(result.msg);
                                    buss_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    });
                });
            }); 
        }
    });

    $(document).on('click', 'button.add_btn', function() {
        $('div.buss_modal').load($(this).data('href'), function() {
            $(this).modal('show');
            //$('form#quick_add_bus_form').attr('action', $(this).data('href'));
             
        });
    }); 

 
    $(document).on('click', 'button.delete_bus_button', function() {
        removeItem();
    });
</script>
@endsection
 

