<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ShippingFeesController@store', [$company_id]), 'method' => 'post', 'id' => 'shipping_fees_add_form' ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans( 'shipping.create_fees' )</h4>
        </div>

        <div class="modal-body">

            <div class="form-group">
                {!! Form::label('amount', __( 'shipping.amount' ) .":*") !!}
                {!! Form::number('amount', null, ['class' => 'form-control', 'required','placeholder' => __( 'shipping.amount') ]);
                !!}
            </div>

            <div class="form-group">
                {!! Form::label('sub_unit_ids', __('shipping.zone_name') . ':') !!}

                {{-- {!! Form::select('areas[]', $areas, null , ['class' => 'form-control select2', 'multiple', 'id' => 'areas']); !!} --}}
                {!! Form::select('area_id', $areas, null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;']); !!}

            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
