<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('ShippingCompanyController@store'), 'method' => 'post', 'id' =>
        'shipping_company_add_form' ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans( 'shipping.add_company' )</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __( 'shipping.company_name' ) .":*") !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.name'
                ) ]);
                !!}
            </div>

            {{-- <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('image', __('lang_v1.product_image') . ':') !!}
                    {!! Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*']); !!}
                    <small>
                        <p class="help-block">@trans('purchase.max_file_size', ['size' =>
                            (config('constants.document_size_limit') / 1000000)]) <br>
                            @trans('lang_v1.aspect_ratio_should_be_1_1')</p>
                    </small>
                </div>
            </div> --}}
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
