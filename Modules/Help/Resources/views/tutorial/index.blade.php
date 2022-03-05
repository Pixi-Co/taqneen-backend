 
@extends('layouts.app')
@section('title', 'Tutorial')
    
@section('content')
 
<!-- Main content -->
<section class="content"> 
        <div class="">
            <button type="button" class="add_btn btn-modal" data-href="{{ action('\Modules\Help\Http\Controllers\TutorialController@create') }}"
                data-container=".tutorials_modal">
                <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
        </div>  
        <div class="table-responsive w3-light-gray">
            <table data-title="@trans('tutorial')" class="table table-bordered table-striped" id="tutorialsinesType_table">
                <thead>
                    <tr> 
                        <th>{{ __( 'title_ar' ) }}</th>
                        <th>{{ __( 'title_en' ) }}</th>
                        <th>@trans( 'description_en' )</th>
                        <th>@trans( 'description_ar' )</th>
                        <th>@trans( 'position' )</th>
                        <th>@trans( 'step' )</th> 
                        <th>@trans( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        </div> 


    <div class="modal fade tutorials_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content --> 
@stop
@section('javascript')

 
<script>
    
    //tutorialsiness type table
    var tutorial_table = $('#tutorialsinesType_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/tutorial',
        @include("layouts.partials.datatable_plugin")
        columnDefs: [{
            targets: 2,
            orderable: false,
            searchable: false,
        }, ],
        columns: [
            {
                data: 'title_ar' 
            },
            {
                data: 'title_en' 
            },
            {
                data: 'description_ar' 
            },
            {
                data: 'description_en' 
            },
            {
                data: 'position'
            },
            { 
                data: 'step'
            }, 
            { 
                data: 'action'
            }
        ], 
        "initComplete": function(settings, json) { 
            $(document).on('click', 'button.delete_tutorial_button', function() {
                swal({
                    title: LANG.sure,
                    text: LANG.confirm_delete_tutorial,
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
                                    tutorials_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
            
            $(document).on('click', 'button.edit_tutorial_button', function() {
                $('div.tutorials_modal').load($(this).data('href'), function() {
                    $(this).modal('show');
/*
                    $('form#tutorial_edit_form').submit(function(e) {
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
                                    $('div.tutorials_modal').modal('hide');
                                    toastr.success(result.msg);
                                    tutorials_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    });
                    */
                    formAjax(true);
                });
            }); 
        }
    });

    $(document).on('click', 'button.add_btn', function() {
        $('div.tutorials_modal').load($(this).data('href'), function() {
            $(this).modal('show');
            //$('form#quick_add_tutorial_form').attr('action', $(this).data('href'));
             
        });
    }); 

 
    $(document).on('click', 'button.delete_tutorial_button', function() {
        removeItem();
    });
</script>
@endsection
 

