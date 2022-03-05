<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('TaxonomyController@store'), 'method' => 'post', 'id' => 'category_add_form' ]) !!}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@trans( 'messages.add' )</h4>
    </div>

    <div class="modal-body">
      <input type="hidden" name="category_type" value="{{$category_type}}">
      @php
        $name_label = !empty($module_category_data['taxonomy_label']) ? $module_category_data['taxonomy_label'] : __( 'category.category_name' );
        $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;

        $cat_code_label = !empty($module_category_data['taxonomy_code_label']) ? $module_category_data['taxonomy_code_label'] : __( 'category.code' );

        $enable_sub_category = isset($module_category_data['enable_sub_taxonomy']) && !$module_category_data['enable_sub_taxonomy'] ? false : true;

        $category_code_help_text = !empty($module_category_data['taxonomy_code_help_text']) ? $module_category_data['taxonomy_code_help_text'] : __('lang_v1.category_code_help');
      @endphp
      <div class="form-group">
        {!! Form::label('name', $name_label . ':*') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => $name_label]); !!}
      </div>
      @php
        
      $accounts = App\Account::forDropdown(null, true);
      @endphp
      <div class="form-group">
        {!! Form::label('account_id', __( 'account' ) . ':') !!}
        {!! Form::select('account_id', $accounts, null, ['class' => 'form-control']); !!}
      </div>
      @if($cat_code_enabled)
      <div class="form-group">
        {!! Form::label('short_code', $cat_code_label . ':') !!}
        {!! Form::text('short_code', null, ['class' => 'form-control', 'placeholder' => $cat_code_label]); !!}
        <p class="help-block">{!! $category_code_help_text !!}</p>
      </div>
      @endif
      <div class="form-group">
        {!! Form::label('description', __( 'lang_v1.description' ) . ':') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.description'), 'rows' => 3]); !!}
      </div>
      @if(!empty($parent_categories) && $enable_sub_category)
        <div class="form-group">
            <div class="checkbox category-check-container">
              <label>
                 {!! Form::checkbox('add_as_sub_cat', 0, false,[ 'class' => 'category-check toggler icheck on-icheck', 'data-toggle_id' => 'parent_cat_div' ]); !!} @trans( 'lang_v1.add_as_sub_txonomy' )
              </label>
            </div>
        </div>
        <div class="form-group" style="display: none" id="parent_cat_div">
          {!! Form::label('parent_id', __( 'category.select_parent_category' ) . ':') !!}
          {!! Form::select('parent_id', $parent_categories, null, ['class' => 'form-control']); !!}
        </div>
      @endif
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@trans( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@trans( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
  $('.category-check').iCheck('toggle', function(event){
    console.log(event);
    //alert();
    if (!$('.category-check')[0].checked) {
      $('#parent_cat_div').slideUp();
    } else {
      $('#parent_cat_div').slideDown();
    }
  });
 
  $('#parent_cat_div').addClass('hide');
  $('.category-check').iCheck('uncheck');

  //$('.icheck').parent().parent().parent().parent().find('#parent_cat_div');
</script>
