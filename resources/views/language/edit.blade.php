<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('LanguageController@update', [$language->id]), 'method' => 'PUT', 'id' => 'language_edit_form']) !!}

        @csrf
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Language</h4>
        </div>

        <div class="modal-body">

            <div class="form-group">
                {!! Form::label('name', __('user.name') . ':*') !!}
                {!! Form::text('name', $language->name, ['class' => 'form-control', 'required', 'placeholder' => __('user.name')]) !!}
            </div> 

            <div class="form-group">
                {!! Form::label('short_name', __('short_name') . ':*') !!}
                {!! Form::text('short_name',  $language->short_name, ['class' => 'form-control', 'required', 'placeholder' => __('short_name')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('key', __('key') . ':*') !!}
                {!! Form::text('key',  $language->key, ['class' => 'form-control', 'required', 'placeholder' => __('key')]) !!}
            </div>
            
            <div class="form-group">
                <br>
                <label>
                    {!! Form::checkbox('is_rtl',  $language->is_rtl, false, ['class' => 'input-icheck']) !!}
                    {{ __('is_rtl') }}
                </label>
            </div>
            
            <div class="form-group">
              <br>
                <label>
                    {!! Form::checkbox('active',  $language->active, false, ['class' => 'input-icheck']) !!}
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
