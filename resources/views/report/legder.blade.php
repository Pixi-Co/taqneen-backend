@extends('layouts.app')
@section('title', __( 'ledger report' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @trans( 'ledger report' )
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section">
        <h2>{{session()->get('business.name')}} - @trans( 'ledger' )</h2>
    </div>
    
    <form action="" method="get">
        @csrf
        <div class="row no-print">
            <div class="col-md-3  col-xs-3">
                <select name="type" class="form-control debit_credit" value="" >
                    <option value="" >{{ __('all') }}</option>
                    <option value="debit" >{{ __('debit') }}</option>
                    <option value="credit" >{{ __('credit') }}</option>
                </select>
            </div>  
            <div class="col-md-3  col-xs-3">
                <select name="type" class="form-control contact_type" value="" >
                    <option value="customer" {{ $type=='customer'? 'selected' : '' }}>{{ __('customer') }}</option>
                    <option value="supplier" {{ $type=='supplier'? 'selected' : '' }}>{{ __('supplier') }}</option>
                </select>
            </div> 
            <div class="col-md-3 col-xs-3">
                <div class="form-group ">
                    <div class="input-">
                        <input type="hidden" name="start_date" class="start_date">
                        <input type="hidden" name="end_date" class="end_date">
                      <button type="button" class="btn btn-primary" id="profit_loss_date_filter">
                        <span>
                          <i class="fa fa-calendar"></i> {{ __('messages.filter_by_date') }}
                        </span>
                        <i class="fa fa-caret-down"></i>
                      </button>
                    </div>
                </div>
            </div> 
            <div class="col-md-3 col-xs-3 text-left">
                <div class="form-group text-left"> 
                    <button class="btn w3-green" type="button" onclick="loadLedger()" >{{ "submit" }}</button>
                </div>
            </div>
        </div> 
    </form>
    <br>
    <br>

    <div class="w3-block" id="ledgerContent" >
         
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    function loadLedger() { 

        var start_date = $('.start_date').val();
        var end_date = $('.end_date').val();
        //var transaction_types = $('input.transaction_types:checked').map(function(i, e) {return e.value}).toArray();
        //var show_payments = $('input#show_payments').is(':checked');
        var transaction_types = null;
        var show_payments = true;
 
        var data = {
            start_date :start_date,
            end_date: end_date,
            transaction_types: transaction_types,
            show_payments: show_payments,
            type: "report",
            debit_credit: $('.debit_credit').val(),
            contact_type: $('.contact_type').val()
        };
        $.ajax({
            url: '/contacts/ledger?' + $.param(data),
            dataType: 'html',
            success: function(result) {
                $('#ledgerContent')
                    .html(result);
                __currency_convert_recursively($('#ledgerContent'));
    
                $('#ledger_table').DataTable({ 
                    @include("layouts.partials.datatable_plugin")  
                });
            },
        });
    }

    $(document).ready( function() {  
        loadLedger();
    });


</script>

@endsection
