@extends('layouts.app')
@section('title', __('purchase.edit_purchase'))


@section("css")
<style>
	.pr-card {
		background-color: #fff;
		box-shadow: 0 10px 20px rgb(0 0 0 / 10%);
		padding: 30px;
		border-radius: 7px;
		margin: 10px 0;
		height: 300px; 
		color: gray;
	}
</style>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@trans('purchase.edit_purchase') <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('purchase.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i></h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Page level currency setting -->
  <input type="hidden" id="p_code" value="{{$currency_details->code}}">
  <input type="hidden" id="p_symbol" value="{{$currency_details->symbol}}">
  <input type="hidden" id="p_thousand" value="{{$currency_details->thousand_separator}}">
  <input type="hidden" id="p_decimal" value="{{$currency_details->decimal_separator}}">

  @include('layouts.partials.error')

  {!! Form::open(['url' =>  action('PurchaseController@update' , [$purchase->id] ), 'method' => 'PUT', 'id' => 'add_purchase_form', 'files' => true ]) !!}

  @php
    $currency_precision = config('constants.currency_precision', 2);
  @endphp

  <input type="hidden" id="purchase_id" value="{{ $purchase->id }}">

    @component('components.widget', ['class' => 'box-primary w3-padding'])
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if(!empty($default_purchase_status)) c  @else co  @endif">
              <div class="form-group">
                {!! Form::label('supplier_id', __('purchase.supplier') . ':*') !!}
                <div class="input-group"> 
                  {!! Form::select('contact_id', [ $purchase->contact_id => $purchase->contact->name], $purchase->contact_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select') , 'required', 'id' => 'supplier_id']); !!}
                  <span class="input-group-btn"> 
                      <button type="button" style="margin-left: 4px" class="add_new_supplier btn add_select_btn w3-round btn-modal new-theme" data-name="">
                        <i class="fa fa-plus-circle text-primary fa-lg w3-text-white"></i></button>
                  </span>
                </div>
              </div>
              <strong>
                @trans('business.address'):
              </strong>
              <div id="supplier_address_div">
                {!! $purchase->contact->contact_address !!}
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if(!empty($default_purchase_status)) c  @else c  @endif">
              <div class="form-group">
                {!! Form::label('ref_no', __('purchase.ref_no') . '*') !!}
                @show_tooltip(__('lang_v1.leave_empty_to_autogenerate'))
                {!! Form::text('ref_no', $purchase->ref_no, ['class' => 'form-control', 'required']); !!}
              </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-6 w3-padding @if(!empty($default_purchase_status)) c @else c @endif">
              <div class="form-group">
                {!! Form::label('transaction_date', __('purchase.purchase_date') . ':*') !!}
                <div class="input-group"> 
                  {!! Form::text('transaction_date', @format_datetime($purchase->transaction_date), ['class' => 'form-control', 'readonly', 'required']); !!}
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-6 w3-padding  @if(!empty($default_purchase_status)) hide @endif">
              <div class="form-group">
                {!! Form::label('status', __('purchase.purchase_status') . ':*') !!}
                @show_tooltip(__('tooltip.order_status'))
                {!! Form::select('status', $orderStatuses, $purchase->status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select') , 'required']); !!}
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 w3-padding ">
              <div class="form-group">
                {!! Form::label('location_id', __('purchase.business_location').':*') !!}
                @show_tooltip(__('tooltip.purchase_location'))
                {!! Form::select('location_id', $business_locations, $purchase->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'disabled']); !!}
              </div>
            </div>

            <!-- Currency Exchange Rate -->
            <div class="col-lg-4 col-md-4 col-sm-6 w3-padding  @if(!$currency_details->purchase_in_diff_currency) hide @endif">
              <div class="form-group">
                {!! Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*') !!}
                @show_tooltip(__('tooltip.currency_exchange_factor'))
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                  </span>
                  {!! Form::number('exchange_rate', $purchase->exchange_rate, ['class' => 'form-control', 'required', 'step' => 0.001]); !!}
                </div>
                <span class="help-block text-danger">
                  @trans('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name])
                </span>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 w3-padding ">
                <div class="form-group">
                  <div class="multi-input">
                    {!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!} @show_tooltip(__('tooltip.pay_term'))
                    <br/>
                    {!! Form::number('pay_term_number', $purchase->pay_term_number, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]); !!}

                    {!! Form::select('pay_term_type', 
                      ['months' => __('lang_v1.months'), 
                        'days' => __('lang_v1.days')], 
                        $purchase->pay_term_type, 
                      ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select'), 'id' => 'pay_term_type']); !!}
                  </div>
              </div>
          </div>

            <div class="col-lg-12 col-md-12 col-sm-12 w3-padding ">
                <div class="form-group">
                    {!! Form::label('document', __('purchase.attach_document') . ':') !!}
                    {!! Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
                    <p class="help-block">@trans('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                    @includeIf('components.document_help_text')</p>
                </div>
            </div>
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary w3-padding'])
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon w3-round w3-border-0 w3-light-gray">
                    <i class="fa fa-search"></i>
                  </span>
                  {!! Form::text('search_product', null, ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); !!}
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 text-right">
              <div class="form-group">
                <button tabindex="-1" type="button" class="btn btn-link btn-modal"data-href="{{action('ProductController@quickAdd')}}" 
                      data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> @trans( 'product.add_new_product' ) </button>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
              @include('purchase.partials.edit_purchase_entry_row')

              <hr/>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  @trans( 'lang_v1.total_items' ):<span id="total_quantity" class="display_currency" data-currency_symbol="false"></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  @trans( 'purchase.net_total_amount' ):
                  <span id="total_subtotal" class="display_currency">{{$purchase->total_before_tax/$purchase->exchange_rate}}</span>
                      <!-- This is total before purchase tax-->
                      <input type="hidden" id="total_subtotal_input" value="{{$purchase->total_before_tax/$purchase->exchange_rate}}" name="total_before_tax">
                </div>
              </div>
              <div class="pull-right col-md-5 hidden">
                <table class="pull-right col-md-12"> 
                  <tr class="hide">
                    <th class="col-md-7 text-right">@trans( 'purchase.total_before_tax' ):</th>
                    <td class="col-md-5 text-left">
                      <span id="total_st_before_tax" class="display_currency"></span>
                      <input type="hidden" id="st_before_tax_input" value=0>
                    </td>
                  </tr>
                  <tr>
                    <th class="col-md-7 text-right"></th>
                    <td class="col-md-5 text-left">
                      
                    </td>
                  </tr>
                </table>
              </div>

            </div>
        </div>
    @endcomponent

    @component('components.widget', ['class' => 'box-primary w3-padding']) 
      <div class="text-center">
        <b class="w3-large w3-text-gray">@trans( 'purchase.discount' )</b>
        <br>
      </div>
        <div class="row">

          <div class="col-lg-4 col-md-4 col-sm-4 w3-padding"> 
            <div class="pr-card">
              <br>
              <div class="form-group">
                {!! Form::label('discount_type', __( 'purchase.discount_type' ) . ':') !!}
                {!! Form::select('discount_type', [ '' => __('lang_v1.none'), 'fixed' => __( 'lang_v1.fixed' ), 'percentage' => __( 'lang_v1.percentage' )], $purchase->discount_type, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
              </div>
              <div class="form-group">
                {!! Form::label('discount_amount', __( 'purchase.discount_amount' ) . ':') !!}
                {!! Form::text('discount_amount', 

                ($purchase->discount_type == 'fixed' ? 
                  number_format($purchase->discount_amount/$purchase->exchange_rate, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator)
                :
                  number_format($purchase->discount_amount, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator)
                )
                , ['class' => 'form-control input_number']); !!}
                </div>
                <div class="w3-block w3-margin text-center">
                  <b>Discount:</b>(-) 
                      <span id="discount_calculated_amount" class="display_currency">0</span>
                </div>
            </div>
          </div>

          
          <div class="col-lg-4 col-md-4 col-sm-4 w3-padding"> 
            <div class="pr-card">
              <br>
              <div class="form-group">
                {!! Form::label('tax_id', __( 'purchase.purchase_tax' ) . ':') !!}
                <select name="tax_id" id="tax_id" class="form-control select2" placeholder="'Please Select'">
                  <option value="" data-tax_amount="0" selected>@trans('lang_v1.none')</option>
                  @foreach($taxes as $tax)
                    <option value="{{ $tax->id }}" @if($purchase->tax_id == $tax->id) {{'selected'}} @endif data-tax_amount="{{ $tax->amount }}"
                    >
                      {{ $tax->name }}
                    </option>
                  @endforeach
                </select>
                {!! Form::hidden('tax_amount', $purchase->tax_amount, ['id' => 'tax_amount']); !!}
                </div>
                <div class="w3-block w3-margin text-center">
                  <b>@trans( 'purchase.purchase_tax' ):</b>(+) 
                  <span id="tax_calculated_amount" class="display_currency">0</span>
                </div>
            </div>
          </div>

          
          <div class="col-lg-4 col-md-4 col-sm-4 w3-padding"> 
            <div class="pr-card">
              <br>
              <div class="form-group">
              {!! Form::label('shipping_details', __( 'purchase.shipping_details' ) . ':') !!}
              {!! Form::text('shipping_details', $purchase->shipping_details, ['class' => 'form-control']); !!}
              </div>
              <div class="form-group">
              {!! Form::label('shipping_charges','(+) ' . __( 'purchase.additional_shipping_charges') . ':') !!}
              {!! Form::text('shipping_charges', number_format($purchase->shipping_charges/$purchase->exchange_rate, $currency_precision, $currency_details->decimal_separator, $currency_details->thousand_separator), ['class' => 'form-control input_number']); !!}
              </div>
              <div class="w3-block w3-margin text-center">
                {!! Form::hidden('final_total', $purchase->final_total , ['id' => 'grand_total_hidden']); !!}
                <b>@trans('purchase.purchase_total'): </b><span id="grand_total" class="display_currency" data-currency_symbol='true'>{{$purchase->final_total}}</span>
              </div>
            </div>
          </div>
          
          <div class="form-group w3-block w3-padding">
            {!! Form::label('additional_notes',__('purchase.additional_notes')) !!}
            {!! Form::textarea('additional_notes', $purchase->additional_notes, ['class' => 'form-control', 'rows' => 3]); !!}
          </div> 
          
					@php
            $custom_labels = json_decode(session('business.custom_labels'), true); 
						$customPurchase = isset($custom_labels['purchase'])? $custom_labels['purchase'] : [];
          @endphp 
          @foreach ($customPurchase as $key => $value)
          @if ($value)
          <div class="col-md-3">
            <div class="form-group">
              {!! Form::label($key, __($value) . ':') !!}
              {!! Form::text($key, $purchase->$key, ['class' => 'form-control', 
                'placeholder' => __($value)]); !!}
            </div>
          </div>
          @endif
          @endforeach
        </div>
    @endcomponent
   
    <center class="w3-padding">
      <button type="button" id="submit_purchase_form" class="add_btn">
        @trans('messages.update')
      </button>
    </center>
{!! Form::close() !!}
</section>
<!-- /.content -->
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  @include('contact.create', ['quick_add' => true])
</div>

@endsection

@section('javascript')
  <script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
  <script type="text/javascript">
    $(document).ready( function(){
      update_table_total();
      update_grand_total();
      __page_leave_confirmation('#add_purchase_form');
    });
  </script>
  @include('purchase.partials.keyboard_shortcuts')
@endsection
