<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ShippingSettlementController@update', ['company' => $company_id, 'id' => $sell->id]), 'method' => 'PUT', 'id' => 'settle_shipping_company_form' ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{ __('sale.invoice_no') }}: #{{ $sell->invoice_no }}</h4>
        </div>

        <div class="modal-body">

            <div class="form-group">
                {!! Form::label('shipping_status', __('lang_v1.shipping_status')) !!}
                {!! Form::select('shipping_status',$shipping_statuses, null, ['class' => 'form-control','placeholder' => __('messages.please_select')]); !!}
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
