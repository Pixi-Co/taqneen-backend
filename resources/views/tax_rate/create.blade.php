<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('TaxRateController@store'), 'method' => 'post', 'id' => 'tax_rate_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@trans( 'tax_rate.add_tax_rate' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('name', __( 'tax_rate.name' ) . ':*') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'tax_rate.name' )]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('amount', __( 'tax_rate.rate' ) . ':*') !!} @show_tooltip(__('lang_v1.tax_exempt_help'))
          {!! Form::text('amount', null, ['class' => 'form-control input_number', 'required']); !!}
      </div>
      
      
      @php 
        $taxCodes = App\GlobalSetting::getTaxCodes();
        $listOfTaxCodes = [];
        foreach($taxCodes as $item) {
            $listOfTaxCodes[$item->code] = "(" . $item->code . ") " . (session('user.language') == 'ar'? $item->desc_ar : $item->desc_en);
        }

      @endphp     
      <div class="row " > 
          <div class="col-sm-12">
            <b>{{ __('Tax code of einvoice') }}</b>
            @include("layouts.partials.tooltip", ["text" => __('einvoice_tax_code')])
              {!! Form::select('einvoice_tax_code', $listOfTaxCodes, '', ['class' => 'form-control select2 w3-light-gray']) !!}
          </div>
      </div>

      <div class="form-group">
        <div class="checkbox">
          <label>
             {!! Form::checkbox('for_tax_group', 1, false, [ 'class' => 'input_icheck']); !!} @trans( 'lang_v1.for_tax_group_only' )
          </label> @show_tooltip(__('lang_v1.for_tax_group_only_help'))
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

@include("layouts.js.icheck")

<script>
  $('.select2').select2();
</script>
