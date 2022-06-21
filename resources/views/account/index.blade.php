@extends('layouts.app')
@section('title', __('lang_v1.payment_accounts'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans('lang_v1.payment_accounts') 
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @if(!empty($not_linked_payments))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <ul>
                        @if(!empty($not_linked_payments))
                            <li>{!! __('account.payments_not_linked_with_account', ['payments' => $not_linked_payments]) !!} <a href="{{action('AccountReportsController@paymentAccountReport')}}">@trans('account.view_details')</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    @endif
{{--    @can('account.access')--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-pills mb-3 setting-tabs w3-padding">
                    <li class="nav-item active">
                        <a class="nav-link" href="#other_accounts" data-toggle="tab">
                            <i class="fa fa-book"></i> <strong>@trans('account.accounts')</strong>
                        </a>
                    </li>
                    {{--
                    <li>
                        <a href="#capital_accounts" data-toggle="tab">
                            <i class="fa fa-book"></i> <strong>
                            @trans('account.capital_accounts') </strong>
                        </a>
                    </li>
                    --}}
                    <li class="nav-item" onclick="editDatatable()" >
                        <a class="nav-link" href="#account_types" data-toggle="tab">
                            <i class="fa fa-list"></i> <strong>
                            @trans('lang_v1.account_types') </strong>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="other_accounts">
                        <div class="row">
                            <div class="col-md-12"> 
                                    <div class="col-md-4">
                                        {!! Form::select('account_status', ['active' => __('business.is_active'), 'closed' => __('account.closed')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'account_status']); !!}
                                    </div>
                                    <div class="col-md-8">
                                        <button type="button" class="add_btn btn-modal pull-right" 
                                            data-container=".account_model"
                                            data-href="{{action('AccountController@create')}}">
                                            <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
                                    </div> 
                            </div>
                            <div class="col-sm-12">
                            <br>
                                <div class="table-responsive w3-light-gray">
                                    <table data-title="@trans('account.accounts')" class="table table-bordered table-striped" id="other_account_table">
                                        <thead>
                                            <tr>
                                                <th>@trans( 'lang_v1.name' )</th>
                                                <th>@trans( 'lang_v1.account_type' )</th>
                                                <th>@trans( 'lang_v1.account_sub_type' )</th>
                                                <th>@trans('account.account_number')</th>
                                                <th>@trans( 'brand.note' )</th>
                                                <th>@trans('lang_v1.balance')</th>
                                                <th>@trans('lang_v1.added_by')</th>
                                                <th>@trans('is_for_discounts')</th>
                                                <th>@trans('is_for_taxs')</th>
                                                <th>@trans( 'messages.action' )</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="tab-pane" id="capital_accounts">
                        <table class="table table-bordered table-striped" id="capital_account_table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>@trans( 'lang_v1.name' )</th>
                                    <th>@trans('account.account_number')</th>
                                    <th>@trans( 'brand.note' )</th>
                                    <th>@trans('lang_v1.balance')</th>
                                    <th>@trans( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    --}}
                    <div class="tab-pane" id="account_types">
                        <div class="row hidden">
                            <div class="col-md-12">
                                <button type="button" class="add_btn btn-modal pull-right" 
                                    data-href="{{action('AccountTypeController@create')}}"
                                    data-container="#account_type_modal">
                                    <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="w3-padding">
                                    @include("layouts.js.jstree_option", ["id" => "js_tree_account_type"]) 
                                </div>
                            </div>
                            <div class="col-md-12 w3-light-gray w3-padding hidden">
                                
                                <table data-title="@trans('lang_v1.account_types')" class="table table-striped table-bordered" id="account_types_table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>@trans( 'lang_v1.name' )</th>
                                            <th>@trans( 'messages.action' )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($account_types as $account_type)
                                            <tr class="account_type_{{$account_type->id}}">
                                                <td>{{$account_type->name}}</td>
                                                <td>
                                                    
                                                    {!! Form::open(['url' => action('AccountTypeController@destroy', $account_type->id), 'method' => 'delete' ]) !!}
                                                    <button type="button" class="btn btn-primary btn-modal btn-xs" 
                                                    data-href="{{action('AccountTypeController@edit', $account_type->id)}}"
                                                    data-container="#account_type_modal">
                                                    <i class="fa fa-edit"></i> @trans( 'messages.edit' )</button>

                                                    <button type="button" class="btn btn-danger btn-xs delete_account_type" >
                                                    <i class="fa fa-trash"></i> @trans( 'messages.delete' )</button>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr> 
                                                @foreach($account_type->sub_types as $sub_type)
                                                <tr>
                                                    <td>&nbsp;&nbsp;-- {{$sub_type->name}}</td>
                                                    <td>
                                                        

                                                        {!! Form::open(['url' => action('AccountTypeController@destroy', $sub_type->id), 'method' => 'delete' ]) !!}
                                                            <button type="button" class="btn btn-primary btn-modal btn-xs" 
                                                        data-href="{{action('AccountTypeController@edit', $sub_type->id)}}"
                                                        data-container="#account_type_modal">
                                                        <i class="fa fa-edit"></i> @trans( 'messages.edit' )</button>
                                                            <button type="button" class="btn btn-danger btn-xs delete_account_type" >
                                                            <i class="fa fa-trash"></i> @trans( 'messages.delete' )</button>
                                                            {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    @endcan--}}
    
    <div class="modal fade account_model" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel" id="account_type_modal">
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
<script>
    $(document).ready(function(){

        $(document).on('click', 'button.close_account', function(){
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete)=>{
                if(willDelete){
                     var url = $(this).data('url');

                     $.ajax({
                         method: "get",
                         url: url,
                         dataType: "json",
                         success: function(result){
                             if(result.success == true){
                                toastr.success(result.msg);
                                capital_account_table.ajax.reload();
                                other_account_table.ajax.reload();
                             }else{
                                toastr.error(result.msg);
                            }

                        }
                    });
                }
            });
        });

        $(document).on('submit', 'form#edit_payment_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: "POST",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success:function(result){
                    if(result.success == true){
                        $('div.account_model').modal('hide');
                        toastr.success(result.msg);
                        capital_account_table.ajax.reload();
                        other_account_table.ajax.reload();
                    }else{
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $(document).on('submit', 'form#payment_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: "post",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success:function(result){
                    if(result.success == true){
                        $('div.account_model').modal('hide');
                        toastr.success(result.msg);
                        capital_account_table.ajax.reload();
                        other_account_table.ajax.reload();
                    }else{
                        toastr.error(result.msg);
                    }
                }
            });
        });

        // account_types_table
        var account_types_table = $('#account_types_table').DataTable({ 
          @include("layouts.partials.datatable_plugin")  
        });

        // capital_account_table
        capital_account_table = $('#capital_account_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/account/account?account_type=capital',
                        @include("layouts.partials.datatable_plugin") 
                        columnDefs:[{
                                "targets": 5,
                                "orderable": false,
                                "searchable": false
                            }],
                        columns: [
                            {data: 'name', name: 'name'},
                            {data: 'account_number', name: 'account_number'},
                            {data: 'note', name: 'note'},
                            {data: 'balance', name: 'balance', searchable: false},
                            {data: 'action', name: 'action'}
                        ],
                        "fnDrawCallback": function (oSettings) {
                            __currency_convert_recursively($('#capital_account_table'));
                        }
                    });
        // capital_account_table
        other_account_table = $('#other_account_table').DataTable({
                        processing: true,
                        serverSide: true,
                        @include("layouts.partials.datatable_plugin") 
                        ajax: {
                            url: '/account/account?account_type=other',
                            data: function(d){
                                d.account_status = $('#account_status').val();
                            }
                        },
                        columnDefs:[{
                                "targets": 7,
                                "orderable": false,
                                "searchable": false
                            }],
                        columns: [
                            {data: 'name', name: 'accounts.name'},
                            {data: 'parent_account_type_name', name: 'pat.name'},
                            {data: 'account_type_name', name: 'ats.name'},
                            {data: 'account_number', name: 'accounts.account_number'},
                            {data: 'note', name: 'accounts.note'},
                            {data: 'balance', name: 'balance', searchable: false},
                            {data: 'added_by', name: 'u.first_name'},
                            {data: 'is_for_discount', name: 'is_for_discount'},
                            {data: 'is_for_tax', name: 'is_for_tax'},
                            {data: 'action', name: 'action'}
                        ],
                        "fnDrawCallback": function (oSettings) {
                            __currency_convert_recursively($('#other_account_table'));
                        }
                    });

    });

    $('#account_status').change( function(){
        other_account_table.ajax.reload();
    });

    $(document).on('submit', 'form#deposit_form', function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
          method: "POST",
          url: $(this).attr("action"),
          dataType: "json",
          data: data,
          success: function(result){
            if(result.success == true){
              $('div.view_modal').modal('hide');
              toastr.success(result.msg);
              capital_account_table.ajax.reload();
              other_account_table.ajax.reload();
            } else {
              toastr.error(result.msg);
            }
          }
        });
    });

    $('.account_model').on('shown.bs.modal', function(e) {
        $('.account_model .select2').select2({ dropdownParent: $(this) })
    });

    $(document).on('click', 'button.delete_account_type', function(){
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete)=>{
            if(willDelete){
                $(this).closest('form').submit();
            }
        });
    })

    $(document).on('click', 'button.activate_account', function(){
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willActivate)=>{
            if(willActivate){
                 var url = $(this).data('url');
                 $.ajax({
                     method: "get",
                     url: url,
                     dataType: "json",
                     success: function(result){
                         if(result.success == true){
                            toastr.success(result.msg);
                            capital_account_table.ajax.reload();
                            other_account_table.ajax.reload();
                         }else{
                            toastr.error(result.msg);
                        }

                    }
                });
            }
        });
    });
</script>
@include("layouts.js.jtree", ["id" => "js_tree_account_type", "selectedId" => null])
@endsection
