@extends('layouts.app')

@section('content')
  

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class=" " >
        <i class='fa fa-users w3-xxlarge new-theme-text' style='margin:4px' ></i>
        @trans( 'user.users' ) 
    </h1> 
</section>

<!-- Main content -->
<section class="content new-content">
    @component('components.widget', ['class' => 'box-primary', 'title' => ""])
    @can('user.create')
    @slot('tool')
    <div class="box-tools">
        <a class="add_btn" href="{{action('ManageUserController@create')}}">
            <i class="fa fa-plus"></i> @trans( 'messages.add' )</a>
    </div>
    @endslot
    @endcan
    @can('user.view')
    <div class="table-responsive light-gray w3-border w3-border-light-gray"> 

        {{-- <table class="table table-bordered table-striped" id="users_table">
            <thead>
                <tr>
                    <th>@trans( 'business.username' )</th>
                    <th>@trans( 'user.name' )</th>
                    <th>@trans( 'user.role' )</th>
                    <th>@trans( 'business.email' )</th>
                    <th>@trans( 'messages.action' )</th>
                </tr>
            </thead>
        </table> --}}
        <table id="users_table" data-title="{{ __( 'user.users' ) }}" class="custom-datatable table table-striped table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>@trans( 'business.username' )</th>
                    <th>@trans( 'user.name' )</th>
                    <th>@trans( 'user.role' )</th>
                    <th>@trans( 'business.email' )</th>
                    <th>@trans( 'messages.action' )</th>
                </tr>
            </thead>
        </table>
    </div>
    @endcan
    @endcomponent

    <div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->  

@endsection

@section('javascript')
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/users',
                    columnDefs: [ {
                        "targets": [4],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"username"},
                        {"data":"full_name"},
                        {"data":"role"},
                        {"data":"email"},
                        {"data":"action"}
                    ]
                });
        $(document).on('click', 'button.delete_user_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_user,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                users_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });
        
    });
    
    
</script>
@endsection

