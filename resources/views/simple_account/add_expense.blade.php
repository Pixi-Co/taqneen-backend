@extends("layouts.app")

@section("css")
<style>
    .expense-label {
        min-width: 100px;
    }

    .no-border, .no-border tr, .no-border th, .no-border td {
        border: none!important;
    }

    .form-control {
        background-color: #fbfbfb!important;
    }
    .padding-0 .padding-0 td, .padding-0 th {
        padding: 0px!important;
    }
</style>
@endsection


@section("content")


<div class="w3-block w3-padding">
    <div class="w3-padding w3-white w3-round sb-shadow text-capitalize">
        <h2>
            {{ __('add book entiries') }}
        </h2>
        <hr>
        <form action="{{ route('expense.simple_create') }}" method="post"  class="form " >
            @csrf
            <div class="row">
    
                <div class="col-md-6">
                    <table class="w3-table w3-border-0 no-border">
                        <tr>
                            <th>{{ __('location') }}</th>
                            <td>
                                <select class="form-control" name="location_id" required="">
                                    @foreach($business_locations as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('ref_no') }}</th>
                            <td>
                                <input type="text" class="form-control" name="ref_no">
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('date') }}</th>
                            <td>
                                <input type="text" required="" readonly value="{{ @format_datetime('now') }}" style="width: 100%" class="form-control" name="transaction_date" >
                            </td>
                        </tr> 
                    </table> 
                </div>
    
                <div class="col-md-6">
                    <table class="w3-table w3-border-0 no-border"> 
                        <tr>
                            <th>{{ __('notes') }}</th>
                            <td>
                                <textarea class="form-control" name="additional_notes" ></textarea>
                            </td>
                        </tr> 
                    </table> 
                </div> 

            </div>

            <br>

            <div class="row">
                <table class="table table-bordered expense_table">
                    <tr class="w3-green w3-round" > 
                        <th>{{ __('account_name') }}</th>
                        <th>{{ __('currency') }}</th>
                        <th>{{ __('debit') }}</th>
                        <th>{{ __('crebit') }}</th>
                        <th>{{ __('center_of_cost') }}</th>
                        <th></th>
                    </tr>

                    <tr class="copy-row padding-0" >
                        <td>
                            <select name="account_id[]" class="form-control emtry-input" required="" >
                                @foreach($accounts as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" readonly value="{{ $currency->code }}" class="form-control">
                        </td>
                        <td>
                            <input type="number" name="debit[]" class="form-control emtry-input">
                        </td>
                        <td>
                            <input type="number" name="credit[]" class="form-control emtry-input">
                        </td>
                        <td>
                            <select name="expense_category_id[]" class="form-control emtry-input" required="" >
                                @foreach($expense_categories as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" onclick="removeRow($(this).parent().parent())" class="btn btn-danger" >
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </table>

            </div> 
            <button type="button" onclick="addNewRow()" class="btn btn-default" >
                <i class="fa fa-plus"></i>
            </button>
            <br>
            <div class="w3-center">
                <button class="add_btn">
                    {{ __('save') }}
                </button>
            </div>
    
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    function addNewRow() {
        var row = document.createElement('tr');
        row.className = "padding-0 new-row";
        row.innerHTML = $('.copy-row').html();
        $(row).find('.emtry-input').val('');
        $(row).find('select').select2();

        $('.expense_table').append(row); 
        toastr.success('{{ __("new row created") }}');
    }

    function removeRow(row) {
        if ($('.expense_table .padding-0').length <= 1)
            return toastr.error('{{ __("leave at least one row") }}');
 
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_unit,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                row.remove();
                toastr.success('{{ __("row removed") }}');
            }
        });
    }

    $(document).ready(function(){

        formAjax(false, function(r){
            if (r.status == 1)
            $('.new-row').remove();
        });
        
    });
</script>
@endsection
