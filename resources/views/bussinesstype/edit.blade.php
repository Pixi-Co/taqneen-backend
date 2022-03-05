<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('BussinessTypeController@update', [$bussinesstype->id]), 'method' => 'PUT', 'id' => 'bus_edit_form']) !!}

        @csrf
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Bussiness Type</h4>
        </div>

        <div class="modal-body">

            <div class="form-group">
                {!! Form::label('name', __('user.name') . ':*') !!}
                {!! Form::text('name', $bussinesstype->name, ['class' => 'form-control', 'required', 'placeholder' => __('user.name')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon', __('lang_v1.icon') . ':*') !!}
                {!! Form::text('icon', $bussinesstype->icon, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.icon')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', __('brand.short_description') . ':') !!}
                {!! Form::text('description', $bussinesstype->description, ['class' => 'form-control', 'placeholder' => __('brand.short_description')]) !!}
            </div>

            <div class="form-group">
                <label>
                    {!! Form::checkbox('active', $bussinesstype->active, false, ['class' => 'input-icheck', 'checked' => $bussinesstype->active == 1? 'checked' : '']) !!}
                    {{ __('lang_v1.is_active') }}
                </label>
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@trans( 'messages.update' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>
