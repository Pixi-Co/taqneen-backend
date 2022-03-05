@extends('layouts.app')
@section('title', __( 'income statement' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @trans( 'income statement' )
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2>{{session()->get('business.name')}} - @trans( 'report.profit_loss' )</h2></div>
    
    <form action="" method="get">
        @csrf
        <div class="row no-print">
            <div class="col-md-4  col-xs-4">
                <div class="input-">
                    
                     <select class="form-control select2" name="location_id" id="profit_loss_location_filter">
                        @foreach($business_locations as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-xs-4">
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
            <div class="col-md-4 col-xs-4 text-left">
                <div class="form-group text-left"> 
                    <button class="btn w3-green">{{ "submit" }}</button>
                </div>
            </div>
        </div> 
    </form>
    <br>
    <br>

    <div class="w3-block">
        <table class="w3-table w3-white table-bordered w3-large">
            <tr>
                <td></td> 
                <td>{{ $start_date }} - {{ $end_date }}</td>
            </tr>
            <tr>
                <td>
                    <b >{{ __('Revenues') }}</b>
                </td>
                <td>  
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Sales Income') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_sell'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Other Income') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['other_income'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Sales Discount') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_sell_discount'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <b>
                        {{ __('Total Revenue') }}
                    </b>
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_revenue'] }}
                    </span>
                </td>
            </tr>
            
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <b>{{ __('Cost of Sales') }}</b>
                </td>
                <td> 
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Purchases-Finished Goods') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['opening_stock'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Cost of Sales-Freight') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_purchase_shipping_charge'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Inventory Adjustments') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_adjustment'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Purchase Returns and Allowance') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_purchase_return'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    {{ __('Purchase Discounts') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_purchase_discount'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <b>{{ __('Total Cost of Sales') }}</b>
                </td>
                <td> 
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_cost_of_sales'] }}
                    </span> 
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <b>{{ __('Gross Profit') }}</b>
                </td>
                <td> 
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['gross_profit'] }}
                    </span> 
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>
                    <b>{{ __('Expenses') }}</b>
                </td>
                <td> 
                </td>
            </tr>
            @foreach($data['expense_rows'] as $row)
            <tr>
                <td>
                    {{ $row->expense_name }}
                </td>
                <td> 
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $row->total_expense }}
                    </span>
                </td>
            </tr>
            @endforeach
            <tr>
                <td>
                    {{ __('Transporation Expenses') }}
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_transfer_shipping_charges'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <b>{{ __('Total Expenses') }}</b>
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['total_expense'] }}
                    </span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <b>{{ __('Net Profit') }}</b>
                </td>
                <td> 
                    <span class="display_currency" data-currency_symbol="true">
                        {{ $data['net_profit'] }}
                    </span> 
                </td>
            </tr>
        </table>
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    $(document).ready( function() {
         

    });
</script>

@endsection
