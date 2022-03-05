<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ShippingCompanyController@update', [$company->id]), 'method' => 'PUT', 'id' => 'shipping_company_edit_form' ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans( 'shipping.edit_company' )</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __( 'shipping.company_name' ) . ':*') !!}
                {!! Form::text('name', $company->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.shipping_company_name' )]); !!}
            </div>


        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@trans( 'messages.update' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
