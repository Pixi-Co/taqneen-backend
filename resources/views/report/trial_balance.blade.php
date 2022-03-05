@extends('layouts.app')
@section('title', __( 'trial balance' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @trans( 'trial balance' )
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2>{{session()->get('business.name')}} - @trans( 'report.profit_loss' )</h2></div>
    
    <form action="" method="get">
        @csrf
        <div class="row no-print hidden">
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
        <table class="w3-table text-center w3-white table-bordered w3-large table-striped"> 
            <tr class="w3-green" >
                <td rowspan="2">
                    <b class="w3-padding" >{{ __('account type') }}</b>
                </td> 
                <td colspan="2" >
                    <b >{{ __('openning balance') }}</b>
                </td> 
                <td colspan="2" >
                    <b >{{ __('balance per period') }}</b>
                </td> 
                <td colspan="2" >
                    <b >{{ __('final balance') }}</b>
                </td> 
            </tr>
            <tr class="w3-green" > 

                <td><b >{{ __('debit') }}</b></td>
                <td><b >{{ __('credit') }}</b></td>

                <td><b >{{ __('debit') }}</b></td>
                <td><b >{{ __('credit') }}</b></td>

                <td><b >{{ __('debit') }}</b></td>
                <td><b >{{ __('credit') }}</b></td>
            </tr>
            
            @foreach($data as $key => $value)
            @php
                $final = $value['start'] + $value['process'];
            @endphp
            <tr>
                <td>@trans($key)</td>

                <td class="display_currency" >{{ $value['start'] < 0? $value['start'] * -1 : 0 }}</td>
                <td class="display_currency" >{{ $value['start'] > 0? $value['start'] : 0 }}</td>

                <td class="display_currency" >{{ $value['process'] < 0? $value['process'] * -1 : 0 }}</td>
                <td class="display_currency" >{{ $value['process'] > 0? $value['process'] : 0 }}</td>  

                <td class="display_currency" >{{ $final < 0? $final * -1 : 0 }}</td>
                <td class="display_currency" >{{ $final > 0? $final : 0 }}</td>  
            </tr>
            @endforeach

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
