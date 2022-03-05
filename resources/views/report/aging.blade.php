@extends('layouts.app')
@section('title', __( 'aging report' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @trans( 'aging report' )
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2>{{session()->get('business.name')}} - @trans( 'report.profit_loss' )</h2></div>
    
    <form action="" method="get">
        @csrf
        <div class="row no-print">
            <div class="col-md-4  col-xs-4">
                <select name="type" class="form-control" value="" >
                    <option value="customer" {{ $type=='customer'? 'selected' : '' }}>{{ __('customer') }}</option>
                    <option value="supplier" {{ $type=='supplier'? 'selected' : '' }}>{{ __('supplier') }}</option>
                    <option value="product" {{ $type=='product'? 'selected' : '' }}>{{ __('product') }}</option> 
                </select>
            </div>
            <!--
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
        -->
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
        <table data-title="{{ __($type . " aging report") }}" class="w3-table w3-white table-bordered w3-large w3-round-large" 
        id="aging_table"
        style="border: 1px solid gray!important" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __($type) }}</th>
                    <th>{{ __('0-30 days') }}</th>
                    <th>{{ __('31-60 days') }}</th>
                    <th>{{ __('61-90 days') }}</th>
                    <th>{{ __('91-120 days') }}</th>
                    <th>{{ __('121+ days') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $class = $type != 'product'? 'display_currency' : '';
                @endphp
                @foreach($resources as $resource)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td class="w3-display-container" >
                    {{ $resource->name }}

                    @if ($type != 'product')
                    @php
                    $v2 = $resource->getAgeTotal('0', null);
                    @endphp
                    <span class="w3-right {{ $class }}" data-currency_symbol="true">
                        {{ $v2 }}
                    </span> 
                    @endif
                </td>
                <td> 
                    @php
                        $v1 = $resource->getAgeTotal('0', 30);
                    @endphp
                    <span class="{{ $class }} {{ $v1 > 0? 'w3-text-deep-orange' : '' }}" data-currency_symbol="true">
                        {{ $v1 }}
                    </span>
                </td>
                <td> 
                    @php
                    $v2 = $resource->getAgeTotal(31, 60);
                    @endphp
                    <span class="{{ $class }} {{ $v2 > 0? 'w3-text-deep-orange' : '' }}" data-currency_symbol="true">
                        {{ $v2 }}
                    </span> 
                </td>
                <td> 
                    @php
                    $v3 = $resource->getAgeTotal(61, 90);
                    @endphp
                    <span class="{{ $class }} {{ $v3 > 0? 'w3-text-deep-orange' : '' }}" data-currency_symbol="true">
                        {{ $v3 }}
                    </span>  
                </td>
                <td> 
                    @php
                    $v4 = $resource->getAgeTotal(91, 120);
                    @endphp
                    <span class="{{ $class }} {{ $v4 > 0? 'w3-text-deep-orange' : '' }}" data-currency_symbol="true">
                        {{ $v4 }}
                    </span>  
                </td>
                <td> 
                    @php
                    $v5 = $resource->getAgeTotal(121, null);
                    @endphp
                    <span class="{{ $class }} {{ $v5 > 0? 'w3-text-deep-orange' : '' }}" data-currency_symbol="true">
                        {{ $v5 }}
                    </span>  
                </td>
                 
            </tr>
            @endforeach
            </tbody>
             
        </table>
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
    $(document).ready( function() {
         //aging_table
        $aging_table = $('#aging_table').DataTable({ 
            @include("layouts.partials.datatable_plugin")
        });
    });
</script>

@endsection
