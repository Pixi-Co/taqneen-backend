<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('BussinessTypeController@store'), 'method' => 'post', 'id' =>  'quick_add_bus_form', 'class' => 'form' ]) !!}

        @csrf
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> add bussiness type</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', __('user.name') . ':*') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('user.name')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', __('brand.short_description') . ':') !!}
                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('brand.short_description')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon', __('lang_v1.icon') . ':') !!}
                {!! Form::text('icon', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.icon')]) !!}
            </div>
            
            <div class="form-group">
              <br>
                <label>
                    {!! Form::checkbox('active', 1, false, ['class' => 'input-icheck']) !!}
                    {{ __('lang_v1.is_active') }}
                </label>
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
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

    formAjax(false, function(r){
      buss_table.ajax.reload();
    });

</script>
