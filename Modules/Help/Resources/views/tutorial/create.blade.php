<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('\Modules\Help\Http\Controllers\TutorialController@store'), 'method' => 'post', 'id' =>  'quick_add_tutorial_form', 'class' => 'form', 'enctype' => 'multipart/form-data' ]) !!}

        @csrf
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@trans('add tutorial')</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('title_ar', __('title_ar')) !!}
                {!! Form::text('title_ar', null, ['class' => 'form-control', 'required', 'placeholder' => __('title_ar')]) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('title_en', __('title_en')) !!}
                {!! Form::text('title_en', null, ['class' => 'form-control', 'required', 'placeholder' => __('title_en')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description_ar', __('description_ar')) !!}
                <textarea name="description_ar" id="description_ar" class="form-control"  ></textarea>
            </div>

            <div class="form-group">
                {!! Form::label('description_en', __('description_en')) !!}
                <textarea name="description_en" id="description_en" class="form-control"  ></textarea>
            </div>

            <div class="form-group">
                {!! Form::label('image', __('image') . ':') !!}
                <input type="file" class="form-control" name="image" id="image" accept="image/*" >
            </div>

            <div class="form-group">
                {!! Form::label('video', __('video') . ':') !!}
                <input type="file" class="form-control" name="video" id="video" accept="video/*" >
            </div> 

            <div class="form-group">
                {!! Form::label('step', __('step') . ':') !!}
                <input type="number" class="form-control" name="step" id="step"  >
            </div> 

            <div class="form-group">
                {!! Form::label('related_user_field', __('related_user_field') . ':') !!}
                <input type="text" class="form-control" name="related_user_field" id="related_user_field"  >
            </div> 

            <div class="form-group">
                {!! Form::label('path_content', __('path_content') . ':') !!}
                <input type="text" class="form-control" name="path_content" id="path_content"  >
            </div> 

            <div class="form-group">
                {!! Form::label('position', __('position') . ':') !!}
                <select name="position" class="form-control" id="position">
                    @foreach (Tutorial::getPosition() as $key)
                        <option value="{{ $key }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div> 

            <div class="form-group">
                {!! Form::label('modal', __('modal') . ':') !!}
                <select name="modal" class="form-control" id="modal">
                    @foreach (Tutorial::getModalSizes() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>  

            <div class="form-group">
                {!! Form::label('modal', __('animation') . ':') !!}
                <select name="animation" class="form-control" id="animation">
                    @foreach (Tutorial::getAnimations() as $key)
                        <option value="{{ $key }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {!! Form::label('selector', __('selector') . ':') !!}
                <input type="text" class="form-control" name="selector" id="selector"  >
            </div> 

            <div class="form-group">
                {!! Form::label('page', __('page') . ':') !!}
                <input type="text" class="form-control" name="page" id="page"  >
            </div> 
 
            <div class="form-group">
                <label>
                    {!! Form::checkbox('is_required', 1, false, ['class' => 'input-icheck', 'checked' => 'checked']) !!}
                    {{ __('is_required') }}
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
      tutorials_table.ajax.reload();
    });

</script>
