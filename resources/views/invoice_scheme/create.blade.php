<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('InvoiceSchemeController@store'), 'method' => 'post', 'id' => 'invoice_scheme_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@trans( 'invoice.add_invoice' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="option-div-group">

          <div class="col-sm-6">
            <div class="form-group">
              <div class="option-div w3-display-container">
                <h4>FORMAT: <br>XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                {!! Form::radio('scheme_type', 'blank'); !!}

                <div class="w3-display-topright w3-padding selected">
                  <i class="fa fa-check-circle w3-text-green"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <div class="option-div w3-display-container">
                <h4>FORMAT: <br>{{ date('Y') }}-XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                {!! Form::radio('scheme_type', 'year'); !!}

                <div class="w3-display-topright w3-padding selected">
                  <i class="fa fa-check-circle w3-text-green"></i>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-sm-4 hidden">
          <div class="form-group">
            <label>@trans('invoice.preview'):</label>
            <div id="preview_format">@trans('invoice.not_selected')</div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::label('name', __( 'invoice.name' ) . ':*') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]); !!}
          </div>
        </div>
        <div id="invoice_format_settings" class="hide">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('prefix', __( 'invoice.prefix' ) . ':') !!}
            <div class="input-"> 
                {!! Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => '']); !!}
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('start_number', __( 'invoice.start_number' ) . ':') !!}
            <div class="">
                {!! Form::number('start_number', 0, ['class' => 'form-control', 'required', 'min' => 0 ]); !!}
            </div>
          </div>
        </div>
        <div class="clearfix">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('total_digits', __( 'invoice.total_digits' ) . ':') !!}
            <div class="">
              {!! Form::select('total_digits', ['4' => '4', '5' => '5', '6' => '6', '7' => '7', 
              '8' => '8', '9'=>'9', '10' => '10'], 4, ['class' => 'form-control', 'required']); !!}
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <br>
            <div class="checkbox">
              <label>
                {!! Form::checkbox('is_default', 1); !!} @trans('barcode.set_as_default')</label>
            </div>
          </div>
        </div>
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